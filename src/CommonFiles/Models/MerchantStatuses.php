<?php

namespace OlaHub\Models;

class MerchantStatuses extends OlaHubCommonModels {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    
    protected $table = 'lkp_merchant_statuses';
    
}
