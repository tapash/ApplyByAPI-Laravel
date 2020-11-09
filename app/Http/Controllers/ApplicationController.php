<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Job $job)
    {
        return Application::latest()->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apply(StoreApplicationRequest $request)
    {
        //get job by token
        $job = Job::whereToken($request->token)->first();

        $application = $job->applyJob(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Application is submitted.',
            'applicaton_id' => $application->id
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        return $application;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        $application->delete();

        return response()->json([
            'success' => true,
            'message' => 'The applcation is deleted.'
        ], 204);
    }
}
