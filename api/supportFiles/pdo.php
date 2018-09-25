<?php

    $host = 'localhost';
    $db   = 'project_sdc';
    $user = 'root';
	$pass = '';
	
	// $host = 'localhost';
    // $db   = 'tradewat_maindb';
    // $user = 'tradewat_amal';
	// $pass = '@Amal7532';
	

    $charset = 'utf8mb4';

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
		//throw new \PDOException($e->getMessage(), (int)$e->getCode());
		
		echo '{"responseStatus":"false","responseCode":"002","responseMessage":"DB connection failure."}';
		exit();

    }

?>