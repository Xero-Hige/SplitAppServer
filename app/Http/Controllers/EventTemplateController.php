<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventTemplate;
use Illuminate\Http\Request;

use App\Http\Requests;

class EventTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventTemplates = EventTemplate::with("tasks")->get();

        return response()->api_ok($eventTemplates);
    }

    /**
     * @apiVersion 0.0.1
     *
     * @api {post} /eventTemplates Post event template
     * @apiDescription Creates a new template.
     * @apiName PostTemplate
     * @apiGroup EventTemplate
     *
     * @apiHeader {String} X-Auth-Facebook-ID Facebook ID for the user
     * @apiHeader {String} X-Auth-Token Token retrieved using /token
     *
     * @apiParam {Int} event_id Event which will serve as a base for the template
     *
     * @apiSuccess {Int} id New event template id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = Event::find($request->input("event_id"));
        if (!$event) return response()->api_not_found(["event"]);

        $user = auth()->user();

        $eventTemplate = new EventTemplate();
        $eventTemplate->fromEvent($event);

        return response()->api_ok(["id" => $eventTemplate->id]);
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
