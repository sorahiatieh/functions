<?php
    function isMobile($input){
        if(strlen($input)!=11)
            return false;

        if(substr($input,0,2)!= '09')
            return false;

        for($i=0; $i<strlen($input); $i++){
            $char=substr($input,$i,1);
            if(ord($char)<ord('0') || ord($char)>ord('9')){
                return false;
            }
            return true;
        }
    }

?>