<?php

namespace OlaHub\Models;

class ItemCategory extends OlaHubCommonModels {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    
    protected $table = 'catalog_item_categories';
    
    protected $columnsMaping = [
        'catName' => [
            'column' => 'name',
            'type' => 'multiLang',
            'relation' => false,
            'validation' => 'required|max:4000'
        ],
        'catParent' => [
            'column' => 'parent_id',
            'type' => 'numNull',
            'manyToMany' => false,
            'validation' => '',
            'filterValidation' => 'integer',
        ],
    ];

    public function countryRelation() {
        return $this->hasMany('OlaHub\Models\ManyToMany\ItemCountriesCategory','category_id');
    }

    public function childsData() {
        return $this->hasMany('OlaHub\Models\ItemCategory','parent_id');
    }

    public function itemCategoryData() {
        return $this->belongsTo('OlaHub\Models\ItemCategory','parent_id','id');
    }

}
