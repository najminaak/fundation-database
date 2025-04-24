<?php

namespace App\Http\Controllers\API\Organizer\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organizer\Organization\OrganizationEnrollmentRequest;
use App\Http\Resources\Organizer\Organization\OrganizationResource;
use App\Http\Responses\ApiResponse;
use App\Service\Organizer\Organization\OrganizationService;
use Illuminate\Http\Request;
use App\Models\Organizer;
use App\Models\Organization; 

class OrganizationController extends Controller
{
    protected $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    public function index()
    {
        try {
            $organizationList = $this->organizationService->getOrganizationLists();
            return new ApiResponse('success',  __('validation.message.loaded'), OrganizationResource::collection($organizationList), 200);
        } catch (\Exception $exception) {
            return new ApiResponse('error',  $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function store(OrganizationEnrollmentRequest $request, $user_id)
    {
        try {
            return new ApiResponse('success',  __('validation.message.created'), $this->organizationService->postOrganizationEnrollment($request, $user_id), 200);
        } catch (\Exception $exception) {
            return new ApiResponse('error',  $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function update(OrganizationEnrollmentRequest $request)
    {
        try {
            return new ApiResponse('success',  __('validation.message.updated'), $this->organizationService->updateOrganizationData($request), 200);
        } catch (\Exception $exception) {
            return new ApiResponse('error',  $exception->getMessage(), null, $exception->getCode());
        }
    }
    public function show($user_id)
    {
        // Ambil entrepreneur berdasarkan user_id
        $organizer = Organizer::where('user_id', $user_id)->first();
    
        if (!$organizer) {
            return response()->json([
                'message' => 'Organizer not found',
            ], 404);
        }
    
        // Ambil mitra berdasarkan entrepreneur_id
        $organization = Organization::where('id', $organizer->id)->first();
    
        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found',
            ], 404);
        }
    
        return response()->json([
            'message' => 'Organization data retrieved successfully',
            'data' => $organization,
        ]);
    }

}
