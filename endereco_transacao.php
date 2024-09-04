<?php 

	require_once('db.class.php');//Requisita o script que contém as configurações para conectar com o banco de dados

	$objDb = new database();//Instância objDb com as propriedades database de db.class
	$link = $objDb -> conecta_mysql();//Cria uma conexão com o banco de dados e armazena em link

    $id = $_GET['id'];

	$lista = [];//Cria um array para armazenar o resultado da leitura do banco de dados
	$sql = " SELECT * FROM transacoes where codigo_referencia = '$id' ";//Armazena em sql o codigo que será enviado para o banco de dados

	if($resultado_lista = mysqli_query($link, $sql))					
		{
		$lista = mysqli_fetch_array($resultado_lista);

        $endereco = $lista['endereco'];
		$numero = $lista['numero'];
        $complemento = $lista['complemento'];
        $bairro = $lista['bairro'];
        $cep = $lista['cep'];
        $cidade = $lista['cidade'];
        $estado = $lista['estado'];
        $pais = $lista['pais'];
        $tipoFrete = $lista['tipoFrete'];

        if($estado == "AC")
            {
            $acre = 'selected';
            }else $acre = '';

        if($estado == "AL")
            {
            $alagoas = 'selected';
            }else $alagoas = '';

        if($estado == "AP")
            {
            $amapa = 'selected';
            }else $amapa = '';

        if($estado == "AM")
            {
            $amazonas = 'selected';
            }else $amazonas = '';

        if($estado == "BA")
            {
            $bahia = 'selected';
            }else $bahia = '';

        if($estado == "CE")
            {
            $ceara = 'selected';
            }else $ceara = '';

        if($estado == "DF")
            {
            $distrito_federal = 'selected';
            }else $distrito_federal = '';

        if($estado == "ES")
            {
            $espirito_santo = 'selected';
            }else $espirito_santo = '';

        if($estado == "GO")
            {
            $goias = 'selected';
            }else $goias = '';

        if($estado == "MA")
            {
            $maranhao = 'selected';
            }else $maranhao = '';

        if($estado == "MT")
            {
            $mato_grosso = 'selected';
            }else $mato_grosso = '';

        if($estado == "MS")
            {
            $mato_grosso_sul = 'selected';
            }else $mato_grosso_sul = '';

        if($estado == "MG")
            {
            $minas_gerais = 'selected';
            }else $minas_gerais = '';

        if($estado == "PA")
            {
            $para = 'selected';
            }else $para = '';

        if($estado == "PB")
            {
            $paraiba = 'selected';
            }else $paraiba = '';

        if($estado == "PR")
            {
            $parana = 'selected';
            }else $parana = '';

        if($estado == "PE")
            {
            $pernambuco = 'selected';
            }else $pernambuco = '';

        if($estado == "PI")
            {
            $piaui = 'selected';
            }else $piaui = '';

        if($estado == "RJ")
            {
            $rio_janeiro = 'selected';
            }else $rio_janeiro = '';

        if($estado == "RN")
            {
            $rio_grande_norte = 'selected';
            }else $rio_grande_norte = '';

        if($estado == "RS")
            {
            $rio_grande_sul = 'selected';
            }else $rio_grande_sul = '';

        if($estado == "RO")
            {
            $rondonia = 'selected';
            }else $rondonia = '';

        if($estado == "RR")
            {
            $roraima = 'selected';
            }else $roraima = '';

        if($estado == "SC")
            {
            $santa_catarina = 'selected';
            }else $santa_catarina = '';

        if($estado == "SP")
            {
            $sao_paulo = 'selected';
            }else $sao_paulo = '';

        if($estado == "SE")
            {
            $sergipe = 'selected';
            }else $sergipe = '';

        if($estado == "TO")
            {
            $tocantins = 'selected';
            }else $tocantins = '';

        if($pais == "BRA")
            {
            $brasil = 'selected';
            }else $brasil = '';

        echo '<div class="col-md-6">';
            echo '<br>';
            echo '<div class="col-md-12">';
            echo '<div class="col-md-4">';
                echo '<label for="">Endereço:</label>';
            echo '</div>';
            echo '<div class="col-md-8">';
			    echo "<p>$endereco</p>";
            echo '</div>';
            echo '</div>';
            echo '<br><br>';

            echo '<div class="col-md-12">';
            echo '<div class="col-md-4">';
			    echo '<label for="">Numero:</label>';
            echo '</div>';
            echo '<div class="col-md-8">';
                echo "<p>$numero</p>";
            echo '</div>';
            echo '</div>';
            echo '<br><br>';

            echo '<div class="col-md-12">';
            echo '<div class="col-md-4">';
                echo '<label for="">Complemento:</label>';
            echo '</div>';
            echo '<div class="col-md-8">';
                echo "<p>$complemento</p>";
            echo '</div>';
            echo '</div>';
            echo '<br><br>';

            echo '<div class="col-md-12">';
            echo '<div class="col-md-4">';
                echo '<label for="">Bairro:</label>';
            echo '</div>';
            echo '<div class="col-md-8">';
			    echo "<p>$bairro</p>";
            echo '</div>';
            echo '</div>';
            echo '<br><br>';

            echo '<div class="col-md-12">';
            echo '<div class="col-md-4">';
                echo '<label for="">Cep de destino:</label>';
            echo '</div>';
            echo '<div class="col-md-8">';
			    echo "<p>$cep</p>";
            echo '</div>';
            echo '</div>';
            echo '<br><br>';

            echo '<div class="col-md-12">';
            echo '<div class="col-md-4">';
                echo '<label for="">Cidade:</label>';
            echo '</div>';
            echo '<div class="col-md-8">';
                echo "<p>$cidade</p>";
            echo '</div>';
            echo '</div>';
            echo '<br><br>';

            echo '<div class="col-md-12">';
            echo '<div class="col-md-4">';
                echo '<label for="">Serviço de frete:</label>';
            echo '</div>';
            echo '<div class="col-md-8">';
                echo "<p>$tipoFrete</p>";
            echo '</div>';
            echo '</div>';
            echo '<br><br><br>';

            echo '<div class="col-md-12">';
            echo '<div class="col-md-6">';
                echo '<label for="">Estado:</label>';
                echo '<select class="form-control formulario_custom" name="estado" id="estado" onchange="verifica(this.value)" disabled>';
                    echo '<option value="">Selecione</option>';
                    echo '<option value="AC" '.$acre.'>Acre</option>';
                    echo '<option value="AL" '.$alagoas.'>Alagoas</option>';
                    echo '<option value="AP" '.$amapa.'>Amapá</option>';
                    echo '<option value="AM" '.$amazonas.'>Amazonas</option>';
                    echo '<option value="BA" '.$bahia.'>Bahia</option>';
                    echo '<option value="CE" '.$ceara.'>Ceará</option>';
                    echo '<option value="DF" '.$distrito_federal.'>Distrito Federal</option>';
                    echo '<option value="ES" '.$espirito_santo.'>Espirito Santo</option>';
                    echo '<option value="GO" '.$goias.'>Goiás</option>';
                    echo '<option value="MA" '.$maranhao.'>Maranhão</option>';
                    echo '<option value="MT" '.$mato_grosso.'>Mato Grosso</option>';
                    echo '<option value="MS" '.$mato_grosso_sul.'>Mato Grosso do Sul</option>';
                    echo '<option value="MG" '.$minas_gerais.'>Minas Gerais</option>';
                    echo '<option value="PA" '.$para.'>Pará</option>';
                    echo '<option value="PB" '.$paraiba.'>Paraiba</option>';
                    echo '<option value="PR" '.$parana.'>Paraná</option>';
                    echo '<option value="PE" '.$pernambuco.'>Pernambuco</option>';
                    echo '<option value="PI" '.$piaui.'>Piauí</option>';
                    echo '<option value="RJ" '.$rio_janeiro.'>Rio de Janeiro</option>';
                    echo '<option value="RN" '.$rio_grande_norte.'>Rio Grande do Norte</option>';
                    echo '<option value="RS" '.$rio_grande_sul.'>Rio Grande do Sul</option>';
                    echo '<option value="RO" '.$rondonia.'>Rondônia</option>';
                    echo '<option value="RR" '.$roraima.'>Roraima</option>';
                    echo '<option value="SC" '.$santa_catarina.'>Santa Catarina</option>';
                    echo '<option value="SP" '.$sao_paulo.'>São Paulo</option>';
                    echo '<option value="SE" '.$sergipe.'>Sergipe</option>';
                    echo '<option value="TO" '.$tocantins.'>Tocantins</option>';
                echo '</select>';
            echo '</div>';

            echo '<div class="col-md-6">';
                echo '<label for="">Pais:</label>';
                echo '<select class="form-control formulario_custom" name="pais" id="pais" onchange="verifica(this.value)" disabled>';
                    echo '<option value="">Selecione</option>';
                    echo '<option value="BRA" '.$brasil.'>Brasil</option>';
                echo '</select><br>';
            echo '</div>';
            echo '</div>';
        echo '</div>';


        }
	
?>