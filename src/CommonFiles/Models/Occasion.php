<?php

namespace OlaHub\Models;

class Occasion extends OlaHubCommonModels {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    
    protected $table = 'occasion_types';
    
    public function countryRelation() {
        return $this->hasMany('OlaHub\Models\ManyToMany\occasionCountries','occasion_type_id');
    }
}
