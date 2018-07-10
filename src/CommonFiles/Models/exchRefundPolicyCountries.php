<?php

namespace OlaHub\Models\ManyToMany;

class exchRefundPolicyCountries extends \OlaHub\Models\OlaHubCommonModels {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    
    public static function boot() {
        parent::boot();
        static::addGlobalScope(new \OlaHub\Scopes\publishScope);
    }

    protected $table = 'country_excng_refnd_plcy';
    
    public function countryData() {
        return $this->belongsTo('OlaHub\Models\Country','country_id');
    }

    public function exchRefundPolicyData() {
        return $this->belongsTo('OlaHub\Models\ExchangeAndRefund','policy_id');
    }

}
