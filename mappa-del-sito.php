<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/parts.php");
	$pageData["menuItem"] = "mappa-del-sito";
	$pageData["title"] = "Mappa del sito";
	$pageData["description"] = "Sitemap del sito del Mese del Benessere Psicologico promosso dall'Ordine degli Psicologi di Puglia dal 1 al 31 ottobre.";
	top($pageData);
?>
	<div class="container distanceMe">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1>Mappa del sito</h1>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<nav class="normalList">
					<ul>
						<?php
							foreach($pageData["footerMenu"] as $key => $arr)
							{
								?>
									<li><a href="<?php echo $base.$arr["url"]?>" target=_blank><?php echo $arr["label"]?></a></li>
								<?php
							}
						?>
					</ul>
				</nav>
			</div>			
		</div>
	</div>
<?php
	bottom($pageData);
?>