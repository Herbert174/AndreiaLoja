<?php  

    require_once('vendor/autoload.php');

    $client = new \GuzzleHttp\Client();

    session_start();

    include_once("PagSeguroLibrary/PagSeguroLibrary.php");
    $paymentRequest = new PagSeguroPaymentRequest();

    //$frete = 0;

    $valor = (float)$_SESSION['valor'];
    //$frete = (float)$_SESSION['preco_frete'];

    $servico = (string)$_POST['servicoPost'];
    $prazo = (float)$_POST['prazoPost'];
    $frete = (float)$_POST['precoPost'];

    $valortotal = $valor;
    $valorfrete = $frete;
    $valorcompra = $valortotal + $valorfrete;

    $_SESSION['preco_frete'] = $valorfrete;

    require_once('db.class.php');
    $id_usuario  = $_SESSION['id_usuario'];
    $usuario     = $_SESSION['usuario'];

    $cep         = $_SESSION['cep'];
	$rua         = $_SESSION['endereco'];
	$numero      = $_SESSION['numero'];
	$complemento = $_SESSION['complemento'];
	$bairro      = $_SESSION['bairro'];
	$cidade      = $_SESSION['cidade'];
	$estado      = $_SESSION['estado'];
	$pais        = $_SESSION['pais'];

    $comprimento_produto = $_SESSION['comprimento_produto'];
	$altura_produto      = $_SESSION['altura_produto'];
	$largura_produto     = $_SESSION['largura_produto'];
	$peso_produto        = $_SESSION['peso_produto'];

    $lista_produtos = "";

    $sql = " SELECT * FROM carrinho_de_compras WHERE id = '$id_usuario' ";

    $objDb = new database();//Instância a classe
    $link = $objDb -> conecta_mysql();//Executa função de conexão com o MySQL

    $resultado_carrinho = mysqli_query($link, $sql);

    $produto = '';
    $Produtos = '';

    if($resultado_carrinho)
        {
        while($produto = mysqli_fetch_array($resultado_carrinho))
            {
            $produto_id   = $produto['id_produto'];
            $produto_qntd = $produto['qntd_produto'];

            $JsonId = json_encode($produto_id);
            $JsonQntd = json_encode($produto_qntd);

            $sql = " SELECT * FROM produtos WHERE id_produto = '$produto_id' ";
            $resultado_produto = mysqli_query($link, $sql);
            if($resultado_produto)
                {
                while($dados_produto = mysqli_fetch_array($resultado_produto))
                    {
                    $nome_produto        = $dados_produto['nome_produto'];
                    $preco_produto       = $dados_produto['preco'];
                    $resumo_produto      = $dados_produto['resumo'];

                    $JsonNome = json_encode($nome_produto);
                    $JsonResumo = json_encode($resumo_produto);
                    $JsonPreco = json_encode($preco_produto);
                    }
                $paymentRequest->addItem($produto_id, $nome_produto, $produto_qntd, $preco_produto);
                $lista_produtos .= "Nome: $nome_produto <br> Qntd: $produto_qntd <br> Preco unitário: $preco_produto <br><br>";
                /*$produto = array(
                    "reference_id" => $JsonId,
                    "name" => $JsonNome,
                    "description" => $JsonResumo,
                    "quantity" => $JsonQntd,
                    "unit_amount" => $JsonPreco,
                    );
                $JsonProduto = json_encode($produto);
                $Produtos .= $produto;
                $JsonProdutos = json_encode($Produtos);*/
                }else{
                     echo "Erro na consulta do banco de dados";
                     }
            }
        }

    /*$codigoReferencia = uniqid();
    $JsonRef = json_encode($codigoReferencia);

    $JsonPais = json_encode($pais);
    $JsonEstado = json_encode($estado);
    $JsonCidade = json_encode($cidade);
    $JsonCep = json_encode($cep);
	$JsonRua = json_encode($rua);
	$JsonNumero = json_encode($numero);
	$JsonBairro = json_encode($bairro);
	$JsonComplemento = json_encode($complemento);
	
    $endereco = array(
        "country" => $JsonPais,
        "region_code" => $JsonEstado,
        "city" => $JsonCidade,
        "postal_code" => $JsonCep,
        "street" => $JsonRua,
        "number" => $JsonNumero,
        "locality" => $JsonBairro,
        "complement" => $JsonComplemento,
        );

    $JsonEndereco = json_encode($endereco);

    $JsonComprimento = json_encode($comprimento_produto);
    $JsonAltura = json_encode($altura_produto);
	$JsonLargura = json_encode($largura_produto);

	$JsonPeso = json_encode($peso_produto);

    $dimensao = array(
        "length" => $JsonComprimento,
        "width" => $JsonLargura,
        "height" => $JsonAltura,
        );
    $JsonDimensao = json_encode($dimensao);

    $TipoFrete = "CALCULATE";
    $JsonTipoFrete = json_encode($TipoFrete);

    $JsonPrecoFrete = json_encode($valorfrete);

    $cartaoCredito = "CREDIT_CARD";
    $JsonCartaoCredito = json_encode($cartaoCredito);
    
    $bandeiraCartao = "mastercard";
    $JsonBandeiraCartao = json_encode($bandeiraCartao);

    $MetodoPagamentoCredito = array(
        "type" => $JsonCartaoCredito,
        "brands" => $JsonBandeiraCartao,
        );

    $cartaoDebito = "DEBIT_CARD";
    $JsonCartaoDebito = json_encode($cartaoDebito);
    
    $bandeiraCartaoD = "visa";
    $JsonBandeiraCartaoD = json_encode($bandeiraCartaoD);

    $MetodoPagamentoDebito = array(
        "type" => $JsonCartaoDebito,
        "brands" => $JsonBandeiraCartaoD,
        );

    $Boleto = "BOLETO";
    $JsonBoleto = json_encode($Boleto);
    
    $bandeiraBoleto = "visa";
    $JsonBandeiraBoleto = json_encode($bandeiraBoleto);

    $MetodoPagamentoBoleto = array(
        "type" => $JsonBoleto,
        "brands" => $JsonBandeiraBoleto,
        );

    $PIX = "PIX";
    $JsonPix = json_encode($PIX);

    $MetodoPagamentoPix = array(
        "type" => $JsonPix,
        );

    $MetodosPagamento = array(
        $MetodoPagamentoCredito,
        $MetodoPagamentoDebito,
        $MetodoPagamentoBoleto,
        $MetodoPagamentoPix,
        );

    $JsonMetodosPagamento = json_encode($MetodosPagamento);

    $DescricaoLoja = "Ageofgames Ecommerce Tecnologia";
    $JsonDescricaoLoja = json_encode($DescricaoLoja);

    $UrlAposCompra = "https://pagseguro.uol.com.br";
    $JsonUrlAposCompra = json_encode($UrlAposCompra);

    $UrlNotificacao = "https://pagseguro.uol.com.br";
    $JsonUrlNotificacao = json_encode($UrlNotificacao);

    $produto = array(
        "reference_id" => "xert",
        "name" => "Testando",
        "description" => "Testando o teste",
        "quantity" => "2",
        "unit_amount" => "546000",
        );
    $JsonProduto = json_encode($produto);

    $body = array(
        "reference_id" => $JsonRef,
        "items" => array($JsonProduto),
        "shipping" => array(
            "address" => array($JsonEndereco),
            "box" => array($JsonDimensao),
            "weight" => $JsonPeso,
            "type" => $JsonTipoFrete,
            "amount" => $JsonPrecoFrete,
            ),
        "payment_methods" => array($JsonMetodosPagamento),
        "soft_descriptor" => $JsonDescricaoLoja,
        "redirect_url" => $JsonUrlAposCompra,
        "notification_urls" => $JsonUrlNotificacao,
        );

    $bodyJson = json_encode($body);

    $response = $client->request('POST', 'https://api.pagseguro.com', [
        'body' => $bodyJson,
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer 26d141b1-28e9-4cd5-865c-09135a44feaffe19b65244f383bc7225e2f1f9d3b621aa59-bf57-4af5-aa34-d1b77fbc4c16',
            'Content-Type' => 'application/json',*/
            //'accept' => '*/*',
        /*    ],
        ]);

    echo $response->getBody();*/

    $sedexCode = PagSeguroShippingType::getCodeByType('SEDEX');  
    $paymentRequest->setShippingType($sedexCode); 
    $paymentRequest->setShippingAddress(  
        $cep,  
        $rua,  
        $numero,  
        $complemento,  
        $bairro,  
        $cidade,  
        $estado,  
        $pais 
        );  

    $paymentRequest->addItem('0003', 'Frete',  1, $valorfrete);

    $paymentRequest->setCurrency("BRL");

    $codigoReferencia = uniqid();

    // Referenciando a transação do PagSeguro em seu sistema  
    $paymentRequest->setReference($codigoReferencia);  
      
    // URL para onde o comprador será redirecionado (GET) após o fluxo de pagamento  
    $paymentRequest->setRedirectUrl("https://ageofgames.com.br/Ecommerce/");
      
    // URL para onde serão enviadas notificações (POST) indicando alterações no status da transação  
    $paymentRequest->addParameter('notificationURL', 'https://ageofgames.com.br/Ecommerce/notificacoes_pagamentos.php');
    try {
        $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()  
        $checkoutUrl = $paymentRequest->register($credentials);  

        $_SESSION['link_pagseguro'] = $checkoutUrl;
        
        }catch(PagSeguroServiceException $e)
            {  
            die('<p>Não foi possivel calcular o frete corretamente, por favor verifique o CEP</p>');
            }


    $_SESSION['link_pagseguro'] = $checkoutUrl; //url do checkout deverá ser guardado aqui

    $sql = " INSERT INTO transacoes(codigo_referencia, id_usuario, valor_compra, nome_comprador, endereco, numero, complemento, bairro, cep, cidade, estado, pais, produtos, tipoFrete) values('$codigoReferencia', '$id_usuario', '$valorcompra', '$usuario', '$rua', '$numero', '$complemento', '$bairro', '$cep', '$cidade', '$estado', '$pais', '$lista_produtos', '$servico') ";

    if(mysqli_query($link, $sql))//Envia o codigo ao banco de dados, cadastrando as informações do produto enviado pelo usuario
		{
		}else{
			 echo 'Erro ao registrar transação no banco de dados';
			 }
    
    echo "<br><a class='link-custom' href='#'><button class='btn btn-default btn-block botao btn-blue' onclick='envia_pagseguro();'>Avançar para o Pagseguro</button></a>";
    

