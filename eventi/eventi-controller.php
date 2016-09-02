<?php
	function get_elenco_eventi($limit = 99999)
	{
		global $db;
		if($limit == 3)
			return $db->dbQuery("SELECT datiEvento.*, CONCAT(nome, ' ', cognome) AS dott, titolo FROM datiEvento INNER JOIN datiPersonali USING(idPsicologo) WHERE idPsicologo != 10867 ORDER BY RAND() LIMIT ".$limit);	
		return $db->dbQuery("SELECT datiEvento.*, CONCAT(nome, ' ', cognome) AS dott, titolo FROM datiEvento INNER JOIN datiPersonali USING(idPsicologo) LIMIT ".$limit);
	}

	function get_evento_by_permalink($permalink)
	{
		global $db;
		$eventi = $db->dbQuery("SELECT datiEvento.*, CONCAT(nome, ' ', cognome) AS dott, email, titolo FROM datiEvento INNER JOIN datiPersonali USING(idPsicologo)");
		foreach($eventi as $evento)
		{
			$perm = permalink($evento["dott"]." ".$evento["titoloEvento"]." ".$evento["cittaEvento"]);
			if($perm == $permalink)
				return $evento;
		}
		return false;
	}

	function cerca_eventi($citta)
	{
		global $db;
		return $db->dbQuery("SELECT datiEvento.*, CONCAT(nome, ' ', cognome) AS dott, titolo FROM datiEvento INNER JOIN datiPersonali USING(idPsicologo) WHERE LOWER(cittaEvento) LIKE '%".strtolower(addslashes($citta))."%'");
	}
?>