<?php 
 namespace App\Http\Services\Common;
 use Illuminate\Support\Facades\Http;

 class SendSMS {
    
    public function sendSMS($user, $message) {
        return Http::withHeaders([
            'Authorization' => 'Bearer '.env("SMS_TOKEN").'',
        ])->acceptJson()
        ->post(''.env("SMS_URL").'', [
           'sender' => 'UMURINZI',
            'to' => is_array($user) ? $user['telephone'] : "+".$user->telephone,
            'text' => $message
        ]);
    }
}

?>