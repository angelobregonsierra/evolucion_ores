<?php
$variable="";
$datos='Usuarios-8-salida.csv';
$variable=file($datos);
$file = fopen("Usuarios-8-salida-ores.csv", "w");
foreach ($variable as $var) {
    $var = trim($var);
    $var = explode(';', $var);
    var_dump($var);
    $numero=$var[2];
    $articulo="https://ores.wikimedia.org/scores/eswiki/?models=damaging|goodfaith&revids=".$numero;
    if (!$data = file_get_contents($articulo)) {
        echo "Error de $var";
    }
    else {
        $data = json_decode($data,true);
        $danyofalse=$data[''.$numero.'']['damaging']['probability']['false'];
        $danyotrue=$data[''.$numero.'']['damaging']['probability']['true'];
        $buenafefalse=$data[''.$numero.'']['goodfaith']['probability']['false'];
        $buenafetrue=$data[''.$numero.'']['goodfaith']['probability']['true'];
        $grabar=$var[0].";".$var[1].";".$var[2].";".$var[3].";".$danyofalse.";".$danyotrue.";".$buenafefalse.";".$buenafetrue. "\n";
        fwrite($file, $grabar);
    }
}
fclose($file);
?>