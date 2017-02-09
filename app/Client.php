<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $table = 'clients';
    protected $dates = ['deleted_at'];
    protected $with = ['main_contact'];
    protected $appends = [
        'client_type',
        'address'
    ];

    /**
     * Return all Contacts associated with the Client, if the Client is marked as a Company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Return main Contact of the Client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function main_contact()
    {
        return $this->hasOne(Contact::class, 'id', 'main_contact_id');
    }

    /**
     * Return all Jobs associated with the Client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    /**
     * Return subscription information if the Client has a subscription.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subscription()
    {
        return $this->hasOne(Service::class);
    }

    /**
     * @return string
     */
    public function getClientTypeAttribute()
    {
        if ($this->attributes['company']) {
            return 'Company';
        } else {
            return 'Individual';
        }
    }

    public function getAddressAttribute()
    {
        return $this->attributes['address_line_1'] . ' ' . $this->attributes['address_town'] . ' ' . $this->attributes['address_county'] . ' ' . $this->attributes['address_postcode'];
    }

    /**
     * Scope a query to only return Companies.
     *
     * @param $query
     * @return mixed
     */
    public function scopeCompany($query)
    {
        return $query->where('company', 1);
    }

    /**
     * Scope a query to only return Individuals.
     *
     * @param $query
     * @return mixed
     */
    public function scopeIndividual($query)
    {
        return $query->where('company', 0);
    }

    /**
     * Scope a query to only include active Clients.
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * Scope a query to only include Bad Payers.
     *
     * @param $query
     * @return mixed
     */
    public function scopeBadPayer($query)
    {
        return $query->where('payer_warning', 1);
    }

    /**
     * Scope a query to only include subscribed Clients.
     *
     * @param $query
     * @return mixed
     */
    public function scopeSubscriber($query)
    {
        return $query->whereNotNull('subscription');
    }

    /**
     * Scope a query to only include Clients that initially enquired.
     *
     * @param $query
     * @return mixed
     */
    public function scopeEnquired($query)
    {
        return $query->where('from_enquiry', 1);
    }
}
