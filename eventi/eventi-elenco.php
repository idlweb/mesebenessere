<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/parts.php");

	$pageData["menuItem"] = "eventi";
	$pageData["title"] = "Eventi psicologo Puglia";
	$pageData["description"] = "Gli eventi aperti al pubblico sul tema del benessere psicologico, dedicato a singoli, coppie, di gruppo, scorri la lista e scopri quello più vicino a te.";
	$pageData["property_content"]["og:title"] = "Eventi";
	$pageData["property_content"]["og:type"] = "article";
	$pageData["property_content"]["og:description"] = "Gli eventi aperti al pubblico sul tema del benessere psicologico, dedicato a singoli, coppie, di gruppo, scorri la lista e scopri quello più vicino a te.";
	$pageData["property_content"]["og:site_name"] = "Mese del Benessere Psicologico";
	$pageData["property_content"]["twitter:card"] = "summary";
	$pageData["property_content"]["twitter:title"] = "Eventi - Mese del Benessere Psicologico";
	$pageData["property_content"]["twitter:description"] = "Gli eventi aperti al pubblico sul tema del benessere psicologico, dedicato a singoli, coppie, di gruppo, scorri la lista e scopri quello più vicino a te.";

	if(isSet($_GET["c"]))
		$eventi = cerca_eventi($_GET["c"]);
	else
		$eventi = get_elenco_eventi();

	top($pageData);

	bannerino();
?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 text-center borderBottomGrey">
				<h1 class="mt30 mb30"><span class="quadrato big" style="background-color: <?php echo $mainMenuITA[$pageData["menuItem"]]["color"] ?>"></span> Eventi</h1>
			</div>
		</div>
	</div>	
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<form class="upperForm">
					<div class="row">
						<div class="col-lg-4">
							<span class="mt5 display-block">Cerca l'evento per città:</span>
						</div>
						<div class="col-lg-6">
							<?php
								if(isSet($_GET["c"]))
									$val = strip_tags($_GET["c"]);
								else
									$val = "";
							?>
							<input type="text" name="c" value="<?php echo $val ?>" class="form-control">
						</div>
						<div class="col-lg-2">
							<button type="submit" class="btn btn-orange">Cerca</button>
						</div>
					</div>
				</form>
				<?php
					if(count($eventi) == 0)
					{
						?>
							<p>
								<span class="h3 text-center display-block mb30">Nessun elemento trovato</span>
							</p>
						<?php
					}
					foreach($eventi as $evento)
					{
						$perm = $base."eventi/".permalink($evento["dott"]." ".$evento["titoloEvento"]." ".$evento["cittaEvento"]).".html";
						?>
							<div class="mb30">
								<span class="h5"><?php echo strip_tags($evento["sedeEvento"]) ?> <strong><?php echo strip_tags($evento["cittaEvento"]) ?></strong></span>
								<span class="h5 display-block"><?php echo strip_tags($evento["periodoEvento"]) ?></span>
								<?php
									if($evento["orarioEvento"] != "")
									{
										?>
											<span><?php echo strip_tags($evento["orarioEvento"]) ?></span>
										<?php
									}
								?>
								<h2 class="mt5">
									<a href="<?php echo $perm ?>" class="orangeText"><?php echo (strip_tags($evento["titoloEvento"])) ?></a>
								</h2>
								<hr>
								<span class="h5">Tenuto da: <strong><?php echo strip_tags($evento["titolo"]." ".$evento["dott"]) ?></strong></span>
								<p class="mt5">
									<?php echo smartString(strip_tags($evento["descrizioneEvento"]), 200) ?>
								</p>
								<div class="text-center mt30">
									<a href="<?php echo $perm ?>" class="btn btn-orange">Approfondisci</a>
								</div>								
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