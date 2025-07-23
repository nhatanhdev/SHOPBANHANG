<?php
namespace App\Traits;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
trait StorageImageTrait{
    public function storageTraitUpload($request, $fieldName, $folderName){
        if($request->hasFile($fieldName)){
            $file = $request->$fieldName;
            $fileName = $file->getClientOriginalName();
            $fileNameHash = str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/'.$folderName.'/'. auth()->id() , $fileNameHash);
            $dataUpload = [
            'file_name' => $fileName,
            'file_path' => Storage::url($filePath),

            ];
            return $dataUpload;
        }

        return null;

    }

    public function storageTraitUploadMutiple($file, $folderName){
        $fileName = $file->getClientOriginalName();
        $fileNameHash = str::random(20) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/'.$folderName.'/'. auth()->id() , $fileNameHash);
        $dataUpload = [
        'file_name' => $fileName,
        'file_path' => Storage::url($filePath),

        ];
        return $dataUpload;

    }
}
