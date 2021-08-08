<?php

if($_GET["type"]=="license")
{
	header("Content-Type: application/oct-stream"); 
	$_x218=dirname(__FILE__)."/phpeditor.lic";
	$_x57=filesize($_x218);
	//$_x147=@get_magic_quotes_runtime();
	//@set_magic_quotes_runtime(0);
	$_x149=fopen($_x218,"rb");
	$_x133=fread($_x149,$_x57);
	fclose($_x149);
	//@set_magic_quotes_runtime($_x147);
	echo(bin2hex($_x133));
	exit(200);
}

?>