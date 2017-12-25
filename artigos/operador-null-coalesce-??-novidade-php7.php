<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	
	<title>Operador Null Coalesce ?? Novidade PHP7</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="Neste artigo vamos falar sobre uma novidade do PHP7 o operador null coalesce que apareceu facilitando caminhos, inicialização e verificação...
		">
	
	<link rel="stylesheet" href="css/estilo.css">

	<meta name="author" content="Vinícius Moura">

	<meta name="robots" content="index,follow,archive">

	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> 

	<meta http-equiv="Content-Security-Policy" content="default-src 'self'; img-src 'none'; script-src 'none'; form-action 'none'; style-src 'self' http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css;">       	
</head>
<body>
<div class="conteudo">
	
	<!-- área de navegação menu -->
	<div class="conteudo menu">
		<p><a href="home">Blog do Fenestim</a></p>	
		<nav>
			<ul>
				<li><a href="home" class="casa">Casa</a></li>
				<li><a href="sobre">Sobre</a></li>
				<!-- <li><a href="contato">Contato</a></li>-->
			</ul>
		</nav>
	</div>

	<div class="conteudo artigos texto_artigos">
		<h1> Operador Null Coalesce ?? Novidade PHP7 </h1>
		
		<p>Neste artigo vamos falar sobre uma novidade do PHP7 o operador null coalesce que apareceu facilitando caminhos, inicialização e verificação de condições para uma variável em uma única linha.
		Primeiramente, se você conhece os arrays <a href='https://secure.php.net/manual/pt_BR/language.variables.superglobals.php' title='variavéis superglobais php' target='blank'>superglobais</a> do PHP, sabe ou não que as vezes precisamos verificar se ele existe para alguma lógica específica, mas também, para evitar erros de variáveis não inicializados. Exemplo abaixo de uma variável recebendo o array superglobal $_POST:</p>

		<pre>
			<br>
			<p>$var = $_POST['qualquer_coisa'];</p>	
		</pre>

		<p>Caso o array superglobal $_POST['qualquer_coisa'] não fosse enviado, a variável $var não seria inicializada e você teria um erro de variável não definida. Para solucionar isso você poderia escrever o seguinte código: </p>

		<pre>
			<br>
			<p>$var = (isset($_POST['qualquer_coisa']))?$_POST['qualquer_coisa']:'valor padrão';</p>
		</pre>

		<p>Para exemplificar, a função <a href='http://php.net/manual/pt_BR/function.isset.php' target='blank' title='função isset do PHP'>isset()</a> verifica se uma variável foi definida, no caso, isset($_POST['<br>qualquer_coisa']) , agora, logo após o fechamento do colchete você tem uma interrogação ? e logo depois da repetição do  $_POST['qualquer_coisa'] você tem : dois pontos. 
		O que significa a ? interrogação e o : dois pontos? Juntando a lógica da linha do código acima temos uma estrutura if simples em uma linha só. Como assim? A função isset() funciona como uma condição de uma estrutura if. Observe: Se for configurado, definido $_POST['qualquer_coisa'], a variável $var recebe o que tem no $_POST['qualquer_coisa'] valor que se encontra depois da interrogação, logo depois else, senão a variável $var recebe um valor padrão após os : dois pontos. A utilização da interrogação e os dois pontos é conhecido como operador ternário em PHP.</p>

		<h2>Operador null coalesce ?? </h2>

		<p>Já em PHP7 com o operador null coalesce pode ficar totalmente simplificado de se fazer a verificação do código acima.</p>

		<pre>
			<br>
			<p>$var = $_POST['qualquer_coisa'] ?? 'valor padrão';</p>
		</pre>

		<p>Tente entender, você não escreve mais o array $_POST['qualquer coisa'], mas também, não precisa da função isset() para verificar a existência da variável global. Simplesmente com as duas ?? interrogações e o resultado para as condições é verificado se existe $_POST['qualquer_coisa'], senão ele recebe o valor padrão. Com o operador null coalesce fica até mais lógico.</p>

		<p>Você pode fazer mais coisas legais com o null coalesce: </p> 

		<pre>
			<br>
			<p>$var = $_POST['qualquer_coisa']  ?? $_GET['qualquer_coisa'] ?? 'valor padrão';</p>
		</pre>

		<p>O que isso significa? Significa que você pode ter diversos caminhos contendo valores a serem colocados na variável $var. Se existir $_POST['qualquer_coisa']  ele seta a váriavel. Caso não, ele tenta com o $_GET['qualquer_coisa']. No final de tudo, se não existir nem um nem outro, coloca o valor padrão.</p>

		<p>O PHP7 tem bastante novidades e você pode conhecer algumas dessas em: <a href='https://secure.php.net/manual/pt_BR/migration70.new-features.php' title='Novidades PHP7' target='blank'>Novidades PHP7</a></p>
	</div>
</div>

<footer class="rodape">
</footer>

</body>
</html>