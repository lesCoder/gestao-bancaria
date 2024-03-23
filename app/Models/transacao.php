<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transacao extends Model
{
    use HasFactory;

    protected $table = 'transacoes';

    protected $fillable = ['tipo','valor', 'descricao','conta_id'];

    protected $hidden = ['created_at', 'updated_at', 'id'];
}
