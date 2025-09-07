<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="My API",
 *     version="1.0.0",
 *     description="Документация API",
 * )
 *
 * @OA\SecurityScheme(
 *      securityScheme="bearer_token",
 *      type="apiKey",
 *      in="header",
 *      name="Authorization",
 *      description="Enter token in format (Bearer <token>)"
 *  )
 */
class SwaggerController
{
}
