<?php
/*$dom = new DOMDocument();
$dom->load('http://globodi.com/cfdi/xml/ejemplos/ejemplo.php') or die("XML invalido");
//$dom->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0);
$dom->save('xml/tres.xml');
*/
$dom = new DOMDocument();
//$dom->preserveWhiteSpace = false;
//$dom->formatOutput = true;
$dom->load('http://globodi.com/cfdi/xml/ejemplos/ejemplo.php'); //XML de prueba
$dom->save('xml/nombre_fichero.xml');

?>
