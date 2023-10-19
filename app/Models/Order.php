<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $guarded;

    protected $fillable = [
        'customer_id',
        'designer_id',
        'service_name',
        'files',
        'receiver_address',
        'receiver_phone',
        'total_price',
        'advance_paid',
        'receiving_date',
        'created_by',
    ];
    protected $casts = [
        'files' => 'array',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

}
