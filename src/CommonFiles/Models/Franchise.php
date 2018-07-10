<?php

namespace OlaHub\Models;

class Franchise extends OlaHubCommonModels {

    //use \Illuminate\Database\Eloquent\SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
        $this->statusColumn = 'franchiseStatus';
        $this->portalUtilities = new \OlaHub\MerchantPortal\Helpers\SecureHelper;
    }

    protected $table = 'sec_franchise';

}
