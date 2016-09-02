<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/parts.php");
	require_once($_SERVER["DOCUMENT_ROOT"].$root."consulenze/consulenze-controller.php");	

	$pageData["menuItem"] = "consulenze";
	$pageData["title"] = "Consulenze e psicoterapia";
	$pageData["description"] = "Nel Mese del Benessere dal 1 al 31 ottobre si offrono consulenze gratuite degli psicologi di Bari, Lecce, Foggia, Taranto e Brindisi, scopri i dettagli.";
	$pageData["property_content"]["og:title"] = "Consulenze";
	$pageData["property_content"]["og:type"] = "article";
	$pageData["property_content"]["og:description"] = "Nel Mese del Benessere dal 1 al 31 ottobre si offrono consulenze gratuite degli psicologi di Bari, Lecce, Foggia, Taranto e Brindisi, scopri i dettagli.";
	$pageData["property_content"]["og:site_name"] = "Mese del Benessere Psicologico";
	$pageData["property_content"]["twitter:card"] = "summary";
	$pageData["property_content"]["twitter:title"] = "Consulenze - Mese del Benessere Psicologico";
	$pageData["property_content"]["twitter:description"] = "Nel Mese del Benessere dal 1 al 31 ottobre si offrono consulenze gratuite degli psicologi di Bari, Lecce, Foggia, Taranto e Brindisi, scopri i dettagli.";

	if(isSet($_GET["c"]))
		$consulenze = cerca_consulenze($_GET["c"]);
	else
		$consulenze = get_elenco_consulenze();

	top($pageData);

	bannerino();
?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 text-center borderBottomGrey">
				<h1 class="mt30 mb30"><span class="quadrato big" style="background-color: <?php echo $mainMenuITA[$pageData["menuItem"]]["color"] ?>"></span> Consulenze</h1>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<form class="upperForm">
					<div class="row">
						<div class="col-lg-5">
							<span class="mt5 display-block">Cerca consulenze per città:</span>
						</div>
						<div class="col-lg-5">
							<?php
								if(isSet($_GET["c"]))
									$val = strip_tags($_GET["c"]);
								else
									$val = "";
							?>
							<input type="text" name="c" value="<?php echo $val ?>" class="form-control">
						</div>
						<div class="col-lg-2">
							<button type="submit" class="btn btn-green">Cerca</button>
						</div>
					</div>
				</form>
				<?php
					if(count($consulenze) == 0)
					{
						?>
							<p>
								<span class="h3 text-center display-block mb30">Nessun elemento trovato</span>
							</p>
						<?php
					}
					foreach($consulenze as $consulenza)
					{
						$perm = $base."consulenze/".permalink($consulenza["dott"]." ".$consulenza["cittaConsulenza"]).".html";
						?>
							<div class="mb60">
								<span class="h5"><?php echo strip_tags($consulenza["sedeConsulenza"]) ?> <strong><?php echo strip_tags($consulenza["cittaConsulenza"]) ?></strong></span>
								<h2 class="mt5 mb0">
									<a href="<?php echo $perm ?>" class="greenText">Dott. <?php echo strip_tags($consulenza["dott"]) ?></a>
								</h2>
								<hr>
								<p class="mt0 h5">
									<?php echo smartString(strip_tags($consulenza["descrizioneConsulenza"]), 200) ?>
								</p>
								<div class="mt15">
									<a href="<?php echo $perm ?>" class="btn btn-green">Approfondisci</a>
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