<?php

	require 'config.php';
	//$mantenimiento = true;

	if($general["mantenimiento"] == true)
	{
		echo "Mantenimiento";
		header('location: '.$general["indexMantenimiento"]);
	}
	else
	{
		echo "Se redirige a la página";
		//header('location: web/index.php');
	}

?>