<?php
error_reporting(1);
ini_set('display_errors', 1);

require dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'autoload.php';

$cfdi = new Comprobante();

// Preparar valores
$moneda = 'MXN';
$subtotal  = 190.00;
$iva       =  11.40;
$descuento =   1.40;
$total     = 200.00;
$fecha     = time();

// Establecer valores generales
$cfdi->LugarExpedicion   = '12345';
$cfdi->FormaPago         = '27';
$cfdi->MetodoPago        = 'PUE';
$cfdi->Folio             = '21';
$cfdi->Serie             = 'A';
$cfdi->TipoDeComprobante = 'I';
$cfdi->TipoCambio        = 1;
$cfdi->Moneda            = $moneda;
$cfdi->setSubTotal($subtotal);
$cfdi->setTotal($total);
$cfdi->setDescuento($descuento);
$cfdi->setFecha($fecha);

// Agregar emisor
$cfdi->Emisor = Emisor::init(
    'LAN7008173R5',                    // RFC
    '622',                             // Régimen Fiscal
    'Emisor Ejemplo'                   // Nombre (opcional)
);

// Agregar receptor
$cfdi->Receptor = Receptor::init(
    'XAXX010101000',                   // RFC
    'I08',                             // Uso del CFDI
    'Receptor Ejemplo'                 // Nombre (opcional)
);

// Preparar datos del concepto 1
$concepto = Concepto::init(
    '52141807',                        // clave producto SAT
    '2',                               // cantidad
    'P83',                             // clave unidad SAT
    'Nombre del producto de ejemplo',
    95.00,                             // precio
    190.00                             // importe
);
$concepto->NoIdentificacion = 'PR01'; // clave de producto interna
$concepto->Unidad = 'Servicio';       // unidad de medida interna
$concepto->Descuento = 0.0;

// Agregar impuesto (traslado) al concepto 1
$traslado = new ConceptoTraslado;
$traslado->Impuesto = '002';          // IVA
$traslado->TipoFactor = 'Cuota';
$traslado->TasaOCuota = 0.16;
$traslado->Base = $subtotal;
$traslado->Importe = $iva;
$concepto->agregarImpuesto($traslado);

// Agregar impuesto (retencion) al concepto 1
$traslado = new ConceptoRetencion;
$traslado->Impuesto = '001';          // ISR
$traslado->TipoFactor = 'Tasa';
$traslado->TasaOCuota = 0.10;
$traslado->Base = $subtotal;
$traslado->Importe = $traslado->Base * $traslado->TasaOCuota;
$concepto->agregarImpuesto($traslado);

// Agregar concepto 1 a CFDI
$cfdi->agregarConcepto($concepto);

// Agregar más conceptos al CFDI
// $concepto = Concepto::init(...);
// ...
// $cfdi->agregarConcepto($concepto);

// Agregar CFDIs relacionados
$tipoRelacion = '02';
$cfdi->CfdiRelacionados = CfdiRelacionados::init($tipoRelacion);
$cfdi->CfdiRelacionados->agregarUUID('670B9562-B30D-52D5-B827-655787665500');
$cfdi->CfdiRelacionados->agregarUUID('550E8400-E29B-41D4-A716-446655440000');


















// COMPLEMENTO "COMERCIO EXTERIOR 1.1"

$cfdi->customAttrs['xmlns:cce11'] = 'http://www.sat.gob.mx/ComercioExterior11';

$complementoCE = new ComplementoComercioExterior();

$complementoCE->setComercioExterior(
    '2', // TipoOperacion
    null, // MotivoTraslado
    'A1', // ClaveDePedimento
    '0', // CertificadoOrigen
    null, // NumCertificadoOrigen
    null, // NumeroExportadorConfiable
    'FOB', // Incoterm
    '0', // Subdivision
    null, // Observaciones
    18.8451, // TipoCambioUSD
    4917.00 // TotalUSD
);

