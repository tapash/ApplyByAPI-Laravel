<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Illuminate\Http\Request;

class CheckJobToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Token::whereToken($request->token)->whereTime('expired_at', '>=', now())->first() === null) {
            return response()->json([
                'success' => false,
                'message' => 'The token is invalid'
            ], 422);
        }

        return $next($request);
    }
}
