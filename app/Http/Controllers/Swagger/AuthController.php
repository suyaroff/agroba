<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 *     path="/api/auth/login",
 *     summary="User login",
 *     tags={"Authentication"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email","password"},
 *             @OA\Property(property="email", type="string", format="email", example="admin@mail.com"),
 *             @OA\Property(property="password", type="string", format="password", example="admin")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Login successful",
 *         @OA\JsonContent(
 *             @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2Fncm9iYS5sb2NhbC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTc0NzcxOTQ4OSwiZXhwIjoxNzQ3NzIzMDg5LCJuYmYiOjE3NDc3MTk0ODksImp0aSI6IlV1dlpWRUFibkRCVVhWM1EiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.y8mmOfSD_KIxBI-eAemGMXAhtaJAifL4Ui-TqgRQWBE"),
 *             @OA\Property(property="token_type", type="string", example="bearer"),
 *             @OA\Property(property="expires_in", type="integer", example="3600")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Invalid credentials",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string"),
 *         )
 *     ),
 *     @OA\Response(
 *          response=422,
 *          description="All data need",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string"),
 *              @OA\Property(property="errors", type="object"),
 *          )
 *      )
 * )
 *
 *
 *
 * @OA\Post(
 *     path="/api/auth/me",
 *     summary="User information",
 *     tags={"Authentication"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Response(
 *          response=200,
 *          description="Return user information",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example="1"),
 *              @OA\Property(property="name", type="string", example="Adminoff"),
 *              @OA\Property(property="email", type="string", example="admin@mail.com"),
 *              @OA\Property(property="email_verified_at", type="string", example="2025-05-20T02:39:37.000000Z"),
 *              @OA\Property(property="created_at", type="string", example="2025-05-20T02:39:37.000000Z"),
 *              @OA\Property(property="updated_at", type="string", example="2025-05-20T02:39:37.000000Z"),
 *          )
 *     ),
 *     @OA\Response(
 *          response=401,
 *          description="Error",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Unauthenticated")
 *          )
 *     ),
 * )
 *
 *
 *
 * @OA\Post(
 *     path="/api/auth/refresh",
 *     summary="Refresh authentication token",
 *     tags={"Authentication"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Response(
 *         response=200,
 *         description="Token refreshed successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2Fncm9iYS5sb2NhbC9hcGkvYXV0aC9yZWZyZXNoIiwiaWF0IjoxNzQ3NzE5NDg5LCJleHAiOjE3NDc3MjMwODksIm5iZiI6MTc0NzcxOTQ4OSwianRpIjoiVXV2WlZFQWJuREJVWFYzUSIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.y8mmOfSD_KIxBI-eAemGMXAhtaJAifL4Ui-TqgRQWBE"),
 *             @OA\Property(property="token_type", type="string", example="bearer"),
 *             @OA\Property(property="expires_in", type="integer", example="3600")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Unauthenticated")
 *         )
 *     )
 * )
 *
 * @OA\Post(
 *     path="/api/auth/logout",
 *     summary="User logout",
 *     tags={"Authentication"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Response(
 *         response=200,
 *         description="Successfully logged out",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Successfully logged out")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Unauthenticated")
 *         )
 *     )
 * )
 */
class AuthController extends Controller
{

}
