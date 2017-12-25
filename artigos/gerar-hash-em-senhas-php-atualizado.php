<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	
	<title>Gerar Hash em senhas PHP Atualizado</title> 

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="Hash em senhas no PHP costuma ser algo que você precisa se preocupar, principalmente quando você começa a pesquisar um pouco sobre segurança.">
	
	<link rel="stylesheet" href="css/estilo.css">

	<meta name="author" content="Vinícius Moura">

	<meta name="robots" content="index,follow,archive">

	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>
<div class="conteudo">	
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
		
		<h1> Gerar Hash em senhas PHP Atualizado</h1>
		
		<p>
		Hash em senhas no PHP costuma ser algo que você precisa se preocupar, principalmente quando você começa a pesquisar um pouco sobre segurança. O Hash que ao contrário da criptografia garante a integridade da informação, faz com que um dado não tenha sua forma original de volta, só a sua verificação. Diferenciando, a criptografia possui conceitos para a confidencialidade, na qual, uma mensagem não pode ser lida a olho nu, mas, pode ter sua forma original de volta.
		</p>

		<h2>Como gerar Hash em senhas PHP </h2>

		<pre>
			<p>//através do password_hash</p>
			<p>$hash = password_hash('feijao',CRYPT_BLOWFISH,['cost'=>10]);</p>
			<p>echo $hash;</p>
			<p>//a saída seria algo assim:</p> 
			<p>$2y$10$H16DJcLwi.wwjl.jfRnUiOU0oAvKV3GPJRbq4SdXzCUIZmEdmY9LC
			</p>
		</pre>

		<p>Primeiramente, a variável hash recebe através do <a href='http://php.net/manual/pt_BR/function.password-hash.php' target='blank' title="password_hash do php">password_hash()</a>(função PHP para gerar hash de senhas), o hash da palavra feijão que é a senha do usuário. O <a href='https://secure.php.net/manual/pt_BR/function.crypt.php' target='blank' title='crypt algoritmos de senha'>CRYPT_BLOWFISH</a> algoritmo utilizado para gerar o hash junto do cost (custo), ciclo de processamento que garante que a palavra feijão seja hasheada unicamente, através disso, outras palavras feijão terão o hash diferente mas comparadas a palavra feijão ainda serão todas feijão. Quanto maior o custo, mais lento o processamento (evitando ataques de <a href='https://www.owasp.org/index.php/Brute_force_attack' title='brute force attack owsp'>brutal force</a>).</p> 

		<h2>Verificando a senha sendo Hash</h2>

		<p>Para verificar o hash de uma senha é simples. Você utilizará do <a href='http://php.net/manual/pt_BR/function.password-verify.php' target='blank' title='password_verify() do php'>password_verify()</a> que precisa de uma suposta senha em seu formato original e o hash da mesma feita com o password_hash(). Em um suposto caso de banco de dados, você selecionaria um usuário cadastrado e depois verificaria se a sua senha enviada condiz com o hash da senha que esta guardada no banco. Assim, você teria o Hash que esta no banco de dados e a senha enviada para utilizar o password_verify(), validando uma suposto local com entrada de senha.</p> 

		<pre>
			<p>//para verificar o hash de senhas</p>
			<p>$hash = password_hash('feijao',CRYPT_BLOWFISH,['cost'=>10]);</p>
			<p>if(password_verify('feijao',$hash)) {</p>
  				<p>echo 'Correto!';</p>
			<p>}else{ </p>
				<p>echo 'Ops, erro.';</p>
			<p>}</p>
		</pre>
	</div>
</div>

<footer class="rodape">
</footer>

</body>
</html>