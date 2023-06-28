{{-- resources/views/upload/index.blade.php --}}
@extends('base')

@section('title', 'Upload de Arquivos')

@section('content')

<link rel="stylesheet" href="{{ asset('js/tinymce/skins/ui/oxide/skin.min.css') }}">
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>

<form action="{{ route('upload.save') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    <br>
    <button type="submit"
        class="rounded-lg border border-blue-500 bg-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-primary-700 hover:bg-primary-700 focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:border-primary-300 disabled:bg-primary-300"
        value="Gravar">Salvar Documento</button>
</form>

<br>
<br>

<form action="{{ route('upload.saverichtext') }}" method="POST">
    @csrf
    <textarea name="documento"></textarea>
    <script>
        tinymce.init({
     selector: 'textarea',
     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
     tinycomments_mode: 'embedded',
     tinycomments_author: 'Author name',
     mergetags_list: [
       { value: 'First.Name', title: 'First Name' },
       { value: 'Email', title: 'Email' },
     ]
   });
    </script>
    <button type="submit"
        class="rounded-lg border border-blue-500 bg-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-primary-700 hover:bg-primary-700 focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:border-primary-300 disabled:bg-primary-300">Salvar
        Rich-text</button>
</form>
@endsection