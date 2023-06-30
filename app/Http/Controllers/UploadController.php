<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Models\Documento;
use App\Models\DocumentoFixo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload.index');
    }

    public function tabela()
    {
        // Obtém o usuário logado
        $user = Auth::user();

        // Obtém os documentos fixos do usuário logado
        $documentosFixos = DocumentoFixo::where('nome_usuario', $user->name)->get();

        // Obtém os documentos do usuário logado
        $documentos = Documento::where('nome_usuario', $user->name)->get();

        return view('upload.tabela', [
            'documentosFixos' => $documentosFixos,
            'documentos' => $documentos
        ]);
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
        $titulo = $request->input('titulo');
        $documento = $request->input('documento');

        if ($titulo && $documento) {
            // Remove as tags HTML do conteúdo do documento
            $texto = strip_tags($documento);

            $caminho = 'documentos/';
            $nomeArquivo = $titulo . '.txt';

            // Armazena o conteúdo do documento (apenas o texto) no arquivo "public/documentos/{titulo}.txt"
            Storage::put($caminho . $nomeArquivo, $texto);

            // Salvar informações na tabela de documentos
            $documentoModel = new Documento();
            $documentoModel->nome_arquivo = $nomeArquivo;
            $documentoModel->tipo = 'rich-text';
            $documentoModel->nome_usuario = $request->user()->name; // Assume que você tem um sistema de autenticação com usuários
            $documentoModel->save();

            return 'Documento rich-text salvo com sucesso!';
        }

        return 'Título e/ou documento não fornecidos.';
    }

    public function visualizar($id)
    {
        // Obter o documento fixo com base no ID fornecido
        $documentoFixo = DocumentoFixo::find($id);

        // Verificar se o documento foi encontrado
        if (!$documentoFixo) {
            // Redirecionar ou exibir uma mensagem de erro, caso o documento não exista
            return redirect()->back()->with('error', 'Documento não encontrado.');
        }

        // Retornar a visualização do documento fixo, passando o objeto $documentoFixo para a view
        return view('upload.visualizar', ['documentoFixo' => $documentoFixo]);
    }

    public function atualizar(Request $request, $id)
    {
        $documento = DocumentoFixo::findOrFail($id);

        $documento->titulo = $request->input('titulo');

        $documento->save();

        return redirect()->route('upload.index')->with('success', 'Documento atualizado com sucesso.');
    }

    public function editar(Documento $documento)
    {
        return view('upload.editar', ['documento' => $documento]);
    }

    public function editarGravar(UploadRequest $request, Documento $documento)
    {
        $dados = $request->validated();
        $documento->update($dados);
        return redirect()->route('upload.index')->with('success', 'Documento editado com sucesso.');
    }

    public function apagar(Documento $documento)
    {
        // Se for um pedido DELETE, exclui o documento do banco de dados
        if (request()->isMethod('DELETE')) {
            // Realize a exclusão tanto da tabela 'Documento' quanto da 'DocumentoFixo'
            $documento->delete();
            Documento::where('id', $documento->id)->delete();
            return redirect()->route('upload.tabela')->with('sucesso', 'Documento apagado com sucesso.');
        }

        return view('upload.apagar', ['documento' => $documento]);
    }

    public function apagarFixo(DocumentoFixo $documentoFixo)
    {
        if (request()->isMethod('DELETE')) {
            $documentoFixo->delete();
            return redirect()->route('upload.tabela')->with('sucesso', 'Documento fixo excluído com sucesso.');
        }

        return view('upload.apagar', ['documentoFixo' => $documentoFixo]);
    }

    public function buscar(Request $request)
    {
        $filtro = $request->input('filtro');
        $termo = $request->input('termo');

        if ($filtro === 'data_upload') {
            $documentos = Documento::whereDate('created_at', $termo)->get();
            $documentosFixos = DocumentoFixo::whereDate('created_at', $termo)->get();
        } else {
            $documentos = Documento::where($filtro, 'like', '%' . $termo . '%')->get();
            $documentosFixos = DocumentoFixo::where($filtro, 'like', '%' . $termo . '%')->get();
        }

        return view('upload.tabela', compact('documentos', 'documentosFixos'));
    }
}
