<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    protected $fillable = ['numero_conta','saldo'];

    protected $hidden = ['created_at', 'updated_at', 'id'];
}
