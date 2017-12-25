<?php
require_once 'config/config.php';

$rota = 'index';

if(isset($_GET)) {

	$request = filter_input(INPUT_SERVER,'REQUEST_URI');

	$pos = strpos($request, '/', 1);

	//o file vai ser utilizado somente nas buscas
	//de artigos
	$file = substr($request, $pos+1);

	if(array_key_exists('home', $_GET)) {
		$rota = 'home';
	}

	//if(array_key_exists('contato', $_GET)) {
		//$rota = 'contato';
	//}

	if(array_key_exists('sobre', $_GET)) {
		$rota = 'sobre';
	}

	if(is_file("controllers/{$rota}.php") && $rota !== 'home') {
		require "controllers/{$rota}.php";
	}

	//O home não pode ser requerido
	//por causa que ainda não foi feito
	//os artigos. Somente no final 
} 

//index ou home por causa de não haver get
//com a rota por padrao index é possível seguir
//e verificar o que pode ser feito
if($rota === 'index' or $rota === 'home') {
	
	require_once 'helpers/config.php';
	require_once 'helpers/banco.php';
	require_once 'models/artigo.php';
	require_once 'models/repositorio_artigos.php';
	require_once 'helpers/helpers.php';

	//instancia de objetos

	$artigos_pag = new Artigo();

	$repositorio_artigos = new RepositorioArtigos($pdo);

	/*utilizando o file para consulta e requerir
	artigo*/
	$file = filter_var($file,FILTER_SANITIZE_STRING);

	$resu = $repositorio_artigos->verificarArtigo($file);

	if($resu) {

		if(is_file("artigos/{$file}.php")) {
			require "artigos/{$file}.php";
		}else {
			require '404.html';
		}
	
	}else {

		$artigos_pag = $repositorio_artigos->buscarArtigos();

		// número total de artigos
		// utilizado na view para ver se o total
		// de artigos é maior que 6 

		$numero_artigos_pag = count($artigos_pag);
	
		$p = 1; 
		/* para controle da página do 	array_sessao_artigo */

		$artigo = [];

		/* $artigo vai recber o artigo e guarda no 				array abaixo */

		$array_sessao_artigos = []; //guarda todos artigos
	
		$indices = 0; //indices para gerar as paginas
	
		//fazer as páginas com 6 artigos cada
		for($i=0;$i<sizeof($artigos_pag);$i++) {
		
			$artigo[$i] = $artigos_pag[$i];
		
			// se artigo já tiver recebido 6
			// artigos o $array_sessao_artigos
			// recebe na $p, pagina referente a p
			// todos os valores ($valor) que são artigos 

			if(count($artigo) == 6) {
				foreach($artigo as $valor) {
					$array_sessao_artigos[$p][] = $valor;
				}

			$p++;
			$artigo = [];
			}
		}

		//controlar caso tenha sobrado artigos mas não completou uma página de seis artigos

		if(count($artigo)>0) {
			foreach($artigo as $valor) {
				$array_sessao_artigos[$p][] = $valor;
			}
		}
		
		$indices = count($array_sessao_artigos);

		$paginas = [];

		// salvando as páginas 
		// que serão possíveis 
		// ser utilizadas
		while($indices>=1) {
			$paginas[] = $indices;
			$indices--;
		}
	
		$indices = count($array_sessao_artigos);
	
		$paginas_inverte = array_reverse($paginas);
		
		if(isset($_GET) && count($_GET)>0) {
			
			$i = 1;

			while($i<=$indices) {

				if(array_key_exists("pag{$i}",$_GET)) {

					$referencia_pag = $i;

				}

				$i++;
			}

			if(isset($referencia_pag) > 0) {

				$numero_pagina = (int)$referencia_pag;

				if($numero_pagina <= $indices && filter_var($numero_pagina, FILTER_VALIDATE_INT)) {

					$pagina = $numero_pagina;

					require 'views/template_index.php';
				}else { //só por preucação
					require '404.html';
				}

			}elseif($rota === 'home') {
				$artigos = new Artigo();
				$artigos = $repositorio_artigos->buscarArtigosPagInicial();

				require 'views/template_index.php';
			}else {
				require '404.html';
			}
		}else {
			$artigos = new Artigo();
			$artigos = $repositorio_artigos->buscarArtigosPagInicial();

			require 'views/template_index.php';
		}
	}
}