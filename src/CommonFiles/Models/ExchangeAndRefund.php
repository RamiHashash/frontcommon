<?php

namespace OlaHub\Models;

class ExchangeAndRefund extends OlaHubCommonModels {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    

    protected $table = 'exchange_refund_policies';

    public function countryRelation() {
        return $this->hasMany('OlaHub\Models\ManyToMany\exchRefundPolicyCountries','policy_id');
    }

}
