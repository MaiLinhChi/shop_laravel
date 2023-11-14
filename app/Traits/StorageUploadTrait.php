<?php
namespace App\Traits;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait StorageUploadTrait {
    public function StorageImageUploadTrait($request, $name_patch, $directory) {
        if ($request->hasFile($name_patch)) {
            $file = $request->file($name_patch);
            $fileName = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePatch = $request->file($name_patch)->storeAs('public/' . $directory . '/' . auth()->id(), $fileNameHash);
            return [
                'file_name' => $fileName,
                'file_patch' => Storage::url($filePatch)
            ];
        }
        return null;
    }

    public function StorageImageMultipleUploadTrait($file, $directory) {
        $fileName = $file->getClientOriginalName();
        $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $filePatch = $file->storeAs('public/' . $directory . '/' . auth()->id(), $fileNameHash);
        return [
            'file_name' => $fileName,
            'file_patch' => Storage::url($filePatch)
        ];
    }
}