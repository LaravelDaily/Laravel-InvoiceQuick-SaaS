<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Invoice
 * @package App
 */
class Invoice extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'invoice_date',
        'invoice_amount',
    ];

    /**
     * @return BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
