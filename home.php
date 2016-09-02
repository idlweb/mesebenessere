<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/parts.php");
	require_once($_SERVER["DOCUMENT_ROOT"].$root."consulenze/consulenze-controller.php");	
	$pageData["menuItem"] = "home";

	$pageData["title"] = "Psicologi Puglia";
	$pageData["description"] = "Il Mese del Benessere Psicologico è l'iniziativa promossa dall'Ordine Psicologi che prevede consulenze gratuite ed eventi sul tema in tutta la regione.";
	$pageData["property_content"]["og:title"] = "Homepage Mese del Benessere Psicologico";
	$pageData["property_content"]["og:type"] = "website";
	$pageData["property_content"]["og:description"] = "Il Mese del Benessere Psicologico è l'iniziativa promossa dall'Ordine Psicologi che prevede consulenze gratuite ed eventi sul tema in tutta la regione.";
	$pageData["property_content"]["og:site_name"] = "Mese del Benessere Psicologico";
	$pageData["property_content"]["twitter:card"] = "summary";
	$pageData["property_content"]["twitter:title"] = "Mese del Benessere Psicologico";
	$pageData["property_content"]["twitter:description"] = "Il Mese del Benessere Psicologico è l'iniziativa promossa dall'Ordine Psicologi che prevede consulenze gratuite ed eventi sul tema in tutta la regione.";

	top($pageData);
	$eventi = get_elenco_eventi(3);
	$consulenze = get_elenco_consulenze(3);
?>
	<div class="container-fluid distanceMe homeMain" id="titolo">
		<div class="innercontainer">
			<div class="row">
				<div class="col-lg-6">
					<div class="p10">
						<h1 class="h1 mb30">Gli <strong>Psicologi di Puglia</strong> ti aspettano con incontri e consulenze <strong>gratuite</strong></h1>
						<p class="text-center">
							<a href="<?php echo $base.$mainMenuITA["iniziativa"]["url"] ?>" class="btn btn-violet">Scopri l'iniziativa</a>
						</p>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="p10">
						<h2 class="h2 mt30 mb30">Cos'è il mese del benessere psicologico?</h2>
						<p>
							Il mese del Benessere Psicologico è una campagna di sensibilizzazione e promozione della Cultura del Benessere della persona che porta a migliorare la qualità della vita e aiuta a prevenire possibili disagi nel rapporto con se stessi e con gli altri. La ricerca del proprio benessere promuove la crescita personale e migliora la convivenza tra le persone.</p><p>Il Mese del Benessere Psicologico è realizzato grazie alla disponibilità di psicologi, i quali offrono consulenze e seminari gratuiti .
						</p>
					</div>
				</div>
			</div>
		</div>
<?php
	bannerino(false);		
?>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 text-center borderBottomGrey">
				<h1 class="mt30 mb30"><span class="quadrato big" style="background-color: <?php echo $mainMenuITA["eventi"]["color"] ?>"></span> Eventi</h1>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<form class="upperForm" action="<?php echo $base ?>eventi/">
					<div class="row">
						<div class="col-lg-4 col-xfs-12">
							<span class="mt5 display-block">Cerca l'evento per città:</span>
						</div>
						<div class="col-lg-6 col-xfs-12">
							<?php
								if(isSet($_GET["c"]))
									$val = strip_tags($_GET["c"]);
								else
									$val = "";
							?>
							<input type="text" name="c" value="<?php echo $val ?>" class="form-control">
						</div>
						<div class="col-lg-2 col-xfs-12">
							<button type="submit" class="btn btn-orange">Cerca</button>
						</div>
					</div>
				</form>
				<?php
					if(count($eventi) == 0)
					{
						?>
							<p>
								<span class="h3 text-center display-block mb30">Seguici per scoprire presto dove incontrarci</span>
							</p>
						<?php
					}
					foreach($eventi as $evento)
					{
						$perm = $base."eventi/".permalink($evento["dott"]." ".$evento["titoloEvento"]." ".$evento["cittaEvento"]).".html";
						?>
							<div class="mb30">
								<span class="h5"><?php echo strip_tags($evento["sedeEvento"]) ?> <strong><?php echo strip_tags($evento["cittaEvento"]) ?></strong></span>
								<h2 class="mt5">
									<a href="<?php echo $perm ?>" class="orangeText"><?php echo strip_tags($evento["titoloEvento"]) ?>.</a>
								</h2>
								<hr>
								<span class="h5">Tenuto da: <strong>Dott. <?php echo strip_tags($evento["dott"]) ?></strong></span>
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
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 text-center borderBottomGrey borderTopGrey">
				<h1 class="mt30 mb30"><span class="quadrato big" style="background-color: <?php echo $mainMenuITA["consulenze"]["color"] ?>"></span> Consulenze</h1>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<form class="upperForm" action="<?php echo $base ?>consulenze/">
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
								<span class="h3 text-center display-block mb30">Seguici per scoprire presto dove incontrarci</span>
							</p>
						<?php
					}
					foreach($consulenze as $consulenza)
					{
						$perm = $base."consulenze/".permalink($consulenza["dott"]." ".$consulenza["cittaConsulenza"]).".html";
						?>
							<div class="mb60">
								<span class="h5"><strong><?php echo strip_tags($consulenza["cittaConsulenza"]) ?></strong></span>
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
	<div class="container pb80">
		<h1 class="mt30 mb30 text-center"><span class="quadrato big" style="background-color: <?php echo $mainMenuITA["home"]["color"] ?>"></span> Facebook</h1>
		<div id="fbWrapContent">
			<div class="text-center">
				<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
			</div>
		</div>
	</div>	
<?php
	mappa_eventi($pageData);
	bottom($pageData);
?>