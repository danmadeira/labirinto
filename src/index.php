<?php

/* to Hide All Errors: */
//error_reporting(0);
//ini_set('display_errors', 0);

/* to Show All Errors: */
error_reporting(E_ALL);
ini_set('display_errors', 1);

//header('Content-Type: image/svg+xml');
//header('Content-Disposition: inline; filename="imagem.svg"');

foreach (glob("class/*.class.php") as $classe) {
    require_once("./$classe");
}

ConfiguracaoAmbiente::defineConstantes();

$sistema = new SistemaLabirinto;
echo $sistema->exibeLabirinto();
   
