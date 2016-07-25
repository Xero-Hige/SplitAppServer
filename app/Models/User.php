<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Model implements AuthorizableContract,
                                    AuthenticatableContract
{
    use Authorizable, Authenticatable;

    protected $primaryKey = "facebook_id";
    public $incrementing = FALSE;

    public function checkFacebookToken($facebook_token) {
        //TODO: Implement
        return TRUE;
    }

    public function generateToken() {
        $this->token = str_random(20);
        $this->save();
    }
}
