<?php 
 namespace App\Http\Services\Common;
 use Illuminate\Support\Str;
 use Illuminate\Support\Facades\Storage;
 use setasign\Fpdi\Fpdi;
 use App\Models\Client;
 use App\Models\Notary;

 class FileDownload {
    
    public function downloadFile($file, $disk) {
        // File doesn't exist
        if(!Storage::disk($disk)->exists($file->file_path)){
            abort(404);
        } else {
            //File Uploaded By Notary Automatically Gets Stamp
            if($file->file_type == \App\Models\File::NOTARY_UPLOAD) {
                $fileOwner = (new FileOwner)->getFileOwner($file);
                $path = Storage::disk($disk)->path($file->file_path);
                return $this->downloadFileWithStamp($path, $file, $fileOwner);                
            } else {
                //File Uploaded by Client 

                // National ID doesn't need stamp
                if ($disk === 'client_photocopy_ids') {
                    return $this->downloadFileWithoutStamp($file, $disk);
                } else {
                    // Files;
                    $fileStatus = $file->sending;
                    $fileOwner =  $fileStatus->receiver;
                    $path = Storage::disk($disk)->path($file->file_path);

                    //if file is not yet notarized 
                    if ($fileStatus->status == \App\Models\File_Sending::PENDING) {
                        return $this->downloadFileWithoutStamp($file, $disk);
                    } else {
                        // File already notarized
                        return $this->downloadFileWithStamp($path, $file, $fileOwner); 
                    }
                }
            }
        }  
    }

    public function downloadFileWithStamp($path, $file, $notary)
    {
        $date = $file->confirmation->created_at->format('Y-m-d');
        $pdf = new Fpdi();
        $text = 'Notarized by '. $notary->user->names.' with code '. $notary->notary_code .' on '. $date .'';
        $pages_count = $pdf->setSourceFile($path);
        for ($i = 1; $i <= $pages_count; $i ++) {
            $pdf->AddPage();
            $tplIdx = $pdf->importPage($i);
            $pdf->useTemplate($tplIdx, 0, 0);
            $pdf->SetFont('Helvetica', 'B', 12);
            $pdf->SetTextColor(235, 64, 52);;
            $pdf->SetXY(30, 150);
            $pdf->Write(20, $text);
        }
        return $pdf->Output();
    }

    public function downloadFileWithoutStamp($file, $disk)
    {
        $filename = Str::random(6);
        $path = Storage::disk($disk)->path($file->file_path);
        $type = mime_content_type($path);

        $header = [
            'Content-Type'        => $type,
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ];
        return response()->file($path, $header);
    }

}

?>