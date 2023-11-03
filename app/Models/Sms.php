<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    use HasFactory;

    protected $guarded;

    public function receiver()
    {
        return $this->belongsTo(Customer::class, 'phone');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sent_by');
    } 
}
