<?php

namespace OlaHub\Models;

class MerchantInvite extends OlaHubCommonModels {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }

    protected $table = 'merchant_invites';

    public function country() {
        return $this->belongsTo('OlaHub\Models\Country', 'country_id');
    }

    public function merchantAllData() {
        return $this->hasOne('OlaHub\Models\MerGeneralInfo', 'invitation_id');
    }
    
    public function invitationStatus() {
        return $this->belongsTo('OlaHub\Models\MerchantStatuses', 'status');
    }

    public static function getSubscribersData($subscribersData) {
        $return = $subscribersData;
        $subscribers = @unserialize($subscribersData);
        if (is_array($subscribers)) {
            $return = [];
            foreach ($subscribers as $sub) {
                $franch = Franchise::find((int) $sub);
                if ($franch) {
                    $return[] = $franch;
                }
            }
        }

        return $return;
    }
    
    static function checkInvitationStatus($id){
        $invitation = MerchantInvite::find($id);
        if($invitation && strlen($invitation->hash_url) > 0 && !in_array($invitation->status, ['3','4'])){
            return TRUE;
        }
        return false;
    }

}
