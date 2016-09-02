<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/parts.php");

	$pageData["menuItem"] = "eventi";
	$evento = get_evento_by_permalink($_GET["permalink"]);

	$pageData["title"] = strip_tags($evento["titoloEvento"])." | Eventi psicologo Puglia";
	$pageData["description"] = strip_tags($evento["titoloEvento"]).", evento del Mese del Benessere Psicologico dal 1 al 31 ottobre, clicca, scopri i dettagli e partecipa.";
	$pageData["property_content"]["og:title"] = strip_tags($evento["titoloEvento"]);
	$pageData["property_content"]["og:type"] = "article";
	$pageData["property_content"]["og:description"] = strip_tags($evento["titoloEvento"]).", evento del Mese del Benessere Psicologico da 1 a 31 ottobre, clicca, scopri i dettagli e partecipa.";
	$pageData["property_content"]["og:site_name"] = "Mese del Benessere Psicologico";
	$pageData["property_content"]["twitter:card"] = "summary";
	$pageData["property_content"]["twitter:title"] = strip_tags($evento["titoloEvento"])." - Mese del Benessere Psicologico";
	$pageData["property_content"]["twitter:description"] = strip_tags($evento["titoloEvento"]).", evento del Mese del Benessere Psicologico dal 1 al 31 ottobre, clicca, scopri i dettagli e partecipa.";

		
	top($pageData);

	bannerino();
	
?>
	<div class="container mb30">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1><span class="quadrato big" style="background-color: <?php echo $mainMenuITA[$pageData["menuItem"]]["color"] ?>"></span> Eventi</h1>
				<?php
					if(isSet($_GET["c"]))
					{
						?>
							<span>Cerca nella città di <strong><?php echo strip_tags($_GET["c"]) ?></strong></span>
						<?php
					}
				?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<?php
					if($evento == false)
					{
						?>
							<p>
								<span class="h3 mb30 text-center display-block">Nessun elemento trovato</span>
							</p>
						<?php
					}
					else
					{
						?>
							<div class="mb60">
								<span class="h3 display-block"><strong><?php echo strip_tags($evento["periodoEvento"]) ?></strong></span>
								<?php
									if($evento["orarioEvento"] != "")
									{
										?>
											<span><?php echo strip_tags($evento["orarioEvento"]) ?></span>
										<?php
									}
								?>
								<span class="h4 mb0 display-block"><?php echo strip_tags($evento["sedeEvento"]) ?> <strong><?php echo strip_tags($evento["cittaEvento"]) ?></strong></span>
								<span class="h4 mt5 display-block">
									<?php
										if($evento["indirizzoEvento"] != "")
											echo strip_tags($evento["indirizzoEvento"]).", ";
										echo strip_tags($evento["capEvento"]." ".$evento["cittaEvento"]." ".$evento["provinciaEvento"]) ;
									?>
								</span>
								<h2>
									<span class="orangeText"><?php echo strip_tags($evento["titoloEvento"]) ?></span>
								</h2>
								<hr>
								<p class="mt40">
									<?php echo strip_tags($evento["descrizioneEvento"], "<br><strong><a>") ?>
								</p>
								<?php
									if($evento["idPsicologo"] != "10892")
									{
										?>
											<p class="mt20">
												<span class="h4">Tenuto da: <strong><?php echo strip_tags($evento["titolo"]." ".$evento["dott"]) ?></strong> (<?php echo strip_tags($evento["email"]) ?>)</span>
											</p>
										<?php
									}
									else
									{
										?>
											<p class="mt20">
												<span class="h4">Interverrà la Dott.ssa <strong>Marisa Yldirim</strong> (consigliere dell'ordine Psicologi Puglia). Per info <a href="http://www.psicologipuglia.it" target=_blank>www.psicologipuglia.it</a>.</span>
											</p>
										<?php
									}
								?>
								<p class="mt20">
									<?php
										if($evento["relatoriEvento"] != "")
										{
											?>
												<strong>Relatori: </strong><?php echo $evento["relatoriEvento"] ?>
											<?php									
										}
									?>
								</p>
							</div>
						<?php
					}
				?>
			</div>
		</div>
	</div>
<?php
	mappa_eventi($pageData);
	bottom($pageData);
?>