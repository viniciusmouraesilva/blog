<?php
	
class RepositorioArtigos {

	private $pdo;

	public function __construct($pdo) {
		$this->pdo = $pdo;
	}

	public function buscarArtigos() {
		
		$sqlBuscar = "SELECT * FROM artigos ORDER BY data_artigo DESC";
		
		$query = $this->pdo->prepare($sqlBuscar);
		
		$query->execute();
		
		$artigos = [];
		$i = 0;
		
		while($artigo = $query->FetchObject('Artigo'))
		{
			$artigos[$i] = $artigo;
			$i++;
		}

		return $artigos;
	}

	function buscarArtigosPagInicial() {
		
		$sqlBuscar = "SELECT * FROM artigos ORDER BY data_artigo DESC LIMIT 6";
	
		$query = $this->pdo->prepare($sqlBuscar);
		
		$query->execute();
		
		$artigos = [];
		
		while($artigo = $query->FetchObject('Artigo'))
		{
			$artigos[] = $artigo;
		}	
		
		return $artigos;
	}

	public function buscar_artigos_por_url($artigo_url)
	{

		$sqlBuscar = "SELECT * FROM artigos WHERE url = :artigo_url";
		
		$query = $this->pdo->prepare($sqlBuscar);
		
		$query->execute(['artigo_url'=>$artigo_url]);
		
		$artigo = $query->FetchObject('Artigo');
		
		return $artigo;
	}

	public function verificarArtigo($artigo)
	{
		try {


			$sqlBuscar = "SELECT * FROM artigos WHERE nome = :artigo LIMIT 1";
		
			$query = $this->pdo->prepare($sqlBuscar);
		
			$query->execute(['artigo'=>$artigo]);
		
			$erros = $query->errorInfo();

			if($erros[0] != 00000) {
				throw new Exception();
			}

			if($query->rowCount() == 1) {
				return true;
			}else {
				throw new Exception();
			}

		}catch(Exception $ex) {
			return false;
		}
	}
}