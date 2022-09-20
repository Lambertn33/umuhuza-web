<?php 
 namespace App\Http\Services\Common;
 use App\Models\Client;
 use App\Models\Notary;

 class FileOwner {
    
    public function getFileOwner($file)
    {
        return $file->file_type == \App\Models\File::NOTARY_UPLOAD ?
        Notary::where('id', $file->owner)->first()
        : Client::where('id', $file->owner)->first();
    }

    public function getFileNotary($file)
    {
        // if ($file->file_type ==  \App\Models\File::NOTARY_UPLOAD) {
        //     $fileOwner = (new FileOwner)->getFileOwner($file);
        // } else {
        //     $fileOwner = $file->sending->receiver;
        //     return $fileOwner;
        // }
        return $file->file_type == \App\Models\File::NOTARY_UPLOAD ?
            $this->getFileOwner($file) 
            : $file->sending->receiver;
    }
}

?>