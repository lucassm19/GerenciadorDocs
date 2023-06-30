@extends('base')

@section('title', 'Meus Documentos')

@section('content')

<h2 class="text-lg font-bold mb-4 text-center">PDF, DOC e DOCX</h2>

<table class="min-w-full divide-y divide-gray-200">
    <thead>
        <tr>
            <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID
            </th>
            <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Nome
                do Arquivo</th>
            <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Tipo
            </th>
            <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Nome
                do Usuário</th>
            <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Ações
            </th>
        </tr>
    </thead>

    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($documentosFixos as $documentoFixo)
        <tr>
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-center">{{$documentoFixo->id}}</td>
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-center">{{$documentoFixo->nome_arquivo}}</td>
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-center">{{$documentoFixo->tipo}}</td>
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-center">{{$documentoFixo->nome_usuario}}</td>
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-center">
                <a href="{{ route('upload.visualizar', $documentoFixo->id) }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Visualizar</a>
                <a href="{{ route('upload.apagarFixo', $documentoFixo->id) }}"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Excluir</a>
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Compartilhar</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<br>
<br>
<br>

<div class="mb-5">
    <h2 class="text-lg font-bold mb-4 text-center">Rich-Text</h2>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID
                </th>
                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Nome do Arquivo</th>
                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Tipo</th>
                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Nome do Usuário</th>
                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Ações</th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($documentos as $documento)
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-center">{{$documento->id}}</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-center">{{$documento->nome_arquivo}}</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-center">{{$documento->tipo}}</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-center">{{$documento->nome_usuario}}</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-center">
                    <a href="{{ route('upload.visualizar', $documento->id) }}"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Visualizar</a>
                    <a href="{{ route('upload.apagar', $documento->id) }}"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Excluir</a>
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Compartilhar</button>
                    <a href="{{ route('upload.editar', $documento->id) }}"
                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Editar Rich
                        Text</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection