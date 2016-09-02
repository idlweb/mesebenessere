<?php
	function getAdminTemplate($locale)
	{
		$adminTemplate = file_get_contents($_SESSION["ADMIN_TEMPLATE_PAGE"]);
		$moduleMenu = "";
		$titleFromModule = "";
		foreach ($_SESSION["modules"] as $module)
		{
			$moduleName = $_GET["module"];
			if($moduleName == $module->getFolderName())
			{	
				$class = " titleBold";
				$titleFromModule = $module->getModuleName($locale);
			}
			else
				$class = "";
			$moduleMenu .= $module->getModuleMenu($locale);
		}
		$adminTemplate = str_replace('%%ADMIN_MENU_BAR%%',$moduleMenu,$adminTemplate);
		$adminTemplate = str_replace('%%TITLE%%',$titleFromModule,$adminTemplate);
		return $adminTemplate;
	}
	
	function permalink($permalink, $replace=array(), $delimiter='-')
	{
		if(!empty($replace))
		{
			$permalink = str_replace((array)$replace, ' ', $permalink);
		}

		$permalink = str_replace("à", "a", str_replace("è", "e", str_replace("ì", "i", str_replace("ò", "o", str_replace("ù", "u", $permalink)))));
		$permalink = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $permalink);
		$permalink = strtolower(trim($permalink, '-'));
		$permalink = preg_replace("/[\/_|+ -]+/", $delimiter, $permalink);

		return $permalink;
	}
	
	function save_Image($path, $fileName, $postImage, $oldFile = "")
	{
		if((isSet($postImage["error"])) and ($postImage["error"] != 0))
		{
			return $postImage["error"];
		}
		else
		{
			$time = time();
			$allowedExts = array("jpg","jpeg","png");
			$split = explode(".", $postImage["name"]);
			$extension = $split[count($split)-1];
			$fileName = $time."_".$fileName.".".$extension;
			if(in_array(strtolower($extension),$allowedExts))
			{
				$fileNameCompletoConPath = $path.$fileName;
				if ($postImage["error"] != 4)
				{
					if(move_uploaded_file($postImage["tmp_name"], $fileNameCompletoConPath))
					{
						if($oldFile != "")
							unlink($path.$oldFile);
						return $fileName;
					}
				}
			}
			else
			{
				return UPLOAD_ERR_EXTENSION;
			}
		}
	}
	
	function saveAllegato($path, $fileName, $postImage, $oldFile = "")
	{
		if((isSet($postImage["error"])) and ($postImage["error"] != 0))
		{
			return $postImage["error"];
		}
		else
		{
			$time = time();
			$allowedExts = array("pdf");
			$split = explode(".", $postImage["name"]);
			$extension = $split[count($split)-1];
			$fileName = $time."_".$fileName.".".$extension;
			if(in_array(strtolower($extension),$allowedExts))
			{
				$fileNameCompletoConPath = $path.$fileName;
				if ($postImage["error"] != 4)
				{
					if(move_uploaded_file($postImage["tmp_name"], $fileNameCompletoConPath))
					{
						if($oldFile != "")
							unlink($path.$oldFile);
						return $fileName;
					}
				}
			}
			else
			{
				return UPLOAD_ERR_EXTENSION;
			}
		}
	}
	
	function saveAttachment($path, $fileName, $postImage, $oldFile = "")
	{
		if((isSet($postImage["error"])) and ($postImage["error"] != 0))
		{
			return $postImage["error"];
		}
		else
		{
			$time = time();
			$allowedExts = array("jpg","jpeg","png","pdf");
			$split = explode(".", $postImage["name"]);
			$extension = $split[count($split)-1];
			$fileName = $time."_".$fileName.".".$extension;
			if(in_array(strtolower($extension),$allowedExts))
			{
				$fileNameCompletoConPath = $path.$fileName;
				if ($postImage["error"] != 4)
				{
					if(move_uploaded_file($postImage["tmp_name"], $fileNameCompletoConPath))
					{
						if($oldFile != "")
							unlink($path.$oldFile);
						return $fileName;
					}
				}
			}
			else
			{
				return UPLOAD_ERR_EXTENSION;
			}
		}
	}
?>