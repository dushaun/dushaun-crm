<?php

namespace App;

use App\Events\EnquirySubmitted;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Notifications\Notifiable;

class Enquiry extends Model
{
    protected $table = 'enquiries';
    protected $appends = ['prospect_type'];
    protected $with = ['product'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne(WebProduct::class, 'id', 'product_id');
    }

    /**
     * @return string
     */
    public function getProspectTypeAttribute()
    {
        if ($this->attributes['company']) {
            return 'Company';
        } else {
            return 'Individual';
        }
    }

    /**
     * Scope a query to only include Individual Enquiries.
     *
     * @param $query
     * @return mixed
     */
    public function scopeIndividual($query)
    {
        return $query->where('company', 0);
    }

    /**
     * Scope a query to only include Company Enquiries.
     *
     * @param $query
     * @return mixed
     */
    public function scopeCompany($query)
    {
        return $query->where('company', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeRead($query)
    {
        return $query->where('read', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNotRead($query)
    {
        return $query->where('read', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeAccepted($query)
    {
        return $query->where('accepted', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNotAccepted($query)
    {
        return $query->where('accepted', 1);
    }
}
