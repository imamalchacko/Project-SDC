<?php

   	require_once("supportFiles/authentication.php");
	require_once("supportFiles/library.php");

	simple_auth($auth);

	try{
		$stmt1 = $pdo->prepare("SELECT * FROM users WHERE username in (?)");
        $stmt1->execute([$_POST['username']]);
        

		if($stmt1->rowCount()!=1){
			response("false","010","Incorrect username or password.");
		}
		else{
			while ($row = $stmt1->fetch()) {
                if($row['password']!=$_POST['password']){
                    response("false","010","Incorrect username or password.");
                }
                else{
                        $responseArray = array("responseStatus"=>"true","responseCode"=>"000","responseMessage"=>"Login Success.","authToken"=>encryptIt($_POST['username']));
		                echo json_encode($responseArray);
                }
            }
		}
		
	}
	catch(\PDOException $e){
        //throw new \PDOException($e->getMessage(), (int)$e->getCode());
		response("false","-001","Unexpected Error.");
	}
?>