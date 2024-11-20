<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    // ...
    protected $fillable = [
        'name',       // Permitir asignación masiva para 'name'
        'email',
        'password',
        'role',       // Asegúrate de que 'role' también esté aquí si lo necesitas
    ];
}
