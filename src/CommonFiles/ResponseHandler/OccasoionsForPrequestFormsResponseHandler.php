<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\ManyToMany\occasionCountries;
use League\Fractal;

class OccasoionsForPrequestFormsResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;

    public function transform(occasionCountries $data) {
        $this->data = $data;
        $this->setDefaultData();
        return $this->return;
    }

    private function setDefaultData() {
        $this->return = [
            "value" => isset($this->data->id) ? (string) $this->data->id : 0,
            "text" => \OlaHub\Helpers\OlaHubCommonHelper::returnCurrentLangField($this->data->occasionData, 'name'),
        ];
    }

}
