<?php

namespace OlaHub\Models;

use Illuminate\Http\Request;

class ProductAttribute extends OlaHubCommonModels {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }

    protected $table = 'catalog_item_attributes';

    public function productAttributeValue() {
        return $this->hasMany('OlaHub\Models\ProductAttributeValue', 'product_attribute_id');
    }

}
