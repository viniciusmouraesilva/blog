<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	
	<title>RFI em PHP</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="RFI ou Remote File Inclusion, vulnerabilidade que usa da inclusão remota de arquivos para um determinado Webiste que esteja vulnerável ao mesmo. 
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
		<h1> RFI em PHP </h1>
		
		<p>RFI ou Remote File Inclusion, vulnerabilidade que usa da inclusão remota de arquivos para um determinado Webiste que esteja vulnerável ao mesmo. Essa inclusão pode se dar por meio da falta de validação dos dados.  Por exemplo, se você recebe por parâmetro um determinado dado vindo da url e inclui-lo diretamente sem filtrar essa entrada.</p> 
        <pre> 

        <p>if(array_key_exists('pagina',$_GET)) {</p> 

            <p>$url = $_GET['pagina'];</p> 

            <p>include $url;</p> 

        <p>}</p> 

        </pre>       

        <p>Nó código acima, se existir o índice ‘pagina’ no $_GET, a variável url vai receber o $_GET[‘pagina’] e fazer a sua inclusão utilizando o comando include com o conteúdo da url.</p> 

        <p>Você talvez ainda não percebeu o problema do código acima. Agora, o que aconteceria se eu passasse o seguinte argumento para o $_GET no índice página: </p> 

        <p class='url_falsa'>http://localhost/url.php?pagina=http://www.google.com.br/</p> 

        <p>Se você utilizar a url acima com o código php do início você poderá ter a página do Google carregada na sua tela.</p> 

        <p>Tá, mas é a página do Google você fala. E se fosse uma página com códigos que prejudicasse a sua aplicação.  Através dessa inclusão poderia ser  executado scripts com códigos maliciosos que podem prejudicar e podendo também explorar outros ataques como <a href='https://www.owasp.org/index.php/Denial_of_Service' titile='OWSP sobre Dos Denial of Service' target='blank'>DoS</a> ou  <a href='https://www.owasp.org/index.php/Cross-site_Scripting_(XSS)'' title='OWSP sobre XSS CROSS-SITE-SCRIPTING' target='blank'> XSS.</a></p> 

        <p>Para evitar esse tipo de ataque, você pode mudar uma diretiva do arquivo <a href='https://secure.php.net/manual/pt_BR/configuration.file.php' title='arquivo de configuração PHP ini' target='blank'>php.ini</a> do PHP para não incluir urls enviadas. Se você colocar Off na seguinte diretiva do PHP: <a href='https://secure.php.net/manual/pt_BR/filesystem.configuration.php' target='blank' title='allow_url_include configuração PHP'>allow_url_include</a> você ao tentar passar uma url nesse contexto no $_GET, você terá três Warning  do PHP.</p>   

        <p class='destaque'>Warning: include(): https:// wrapper is disabled in the server configuration by allow_url_include=0 in /var/www/html/url.php on line 6</p> 

        <p class='destaque'>Warning: include(https://www.google.com.br/): failed to open stream: no suitable wrapper could be found in /var/www/html/url.php on line 6</p> 

        <p class='destaque'>Warning: include(): Failed opening 'https://www.google.com.br/' for inclusion (include_path='.:/usr/share/php') in /var/www/html/url.php on line 6</p> 

        <p>O primeiro é referente a configuração do allow_url_include para Off que impediu a inclusão da url contendo o site do Google.</p> 

        <p>O segundo é que não foi possível abrir o arquivo por estar fora da estrutura de diretórios.</p> 

        <p>E o terceiro, na qual houve uma falha ao abrir o conteúdo enviado que é o caminho para o site do Google.</p> 

        <p>Você pode até desabilitar os erros na tela mas, eu particularmente tentaria tratar o quesito dados enviados que podem ser inclusos com include através de uma Whitelist(lista branca em português).</p> 

        <p>Suponha que o seu site tenha somente as seguintes áreas para acesso: home, contato e sobre. Você poderia fazer o seguinte para que o usuário só acessasse as páginas que são viáveis listadas nesse parágrafo acima: </p> 

        <pre> 

        <p>switch($url)  {</p> 

            <p>case 'home':</p> 

            <p>include $url . '.php';</p> 

            <p>break;</p> 

        <p>case 'sobre':</p> 

            <p>include $url . '.php';</p> 

            <p>break;</p> 

        <p>case 'contato':</p> 

            <p>include $url . '.php';</p> 

            <p>break;</p> 

        <p>default:</p> 

            <p>print '404';</p> 

            <p>break;</p> 

    <p>}</p> </pre> 

    <p>Assim, se tivesse uma solicitação para a página do Google seria exibido 404. Você pode trocar esse 404 para uma página HTML ou PHP para exibir esse erro de forma customizada.</p> 

    <h2>Extra</h2>  

    <p>De bônus tem uma diretiva do php.ini que você pode configurar adicionalmente para se proteger. Ela pode se encaixar em prol de evitar o ataque de RFI então vamos lá.</p> 

    <p>Você também pode colocar Off na diretava allow_url_fopen no seu php.ini, evitando que seja incluído arquivos através da entrada do comando fopen.</p> 

    <p>Sinceramente não sei como mostrar um exemplo, então, fica para você pesquisar entre o vasto mundo da internet. Por hoje é só.</p> 

	</div>
</div>

<footer class="rodape">
</footer>

</body>
</html>