<?php 

class Encryption
  {

      public function encrypt($data)
        {
            $output = false;
            $encrypt_method = "AES-256-CBC";
            $secret_key = '@Secrety key PMS';
            $secret_iv = '@Secrety key PMS iv';
            $iv = substr(hash('sha256', $secret_iv), 0, 16);
            $key = hash('sha256', $secret_key);
            $output = openssl_encrypt($data, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
            return $output;
        }

    public function decrypt($data)
    {

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = '@Secrety key PMS';
        $secret_iv = '@Secrety key PMS iv';
        $key = hash('sha256', $secret_key);

        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($data), $encrypt_method, $key, 0, $iv);


        return $output;

    }

}

$Hash = new Encryption();
?>
