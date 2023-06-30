@extends('base')

@section('title', 'Login')

@section('content')
<form action="{{ route('user.login')}}" method="POST">
    @csrf

    <input type="text" name="name" id="username" placeholder="Username" class="mb-2">

    <br>

    <input type="password" name="password" id="password" placeholder="Senha" class="mb-2">

    <br>

    <button type="submit" class="mb-2 bg-blue-400 p-2 rounded-lg cursor-pointer">Acessar</button>


    <a href="{{ route('user.create') }}" type="submit"
        class="mb-2 bg-blue-400 p-2 rounded-lg cursor-pointer">Novo
        Usuário</a>
</form>

@endsection