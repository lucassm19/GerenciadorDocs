<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index() {
        return view('upload.index');
    }

    public function save(Request $form) {
        $arquivo = $form->file('file');

        $arquivo->storeAs('public', $arquivo->getClientOriginalName());
        return 'Gravado!';
    }
}

//Documentação sobre o tema "File Storage"
