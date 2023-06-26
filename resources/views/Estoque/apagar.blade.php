@extends('base')
@section('title', 'Estoque - Apagar')

@section('content')

<div>Quer apagar mesmo? 👌</div>

<p>Você está prestes a apagar {{$estoque['nome']}}.</p>

<form action="{{route('estoque.apagar', $estoque, $estoque['id'])}}" method="post">
    @method('delete')
    @csrf

    <button type="submit">Apagar</button>
</form>

@endsection