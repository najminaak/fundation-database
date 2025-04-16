<?php

namespace App\Http\Controllers\API\Entrepreneur\Mitra;

use App\Http\Controllers\Controller;
use App\Http\Requests\Entrepreneur\Mitra\MitraEnrollmentRequest;
use App\Http\Resources\Entrepreneur\Mitra\MitraResource;
use Illuminate\Http\Request;
use App\Service\Entrepreneur\Mitra\MitraService;
use App\Http\Responses\ApiResponse;
use App\Models\Entrepreneur;
use App\Models\Mitra; 


class MitraController extends Controller
{
    protected $mitraService;

    public function __construct(MitraService $mitraService)
    {
        $this->mitraService = $mitraService;
    }

    public function index()
    {
        try {
            $mitraList = $this->mitraService->getMitraLists();
            return new ApiResponse('success',  __('validation.message.loaded'), MitraResource::collection($mitraList), 200);
        } catch (\Exception $exception) {
            return new ApiResponse('error',  $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function store($user_id, MitraEnrollmentRequest $request)
    {
        try {
            return new ApiResponse('success',  __('validation.message.created'), $this->mitraService->postMitraEnrollment($request, $user_id), 200);
        } catch (\Exception $exception) {
            return new ApiResponse('error',  $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function update(MitraEnrollmentRequest $request)
    {
        try {
            return new ApiResponse('success',  __('validation.message.updated'), $this->mitraService->updateMitra($request), 200);
        } catch (\Exception $exception) {
            return new ApiResponse('error',  $exception->getMessage(), null, $exception->getCode());
        }
    }

    public function show($user_id)
    {
        // Ambil entrepreneur berdasarkan user_id
        $entrepreneur = Entrepreneur::where('user_id', $user_id)->first();
    
        if (!$entrepreneur) {
            return response()->json([
                'message' => 'Entrepreneur not found',
            ], 404);
        }
    
        // Ambil mitra berdasarkan entrepreneur_id
        $mitra = Mitra::where('id', $entrepreneur->id)->first();
    
        if (!$mitra) {
            return response()->json([
                'message' => 'Mitra not found',
            ], 404);
        }
    
        return response()->json([
            'message' => 'Mitra data retrieved successfully',
            'data' => $mitra,
        ]);
    }
    

}
