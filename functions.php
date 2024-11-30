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

?>
