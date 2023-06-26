{{-- resources/views/upload/index.blade.php --}}
@extends('base')

@section('title', 'Upload')

@section('content')
    <form action="{{ route('upload.save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <br>
        <input type="submit" value="Gravar">
    </form>

@endsection
