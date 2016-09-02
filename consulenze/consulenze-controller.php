<?php
	function get_elenco_consulenze($limit = 9999)
	{
		global $db;
		if($limit == 3)
			return $db->dbQuery("SELECT datiConsulenza.*, CONCAT(nome, ' ', cognome) AS dott FROM datiConsulenza INNER JOIN datiPersonali USING(idPsicologo) WHERE idPsicologo != 10867 ORDER BY RAND() LIMIT ".$limit);	
		return $db->dbQuery("SELECT datiConsulenza.*, CONCAT(nome, ' ', cognome) AS dott FROM datiConsulenza INNER JOIN datiPersonali USING(idPsicologo) LIMIT ".$limit);
	}

	function get_consulenza_by_permalink($permalink)
	{
		global $db;
		$consulenze = $db->dbQuery("SELECT datiConsulenza.*, CONCAT(nome, ' ', cognome) AS dott, email FROM datiConsulenza INNER JOIN datiPersonali USING(idPsicologo)");
		foreach($consulenze as $consulenza)
		{
			$perm = permalink($consulenza["dott"]." ".$consulenza["cittaConsulenza"]);
			if($perm == $permalink)
				return $consulenza;
		}
		return false;
	}

	function cerca_consulenze($citta)
	{
		global $db;
		return $db->dbQuery("SELECT datiConsulenza.*, CONCAT(nome, ' ', cognome) AS dott FROM datiConsulenza INNER JOIN datiPersonali USING(idPsicologo) WHERE cittaConsulenza LIKE '%".addslashes($citta)."%'");
	}
?>