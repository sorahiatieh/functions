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

function isPage($page_name){
    global $LINK;
    $q="select  count(1) from tbl_pages where `enable`=1 and `name`='$page_name'";
    $result=mysqli_query($LINK,$q) or(mysqli_error($LINK));
    $row=mysqli_fetch_row($result);

    mysqli_free_result($result);

    if($row[0] !=0)
        return true;

    return false;
}

function getPageDetails($page_name){
    global $LINK;
    $q="select  * from tbl_pages where `enable`=1 and `name`='$page_name'";
    $result=mysqli_query($LINK,$q) or(mysqli_error($LINK));
    $field=mysqli_fetch_assoc($result);

    mysqli_free_result($result);


    return $field;
}

function makeOutput($arr){
    $output = '';
    foreach ($arr as $key => $value) {
        $output .= "'{$key}' = '{$value}'";
    }
    if (strlen($output)>0){
        $output=substr($output,0,strlen($output)-1);
    }

    return $output;
}

function getExtensionName($name){
    $pos=strrpos($name,'.');
    $pasvand=substr($name,$pos+1);

    return strtolower($pasvand);
}

function registerUser($details){
    global $LINK;

    $fields="";
    $values="";

    foreach ($details as $key => $value) {
        $fields .="`$key` ,";
        $values .="'$value' ,";
    }

    if (strlen($fields) !=0) {
        $fields=mb_substr($fields,0,mb_strlen($fields)-1);
        $values=mb_substr($values,mb_strlen($values)-1);
    }

    $q="insert into tbl_registers ($fields) values ($values)";
    //die($q);
    mysqli_query($LINK,$q) or (mysqli_error($LINK));

     return mysqli_insert_id($LINK);
}

function addComment($details){
    global $LINK;

    $fields="";
    $values="";

    foreach ($details as $key => $value) {
        $fields .="`$key` ,";
        $values .="'$value' ,";
    }

    if (strlen($fields) !=0) {
        $fields=mb_substr($fields,0,mb_strlen($fields)-1);
        $values=mb_substr($values,mb_strlen($values)-1);
    }

    $q="insert into tbl_comments ($fields) values ($values)";
    //die($q);
    mysqli_query($LINK,$q) or (mysqli_error($LINK));

    return mysqli_insert_id($LINK);
}

function getIp(){
    return $_SERVER['REMOTE_ADDR'];
}

function getRealIp(){
    return getIp();
}

?>
