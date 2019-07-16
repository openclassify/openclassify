<?php


namespace Visiosoft\ProfileModule\Http\Middleware;

class Cors
{

    public function handle()
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Laravel CORS
            |--------------------------------------------------------------------------
            |
            | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
            | to accept any value.
            |
            */

            'supportsCredentials' => false,
            'allowedOrigins' => ['*'],// ex: ['abc.com', 'api.abc.com']
            'allowedHeaders' => ['*'],
            'allowedMethods' => ['*'],// ex: ['GET', 'POST', 'PUT', 'DELETE']
            'exposedHeaders' => [],
            'maxAge' => 0,

        ];
    }
}