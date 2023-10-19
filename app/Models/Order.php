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

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function designer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'designer_id', 'id');
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
