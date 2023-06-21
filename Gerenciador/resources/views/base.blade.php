<form action="/upload" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="documento" accept=".pdf,.doc,.docx">
    <button type="submit">Enviar</button>
</form>
