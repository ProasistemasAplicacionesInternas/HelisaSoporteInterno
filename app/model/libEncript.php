<?php

    class keyCript{
        function encript($a){return openssl_encrypt($a,"aes-128-cbc","myLibEncript",0,"1234567812345678");}
        function decript($b){return openssl_decrypt($b,"aes-128-cbc","myLibEncript",0,"1234567812345678");}
    }

?>