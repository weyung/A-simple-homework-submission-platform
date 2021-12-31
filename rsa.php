<?php
define("PUBLIC_PATH","./src/rsa_pub");
define("PRIVATE_PATH","./src/rsa");
function rsa_encrypt($data){
	    //公钥加密 
    $public_key = openssl_pkey_get_public(file_get_contents(PUBLIC_PATH)); 
    if(!$public_key){
        die('公钥不可用');
    }
        //第一个参数是待加密的数据只能是string，第二个参数是加密后的数据,第三个参数是openssl_pkey_get_public返回的资源类型,第四个参数是填充方式
    $return_en = openssl_public_encrypt($data, $crypted, $public_key);
    if(!$return_en){
        return('加密失败,请检查RSA秘钥');
    }
    $eb64_cry = base64_encode($crypted);
    return $eb64_cry;
}
function rsa_decrypt($endata){
	    //私钥解密
    $private_key = openssl_pkey_get_private(file_get_contents(PRIVATE_PATH));
    if(!$private_key){
        die('私钥不可用');
    }
    $return_de = openssl_private_decrypt(base64_decode($endata), $decrypted, $private_key);
    if(!$return_de){
        return('解密失败,请检查RSA秘钥');
    }
    return $decrypted;
}
?>