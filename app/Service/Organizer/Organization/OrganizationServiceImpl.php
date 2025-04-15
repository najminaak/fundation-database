<?php

namespace App\Service\Organizer\Organization;

use App\Http\Requests\Organizer\Organization\OrganizationEnrollmentRequest;
use App\Models\Organizer;
use App\Repository\Organization\OrganizationRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;


class OrganizationServiceImpl implements OrganizationService
{
    protected $organizationRepository;


    public function __construct(OrganizationRepository $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }
    
    public function getOrganizationLists()
    {
        try {
            $organizationList = $this->organizationRepository->findAll();
            return $organizationList;
        }catch (\Exception $exception){
            throw new Exception(__('validation.message.something_went_wrong'), 500);
        }catch (AuthorizationException $exception) {
            throw new Exception('You are not authorized to access', 403);
        }
    }

    public function postOrganizationEnrollment(OrganizationEnrollmentRequest $request, $user_id)
    {
        $validatedData = $request->validated();

        try {
            $base64Image = $request->photo_file;

            // Jika ada prefix seperti data:image/png;base64,...
            if (str_contains($base64Image, 'base64,')) {
                $base64Image = explode('base64,', $base64Image)[1];
            }

            // Decode
            $imageData = base64_decode($base64Image);

            // Nama file unik
            $filename = 'organizer/organization/' . uniqid() . '.jpg';

            // Simpan ke storage/public
            Storage::disk('public')->put($filename, $imageData);

            // Simpan path-nya
            $validatedData['photo_file'] = 'storage/' . $filename;

            // Simpan ke database
            $organization = $this->organizationRepository->save($validatedData);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            throw new Exception(__('validation.message.something_went_wrong'), 500);
        } catch (AuthorizationException $exception) {
            throw new Exception('You are not authorized to access', 403);
        }
    
        try {
            $dataorganization = [
                'user_id' => $user_id,
                'organization_id' => $organization->id
            ];
            $relation = Organizer::create($dataorganization);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            throw new Exception(__('validation.message.something_went_wrong'), 500);
        } catch (AuthorizationException $exception) {
            throw new Exception('You are not authorized to access', 403);
        } catch (ModelNotFoundException $exception) {
            throw new Exception('Model not found', 404);
        }
    
        $data = [
            'organization' => $organization,
            'organizer' => $relation
        ];
    
        return $data;
    }

    public function updateOrganizationData(OrganizationEnrollmentRequest $request)
    {
        
        try {
            $organizationId = auth()->user()->organizer->organization_id;
            $validatedData = $request->validated();
            $file = $request->photo_file;
            if($file !== null){
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filenameOriginal = 'organizer/organization/' . $filename . '_' . time() . '.' . $extension;
                $path = $file->storeAs('public/' . $filenameOriginal);
                $validatedData['photo_file'] = 'storage/'.$filenameOriginal;
            }
            $organizer = $this->organizationRepository->update($validatedData, $organizationId);
        }catch (\Exception $exception){
            throw new Exception(__('validation.message.something_went_wrong'), 500);
        }catch (AuthorizationException $exception) {
            throw new Exception('You are not authorized to access', 403);
        }catch (ModelNotFoundException $exception) {
            throw new Exception('Model not found', 404);
        }

        return $organization;
    }
}