<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

if ( ! function_exists('hoy'))
{
	function hoy()
	{
		return date('Y-m-d H:i:s',now());
	}
}



if ( ! function_exists('rfc2822_to_mysql'))
{
	function rfc2822_to_mysql($date)
	{
		return date('Y-m-d H:i:s',strtotime($date));
	}
}


if ( ! function_exists('array_day'))
{
	function array_day()
	{
		$ret = array();
		for($i=1;$i<=31;$i++){
			$ret[$i] = (($i<10) ? '0'.$i : $i);
		}
		return $ret;
	}
}



if ( ! function_exists('array_month'))
{
	function array_month()
	{
		$ci =& get_instance();
		$ci->lang->load('calendar');

		$ret = array();
		$ret[1] = $ci->lang->line('cal_january');
		$ret[2] = $ci->lang->line('cal_february');
		$ret[3] = $ci->lang->line('cal_march');
		$ret[4] = $ci->lang->line('cal_april');
		$ret[5] = $ci->lang->line('cal_mayl');
		$ret[6] = $ci->lang->line('cal_june');
		$ret[7] = $ci->lang->line('cal_july');
		$ret[8] = $ci->lang->line('cal_august');
		$ret[9] = $ci->lang->line('cal_september');
		$ret[10] = $ci->lang->line('cal_october');
		$ret[11] = $ci->lang->line('cal_november');
		$ret[12] = $ci->lang->line('cal_december');
		return $ret;
	}
}




if ( ! function_exists('array_hour'))
{
	function array_hour($intervalo = 15, $HoraDesde = array('hora'=>0,'min'=>0), $HoraHasta=array('hora'=>23,'min'=>00))
	{

		$ret = array();
		$HoraMin = $HoraDesde;
		$hora = str_pad($HoraMin['hora'],2,0,STR_PAD_LEFT);
		$minuto = str_pad($HoraMin['min'],2,0,STR_PAD_LEFT);
		$ret[$hora.':'.$minuto] = $hora.':'.$minuto;
		do {
			$HoraMin['min'] = $HoraMin['min'] + $intervalo;
			if ($HoraMin['min'] >= 60) {
			   $HoraMin['min'] = 0;
			   $HoraMin['hora'] = $HoraMin['hora'] + 1;
			   if ($HoraMin['hora'] >= 24) {
			      $HoraMin['hora'] = 0;
			   }
			}
			if (($HoraMin['hora'] >= $HoraHasta['hora']) and ($HoraMin['min'] >= $HoraHasta['min'])) {
				break;
			}else{

				$hora = str_pad($HoraMin['hora'],2,0,STR_PAD_LEFT);
				$minuto = str_pad($HoraMin['min'],2,0,STR_PAD_LEFT);
				$ret[$hora.':'.$minuto] = $hora.':'.$minuto;


			}
		} while (true);
		return $ret;
	}
}



if ( ! function_exists('month_text')){
	function month_text($month)
	{
		$ci =& get_instance();
		$ci->lang->load('calendar');
		$ret = '';
		switch((integer) $month){
			case 1:
				$ret = $ci->lang->line('cal_january');
				break;
			case 2:
				$ret = $ci->lang->line('cal_february');
				break;
			case 3:
				$ret = $ci->lang->line('cal_march');
				break;
			case 4:
				$ret = $ci->lang->line('cal_april');
				break;
			case 5:
				$ret = $ci->lang->line('cal_mayl');
				break;
			case 6:
				$ret = $ci->lang->line('cal_june');
				break;
			case 7:
				$ret = $ci->lang->line('cal_july');
				break;
			case 8:
				$ret = $ci->lang->line('cal_august');
				break;
			case 9:
				$ret = $ci->lang->line('cal_september');
				break;
			case 10:
				$ret = $ci->lang->line('cal_october');
				break;
			case 11:
				$ret = $ci->lang->line('cal_november');
				break;
			case 12:
				$ret = $ci->lang->line('cal_december');
				break;

		}

		return $ret;
	}
}


