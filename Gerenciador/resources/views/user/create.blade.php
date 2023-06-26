@extends('base')

@section('title', 'Cadastro de Usuários')

@section('content')
    <form action="{{ route('user.create')}}" method="POST">
        @csrf

        <input type="text" name="name" id="name" placeholder="Username" class="mb-2">

        <br>

        <input type="password" name="password" id="password" placeholder="Senha" class="mb-2">

        <br>

        <input type="email" name="email" id="email" placeholder="E-mail" class="mb-2">

        <br>
            
        <input type="submit" value="Gravar" class="mb-2 bg-green-400 p-2 rounded-lg cursor-pointer">
    </form>

@endsection
