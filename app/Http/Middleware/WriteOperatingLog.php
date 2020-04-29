<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\OperationgLog;

class WriteOperatingLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data = [
            'user_id' => \Auth::user()->id,
            'uri'     => $request->getRequestUri(),
            'methods' => $request->method(),
            'data'    => collect($request->all())->toJson()
        ];

        OperationgLog::create($data);

        return $next($request);
    }
}
