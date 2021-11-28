<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class UsersImportController extends Controller
{
    public function show()
    {

        return view('users.import');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);
        $file = $request->file('file')->store('import');

        $import = new UsersImport;
        $import->import($file);
        
        return back()->withStatus('El archivo Excel fue importado correctamente');
    }
}