/*      raw para utilizar nos testes do postman
    {
        "reference_id":"REFERÊNCIA DO PRODUTO",
        "expiration_date":"2023-08-14T19:09:10-03:00",
        "customer":
            {"name":"João teste",
            "email":"joao@teste.com",
            "tax_id":"12345678909",
            "phone":
                {"country":"+55",
                "area":"27",
                "number":"999999999"
                }
            },
        "customer_modifiable":true,
        "items":[
            {"reference_id":"ITEM01",
            "name":"Nome do Produto",
            "quantity":1,
            "unit_amount":500,
            "image_url":"https://www.petz.com.br/blog//wp-content/upload/2018/09/tamanho-de-cachorro-pet-1.jpg"
            }
        ],
        "additional_amount":0,
        "discount_amount":0,
        "shipping":
            {"type":"FREE",
            "amount":0,
            "service_type":"PAC",
            "address":
                {"country":"BRA",
                "region_code":"SP",
                "city":"São Paulo",
                "postal_code":"01452002",
                "street":"Faria Lima",
                "number":"1384",
                "locality":"Pinheiros",
                "complement":"5 andar"
                },
            "address_modifiable":true,
            "box":
                {"dimensions":
                    {"length":15,
                    "width":10,
                    "height":14
                    },
                "weight":300
                }
            },
        "payment_methods":[
                {"type":"credit_card",
                "brands":[
                    "mastercard"]
                    },
                {"type":"credit_card",
                "brands":["visa"]
                },
                {"type":"debit_card",
                "brands":["visa"]
                },
                {"type":"PIX"},
                {"type":"BOLETO"}
            ],
        "payment_methods_configs":[
            {"type":"credit_card",
            "config_options":[
                {"option":"installments_limit",
                "value":"1"}
                ]
            }
            ],
        "soft_descriptor":"xxxx",
        "redirect_url":"https://pagseguro.uol.com.br",
        "return_url":"https://pagseguro.uol.com.br",
        "notification_urls":["https://pagseguro.uol.com.br"]
    }
*/

?>