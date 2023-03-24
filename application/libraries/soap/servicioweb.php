<?php
include("lib/nusoap.php");
class servicioweb {

    private $objClienteSOAP;

    function __construct() {
        require_once dirname(__FILE__) . '/config.php';

        //$this->objClienteSOAP = new soapclient(URLCLIENT, array("login" => "wsapps", "password"  => "wsappsSkyfeet"));
      $this->objClienteSOAP = new soapclient(URLCLIENT/*, array("login" => "wsappsfeetco", "password"  => "r1c@rd0Aut0r!zo")*/);
        $this->objClienteSOAP->__setLocation(URLLOCATION);
    }


    public function enviar_mensaje($data){

		$params = array (
		"enviar_mensaje" => '<x:Envelope xmlns:x="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/"><x:Header/><x:Body><tem:enviar_mensaje><tem:imei>011412000099378</tem:imei><tem:de>3121509261</tem:de><tem:para>3121189964</tem:para><tem:mensaje>test2</tem:mensaje><tem:fecha_msj>05/23/2017</tem:fecha_msj><tem:pais>MX</tem:pais><tem:pais_salida>MX</tem:pais_salida></tem:enviar_mensaje></x:Body></x:Envelope>' );

    $params2=  array('imei'=>$data['imei'], 'de'=>$data['de'], 'para'=>$data['para'], 'mensaje'=>$data['mensaje'], 'fecha_msj'=>$data['fecha_msj'], 'pais'=>$data['pais'], 'pais_salida'=>$data['pais_salida']);
		$response = $this->objClienteSOAP->__soapCall('enviar_mensaje',array($params2));

		///$xml = json_decode(json_encode((array) simplexml_load_string($response->return)), 1);



		return $response->enviar_mensajeResult;
    }


}

?>
