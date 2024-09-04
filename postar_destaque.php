<?php
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
    
    $sql = " SELECT * FROM destaques ";

    if($resultado_lista = mysqli_query($link, $sql))
        {
        $destaque = mysqli_fetch_all($resultado_lista, MYSQLI_ASSOC);
        }

    $id = $_GET['id'] - 1;

    $destaque1 = $destaque[$id]['destaque1'] - 1;
    $destaque2 = $destaque[$id]['destaque2'] - 1;
    $destaque3 = $destaque[$id]['destaque3'] - 1;
    $destaque4 = $destaque[$id]['destaque4'] - 1;
    $destaque5 = $destaque[$id]['destaque5'] - 1;
    $destaque6 = $destaque[$id]['destaque6'] - 1;
    $destaque7 = $destaque[$id]['destaque7'] - 1;
    $destaque8 = $destaque[$id]['destaque8'] - 1;

    $preco_bruto = $lista[$destaque1]['preco'];
    $preco = number_format($preco_bruto, 2, ',', '.');
    $avaliacao = $lista[$destaque1]['avaliacoes'];
    if($avaliacao > 4)
        {
        $cinco_estrelas = 'ativo';
        }else $cinco_estrelas = '';
    if($avaliacao > 3 && $avaliacao <= 4)
        {
        $quatro_estrelas = 'ativo';
        }else $quatro_estrelas = '';
    if($avaliacao > 2 && $avaliacao <= 3)
        {
        $tres_estrelas = 'ativo';
        }else $tres_estrelas = '';
    if($avaliacao > 1 && $avaliacao <= 2)
        {
        $dois_estrelas = 'ativo';
        }else $dois_estrelas = '';
    if($avaliacao == 1)
        {
        $uma_estrela = 'ativo';
        }else $uma_estrela = '';
    if($avaliacao == null)
        {
        $cinco_estrelas = 'ativo';
        }
    echo '<div class="col-md-3 custom1 borda">';
    echo '<a href="consulta_produto?produto='.$lista[$destaque1]['id_produto'].'">';
    echo '<img class="img-responsive img-custom" src="'.$lista[$destaque1]['imagem'].'"></a><br>';
    echo '<p><b>Produto:</b> <span class="direita">'.$lista[$destaque1]['nome_produto'].'</span></p>';
    echo '<p><b>Preço:</b> <span class="direita">R$ '.$preco.'</span></p>';
    echo '<span class="negrito">Avaliação: </span>';
    echo '<ul class="avaliacao direita">';
    echo '<li class="star-icon '.$uma_estrela.'" data-avaliacao="1"></li>';
    echo '<li class="star-icon '.$dois_estrelas.'" data-avaliacao="2"></li>';
    echo '<li class="star-icon '.$tres_estrelas.'" data-avaliacao="3"></li>';
    echo '<li class="star-icon '.$quatro_estrelas.'" data-avaliacao="4"></li>';
    echo '<li class="star-icon '.$cinco_estrelas.'" data-avaliacao="5"></li>';
    echo '</ul>';
    echo '</div>';

    $preco_bruto = $lista[$destaque2]['preco'];
    $preco = number_format($preco_bruto, 2, ',', '.');
    $avaliacao = $lista[$destaque2]['avaliacoes'];
    if($avaliacao > 4)
        {
        $cinco_estrelas = 'ativo';
        }else $cinco_estrelas = '';
    if($avaliacao > 3 && $avaliacao <= 4)
        {
        $quatro_estrelas = 'ativo';
        }else $quatro_estrelas = '';
    if($avaliacao > 2 && $avaliacao <= 3)
        {
        $tres_estrelas = 'ativo';
        }else $tres_estrelas = '';
    if($avaliacao > 1 && $avaliacao <= 2)
        {
        $dois_estrelas = 'ativo';
        }else $dois_estrelas = '';
    if($avaliacao == 1)
        {
        $uma_estrela = 'ativo';
        }else $uma_estrela = '';
    if($avaliacao == null)
        {
        $cinco_estrelas = 'ativo';
        }
    echo '<div class="col-md-3 custom1 borda">';
    echo '<a href="consulta_produto?produto='.$lista[$destaque2]['id_produto'].'">';
    echo '<img class="img-responsive img-custom" src="'.$lista[$destaque2]['imagem'].'"></a><br>';
    echo '<p><b>Produto:</b> <span class="direita">'.$lista[$destaque2]['nome_produto'].'</span></p>';
    echo '<p><b>Preço:</b> <span class="direita">R$ '.$preco.'</span></p>';
    echo '<span class="negrito">Avaliação: </span>';
    echo '<ul class="avaliacao direita">';
    echo '<li class="star-icon '.$uma_estrela.'" data-avaliacao="1"></li>';
    echo '<li class="star-icon '.$dois_estrelas.'" data-avaliacao="2"></li>';
    echo '<li class="star-icon '.$tres_estrelas.'" data-avaliacao="3"></li>';
    echo '<li class="star-icon '.$quatro_estrelas.'" data-avaliacao="4"></li>';
    echo '<li class="star-icon '.$cinco_estrelas.'" data-avaliacao="5"></li>';
    echo '</ul>';
    echo '</div>';

    $preco_bruto = $lista[$destaque3]['preco'];
    $preco = number_format($preco_bruto, 2, ',', '.');
    $avaliacao = $lista[$destaque3]['avaliacoes'];
    if($avaliacao > 4)
        {
        $cinco_estrelas = 'ativo';
        }else $cinco_estrelas = '';
    if($avaliacao > 3 && $avaliacao <= 4)
        {
        $quatro_estrelas = 'ativo';
        }else $quatro_estrelas = '';
    if($avaliacao > 2 && $avaliacao <= 3)
        {
        $tres_estrelas = 'ativo';
        }else $tres_estrelas = '';
    if($avaliacao > 1 && $avaliacao <= 2)
        {
        $dois_estrelas = 'ativo';
        }else $dois_estrelas = '';
    if($avaliacao == 1)
        {
        $uma_estrela = 'ativo';
        }else $uma_estrela = '';
    if($avaliacao == null)
        {
        $cinco_estrelas = 'ativo';
        }
    echo '<div class="col-md-3 custom1 borda">';
    echo '<a href="consulta_produto?produto='.$lista[$destaque3]['id_produto'].'">';
    echo '<img class="img-responsive img-custom" src="'.$lista[$destaque3]['imagem'].'"></a><br>';
    echo '<p><b>Produto:</b> <span class="direita">'.$lista[$destaque3]['nome_produto'].'</span></p>';
    echo '<p><b>Preço:</b> <span class="direita">R$ '.$preco.'</span></p>';
    echo '<span class="negrito">Avaliação: </span>';
    echo '<ul class="avaliacao direita">';
    echo '<li class="star-icon '.$uma_estrela.'" data-avaliacao="1"></li>';
    echo '<li class="star-icon '.$dois_estrelas.'" data-avaliacao="2"></li>';
    echo '<li class="star-icon '.$tres_estrelas.'" data-avaliacao="3"></li>';
    echo '<li class="star-icon '.$quatro_estrelas.'" data-avaliacao="4"></li>';
    echo '<li class="star-icon '.$cinco_estrelas.'" data-avaliacao="5"></li>';
    echo '</ul>';
    echo '</div>';

    $preco_bruto = $lista[$destaque4]['preco'];
    $preco = number_format($preco_bruto, 2, ',', '.');
    $avaliacao = $lista[$destaque4]['avaliacoes'];
    if($avaliacao > 4)
        {
        $cinco_estrelas = 'ativo';
        }else $cinco_estrelas = '';
    if($avaliacao > 3 && $avaliacao <= 4)
        {
        $quatro_estrelas = 'ativo';
        }else $quatro_estrelas = '';
    if($avaliacao > 2 && $avaliacao <= 3)
        {
        $tres_estrelas = 'ativo';
        }else $tres_estrelas = '';
    if($avaliacao > 1 && $avaliacao <= 2)
        {
        $dois_estrelas = 'ativo';
        }else $dois_estrelas = '';
    if($avaliacao == 1)
        {
        $uma_estrela = 'ativo';
        }else $uma_estrela = '';
    if($avaliacao == null)
        {
        $cinco_estrelas = 'ativo';
        }
    echo '<div class="col-md-3 custom1 borda">';
    echo '<a href="consulta_produto?produto='.$lista[$destaque4]['id_produto'].'">';
    echo '<img class="img-responsive img-custom" src="'.$lista[$destaque4]['imagem'].'"></a><br>';
    echo '<p><b>Produto:</b> <span class="direita">'.$lista[$destaque4]['nome_produto'].'</span></p>';
    echo '<p><b>Preço:</b> <span class="direita">R$ '.$preco.'</span></p>';
    echo '<span class="negrito">Avaliação: </span>';
    echo '<ul class="avaliacao direita">';
    echo '<li class="star-icon '.$uma_estrela.'" data-avaliacao="1"></li>';
    echo '<li class="star-icon '.$dois_estrelas.'" data-avaliacao="2"></li>';
    echo '<li class="star-icon '.$tres_estrelas.'" data-avaliacao="3"></li>';
    echo '<li class="star-icon '.$quatro_estrelas.'" data-avaliacao="4"></li>';
    echo '<li class="star-icon '.$cinco_estrelas.'" data-avaliacao="5"></li>';
    echo '</ul>';
    echo '</div>';

    $preco_bruto = $lista[$destaque5]['preco'];
    $preco = number_format($preco_bruto, 2, ',', '.');
    $avaliacao = $lista[$destaque5]['avaliacoes'];
    if($avaliacao > 4)
        {
        $cinco_estrelas = 'ativo';
        }else $cinco_estrelas = '';
    if($avaliacao > 3 && $avaliacao <= 4)
        {
        $quatro_estrelas = 'ativo';
        }else $quatro_estrelas = '';
    if($avaliacao > 2 && $avaliacao <= 3)
        {
        $tres_estrelas = 'ativo';
        }else $tres_estrelas = '';
    if($avaliacao > 1 && $avaliacao <= 2)
        {
        $dois_estrelas = 'ativo';
        }else $dois_estrelas = '';
    if($avaliacao == 1)
        {
        $uma_estrela = 'ativo';
        }else $uma_estrela = '';
    if($avaliacao == null)
        {
        $cinco_estrelas = 'ativo';
        }
    echo '<div class="col-md-3 custom1 borda">';
    echo '<a href="consulta_produto?produto='.$lista[$destaque5]['id_produto'].'">';
    echo '<img class="img-responsive img-custom" src="'.$lista[$destaque5]['imagem'].'"></a><br>';
    echo '<p><b>Produto:</b> <span class="direita">'.$lista[$destaque5]['nome_produto'].'</span></p>';
    echo '<p><b>Preço:</b> <span class="direita">R$ '.$preco.'</span></p>';
    echo '<span class="negrito">Avaliação: </span>';
    echo '<ul class="avaliacao direita">';
    echo '<li class="star-icon '.$uma_estrela.'" data-avaliacao="1"></li>';
    echo '<li class="star-icon '.$dois_estrelas.'" data-avaliacao="2"></li>';
    echo '<li class="star-icon '.$tres_estrelas.'" data-avaliacao="3"></li>';
    echo '<li class="star-icon '.$quatro_estrelas.'" data-avaliacao="4"></li>';
    echo '<li class="star-icon '.$cinco_estrelas.'" data-avaliacao="5"></li>';
    echo '</ul>';
    echo '</div>';

    $preco_bruto = $lista[$destaque6]['preco'];
    $preco = number_format($preco_bruto, 2, ',', '.');
    $avaliacao = $lista[$destaque6]['avaliacoes'];
    if($avaliacao > 4)
        {
        $cinco_estrelas = 'ativo';
        }else $cinco_estrelas = '';
    if($avaliacao > 3 && $avaliacao <= 4)
        {
        $quatro_estrelas = 'ativo';
        }else $quatro_estrelas = '';
    if($avaliacao > 2 && $avaliacao <= 3)
        {
        $tres_estrelas = 'ativo';
        }else $tres_estrelas = '';
    if($avaliacao > 1 && $avaliacao <= 2)
        {
        $dois_estrelas = 'ativo';
        }else $dois_estrelas = '';
    if($avaliacao == 1)
        {
        $uma_estrela = 'ativo';
        }else $uma_estrela = '';
    if($avaliacao == null)
        {
        $cinco_estrelas = 'ativo';
        }
    echo '<div class="col-md-3 custom1 borda">';
    echo '<a href="consulta_produto?produto='.$lista[$destaque6]['id_produto'].'">';
    echo '<img class="img-responsive img-custom" src="'.$lista[$destaque6]['imagem'].'"></a><br>';
    echo '<p><b>Produto:</b> <span class="direita">'.$lista[$destaque6]['nome_produto'].'</span></p>';
    echo '<p><b>Preço:</b> <span class="direita">R$ '.$preco.'</span></p>';
    echo '<span class="negrito">Avaliação: </span>';
    echo '<ul class="avaliacao direita">';
    echo '<li class="star-icon '.$uma_estrela.'" data-avaliacao="1"></li>';
    echo '<li class="star-icon '.$dois_estrelas.'" data-avaliacao="2"></li>';
    echo '<li class="star-icon '.$tres_estrelas.'" data-avaliacao="3"></li>';
    echo '<li class="star-icon '.$quatro_estrelas.'" data-avaliacao="4"></li>';
    echo '<li class="star-icon '.$cinco_estrelas.'" data-avaliacao="5"></li>';
    echo '</ul>';
    echo '</div>';

    $preco_bruto = $lista[$destaque7]['preco'];
    $preco = number_format($preco_bruto, 2, ',', '.');
    $avaliacao = $lista[$destaque7]['avaliacoes'];
    if($avaliacao > 4)
        {
        $cinco_estrelas = 'ativo';
        }else $cinco_estrelas = '';
    if($avaliacao > 3 && $avaliacao <= 4)
        {
        $quatro_estrelas = 'ativo';
        }else $quatro_estrelas = '';
    if($avaliacao > 2 && $avaliacao <= 3)
        {
        $tres_estrelas = 'ativo';
        }else $tres_estrelas = '';
    if($avaliacao > 1 && $avaliacao <= 2)
        {
        $dois_estrelas = 'ativo';
        }else $dois_estrelas = '';
    if($avaliacao == 1)
        {
        $uma_estrela = 'ativo';
        }else $uma_estrela = '';
    if($avaliacao == null)
        {
        $cinco_estrelas = 'ativo';
        }
    echo '<div class="col-md-3 custom1 borda">';
    echo '<a href="consulta_produto?produto='.$lista[$destaque7]['id_produto'].'">';
    echo '<img class="img-responsive img-custom" src="'.$lista[$destaque7]['imagem'].'"></a><br>';
    echo '<p><b>Produto:</b> <span class="direita">'.$lista[$destaque7]['nome_produto'].'</span></p>';
    echo '<p><b>Preço:</b> <span class="direita">R$ '.$preco.'</span></p>';
    echo '<span class="negrito">Avaliação: </span>';
    echo '<ul class="avaliacao direita">';
    echo '<li class="star-icon '.$uma_estrela.'" data-avaliacao="1"></li>';
    echo '<li class="star-icon '.$dois_estrelas.'" data-avaliacao="2"></li>';
    echo '<li class="star-icon '.$tres_estrelas.'" data-avaliacao="3"></li>';
    echo '<li class="star-icon '.$quatro_estrelas.'" data-avaliacao="4"></li>';
    echo '<li class="star-icon '.$cinco_estrelas.'" data-avaliacao="5"></li>';
    echo '</ul>';
    echo '</div>';

    $preco_bruto = $lista[$destaque8]['preco'];
    $preco = number_format($preco_bruto, 2, ',', '.');
    $avaliacao = $lista[$destaque8]['avaliacoes'];
    if($avaliacao > 4)
        {
        $cinco_estrelas = 'ativo';
        }else $cinco_estrelas = '';
    if($avaliacao > 3 && $avaliacao <= 4)
        {
        $quatro_estrelas = 'ativo';
        }else $quatro_estrelas = '';
    if($avaliacao > 2 && $avaliacao <= 3)
        {
        $tres_estrelas = 'ativo';
        }else $tres_estrelas = '';
    if($avaliacao > 1 && $avaliacao <= 2)
        {
        $dois_estrelas = 'ativo';
        }else $dois_estrelas = '';
    if($avaliacao == 1)
        {
        $uma_estrela = 'ativo';
        }else $uma_estrela = '';
    if($avaliacao == null)
        {
        $cinco_estrelas = 'ativo';
        }
    echo '<div class="col-md-3 custom1 borda">';
    echo '<a href="consulta_produto?produto='.$lista[$destaque8]['id_produto'].'">';
    echo '<img class="img-responsive img-custom" src="'.$lista[$destaque8]['imagem'].'"></a><br>';
    echo '<p><b>Produto:</b> <span class="direita">'.$lista[$destaque8]['nome_produto'].'</span></p>';
    echo '<p><b>Preço:</b> <span class="direita">R$ '.$preco.'</span></p>';
    echo '<span class="negrito">Avaliação: </span>';
    echo '<ul class="avaliacao direita">';
    echo '<li class="star-icon '.$uma_estrela.'" data-avaliacao="1"></li>';
    echo '<li class="star-icon '.$dois_estrelas.'" data-avaliacao="2"></li>';
    echo '<li class="star-icon '.$tres_estrelas.'" data-avaliacao="3"></li>';
    echo '<li class="star-icon '.$quatro_estrelas.'" data-avaliacao="4"></li>';
    echo '<li class="star-icon '.$cinco_estrelas.'" data-avaliacao="5"></li>';
    echo '</ul>';
    echo '</div>';
?>