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
			'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZGYyMTcyYjlkMGRiYjBlMDcwZTAzZjRhYjkxYzExOTRmMTBkMjNlNmFiMmVhMDcyYTIyYWQwZjE5YzMzNjU3YjQxM2YyYmVjMjA3OTkyNTQiLCJpYXQiOjE3MjU5MjI4NjkuNzI0NjgsIm5iZiI6MTcyNTkyMjg2OS43MjQ2ODIsImV4cCI6MTc1NzQ1ODg2OS43MTAwMDEsInN1YiI6IjljZjhiZWViLTMzMmQtNGE3MC04OTFmLWI5Y2UxZDFmMDUzYyIsInNjb3BlcyI6WyJzaGlwcGluZy1jYWxjdWxhdGUiXX0.zNl54BygRYD8zLTSg0O3MdVZkU6ZOnDl6iqAM8rqTCJIqL96TsJMfXnDgmJojuHlJtY-SfD48yVKLuiSitzzFoJ6ty2xQVAyfs5iFRRD1PcPMMHkdZwa5O4vQt8dXPKm0cxPlN6HMlLXiISxP0oJk3hlB-3DZjgyjM5rF9QA7z1BtUAmLGEqiXEbnXDJfvckvB8NscRT0cvwqqBvwAm2Z-xObqyPw18eiSY6J2YaaUbHkHzX5l2XT3dwX62FW0L7e1whFY-QElh0lpMPU9hf-gtVj0b8Oo6eqBb7qnYzVrNjQQE37tHcT2NJ18aIwGAqeeHL7YQyfuQzT6ITm0G03hKrU1N9JXr68Wr4XmhUaof1iiEHcd7iFFc0s8_IFjAjyztCbsUHEMb6pWDYIDEh4VUfeOzlEm8o969HwvoiBmCeq7eTMI12Ug0Mdq1Pwt31PIsrQzcY8WVN_znJVZxe3hhUxAD4IR9w5vQ6wryAyikES9J8rmNuH2CoTPN0iAMYn_djBmoFDd_jlmxJdX9CnvYotvqKpx5nTgBvkxqOOJXAu7Cu8r--SXQ2K9lSFR687AJPLQdMIL3xS-qfZ_djsqWzf43fpPfkNw9BVbZe9EYugnzd3TaKkVw6TYlGKmz19Lh4eAq-4RFDkgJAo36gGYjNCHnpuaHUukopusI22xM',
			'Content-Type' => 'application/json',
			'User-Agent' => 'Aplicação allsexybox@gmail.com',
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
