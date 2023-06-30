@extends('base')

@section('title', 'VIsualização Documento')

@section('content') 


<iframe src="{{ asset('documentos/' . $documentoFixo->id) }}" width="100%" height="500px"></iframe>


@endsection