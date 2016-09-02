<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/parts.php");
	$pageData["menuItem"] = "newsletter-policy";
	top($pageData);
?>
	<div class="container distanceMe">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1>Newsletter Policy</h1>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<p>
					I tuoi dati personali saranno trattati dal <?php echo $nomeSito ?> in modalità elettronica, per erogare i servizi riservati agli utenti registrati. Inoltre, previo consenso, i dati – compresi quelli da te forniti in occasione degli eventuali processi d'acquisto - saranno trattati per l’invio da parte del <?php echo $nomeSito ?> di newsletter e – per conto proprio o di terzi - di altro materiale informativo e promozionale, comunicazioni commerciali, per lo svolgimento di attività di vendita diretta e sondaggi d'opinione. I tuoi dati – compresi quelli da te forniti in occasione degli eventuali processi d'acquisto e le tue abitudini di consumo - saranno trattati, sempre previo consenso, per fini di profilazione, allo scopo di migliorare la tua esperienza di navigazione sul sito e di inviarti proposte in linea con i tuoi interessi. 
				</p>
				<p>
					Tutti i gli utenti registrati su <?php echo $nomeSito ?> possono esprimere il loro desiderio di non ricevere comunicazioni commerciali da noi e/o da terzi selezionati. Qualora non desideri continuare a ricevere comunicazioni commerciali da noi e/o da terzi selezionati dovrà esprimere la sua rinuncia mediante email a <a href="mailto: <?php echo $indirizzoinfo ?>"><?php echo $indirizzoinfo ?></a>.
				</p>
				<p>
					Gli incaricati preposti al trattamento sono: gli addetti alla gestione del sito ed erogazione dei relativi servizi, al marketing, ai sistemi informativi e Brain Pull Società Cooperativa. 
				</p>
				<p> 
					Consulta la <a href="<?php echo $base.$pageData["footerMenu"]["privacy-policy"]["url"] ?>" target=_blank>Privacy Policy</a> presente sul sito per tutte le altre informazioni a tutela dei tuoi diritti. 
				</p>
			</div>			
		</div>
	</div>
<?php
	bottom($pageData);
?>