<?php
	class DBQuery
	{
		private $error = null;
		private $numRows = null;

		function __construct()
		{

		}

		public function dbQuery($sql, $result_type=MYSQLI_ASSOC)
		{
			$host = "127.0.0.1";
			$user = "userbenessere";
			$password = '&&,0Mwq^97?#G7k#F%Wd2K.?1';
			$db = "datapsyweb";
			$connection = mysqli_connect($host,$user,$password);
			if (!$connection)
			{
				echo ('Not connected : ' . mysqli_error());
			}
			mysqli_select_db($connection, $db);


			$res = mysqli_query($connection, $sql);
			$queryType = substr($sql,0,6);
			$numAffected = "#####";
			if($queryType == "SELECT")
			{
				$numAffected = mysqli_num_rows($res);
			}
			else
			{
				$numAffected = mysqli_affected_rows($connection);
			}

			//echo "<br><br><br>".$queryType." - ".$sql." - ".$numAffected;

			if (($res == false) && (is_numeric($numAffected)))
			{
				$this->error = mysqli_error();
				$this->numRows = null;
				return false;
			}
			else
			{
				$queryType = substr($sql,0,6);
				if (($queryType == "INSERT") or ($queryType == "UPDATE") or ($queryType == "DELETE"))//se la query è INSERT UPDATE o DELETE
				{
					$this->numRows = mysqli_affected_rows($connection);
					return true;
				}
				else
				{
					if (($queryType == "SELECT"))
					{
						$this->numRows = mysqli_num_rows($res);
						$return = array();
						$returnCount = 0;
						$array = array();
						while ($record = mysqli_fetch_array($res, $result_type))
						{
							$array = array();
							$keys = array_keys($record);
							for ($i = 0; $i < count($keys); $i++)
							{
								$key = $keys[$i];
								$array[$key] = $record[$key];

							}
							$return[$returnCount] = $array;
							$returnCount++;
						}
						return $return;
					}
				}
			}
		}

		public function fetchdbquery($sql)
		{
			$res = mysqli_query($connection, $sql);
			$output = array();
			$i = 0;
			while($record = mysqli_fetch_array($res))
			{
				$output[$i] = $record;
				$i++;
			}
			return $output;
		}

		public function dbError()
		{
			return $this->error;
		}

		public function dbRows()
		{
			return $this->numRows;
		}

		public function mysql_date_to_db($date)
		{
			return $date;
		}

		public function mysql_date_from_db($date)
		{
			return $date;
		}
	}
 ?>
