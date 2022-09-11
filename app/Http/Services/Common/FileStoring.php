<?php 
 namespace App\Http\Services\Common;

 class FileStoring {
    
    public function storeFile($request, $file, $tel, $disk) {
        $uploadedFile = $request->file($file);
        $filename = time() . '_'.$tel.'.' .$uploadedFile->getClientOriginalExtension();
        $finalFile = $uploadedFile->storeAs(date('YF'),$filename, $disk);
        return $finalFile;        
    }

}

?>