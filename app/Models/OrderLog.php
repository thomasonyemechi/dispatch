<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    use HasFactory;

    protected $guarded; 

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }


    public function staff()
    {
        return $this->belongsTo(User::class, 'logged_by');
    }


    public function designer_log()
    {
        return $this->where(['department' => 'designer'])->get();
    }

    public function complete_design()
    {
        return $this->hasOne(OrderLog::class, 'id')->where(['department' => 'designer', 'status' => 'completed']);
    }
}
