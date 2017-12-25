<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Blog do Fenestim | Artigos sobre PHP atualizados </title>
	
	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta name="author" content="Vinícius Moura">

	<meta name="description" content="Blog com artigos sobre PHP com as técnicas mais atualizadas para seus problemas mais atuais.">

	<meta name="robots" content="index,follow">

	<link rel="stylesheet" href="css/estilo.css">
	
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
	
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

		<!-- área onde ficara os artigos -->
		<div class="conteudo artigos"> 
			<p>ÚLTIMOS ARTIGOS</p>
			<hr>

			<!-- Exibição da página no objeto artigos 
			sem paginação -->

			<?php if(!isset($pagina)): ?>
				<?php foreach($artigos as $artigo): ?>
					
					<h1><?php echo htmlentities($artigo->getTitulo()); ?></h1>
					
					<h5><?php echo formatar_data($artigo->getData_Artigo()); ?></h5>
					
					<p><?php echo htmlentities($artigo->getDescricao()); ?></p>
					
					<a href="<?php echo htmlentities($artigo->getNome()); ?>"> Ler artigo completo </a>
				<?php endforeach; ?>
			<?php endif; ?>
	
			<!-- Já na verificação abaixo eu vou utilizar os artigos salvos dentro $array_sessao_artigos pois já pode possuir paginação -->

			<?php if(isset($pagina) && $pagina <= $indices): ?>
				<?php foreach($array_sessao_artigos[$pagina] as $artigo): ?>
						
						<h1><?php echo htmlentities($artigo->getTitulo()); ?></h1>
						
						<h5><?php echo formatar_data($artigo->getData_Artigo()); ?></h5>

						<p><?php echo htmlentities($artigo->getDescricao()); ?></p>
					
						<a href="<?php echo htmlentities($artigo->getNome()); ?>">Ler artigo completo</a>

				<?php endforeach; ?>
			<?php endif; ?>
			
			<!-- Se o número de artigos for maior que
			seis já possível fazer a paginação -->

			<?php if($numero_artigos_pag > 6): ?>
				<br>
				<?php if(isset($pagina) && $pagina > 1): ?>
				
					<?php if($pagina <= $indices): ?>
						
						<a href="pag<?php echo $pagina - 1; ?>">Anterior</a>
					<?php else: ?>

						<?php echo ""; ?>
					<?php endif; ?>
				<?php endif; ?>
		
				<?php foreach ($paginas_inverte as $paginas): ?>
				
					<a href="pag<?php echo $paginas; ?>" class="button_pag"><?php echo $paginas; ?></a>
			
				<?php endforeach; ?>
		
				<?php if(isset($pagina) && $pagina > 1 && $indices > $pagina): ?>
						<?php if($pagina <= $indices): ?>
					
							<a href="pag<?php echo $pagina + 1; ?>">Proxima</a>
						<?php else:  ?>

							<?php echo ""; ?>
						<?php endif; ?>

				<?php elseif(!isset($pagina) or $pagina == 1): ?>
				
					<a href="pag2"">Próxima</a>
				<?php endif; ?>
			<?php endif; ?>
	
		</div>
	</div>
	
<footer class="rodape">
</footer>
</body>
</html>