<?php

/**
 * Description of debug
 *
 * @author OMAR
 */
class debug {

    protected $output;

    public function __construct() {

    }
    static function showQuery( $string ) {
	
		global $output;
		$output[] = $string;
		return;
    }
    public function __toString() {
	
		global $ModeDeveloppement, $output;

		$html  = '';
		$html  = '<div id="debug">';
	
		if ( count($output) ) {
	    
		foreach ( $output as $line ) {
			$html .= '<p>'.$line.'</p>';
	    }
	}
	else {
		echo $ModeDeveloppement;
	    $html .= '<p>Acune requête à été exécuté !</p>';
	}

	$html .= '</div>';
	
	return $html;

    }
}