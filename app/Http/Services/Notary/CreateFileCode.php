<?php 

 namespace App\Http\Services\Notary;


 class CreateFileCode {

    public function createFileCode($authenticatedNotary)
    {
        $stringFirstLetter = $authenticatedNotary->user->names[0];
        $stringLastTelephoneDigit = $authenticatedNotary->user->telephone % 10;
        $stringCurrentTime = str_replace(":","",date('h:i'));
        $stringCurrentDate = str_replace('-','',date('d-m-y'));
        return $stringFirstLetter.''.$stringLastTelephoneDigit.''.$stringCurrentTime.''.$stringCurrentDate;
    }
 }

?>