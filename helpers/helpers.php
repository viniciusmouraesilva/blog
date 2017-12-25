<?php 

function formatar_data($data) {

	if($data == '' or $data == '0000-00-00 00:00:00') {
		return '';
	}

	$dados = explode(' ', $data);

	$novo_array_dados = explode('-', $dados[0]);
	
	//montar data
	$data = $novo_array_dados[2] . '/' . $novo_array_dados[1] . '/' . $novo_array_dados[0];

	return $data;

}