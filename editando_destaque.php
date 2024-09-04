<?php

	require_once('db.class.php');

	$objDb = new database();
	$link = $objDb -> conecta_mysql();

	$destaque1 = $_POST['destaque1'];
    $destaque2 = $_POST['destaque2'];
    $destaque3 = $_POST['destaque3'];
    $destaque4 = $_POST['destaque4'];
    $destaque5 = $_POST['destaque5'];
    $destaque6 = $_POST['destaque6'];
    $destaque7 = $_POST['destaque7'];
    $destaque8 = $_POST['destaque8'];
    $id = $_GET['id'];

	$sql = " UPDATE destaques SET destaque1 = '$destaque1', destaque2 = '$destaque2', destaque3 = '$destaque3', ";
    $sql .= " destaque4 = '$destaque4', destaque5 = '$destaque5', destaque6 = '$destaque6', destaque7 = '$destaque7', ";
    $sql .= " destaque8 = '$destaque8' WHERE id_destaques = '$id' ";

	if($resultado_id = mysqli_query($link, $sql))
		{
		header("Location: crud");
		}
?>