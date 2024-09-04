<?php 

	require_once('vendor/autoload.php');

	session_start();
	//Aquele ajuste pra desbugar possivelmente

	$comprimento_produto = $_SESSION['comprimento_produto'];
	$altura_produto      = $_SESSION['altura_produto'];
	$largura_produto     = $_SESSION['largura_produto'];
	$peso_produto        = $_SESSION['peso_produto'];
	$cep_origem         = "04218000";

	$cep_final   = $_POST['sCepDestino'];
	$endereco    = $_POST['endereco'];
	$numero      = $_POST['numero'];
	$complemento = $_POST['complemento'];
	$bairro      = $_POST['bairro'];
	$cidade      = $_POST['cidade'];
	$estado      = $_POST['estado'];
	$pais        = $_POST['pais'];

	$_SESSION['cep']         = $cep_final;
	$_SESSION['endereco']    = $endereco;
	$_SESSION['numero']      = $numero;
	$_SESSION['complemento'] = $complemento;
	$_SESSION['bairro']      = $bairro;
	$_SESSION['cidade']      = $cidade;
	$_SESSION['estado']      = $estado;
	$_SESSION['pais']        = $pais;

	$JsonCepFinal = json_encode($cep_final);
	$JsonLarguraProduto = json_encode($largura_produto);
	$JsonAlturaProduto = json_encode($altura_produto);
	$JsonComprimentoProduto = json_encode($comprimento_produto);
	$JsonPesoProduto = json_encode($peso_produto);

	$client = new \GuzzleHttp\Client();
	
	$body = array(
		"from" => array("postal_code" => "04218000"),
		"to" => array("postal_code" => $JsonCepFinal),
		"package" => array(
			"width" => $JsonLarguraProduto,
			"height" => $JsonAlturaProduto,
			"length" => $JsonComprimentoProduto,
			"weight" => $JsonPesoProduto,
			),
		);
	
	//echo $bodyJson = json_encode($body);
	$bodyJson = json_encode($body);
	
	$response = $client->request('POST', 'https://www.melhorenvio.com.br/api/v2/me/shipment/calculate', [
		'body' => $bodyJson,
		'headers' => [
			'Accept' => 'application/json',
			'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYjY1ZDBmYmNhYzliZWQ1MjhlNDFjYzlkOWMyZWZjZDY5NmFlZDMxOTJjNjRiOWExNWY4Y2NjMDA0NDZiZTE5YjAzNjVjNWZjN2EzNDZiNjAiLCJpYXQiOjE3MjQxODIzMDkuNzE3MTk4LCJuYmYiOjE3MjQxODIzMDkuNzE3MTk5LCJleHAiOjE3NTU3MTgzMDkuNzAxMzEyLCJzdWIiOiI5Y2NmYjUyMS1iZTJkLTQ1MDItYWI3NS00MDEwZjI1NDlmY2EiLCJzY29wZXMiOlsic2hpcHBpbmctY2FsY3VsYXRlIl19.sJ3OHPTsPJt4p4-vLSs0eqfUYBCIb8WlFWrWcRKQeXYXlEHpgTVqdUT3ZTWxYTlPop3kY7D7bTyFxYOiXvZ2yXzVPfwfcxNmuX-dBXfMKGW3t74yOwVnnCO7jI5gI-Rhy8ImY0h0ELtXLyjQnejZPITFTRsyRUzCKbMo6LGqBfY9VuJuJPobSjrpRJSR0uXX88OEP6fkJNoHl3oVoS2zHzIG2DwYSTv2Bs6dTIIVWyCKFlsIhEVIKCUr4IJAgYuMEfgMq0HNDtoYQY2lLTFRfkZPuLCzlrzkxugpQ0RJbmPHWNiLpWWytoWyfwNV4aPuokQF_1zuRhJv1AamLw4fahKn8omnYISDRU3shAEh4isW8W1GBU-OKwM_hGTKZT804oPkdaZeGu2ujm9ahwNIp_o7lkHs-6wgXbe3aQzpg1a8m_uz7iro9SrnbRjPtNZhDGZPak0gqE55sCm0ABgaGByddmOoKypn7R-axJOCorJhVIXRJQkB0Lm2Ql9WoQhlbeEUp6LEyN22Z6smlr4VZBuh4pGYSX8pzOfwq0ysP8hRT_x83-OP5vgCvslNErTXZD4wsTOt7k07aG3O6s5tcZhq-G1XTAX3y64M9-NgQlKBeCJ60qngDblbvT9BumIHg9Yv1xakkmyqDD_lgWx7WNMr9lzR8k-gmTo7vLtexSA',
			'Content-Type' => 'application/json',
			'User-Agent' => 'Aplicação herbertms174@gmail.com',
			],
	  ]);
	
	$fretes = json_decode($response->getBody()); //Objeto gettype($fretes)
	
	//echo $response->getBody();
	/*$retorno_lista = '';
	$retorno_lista .= '<div class="row">';
	$retorno_lista .= '<div class="col-sm-2">';
	$retorno_lista .= '<span class="centro"></span>';
	$retorno_lista .= '</div>';
	$retorno_lista .= '<div class="col-sm-3">';
	$retorno_lista .= '<span class="centro">Categoria</span>';
	$retorno_lista .= '</div>';
	$retorno_lista .= '<div class="col-sm-1">';
	$retorno_lista .= '<span class="centro">Prazo</span>';
	$retorno_lista .= '</div>';
	$retorno_lista .= '<div class="col-sm-2">';
	$retorno_lista .= '<span class="centro">Preço</span>';
	$retorno_lista .= '</div>';
	$retorno_lista .= '<div class="col-sm-2">';
	$retorno_lista .= '<span class="centro">Ação</span>';
	$retorno_lista .= '</div>';
	$retorno_lista .= '</div><br>';*/

	$retorno_lista = '';
	$retorno_lista .= '<table class="table table-hover tabelaTamanhoCustom">';
	$retorno_lista .= '<thead class="tabela_custom">';
	$retorno_lista .= '<tr>';
	$retorno_lista .= '<th scope="col" colspan="1"></th>';
	$retorno_lista .= '<th scope="col" colspan="1">Categoria</th>';
	$retorno_lista .= '<th scope="col" colspan="1">Prazo</th>';
	$retorno_lista .= '<th scope="col" colspan="1"><span class="centro1">Preço</span></th>';
	$retorno_lista .= '<th scope="col" colspan="1"><span class="centro1">Ação</span></th>';
	$retorno_lista .= '</tr>';
	$retorno_lista .= '</thead>';
	$retorno_lista .= '<tbody>';


	
	foreach($fretes as $frete)
		{
		$nomeServico = isset($frete->name) ? $frete->name : null;
		$preco = isset($frete->price) ? $frete->price : null;
		$prazo = isset($frete->delivery_time) ? $frete->delivery_time : null;
		$entregadora = isset($frete->company->name) ? $frete->company->name : null;
		$fotoEntregadora = isset($frete->company->picture) ? $frete->company->picture : null;
		if($nomeServico && $preco && $prazo && $entregadora && $fotoEntregadora)
			{
			/*$retorno_lista .= '<div class="row">';
			$retorno_lista .= '<div class="col-sm-2">';
			$retorno_lista .= '<img class="img-custom5" src="'.$fotoEntregadora.'">';
			$retorno_lista .= '</div>';
			$retorno_lista .= '<div class="col-sm-3">';
			$retorno_lista .= '<span>'.$nomeServico.'</span>';
			$retorno_lista .= '</div>';
			$retorno_lista .= '<div class="col-sm-1">';
			$retorno_lista .= '<span>'.$prazo.' dia(s)</span>';
			$retorno_lista .= '</div>';
			$retorno_lista .= '<div class="col-sm-2">';
			$retorno_lista .= '<span>R$: '.$preco.'</span>';
			$retorno_lista .= '</div>';
			$retorno_lista .= '<div class="col-sm-2">';
			$retorno_lista .= '<button class="btn btn-default escolhaFrete" data-servico="'.$nomeServico.'" data-prazo="'.$prazo.'" data-preco="'.$preco.'" type="button">Selecionar</button>';
			$retorno_lista .= '</div>';
			$retorno_lista .= '</div><br>';*/

			$retorno_lista .= '<tr><td><img class="img-frete" src="'.$fotoEntregadora.'"></td>';
			$retorno_lista .= '<td><span>'.$nomeServico.'</span></td>';
			$retorno_lista .= '<td><span>'.$prazo.' dia(s)</span></td>';
			$retorno_lista .= '<td><span>R$: '.$preco.'</span></td>';
			$retorno_lista .= '<td><button class="btn btn-default escolhaFrete" data-servico="'.$nomeServico.'" data-prazo="'.$prazo.'" data-preco="'.$preco.'" type="button">Selecionar</button></td></tr>';
			}
		}
	$retorno_lista .= '</tbody>';

	echo $retorno_lista;

?>
