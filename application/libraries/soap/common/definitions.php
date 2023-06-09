<?php
	// Definición de tipos en nuestro servicio web -------------------------

	$server->wsdl->addComplexType(
		'TWsPersona',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'Nombre' => array('name' => 'Nombre', 'type' => 'xsd:string'),
			'Edad' => array('name' => 'Edad', 'type' => 'xsd:int'),
			'Sexo' => array('name' => 'Sexo', 'type' => 'xsd:string')
		)
	);

	$server->wsdl->addComplexType(
		'TWsArrayOfPersona',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(
			array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:TWsPersona[]')			 	
		),
		'tns:TWsPersona'
	);

	$server->wsdl->addComplexType(
	    'TWsResultadoSorteo',
	    'complexType',
	    'struct',
	    'all',
	    '',
	    array(
		'saludo' => array('name' => 'saludo', 'type' => 'xsd:string'),
		'ganador' => array('name' => 'ganador', 'type' => 'xsd:boolean')
	    )
	);


	


	// Definición de métodos en nuestro servicio web -------------------------------------------

	$server->register(
	    'hola',                		  // Nombre del método
	    array('nombre' => 'xsd:string'),      // Parámetros de entrada
	    array('hola' => 'xsd:string','mundo' => 'xsd:string'),      // Parámetros de salida
	    SOAP_SERVER_NAMESPACE,                // Nombre del workspace
	    SOAP_SERVER_NAMESPACE.'#hola',        // Acción soap
	    'rpc',                                // Estilo
	    'encoded',                            // Uso
	    'Saluda a la persona'       	  // Documentación
	);

	$server->register(
	    'IniciarSorteo',           		  	 // Nombre del método
	    array('Persona' => 'tns:TWsPersona'),    	 // Parámetros de entrada
	    array('return' => 'tns:TWsResultadoSorteo'), // Parámetros de salida
	    SOAP_SERVER_NAMESPACE,                	 // Nombre del workspace
	    SOAP_SERVER_NAMESPACE.'#IniciarSorteo',      // Acción soap
	    'rpc',                                	 // Estilo
	    'encoded',                            	 // Uso
	    'Saludar y devuelve el resultado del sorteo' // Documentación
	);

	$server->register(
	    'GetPersonas',           		  	 // Nombre del método
	    array(),    	 			 // Parámetros de entrada
	    array('return' => 'tns:TWsArrayOfPersona'),  // Parámetros de salida
	    SOAP_SERVER_NAMESPACE,                	 // Nombre del workspace
	    SOAP_SERVER_NAMESPACE.'#GetPersonas',        // Acción soap
	    'rpc',                                	 // Estilo
	    'encoded',                            	 // Uso
	    'Devuelve un array de personas' 		 // Documentación
	);
?>
