<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoFixo extends Model
{
    use HasFactory;

    protected $table = 'documentos_fixos';

    protected $fillable = [
        'nome_arquivo',
        'tipo',
        'nome_usuario',
    ];

}
