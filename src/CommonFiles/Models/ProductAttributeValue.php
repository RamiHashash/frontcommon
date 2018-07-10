<?php

namespace OlaHub\Models;

class ProductAttributeValue extends OlaHubCommonModels {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }
    protected $table = 'catalog_attribute_values';

    public function productAttribute(){
        return $this->belongsTo('OlaHub\Models\ProductAttribute', 'product_attribute_id');
    }


}
