<?php

    require_once('db.class.php');

    include_once("PagSeguroLibrary/PagSeguroLibrary.php");

    $notificationCode = $_POST['notificationCode'];

    try {  
        $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()  
        $response = PagSeguroNotificationService::checkTransaction(  
            $credentials,  
            $notificationCode  
            );  

        $CodigoReferencia = $response->getReference();
        $CodigoTransacao = $response->getCode();
        $StatusPagamento = $response->getStatus()->getTypeFromValue();

        switch($StatusPagamento)
            {
            case "WAITING_PAYMENT":
            $status_pagamento = "Aguardando Pagamento";
            break;

            case "PAID":
            $status_pagamento = "Pago";
            break;

            case "AVAILABLE":
            $status_pagamento = "Disponivel";
            break;

            case "IN_DISPUTE":
            $status_pagamento = "Em disputa";
            break;

            case "CANCELLED":
            $status_pagamento = "Cancelado";
            break;

            case "REFUNDED":
            $status_pagamento = "Estornado";
            break;
            }

        } catch (PagSeguroServiceException $e) 
            {  
            die($e->getMessage());  
            }  

        $objDb = new database();//Instância a classe
        $link = $objDb -> conecta_mysql();//Executa função de conexão com o MySQL

        $sql = " UPDATE transacoes SET status_pagamento = '$status_pagamento', codigo_transacao = '$CodigoTransacao' WHERE codigo_referencia = '$CodigoReferencia' ";

        if($resultado_id = mysqli_query($link, $sql))
			{
			}
?>