<?php 
 namespace App\Http\Services\Common;
 use App\Models\Notary;
 use App\Models\Client;

 class ValidateInputs {
    
    public function validatePhoneNumber($input, $format, $digits)
    {
        return ((substr($input, 0, 4) != $format) || strlen($input) != $digits) ? false : true;
    }

    public function validateNationalIDExistence($input)
    {
       return (Notary::where('national_id', $input)->exists() || Client::where('national_id', $input)->exists()) ? true : false;
    }

    public function validateNationalIDLength($input)
    {
        return strlen($input) == 16 ? true : false;
    }
}

?>