<?php 
 namespace App\Http\Services\Common;
 use Illuminate\Support\Facades\File;
 use Illuminate\Support\Facades\Response;
 use Illuminate\Support\Facades\Storage;

 class ImageDownload {
    
    public function dowloadImage($notary, $disk) {
        $path =  Storage::disk($disk)->path($notary->image);
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;      
    }

}

?>