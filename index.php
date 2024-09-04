<?php

    session_start();

    $erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
    $sucesso = isset($_GET['sucesso_registro']) ? $_GET['sucesso_registro'] : 0;

    $valor = 0;

    if(isset($_SESSION['usuario']))
        {
        $valor = $_SESSION['valor'];
        $usuario = $_SESSION['usuario'];
        }else{
             $usuario = 'Faça o login para iniciar as compras';
             }

    require_once('db.class.php');

    $objDb = new database();
    $link = $objDb -> conecta_mysql();
         
    $lista = [];
    $destaque = [];
    $sql = " SELECT * FROM produtos ";
         
    if($resultado_lista = mysqli_query($link, $sql))
        {
        $lista = mysqli_fetch_all($resultado_lista, MYSQLI_ASSOC);
        }
             
    $sql = " SELECT * FROM produtos_destaque ";
         
    if($resultado_lista = mysqli_query($link, $sql))
        {
        $destaque = mysqli_fetch_all($resultado_lista, MYSQLI_ASSOC);
        }
    $Mais_vendido = $destaque[0]['mais_vendido'] - 1;
    $Novidades1 = $destaque[0]['novidade1'] - 1;
    $Novidades2 = $destaque[0]['novidade2'] - 1;
    $Novidades3 = $destaque[0]['novidade3'] - 1;
    $Destaque = $destaque[0]['destaque'] - 1;
         
    $_SESSION['id_mais_vendido'] = $lista[$Mais_vendido]['id_produto'];
    $_SESSION['imagem_mais_vendido'] = $lista[$Mais_vendido]['imagem'];
    $_SESSION['id_novidades1'] = $lista[$Novidades1]['id_produto'];
    $_SESSION['imagem_novidades1'] = $lista[$Novidades1]['imagem'];
    $_SESSION['id_novidades2'] = $lista[$Novidades2]['id_produto'];
    $_SESSION['imagem_novidades2'] = $lista[$Novidades2]['imagem'];
    $_SESSION['id_novidades3'] = $lista[$Novidades3]['id_produto'];
    $_SESSION['imagem_novidades3'] = $lista[$Novidades3]['imagem'];
    $_SESSION['id_destaque'] = $lista[$Destaque]['id_produto'];
    $_SESSION['imagem_destaque'] = $lista[$Destaque]['imagem'];

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Loja Online</title>
        <link rel="icon" href="imagens/Capa.jpeg">

        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

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
            $(document).ready(function() 
                {
                $('#meu_carrinho').click( function()//Coloca de forma dinamica os produtos escolhidos pelo usuario no carrinho de compras
                    {
                    $.ajax({
                            url: 'consulta_carrinho?pagina=index',
                            success: function(data)
                                {
                                $('#produto-carrinho').html(data);
                                }
                          });
                    $.ajax({
                            url: 'atualiza_preco',
                            success: function(data)
                                {
                                $('#valor').html(data);
                                }
                          });
                    })
                function postarproduto()
                    {
                    //carrega os produtos destaque
                    $.ajax({
                          url: 'postar_destaque?id=1',
                          success: function(data)
                              {
                              $('#produtos').html(data);
                              }
                          })

                    //carrega os produtos mais vendidos
                    $.ajax({
                          url: 'postar_destaque?id=2',
                          success: function(data)
                              {
                              $('#produtos1').html(data);
                              }
                          })

                    //carrega os produtos mais procurados
                    $.ajax({
                          url: 'postar_destaque?id=3',
                          success: function(data)
                              {
                              $('#produtos2').html(data);
                              }
                          })
                    }
                postarproduto();

                function postaraba()
                    {
                    //carrega os produtos destaque
                    $.ajax({
                          url: 'postar_abas?id=2',
                          success: function(data)
                              {
                              $('#aba1').html(data);
                              }
                          })

                    //carrega os produtos mais vendidos
                    $.ajax({
                          url: 'postar_abas?id=3',
                          success: function(data)
                              {
                              $('#aba2').html(data);
                              }
                          })

                    //carrega os produtos mais procurados
                    $.ajax({
                          url: 'postar_abas?id=4',
                          success: function(data)
                              {
                              $('#aba3').html(data);
                              }
                          })
                    }
                postaraba();

                function postartriade()
                    {
                    //carrega os produtos destaque
                    $.ajax({
                          url: 'postar_triade?id=5',
                          success: function(data)
                              {
                              $('#triade').html(data);
                              }
                          })
                    }
                postartriade();
                //Esconde o elemento dinamico do carrinho de compras quando não tem nenhum usuario logado
                <?php
                    if(!isset($_SESSION['usuario']))
                        {
                        ?>
                        $('#produto-carrinho').hide();
                        $('#finalizar_compra').hide();
                        <?php
                        }
                ?>
                });
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
                        <li><a href="#">Início</a></li>
                        <li><a href="#">Contato</a></li>
                        <li><a href="cadastrar_user">Cadastrar</a></li>
                        <li class="<?= $erro == 1 ? 'open' : '' ?><?= $sucesso == 1 ? 'open' : '' ?>">
                            <a id="entrar" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login</a>
                            <ul class="dropdown-menu menu-custom" aria-labelledby="entrar">
                                <div class="col-md-12">
                                    <p class ="pnavCustom">Acesse sua conta e vá as compras</p>
                                    
                                    <form method="post" action="validar_acesso" id="formLogin">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" />
                                        </div>
                
                                        <div class="form-group">
                                            <input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" />
                                        </div>
                
                                        <button type="buttom" class="btn btn-custom1" id="btn_login">Entrar</button>

                                        <br/><br/>               
                                    </form>
                                    <?php
                                        if($erro == 1)
                                            {   
                                            echo '<font color="#FF0000">Usuario e ou senha invalido(s)</font>';
                                            }
                                        if($sucesso == 1)
                                            {
                                            echo '<font color="#0E7411">Conta criada com sucesso!</font>';
                                            }
                                    ?>
                                </div>
                            </ul>
                        </li>
                        <li>
                            <a id="categorias" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categorias
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="categorias">
                                    <li><a href="Produtos?secao=1">Computadores</a></li>
                                    <li><a href="Produtos?secao=2">Notebooks</a></li>
                                    <li><a href="Produtos?secao=3">Celulares</a></li>
                                    <li><a href="Produtos?secao=4">Fones</a></li>
                                    <li><a href="Produtos?secao=5">Carregadores</a></li>
                                    <li><a href="Produtos?secao=6">Calçados</a></li>
                            </ul>
                        </li>
                        <li><button class="btn_custom" id="meu_carrinho" data-toggle="modal" data-target="#modal-mensagem"><img class="carrinho_compras" src="imagens/Emote1.png">Meu Carrinho</button></li>
                    </ul>

                    <img class="nav navbar-nav navbar-left img-logo" src="imagens/Capa.jpeg">
                    <div class="nav navbar-nav navbar-left nav-custom">
                        <p>Bem vindo: <span class="negrito"><?= $usuario ?></span></p>
                    </div>
                </div> 

            <!-- Container fluid -->
            </div>

        <!-- Barra de navegação -->
        </nav>

        <div class="modal fade" id="modal-mensagem">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    <h4 class="modal-title">Carrinho de compras</h4>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9">
                                <h3 class="titulo1">Itens no carrinho</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div id="produto-carrinho" class="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Valor: </span>R$</span> <span class="negrito"><span id="valor"></h4>
                                <span id="finalizar_compra">
                                    <a class="link-custom" href="pagamento"><button class="btn btn-custom2">Finalizar Carrinho</button></a>
                                </span>
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

        <div class="col-sm-12 div_custom">
        </div>

        <section id="conteudo">   
            <div class="container">
                <div class="row">
                    <div class="col-md-12" >
                        <div class="col-md-8 tamanho">
                            <h2 class="titulo1">Novidades</h2>
                            <div id="myCarousel" class="carousel slide custom" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slite-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slite-to="1"></li>
                                    <li data-target="#myCarousel" data-slite-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <a href="consulta_produto?produto=<?= $_SESSION['id_novidades1'] ?>"><img id="img1" src="<?= $_SESSION['imagem_novidades1'] ?>" alt="Imagem 1"></a>
                                    </div>
                                    <div class="item">
                                        <a href="consulta_produto?produto=<?= $_SESSION['id_novidades2'] ?>"><img id="img2" src="<?= $_SESSION['imagem_novidades2'] ?>" alt="Imagem 2"></a>
                                    </div>
                                    <div class="item">
                                        <a href="consulta_produto?produto=<?= $_SESSION['id_novidades3'] ?>"><img id="img3" src="<?= $_SESSION['imagem_novidades3'] ?>" alt="Imagem 3"></a>
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Proximo</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h2 class="titulo1">Mais vendido</h2>
                            <a href="consulta_produto?produto=<?= $_SESSION['id_mais_vendido'] ?>"><img class="img-responsive img-custom1" src="<?= $_SESSION['imagem_mais_vendido'] ?>"></a>
                            <a href="consulta_produto?produto=<?= $_SESSION['id_destaque'] ?>"><img class="img-responsive img-custom4" src="<?= $_SESSION['imagem_destaque'] ?>"></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="conteudo1">
            <div class="container">
                <div class="col-sm-12">
                    <!-- Criação das abas -->
                    <ul class="nav nav-tabs" role="tablist"> 
                            <li class="active"><a href="#destaque" role="tab" data-toggle="tab">Destaques</a></li>
                            <li><a href="#mais_vendidos" role="tab" data-toggle="tab">Mais vendidos</a></li>
                            <li><a href="#mais_procurados" role="tab" data-toggle="tab">Mais procurados</a></li>
                    </ul>
                    <!-- Conteúdo das abas -->
                    <div class="tab-content">
                            
                        <!-- Aba informações -->
                        <div class="tab-pane active" role="tabpanel" id="destaque">
                            <div class="row" id="aba1">
                            </div>
                        </div>

                        <!-- Aba avaliações -->
                        <div class="tab-pane" role="tabpanel" id="mais_vendidos">
                            <div class="row" id="aba2">
                            </div>
                        </div>

                        <!-- Aba compre também -->
                        <div class="tab-pane" role="tabpanel" id="mais_procurados">
                            <div class="row" id="aba3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="conteudo1">
            <div class="container">
                <div class="col-sm-0">
                    <a href="https://web.whatsapp.com/send?phone=" target="_blank"><img class="img-whatsapp" src="imagens/whatsapp.png"> </a>
                </div>
                <div class="col-sm-12">
                    <h4 class="titulo1">Destaques</h4>
                    <div class="row" id="produtos">
                    </div>
                </div>
            </div>
        </section>

        <section id="conteudo1">
            <div class="container">
                <div class="col-sm-12">
                    <h4 class="titulo1">Principais Categorias</h4>
                    <div class="row" id="triade">
                    </div>
                </div>
            </div>
        </section>

        <section id="conteudo1">
            <div class="container">
                <div class="col-sm-12">
                    <h4 class="titulo1">Mais vendidos</h4>
                    <div class="row" id="produtos1">
                    </div>
                </div>
            </div>
        </section>
        <section id="conteudo1">
            <div class="container">
                <div class="col-sm-12">
                    <h4 class="titulo1">Mais procurados</h4>
                    <div class="row" id="produtos2">
                    </div>
                </div>
            </div>
        </section>

        <footer id="rodape">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="titulo2">Conheça a nossa equipe</h3>
                    </div>
                    <div class="col-md-2">
                        <h3>Categorias</h3>
                        <a class="link-custom" href="Produtos?secao=1">Computadores</a><br>
                        <a class="link-custom" href="Produtos?secao=2">Notebooks</a><br>
                        <a class="link-custom" href="Produtos?secao=3">Celulares</a><br>
                        <a class="link-custom" href="Produtos?secao=4">Fones</a><br>
                        <a class="link-custom" href="Produtos?secao=5">Carregadores</a><br>
                        <a class="link-custom" href="Produtos?secao=6">Calçados</a><br>
                        <a class="link-custom" href="crud">CRUD</a>
                    </div>
                    <div class="col-md-3">
                        <br>
                        <img class="img-rodape" src="imagens/img_pagseguro.png">
                    </div>
                    <div class="col-md-3">
                        <br><br><br><br><br>
                        <ul class="nav">
                            <li class="item-rede-social"><a href="#"><img src="imagens/facebook.png"></a></li>
                            <li class="item-rede-social"><a href="#"><img src="imagens/twitter.png"></a></li>
                            <li class="item-rede-social"><a href="#"><img src="imagens/instagram.png"></a></li>
                        </ul>
                    </div>
                </div> <!-- /row --><br>
            </div>
        </footer>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        
    </body>
</html>