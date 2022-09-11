<?php 
 namespace App\Http\Services\Common;
 use Illuminate\Support\Str;
 use Illuminate\Support\Facades\Storage;

 class FileDownload {
    
    public function downloadFile($file) {
        if(!Storage::disk('notary_uploaded_files')->exists($file->file_path)){
            abort(404);
        }else{
            $filename = Str::random(6);
            $path = Storage::disk('notary_uploaded_files')->path($file->file_path);
            $type = mime_content_type($path);

            $header = [
                'Content-Type'        => $type,
                'Content-Disposition' => 'inline; filename="' . $filename . '"'
            ];

            return response()->file($path, $header);
         }  
    }

}

?>