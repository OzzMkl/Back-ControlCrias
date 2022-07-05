<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/api/registra-empleado',
        '/api/login',
        '/api/update',
        '/api/registra-cria',
        '/api/registra-sensor',
        '/api/actualiza-sensor/{id_sensor}'
    ];
}
/*************** */
