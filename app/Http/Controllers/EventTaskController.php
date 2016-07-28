<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventTask;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class EventTaskController extends Controller
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
     * @api {post} /events/:event_id/tasks Post event task
     * @apiDescription Creates a new task.
     * @apiName PostTask
     * @apiGroup EventTask
     *
     * @apiHeader {String} X-Auth-Facebook-ID Facebook ID for the user
     * @apiHeader {String} X-Auth-Token Token retrieved using /token
     *
     * @apiParam {Int} :event_id
     * @apiParam {String} assignee May be NULL
     * @apiParam {String} name
     * @apiParam {Float} cost
     *
     * @apiSuccess {Int} id New event task id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $event_id)
    {
        $vars = ["name", "cost"];
        foreach ($vars as $var)
            if (!array_keys($var, $request->input))
                return response()->api_invalid([$var => ["El campo es obligatorio."]]);

        $user = auth()->user();
        
        $eventTask = new EventTask();
        $eventTask->name = $request->input("name");
        $eventTask->cost = $request->input("cost");
        $eventTask->event_id = $event_id;
        if ($request->input("assignee")) {
            $assignee = User::find($request->input("assignee"));
            if (!$assignee) return response()->api_not_found(["assignee" => "patient"]);
            $assignee->eventTasks()->save($eventTask);
        }

        return response()->api_ok(["id" => $eventTask->id]);
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
     * @apiVersion 0.0.1
     *
     * @api {put} /events/:event_id/tasks/:task_id Put event task
     * @apiDescription Updates a task.
     * @apiName PutTask
     * @apiGroup EventTask
     *
     * @apiHeader {String} X-Auth-Facebook-ID Facebook ID for the user
     * @apiHeader {String} X-Auth-Token Token retrieved using /token
     *
     * @apiParam {Int} :event_id
     * @apiParam {Int} :task_id
     * @apiParam {String} assignee May be NULL
     * @apiParam {String} name
     * @apiParam {Float} cost
     * @apiParam {Bool} done
     *
     * @apiSuccess {Int} id Event task id
     * @apiSuccess {String} assignee May be NULL
     * @apiSuccess {String} name
     * @apiSuccess {String} cost
     * @apiSuccess {String} done
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event_id, $event_task_id)
    {
        $user = auth()->user();

        $eventTask = EventTask::find($event_task_id);
        if (!$eventTask) return response()->api_not_found(["event_task"]);

        if ($request->input("name"))
            $eventTask->name = $request->input("name");
        if ($request->input("cost"))
            $eventTask->cost = $request->input("cost");
        if ($request->input("done"))
            $eventTask->done = $request->input("done");
        if ($request->input("assignee")) {
            $assignee = User::find($request->input("assignee"));
            if (!$assignee) return response()->api_not_found(["assignee"]);
            $eventTask->assignee = $assignee->facebook_id;
        }

        $eventTask->save();

        return response()->api_ok($eventTask);
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
