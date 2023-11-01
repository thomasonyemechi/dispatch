<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

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
        'total_price' => 'float',
        'advance_paid' => 'float'
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

    public function dispatcher()
    {
        return $this->belongsTo(User::class, 'dispatch_id', 'id');

    }

    
    public function getTimeLeftAttribute()
    {
        $receivingDate = Carbon::parse($this->attributes['receiving_date']);
        $now = Carbon::now();

        return $receivingDate->diffForHumans($now, [
            'syntax' => CarbonInterface::DIFF_ABSOLUTE
        ]);
    }
}
