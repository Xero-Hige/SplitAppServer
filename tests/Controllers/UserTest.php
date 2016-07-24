<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetTokenNoData()
    {
        $user = factory(\App\Models\User::class)->create();

        $this->json("GET", "token");
        $this->assertEquals(422, $this->response->getStatusCode());
    }

    public function testGetTokenAreNotEqual() {
        $user = factory(\App\Models\User::class)->create();
        $user->save();

        $this->json("GET", "token", [
            "facebook_id" => $user->facebook_id,
            "facebook_token" => "a"
        ]);
        $this->assertEquals(200, $this->response->getStatusCode());
        $resp = json_decode($this->response->content());
        $token1 = $resp->data->token;
        $this->assertEquals(20, strlen($resp->data->token));
        
        $user2 = \App\Models\User::whereId($user->id)->first();
        $this->assertEquals($user2->token, $resp->data->token);

        $this->json("GET", "token", [
            "facebook_id" => $user->facebook_id,
            "facebook_token" => $user->facebook_token
        ]);
        $this->assertEquals(200, $this->response->getStatusCode());
        $resp = json_decode($this->response->content());
        $this->assertNotEquals($token1, $resp->data->token);
        $this->assertEquals(20, strlen($resp->data->token));
    }

    public function testGetTokenWrongPassword() {
        //TODO: Implement
    }
}
