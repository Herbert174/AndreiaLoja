<?php

    require_once('db.class.php');

    include_once("PagSeguroLibrary/PagSeguroLibrary.php");

    $transactionCode = $_GET['id'];

    try {  
        $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()  

        $response = PagSeguroCancelService::createRequest($credentials, $transactionCode);  

        } catch (PagSeguroServiceException $e) 
            {  
            die($e->getMessage());  
            }
?>