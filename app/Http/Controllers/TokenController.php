<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Token;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateToken(Request $request)
    {
        $request->validate([
            'job_id' => 'required|integer'
        ]);

        if($job = Job::whereId($request->job_id)->first()) {

            $token = $job->generateToken();

            return response()->json([
                'token' => $job->token,
                'expired_at' => $token->expired_at
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'The job is not found'
        ], 404);
    }
}
