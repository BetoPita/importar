<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Outputs an array or variable
*
* @param    $var array, string, integer
* @return    string
*/

    function debug_var($var = '')
    {
        echo _before();
        if (is_array($var))
        {
            print_r($var);
        }
            else
        {
            echo $var;
        }
        echo _after();
    }


function lquery()
    {
        $CI =& get_instance();
        echo $CI->db->last_query();
    }
//------------------------------------------------------------------------------

/**
* Outputs the last query
*
* @return    string
*/

    function debug_last_query()
    {
        $CI =& get_instance();
        echo _before();
        echo $CI->db->last_query();
        echo _after();
    }
    
//------------------------------------------------------------------------------

/**
* Outputs the query result
*
* @param    $query object
* @return    string
*/

    function debug_query_result($query = '')
    {
        echo _before();
        print_r($query->result_array());
        echo _after();
    }
    
//------------------------------------------------------------------------------

/**
* Outputs all session data
*
* @return    string
*/
    function debug_session()
    {
        $CI =& get_instance();
        echo _before();
        print_r($CI->session->all_userdata());
        echo _after();
    }

//------------------------------------------------------------------------------

/**
* Logs a message or var
*
* @param    $message array, string, integer
* @return    string
*/

    function debug_log($message = '')
    {
        is_array($message) ? log_message('debug', print_r($message)) : log_message('debug', $message);
    }

//------------------------------------------------------------------------------

/**
* _before
*
* @return    string
*/
    function _before()
    {
        $before = '<div style="padding:10px 20px 10px 20px; background-color:#fbe6f2; border:1px solid #d893a1; color: #000; font-size: 12px;>'."\n";
        $before .= '<h5 style="font-family:verdana,sans-serif; font-weight:bold; font-size:18px;">Debug Helper Output</h5>'."\n";
        $before .= '<pre>'."\n";
        return $before;
    }
    
//------------------------------------------------------------------------------

/**
* _after
*
* @return    string
*/

    function _after()
    {
        $after = '</pre>'."\n";
        $after .= '</div>'."\n";
        return $after;
    }
function trim_text($text, $count){
    $trimed = "";
    $text = str_replace("  ", " ", $text);
    $string = explode(" ", $text);
    $totalS = count($string);
    if($totalS>$count){
        for ( $wordCounter = 0; $wordCounter <= $count; $wordCounter++ ){
        $trimed .= $string[$wordCounter];
        if ( $wordCounter < $count ){ $trimed .= " "; }
        else { $trimed .= "..."; }
        }
        $trimed = trim($trimed);
        return $trimed;
    }else{
        return $text;
    }
}
//------------------------------------------------------------------------------
function trim_text_words($text, $count=''){
	$trimed = "";
	if($count==''){
		$count=100;
	}
	$text = str_replace("  ", " ", $text);
	if(strlen($text)>$count){
		return substr($text, 0,$count).'...';
	}else{
		return $text;
	}
}
 ?>