<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bike extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['marca', 'modelo', 'kms', 'precio', 'matriculada', 'imagen', 'user_id', 'matricula', 'color'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
