<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/parts.php");
	$pageData["menuItem"] = "iniziativa";

	$pageData["title"] = "Cos'è";
	$pageData["description"] = "Informazioni generali e spirito del Mese del Benessere Psicologico a cura dell'Ordine Psicologi di Puglia, vai agli eventi e alle consulenze gratuite.";
	$pageData["property_content"]["og:title"] = "L'iniziativa";
	$pageData["property_content"]["og:type"] = "article";
	$pageData["property_content"]["og:description"] = "Informazioni generali e spirito del Mese del Benessere Psicologico a cura dell'Ordine Psicologi di Puglia, vai agli eventi e alle consulenze gratuite.";
	$pageData["property_content"]["og:site_name"] = "Mese del Benessere Psicologico";
	$pageData["property_content"]["twitter:card"] = "summary";
	$pageData["property_content"]["twitter:title"] = "L'iniziativa - Mese del Benessere Psicologico";
	$pageData["property_content"]["twitter:description"] = "Informazioni generali e spirito del Mese del Benessere Psicologico a cura dell'Ordine Psicologi di Puglia, vai agli eventi e alle consulenze gratuite.";

	
	top($pageData);
	bannerino();
?>
	<div class="container" id="distanceMe">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<h1 class="text-center mt80 mb40"><span class="quadrato big" style="background-color: <?php echo $mainMenuITA[$pageData["menuItem"]]["color"] ?>"></span> L'iniziativa</h1>
				<p class="mb20">
					Sensibilizzare e promuovere la cultura del Benessere, affinché ognuno possa puntare a migliorare la qualità della vita, elaborando e condividendo il non risolto del proprio vissuto interiore: questo l’obiettivo dell’Ordine degli Psicologi di Puglia, che per il quinto anno consecutivo promuove l’iniziativa del “Mese del Benessere Psicologico” con la volontà di coinvolgere non soltanto gli addetti ai lavori, ma anche quella parte di popolazione restia al cambiamento o introversa, vittima del pregiudizio sociale che vede chi si affida allo psicologo come pazzo o malato.</p>
				<p class="mb20">
					Una comunicazione, quindi, improntata sull’abbattere e decostruire la falsa convinzione del pregiudizio sociale, catturando prima e indirizzando poi l’attenzione di quella popolazione che vive una situazione di malessere interiore, spesso inconsapevole della possibilità del cambiamento, ad uscire dall’impasse in cui vive, avvicinandola alla rete di professionisti pronti a guidarli verso la ricerca del benessere psicologico.</p>
				<p class="mb80">
					Risolvere conflitti interni non solo migliora la qualità della vita, ma aiuta anche a prevenire e affrontare con maggiore consapevolezza le possibili discrepanze tra Sé e l’altro, tra il proprio microcosmo e le infinite relazioni di esso con l’esterno. È partendo dagli innumerevoli benefici del benessere e annullando e destrutturando la paura del cambiamento e gli stereotipi che legano lo psicologo al malato che insieme si darà vita al "Mese del Benessere Psicologico".				
				</p>
			</div>
		</div>
	</div>
<?php
	mappa_eventi($pageData);
	bottom($pageData);
?>