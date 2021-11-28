@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-primary">
                <div class="card-header border-primary">Importar Excel</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if (isset($errors) && $errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $e )
                        <li>
                            {{$e}}
                        </li>
                        @endforeach

                    </ul>

                </div>
                    @endif

                @if (session()->has('Failure'))
                <table class="table table-danger">
                    <tr>
                        <th>Columna</th>
                        <th>Atributos</th>
                        <th>Errores</th>
                        <th>Valor</th>
                    </tr>
                    @foreach (session()->get('Failure') as $validation)
                    <tr>
                        <td>{{$validation["row"]}}</td>
                        <td>{{$validation["attribute"]}}</td>
                        <td>
                            <ul>
                                @foreach ($validation["errors"] as $e)
                                <li>{{$e}}</li>

                                @endforeach
                            </ul>
                        </td>
                        <td>
                            {{$validation["values"]}}
                        </td>

                    </tr>

                    @endforeach


                </table>
                @php
                    session()->forget('Failure');
                @endphp

                @endif


                @if (session()->has('Success'))
                <table class="table table-success">
                    <tr>
                        <th>Columna</th>
                        <th>Estudiante</th>
                        <th>Mensaje</th>

                    </tr>
                    @foreach (session()->get('Success') as $validation)
                    <tr>
                        <td>{{$validation["row"]}}</td>
                        <td>{{$validation["attribute"]}}</td>
                        <td>
                            <ul>
                                @foreach ($validation["errors"] as $e)
                                <li>{{$e}}</li>

                                @endforeach
                            </ul>
                        </td>


                    </tr>

                    @endforeach


                </table>
                @php
                    session()->forget('Success');
                @endphp

                @endif


                    <form action="/users/import" method="POST" enctype="multipart/form-data" >
                        @csrf

                        <div class="form-group">
                            <input  type="file" name="file" required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />

                            <button type="submit" class="btn btn-primary">Importar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
