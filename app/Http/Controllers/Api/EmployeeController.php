<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;


/**
 * Handles HTTP requests related to Employee resources.
 * Provides CRUD operations for managing employees in the system.
 * All methods require proper authentication and authorization.
 */
class EmployeeController extends Controller
{
    /**
     * Display a paginated listing of employees.
     * Returns 10 employees per page with their details.
     * Accessible by authenticated users with appropriate permissions.
     *
     * @return AnonymousResourceCollection JSON response with paginated employee data
     * @response status=200 scenario="Success" {"data": [...], "meta": {...}}
     * @response status=401 scenario="Unauthenticated" {"message": "Unauthenticated"}
     */
    public function index(): AnonymousResourceCollection
    {
        Gate::authorize('viewAny', Employee::class);

        $query = Employee::query();
        if (auth()->user()->role != 'admin') {
            $query->whereHas('enterprise', function ($query) {
                $query->where('owner_id', auth()->id());
            });
        }

        return EmployeeResource::collection($query->paginate(10));
    }

    /**
     * Store a new employee in the database.
     * Validates input data before creation using form request validation.
     * All required fields must be provided in the correct format.
     *
     * @param StoreEmployeeRequest $request Contains validated employee data
     * @return EmployeeResource JSON response with the created employee data
     * @response status=201 scenario="Success" {"data": {...}}
     * @response status=422 scenario="Validation Error" {"message": "The given data was invalid", "errors": {...}}
     */
    public function store(StoreEmployeeRequest $request): EmployeeResource
    {
        $data = $request->validated();
        $employee = Employee::create($data);
        return EmployeeResource::make($employee);
    }

    /**
     * Display the specified employee details.
     * Uses route model binding for automatic employee resolution.
     * Requires authorization check before displaying employee data.
     *
     * @param Employee $employee The employee model instance
     * @return EmployeeResource JSON response with employee details
     * @response status=200 scenario="Success" {"data": {...}}
     * @response status=403 scenario="Unauthorized" {"message": "Unauthorized"}
     * @response status=404 scenario="Not Found" {"message": "Employee not found"}
     */
    public function show(Employee $employee): EmployeeResource
    {
        Gate::authorize('view', $employee);
        return EmployeeResource::make($employee);
    }

    /**
     * Update the specified employee in storage.
     * Validates input data before update using form request validation.
     * Only provided fields will be updated, maintaining existing data for others.
     *
     * @param UpdateEmployeeRequest $request Contains validated update data
     * @param Employee $employee The employee model to update
     * @return EmployeeResource JSON response with updated employee data
     * @response status=200 scenario="Success" {"data": {...}}
     * @response status=422 scenario="Validation Error" {"message": "The given data was invalid", "errors": {...}}
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee): EmployeeResource
    {
        $data = $request->validated();
        $employee->update($data);
        return EmployeeResource::make($employee);
    }


    /**
     * Delete the specified employee from storage.
     * Checks authorization before deletion using Gate facade.
     * Returns success message after successful deletion.
     *
     * @param Employee $employee The employee model to delete
     * @return JsonResponse Success message or error response
     * @response status=200 scenario="Success" {"message": "Employee deleted successfully"}
     * @response status=403 scenario="Unauthorized" {"message": "Unauthorized"}
     * @response status=404 scenario="Not Found" {"message": "Employee not found"}
     */
    public function destroy(Employee $employee) : JsonResponse
    {
        if (!Gate::allows('delete', $employee)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $employee->delete();
        return response()->json(['message' => 'Employee deleted successfully']);
    }
}
