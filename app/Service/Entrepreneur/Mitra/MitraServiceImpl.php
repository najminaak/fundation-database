<?php

namespace App\Service\Entrepreneur\Mitra;

use App\Http\Requests\Entrepreneur\Mitra\MitraEnrollmentRequest;
use App\Models\Entrepreneur;
use App\Repository\Mitra\MitraRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class MitraServiceImpl implements MitraService
{
    protected $mitraRepository;

    public function __construct(MitraRepository $mitraRepository)
    {
        $this->mitraRepository = $mitraRepository;
    }

    public function getmitraLists()
    {
        try {
            $mitraList = $this->mitraRepository->findAll();
            return $mitraList;
        } catch (\Exception $exception) {
            throw new Exception(__('validation.message.something_went_wrong'), 500);
        } catch (AuthorizationException $exception) {
            throw new Exception('You are not authorized to access', 403);
        }
    }

    public function postmitraEnrollment(MitraEnrollmentRequest $request, $user_id)
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
            $filename = 'entrepreneur/mitra/' . uniqid() . '.jpg';

            // Simpan ke storage/public
            Storage::disk('public')->put($filename, $imageData);

            // Simpan path-nya
            $validatedData['photo_file'] = 'storage/' . $filename;

            // Simpan ke database
            $mitra = $this->mitraRepository->save($validatedData);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            throw new Exception(__('validation.message.something_went_wrong'), 500);
        } catch (AuthorizationException $exception) {
            throw new Exception('You are not authorized to access', 403);
        }

        try {
            $datamitra = [
                'user_id' => $user_id,
                'mitra_id' => $mitra->id
            ];
            $relation = Entrepreneur::create($datamitra);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            throw new Exception(__('validation.message.something_went_wrong'), 500);
        } catch (AuthorizationException $exception) {
            throw new Exception('You are not authorized to access', 403);
        } catch (ModelNotFoundException $exception) {
            throw new Exception('Model not found', 404);
        }

        $data = [
            'mitra' => $mitra,
            'entrepreneur' => $relation
        ];

        return $data;
    }

    public function updatemitra(MitraEnrollmentRequest $request)
    {
        try {
            $mitraId = auth()->user()->entrepreneur->mitra_id;
            $validatedData = $request->validated();
            $file = $request->photo_file;

            if ($file !== null) {
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filenameOriginal = 'entrepreneur/mitra/' . $filename . '_' . time() . '.' . $extension;
                $path = $file->storeAs('public/' . $filenameOriginal);
                $validatedData['photo_file'] = 'storage/' . $filenameOriginal;
            }

            $mitra = $this->mitraRepository->update($validatedData, $mitraId);
        } catch (\Exception $exception) {
            throw new Exception(__('validation.message.something_went_wrong'), 500);
        } catch (AuthorizationException $exception) {
            throw new Exception('You are not authorized to access', 403);
        }

        return $mitra;
    }
}
