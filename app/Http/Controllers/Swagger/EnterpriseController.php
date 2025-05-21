<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *     path="/api/enterprises",
 *     @OA\Header(
 *         header="Accept",
 *         description="application/json",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     summary="Get list of enterprises",
 *     tags={"Enterprises"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         description="Page number",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *             default=1
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="name", type="string", example="JLB Company"),
 *                     @OA\Property(property="director_name", type="string", example="Suyarov Jamal"),
 *                     @OA\Property(property="address", type="string", example="Tashkent, Main street, 32"),
 *                     @OA\Property(property="email", type="string", example="suyaroff@gmail.com"),
 *                     @OA\Property(property="website", type="string", example="jlbcompany.com"),
 *                     @OA\Property(property="phone", type="string", example="+998994888515"),
 *                     @OA\Property(property="created_at", type="string", example="2025-05-19T23:28:08.000000Z"),
 *                     @OA\Property(property="updated_at", type="string", example="2025-05-19T23:28:08.000000Z"),
 *                 )
 *             ),
 *             @OA\Property(
 *                 property="links",
 *                 type="object",
 *                 @OA\Property(property="first", type="string", example="http://agroba.local/api/enterprises?page=1"),
 *                 @OA\Property(property="last", type="string", example="http://agroba.local/api/enterprises?page=5"),
 *                 @OA\Property(property="prev", type="string", nullable=true),
 *                 @OA\Property(property="next", type="string", example="http://agroba.local/api/enterprises?page=2")
 *             ),
 *             @OA\Property(
 *                 property="meta",
 *                 type="object",
 *                 @OA\Property(property="current_page", type="integer", example=1),
 *                 @OA\Property(property="from", type="integer", example=1),
 *                 @OA\Property(property="last_page", type="integer", example=5),
 *                 @OA\Property(property="links", type="array", @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="url", type="string", nullable=true),
 *                     @OA\Property(property="label", type="string", example="&laquo; Previous"),
 *                     @OA\Property(property="active", type="boolean", example=false)
 *                 )),
 *                 @OA\Property(property="path", type="string", example="http://agroba.local/api/enterprises"),
 *                 @OA\Property(property="per_page", type="integer", example=15),
 *                 @OA\Property(property="to", type="integer", example=15),
 *                 @OA\Property(property="total", type="integer", example=75)
 *             )
 *         )
 *     ),
 *     @OA\Response(response=401, description="Unauthenticated")
 * )
 *
 *
 *
 * @OA\Post(
 *     path="/api/enterprises",
 *     @OA\Header(
 *         header="Accept",
 *         description="application/json",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     summary="Create a new enterprise",
 *     tags={"Enterprises"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="JLB Company"),
 *             @OA\Property(property="director_name", type="string", example="Suyarov Jamal"),
 *             @OA\Property(property="address", type="string", example="Tashkent, Main street, 32"),
 *             @OA\Property(property="email", type="string", example="suyaroff@gmail.com"),
 *             @OA\Property(property="website", type="string", example="jlbcompany.com"),
 *             @OA\Property(property="phone", type="string", example="+998994888515"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Enterprise created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example="1"),
 *                 @OA\Property(property="name", type="string", example="JLB Company"),
 *                 @OA\Property(property="director_name", type="string", example="Suyarov Jamal"),
 *                 @OA\Property(property="address", type="string", example="Tashkent, Main street, 32"),
 *                 @OA\Property(property="email", type="string", example="suyaroff@gmail.com"),
 *                 @OA\Property(property="website", type="string", example="jlbcompany.com"),
 *                 @OA\Property(property="phone", type="string", example="+998994888515"),
 *                 @OA\Property(property="created_at", type="string", example="2025-05-19T23:28:08.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", example="2025-05-19T23:28:08.000000Z"),
 *             )
 *         )
 *     ),
 *     @OA\Response(response=401, description="Unauthenticated"),
 *     @OA\Response(response=422, description="Validation error")
 * )
 *
 *
 *
 * @OA\Get(
 *     path="/api/enterprises/{id}",
 *     @OA\Header(
 *         header="Accept",
 *         description="application/json",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     summary="Get enterprise by ID",
 *     tags={"Enterprises"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Enterprise ID",
 *         @OA\Schema(type="integer", default=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="JLB Company"),
 *                 @OA\Property(property="director_name", type="string", example="Suyarov Jamal"),
 *                 @OA\Property(property="address", type="string", example="Tashkent, Main street, 32"),
 *                 @OA\Property(property="email", type="string", example="suyaroff@gmail.com"),
 *                 @OA\Property(property="website", type="string", example="jlbcompany.com"),
 *                 @OA\Property(property="phone", type="string", example="+998994888515"),
 *                 @OA\Property(property="created_at", type="string", example="2025-05-19T23:28:08.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", example="2025-05-19T23:28:08.000000Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=404, description="Enterprise not found"),
 *     @OA\Response(response=401, description="Unauthenticated")
 * )
 *
 *
 *
 * @OA\Patch(
 *     path="/api/enterprises/{id}",
 *     @OA\Header(
 *         header="Accept",
 *         description="application/json",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     summary="Update enterprise",
 *     tags={"Enterprises"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Enterprise ID",
 *         @OA\Schema(type="integer", default=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="JLB Company"),
 *             @OA\Property(property="director_name", type="string", example="Suyarov Jamal"),
 *             @OA\Property(property="address", type="string", example="Tashkent, Main street, 32"),
 *             @OA\Property(property="email", type="string", example="suyaroff@gmail.com"),
 *             @OA\Property(property="website", type="string", example="jlbcompany.com"),
 *             @OA\Property(property="phone", type="string", example="+998994888515"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Enterprise updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="JLB Company"),
 *                 @OA\Property(property="director_name", type="string", example="Suyarov Jamal"),
 *                 @OA\Property(property="address", type="string", example="Tashkent, Main street, 32"),
 *                 @OA\Property(property="email", type="string", example="suyaroff@gmail.com"),
 *                 @OA\Property(property="website", type="string", example="jlbcompany.com"),
 *                 @OA\Property(property="phone", type="string", example="+998994888515"),
 *                 @OA\Property(property="created_at", type="string", example="2025-05-19T23:28:08.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", example="2025-05-19T23:28:08.000000Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=404, description="Enterprise not found"),
 *     @OA\Response(response=422, description="Validation error"),
 *     @OA\Response(response=401, description="Unauthenticated")
 * )
 *
 *
 * @OA\Delete(
 *     path="/api/enterprises/{id}",
 *     @OA\Header(
 *         header="Accept",
 *         description="application/json",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     summary="Delete enterprise",
 *     tags={"Enterprises"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Enterprise ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response=200, description="Enterprise deleted successfully"),
 *     @OA\Response(response=404, description="Enterprise not found"),
 *     @OA\Response(response=401, description="Unauthenticated")
 * )
 */
class EnterpriseController extends Controller
{

}
