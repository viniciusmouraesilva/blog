<?php

try {
	$pdo = new PDO(DSN,USUARIO,SENHA,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}catch(PDOException $ex) {
	exit('Não foi possível conectar com o banco.');
}