<?php

namespace OlaHub\Models\ManyToMany;

class ItemCountriesCategory extends \OlaHub\Models\OlaHubCommonModels {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
        $this->statusColumn = 'catStatus';
    }

    protected $table = 'country_item_categories';

    public function countryData() {
        return $this->belongsTo('OlaHub\Models\Country', 'country_id');
    }

    public function categoryData() {
        return $this->belongsTo('OlaHub\Models\ItemCategory', 'category_id');
    }

    static function preRequestData($countryID) {
        $return = [];
        $data = ItemCountriesCategory::where('country_id', $countryID)->where('is_published', '1')->get();
        foreach ($data as $one) {
            $return[] = [
                'value' => $one->id,
                'commision' => $one->commission_percentage,
                'text' => \OlaHub\Helpers\OlaHubCommonHelper::returnCurrentLangField($one->categoryData, 'name'),
            ];
        }
        return $return;
    }

}