$complementoCE->setEmisor(
    null, // 'BAJS721028MDFMTR05', // Curp
    'Hidalgo', // Domicilio_Calle
    'QUE', // Domicilio_Estado
    'MEX', // Domicilio_Pais
    '76224', // Domicilio_CodigoPostal
    '1000', // Domicilio_NumeroExterior
    '0209', // Domicilio_NumeroInterior
    '014', // Domicilio_Colonia
    null, // Domicilio_Localidad
    null, // Domicilio_Referencia
    '014' // Domicilio_Municipio
);

$complementoCE->setPropietario(
    '756985236', // NumRegIdTrib
    'AFG' // ResidenciaFiscal
);

// NumRegIdTrib debe incluirse en el Receptor de Comprobante,
// no del complemento
$cfdi->Receptor->NumRegIdTrib = '121585958';

$complementoCE->setReceptor(
    'Avenue Sahara', // Domicilio_Calle
    'NV', // Domicilio_Estado
    'USA', // Domicilio_Pais
    '45678', // Domicilio_CodigoPostal
    '74', // Domicilio_NumeroExterior
    null, // Domicilio_NumeroInterior
    'BIG DESERT', // Domicilio_Colonia
    null, // Domicilio_Localidad
    null, // Domicilio_Referencia
    null, // Domicilio_Municipio
    null // NumRegIdTrib
);

$complementoCE->setDestinatario(
    '756985236', // NumRegIdTrib
    'El Comercio USA Inc' // Nombre
);

$mercancia = $complementoCE->addMercancia(
    'A-123LFM', // NoIdentificacion
    2100.0, // ValorDolares
    '94059102', // FraccionArancelaria
    1200.0, // CantidadAduana
    '01', // UnidadAduana
    1.75 // ValorUnitarioAduana
);

$complementoCE->addDescripcionEspecifica(
    $mercancia, // Elemento $mercancia
    'marca 1', // Marca
    'modelo 1', // Modelo
    'sub modelo 1', // SubModelo
    'numero de serie 1' // NumeroSerie
);
$complementoCE->addDescripcionEspecifica($mercancia, 'marca 2', 'modelo 2', 'sub modelo 2', 'numero de serie 2');

$mercancia = $complementoCE->addMercancia('A-123JKL', 1437.0, '94059102',  958.0, '01', 1.5);
$complementoCE->addDescripcionEspecifica($mercancia, 'marca', 'modelo', 'sub modelo', 'numero de serie');

$complementoCE->addMercancia('A-123WHX', 1380.0, '94059102', 1150.0, '01', 1.2);

// Agregar complemento al CFDI
$cfdi->Complemento[] = $complementoCE;














// Ejemplo de objeto DOMDocument que contiene una Addenda

$addendaDoc = new DOMDocument();
$child = $addendaDoc->createElement('EjemploAddenda');
$child->setAttribute('atributo', 'valor');
$addendaDoc->appendChild($child);

// Agregar addenda al CFDI
$cfdi->Addenda[] = $addendaDoc;















// Mostrar XML del CFDI generado hasta el momento
// header('Content-type: application/xml; charset=UTF-8');
// echo $cfdi->obtenerXml();
// die;

// Cargar certificado que se utilizará para generar el sello del CFDI
$cert = new UtilCertificado();

// Si no se especifica la ruta manualmente, se intentará obtener automatícamente
// UtilCertificado::establecerRutaOpenSSL();

$ok = $cert->loadFiles(
    dirname(__FILE__).DIRECTORY_SEPARATOR.'LAN7008173R5.cer',
    dirname(__FILE__).DIRECTORY_SEPARATOR.'LAN7008173R5.key',
    '12345678a'
);
if(!$ok) {
    die('Ha ocurrido un error al cargar el certificado.');
}

$ok = $cfdi->sellar($cert);
if(!$ok) {
    die('Ha ocurrido un error al sellar el CFDI.');
}

// Mostrar XML del CFDI con el sello
header('Content-type: application/xml; charset=UTF-8');
//header('Content-Disposition: attachment; filename="xml/tu_archivo.xml');
echo $cfdi->obtenerXml();
die;

// Mostrar objeto que contiene los datos del CFDI
print_r($cfdi);


die;



die('OK');
