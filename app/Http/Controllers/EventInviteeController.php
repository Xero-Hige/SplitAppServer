<?php

namespace App\Http\Controllers;

use App\Models\EventInvitee;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class EventInviteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @apiVersion 0.0.1
     *
     * @api {post} /events/:event_id/invitees Post event invitee
     * @apiDescription Creates a new invitee.
     * @apiName PostInvitee
     * @apiGroup EventInvitee
     *
     * @apiHeader {String} X-Auth-Facebook-ID Facebook ID for the user
     * @apiHeader {String} X-Auth-Token Token retrieved using /token
     *
     * @apiParam {Int} :event_id
     * @apiParam {String} invitee
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $event_id)
    {

        if (!$request->input("invitee"))
            return response()->api_invalid(["invitee" => ["El campo es obligatorio."]]);

        $user = auth()->user();

        $eventInvitee = new EventInvitee();
        $eventInvitee->event_id = $event_id;

        $invitee = User::find($request->input("invitee"));
        if (!$invitee) return response()->api_not_found(["invitee"]);
        $eventInvitee->user_id = $request->input("invitee");
        $eventInvitee->save();

        return response()->api_ok([]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
