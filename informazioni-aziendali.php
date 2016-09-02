<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/parts.php");
	$pageData["menuItem"] = "informazioni-aziendali";
	$pageData["title"] = "Informazioni legali";
	$pageData["description"] = "Informazioni legali del sito del Mese del Benessere Psicologico promosso dall'Ordine degli Psicologi di Puglia dal 1 al 31 ottobre.";
	top($pageData);
?>
	<div class="container distanceMe">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1>Informazioni aziendali</h1>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="h4"><?php echo $ragioneSociale ?></h2>
				<p>
					<?php
						echo $indirizzoLegale."<br>".
							$caplocalitaprovinciaLegale."<br><br>".
							"CF".$codiceFiscale."<br>";
					?>
				</p>
			</div>			
		</div>
	</div>
<?php
	bottom($pageData);
?>