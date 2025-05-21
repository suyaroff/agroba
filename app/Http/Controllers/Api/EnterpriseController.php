<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\Enterprise\ShowEnterpriseRequest;
use App\Http\Requests\Enterprise\StoreEnterpriseRequest;
use App\Http\Requests\Enterprise\UpdateEnterpriseRequest;
use App\Http\Resources\EnterpriseResource;
use App\Models\Enterprise;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;


/**
 * Handles HTTP requests related to Enterprise resources.
 * Provides CRUD operations for managing enterprises in the system.
 * All methods require proper authentication and authorization.
 */
class EnterpriseController extends Controller
{
    /**
     * Display a paginated listing of enterprises.
     * Returns 10 enterprises per page with their details.
     * For admin users - returns all enterprises.
     * For company users - returns only their own enterprises.
     * Accessible by authenticated users with appropriate permissions.
     *
     * @return AnonymousResourceCollection JSON response with paginated enterprise data
     * @response status=200 scenario="Success" {"data": [...], "meta": {...}}
     * @response status=401 scenario="Unauthenticated" {"message": "Unauthenticated"}
     */
    public function index()
    {
        $user = auth()->user();
        $query = Enterprise::query();

        if ($user->role != 'admin') {
            $query->where('owner_id', $user->id);
        }

        $enterprises = $query->paginate(10);
        return EnterpriseResource::collection($enterprises);
    }

    /**
     * Store a new enterprise in the database.
     * Validates input data before creation using form request validation.
     * All required fields must be provided in the correct format.
     *
     * @param StoreEnterpriseRequest $request Contains validated enterprise data
     * @return EnterpriseResource JSON response with the created enterprise data
     * @response status=201 scenario="Success" {"data": {...}}
     * @response status=422 scenario="Validation Error" {"message": "The given data was invalid", "errors": {...}}
     */
    public function store(StoreEnterpriseRequest $request): EnterpriseResource
    {
        $data = $request->validated();
        $enterprise = Enterprise::create($data);
        return EnterpriseResource::make($enterprise);
    }

    /**
     * Display the specified enterprise details.
     * Uses route model binding for automatic enterprise resolution.
     *
     * @param ShowEnterpriseRequest $request Contains validation rules
     * @param Enterprise $enterprise The enterprise model instance
     * @return EnterpriseResource JSON response with enterprise details
     * @response status=200 scenario="Success" {"data": {...}}
     * @response status=404 scenario="Not Found" {"message": "Enterprise not found"}
     */
    public function show(ShowEnterpriseRequest $request, Enterprise $enterprise): EnterpriseResource
    {
        return EnterpriseResource::make($enterprise);
    }

    /**
     * Update the specified enterprise in storage.
     * Validates input data and ensures at least one field is provided.
     * Only provided fields will be updated, maintaining existing data for others.
     *
     * @param UpdateEnterpriseRequest $request Contains validated update data
     * @param Enterprise $enterprise The enterprise model to update
     * @return EnterpriseResource|JsonResponse JSON response with updated enterprise data
     * @response status=200 scenario="Success" {"data": {...}}
     * @response status=422 scenario="Validation Error" {"message": "The given data was invalid", "errors": {...}}
     */
    public function update(UpdateEnterpriseRequest $request, Enterprise $enterprise): EnterpriseResource|JsonResponse
    {

        $data = $request->validated();
        $enterprise->update($data);
        return EnterpriseResource::make($enterprise);
    }

    /**
     * Remove the specified enterprise from storage.
     * Checks authorization before deletion using Gate facade.
     * Returns success message after successful deletion.
     *
     * @param Enterprise $enterprise The enterprise model to delete
     * @return JsonResponse Success message or error response
     * @response status=200 scenario="Success" {"message": "Enterprise deleted successfully"}
     * @response status=403 scenario="Unauthorized" {"message": "Unauthorized"}
     * @response status=404 scenario="Not Found" {"message": "Enterprise not found"}
     */
    public function destroy(Enterprise $enterprise): JsonResponse
    {
        if (!Gate::allows('delete', $enterprise)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $enterprise->delete();
        return response()->json(['message' => 'Enterprise deleted successfully']);
    }
}
