<?php 
 
	require_once('db.class.php');//Requisita o script que contém as configurações para conectar com o banco de dados

	$objDb = new database();//Instância objDb com as propriedades database de db.class
	$link = $objDb -> conecta_mysql();//Cria uma conexão com o banco de dados e armazena em link

	$lista = [];//Cria um array para armazenar o resultado da leitura do banco de dados
	$sql = " SELECT * FROM transacoes ORDER BY id_transacao DESC ";//Armazena em sql o codigo que será enviado para o banco de dados

	if($resultado_lista = mysqli_query($link, $sql))/*Se conecta com o banco de dados e envia o codigo de sql
													recuperando o retorno em resultado_lista*/
		{
		$lista = mysqli_fetch_all($resultado_lista, MYSQLI_ASSOC);
		}//Reorganiza em lista o retorno do banco de dados armazenado em resultado_lista
	
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Crud</title>
		<!-- Bootstrap -->
	    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	    <link rel="stylesheet" href="estilo.css">

        <!-- Jquery -->
        <script src="jquery-3.6.0.js"></script>

	    <style type="text/css">
	    	body {background-image: none;}
	    </style>

        <script type="text/javascript">
            function endereco(id)
                {
                $.ajax({
                        url: 'endereco_transacao?id='+id,
                        success: function(data)
                            {
                            $('#endereco').html(data);
                            $('#modal-endereco').modal();
                            }
                      });
                }
			function produtos(id)
                {
                $.ajax({
                        url: 'produtos_transacao?id='+id,
                        success: function(data)
                            {
                            $('#produtos').html(data);
                            $('#modal-produtos').modal();
                            }
                      });
                }

            function cancelar(id)
                {
                var confirmacao = confirm("Tem certeza que deseja cancelar esta transação?");
                if(confirmacao == true)
                    {
                    //alert('O cancelamento foi solicitado com sucesso!');
                    $.ajax({
                            url: 'cancelar_transacao?id='+id,
                            success: function(data)
                                {
                                alert('O cancelamento foi solicitado com sucesso!');
                                }
                          });
                    }
               
                }
                
        </script>
	</head>

	<body>

        <div class="modal fade" id="modal-endereco">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    <h4 class="modal-title">Endereço de entrega</h4>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div id="endereco">
                            </div>
                        </div>
                    </div>                                             
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
        </div>

		<div class="modal fade" id="modal-produtos">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    <h4 class="modal-title">Lista de produtos</h4>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div id="produtos">
                            </div>
                        </div>
                    </div>                                             
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
        </div>

		<div class="container"><!-- Estrutura onde será exibido a lista do CRUD de produtos -->
	    	<div class="page-header">
	        	<h1>Compras realizadas</h1>
	      	</div>

		    <div class="row">
		    	<div class="col-sm-12">
					<table class="table table-hover">
						<thead class="tabela_custom">
							<tr>
								<th class="centro1" scope="col">Codigo de Referência</th>
								<th class="centro1" scope="col">Comprador</th>
								<th class="centro1" scope="col">Valor da compra</th>
								<th class="centro1" scope="col">Status de pagamento</th>
                                <th class="centro1" scope="col">Endereço</th>
								<th class="centro1" scope="col">Produtos</th>
                                <th class="centro1" scope="col">Codigo de Transação</th>
							</tr>
						</thead>
						<tbody><!-- Area onde é exibido os produtos já cadastrados no banco de dados -->
						<?php  
							foreach ($lista as $transacoes):
								$valor_bruto = $transacoes['valor_compra'];
								$valor = number_format($valor_bruto, 2, ',', '.');?><!-- Laço de repetição responsável por organizar e exibir
							cada produto da lista de produtos armazenado no banco de dados -->
							
								<tr>
									<td class="centro1" scope="row"><?=$transacoes['codigo_referencia'];?></td>
									<td class="centro1"><?=$transacoes['nome_comprador']?></td>
                                    <td class="centro1"><?=$valor;?></td>
									<td class="centro1"><?=$transacoes['status_pagamento'];?></td>
                                    <td class="centro1"><a href="#" onclick="endereco('<?php echo $transacoes['codigo_referencia']; ?>');">Endereço de entrega</button></td>
									<td class="centro1"><a href="#" onclick="produtos('<?php echo $transacoes['codigo_referencia']; ?>');">Produtos</button></td>
                                    <td class="centro1"><?=$transacoes['codigo_transacao'];?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		<a href="crud">Dashboard Produtos</a><br>
		<a href="index">Pagina Inicial</a><br><br><!-- Link que leva para a pagina inicial da loja -->
		</div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>