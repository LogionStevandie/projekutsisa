<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkAccess($route, $userId, $roleId)
    {
        $access = DB::table('menu')
            ->select('menu.url')
            ->leftjoin('roleaccess', 'menu.idMenu', '=', 'roleaccess.idMenu')
            ->where('roleaccess.idRole',$roleId)
            ->get();
        $check = false;
        for($i = 0; $i < count($access); $i++ ){
            if($access[$i]->url == $route){
                $check = true;
            }
        }

        return ($check);
    }

    public function enkripData($data, $action)
    {
        $secret_key = 'simple_secret_key_for_us';
        $secret_iv = 'simple_secret_iv_for_us';

        $output = "";
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action) {
            //$output = base64_encode(openssl_encrypt($data, $encrypt_method, $key, 0, $iv));
            $output = Crypt::encryptString(base64_encode(openssl_encrypt($data, $encrypt_method, $key, 0, $iv)));
        } 
        else if (!$action) {
            //$output = Crypt::decryptString($data);
            $output = openssl_decrypt(base64_decode(Crypt::decryptString($data)), $encrypt_method, $key, 0, $iv);
        }

        return $output;

    }

    public function dekripData($data)
    {       
        //Define cipher 
        $cipher = "aes-256-cbc"; 

        $encryption_key = openssl_random_pseudo_bytes(32);
        
        $iv_size = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($iv_size);

        //Decrypt data 
        $decrypted_data = openssl_decrypt($data, $cipher, $encryption_key, 0, $iv); 

        //base64
        $decrypted_data = base64_decode($decrypted_data);

        return ($decrypted_data);
    }
}
