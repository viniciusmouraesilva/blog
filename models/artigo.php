<?php
class Artigo {
		
	private $id = 0;
	private $titulo;
	private $conteudo;
	private $descricao;
	private $nome;
	private $url;
	private $data_artigo;
		
	public function setId($id) {
		$this->id = $id;	
	}

	public function getId() {
		return $this->id;	
	}

	public function setTitulo($titulo) {
		$this->titulo = $titulo;	
	}

	public function getTitulo() {
		return $this->titulo;	
	}	
		
	public function setConteudo($conteudo) {
		$this->conteudo = $conteudo;		
	}

	public function getConteudo() {
		return $this->conteudo;	
	}	
		
	public function setDescricao($descricao) {
		$this->descricao = $descricao;	
	}

	public function getDescricao() {
		return $this->descricao;	
	}	
		
	public function setNome($nome) {
		$this->nome = $nome;	
	}

	public function getNome() {
		return $this->nome;	
	}	
		
	public function setUrl($url) {
		$this->url = $url;		
	}

	public function getUrl() {
		return $this->url;	
	}	
		
	public function setData_Artigo($artigo) {
		$this->artigo = $artigo;		
	}

	public function getData_Artigo() {
		return $this->data_artigo;
	}			
}