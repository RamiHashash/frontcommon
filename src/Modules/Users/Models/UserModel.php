<?php

namespace OlaHub\UserPortal\Models;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model {

    protected $table = 'users';
    
    protected $columnsMaping = [
        'userFirstName' => [
            'column' => 'first_name',
            'type' => 'string',
            'relation' => false,
            'validation' => 'max:200'
        ],
    ];
}
