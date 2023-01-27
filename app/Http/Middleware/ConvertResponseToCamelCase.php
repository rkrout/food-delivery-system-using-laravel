<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConvertResponseToCamelCase
{
    /**
     * This will convert the request data to snake case and response data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function getInCamelCase($data)
    {
        $replaced = [];

        foreach ($data as $key => $value) {
            $replaced[Str::camel($key)] = is_array($value) ? $this->getInCamelCase($value) : $value;
        }

        return $replaced;
    }

    public function getInSnakeCase($data)
    {
        $replaced = [];

        foreach ($data as $key => $value) {
            $replaced[Str::snake($key)] = is_array($value) ? $this->getInSnakeCase($value) : $value;
        }

        return $replaced;
    }

    public function handle(Request $request, Closure $next)
    {
        $request->replace($this->getInSnakeCase($request->all()));

        $response = $next($request);

        return $response->setContent(json_encode(
            $this->getInCamelCase(json_decode($response->getContent(), true))
        ));
    }
}
