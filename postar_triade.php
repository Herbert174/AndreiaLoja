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
    
    $sql = " SELECT * FROM produtos_destaque ";

    if($resultado_lista = mysqli_query($link, $sql))
        {
        $destaque = mysqli_fetch_all($resultado_lista, MYSQLI_ASSOC);
        }

    $id = $_GET['id'] - 1;

    $destaque1 = $destaque[$id]['novidade1'] - 1;
    $destaque2 = $destaque[$id]['novidade2'] - 1;
    $destaque3 = $destaque[$id]['novidade3'] - 1;

    $preco_bruto = $lista[$destaque1]['preco'];
    $preco = number_format($preco_bruto, 2, ',', '.');
    echo '<div class="col-md-4">';
    echo '<a href="Produtos?secao=1">';
    echo '<img class="img-responsive img-custom3" src="'.$lista[$destaque1]['imagem'].'"></a><br>';
    echo '</div>';

    $preco_bruto = $lista[$destaque2]['preco'];
    $preco = number_format($preco_bruto, 2, ',', '.');
    echo '<div class="col-md-4">';
    echo '<a href="Produtos?secao=3">';
    echo '<img class="img-responsive img-custom3" src="'.$lista[$destaque2]['imagem'].'"></a><br>';
    echo '</div>';

    $preco_bruto = $lista[$destaque3]['preco'];
    $preco = number_format($preco_bruto, 2, ',', '.');
    echo '<div class="col-md-4">';
    echo '<a href="Produtos?secao=2">';
    echo '<img class="img-responsive img-custom3" src="'.$lista[$destaque3]['imagem'].'"></a><br>';
    
?>