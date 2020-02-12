<?php
/*
function sqli_mres($input){
    if(get_magic_quotes_gpc()){
        $input = stripslashes($input);
    }
    if( !is_numeric($input)){
        $input = "'".mysqli_real_escape_string($input)."'";
    }
    return $input;
}*/

function sqli_preg($input){ //특수문자가 있으면 false 특수문자가 없으면 true
    if(preg_match("/[^\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}a-zA-Z\s]+/u", $input,  $match)){
        return false;
    }else{
        return true;
    }
}
function sqli_num($input){
    if(preg_match('/[0-9]/', $input, $match)){
        return false;
    }else{
        return true;
    }
}
?>