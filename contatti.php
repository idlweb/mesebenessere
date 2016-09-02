<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/proto/parts.php");
	$pageData["menuItem"] = "contatti";
	
	$pageData["title"] = "Contatti";
	$pageData["description"] = "Contatta e richiedi informazioni all'Ordine degli Psicologi di Puglia per le consulenze gratuite e gli eventi del Mese del Benessere Psicologico.";
	$pageData["property_content"]["og:title"] = "Contatti";
	$pageData["property_content"]["og:type"] = "article";
	$pageData["property_content"]["og:description"] = "Contatta e richiedi informazioni all'Ordine degli Psicologi di Puglia per le consulenze gratuite e gli eventi del Mese del Benessere Psicologico.";
	$pageData["property_content"]["og:site_name"] = "Mese del Benessere Psicologico";
	$pageData["property_content"]["twitter:card"] = "summary";
	$pageData["property_content"]["twitter:title"] = "Contatti - Mese del Benessere Psicologico";
	$pageData["property_content"]["twitter:description"] = "Contatta e richiedi informazioni all'Ordine degli Psicologi di Puglia per le consulenze gratuite e gli eventi del Mese del Benessere Psicologico.";

	top($pageData);
?>
	<div class="container distanceMe">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1>Contatti</h1>
			</div>
		</div>
	</div>
	<div class="container">
		<?php map() ?>
	</div>
	<div class="container mt30">
		<?php modulo_contatti() ?>
	</div>
<?php
	bottom($pageData);
?>