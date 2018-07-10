<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\ProductAttributeValue;
use League\Fractal;

class AttributeValuesForPrequestFormsResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(ProductAttributeValue $data) {
        $this->data = $data;
        $this->setDefaultData();
        return $this->return;
    }

    private function setDefaultData() {
        $parent = $this->data->productAttribute;
        $this->return = [
            "value" => isset($this->data->id) ? (string) $this->data->id : 0,
            "text" => \OlaHub\Helpers\OlaHubCommonHelper::returnCurrentLangField($this->data, 'attribute_value'),
            "parent" => \OlaHub\Helpers\OlaHubCommonHelper::returnCurrentLangField($parent, 'name'),
        ];
    }

}
