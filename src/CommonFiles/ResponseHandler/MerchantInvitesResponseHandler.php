<?php

namespace OlaHub\ResponseHandlers;

use OlaHub\Models\MerchantInvite;
use League\Fractal;

class MerchantInvitesResponseHandler extends Fractal\TransformerAbstract {

    private $return;
    private $data;
    private $merchant;

    public function transform(MerchantInvite $data) {
        $this->data = $data;
        $this->return['merInvID'] = $this->data->id;
        $status = $this->data->invitationStatus;
        $this->return['merInvStatus'] = isset($status->id) ? $status->id : 'N/A';
        $this->return['merInvStatusName'] = isset($status->name) ? $status->name : 'N/A';
        $this->merchant = $this->data->merchantAllData;
        $this->setCountryData();
        $this->setFormOneData();
        $this->setFormTwoData();
        $this->setFormThreeData();
        $this->setFormFourData();
        $this->setFormFiveData();
        $this->setDates();
        $this->return['error'] = [];
        return $this->return;
    }

    private function setCountryData() {
        $country = $this->data->country;
        if (isset($country->id)) {
            $this->return["merInvCountry"] = isset($country->id) ? $country->id : 0;
            $this->return["merInvCountryName"] = \OlaHub\Helpers\MerchantUsersHelper::returnCurrentLangField($country, 'name');
            $currency = $country->currencyData;
            $this->return["merInvCurrency"] = isset($currency->id) ? $currency->id : 0;
            $this->return["merInvCurrencyName"] = \OlaHub\Helpers\MerchantUsersHelper::returnCurrentLangField($currency, 'name')." ($currency->code)";
        }
    }

    private function setFormOneData() {
        $merGeneralInfo = new \OlaHub\Models\MerGeneralInfo;
        $data = $this->merchant ? $merGeneralInfo->checkDataSet($this->merchant) : new \stdClass;
        $prerequest = $merGeneralInfo->getFormPreRequest($this->data->country_id);
        $this->return["FormOne"] = new \stdClass;
        $this->return["FormOne"]->data = $data;
        $this->return["FormOne"]->prerequest = $prerequest;
    }

    private function setFormTwoData() {
        $merBillingAddress = new \OlaHub\Models\MerBillingAddress;
        $data = $this->merchant ? $merBillingAddress->checkDataSet($this->merchant) : new \stdClass;
        $prerequest = $merBillingAddress->getFormPreRequest($this->data->country_id);
        $this->return["FormTwo"] = new \stdClass;
        $this->return["FormTwo"]->data = $data;
        $this->return["FormTwo"]->prerequest = $prerequest;
    }

    private function setFormThreeData() {
        $merMainContactInfo = new \OlaHub\Models\MerMainContactInfo;
        $data = $this->merchant ? $merMainContactInfo->checkDataSet($this->merchant) : new \stdClass;
        $prerequest = $merMainContactInfo->getFormPreRequest($this->data->country_id);
        $this->return["FormThree"] = new \stdClass;
        $this->return["FormThree"]->data = $data;
        $this->return["FormThree"]->prerequest = $prerequest;
    }

    private function setFormFourData() {
        $merBankInfo = new \OlaHub\Models\MerBankInfo;
        $data = [];
        if ($this->merchant) {
            foreach ($this->merchant->bankInfoRelation as $bankInfo) {
                $data[] = $merBankInfo->checkDataSet($bankInfo);
            }
        }

        $prerequest = $merBankInfo->getFormPreRequest($this->data->country_id);
        $this->return["FormFour"] = new \stdClass;
        $this->return["FormFour"]->data = $data;
        $this->return["FormFour"]->prerequest = $prerequest;
    }

    private function setFormFiveData() {
        $merStore = new \OlaHub\Models\MerStore;
        $data = [];
        if ($this->merchant) {
            foreach ($this->merchant->storeRelation as $store) {
                $data[] = $merStore->checkDataSet($store);
            }
        }

        $prerequest = $merStore->getFormPreRequest($this->data->country_id);
        $this->return["FormFive"] = new \stdClass;
        $this->return["FormFive"]->data = $data;
        $this->return["FormFive"]->prerequest = $prerequest;
    }

    private function setDates() {
        $this->return["created"] = isset($this->data->created_at) ? \OlaHub\Helpers\MerchantUsersHelper::convertStringToDate($this->data->created_at) : "N/A";
        $this->return["creator"] = \OlaHub\Helpers\MerchantUsersHelper::defineRowCreator($this->data);
        $this->return["updated"] = isset($this->data->updated_at) ? \OlaHub\Helpers\MerchantUsersHelper::convertStringToDate($this->data->updated_at) : "N/A";
        $this->return["updater"] = \OlaHub\Helpers\MerchantUsersHelper::defineRowUpdater($this->data);
    }

}
