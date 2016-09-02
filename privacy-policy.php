<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/parts.php");
	$pageData["menuItem"] = "privacy-policy";
	$pageData["title"] = "Privacy Policy";
	$pageData["description"] = "Privacy Policy del sito del Mese del Benessere Psicologico promosso dall'Ordine degli Psicologi di Puglia dal 1 al 31 ottobre.";
	top($pageData);
?>
	<div class="container distanceMe">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1>Privacy Policy</h1>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2>Perche' questo avviso</h2>
				<p>
					In questa pagina si descrivono le modalità di gestione del sito in riferimento al trattamento dei dati personali degli utenti che lo consultano.</p><p>Si tratta di un'informativa che è resa anche ai sensi dell'art. 13 del d.lg. n. 196/2003 - Codice in materia di protezione dei dati personali a coloro che interagiscono con il sito <?php echo $nomeSito ?>, accessibile per via telematica a partire dall'indirizzo: <?php echo $nomeDominio ?>, corrispondente alla pagina iniziale del detto sito.</p><p>L'informativa è resa solo per il sito <?php echo $nomeSito ?> e non anche per altri siti web eventualmente consultati dall'utente tramite link.</p><p>L'informativa si ispira anche alla Raccomandazione n. 2/2001 che le autorità europee per la protezione dei dati personali, riunite nel Gruppo istituito dall'art. 29 della direttiva n. 95/46/CE, hanno adottato il 17 maggio 2001 per individuare alcuni requisiti minimi per la raccolta di dati personali on-line, e, in particolare, le modalità, i tempi e la natura delle informazioni che i titolari del trattamento devono fornire agli utenti quando questi si collegano a pagine web, indipendentemente dagli scopi del collegamento.
				</p>
				<h2>Il "titolare" del trattamento</h2>
				<p>
					A seguito della consultazione di questo sito possono essere trattati dati relativi a persone identificate o identificabili.</p><p>Il "titolare" del loro trattamento è <?php echo $ragioneSociale ?>, Sede legale <?php echo $indirizzoLegaleCompleto ?>, P.IVA <?php echo $partitaIva ?>.
