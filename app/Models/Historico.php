<?php

namespace cadvisitante\Models;

use Illuminate\Database\Eloquent\Model;

use \Config as Config;

class Historico extends Model
{
    protected $table  = 'historico';

    private static function getPrivateKey() {
        if(file_exists(Config::get('keys.path.private'))) {
            $key_content = file_get_contents(Config::get('keys.path.private'));
            $key = openssl_get_privatekey($key_content, Config::get('keys.password'));

            return $key;
        } else {
            return 'A chave privada não existe';
        }
    }

    private static function getPublicKey() {
        if(file_exists(Config::get('keys.path.private'))) {
            $key_content = file_get_contents(Config::get('keys.path.public'));
            $key = openssl_get_publickey($key_content);

            return $key;
        } else {
            return 'A chave pública não existe';
        }
    }

    public static function encryptData($data) {
        $key = self::getPrivateKey();

        if(openssl_private_encrypt($data, $criptografado, $key)) {
            if( ! is_null($criptografado)) {
                return base64_encode($criptografado);
            }
        }

        return false;
    }

    public static function decryptData($data) {
        $key = self::getPublicKey();
        $data = base64_decode($data);

        if(openssl_public_decrypt($data, $descriptografado, $key)) {
            if( ! is_null($descriptografado)) {
                return $descriptografado;
            }
        }

        return false;
    }

    public function store(HistoricoRequest $request) {

    }
    public function getDtSaidaAttribute($value) {
        $value = date('U', strtotime($value));
        return $value * 1000;
    }
    
    public function getCreatedAtAttribute($value) {
        $value = date('U', strtotime($value));
        return $value * 1000;
    }
}
