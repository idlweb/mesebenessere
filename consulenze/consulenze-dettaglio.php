<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/parts.php");
	require_once($_SERVER["DOCUMENT_ROOT"].$root."consulenze/consulenze-controller.php");	

	$pageData["menuItem"] = "consulenze";
	$consulenza = get_consulenza_by_permalink($_GET["permalink"]);
	$pageData["title"] = strip_tags($consulenza["descrizioneConsulenza"])." | Consulenze e psicoterapia | Mese del Benessere Psicologico";
	$pageData["description"] = "Consulenza gratuita a cura del dottor ".strip_tags($consulenza["dott"]).", per l'iniziativa del Mese del Benessere Psicologico di Bari, Lecce, Foggia, Taranto, Brindisi.";
	$pageData["property_content"]["og:title"] = strip_tags($consulenza["dott"]);
	$pageData["property_content"]["og:type"] = "article";
	$pageData["property_content"]["og:description"] = "Consulenza gratuita a cura del dottor ".strip_tags($consulenza["dott"]).", per l'iniziativa del Mese del Benessere Psicologico di Bari, Lecce, Foggia, Taranto, Brindisi.";
	$pageData["property_content"]["og:site_name"] = "Mese del Benessere Psicologico";
	$pageData["property_content"]["twitter:card"] = "summary";
	$pageData["property_content"]["twitter:title"] = "Dottor ".strip_tags($consulenza["dott"])." - Mese del Benessere Psicologico";
	$pageData["property_content"]["twitter:description"] = "Consulenza gratuita a cura del dottor ".strip_tags($consulenza["dott"]).", per l'iniziativa del Mese del Benessere Psicologico di Bari, Lecce, Foggia, Taranto, Brindisi.";

		
	top($pageData);

	bannerino();
	
?>
	<div class="container mb30">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1><span class="quadrato big" style="background-color: <?php echo $mainMenuITA[$pageData["menuItem"]]["color"] ?>"></span> Consulenze</h1>
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
					if($consulenza == false)
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
								<?php
									if($consulenza["periodoConsulenza"] != "1-31 Ottobre")
									{
										?>
											<span class="h3 display-block"><strong><?php echo strip_tags($consulenza["periodoConsulenza"]) ?></strong></span>
										<?php
									}
								?>
								<h2 class="mt0 mb0">
									<span class="greenText">Dott. <?php echo strip_tags($consulenza["dott"]) ?></span>
								</h2>
								<span class="h4 mb0 display-block"><?php echo strip_tags($consulenza["sedeConsulenza"]) ?> <strong><?php echo strip_tags($consulenza["cittaConsulenza"]) ?></strong></span>
								<span class="h4 mt5 display-block"><?php echo strip_tags($consulenza["indirizzoConsulenza"].", ".$consulenza["capConsulenza"]." ".$consulenza["cittaConsulenza"]." ".$consulenza["provinciaConsulenza"]) ?></span>
								<hr>
								<p class="mt0">
									<?php echo strip_tags($consulenza["descrizioneConsulenza"]) ?>
								</p>	
								<p class="mt20">
									<span class="h4">Tenuto da: <strong>Dott. <?php echo strip_tags($consulenza["dott"]) ?></strong> (<?php echo strip_tags($consulenza["email"]) ?>)</span>
								</p>
								<p class="mt20">
									<?php
										if($consulenza["relatoriConsulenza"] != "")
										{
											?>
												<strong>Relatori: </strong><?php echo $consulenza["relatoriConsulenza"] ?>
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