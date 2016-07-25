<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
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
