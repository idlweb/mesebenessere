<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/parts.php");

	if(isSet($_POST["passAdmin"]))
	{
		if($_POST["passAdmin"] == "compleannoDiBob2015")
			$_SESSION["adminBoard"] = true;
	}

	if(!isSet($_SESSION["adminBoard"]))
	{
		?>
			<form method=POST>
				<input type="password" name="passAdmin">
				<input type="submit" value="Login">
			</form>
		<?php
		exit();
	}
	$pageData["menuItem"] = "area-riservata";

	

	$campi = array(
		"datiPersonali" => array(
			"nome" => array("label" => "Nome", "cols" => "col-lg-6"),
			"cognome" => array("label" => "Cognome", "cols" => "col-lg-6"),
			"telefono" => array("label" => "Telefono", "cols" => "col-lg-6"),
			"email" => array("label" => "E-mail", "cols" => "col-lg-6")
		),
		"datiEvento" => array(
			"titoloEvento" => array("label" => "Titolo", "cols" => "col-lg-12"),
			"sedeEvento" => array("label" => "Sede", "cols" => "col-lg-12"),
			"indirizzoEvento" => array("label" => "Indirizzo", "cols" => "col-lg-12"),
			"cittaEvento" => array("label" => "Citta", "cols" => "col-lg-4"),
			"capEvento" => array("label" => "CAP", "cols" => "col-lg-4"),
			"provinciaEvento" => array("label" => "Provincia", "cols" => "col-lg-4"),
			"periodoEvento" => array("label" => "Periodo", "cols" => "col-lg-6"),
			"orarioEvento" => array("label" => "Orario", "cols" => "col-lg-6"),
			"relatoriEvento" => array("label" => "Relatori", "cols" => "col-lg-12"),
			"descrizioneEvento" => array("label" => "Descrizione", "type" => "textarea", "cols" => "col-lg-12")
		),
		"datiConsulenza" => array(
			"descrizioneConsulenza" => array("label" => "Descrizione", "type" => "textarea", "cols" => "col-lg-12"),
			"sedeConsulenza" => array("label" => "Sede", "cols" => "col-lg-12"),
			"indirizzoConsulenza" => array("label" => "Indirizzo", "cols" => "col-lg-12"),
			"cittaConsulenza" => array("label" => "Citta", "cols" => "col-lg-4"),
			"capConsulenza" => array("label" => "CAP", "cols" => "col-lg-4"),
			"provinciaConsulenza" => array("label" => "Provincia", "cols" => "col-lg-4"),
			"periodoConsulenza" => array("label" => "Periodo", "cols" => "col-lg-6"),
			"orarioConsulenza" => array("label" => "Orario", "cols" => "col-lg-6"),
			"relatoriConsulenza" => array("label" => "Relatori", "cols" => "col-lg-12")
		)
	);

	

	if(isSet($_POST["emailPsico"]))
	{
		$emailPsico = addslashes($_POST["emailPsico"]);
		$queryIni = "SELECT idutenti_psico FROM utenti_psico WHERE email = '".$emailPsico."'";
		$res = $db->dbQuery($queryIni);
		$idPsicologo = addslashes($res[0]["idutenti_psico"]);
		
		$queryPersonali = "SELECT * FROM datiPersonali WHERE idPsicologo = '".$idPsicologo."'";
		$resPersonali = $db->dbQuery($queryPersonali);
		$queryEvento = "SELECT * FROM datiEvento WHERE idPsicologo = '".$idPsicologo."'";
		$resEvento = $db->dbQuery($queryEvento);
		$queryConsulenza = "SELECT * FROM datiConsulenza WHERE idPsicologo = '".$idPsicologo."'";
		$resConsulenza = $db->dbQuery($queryConsulenza);
	}

	if(isSet($_POST["cmdfileDaCaricare"]))
	{
		$target_dir = "grafiche/";
		$uploadOk = 1;
		$imageFileType = pathinfo($_FILES["fileDaCaricare"]["name"], PATHINFO_EXTENSION);		
		// Allow certain file formats
		/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}*/
		
		$filename = $_POST["descrizione"]."_".time().".".$imageFileType;
		$target_file = $target_dir . $filename;
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		}
		else 
		{
			if (move_uploaded_file($_FILES["fileDaCaricare"]["tmp_name"], $target_file))
			{
				//echo "The file ". basename( $_FILES["fileDaCaricare"]["name"]). " has been uploaded.";
				if($_POST["descrizione"] == "consulenza")
					$query = "UPDATE datiConsulenza SET url = '".addslashes($filename)."' WHERE idPsicologo = ".$idPsicologo;
				else
				{
					if($_POST["descrizione"] == "evento")
						$query = "UPDATE datiEvento SET url = '".addslashes($filename)."' WHERE idDatiEvento = ".addslashes($_POST["numEvento"]);
				}
				//echo $query;
				$db->dbQuery($query);
				//invia_notifica_per_grafica_caricata($emailPsico, $filename, $_POST["descrizione"], array("noreply@mesedelbenesserepsicologico.it"));
				alert("Complimenti!", "Immagine inviata all'utente", "green");
			}
			else
			{
				alert("Attenzione!", "Errore di sistema, contattare Domenico a qualsiasi ora del giorno e della notte.", "red");
			}
		}
	}

	function invia_notifica_per_grafica_caricata($email, $filename, $tipo, $bcc)
	{
		global $campi;
		
		if(true)//($nome != "") and ($messaggio != "") and ($telefono != "") and ($accetto == "on") and (!(filter_var($email, FILTER_VALIDATE_EMAIL) === false)))
		{		
			//autenticazione al server
			$serverSMTP = "mail.mesedelbenesserepsicologico.it";
			$portaSMTP = 25;
			$indirizzoLogin = "noreply@mesedelbenesserepsicologico.it";
			$passwordLogin = 'p05nE2o0-69F-,6(5OMSl?#a.';

			//attori di posta
			$indirizzoMittente = $indirizzoLogin;
			$nomeMittente = "Ordine degli Psicologi di Puglia";
			$indirizzoDestinatario = $email;

			//messaggio
			$oggetto = "Nuova grafica caricata";
			$logoCliente = "http://www.mesedelbenesserepsicologico.it/images/logo-email.png";
			$larghezzaLogoCliente = 251;
			$coloreCliente = "#FBCC00";
			$htmlBody = "<div>
							<img src='".$logoCliente."' style='width:".$larghezzaLogoCliente."px; margin: auto; display: block;'>
							<div style='margin: 20px 0px 30px 0px; background-color: #6CC067; height: 3px;'></div>
							<p>Gentile utente,<br>è stata caricata una grafica di tipo '".$tipo."' dallo staff. Può trovarla in allegato a questa mail o scaricarla a <a href='http://mesedelbenesserepsicologico.it/grafiche/".$filename."' target=_blank>questo link</a>.</p>							
							<div style='margin: 20px 0px 30px 0px; background-color: #F47954; height: 3px;'></div>
							<i>Servizio contatti Brainpull</i>
						</div>";
			$htmlBody = str_replace("€","&euro;",$htmlBody);
			if(!manda_mail($serverSMTP, $portaSMTP, $indirizzoLogin, $passwordLogin, $nomeMittente, $indirizzoDestinatario, $indirizzoMittente, $oggetto, $htmlBody, $bcc, "grafiche/".$filename))
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

	top($pageData);
?>
	<div class="container distanceMe" id="distanceMe">
		<form method=POST>
			<h1>Ricerca utente</h1>
			<div class="form-group">
				<label>Inserisci l'e-mail dell'utente</label>
				<input type="text" class="form-control" name="emailPsico">
			</div>
			<div class="text-center">
				<button class="btn btn-primary" type="submit">Cerca</button>
			</div>
		</form>
	</div>
	<div class="container">
		<?php
			if(isSet($_POST["emailPsico"]))
			{
				$queryPersonali = "SELECT * FROM datiPersonali WHERE idPsicologo = '".$idPsicologo."'";
				$resPersonali = $db->dbQuery($queryPersonali);
				$queryEvento = "SELECT * FROM datiEvento WHERE idPsicologo = '".$idPsicologo."'";
				$resEvento = $db->dbQuery($queryEvento);
				$queryConsulenza = "SELECT * FROM datiConsulenza WHERE idPsicologo = '".$idPsicologo."'";
				$resConsulenza = $db->dbQuery($queryConsulenza);
				?>
					<h1 class="text-center">I tuoi dati</h1>
					<div class="row">
						<?php
							foreach($campi["datiPersonali"] as $id => $arr)
							{
								?>
									<div class="form-group <?php echo $arr["cols"] ?>">
										<label for="<?php echo $id ?>"><?php echo $arr["label"] ?></label>
										<span class="valoreAggiunto"><?php echo $resPersonali[0][$id] ?></span>
									</div>
								<?php
							}
						?>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-6">
							<h2>I tuoi eventi</h2>
							<div class="">
								<div>
									<div id="aggiungiForm2">
										<?php
											$i=0;
											foreach($resEvento as $evento)
											{
												$i++
												?>
													<div class="eventiEsistenti row">
														<h3 class="col-lg-12">Evento #<?php echo $i ?></h3>
														<div>
															<?php
																foreach($campi["datiEvento"] as $id => $arr)
																{
																	?>
																		<div class="form-group <?php echo $arr["cols"] ?>">
																			<label for="<?php echo $id ?>"><?php echo $arr["label"] ?></label>
																			<span class="valoreAggiunto"><?php echo $evento[$id] ?></span>
																		</div>
																	<?php
																}
															?>
														</div>
														<div class="col-lg-12">
															<?php
																if($resEvento[$i-1]["url"] != "")
																{
																	?>
																		<a href="<?php echo $root."grafiche/".$resEvento[$i-1]["url"] ?>" target=_blank>Visualizza la grafica</a>
																	<?php
																}
																else
																{
																	?>
																		<form method=POST enctype="multipart/form-data">
																			<div class="form-group">
																				<label>File da caricare</label>
																				<input type="file" name="fileDaCaricare" class="form-control">
																			</div>
																			<input type="hidden" name="cmdfileDaCaricare" value="-1">
																			<input type="hidden" name="descrizione" value="evento">
																			<input type="hidden" name="numEvento" value="<?php echo $resEvento[$i-1]["idDatiEvento"] ?>">
																			<input type="hidden" name="emailPsico" value="<?php echo $_POST["emailPsico"] ?>">
																			<button class="btn btn-primary">Carica</button>
																		</form>
																	<?php
																}
															?>
														</div>
													</div>
												<?php
											}
										?>
									</div>
								</div>
							</div>
						</div>				
						<div class="col-lg-6">
							<h2>La tua consulenza</h2>
							<div class="row">
								<?php
									foreach($campi["datiConsulenza"] as $id => $arr)
									{
										?>
											<div class="form-group <?php echo $arr["cols"] ?>">
												<label for="<?php echo $id ?>"><?php echo $arr["label"] ?></label>
												<span class="valoreAggiunto"><?php echo $resConsulenza[0][$id] ?></span>
											</div>
										<?php
									}
								?>
							</div>
							<?php
								if($resConsulenza[0]["url"] != "")
								{
									?>
										<a href="<?php echo $root."grafiche/".$resConsulenza[0]["url"] ?>" target=_blank>Visualizza la grafica</a>
									<?php
								}
								else
								{
									?>
										<form method=POST enctype="multipart/form-data">
											<div class="form-group">
												<label>File da caricare</label>
												<input type="file" name="fileDaCaricare" class="form-control">
											</div>
											<input type="hidden" name="cmdfileDaCaricare" value="-1">
											<input type="hidden" name="descrizione" value="consulenza">
											<input type="hidden" name="emailPsico" value="<?php echo $_POST["emailPsico"] ?>">
											<button class="btn btn-primary">Carica</button>
										</form>
									<?php
								}
							?>
						</div>
					</div>
				<?php
			}
		?>
	</div>
<?php
	bottom($pageData);
?>