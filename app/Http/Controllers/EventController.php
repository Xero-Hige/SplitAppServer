<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

use App\Http\Requests;

class EventController extends Controller
{
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @apiVersion 0.0.1
     *
     * @api {get} /events/:event_id Get event
     * @apiDescription Returns the event.
     * @apiName GetEvent
     * @apiGroup Event
     * 
     * @apiHeader {String} X-Auth-UserID Facebook ID for the user
     * @apiHeader {String} X-Auth-Token Token retrieved using /token
     *
     * @apiParam {Int} event_id
     *
     * @apiSuccessExample {json} Success response
     * {
     *    "data": [
     *      {
     *          "name": "asd",
     *          "when": "2016-07-25 19:30:00",
     *          "when_iso": "2016-07-25T19:30:00-03:00",
     *          "lat": -53.04,
     *          "long": -53.04,
     *          "invitees": [
     *              {
     *                  "facebook_id": 231231231
     *              },
     *              {
     *                  "facebook_id": 244
     *              }
     *          ],
     *          "tasks": [
     *              {
     *                  "assignee": 231231231,
     *                  "name": "COMPRAR PAN",
     *                  "cost": 4.50,
     *                  "done": true
     *              },
     *              {
     *                  "assignee": 231231231,
     *                  "name": "COMPRAR QUESO",
     *                  "cost": null,
     *                  "done": false
     *              },
     *          ]
     *      }
     *    ],
     *    "errors": []
     * }
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($event_id)
    {
        $user = auth()->user();

        $event = Event::find($event_id);
        if (!$event) return response()->api_not_found();
        $event->whenIso = $event->when->toIso8601String();
        return response()->api_ok($event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
