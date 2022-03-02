function makeid(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@!~$%^&*?';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}

/*! Fun - Read Cookies | */ 
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}


function CryptoJSAesDecrypt(passphrase,encrypted_json_string){

    var obj_json = JSON.parse(encrypted_json_string);
    if (obj_json !== null){
        var encrypted = obj_json.ciphertext;
        var salt = CryptoJS.enc.Hex.parse(obj_json.salt);
        var iv = CryptoJS.enc.Hex.parse(obj_json.iv);   
    
        var key = CryptoJS.PBKDF2(passphrase, salt, { hasher: CryptoJS.algo.SHA512, keySize: 64/8, iterations: 999});
    
    
        var decrypted = CryptoJS.AES.decrypt(encrypted, key, { iv: iv});
    
        return decrypted.toString(CryptoJS.enc.Utf8); 
    }
         
    
}


random_call();

function random_call(){   
        if (!readCookie('secreetJs')) {
            var random_key = makeid(60);
            var random_key_php = rsa.encrypt(random_key); 
            var action = "random_key";
          $.ajax({
                    url:"actions/serverMessinger.php",
                    method: "POST",
                    data:{action:action, random_key_php:random_key_php},
                    success:function(data)
                    {  
                        document.cookie = "secreetJs="+ random_key;
                    } 
              });
        }
} 
    