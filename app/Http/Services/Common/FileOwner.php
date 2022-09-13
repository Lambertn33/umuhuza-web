<?php 
 namespace App\Http\Services\Common;
 use App\Models\Client;
 use App\Models\Notary;

 class FileOwner {
    
    public function getFileOwner($file)
    {
        $fileOwner = '';
        if ($file->file_type == \App\Models\File::NOTARY_UPLOAD) {
            $fileOwner =Notary::where('id', $file->owner)->first();
        } else {
            $fileOwner =Client::where('id', $file->owner)->first();
        }

        return $fileOwner;
    }
}

?>