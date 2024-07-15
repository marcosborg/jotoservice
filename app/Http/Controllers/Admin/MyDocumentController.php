<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Document;
use App\Models\Driver;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MyDocumentController extends Controller
{

    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('my_document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $driver = Driver::where('user_id', auth()->user()->id)->first();

        $document = Document::updateOrCreate([
            'driver_id' => $driver->id,
        ]);

        return view('admin.myDocuments.index')->with([
            'document' => $document
        ]);
    }

    public function update(Request $request)
    {

        $document = Document::find($request->id);

        if (count($document->citizen_card) > 0) {
            foreach ($document->citizen_card as $media) {
                if (!in_array($media->file_name, $request->input('citizen_card', []))) {
                    $media->delete();
                }
            }
        }
        $media = $document->citizen_card->pluck('file_name')->toArray();
        foreach ($request->input('citizen_card', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $document->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('citizen_card');
            }
        }

        if (count($document->tvde_driver_certificate) > 0) {
        foreach ($document->tvde_driver_certificate as $media) {
        if (! in_array($media->file_name, $request->input('tvde_driver_certificate', []))) {
        $media->delete();
        }
        }
        }
        $media = $document->tvde_driver_certificate->pluck('file_name')->toArray();
        foreach ($request->input('tvde_driver_certificate', []) as $file) {
        if (count($media) === 0 || ! in_array($file, $media)) {
        $document->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('tvde_driver_certificate');
        }
        }
        if (count($document->criminal_record) > 0) {
        foreach ($document->criminal_record as $media) {
        if (! in_array($media->file_name, $request->input('criminal_record', []))) {
        $media->delete();
        }
        }
        }
        $media = $document->criminal_record->pluck('file_name')->toArray();
        foreach ($request->input('criminal_record', []) as $file) {
        if (count($media) === 0 || ! in_array($file, $media)) {
        $document->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('criminal_record');
        }
        }
        if ($request->input('profile_picture', false)) {
        if (! $document->profile_picture || $request->input('profile_picture') !== $document->profile_picture->file_name) {
        if ($document->profile_picture) {
        $document->profile_picture->delete();
        }
        $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile_picture'))))->toMediaCollection('profile_picture');
        }
        } elseif ($document->profile_picture) {
        $document->profile_picture->delete();
        }
        if (count($document->driving_license) > 0) {
        foreach ($document->driving_license as $media) {
        if (! in_array($media->file_name, $request->input('driving_license', []))) {
        $media->delete();
        }
        }
        }
        $media = $document->driving_license->pluck('file_name')->toArray();
        foreach ($request->input('driving_license', []) as $file) {
        if (count($media) === 0 || ! in_array($file, $media)) {
        $document->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('driving_license');
        }
        }

        if (count($document->iban) > 0) {
            foreach ($document->iban as $media) {
                if (! in_array($media->file_name, $request->input('iban', []))) {
                    $media->delete();
                }
            }
        }
        $media = $document->iban->pluck('file_name')->toArray();
        foreach ($request->input('iban', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $document->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('iban');
            }
        }

        if (count($document->address) > 0) {
            foreach ($document->address as $media) {
                if (! in_array($media->file_name, $request->input('address', []))) {
                    $media->delete();
                }
            }
        }
        $media = $document->address->pluck('file_name')->toArray();
        foreach ($request->input('address', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $document->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('address');
            }
        }
        
        return redirect()->route('admin.my-documents.index');
    }

}