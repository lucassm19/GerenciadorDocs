<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\DocumentoFixo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload.index');
    }

    public function save(Request $form)
    {
        $arquivo = $form->file('file');

        if ($arquivo) {
            $formatosPermitidos = ['pdf', 'doc', 'docx'];

            $extensao = $arquivo->getClientOriginalExtension();

            if (in_array($extensao, $formatosPermitidos)) {
                $nomeArquivo = $arquivo->getClientOriginalName();
                $caminho = 'documentos/';

                // Armazena o arquivo na pasta "public/documentos"
                Storage::putFileAs($caminho, $arquivo, $nomeArquivo);

                // Salvar informações na tabela de documentos
                $documentoFixo = new DocumentoFixo();
                $documentoFixo->nome_arquivo = $nomeArquivo;
                $documentoFixo->tipo = $extensao;
                $documentoFixo->nome_usuario = $form->user()->name; // Assuming you have an authentication system with users
                $documentoFixo->save();

                return 'Upload realizado com sucesso!';
            } else {
                return 'Formato de arquivo não suportado. Apenas PDF, DOC e DOCX são permitidos.';
            }
        }

        return 'Nenhum arquivo selecionado.';
    }

    public function saverichtext(Request $request)
    {
        $documento = $request->input('documento');

        if ($documento) {
            // Remove as tags HTML do conteúdo do documento
            $texto = strip_tags($documento);

            $caminho = 'documentos/';
            $nomeArquivo = time() . '_' . 'rich-text.txt';

            // Armazena o conteúdo do documento (apenas o texto) no arquivo "public/documentos/rich-text.txt"
            Storage::put($caminho . $nomeArquivo, $texto);

            // Salvar informações na tabela de documentos
            $documentoModel = new Documento();
            $documentoModel->nome_arquivo = $nomeArquivo;
            $documentoModel->tipo = 'rich-text';
            $documentoModel->nome_usuario = $request->user()->name; // Assume que você tem um sistema de autenticação com usuários
            $documentoModel->save();

            return 'Documento rich-text salvo com sucesso!';
        }

        return 'Nenhum documento rich-text enviado.';
    }
}