if ( ! function_exists('date2sql'))
{
	function date2sql($date)
	{
		//D-M-Y
		if($date==''){
			return '';
		}
		$dateARR = explode('-',str_replace('/','-',$date));
		if(count($dateARR) == 3){
			if(strlen($dateARR[0]) == '4'){
				return $date;
			}else{
				return $dateARR[2].'-'.$dateARR[1].'-'.$dateARR[0]; //YYYY-MM-DD
			}
		}else{
			return '';
		}
	}
}

if ( ! function_exists('hoy2sql'))
{
	function hoy2sql(){
		return date('Y-m-d\TH:i:s');
	}
}


if ( ! function_exists('esBisiesto'))
{
	function esBisiesto($year){
	   return date('L',mktime(1,1,1,1,1,$year));
	}
}


if ( ! function_exists('date_eng2esp_1'))
{
	function date_eng2esp_1($date)
	{
		//Convertir fecha ingles a español
		// Y-M-D a d/m/Y
		// 0-1-2
		$dateARR = explode('-',str_replace('/','-',$date));
		if(count($dateARR) == 3){
			return $dateARR[2].'/'.$dateARR[1].'/'.$dateARR[0];
		}else{
			return '';
		}
	}
}
if ( ! function_exists('date_eng2esp_time'))
{
	function date_eng2esp_time($date)
	{
		//Convertir fecha ingles a español cuando es datetime
		
		$date = explode(" ",$date);
		$dateARR = explode('-',str_replace('/','-',$date[0]));
		if(count($dateARR) == 3){
			return $dateARR[2].'/'.$dateARR[1].'/'.$dateARR[0]." ".$date[1];
		}else{
			return '';
		}
	}
}

if ( ! function_exists('date_esp2eng'))
{
	function date_esp2eng($date)
	{
		//Convertir fecha español a ingles
		// d/m/Y a Y-M-D a
		// 0-1-2
		$res = '';
		$date = str_replace('/','-',trim($date));
		//Separar fecha hora
		$dateARR0 = explode(' ',$date);
		if(count($dateARR0) > 0){
			$dateARR = explode('-',$dateARR0[0]);
			if(count($dateARR) == 3){

				if(strlen($dateARR[0]) == 4){ //Esta en ingles
					$res = $dateARR[0].'-'.$dateARR[1].'-'.$dateARR[2];
				}else{
					$res = $dateARR[2].'-'.$dateARR[1].'-'.$dateARR[0];
				}
			}
		}

		if(count($dateARR0) == 2){
			$res .= ' ' . $dateARR0[1];
		}

		return $res;
	}
}

if ( ! function_exists('date_eng2esp'))
{
	function date_eng2esp($date,$format='d-m-Y H:i')
	{
		//Convertir fecha español a ingles
		// d/m/Y a Y-M-D a
		// 0-1-2

		$conv = new DateTime($date);
		return $conv->format($format);
	}
}




if ( ! function_exists('spanish_date'))
{
function spanish_date($date){

	$ci =& get_instance();
	$ci->lang->load('calendar');
	$ingles = array('jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec');
	$espanol = array(
			$ci->lang->line('cal_jan'),
			$ci->lang->line('cal_feb'),
			$ci->lang->line('cal_mar'),
			$ci->lang->line('cal_apr'),
			$ci->lang->line('cal_may'),
			$ci->lang->line('cal_jun'),
			$ci->lang->line('cal_jul'),
			$ci->lang->line('cal_aug'),
			$ci->lang->line('cal_sep'),
			$ci->lang->line('cal_oct'),
			$ci->lang->line('cal_nov'),
			$ci->lang->line('cal_dec'));


	return str_replace($ingles,$espanol,strtolower($date));


}
}




