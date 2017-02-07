<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $table = 'clients';
    protected $dates = ['deleted_at'];

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
