<?php	//path per accesso via disco	$_SESSION["SITE_MAIN_FOLDER"] = $_SERVER["DOCUMENT_ROOT"]."/psico";		//path per accesso via HTTP	$_SESSION["SITE_MAIN_LINK"] = "http://localhost/psico";		//impostazioni di sicurezza	$_SESSION["allowed_tags"] = "<p><strong><b><em><i><ul><li><a><br><span>";	$_SESSION["php_keywords"] = array('exec', '$_get', '$_post', 'implode', 'array', 'echo');?>