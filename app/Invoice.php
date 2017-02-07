<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    /**
     * Return associated Job.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Return associated Client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Scope a query to only include Paid Invoices.
     *
     * @param $query
     * @return mixed
     */
    public function scopePaid($query)
    {
        return $query->where('paid', 1);
    }

    /**
     * Scope a query to only include Payments via Online.
     *
     * @param $query
     * @return mixed
     */
    public function scopeOnline($query)
    {
        return $query->where('payment_type', 0);
    }

    /**
     * Scope a query to only include Payments via Bank Transfer.
     *
     * @param $query
     * @return mixed
     */
    public function scopeBankTransfer($query)
    {
        return $query->where('payment_type', 1);
    }
}
