<?php 

//KEYS
$pk = "-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEAq+ZalkKxGNVrahbWdjDEx3ZD9qGny2hfqa+m7vbf2yayk4qR
hWXthh4MKouIdK83w+r/e76dN43ZYncEtzVg6lztGq5t17zAha/EGhE4AgbfYXR+
bRwio0N/grjBHiqKDO+nRJtGudZH5bXzsq8l75dgWYAp833wyVBE1mlpVVX2yCav
PEauZO1a3v1HWxS1Q23ykHdOq4HgxAWVCmEP2hov3tpwsivxQXBP5MyyVbOWgbOH
UvJBbX7EG+tyoFxc7492BFhnQ/MEvJAVyqey6lLNjIuCVMC6r3kVyuVF5AiY5r0f
qiNNsbAx7bv6MJ1D8BD/QTmwss6BdZjSacc/kQIDAQABAoIBAFdphfsO4tuL+1kx
T9E+L3J2c00BG0BWTP8OsUanB2J7pSdduW4qTMR8lxczaSpcx3C7GTulzHCpkzd8
6kr3u9axdmiw9m5UL1pL7N6MjvyI3iLCiF+XhQ2cj0S8Cof6fcTiQR6kDy0FB/6J
rejZI+NYCMi6YZrOGhlk1fxqEgQwISZXA/5UckiiYfxoDOcq7sWb3fpsKrYWXi3t
fc5KaGkx+a5qluz2/7WW19e4i65rR9vI/pwFWrpnG4WZolQv8qIzi4iXcyeW3DuO
jktebrma5dalGp8uv8MdQ0T9GPSHvbpD/IMmvKuVX3vfP4aEP3wLTxG3CMjrUI3L
FN4ZeyECgYEA8SzIAV9a52b4BZvJajGJHarwdHGd1iwErN+8NH2iIPReZv0v7yR/
VXRpDi4zX/uaXgA6+HsA4VKQKmgTyzc75x0pgc1e2F1MUjO4MPir5gTbYMuqOqdY
gYJZtOfP2NakIBCFlfewaEosh5/XThkcDRvNiWYxhovt0g5oQyeUiVUCgYEAtndv
AgNjNR+w8iW0YkbQVBHHeHL+XWUh8TJxUvCDlD27ZNUJBtGcmENGqmz9bx7B/D4M
w/ZY50oZT6kzuiuzrmOBBroAZZiixAe9IchgOuXaff6iMC8/dQCXdKhkjD4qdTnx
Xgp8m21eEBerliebeF35ieGu9gY24LYFoRYeLU0CgYB8jmsxQkUZk7VueBna7YBq
QRl0miUxMoSrn9V8qpHsQSjsOcDi2k+lG70SJMxFuxTrjWTnZed7d3+bVys53enj
H82LCzz7s5uyLKHpMNTetA10/VqKdlkgcejQpJRU4e3b3YyQel6yTfSXivbQj+lL
39sUJiJX4bbOsMAqRqvRDQKBgQCigE9unZG2+BhgL1AsziAvHv5kuRTsHGtUIbZn
RSgJ18iSjl/RoNAzkobWtOYoFl5wxNodk8GtioJsPaaBwPXu81MvqGs+D+e1aab4
9TkuexJRb3sGKq37B6HbFTUm6R5q9EWPmQtMaOSCtHHt8iw10IuyTjnBhdtN2Q2+
XrJVaQKBgEYPzy9Y1nHxx/JuUMd61hsa6aLkrOOoUqsugKYp7mjR+olV/pqJ4+r5
LV1YSkc0O/VGJ0u5Du6rkAI5ffeC4yKHMTptQeX9s5ys/7h7J8U3qyCW31f8mh+7
GM73DxdImFwdXKVc6ANMydjriJmvxuNyQZ6eviMuuTAwS6UGbILI
-----END RSA PRIVATE KEY-----";
$kh = openssl_pkey_get_private($pk);
$details = openssl_pkey_get_details($kh);

function to_hex($data){

	    return strtoupper(bin2hex($data));
	}

function dec_user_to_serv($value, $kh){

	    $data = pack('H*', $value);

	    if (openssl_private_decrypt($data, $decripted, $kh)) {
	        
	        return $decripted;
	    } 
	}

