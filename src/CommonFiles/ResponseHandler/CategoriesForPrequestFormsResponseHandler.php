<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\ManyToMany\MerchantCategories;
use League\Fractal;

class CategoriesForPrequestFormsResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(MerchantCategories $data) {
        $this->data = $data;
        $this->setDefaultData();
        return $this->return;
    }

    private function setDefaultData() {
        $category = isset($this->data->categoryCountryData->categoryData) ? $this->data->categoryCountryData->categoryData : new \stdClass;
        if (isset($category->id)) {
            $this->return = [
                'value' => $this->data->category_id,
                'text' => \OlaHub\Helpers\MerGeneralInfosHelper::returnCurrentLangField($category, 'name'),
            ];
        }
    }

}
