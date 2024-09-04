<?php

    session_start();
    require_once('db.class.php');

    $id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 0;
    $pagseguro = $_SESSION['link_pagseguro'];

    $sql = " SELECT * FROM carrinho_de_compras WHERE id = '$id_usuario' ";

    $objDb = new database();
	$link = $objDb -> conecta_mysql();

    $resultado_carrinho = mysqli_query($link, $sql);

    if($resultado_carrinho)
		{
		while($produto = mysqli_fetch_array($resultado_carrinho))
			{
			$produto_id   = $produto['id_produto'];
			$produto_qntd = $produto['qntd_produto'];

			$sql = " SELECT * FROM produtos WHERE id_produto = '$produto_id' ";
			$resultado_produto = mysqli_query($link, $sql);
			if($resultado_produto)
				{
				while($dados_produto = mysqli_fetch_array($resultado_produto))
					{
					$qntd_antiga = $dados_produto['qntd_estoque'];
                    $qntd_nova = $qntd_antiga - $produto_qntd;
                    $sql = " UPDATE produtos SET qntd_estoque = '$qntd_nova' WHERE id_produto = '$produto_id' ";
                    mysqli_query($link, $sql);
					}
				}else{
					 echo "Erro na consulta do banco de dados";
				     }
			}
        
		}
    header("Location: $pagseguro");

?>