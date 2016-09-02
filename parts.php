<?php
	session_start();
	//ci vuole l'indicatore lingua davanti quando viene stampato

	

	$mainMenuITA = array(
		"home" => array("url" => "home.html", "label" => "Home", "color" => "#FAA635"),
		"eventi" => array("url" => "eventi/", "label" => "Eventi", "color" => "#F47954"),
		"consulenze" => array("url" => "consulenze/", "label" => "Consulenze", "color" => "#6CC067"),
		//"news" => array("url" => "blog/", "label" => "News"),
		"iniziativa" => array("url" => "iniziativa.html", "label" => "iniziativa", "color" => "#A154A0"),
		"area-riservata" => array("url" => "area-riservata.html", "label" => "Area riservata", "color" => "#5D5D5E")
	);
	//ci vuole l'indicatore lingua davanti quando viene stampato
	$footerMenuITA = array(
		"home" => array("url" => "home.html", "label" => "Home"),
		"eventi" => array("url" => "eventi/", "label" => "Eventi"),
		"consulenze" => array("url" => "consulenze/", "label" => "Consulenze"),
		//"news" => array("url" => "blog/", "label" => "News"),
		//"contatti" => array("url" => "contatti.html", "label" => "Contatti"),
		"area-riservata" => array("url" => "area-riservata.html", "label" => "Area riservata"),
		"privacy-policy" => array("url" => "privacy-policy.html", "label" => "Privacy policy"),
		"cookie-policy" => array("url" => "cookie-policy.html", "label" => "Cookie policy"),
		"newsletter-policy" => array("url" => "newsletter-policy.html", "label" => "Newsletter policy"),
		"informazioni-aziendali" => array("url" => "informazioni-aziendali.html", "label" => "Informazioni aziendali"),
		"mappa-del-sito" => array("url" => "mappa-del-sito.html", "label" => "Mappa del sito")
	);

	$pageData = array();
	$current_url = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
	$root = "/"; //serve a puntare immagini, script e file in genere
	$base = $root; //serve a puntare le singole pagine.html
	$lingua = "it";
	$locale = "it_IT";
	$idLingua = "1";
	setlocale(LC_ALL, $locale.".utf8");
	$pageData["base"] = $base;
	$pageData["root"] = $root;
	$pageData["lingua"] = $lingua;
	$pageData["idLingua"] = $idLingua;
	$pageData["menuItem"] = "";
	$pageData["title"] = "";
	$pageData["description"] = "";
	$pageData["property_content"]["og:title"] = "";
	$pageData["property_content"]["og:type"] = "";
	$pageData["property_content"]["og:url"] = $current_url;
	$pageData["property_content"]["og:image"] = "http://".$_SERVER["HTTP_HOST"]."/images/1200x630.jpg";
	$pageData["property_content"]["og:description"] = "";
	$pageData["property_content"]["og:site_name"] = "";
	$pageData["property_content"]["twitter:card"] = "";
	$pageData["property_content"]["twitter:title"] = "";
	$pageData["property_content"]["twitter:description"] = "";
	$pageData["property_content"]["twitter:image"] = "http://".$_SERVER["HTTP_HOST"]."/images/120x120.jpg";
	$pageData["property_content"]["twitter:url"] = $current_url;
	$pageData["mainMenu"] = $mainMenuITA;
	$pageData["footerMenu"] = $footerMenuITA;

	// DATI DA CONFIGURARE



	$ragioneSociale = "Ordine degli Psicologi di Puglia";
	$denominazione = $ragioneSociale;
	$indirizzoLegale = "via Fratelli Sorrentino 6";
	$capLegale = "70126";
	$localitaLegale = "Bari";
	$provinciaLegale = "(BA)";
	$nazioneLegale = "Italia";
	$caplocalitaprovinciaLegale = $capLegale." ".$localitaLegale." ".$provinciaLegale."<br>".$nazioneLegale;
	$indirizzoLegaleCompleto = $indirizzoLegale.", ".$caplocalitaprovinciaLegale;


	$partitaIva = "";
	$codiceFiscale = "93091790720";
	$numeroRea = "BA - 5512992";
	$telefonoContatti = "080 542 10 37";
	$fax = "";

	$indirizzoAmministrativa = $indirizzoLegale;
	$capAmministrativa = $capLegale;
	$localitaAmministrativa = $localitaLegale;
	$provinciaAmministrativa = $provinciaLegale;
	$nazioneAmministrativa = $nazioneLegale;
	$caplocalitaprovinciaAmministrativa = $capAmministrativa." ".$localitaAmministrativa." (".$provinciaAmministrativa."), ".$nazioneAmministrativa;
	$indirizzoAmministrativaCompleto = $indirizzoAmministrativa.", ".$caplocalitaprovinciaAmministrativa;

	$nomeDominio = "www.mesedelbenesserepsicologico.it";
	$nomeSito = "Mesedelbenesserepsicologico.it";
	$indirizzoinfo = "info@mesedelbenesserepsicologico.it";
	
	$appID = "1645624962392488";
	$photoFeed = "https://graph.facebook.com/549826711720254/photos?access_token=1645624962392488|_FzlDl3kIgk9uvrNvZFr-k33-eA&fields=id,created_time,name,images";

	$urlSezioneBlog = "blog/";
	$linkPerRegistrareEventi = $base.$mainMenuITA["area-riservata"]["url"];
	//FINE DATI DA CONFIGURARE

	require_once($_SERVER["DOCUMENT_ROOT"].$root."braingest/util/util.php");
	require_once($_SERVER["DOCUMENT_ROOT"].$root."braingest/dataSource/database/db.php");
	$db = new DBQuery();
	require_once($_SERVER["DOCUMENT_ROOT"].$root."braingest/config/session.php");
	require_once($_SERVER["DOCUMENT_ROOT"].$root."phpThumb/phpThumb.config.php");
	require_once($_SERVER["DOCUMENT_ROOT"].$root."eventi/eventi-controller.php");	


	if(isSet($_POST["logout"]))
	{
		$_SESSION["current_user"] = null;
		unset($_SESSION["current_user"]);
	}

	if(isSet($_POST["login"]))
	{
		$email = addslashes($_POST["email"]);
		//$numeroAlbo = addslashes($_POST["numeroAlbo"]);
		//$password = hash_pbkdf2("sha256", $_POST["password"], "", 10000);
		$query = "SELECT * FROM utenti_psico WHERE email = '".$email."'";// AND pass = '".$password."';";
		$res = $db->dbQuery($query);
		if(count($res) == 1)
			$_SESSION["current_user"] = array("email" => $res[0]["email"], "idutenti_psico" => $res[0]["idutenti_psico"]);
		else
			alert("Attenzione!","Login errato, riprovare.","red");
		//algoritmo: pbkdf2_sha256 iterazioni: 10000 salt: 
	}

	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	if(isSet($_POST["formNewsletter"]))
	{
		$email = strip_tags($_POST["emailNewsletter"]);
		$accetto = $_POST["accettoNewsletter"];
		$ip = get_client_ip();
		$query = "SELECT idIndirizziNewsletter FROM indirizziNewsletter WHERE email = '".addslashes($email)."'";
		$res = $db->dbQuery($query);
		if(count($res) == 0)
		{
			if(($accetto == "on") and (!(filter_var($email, FILTER_VALIDATE_EMAIL) === false)))
			{
				$query = "INSERT INTO indirizziNewsletter (email, lingua, ip) VALUES ('".addslashes($email)."','".$lingua."','".$ip."')";
				$res = $db->dbQuery($query);
				if($res != false)
				{
					alert("Complimenti!", "Il tuo indirizzo è stato aggiunto all'archivio.", "green");
					insertIntoSgam($email);
				}
				else
					alert("Attenzione!", "Il tuo indirizzo non è stato aggiunto all'archivio. Riprovare.", "red");

			}
			else
				alert("Attenzione!", "Riprovare riempiendo tutti i campi.", "red");
		}
		else
			alert("Attenzione!", "Il tuo indirizzo e-mail è stato già inserito in archivio.", "red");
	}
	
	
	if(isSet($_POST["formContatti"]))
	{
		$nome = strip_tags($_POST["nome"]);
		$email = strip_tags($_POST["email"]);
		$telefono = strip_tags($_POST["telefono"]);
		$messaggio = strip_tags($_POST["messaggio"]);
		$accetto = strip_tags($_POST["accetto"]);
		
		if(($nome != "") and ($messaggio != "") and ($telefono != "") and ($accetto == "on") and (!(filter_var($email, FILTER_VALIDATE_EMAIL) === false)))
		{		
			//autenticazione al server
			$serverSMTP = "mail.mesedelbenesserepsicologico.it";
			$portaSMTP = 25;
			$indirizzoLogin = "noreply@mesedelbenesserepsicologico.it";
			$passwordLogin = 'p05nE2o0-69F-,6(5OMSl?#a.';

			//attori di posta
			$indirizzoMittente = $email;
			$nomeMittente = "Ordine degli Psicologi di Puglia";
			$indirizzoDestinatario = "info@mesedelbenesserepsicologico.it";

			//messaggio
			$oggetto = "Nuovo contatto da Mesedelbenesserepsicologico.it";
			$logoCliente = "http://www.mesedelbenesserepsicologico.it/images/logo-email.png";
			$larghezzaLogoCliente = 251;
			$coloreCliente = "#FBCC00";
			$htmlBody = "<div>
							<img src='".$logoCliente."' style='width:".$larghezzaLogoCliente."px; margin: auto; display: block;'>
							<div style='margin: 20px 0px 30px 0px; background-color: #6CC067; height: 3px;'></div>
							<p>Hai ricevuto una contatto dal tuo sito.</p>
							<table>								
								<tr><td>Nome e cognome:</td><td>".$nome."</td></tr>
								<tr><td>Email:</td><td>".$email."</td></tr>
								<tr><td>Email:</td><td>".$telefono."</td></tr>
								<tr><td>Messaggio:</td><td></td></tr>
							</table>
							<p>
								".$messaggio."
							</p>
							<div style='margin: 20px 0px 30px 0px; background-color: #F47954; height: 3px;'></div>
							<i>Servizio contatti Ordine degli Psicologi di Puglia</i>
						</div>";
			$htmlBody = str_replace("€","&euro;",$htmlBody);
			if(!manda_mail($serverSMTP, $portaSMTP, $indirizzoLogin, $passwordLogin, $nomeMittente, $indirizzoDestinatario, $indirizzoMittente, $oggetto, $htmlBody))
			{
				alert("Attenzione!","Errore durante l'invio del messaggio. Si prega di riprovare.","red");
			}
			else
			{
				alert("Complimenti!","Messaggio inviato con successo.","green");
				insertIntoSgam($email);
			}
		}
		else
		{
			alert("Attenzione!","Riempire tutti i campi e riprovare.","red");
		}
	}
	else
	{
		$nome = "";
		$email = "";
		$telefono = "";
		$messaggio = "";
	}

	

	function map()
	{
		global $db, $base;
		$eventi = get_elenco_eventi();
		?>
			<div class="row">
				<div class="col-lg-12">
					<div class="map">
						<div class="overlay" onclick="style.pointerEvents='none'"></div>
						<div id="map" style="height: 500px;"></div>
					</div>
				</div>
			</div>
			<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
			<script type="text/javascript">
				var mapCenter = new google.maps.LatLng(40.979120501097384, 17.16888427734375);
				var myOptions = {
				  zoom: 8,
				  center: mapCenter,
				  mapTypeId: google.maps.MapTypeId.ROADMAP
				};

				var map = new google.maps.Map(document.getElementById("map"), myOptions);

				<?php
					foreach($eventi as $evento)
					{
						if((strip_tags($evento["lat"]) != "") and (strip_tags($evento["lat"]) != "0"))
						{
							$id = strip_tags($evento["idDatiEvento"]);
							$perm = $base."eventi/".permalink($evento["dott"]." ".$evento["titoloEvento"]." ".$evento["cittaEvento"]).".html";
							$gmaps = urlencode(strip_tags($evento["indirizzoEvento"]." ".$evento["capEvento"]." ".$evento["cittaEvento"]." ".$evento["provinciaEvento"]));
							?>
								//Conversano
								var latlng<?php echo $id ?> = new google.maps.LatLng(<?php echo strip_tags($evento["long"]) ?>, <?php echo strip_tags($evento["lat"]) ?>);
								var marker<?php echo $id ?> = new google.maps.Marker(
								  { 
									position: latlng<?php echo $id ?>,
									map: map,
									//icon: 'img/map.png',
									flat: true 
								  });    
								var tooltip<?php echo $id ?> = '<p style="font-family: \'nexa_slab_regularregular\'; height: 50px;" class="text-center"><a class="h5 orangeText" href="<?php echo $perm ?>"><?php echo addslashes(smartString(strip_tags($evento["titoloEvento"]), 30)) ?></a><br><a href="https://www.google.it/maps/place/<?php echo $gmaps ?>/" target=_blank>- google maps -</a></p>';
								var infowindow<?php echo $id ?> = new google.maps.InfoWindow(
								  {
									content: tooltip<?php echo $id ?>
								  });

								google.maps.event.addListener(marker<?php echo $id ?>, 'click', function() {
									infowindow<?php echo $id ?>.open(map,marker<?php echo $id ?>);
								});
							<?php
						}
					}
				?>
			</script>
		<?php
	}

	function info_generali()
	{
		global $ragioneSociale, $indirizzoLegale, $capLegale, $localitaLegale, $provinciaLegale, $nazioneLegale, $caplocalitaprovinciaLegale, $indirizzoLegaleCompleto, $partitaIva, $numeroRea, $indirizzoAmministrativa, $capAmministrativa, $localitaAmministrativa, $provinciaAmministrativa, $nazioneAmministrativa, $caplocalitaprovinciaAmministrativa, $indirizzoAmministrativaCompleto, $nomeDominio, $nomeSito, $indirizzoinfo, $telefonoContatti, $fax, $partitaIva;
		?>
			<p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<span itemprop="streetAddress"><?php echo $indirizzoAmministrativa ?></span>, 
				<span itemprop="postalCode"><?php echo $capAmministrativa ?></span> 
				<span itemprop="addressLocality"><?php echo $localitaAmministrativa ?></span>
				<span itemprop="addressRegion"><?php echo $provinciaAmministrativa ?></span><br>
			</p>
			<p>
				<i class="fa fa-phone"></i> <a href="tel: <?php echo $telefonoContatti ?>" itemprop="telephone"><?php echo $telefonoContatti ?></a><br>
				<i class="fa fa-envelope"></i> <a href="mail: segreteria@psicologipuglia.it" itemprop="telephone">segreteria@psicologipuglia.it</a><br>
			</p>
		<?php
	}

	function modulo_contatti()
	{
		global $nome, $email, $telefono, $messaggio, $denominazione, $footerMenuITA, $base;
		?>
			<div class="row">
				<div class="col-lg-12">
					<div itemscope itemtype="http://schema.org/LocalBusiness" class="mb20">
						<h3 class="h4"><strong itemprop="name"><?php echo $denominazione ?></strong></h3>
						<?php info_generali() ?>
					</div>
				</div>
				<div class="col-lg-12">
					<form method=POST id="formContatti" name="formContatti">
						<input type="hidden" name="formContatti" value="-1">
						<div class="form-group">
							<input class="form-control" type="text" name="nome" value="<?php echo $nome ?>" data-field="nome" placeholder="Nome e cognome">
							<em class="formError" id="errore_nome">Il campo Nome e cognome è obbligatorio</em>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<input class="form-control" type="text" name="email" value="<?php echo $email ?>" data-field="email" placeholder="E-mail">
									<em class="formError" id="errore_email">Il campo E-mail è obbligatorio</em>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<input class="form-control" type="text" name="telefono" value="<?php echo $telefono ?>" data-field="telefono" placeholder="Telefono">
									<em class="formError" id="errore_telefono">Il campo Telefono è obbligatorio</em>
								</div>
							</div>
						</div>
						<div class="form-group">
							<textarea rows=6 name="messaggio" class="form-control" placeholder="Messaggio" data-field="messaggio"><?php echo $messaggio ?></textarea>
							<em class="formError" id="errore_messaggio">Il campo Messaggio è obbligatorio</em>
						</div>
						<div class="form-group">
							<label class="accepted"><input type="checkbox" name="accetto" id="check" data-field="check"> Ho letto e accettato l'<a href="<?php echo $base.$footerMenuITA["privacy-policy"]["url"] ?>" target=_blank>informativa sulla privacy</a></label>
							<em class="formError" id="errore_check">È obbligatorio accettare l'informativa sulla privacy</em>
						</div>
						<div class="form-group">
							<span class="btn btn-violet" type="button" onClick="submit('formContatti')" id="trueSubmit" name="inviaMessaggio">Invia</span>
						</div>
					</form>
					<script>
						function submit(formName)
						{
							var quantiSono = $("#"+formName+" [data-field]").length;
							var fatti = 0;
							var posso = true;
							$("[data-field]").each(function(){

								fatti++;						

								if(($(this).is("[type='text']")) || ($(this).is("textarea")))
								{
									if(this.value == "")
									{
										$("#errore_"+$(this).data("field")).css("display", "block");
										posso = false;
									}
									else
										$("#errore_"+$(this).data("field")).css("display", "none");
								}

								if($(this).is("[type='checkbox']"))
								{
									if(this.checked == false)
									{
										$("#errore_"+$(this).data("field")).css("display", "block");
										posso = false;
									}
									else
										$("#errore_"+$(this).data("field")).css("display", "none");
								}
								if((quantiSono == fatti) && posso)
								{
									document.forms[formName].submit();
								}							
							});
						}
					</script>
				</div>
			</div>
		<?php
	}

	function insertIntoSgam($email)
	{
		global $db;
		$query = "INSERT INTO sgam VALUES ('".addslashes($email)."')";
		$db->dbQuery($query);
	}

	function manda_mail($serverSMTP, $portaSMTP, $indirizzoLogin, $passwordLogin, $nomeMittente, $indirizzoDestinatario, $indirizzoMittente, $oggetto, $messaggioHTML, $bcc = array("messaggi_automatici@brainpull.com"), $filename = "")
	{
		require_once($_SERVER["DOCUMENT_ROOT"]."/phpmailer/PHPMailerAutoload.php");
		try
		{
			$mail = new PHPMailer;
			$mail->IsSMTP();
			$mail->Port = $portaSMTP; 
			$mail->Host = $serverSMTP;
			$mail->Username = $indirizzoLogin;
			$mail->Password = $passwordLogin;
			
			$mail->From = $indirizzoLogin;
			$mail->FromName = utf8_decode($nomeMittente);
			$mail->Sender = $indirizzoLogin; //IMPORTANTE PER SPF VALIDATION
			$mail->AddAddress($indirizzoDestinatario);
			$mail->AddReplyTo($indirizzoMittente);
			if($filename != "")
				$mail->AddAttachment($filename);
			foreach ($bcc as $b)
				$mail->AddBcc($b);
			$mail->IsHTML(true);
			$mail->Subject = utf8_decode($oggetto);
			$mail->Body = utf8_decode($messaggioHTML);
			$mail->AltBody = strip_tags($messaggioHTML);
			$ret = $mail->Send();
			return $ret;
		}
		catch (phpmailerException $e)
		{
			echo "Error 1".$e->errorMessage();
		}
		catch (Exception $e)
		{
			echo "Error 2".$e->getMessage();
		}
	}

	function alert($titolo, $testo, $classe)
	{
		$_SESSION["alert"] = array("titolo" => $titolo, "testo" => $testo, "classe" => $classe);
	}

	function menuItem($menuItem, $currentPage)
	{
		if($menuItem == $currentPage)
		{
			echo ' class="active"';
		}
	}

	function smartString($text, $max_len, $trim_middle = false, $trim_chars = '...')
	{
		$text = trim($text);

		if (strlen($text) < $max_len) {

			return $text;

		} elseif ($trim_middle) {

			$hasSpace = strpos($text, ' ');
			if (!$hasSpace) {
				$first_half = substr($text, 0, $max_len / 2);
				$last_half = substr($text, -($max_len - strlen($first_half)));
			} else {
				$last_half = substr($text, -($max_len / 2));
				$last_half = trim($last_half);
				$last_space = strrpos($last_half, ' ');
				if (!($last_space === false)) {
					$last_half = substr($last_half, $last_space + 1);
				}
				$first_half = substr($text, 0, $max_len - strlen($last_half));
				$first_half = trim($first_half);
				if (substr($text, $max_len - strlen($last_half), 1) == ' ') {
					$first_space = $max_len - strlen($last_half);
				} else {
					$first_space = strrpos($first_half, ' ');
				}
				if (!($first_space === false)) {
					$first_half = substr($text, 0, $first_space);
				}
			}

			return $first_half.$trim_chars.$last_half;

		} else {

			$trimmed_text = substr($text, 0, $max_len);
			$trimmed_text = trim($trimmed_text);
			if (substr($text, $max_len, 1) == ' ') {
				$last_space = $max_len;
			} else {
				$last_space = strrpos($trimmed_text, ' ');
			}
			if (!($last_space === false)) {
				$trimmed_text = substr($trimmed_text, 0, $last_space);
			}
			return remove_trailing_punctuation($trimmed_text).$trim_chars;

		}
	}

	function remove_trailing_punctuation($text)
	{
		return preg_replace("'[^a-zA-Z_0-9]+$'s", '', $text);
	}

	function widget_ultimi_articoli($idLingua, $limit = 5)
	{
		global $idLingua, $base, $urlSezioneBlog;
		$articoli = get_elenco_articoli($idLingua);
		?>
			<div class="panel panel-default">
				<div class="panel-heading">Ultimi articoli</div>
				<div class="panel-body">
					<ul class="list-group">
  						<?php
							foreach($articoli as $articolo)
							{
								$perm = $base.$urlSezioneBlog.strip_tags($articolo["permalink"]).".html";
								?>
									<li class="list-group-item">
										<a href="<?php echo $perm ?>"><?php echo $articolo["titolo"] ?></a> - 
										<time datetime="<?php echo strftime("%Y-%m-%d", $articolo["dataPubblicazione"]) ?>" itemprop="datePublished">
											<?php echo ucwords(strftime("%e %B %g", $articolo["dataPubblicazione"])) ?>
										</time>
									</li>
								<?php
							}
						?>
					</ul>
				</div>
			</div>

		<?php
	}

	function mappa_eventi($pageData)
	{
		?>
			<div class="container-fluid mappaEventi">
				<div class="row">
					<div class="col-lg-12 blueBackground">
						<h2 class="titoloMappa">Mappa eventi</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8 pl0">
						<?php map() ?>
					</div>
					<div class="col-lg-4">
						<?php modulo_contatti() ?>
					</div>
				</div>
			</div>
		<?php
	}

	function bannerino($distance = true)
	{
		global $linkPerRegistrareEventi;
		?>
			<div class="container-fluid<?php if($distance) echo ' distanceMe'; ?> text-center seiPsico<?php if($distance == false) echo ' mt0'; ?>">
				<span class="h5">Sei uno psicologo? <a class="blueText" href="<?php echo $linkPerRegistrareEventi ?>"><strong>Registra il tuo evento o inserisci la tua consulenza</strong></a></span>
			</div>
		<?php
	}

	function widget_cerca_articoli($idLingua, $action)
	{
		?>
			<div class="panel panel-default">
				<div class="panel-heading">Cerca nel blog</div>
				<div class="panel-body">
					<form method=GET action="<?php echo strip_tags($action) ?>" class="mb0">
						<div class="input-group">
							<input type="text" class="form-control" name="cercaBlog" placeholder="Cerca"<?php if(isSet($_GET["cercaBlog"])) echo ' value="'.addslashes($_GET["cercaBlog"]).'"' ?>>
							<span class="input-group-btn">
								<button class="btn btn-primary" type="submit">Cerca</button>
							</span>
						</div>
					</form>
				</div>
			</div>
		<?php
	}

	function top($pageData)
	{
		global $appID, $photoFeed;
		$base = $pageData["base"];
		$root = $pageData["root"];
		?>
			<!DOCTYPE html>
			<html lang="it">
				<head>
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<?php
						if($pageData["title"] != "")
						{
							?>
								<title><?php echo ($pageData["title"]); ?> | Mese del Benessere Psicologico</title>
							<?php
						}
						else{
							?>
								<title>Mese del Benessere Psicologico</title>
							<?php
						}
						if($pageData["description"] != "")
						{
							?>
								<meta name="description" content="<?php echo ($pageData["description"]) ?>" />
							<?php
						}
						foreach($pageData["property_content"] as $key=>$value)
						{
							if($value != "")
							{
								?>
									<meta name="<?php echo $key ?>" content="<?php echo ($value) ?>" />
								<?php
							}
						}					
					?>
					<link href="<?php echo $root ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
					<link href="<?php echo $root ?>bootstrap/css/start.css" rel="stylesheet">
					<link href="<?php echo $root ?>braingest/adminPageView/css/font-awesome.css" rel="stylesheet">
					<link href="<?php echo $root ?>custom.css" rel="stylesheet">
					<script type="text/javascript" src="<?php echo $root ?>bootstrap/js/jquery.min.js"></script>
					<script type="text/javascript" src="<?php echo $root ?>custom.js"></script>
					<script type="text/javascript">
						window.fbAsyncInit = function()
						{
							FB.init({
								appId		: '<?php echo $appID ?>', // App ID
								status		: true, // check login status
								cookie		: true, // enable cookies to allow the server to access the session
								xfbml		: true,  // parse XFBML
								oauth		: true,
								version    : 'v2.1'
							});

							
								
							var colors = new Array("#4CDAE7","<?php echo $pageData["mainMenu"]["consulenze"]["color"] ?>","<?php echo $pageData["mainMenu"]["eventi"]["color"] ?>");
										  
							
							var photoUri = "<?php echo $photoFeed ?>";							
							ajax(photoUri,function(data)
											{
												var obj = JSON.parse(data);
												data = obj.data;
												var htmlGallery = "<div class='row'>";
												var perRiga = 3;
												var righe = 1;
												var cols = 12/perRiga;
												for (i=0; i<(perRiga * righe); i++)
												{
													if(((i%perRiga) == 0) && (i!=0))
														htmlGallery += '</div><div class="row">';
													var indexImmagine = 0;//data[i].images.length-4;
													if(data[i].name != undefined)
														var nome = data[i].name.trunc(200,true);
													else
														var nome = "";
													htmlGallery += '<div class="col-lg-'+cols+'"><a href="http://www.facebook.com/'+data[i].id+'" target=_blank><img src="'+data[i].images[indexImmagine].source+'" class="w100"></a><div class="row"><div class="col-lg-12"><span class="nome mt20 display-block"><span class="quadrato big" style="background-color: '+colors[i]+'"></span>'+nome+'</span></div></div></div>';													
												}
												htmlGallery += "</div>";
												$("#fbWrapContent").html(htmlGallery);
											}
								);
						};
						// Load the SDK Asynchronously
						(function(d, s, id){
						 var js, fjs = d.getElementsByTagName(s)[0];
						 if (d.getElementById(id)) {return;}
						 js = d.createElement(s); js.id = id;
						 js.src = "//connect.facebook.net/en_US/sdk.js";
						 fjs.parentNode.insertBefore(js, fjs);
					   }(document, 'script', 'facebook-jssdk'));
					</script>
					<!--Google Analytics-->
					<script> 
					  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ 
					  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), 
					  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) 
					  })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); 

					  ga('create', 'UA-32639767-50', 'auto'); 
					  ga('send', 'pageview'); 

					</script> 

					<!--Google Webmaster Tools-->
					<meta name="google-site-verification" content="6E0j6cF5ZK81QMO51550VcAxAPRpP1SOIIjwdLz6PAk" /> 

					<!--Bing Webmaster Tools-->
					<meta name="msvalidate.01" content="05E731DCC4167F6040BD0EC94A364524" /> 
				</head>
				<body<?php if(false) /*$pageData["menuItem"] != "home") */ { ?> class="fixedMenu"<?php } ?> onLoad="setScroll()">
					<?php
						if(isSet($_SESSION["alert"]) and count($_SESSION["alert"]) > 0)
						{
							?>
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content <?php echo $_SESSION["alert"]["classe"] ?> text-center">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel"><?php echo $_SESSION["alert"]["titolo"] ?></h4>
											</div>
											<div class="modal-body">
												<p>
													<?php echo $_SESSION["alert"]["testo"] ?>
												</p>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
											</div>
										</div>
									</div>
								</div>
								<script type="text/javascript">
									$(window).load(function(){
										$('#myModal').modal('show');
									});
								</script>
							<?php
							unset($_SESSION["alert"]);
						}
					?>
					<?php
						if(true)//$pageData["menuItem"] == "home")
						{
							?>
								<div id="slideshow" class="up-the-fixed">
									<div class="container">
										<div class="inner">
											<p class="line">
												<span style="background: #FFFFFF; padding-right: 10px;"><strong>6a</strong> EDIZIONE</span>
											</p>
											<a class="logo">
												<img src="<?php echo $root ?>images/mese-benessere-psicologico-logo.png">
											</a>
											<div class="quando">
												<strong>arrivederci al 2016</strong>
											</div>
											<div class="clearFix"></div>
										</div>
									</div>
								</div>
							<?php
						}
					?>
					<div class="the-fixed">
						<nav class="navbar navbar-default">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="collapse navbar-collapse">
								<ul class="nav navbar-nav">
									<?php
										foreach($pageData["mainMenu"] as $key => $arr)
										{
											?>
												<li<?php menuItem($pageData["menuItem"], $key) ?>><a class="scrollLink" href="<?php echo $base.$arr["url"] ?>"><span class="quadrato" style="background-color: <?php echo $arr["color"] ?>"></span><?php echo $arr["label"]?></a></li>
											<?php
										}
										if(isSet($_SESSION["current_user"]) and (count($_SESSION["current_user"]) > 0))
										{
											?>
												<li><a>Benvenuto, <?php echo strip_tags($_SESSION["current_user"]["email"]) ?> <span onclick="document.forms['logout'].submit()">(Logout)</span></a></li>
											<?php
										}										
									?>
								</ul>
							</div>
						</nav>
					</div>
					<form method=POST name="logout" style="display: none;">
						<input type="hidden" name="logout" value="-1">
					</form>
		<?php
	}

	function bottom($pageData)
	{
		global $urlSezioneBlog, $denominazione, $linkPerRegistrareEventi;
		$base = $pageData["base"];
		$root = $pageData["root"];
		$idLingua = $pageData["idLingua"];
		?>
					<footer>
						<?php /*<div class="upperFooter">
							<div class="container">
								<div class="row">
									<div class="col-lg-2">
										<a href="<?php echo $pageData["footerMenu"]["home"]["url"] ?>">
											<img class="w100" src="/proto/images/logo-menu.png">
										</a>
										<div class="mt20">
											<?php info_generali() ?>
										</div>
									</div>									
									<div class="col-lg-3">
										<h3>Newsletter</h3>
										<div>
											<form method="POST" id="formNewsletter" name="formNewsletter">
												<fieldset>
													<input type="hidden" name="formNewsletter" value="-1">
													<div class="form-group">
														<input type="text" id="emailNewsletter" class="form-control" name="emailNewsletter">
													</div>
													<div class="form-group">
														<button type="button" onClick="checkNewsletterForm()" class="btn btn-primary">Invia</button>
													</div>												
													<div class="form-group">
														<label class="accepted"><input id="checkNewsletter" type="checkbox" name="accettoNewsletter"> Ho letto e accettato la <a href="<?php echo $base.$pageData["footerMenu"]["newsletter-policy"]["url"] ?>" target="_blank">newsletter policy</a></label>
													</div>
													<script>
														function checkNewsletterForm()
														{
															if(($("#checkNewsletter").is(":checked")) && ($("#emailNewsletter").val() != ""))
																document.forms["formNewsletter"].submit();
															else
																alert("Accettare le norme sulla privacy ed inserire l'indirizzo e-mail prima di procedere.");
														}
													</script>
												</fieldset>
											</form>
										</div>
									</div>
									<div class="col-lg-4">
										<h3>Blog</h3>										
									</div>
								</div>
							</div>
						</div> */ ?>
						<div class="text-center mt30 mb30">
							<a href="http://www.psicologipuglia.it/" target="_blank"><img src="<?php echo $root ?>images/ordine-nazionale.png"></a>
							<span class="h5 pt20 display-block">Sei uno psicologo? <a class="blueText" href="<?php echo $linkPerRegistrareEventi ?>"><strong>Registra il tuo evento o inserisci la tua consulenza</strong></a></span>
						</div>
						<div class="lowerFooter">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-lg-2 text-left copy">
										<p class="m0">&copy; <?php echo $denominazione ?> <?php echo date("Y") ?></p>
									</div>
									<div class="col-xs-12 col-lg-8 text-center">
										<nav class="footerMenu">
											<ul>
												<?php
													foreach($pageData["footerMenu"] as $key => $arr)
													{
														?>
															<li><a href="<?php echo $base.$arr["url"]?>"><?php echo $arr["label"]?></a></li>
														<?php
													}
												?>
											</ul>
										</nav>										
									</div>
									<div class="col-xs-12 col-lg-2 text-right bp">
										<a href="https://www.brainpull.com" alt="agenzia di comunicazione Bari Milano Brainpull" target=_blank><img src="<?php echo $root ?>images/logo-brainpull.png"></a>
									</div>
								</div>
							</div>
						</div>
					</footer>
					<script type="text/javascript" src="<?php echo $root ?>bootstrap/js/bootstrap.min.js"></script>
					<script type="text/javascript" src="<?php echo $root ?>bootstrap/js/jquery.mobile.custom.min.js"></script>
					<script type="text/javascript" src="<?php echo $root ?>ui-datepicker/jquery-ui.js"></script>
				</body>
			</html>
		<?php
	}
?>