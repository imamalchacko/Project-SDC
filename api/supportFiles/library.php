<?php

    function error($status,$code,$msg){
        echo '{"responseStatus":"'.$status.'","responseCode":"'.$code.'","responseMessage":"'.$msg.'"}';
		exit();
    }

     function response($status,$code,$msg){
        echo '{"responseStatus":"'.$status.'","responseCode":"'.$code.'","responseMessage":"'.$msg.'"}';
		exit();
    }
?>