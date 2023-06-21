<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('documento')) {
            $documento = $request->file('documento');
            $nomeDocumento = time() . '_' . $documento->getClientOriginalName();
            $documento->move(public_path('uploads'), $nomeDocumento);

            // Outras ações necessárias, como salvar o caminho do arquivo no banco de dados, etc.

            return redirect()->back()->with('successo', 'Documento enviado com sucesso.');
        }

        return redirect()->back()->with('erro', 'Nenhum documento selecionado.');
    }
}