<?php echo $ragioneSociale ?> e <?php echo $nomeSito ?> in questa informativa identificano la stessa cosa.
				</p>
				<h2>Responsabile del trattamento</h2>
				<p>
					Brain Pull Società Cooperativa, che ha sede in Conversano (Ba), Italia, via Torino 44, 70014, P.IVA 07359120727, è stata designata responsabile del trattamento ai sensi dell'articolo 29 del Codice in materia di protezione dei dati personali, in quanto incaricata della manutenzione della parte tecnologica del sito.
				</p>
				<h2>Luogo di trattamento dei dati</h2>
				<p>
					I trattamenti connessi all'uso di questo sito hanno luogo presso la predetta sede del Titolare del Trattamento. I dati possono essere trattati anche dal personale della società che cura la manutenzione della parte tecnologica del sito, Brain Pull Società Cooperativa (responsabile del trattamento ai sensi dell'articolo 29 del Codice in materia di protezione dei dati personali), presso la sede della società medesima.
				</p>
				<h2>Tipi di dati trattati</h2>
				<h3>Dati di navigazione</h3>
				<p>
					I sistemi informatici e le procedure software preposte al funzionamento di questo sito web acquisiscono, nel corso del loro normale esercizio, alcuni dati personali la cui trasmissione è implicita nell'uso dei protocolli di comunicazione di Internet.</p><p>Si tratta di informazioni che non sono raccolte per essere associate a interessati identificati, ma che per loro stessa natura potrebbero, attraverso elaborazioni ed associazioni con dati detenuti da terzi, permettere di identificare gli utenti.</p><p>In questa categoria di dati rientrano gli indirizzi IP o i nomi a dominio dei computer utilizzati dagli utenti che si connettono al sito, gli indirizzi in notazione URI (Uniform Resource Identifier) delle risorse richieste, l'orario della richiesta, il metodo utilizzato nel sottoporre la richiesta al server, la dimensione del file ottenuto in risposta, il codice numerico indicante lo stato della risposta data dal server (buon fine, errore, ecc.) ed altri parametri relativi al sistema operativo e all'ambiente informatico dell'utente.</p><p>Questi dati vengono utilizzati al solo fine di ricavare informazioni statistiche anonime sull'uso del sito. I dati potrebbero essere utilizzati per l'accertamento di responsabilità in caso di ipotetici reati informatici ai danni del sito.
				</p>
				<h3>Dati forniti volontariamente dall'utente</h3>
				<p>
					L'invio facoltativo, esplicito e volontario di posta elettronica agli indirizzi eventualmente indicati su questo sito comporta la successiva acquisizione dell'indirizzo del mittente, necessario per rispondere alle richieste, nonché degli eventuali altri dati personali inseriti nella missiva.</p><p>La procedura di acquisto, registrazione, ove presenti, e gli altri servizi eventualmente offerti dal sito <?php echo $nomeSito ?> prevedono l'invio facoltativo di dati personali e non, nei relativi casi necessari per portare a termine il servizio richiesto.
				</p>
				<h3>Cookies</h3>
				<p>
					<?php echo $nomeSito ?>, Brainpull e fornitori di terze parti, tra cui Google e Facebook, potrebbero utilizzare sia cookie proprietari, sia cookie di terze parti per determinare la correlazione tra le visite al sito web e le impressioni degli annunci, gli altri utilizzi dei servizi pubblicitari e le interazioni con tali impressioni e servizi pubblicitari. I dati potrebbero essere utilizzati per l'accertamento di responsabilità e provvedimenti in caso di ipotetici reati informatici o presunti tentativi di sabotaggio ai danni del sito. L'informativa estesa riguardante l'uso dei cookie in questo sito è raggiungibile a questo indirizzo: <a href="http://<?php echo $nomeDominio.$base ?>cookie-policy.html" target=_blank>http://<?php echo $nomeDominio.$base.$pageData["footerMenu"]["cookie-policy"]["url"] ?></a>.
				</p>
				<h2>Facoltativita' del conferimento dei dati</h2>
				<p>
					A parte quanto specificato per i dati di navigazione ed eventualmente per i cookies, l'utente è libero di fornire i dati personali o non personali richiesti.</p><p>Il loro mancato conferimento può comportare l'impossibilità di ottenere quanto richiesto.
				</p>
				<h2>Modalita' del trattamento</h2>
				<p>
					I dati personali sono trattati con strumenti per il tempo strettamente necessario a conseguire gli scopi per cui sono stati raccolti.</p><p>Specifiche misure di sicurezza sono osservate per prevenire la perdita dei dati, usi illeciti o non corretti ed accessi non autorizzati.
				</p>
				<h2>Diritti degli interessati</h2>
				<p>
					I soggetti cui si riferiscono i dati personali hanno il diritto in qualunque momento di ottenere la conferma dell'esistenza o meno dei medesimi dati e di conoscerne il contenuto e l'origine, verificarne l'esattezza o chiederne l'integrazione o l'aggiornamento, oppure la rettificazione (articolo 7 del Codice in materia di protezione dei dati personali).</p><p>Ai sensi del medesimo articolo si ha il diritto di chiedere la cancellazione, la trasformazione in forma anonima o il blocco dei dati trattati in violazione di legge, nonché di opporsi in ogni caso, per motivi legittimi, al loro trattamento.</p><p>Le richieste vanno rivolte:<br>- via e-mail, all'indirizzo: info@brainpull.com<br>- oppure via posta, a Brain Pull Società Cooperativa, via Torino 44, 70014, Conversano (Ba), Italia
				</p>
			</div>			
		</div>
	</div>
<?php
	bottom($pageData);
?>