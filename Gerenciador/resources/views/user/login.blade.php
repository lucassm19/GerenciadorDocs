@extends('base')

@section('title', 'Login')

@section('content')
    <form action="{{ route('user.login')}}" method="POST">
        @csrf

        <input type="text" name="name" id="username" placeholder="Username" class="mb-2">

        <br>

        <input type="password" name="password" id="password" placeholder="Senha" class="mb-2">

        <br>

        <input type="submit" value="Acessar" class="mb-2 bg-green-400 p-2 rounded-lg cursor-pointer">
        <a href="{{ route('user.create') }} " type="submit"></a>
    </form>

@endsection