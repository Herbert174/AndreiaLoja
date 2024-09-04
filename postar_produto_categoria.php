<?php
    require_once('db.class.php');

    $secao = $_GET['secao'];

    $objDb = new database();
    $link = $objDb -> conecta_mysql();

    $lista = [];
    $sql = " SELECT * FROM produtos where secao = '$secao' ";

    if($resultado_lista = mysqli_query($link, $sql))
        {
        $lista = mysqli_fetch_all($resultado_lista, MYSQLI_ASSOC);
        }
    $_SESSION['lista'] = $lista;

    $count = 1;
    foreach ($lista as $produtos)
        {
        $preco_bruto = $produtos['preco'];
        $preco = number_format($preco_bruto, 2, ',', '.');
        $avaliacao = $produtos['avaliacoes'];
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
        echo '<a href="consulta_produto?produto='.$produtos['id_produto'].'">';
        echo '<img class="img-responsive img-custom" src="'.$produtos['imagem'].'"></a><br>';
        echo '<p><b>Produto:</b> <span class="direita">'.$produtos['nome_produto'].'</span></p>';
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
        if($count == 0)
            {
            echo '</div>';
            }
        }
?>