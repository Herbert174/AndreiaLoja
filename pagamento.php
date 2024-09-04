<?php

	session_start();

    $erro = isset($_GET['erro']) ? $_GET['erro'] : 0;

    $valor = $_SESSION['valor'];

    if(isset($_SESSION['usuario']))
        {
        $usuario = $_SESSION['usuario'];
        }else{
             $usuario = 'Faça o login para iniciar as compras';
             }

    include_once("PagSeguroLibrary/PagSeguroLibrary.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Loja Online</title>
        <link rel="icon" href="imagens/twitter.png">

        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- CSS -->
        <link href="estilo.css" rel="stylesheet">

        <!-- Jquery -->
        <script src="jquery-3.6.0.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Javascript -->
        <script type="text/javascript">
            var produto_erro;
            $(document).ready(function() 
                {
	            $('#calcular').click(function() 
	                {
					let formSerialized = $('#formDestino').serialize();
					$.post('calcular_frete', formSerialized, function(resultado)
						{
						//resultado = JSON.parse(resultado);
						//let valorFrete = resultado.preco;
						//let prazoEntrega = resultado.prazo;
						//é necessario utilizar a aspas dessa forma ` por uma questão de sintax do javascript

						$('#fretes').html(resultado);
                        $('#modal-fretes').modal('show');
                        
                        //Será executado após cliente selecionar um dos fretes disponiveis
                        $('.escolhaFrete').click(function() 
	                        {
                            var servico = $(this).data('servico');
                            var prazo = $(this).data('prazo');
                            var preco = $(this).data('preco');
                            $.ajax({
                                    url: 'api_pagseguro',
                                    method: 'post',
                                    data: {servicoPost: servico, prazoPost: prazo, precoPost: preco},
                                    success: function(data)
                                        {
                                        $('#modal-fretes').modal('hide');
                                        $('#btn_compra').html(data);
                                        $.ajax({
                                            url: 'atualiza_preco_total',
                                            success: function(data)
                                                {
                                                $('#valor_total').html(data);
                                                }
                                        });
                                        }
                                });
						    });
                        });
                    $('#modal-endereco').modal('hide');
                    
					});
                    
	            $.ajax({
                        url: 'consulta_carrinho1',
                        success: function(data)
                            {
                            $('#produto-carrinho').html(data);
                            }
                      });
                /*$.ajax({
                        url: 'atualiza_preco',
                        success: function(data)
                            {
                            $('#valor').html(data);
                            }
                      });*/
                $.ajax({
                        url: 'verifica_embalagem',
                        success: function(data)
                            {
                            $('#retorno').html(data);
                            }
                      });
                });

            function envia_pagseguro()
                {
                window.location = "enviar_pagseguro";
                }

            function verifica(value)
                {
                var cep = document.getElementById("cep");
                if(isNaN(cep.value))
                    {
                    cep.value = '';
                    alert('Digite apenas números na area CEP');
                    }
                var endereco = document.getElementById("endereco");
                var numero = document.getElementById("numero");
                if(isNaN(numero.value))
                    {
                    numero.value = '';
                    alert('Digite apenas números na area Número');
                    }
                var apartamento = document.getElementById("complemento");
                var bairro = document.getElementById("bairro");
                var cidade = document.getElementById("cidade");
                var estado = document.getElementById("estado");
                var pais = document.getElementById("pais");
                var calcular = document.getElementById("calcular");
                if(cep.value != '' && endereco.value != '' && numero.value != '' && apartamento.value != '' && estado.value != '' && bairro.value != '' && cidade.value != '')
                    {
                    calcular.disabled = false;
                    }
                // Define que o formulario de endereço não deve atualizar a pagina ao ser enviado
                const form = document.getElementById('formDestino')
                form.addEventListener('submit', e => {
                    e.preventDefault()
                    })
                }
            
        </script>
    </head>

    <body>
    	<!-- Barra de Navegação -->
        <nav class="navbar navbar-default navbar-fixed-top navbar-custom">

            <!-- container-fluid para o menu aparecer na página inteira -->
            <div class="container-fluid">

                <!-- Barra de Navegação quando em colapso -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target = "#Navegacao">
                        <span class="sr-only">Alterar Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Barra de Navegação em estado normal -->
                <div class="collapse navbar-collapse" id="Navegacao">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index">Início</a></li>
                        <li><a href="#">Contato</a></li>
                        <li><a href="cadastrar_user">Cadastrar</a></li>
                        <li class="<?= $erro == 1 ? 'open' : '' ?>">
                            <a id="entrar" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login</a>
                            <ul class="dropdown-menu menu-custom" aria-labelledby="entrar">
                                <div class="col-md-12">
                                    <p style="color: black;">Acesse sua conta e vá as compras</p>
                                    
                                    <form method="post" action="validar_acesso" id="formLogin">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" />
                                        </div>
                
                                        <div class="form-group">
                                            <input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" />
                                        </div>
                
                                        <button type="buttom" class="btn btn-custom1" id="btn_login">Entrar</button>

                                        <br /><br />                
                                    </form>
                                    <?php
                                        if($erro == 1)
                                            {   
                                            echo '<font color="#FF0000">Usuario e ou senha invalido(s)</font>';
                                            }
                                    ?>
                                </div>
                            </ul>
                        </li>
                        <li><button class="btn_custom" id="meu_carrinho" data-toggle="modal" data-target="#modal-mensagem"><img class="carrinho_compras" src="imagens/Emote1.png">Meu Carrinho</button></li>
                    </ul>

                    <img class="nav navbar-nav navbar-left imgcustom" src="imagens/twitter.png">
                    <div class="nav navbar-nav navbar-left nav-custom">
                        Bem vindo: <span class="negrito"><?= $usuario ?></span>
                    </div>
                </div> 

            <!-- Container fluid -->
            </div>

        <!-- Barra de navegação -->
        </nav>

        <div class="modal fade" id="modal-endereco">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    <h3 class="modal-title">Endereço de entrega</h3>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <br>
                                <form id="formDestino" action="">
                                    <div class="col-md-12">
                                    <div class="col-md-4">
										<label for="">Endereço:</label>
                                    </div>
                                    <div class="col-md-8">
										<input class="direita form-control" type="text" name="endereco" id="endereco" onchange="verifica(this.value)" required>
                                    </div>
                                    </div>
                                    <br><br>

                                    <div class="col-md-12">
                                    <div class="col-md-4">
										<label for="">Numero:</label>
                                    </div>
                                    <div class="col-md-8">
										<input class="direita form-control" type="text" name="numero" id="numero" onchange="verifica(this.value)" required>
                                    </div>
                                    </div>
                                    <br><br>

                                    <div class="col-md-12">
                                    <div class="col-md-4">
										<label for="">Complemento:</label>
                                    </div>
                                    <div class="col-md-8">
										<input class="direita form-control" type="text" name="complemento" id="complemento" onchange="verifica(this.value)" required>
                                    </div>
                                    </div>
                                    <br><br>

                                    <div class="col-md-12">
                                    <div class="col-md-4">
										<label for="">Bairro:</label>
                                    </div>
                                    <div class="col-md-8">
										<input class="direita form-control" type="text" name="bairro" id="bairro" onchange="verifica(this.value)" required>
                                    </div>
                                    </div>
                                    <br><br>

                                    <div class="col-md-12">
                                    <div class="col-md-4">
										<label for="">Cep de destino:</label>
                                    </div>
                                    <div class="col-md-8">
										<input class="direita form-control" type="text" name="sCepDestino" id="cep" onchange="verifica(this.value)" required>
                                    </div>
                                    </div>
                                    <br><br>

                                    <div class="col-md-12">
                                    <div class="col-md-4">
										<label for="">Cidade:</label>
                                    </div>
                                    <div class="col-md-8">
										<input class="direita form-control" type="text" name="cidade" id="cidade" onchange="verifica(this.value)" required>
                                    </div>
                                    </div>
                                    <br><br><br>

                                    <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label for="">Estado:</label>
                                        <select class="form-control formulario_custom" name="estado" id="estado" onchange="verifica(this.value)" required>
                                            <option value="">Selecione</option>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espirito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraiba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RO">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Pais:</label>
                                        <select class="form-control formulario_custom" name="pais" id="pais" onchange="verifica(this.value)" required>
                                            <option value="">Selecione</option>
                                            <option value="BRA">Brasil</option>
                                        </select><br>
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>                                             
                </div>
                <div class="modal-footer">
                    <p><button class="esquerda btn btn-default" id="calcular" disabled>Calcular</button></p>
                    </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
        </div>

        <div class="modal fade" id="modal-fretes">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    <h3 class="modal-title">Opções de frete disponiveis</h3>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10">
                                <div id="fretes"></div>
                            </div>
                        </div>
                    </div>                                             
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
        </div>

        <section id="conteudo">
        	<div class="container">
        		<div class="row">
        			<div class="col-md-12">
        				<div class="col-md-8">
        					<div class="row">
                                <div class="col-md-8">
	        					    <h2>Selecione o endereço de entrega</h2>
                                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal-endereco">Endereço</button>
                                    <br><br>
                                </div>
							</div>
                            <div class="row">
								<div class="col-md-12">
                                    <span id="resultado"></span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Produto(s)</h2>
									<div id="produto-carrinho" class=""></div>
									<br><br><br>
								</div>
							</div>
						</div>
        				<div class="col-md-4">
        					<div class="row">
        					<h2>Resumo da compra</h2>
        					<h4>Subtotal: <span class="negrito direita">R$ <?= $valor ?></span></h4>
        					<h4><span id="resultado"></span></h4>
                            <h3><span class="negrito"><span id="valor_total"></span></span></h3>
                            <div><p id="btn_compra"></p></div><br>
                            <h4 class="negrito" id="retorno"></h4>
        					<p>Peso limite por compra 30kg</p>
        					<p>A soma máxima das dimensões da embalagem é de no máximo 200cm (comprimento + largura + altura), acima disso será necessario realizar o pedido do restantes dos produtos em uma nova compra</p>
        					<div><button class="btn btn-default btn-block botao"><a href = "index">Continuar comprando</a></button></div>
        					
        				</div>
        			</div>
        		</div>
        	</div>
        </section>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>

    </body>