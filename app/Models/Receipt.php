<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    public $guarded=[];

    public function items(){
        return $this->hasMany(ReceiptItem::class);
    }

    public function payments(){
        return $this->hasMany(ReceiptPayment::class);
    }
}