$key_pub = 'AAAAB3NzaC1yc2EAAAADAQABAAACAQCOYgL7J9SP2ZI6fNL35j8laNYGwJS7DJvehdsaSBsyMNeZi5oB+ts6d0prDkhxj4/u2GZMEQdi5F93eFWKH5BUyVL6XJJ3e/QeF1AIus9CLZy/SGJEDuSY0bmC/ZjIX7yB8iC05sQ8OfGiZ4kG5YJCxOO66GNf1yE+HYZpEpXU7mMe1cfK7ymno1DHY/FKEnzcTO9AkmPDPtHADS/B1KDa5jlovrZNhe9XdUMnKy5k5sjHWr9nbU7w9U2wTJ5nI+C5HuGgZVqxu4GIX8lUc4PmcHviplSba6bkydLhCC3aIzneYRTGGrxpyEcy6Jw7/yFhahJi2HHhZNcPKplMbK4xSKUe3GT53ga4iS3SBqebwfpqeymGNBhi0pXwOmiabwq1KHqoDVPJL15odFC5FHlau8GQzip1bHZfEf8LSmN+/rZTnf6t8CkE3DbXYQAYQW0colIQexwvyowq95wqmZ1w2U7Pbvi42tsFpPEIOi9q6CGB7L8++xsyC3NHfJgQoinm23l9LOBzJp1l/jnYprrV89dnMdg2iIciowOvA1oHjJ5pQR5dYJ/JwUmgVNWEhfmbiBhS4QZro1UKWhEjCfD92Z09XM+IQPn1LSEYihPdzP+CPyhNHuKYK2zkbFaOhDuNp8lcI6+dxEKFBH1sNiAIVZlunwNjj+dd2ZvhwZogaw==';



$key = ']d:N5gg,6>NG7@~(Ae)mv@AbtYDFvMn\-yu"QC<HVX`3[FSn#F';
$key_secret = ']d:N5gg,6>NG7@~(Ae)mv@AbtYDFvMn\-yu"QC<HVX`3[FSn#F';
$secret_key = ']d:N5gg,6>NG7@~(Ae)mv@AbtYDFvMn\-yu"QC<HVX`3[FSn#F';

$key_pass = ']d:N5gg,6>NG7@~(Ae)mv@AbtYDFvMn\-yu"QC<HVX`3[FSn#F';
$key_publica = ']d:N5gg,6>NG7@~(Ae)mv@AbtYDFvMn\-yu"QC<HVX`3[FSn#F';
$key_userId = ']d:N5gg,6>NG7@~(Ae)mv@AbtYDFvMn\-yu"QC<HVX`3[FSn#F';

$key_g = ']d:N5gg,6>NG7@~(Ae)mv@AbtYDFvMn\-yu"QC<HVX`3[FSn#F';
$key_n = ']d:N5gg,6>NG7@~(Ae)mv@AbtYDFvMn\-yu"QC<HVX`3[FSn#F';

$key_msgs = ']d:N5gg,6>NG7@~(Ae)mv@AbtYDFvMn\-yu"QC<HVX`3[FSn#F';
$key_pin = ']d:N5gg,6>NG7@~(Ae)mv@AbtYDFvMn\-yu"QC<HVX`3[FSn#F';



//ENCRYPT FUNCTION
function encryptthis($data, $key) {
$encryption_key = base64_decode($key);
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
return base64_encode($encrypted . '::' . $iv);
}

//DECRYPT FUNCTION
function decryptthis($data, $key) {
$encryption_key = base64_decode($key);
list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}

function CryptoJSAesEncrypt($passphrase, $plain_text){

    $salt = openssl_random_pseudo_bytes(256);
    $iv = openssl_random_pseudo_bytes(16);
    //on PHP7 can use random_bytes() istead openssl_random_pseudo_bytes()
    //or PHP5x see : https://github.com/paragonie/random_compat

    $iterations = 999;  
    $key = hash_pbkdf2("sha512", $passphrase, $salt, $iterations, 64);

    $encrypted_data = openssl_encrypt($plain_text, 'aes-256-cbc', hex2bin($key), OPENSSL_RAW_DATA, $iv);

    $data = array("ciphertext" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "salt" => bin2hex($salt));
    return json_encode($data);
}
function pinkey($number)
{   
    $number = $number;
    $pinkey = 'Weovr#%vr'.$number.'eimEb$tKEAWB'.$number.'sdf^#df'.$number.'^%cs)uO';
    return $pinkey;

}

?>