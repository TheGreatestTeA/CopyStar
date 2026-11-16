<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id_order';

    protected $fillable = [
        'id_user',
        'id_status',
        'reasonCancellation',
        'id_orderitems'
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function orderitems()
    {
        return $this->belongsTo(Orderitems::class, 'id_orderitems', 'id_orderitems');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status', 'id_status');
    }
}