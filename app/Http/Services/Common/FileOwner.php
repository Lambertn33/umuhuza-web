<?php 
 namespace App\Http\Services\Common;
 use App\Models\Client;
 use App\Models\Notary;

 class FileOwner {
    
    public function getFileOwner($file)
    {
        $fileOwner = $file->file_type == \App\Models\File::NOTARY_UPLOAD ?
                Notary::where('id', $file->owner)->first()
                : Client::where('id', $file->owner)->first();

        return $fileOwner;
    }
}

?>