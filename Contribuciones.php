<?php
$variable="";
$fichero='Usuarios-8.txt';
$usuarios=file($fichero);
$file = fopen("Usuarios-8-salida.csv", "w");
foreach ($usuarios as $usuario) {
	$articulos=$data=$articuloslimpios=$division="";
	$usuario = urlencode(trim($usuario));
    $articulos="https://es.wikipedia.org/w/index.php?title=Especial:Contribuciones/".$usuario."&limit=500";
    $articuloslimpios = trim($articulos, "\n");
    if($data = @file_get_contents($articuloslimpios)) {
        $division = explode('<li data-mw-revid="', $data);
        unset($division[0]);
        foreach ($division as $linea) {
            $division2 = explode("</a>", $linea);
            $division3 = explode('"', $division2[0]);
            $division4 = explode('title="', $division2[0]);
            $division5 = explode('">', $division4[1]);
            $titulo = $division5[0];
            $id=$division3[0];
            $fecha=$division3[count($division3)-1];
            $fecha=str_replace(">", "", $fecha);
            $grabar=$usuario . ";" . $titulo . ";". $id . ";" . $fecha . "\n";
            fwrite($file, $grabar);
        }
        echo ("Todo ha ido bien con " . $usuario . "<br>");
    } else {
        echo "------------------------> Error en el usuario: " . $usuario . "<br>";
    }
}
fclose($file);
?>