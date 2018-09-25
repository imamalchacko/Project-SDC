<?php
    
    require_once("pdo.php");
    
	//$json=file_get_contents('php://input');
    //$obj=json_decode($json);

	$auth=$_POST['auth'];

    
	//$input = "SmackFactory";
	//$encrypted = encryptIt( $input );
	//$decrypted = decryptIt( $encrypted );
	//echo $encrypted . '<br />'.$decrypted;


	function encryptIt( $q ) {

		$expireTime=time()+(438000*60*60*1000); // expire time 100 years 
		//$expireTime=0;

		//$tomorrow = strtotime('+1 day', time());
  		//$expireTime=strtotime(date("d-m-Y",$tomorrow))-3600;   // expire time tomorrow 2:30AM

		$q=$q."-".time()."-".$expireTime;
	    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';

	    $qEncoded = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	    return( $qEncoded );
	}



	function decryptIt( $q ){
		if($q==""){		
			echo '{"responseStatus":"false","responseCode":"001","responseMessage":"Authentication failed."}';
			exit();
		}
	    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';

	    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
	    $qDecoded= (explode('-',$qDecoded));

	    if(($qDecoded[1])>($qDecoded[2])){
	    	echo ($qDecoded[1]) ."  ".($qDecoded[2]);
	    	echo '{"responseStatus":"false","responseCode":"002","responseMessage":"Authentication token expired."}';
			exit();
        }
        
        if(!is_numeric($qDecoded[1])){
            echo '{"responseStatus":"false","responseCode":"001","responseMessage":"Authentication failed."}';
            exit();
        }
           
        return $qDecoded[0];
	}


    function simple_auth($authToken){
        if($authToken!="basic"){
            echo '{"responseStatus":"false","responseCode":"001","responseMessage":"Authentication failed."}';
            exit();
        }
    }
     

    function admin_auth($authToken){       
        if($authToken!="g*Rg3I0"){
            echo '{"responseStatus":"false","responseCode":"001","responseMessage":"Authentication failed."}';
            exit();
        }
    }

?>