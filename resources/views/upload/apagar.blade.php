@extends('base')

@section('title', 'Excluir Documento')

@section('content')

<p class="font-bold">Deseja mesmo excluir este documento?</p>

@if(isset($documento))
<p> {{ $documento->nome_arquivo }} </p>
@elseif(isset($documentoFixo))
<p> {{ $documentoFixo->nome_arquivo }} </p>
@endif

@if(isset($documento))
<form action="{{ route('upload.apagar', $documento->id) }}" method="POST" class="inline-block">
    @csrf
    @method('DELETE')
    <input type="hidden" name="tipo_documento" value="{{ $documento->tipo }}">
    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2">Excluir
        Documento</button>
</form>
@elseif(isset($documentoFixo))
<form action="{{ route('upload.apagarFixo', $documentoFixo->id) }}" method="POST" class="inline-block">
    @csrf
    @method('DELETE')
    <input type="hidden" name="tipo_documento" value="{{ $documentoFixo->tipo }}">
    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2">Excluir
        Documento Fixo</button>
</form>
@endif

<a href="{{ url()->previous() }}"
    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Voltar</a>

@endsection