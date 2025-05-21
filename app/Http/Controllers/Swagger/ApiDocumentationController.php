<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;


/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Agroba Enterprise API Documentation",
 *     description="API documentation for Enterprise Management System",
 *     @OA\Contact(
 *         email="suyaroff@gmail.com"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     ),
 *     termsOfService="https://agroba.local/terms"
 * )
 *
 *
 *
 * @OA\Server(
 *     description="Development API Server",
 *     url="https://agroba.local"
 * )
 *
 * @OA\Tag(
 *     name="auth",
 *     description="Authentication endpoints"
 * )
 *
 * @OA\Tag(
 *     name="users",
 *     description="User management endpoints"
 * )
 *
 * @OA\SecurityScheme(
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="bearerAuth"
 * )
 *
 * @OA\PathItem(
 *     path="/api/"
 * )
 *
 */


class ApiDocumentationController extends Controller
{
    //
}