if ( ! function_exists('proceso_tiempo'))
{
   function proceso_tiempo ($fecha,$fecha2){



      if($fecha2 == ''){
	return $fecha;
      }

      $a  = explode(' ',$fecha);
      $a[1] = substr($a[1],0,8);
      $aFecha = explode('-',str_replace('/','-',$a[0]));
      $aHora = explode(':',$a[1]);


      $a2  = explode(' ',$fecha2);
      $a2[1] = substr($a2[1],0,8);
      $aFecha2 = explode('-',str_replace('/','-',$a2[0]));
      $aHora2 = explode(':',$a2[1]);

      $horaOrig = $aHora[0];
      $minOrig = $aHora[1];

      $diaOrig = $aFecha[2];
      $mesOrig = $aFecha[1];
      $anioOrig = $aFecha[0];


      $horaOrig2 = $aHora2[0];
      $minOrig2 = $aHora2[1];

      $diaOrig2 = $aFecha2[2];
      $mesOrig2 = $aFecha2[1];
      $anioOrig2 = $aFecha2[0];


       $fecha_unix = mktime($aHora[0],$aHora[1],$aHora[2],$aFecha[1],$aFecha[2],$aFecha[0]);
       $fecha_unix2 = mktime($aHora2[0],$aHora2[1],$aHora2[2],$aFecha2[1],$aFecha2[2],$aFecha2[0]);


      //obtener la hora en formato unix
        $ahora= $fecha_unix2;


        //obtener la diferencia de segundos
        $segundos=$ahora-$fecha_unix;

        //dias es la division de n segs entre 86400 segundos que representa un dia;
        $dias=floor($segundos/86400);

        //mod_hora es el sobrante, en horas, de la division de días;
        $mod_hora=$segundos%86400;

        //hora es la division entre el sobrante de horas y 3600 segundos que representa una hora;
        $horas=floor($mod_hora/3600);

        //mod_minuto es el sobrante, en minutos, de la division de horas;
        $mod_minuto=$mod_hora%3600;

        //minuto es la division entre el sobrante y 60 segundos que representa un minuto;
        $minutos=floor($mod_minuto/60);
        if($horas<=0 && $dias == 0){
		    if($minutos < 1){
		       if($segundos == 1){
				  $result = $segundos.' seg';
		       }else{
				  $result = $segundos.' seg';
	       		}
		    }elseif($minutos == 1){
			  $result = '1 min';
	    	}else{
	       		$result = $minutos.' min';
		    }
        }elseif($dias==0){
		    if($horas == 1){
			$result =  $horas.' hr '.$minutos.' min';
		    }else{
		       $result =  $horas.' hrs '.$minutos.' min';
		    }
	    }elseif($dias==1){
		if($horas == 1){
			$result =  $dias.' día, '.$horas.' hr '.$minutos.' min';
		}else{
		       $result =  $dias.' día, '.$horas.' hrs '.$minutos.' min';
		}
        }else{
		if($horas == 1){
			$result =  $dias.' días, '.$horas.' hr '.$minutos.' min';
		}else{
		       $result =  $dias.' días, '.$horas.' hrs '.$minutos.' min';
		}
	}
      return $result;
   }
}

if ( ! function_exists('dias_transcurridos'))
{
	function dias_transcurridos($fecha_i,$fecha_f)
	{
		$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
		$dias 	= abs($dias); $dias = floor($dias);
		return $dias;
	}
}

if ( ! function_exists('fecha_array')){

	function fecha_array($start, $end) {
	    $range = array();

	    if (is_string($start) === true) $start = strtotime($start);
	    if (is_string($end) === true ) $end = strtotime($end);

	    if ($start > $end) return createDateRangeArray($end, $start);

	    do {
	    	$fechaFinal = date_eng2esp(date('Y-m-d', $start));
	        $range[$fechaFinal] = $fechaFinal;
	        $start = strtotime("+ 1 day", $start);
	    } while($start <= $end);

	    return $range;
	}
}


 
if ( ! function_exists('format_hour'))
{
	function format_hour($hora)
	{
		$arrHORA =explode(':', $hora);

		if(count($arrHORA)>=2){
			return $arrHORA[0].':'.$arrHORA[1];
		}else{
			return $hora;
		}


	}
}

if ( ! function_exists('format_hour_date'))
{
	function format_hour_date($fecha)
	{
		
		$arrHORA =explode(' ', $fecha);
		if(count($arrHORA)>=2){

			return $arrHORA[0];
		}else{
			return $fecha;
		}


	}
}
