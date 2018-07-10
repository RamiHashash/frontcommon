<?php

namespace OlaHub\Models\ManyToMany;

class occasionCountries extends \OlaHub\Models\OlaHubCommonModels {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
        $this->statusColumn = 'occasionStatus';
    }

    public static function boot() {
        parent::boot();
        static::addGlobalScope(new \OlaHub\Scopes\publishScope);
    }

    protected $table = 'country_occasion_types';

    public function countryData() {
        return $this->belongsTo('OlaHub\Models\Country', 'country_id');
    }

    public function occasionData() {
        return $this->belongsTo('OlaHub\Models\Occasion', 'occasion_type_id');
    }

}
