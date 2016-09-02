<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/parts.php");
	$pageData["menuItem"] = "area-riservata";


	$campi = array(
		"datiPersonali" => array(
			"nome" => array("label" => "Nome", "cols" => "col-lg-6"),
			"cognome" => array("label" => "Cognome", "cols" => "col-lg-6"),
			"telefono" => array("label" => "Telefono", "cols" => "col-lg-6"),
			"titolo" => array("label" => "Titolo (dott./dott.ssa)", "cols" => "col-lg-6"),
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

	function invia_notifica_per_grafica2($email, $bcc)
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
			$indirizzoMittente = $email;
			$nomeMittente = "Ordine degli Psicologi di Puglia";
			$indirizzoDestinatario = "graphic@brainpull.com";

			//messaggio
			$oggetto = "Nuovi eventi su Mesedelbenesserepsicologico.it";
			$logoCliente = "http://www.mesedelbenesserepsicologico.it/images/logo-email.png";
			$larghezzaLogoCliente = 251;
			$coloreCliente = "#FBCC00";
			$htmlBody = "<div>
							<img src='".$logoCliente."' style='width:".$larghezzaLogoCliente."px; margin: auto; display: block;'>
							<div style='margin: 20px 0px 30px 0px; background-color: #6CC067; height: 3px;'></div>
							<p>L'utente ".$email." con mail ha aggiunto un nuovo evento!</p>
							<table style='width: 100%;'>
								<tr>
									<td style='vertical-align: top;'>";							
										$tbl = array();
										foreach($campi["datiEvento"] as $id => $arr)
										{
											foreach($_POST[$id] as $numEvento => $val)
											{
												if($val != "")
												{
													if(!isSet($tbl[$numEvento]))
														$tbl[$numEvento] = "<h3>Dati nuovo evento #".($numEvento + 1).":</h3><table>";
													$tbl[$numEvento] .= "<tr><td>".strip_tags($arr["label"]).":</td><td>".strip_tags($val)."</td></tr>";
												}
											}
										}
										foreach($_POST[$id] as $numEvento => $val)
										{
											$htmlBody .= $tbl[$numEvento]."</table>";
										}
							$htmlBody .= "
									</td>
								</tr>
							</table>
							<div style='margin: 20px 0px 30px 0px; background-color: #F47954; height: 3px;'></div>
							<i>Servizio contatti Brainpull</i>
						</div>";
			$htmlBody = str_replace("€","&euro;",$htmlBody);
			if(!manda_mail($serverSMTP, $portaSMTP, $indirizzoLogin, $passwordLogin, $nomeMittente, $indirizzoDestinatario, $indirizzoMittente, $oggetto, $htmlBody, $bcc))
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

	if(isSet($_POST["aggiungiForm2"]))
	{
		$codicePsico = addslashes($_SESSION["current_user"]["idutenti_psico"]);
		//dati evento
		$campiStr = "";
		$valoriArr = array();
		
		foreach($campi["datiEvento"] as $id => $arr)
		{
			$campiStr .= ", ".$id;
			foreach($_POST[$id] as $numEvento => $val)
			{
				if(!isSet($valoriArr[$numEvento]))
					$valoriArr[$numEvento] = ", '".addslashes($val)."'";
				else
					$valoriArr[$numEvento] .= ", '".addslashes($val)."'";
			}
		}
		$queryEventi = "INSERT INTO datiEvento (idPsicologo".$campiStr.") VALUES";
		
		$i=0;
		foreach($valoriArr as $v)
		{			
			if($i != 0)
				$queryEventi .= ", ";
			$queryEventi .= "(".$codicePsico.$v.")";
			$i++;
		}
		$resEventi = $db->dbQuery($queryEventi);
		if($resEventi != false)
		{
			alert("Complimenti!","I dati sono stati salvati", "green");
			invia_notifica_per_grafica2($_SESSION["current_user"]["email"], array("domenico@brainpull.com", "noreply@mesedelbenesserepsicologico.it"));
		}
	}

	function invia_notifica_per_grafica($email, $bcc)
	{
		global $campi;
		$email = strip_tags($_POST["email"]);
		
		if(true)//($nome != "") and ($messaggio != "") and ($telefono != "") and ($accetto == "on") and (!(filter_var($email, FILTER_VALIDATE_EMAIL) === false)))
		{		
			//autenticazione al server
			$serverSMTP = "mail.mesedelbenesserepsicologico.it";
			$portaSMTP = 25;
			$indirizzoLogin = "noreply@mesedelbenesserepsicologico.it";
			$passwordLogin = 'p05nE2o0-69F-,6(5OMSl?#a.';

			//attori di posta
			$indirizzoMittente = $email;
			$nomeMittente = "Ordine degli Psicologi di Puglia";
			$indirizzoDestinatario = "graphic@brainpull.com";

			//messaggio
			$oggetto = "Nuova iscrizione su Mesedelbenesserepsicologico.it";
			$logoCliente = "http://www.mesedelbenesserepsicologico.it/images/logo-email.png";
			$larghezzaLogoCliente = 251;
			$coloreCliente = "#FBCC00";
			$htmlBody = "<div>
							<img src='".$logoCliente."' style='width:".$larghezzaLogoCliente."px; margin: auto; display: block;'>
							<div style='margin: 20px 0px 30px 0px; background-color: #6CC067; height: 3px;'></div>
							<p>Hai ricevuto una contatto dal tuo sito.</p>
							<table style='width: 100%;'>
								<tr>
									<td style='vertical-align: top;'>
										<h3>Dati personali:</h3>
										<table>";
											foreach($campi["datiPersonali"] as $id => $arr)
											{
												$htmlBody .= "<tr><td>".strip_tags($arr["label"]).":</td><td>".strip_tags($_POST[$id])."</td></tr>";
											}								
										$htmlBody .= "</table>

										<h3>Dati consulenza:</h3>
										<table>";
											foreach($campi["datiConsulenza"] as $id => $arr)
											{
												$htmlBody .= "<tr><td>".strip_tags($arr["label"]).":</td><td>".strip_tags($_POST[$id])."</td></tr>";
											}								
										$htmlBody .= "</table>
									</td>
									<td style='vertical-align: top;'>";							
										$tbl = array();
										foreach($campi["datiEvento"] as $id => $arr)
										{
											foreach($_POST[$id] as $numEvento => $val)
											{
												if(!isSet($tbl[$numEvento]))
													$tbl[$numEvento] = "<h3>Dati evento #".($numEvento + 1).":</h3><table>";
												$tbl[$numEvento] .= "<tr><td>".strip_tags($arr["label"]).":</td><td>".strip_tags($val)."</td></tr>";
											}
										}
										foreach($_POST[$id] as $numEvento => $val)
										{
											$htmlBody .= $tbl[$numEvento]."</table>";
										}
							$htmlBody .= "
									</td>
								</tr>
							</table>
							<div style='margin: 20px 0px 30px 0px; background-color: #F47954; height: 3px;'></div>
							<i>Servizio contatti Brainpull</i>
						</div>";
			$htmlBody = str_replace("€","&euro;",$htmlBody);
			if(!manda_mail($serverSMTP, $portaSMTP, $indirizzoLogin, $passwordLogin, $nomeMittente, $indirizzoDestinatario, $indirizzoMittente, $oggetto, $htmlBody, $bcc))
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

	if(isSet($_POST["iscriviPersona"]))
	{
		$codicePsico = addslashes($_SESSION["current_user"]["idutenti_psico"]);
		//dati personali
		$campiStr = "";
		$valoriStr = "";
		foreach($campi["datiPersonali"] as $id => $arr)
		{
			$campiStr .= ",".$id;
			$valoriStr .= ",'".addslashes($_POST[$id])."'";
		}		
		$queryPersonali = "INSERT INTO datiPersonali (idPsicologo".$campiStr.") VALUES (".$codicePsico.$valoriStr.")";
		
		
		//dati consulenza
		$campiStr = "";
		$valoriStr = "";
		foreach($campi["datiConsulenza"] as $id => $arr)
		{
			$campiStr .= ",".$id;
			$valoriStr .= ",'".nl2br(addslashes($_POST[$id]))."'";
		}		
		$queryConsulenza = "INSERT INTO datiConsulenza (idPsicologo".$campiStr.") VALUES (".$codicePsico.$valoriStr.")";
		
		//nexa slab ultra e regular
		
		//dati evento
		$campiStr = "";
		$valoriArr = array();
		
		/*"datiEvento" => array(
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
		),*/
		
		foreach($campi["datiEvento"] as $id => $arr)
		{
			$campiStr .= ", ".$id;
			foreach($_POST[$id] as $numEvento => $val)
			{
				if($val == "")
				{
					$tutti = false;
				}
				else
				{
					$almenoUno = true;
					if(!isSet($valoriArr[$numEvento]))
						$valoriArr[$numEvento] = ", '".nl2br(addslashes($val))."'";
					else
						$valoriArr[$numEvento] .= ", '".nl2br(addslashes($val))."'";
				}
			}
		}
		
		
		$queryEventi = "INSERT INTO datiEvento (idPsicologo".$campiStr.") VALUES";
		
		$i=0;
		foreach($valoriArr as $v)
		{			
			if(count(explode("''", $v)) == 1)
			{
				if($i != 0)
					$queryEventi .= ", ";
				$queryEventi .= "(".$codicePsico.$v.")";
				$i++;
			}
			else
				alert("Attenzione!", "Riprovare compilando tutti i campi degli eventi inseriti. Gli eventi incompleti sono stati ignorati.", "red");
		}
			
		$resPersonali = $db->dbQuery($queryPersonali);
		$resConsulenza = $db->dbQuery($queryConsulenza);
		if($i > 0)
			$resEventi = $db->dbQuery($queryEventi);/**/
		else
			$resEventi = true;
		//echo "<br><br>".$queryPersonali."<br><br>".$queryConsulenza."<br><br>".$queryEventi."<br><br>";
		if(($resPersonali != false) and ($resConsulenza != false) and ($resEventi != false))
		{
			alert("Complimenti!","I dati sono stati salvati", "green");
			invia_notifica_per_grafica($email, array("domenico@brainpull.com", "noreply@mesedelbenesserepsicologico.it"));
		}
	}

	top($pageData);
?>
	<div class="container distanceMe" id="distanceMe">
		<?php
			if(isSet($_SESSION["current_user"]) and (count($_SESSION["current_user"])>0))
			{
				$queryPersonali = "SELECT * FROM datiPersonali WHERE idPsicologo = '".addslashes($_SESSION["current_user"]["idutenti_psico"])."'";
				$resPersonali = $db->dbQuery($queryPersonali);
				$queryEvento = "SELECT * FROM datiEvento WHERE idPsicologo = '".addslashes($_SESSION["current_user"]["idutenti_psico"])."'";
				$resEvento = $db->dbQuery($queryEvento);
				$queryConsulenza = "SELECT * FROM datiConsulenza WHERE idPsicologo = '".addslashes($_SESSION["current_user"]["idutenti_psico"])."'";
				$resConsulenza = $db->dbQuery($queryConsulenza);
				?>
					<div class="row">
						<div class="col-lg-12">
							<?php
								if((count($resPersonali) == 0) and (count($resEvento) == 0) and (count($resConsulenza) == 0))
								{
									?>
										<div id="myModal" class="modal fade" role="dialog">
											<div class="modal-dialog" style="wid_th: 90%;">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h2 class="text-center"><span class="quadrato medium" style="background-color: #5D5D5E"></span> Riepilogo</h2>
													</div>
													<div class="modal-body">
														<div class="row">
															<div class="col-lg-12">
																<h2 class="text-center"><span class="quadrato medium" style="background-color: #5D5D5E"></span> Dati personali</h2>
																<div id="newInfoPersonali" class="row">
																</div>
															</div>
															<div class="col-lg-12">
																<h2 class="text-center"><span class="quadrato medium" style="background-color: #6CC067"></span> La tua consulenza</h2>
																<div id="newInfoConsulenza" class="row">
																</div>
															</div>
															<div class="col-lg-12">
																<h2 class="text-center"><span class="quadrato medium" style="background-color: #F47954"></span> I tuoi eventi</h2>
																<div id="newInfoEventi" class="row">
																</div>
															</div>													
															<div class="col-lg-12 text-center">
																<h2><span class="quadrato medium" style="background-color: #FF0000"></span> Attenzione</h2>
																<p>
																	<strong>I dati qui riepilogati non saranno modificabili in futuro. Per eventuali variazioni, si dovrà contattare il servizio assistenza che provvederà manualmente al cambiamento dei dati.</strong>
																</p>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
														<button type="button" class="btn btn-primary" onClick="document.forms['formAggiungi'].submit();">Invia</button>
													</div>
												</div>
											</div>
										</div>
										<script>
											function read()
											{
												var html = $('#infoPersonali').html();
												var html = $(html).find(".form-group").each(function (){
													var id = $(this).find("input[type='text']").attr("id");
													var label = "<label class='display-block'><strong>"+$(this).find("label").html()+"</strong></label>";
													var span = "<span>"+$("#"+id).val()+"</span>";
													$(this).html(label+span);
												});
												$('#newInfoPersonali').html(html);
												$('#newInfoPersonali').append("<div class='col-lg-12'><hr></div>");
												
												
												var html = $('#infoConsulenza').html();
												var html = $(html).find(".form-group").each(function (){
													var id = $(this).find("input[type='text']").attr("id");
													if(id == undefined)
													{
														var id = $(this).find("textarea").attr("id");
													}
													var label = "<label class='display-block'><strong>"+$(this).find("label").html()+"</strong></label>";
													var span = "<span>"+$("#"+id).val()+"</span>";
													$(this).html(label+span);
												});
												$('#newInfoConsulenza').html(html);
												$('#newInfoConsulenza').append("<div class='col-lg-12'><hr></div>");
												
												
												var html = $('#infoEventi').html();
												var html = $(html).find(".form-group").each(function (){
													var id = $(this).find("input[type='text']").attr("id");
													if(id == undefined)
													{
														var id = $(this).find("textarea").attr("id");
													}
													var label = "<label class='display-block'><strong>"+$(this).find("label").html()+"</strong></label>";
													var span = "<span>"+$("#"+id).val()+"</span>";
													var hr = "";
													if($(this).find("label").html() == "Descrizione")
														hr = "<hr>";
													$(this).html(label+span+hr);
												});
												$('#newInfoEventi').html(html);
											}
										</script>
										<h1 class="text-center mt30 mb30"><span class="quadrato big" style="background-color: <?php echo $mainMenuITA["area-riservata"]["color"] ?>"></span> Aggiungi qui i tuoi dati</h1>
										<p class="text-center mb30">
											È obbligatorio inserire almeno i dati personali e quelli relativi alla consulenza. In seguito si potranno inserire gli eventi organizzati.
										</p>
										<form method=POST id="formAggiungi" name="formAggiungi">
											<div class="row" id="infoPersonali">
												<div>
													<?php
														foreach($campi["datiPersonali"] as $id => $arr)
														{
															?>
																<div class="form-group <?php echo $arr["cols"] ?>">
																	<label for="<?php echo $id ?>"><?php echo $arr["label"] ?></label>
																	<input class="form-control" type="text" name="<?php echo $id ?>" id="<?php echo $id ?>" data-field="<?php echo $id ?>">
																	<em class="formError" id="errore_<?php echo $id ?>">Il campo <?php echo $arr["label"] ?> è obbligatorio</em>
																</div>
															<?php
														}
													?>
												</div>
												<script>
													$("#email").val("<?php echo $_SESSION["current_user"]["email"]?>");
													$("#email").change(function(){$("#email").val("<?php echo $_SESSION["current_user"]["email"]?>");});
												</script>
											</div>
											<hr>
											<div class="row">
												<div class="col-lg-6" id="infoConsulenza">
													<h2><span class="quadrato medium" style="background-color: <?php echo $mainMenuITA["consulenze"]["color"] ?>"></span> Inserisci qui la tua consulenza</h2>
													<div class="row">
														<?php
															foreach($campi["datiConsulenza"] as $id => $arr)
															{
																?>
																	<div class="form-group <?php echo $arr["cols"] ?>">
																		<label for="<?php echo $id ?>"><?php echo $arr["label"] ?></label>
																		<?php
																			if(isSet($arr["type"]) and ($arr["type"] == "textarea"))
																			{
																				?>
																					<textarea rows= 5 class="form-control" name="<?php echo $id ?>" id="<?php echo $id ?>" data-field="<?php echo $id ?>"></textarea>
																				<?php
																			}
																			else
																			{
																				?>
																					<input class="form-control" type="text" name="<?php echo $id ?>" id="<?php echo $id ?>" data-field="<?php echo $id ?>">
																				<?php
																			}
																		?>
																		<em class="formError" id="errore_<?php echo $id ?>">Il campo <?php echo $arr["label"] ?> è obbligatorio</em>
																	</div>
																<?php
															}
														?>
													</div>
												</div>
												<div class="col-lg-6" id="infoEventi">
													<h2><span class="quadrato medium" style="background-color: <?php echo $mainMenuITA["eventi"]["color"] ?>"></span> Inserisci qui i dati dell'evento</h2>
													<div class="row">
														<div id="aggiungiForm">
															<fieldset>
																<?php
																	foreach($campi["datiEvento"] as $id => $arr)
																	{
																		?>
																			<div class="form-group <?php echo $arr["cols"] ?>">
																				<label for="<?php echo $id ?>"><?php echo $arr["label"] ?></label>
																				<?php
																					if(isSet($arr["type"]) and ($arr["type"] == "textarea"))
																					{
																						?>
																							<textarea rows= 5 class="form-control" name="<?php echo $id ?>[]" id="<?php echo $id ?>"></textarea>
																						<?php
																					}
																					else
																					{
																						?>
																							<input class="form-control" type="text" name="<?php echo $id ?>[]" id="<?php echo $id ?>">
																						<?php
																					}
																				?>
																			</div>
																		<?php
																	}
																?>
															</fieldset>
														</div>
														<p class="col-lg-12">
															<span class="h5 orangeText strong cursor-pointer" onClick="aggiungiForm()"><i class="fa fa-plus-circle"></i> Crea un nuovo evento</span>
														</p>
													</div>
												</div>
												<script>
													function aggiungiForm()
													{
														var num = $("#aggiungiForm fieldset").length;
														var html = '<fieldset>' +
															<?php
																foreach($campi["datiEvento"] as $id => $arr)
																{
																	?>
																		'<div class="form-group <?php echo $arr["cols"] ?>">' +
																			'<label for="<?php echo $id ?>"><?php echo $arr["label"] ?></label>' +
																				<?php
																					if(isSet($arr["type"]) and ($arr["type"] == "textarea"))
																					{
																						?>
																							'<textarea rows= 5 class="form-control" name="<?php echo $id ?>[]" id="<?php echo $id ?>"></textarea>' +
																						<?php
																					}
																					else
																					{
																						?>
																							'<input class="form-control" type="text" name="<?php echo $id ?>[]" id="<?php echo $id ?>">' +
																						<?php
																					}
																				?>
																		'</div>' +
																	<?php
																}
															?>
														'</fieldset>';
														$("#aggiungiForm").append(html);
													}
												</script>												
												<div class="col-lg-12 text-center mb30 mt30">
													<input type="hidden" name="iscriviPersona" value="-1">
													<span class="btn btn-orange" type="button" onClick="submit('formAggiungi')">Invia</span>
												</div>
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
																read();
																$('#myModal').modal('show');
															}
														});
													}
												</script>
											</div>
										</form>
									<?php
								}
								else
								{
									?>
										<div id="myModalNEW" class="modal fade" role="dialog">
											<div class="modal-dialog" style="wid_th: 90%;">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h2 class="text-center"><span class="quadrato medium" style="background-color: #5D5D5E"></span> Riepilogo</h2>
													</div>
													<div class="modal-body">
														<div class="row">
															<div class="col-lg-12">
																<h2 class="text-center"><span class="quadrato medium" style="background-color: #F47954"></span> I tuoi eventi</h2>
																<div id="newInfoEventi" class="row">
																</div>
															</div>													
															<div class="col-lg-12 text-center">
																<h2><span class="quadrato medium" style="background-color: #FF0000"></span> Attenzione</h2>
																<p>
																	<strong>I dati qui riepilogati non saranno modificabili in futuro. Per eventuali variazioni, si dovrà contattare il servizio assistenza che provvederà manualmente al cambiamento dei dati.</strong>
																</p>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
														<button type="button" class="btn btn-primary" onClick="document.forms['aggiungiForm3'].submit();">Invia</button>
													</div>
												</div>
											</div>
										</div>
										<script>
											function read()
											{
												var html = $('#infoEventi').html();
												var html = $(html).find(".form-group").each(function (){
													var id = $(this).find("input[type='text']").attr("id");
													if(id == undefined)
													{
														var id = $(this).find("textarea").attr("id");
													}
													var label = "<label class='display-block'><strong>"+$(this).find("label").html()+"</strong></label>";
													var span = "<span>"+$("#"+id).val()+"</span>";
													var hr = "";
													if($(this).find("label").html() == "Descrizione")
														hr = "<hr>";
													$(this).html(label+span+hr);
												});
												$('#newInfoEventi').html(html);
											}
										</script><h1 class="text-center mt30 mb30"><span class="quadrato big" style="background-color: <?php echo $mainMenuITA["area-riservata"]["color"] ?>"></span> Area riservata - I tuoi dati</h1>
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
												<h2><span class="quadrato medium" style="background-color: <?php echo $mainMenuITA["consulenze"]["color"] ?>"></span> La tua consulenza</h2>
												<?php
													if(count($resConsulenza) > 0)
													{
														if($resConsulenza[0]["url"] != "")
														{
															?>
																<a class="greenText" href="<?php echo $root."grafiche/".$resConsulenza[0]["url"] ?>" target=_blank>(scarica la grafica)</a>
															<?php
														}
														?>
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
													}
												?>
											</div>
											<div class="col-lg-6">
												<h2><span class="quadrato medium" style="background-color: <?php echo $mainMenuITA["eventi"]["color"] ?>"></span> I tuoi eventi</h2>
												<div class="">
													<form method=POST name="aggiungiForm3" id="aggiungiForm3">
														<div id="infoEventi">
															<div id="aggiungiForm2">
																<?php
																	$i=0;
																	foreach($resEvento as $evento)
																	{
																		$i++
																		?>
																			<div class="eventiEsistenti row">
																				<div class="col-lg-12">
																					<h3 class="display-inline mr20">Evento #<?php echo $i ?></h3>
																					<?php
																						if($evento["url"] != "")
																						{
																							?>
																								<a class="orangeText" href="<?php echo $root."grafiche/".$evento["url"] ?>" target=_blank>(scarica la grafica)</a>
																							<?php
																						}
																					?>
																				</div>
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
																			</div>
																		<?php
																	}
																?>
															</div>
														</div>
														<div class="col-lg-12 text-center mb30">
															<input type="hidden" name="aggiungiForm2" value="-1">
															<span class="btn btn-orange" id="showme" style="display: none;" type="button" onClick="submit('aggiungiForm3')">Invia</span>
														</div>
													</form>
													<p class="col-lg-12">
														<span class="h5 orangeText strong cursor-pointer" onClick="aggiungiForm2()"><i class="fa fa-plus-circle"></i> Crea un nuovo evento</span>
													</p>
												</div>
											</div>
											<script>
												function aggiungiForm2()
												{
													var num = $("#aggiungiForm2 .eventiEsistenti").length + $("#aggiungiForm2 fieldset").length +1;
													var html = '<fieldset class="row">' +
														'<h3 class="col-lg-12">Evento #'+num+'</h3>' +
														<?php
															foreach($campi["datiEvento"] as $id => $arr)
															{
																?>
																	'<div class="form-group <?php echo $arr["cols"] ?>">' +
																		'<label for="<?php echo $id ?>"><?php echo $arr["label"] ?></label>' +
																			<?php
																				if(isSet($arr["type"]) and ($arr["type"] == "textarea"))
																				{
																					?>
																						'<textarea rows= 5 class="form-control" name="<?php echo $id ?>[]" id="<?php echo $id ?>" data-field="<?php echo $id ?>'+num+'"></textarea>' +
																					<?php
																				}
																				else
																				{
																					?>
																						'<input class="form-control" type="text" name="<?php echo $id ?>[]" id="<?php echo $id ?>" data-field="<?php echo $id ?>'+num+'">' +
																					<?php
																				}
																			?>
																			'<em class="formError" id="errore_<?php echo $id ?>'+num+'">Il campo <?php echo $arr["label"] ?> è obbligatorio</em>' +
																	'</div>' +
																<?php
															}
														?>
													'</fieldset>';
													$("#aggiungiForm2").append(html);
													$("#showme").css("display", "inline-block");
												}
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
															read();
															$('#myModalNEW').modal('show');
														}
													});
												}
											</script>											
										</div>
									<?php
								}
							?>							
						</div>
					</div>
				<?php
			}
			else
			{
				?>
					<div class="mt120 mb120">
						<h1 class="text-center mt20 mb40"><span class="quadrato big" style="background-color: <?php echo $mainMenuITA[$pageData["menuItem"]]["color"] ?>"></span> Area riservata</h1>
						<p class="text-center mb20">
							Il mese del benessere psicologico in Puglia è terminato.<br><br><br>Segui L'Ordine degli Psicologi di Puglia per rimanere aggiornato su eventi e attività 2016.
						</p>
						<?php /*<form method=POST>
							<div class="row">
								<div class="col-lg-6 col-lg-offset-3">
									<div class="form-group">
										<label>E-mail</label>
										<div class="form-group">
											<input type="text" class="form-control" name="email">										
										</div>
									</div>
									<div class="form-group">
										<label>Numero albo</label>
										<div class="form-group">
											<input type="text" class="form-control" name="numeroAlbo">										
										</div>
									</div>									
									<div class="form-group text-center">
										<button type="submit" name="login" class="btn btn-orange">Accedi</button>
									</div>
								</div>
							</div>
						</form>*/ ?>
					</div>
				<?php
			}
		?>
	</div>
<?php
	bottom($pageData);
?>