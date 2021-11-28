<?php

namespace App\Imports;

use App\Models\Carrera;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Throwable;

use function PHPUnit\Framework\isEmpty;

class UsersImport implements
    ToCollection,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure,
    WithChunkReading,
    ShouldQueue,
    WithEvents
{
    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;

    public function collection(Collection $rows)
    {
        $hasFailure = array();
        $hasSuccess = array();


        foreach ($rows as $key=>$row) {

            if(!strlen($row["name"])){
                $msj="El campo esta vacio";
                $index="name";
                array_push($hasFailure, $this->generateDetail($key, $index, $msj, $row[$index]));
                continue;

            }

            if(!strlen($row["email"])){
                $msj="El campo esta vacio";
                $index="email";
                array_push($hasFailure, $this->generateDetail($key, $index, $msj, $row[$index]));
                continue;

            }

            if(strlen($row['id_carrera'])!=4){
                if(strlen($row["id_carrera"])==0){
                    $msj="El campo esta vacio";
                }else{
                    $msj="Longitud Incorrecta, Longitud de campo: ".strlen($row["id_carrera"]);
                }

                array_push($hasFailure, $this->generateDetail($key, "id_carrera", $msj, $row["id_carrera"]));
                continue;
            }
            if(!preg_match("/^\d{8}[A-z0-9]{1}$/", $row["rut"])){
                $msj="Formato Incorrecto";

                array_push($hasFailure, $this->generateDetail($key, "rut", $msj, $row["rut"]));
                continue;
            }

            if (!filter_var($row["email"], FILTER_VALIDATE_EMAIL)) {
                $msj="Formato Incorrecto";
                $index="email";
                array_push($hasFailure, $this->generateDetail($key, $index, $msj, $row[$index]));
                continue;
              }
            $validaterut=User::where("rut", $row["rut"])->get();
            if(sizeof($validaterut)>0){
                $msj="El rut esta en uso";
                $index="rut";
                array_push($hasFailure, $this->generateDetail($key, $index, $msj, $row[$index]));
                continue;
            }
            $validatecodigo=Carrera::where("codigo", $row["id_carrera"])->get();
            if(sizeof($validatecodigo)<=0){
                $msj="El codigo de la carrera no esta en el sistema";
                $index="id_carrera";
                array_push($hasFailure, $this->generateDetail($key, $index, $msj, $row[$index]));
                continue;
            }

            $validateEmail=User::where("email", $row["email"])->get();
            if(sizeof($validateEmail)>0){
                $msj="El email esta en uso";
                $index="email";
                array_push($hasFailure, $this->generateDetail($key, $index, $msj, $row[$index]));
                continue;
            }


            $defaultPassword = substr($row["rut"],0,6);
            User::create([
                'carrera_id'=> NULL,//$row['id_carrera'],
                'rut'=> $row['rut'],
                'name'=> $row['name'],
                'email'=> $row['email'],
                'status'=>1,
                'tipo_usuario'=>'Alumno',
                'password'=>Hash::make($defaultPassword)

            ]);
            array_push($hasSuccess, $this->generateDetail($key, $row["rut"], "El alumno se cargo correctamente", NULL));


        }

        if(sizeof($hasFailure)>0){
            session(['Failure' => $hasFailure]);
        }
        if(sizeof($hasSuccess)>0){
            session(['Success' => $hasSuccess]);
        }

    }

    public function generateDetail($row, $attribute, $message, $value){
        return array(
            'row'=> $row,
            'attribute'=>$attribute,
            'errors'=> array($message),
            'values'=> $value
        );

    }

    public static function afterImport(AfterImport $event)
    {
    }


    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required:users,email | unique:users,email',
            'rut' => ['required', 'regex:/^\d{8}[A-z0-9]{1}$/'],
            'id_carrera' => 'required',
        ];
    }

    public function onFailure(Failure ...$failure)
    {


    }
    public function chunkSize(): int
    {
        return 1000;
    }



}
