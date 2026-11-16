<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Cart extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'cart';

    protected $primaryKey = 'id_cart';

    protected $fillable = ['id_product', 'id_user', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}
