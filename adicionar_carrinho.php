<?php 

	session_start();

	require_once('db.class.php');

	$usuario      = $_SESSION['id_usuario'];
	$id_produto   = $_SESSION['id_produto'];
	$qntd_produto = $_POST['qntd'];
	$cor          = isset($_POST['cor']) ? $_POST['cor'] : 0;
	$tamanho      = isset($_POST['tamanho']) ? $_POST['tamanho'] : 0;

	if($qntd_produto <= 0 || null)
		{
		$qntd_produto = 1;
		}

	if(!isset($usuario))
		{
		header('Location: consulta_produto.php?produto='.$id_produto);
		}

	$sql = " SELECT * FROM produtos WHERE id_produto = '$id_produto' ";

	$objDb = new database();//Instância a classe
	$link = $objDb -> conecta_mysql();//Executa função de conexão com o MySQL

	$consulta = mysqli_query($link, $sql);
	while($resultado_consulta = mysqli_fetch_array($consulta))
		{
		$estoque = $resultado_consulta['qntd_estoque'];
		if($qntd_produto <= $estoque)
			{
			$sql = " INSERT INTO carrinho_de_compras(id, id_produto, qntd_produto, cor, tamanho) values('$usuario', '$id_produto', '$qntd_produto', '$cor', '$tamanho') ";
			$resultado = mysqli_query($link, $sql);
			}
		}
	
	header('Location: consulta_produto.php?produto='.$id_produto);

?>