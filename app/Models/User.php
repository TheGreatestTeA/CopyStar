<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'login',
        'id_role',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false;

    public function cartProducts(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'cart',
            'id_user',
            'id_product'
        )->withPivot('quantity', 'id_cart');
    }
}
