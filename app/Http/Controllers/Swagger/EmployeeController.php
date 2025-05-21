<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *     path="/api/employees",
 *     @OA\Header(
 *         header="Accept",
 *         description="application/json",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     summary="Get list of employees",
 *     tags={"Employees"},
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
 *                     @OA\Property(property="passport_number", type="string", example="AA1234567"),
 *                     @OA\Property(property="enterprise_id", type="integer", example=1),
 *                     @OA\Property(property="first_name", type="string", example="John"),
 *                     @OA\Property(property="last_name", type="string", example="Doe"),
 *                     @OA\Property(property="middle_name", type="string", example="Smith"),
 *                     @OA\Property(property="position", type="string", example="Developer"),
 *                     @OA\Property(property="phone", type="string", example="+998994888515"),
 *                     @OA\Property(property="address", type="string", example="Tashenkent, Main street, 32"),
 *                     @OA\Property(property="created_at", type="string", example="2025-05-19T23:28:08.000000Z"),
 *                     @OA\Property(property="updated_at", type="string", example="2025-05-19T23:28:08.000000Z"),
 *                 )
 *             ),
 *             @OA\Property(
 *                 property="links",
 *                 type="object",
 *                 @OA\Property(property="first", type="string", example="http://agroba.local/api/employees?page=1"),
 *                 @OA\Property(property="last", type="string", example="http://agroba.local/api/employees?page=5"),
 *                 @OA\Property(property="prev", type="string", nullable=true),
 *                 @OA\Property(property="next", type="string", example="http://agroba.local/api/employees?page=2")
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
 *                 @OA\Property(property="path", type="string", example="http://agroba.local/api/employees"),
 *                 @OA\Property(property="per_page", type="integer", example=15),
 *                 @OA\Property(property="to", type="integer", example=15),
 *                 @OA\Property(property="total", type="integer", example=75)
 *             )
 *         )
 *     ),
 *     @OA\Response(response=401, description="Unauthenticated")
 * )
 *
 * @OA\Post(
 *     path="/api/employees",
 *     @OA\Header(
 *         header="Accept",
 *         description="application/json",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     summary="Create a new employee",
 *     tags={"Employees"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="passport_number", type="string", example="AA1234567"),
 *             @OA\Property(property="enterprise_id", type="integer", example=1),
 *             @OA\Property(property="first_name", type="string", example="John"),
 *             @OA\Property(property="last_name", type="string", example="Doe"),
 *             @OA\Property(property="middle_name", type="string", example="Smith"),
 *             @OA\Property(property="position", type="string", example="Developer"),
 *             @OA\Property(property="phone", type="string", example="+998994888515"),
 *             @OA\Property(property="address", type="string", example="Tashkent, Main street, 32"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Employee created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="passport_number", type="string", example="AA1234567"),
 *                 @OA\Property(property="enterprise_id", type="integer", example=1),
 *                 @OA\Property(property="first_name", type="string", example="John"),
 *                 @OA\Property(property="last_name", type="string", example="Doe"),
 *                 @OA\Property(property="middle_name", type="string", example="Smith"),
 *                 @OA\Property(property="position", type="string", example="Developer"),
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
 * @OA\Get(
 *     path="/api/employees/{id}",
 *     @OA\Header(
 *         header="Accept",
 *         description="application/json",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     summary="Get employee by ID",
 *     tags={"Employees"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Employee ID",
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
 *                 @OA\Property(property="passport_number", type="string", example="AA1234567"),
 *                 @OA\Property(property="enterprise_id", type="integer", example=1),
 *                 @OA\Property(property="first_name", type="string", example="John"),
 *                 @OA\Property(property="last_name", type="string", example="Doe"),
 *                 @OA\Property(property="middle_name", type="string", example="Smith"),
 *                 @OA\Property(property="position", type="string", example="Developer"),
 *                 @OA\Property(property="phone", type="string", example="+998994888515"),
 *                 @OA\Property(property="address", type="string", example="Tashkent, Main street, 32"),
 *                 @OA\Property(property="created_at", type="string", example="2025-05-19T23:28:08.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", example="2025-05-19T23:28:08.000000Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=404, description="Employee not found"),
 *     @OA\Response(response=401, description="Unauthenticated")
 * )
 *
 * @OA\Patch(
 *     path="/api/employees/{id}",
 *     @OA\Header(
 *         header="Accept",
 *         description="application/json",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     summary="Update employee",
 *     tags={"Employees"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Employee ID",
 *         @OA\Schema(type="integer", default=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="enterprise_id", type="integer", example=1),
 *             @OA\Property(property="first_name", type="string", example="John"),
 *             @OA\Property(property="last_name", type="string", example="Doe"),
 *             @OA\Property(property="middle_name", type="string", example="Smith"),
 *             @OA\Property(property="position", type="string", example="Developer"),
 *             @OA\Property(property="phone", type="string", example="+998994888515"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Employee updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="passport_number", type="string", example="AA1234567"),
 *                 @OA\Property(property="enterprise_id", type="integer", example=1),
 *                 @OA\Property(property="first_name", type="string", example="John"),
 *                 @OA\Property(property="last_name", type="string", example="Doe"),
 *                 @OA\Property(property="middle_name", type="string", example="Smith"),
 *                 @OA\Property(property="position", type="string", example="Developer"),
 *                 @OA\Property(property="phone", type="string", example="+998994888515"),
 *                 @OA\Property(property="address", type="string", example="Tashkent, Main street, 32"),
 *                 @OA\Property(property="created_at", type="string", example="2025-05-19T23:28:08.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", example="2025-05-19T23:28:08.000000Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=404, description="Employee not found"),
 *     @OA\Response(response=422, description="Validation error"),
 *     @OA\Response(response=401, description="Unauthenticated")
 * )
 *
 * @OA\Delete(
 *     path="/api/employees/{id}",
 *     @OA\Header(
 *         header="Accept",
 *         description="application/json",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     summary="Delete employee",
 *     tags={"Employees"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Employee ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response=200, description="Employee deleted successfully"),
 *     @OA\Response(response=404, description="Employee not found"),
 *     @OA\Response(response=401, description="Unauthenticated")
 * )
 */
class EmployeeController extends Controller
{

}
