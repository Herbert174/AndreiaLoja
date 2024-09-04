<?php 

	require_once('db.class.php');//Requisita o script que contém as configurações para conectar com o banco de dados

	$objDb = new database();//Instância objDb com as propriedades database de db.class
	$link = $objDb -> conecta_mysql();//Cria uma conexão com o banco de dados e armazena em link

    $id = $_GET['id'];

	$lista = [];//Cria um array para armazenar o resultado da leitura do banco de dados
	$sql = " SELECT * FROM transacoes where codigo_referencia = '$id' ";//Armazena em sql o codigo que será enviado para o banco de dados

	if($resultado_lista = mysqli_query($link, $sql))					
		{
		$lista = mysqli_fetch_array($resultado_lista);

        $produtos = $lista['produtos'];

        echo '<div class="col-md-6">';
            echo '<br>';
            echo '<div class="col-md-12">';
                echo '<p>'.$produtos.'</p>';
            echo '</div>';
        echo '</div>';


        }
	
?>