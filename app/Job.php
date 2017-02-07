<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';

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
     * Return associated Contact, if the Client is a Company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    /**
     * Return associated Invoice, if one has been generated.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    /**
     * Return associated Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne(WebProduct::class, 'product_id');
    }

    /**
     * Scope a query to only include Completed Jobs.
     *
     * @param $query
     * @return mixed
     */
    public function scopeCompleted($query)
    {
        return $query->whereNotNull('completed');
    }

    /**
     * Scope a query to only include Jobs with additional days.
     *
     * @param $query
     * @return mixed
     */
    public function scopeWithAdditionalDays($query)
    {
        return $query->whereNotNull('additional_days');
    }

    /**
     * Scope a query to only include Quoted Jobs.
     *
     * @param $query
     * @return mixed
     */
    public function scopeQuote($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope a query to only include Jobs that are In Progress.
     *
     * @param $query
     * @return mixed
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', 2);
    }
}
