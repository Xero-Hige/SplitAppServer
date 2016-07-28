<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventInvitee;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Mockery\Tests\Evenement_EventEmitter;

class EventController extends Controller
{
    /**
     * @apiVersion 0.0.1
     *
     * @api {get} /events/ Get events
     * @apiDescription Returns the event list.
     * @apiName GetEvents
     * @apiGroup Event
     *
     * @apiHeader {String} X-Auth-Facebook-ID Facebook ID for the user
     * @apiHeader {String} X-Auth-Token Token retrieved using /token
     *
     * @apiSuccessExample {json} Success response
     * {
     *    "data": [
     *      {
     *          "id": 1
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**
         * @var User $user
         */
        $user = auth()->user();
        
        $events = $user->events()->with('tasks')->get();

        foreach ($events as $event) {
            $event->whenIso = $event->when->toIso8601String();
            $event->invitees = $event->invitees()->get();
        }

        return response()->api_ok($events);
    }

    /**
     * @apiVersion 0.0.1
     *
     * @api {post} /events Post event
     * @apiDescription Creates a new event. The user who creates the event will be the first invitee.
     * @apiName PostEvent
     * @apiGroup Event
     *
     * @apiHeader {String} X-Auth-Facebook-ID Facebook ID for the user
     * @apiHeader {String} X-Auth-Token Token retrieved using /token
     *
     * @apiParam {String} name
     * @apiParam {String} when
     * @apiParam {String} lat
     * @apiParam {String} long
     * @apiParam {String[]} invitees The creating user is an invitee by default and mustn't be included in this field
     *
     * @apiParamExample {json} Request-Example:
     * {
     *  name: "a",
     *  when: "2016-07-25 08:00:00",
     *  lat: 3
     *  long: 2,
     *  invitees: [
     *      23213131,
     *      32132131,
     *      23213556
     *  ]
     * }
     *
     * @apiSuccess {Int} id New event id
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vars = ["name", "when", "lat", "long", "invitees"];
        foreach ($vars as $var)
            if (!array_key_exists($var, $request->input()))
                return response()->api_invalid([$var => ["El campo es obligatorio."]]);

        $user = auth()->user();

        $event = new Event();
        $event->name = $request->input("name");
        $event->when = new \DateTime($request->input("when"));
        $event->lat = $request->input("lat");
        $event->long = $request->input("long");
        $event->save();

        foreach ($request->input("invitees") as $invitee_id) {
            $eventInvitee = new EventInvitee();
            $eventInvitee->event_id = $event->id;
            $eventInvitee->user_id = $invitee_id;
            $eventInvitee->save();
        }

        $eventInvitee = new EventInvitee();
        $eventInvitee->event_id = $event->id;
        $eventInvitee->user_id = $user->facebook_id;
        $eventInvitee->save();

        return response()->api_ok(["id" => $event->id]);
    }

    /**
     * @apiVersion 0.0.1
     *
     * @api {get} /events/:event_id Get event
     * @apiDescription Returns the event.
     * @apiName GetEvent
     * @apiGroup Event
     * 
     * @apiHeader {String} X-Auth-Facebook-ID Facebook ID for the user
     * @apiHeader {String} X-Auth-Token Token retrieved using /token
     *
     * @apiParam {Int} event_id
     *
     * @apiSuccessExample {json} Success response
     * {
     *    "data": {
     *        "name": "asd",
     *        "when": "2016-07-25 19:30:00",
     *        "when_iso": "2016-07-25T19:30:00-03:00",
     *        "lat": -53.04,
     *        "long": -53.04,
     *        "invitees": [
     *            {
     *                "facebook_id": 231231231
     *            },
     *            {
     *                "facebook_id": 244
     *            }
     *        ],
     *        "tasks": [
     *            {
     *                "assignee": 231231231,
     *                "name": "COMPRAR PAN",
     *                "cost": 4.50,
     *                "done": true
     *            },
     *            {
     *                "assignee": 231231231,
     *                "name": "COMPRAR QUESO",
     *                "cost": null,
     *                "done": false
     *            },
     *        ]
     *    },
     *    "errors": []
     * }
     *
     * @param  int  $event_id
     * @return \Illuminate\Http\Response
     */
    public function show($event_id)
    {
        $user = auth()->user();

        $event = Event::with("tasks")->with("invitees")->find($event_id);
        if (!$event) return response()->api_not_found();
        $event->whenIso = $event->when->toIso8601String();
        return response()->api_ok($event);
    }

    /**
     * @apiVersion 0.0.1
     *
     * @api {put} /events/:event_id Update event
     * @apiDescription Updates an event.
     * @apiName PutEvent
     * @apiGroup Event
     *
     * @apiHeader {String} X-Auth-Facebook-ID Facebook ID for the user
     * @apiHeader {String} X-Auth-Token Token retrieved using /token
     *
     * @apiParam {Int} :event_id
     * @apiParam {String} name
     * @apiParam {String} when
     * @apiParam {String} lat
     * @apiParam {String} long
     *
     * @apiSuccess {Int} id event id
     * @apiSuccess {String} name
     * @apiSuccess {String} when
     * @apiSuccess {String} lat
     * @apiSuccess {String} long
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();

        $event = Event::find($id);
        if (!$event) return response()->api_not_found();

        $vars = ["name", "when", "lat", "long"];
        foreach ($vars as $var)
            if (!$request->input($var))
                return response()->api_invalid([$var => ["El campo es obligatorio."]]);

        $event->name = $request->input("name");
        $event->when = new \DateTime($request->input("when"));
        $event->lat = $request->input("lat");
        $event->long = $request->input("long");
        $event->save();

        return response()->api_ok($event);
    }

    /**
     * @apiVersion 0.0.1
     *
     * @api {delete} /events/:event_id Delete event
     * @apiDescription Deletes an event.
     * @apiName DeleteEvent
     * @apiGroup Event
     *
     * @apiHeader {String} X-Auth-Facebook-ID Facebook ID for the user
     * @apiHeader {String} X-Auth-Token Token retrieved using /token
     *
     * @apiParam {Int} :event_id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::with("tasks")->with("invitees")->find($id);
        if (!$event) return response()->api_not_found();
        $event->delete();
        return response()->api_ok([]);
    }
}
