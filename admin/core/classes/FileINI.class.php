<?php

/*
 * CLASS INI
 * ACTIVEDEV.NET
 */

class FileINI {
	
    public function setVariables ( $IniFile, $IniKey, $IniVar ) {
	
        $this->Ini_Key = '['.strtolower($IniKey).']';
        $this->Ini_Variable = strtolower($IniVar);

        $this->Ini_File = file( $IniFile . '.config.php' );

        unset($this->Ini_Value);

        for($Ini_Rec = 0; $Ini_Rec < sizeof($this->Ini_File); $Ini_Rec++) {

            // Enregistrement
            $this->Ini_Temp = trim($this->Ini_File[$Ini_Rec]);
            $this->Ini_Tmp 	= strtolower($this->Ini_Temp);

            if ( substr_count($this->Ini_Tmp, '[') > 0 ) $this->Ini_Ready = 0;

            if ( $this->Ini_Tmp == $this->Ini_Key ) $this->Ini_Ready = 1;

            if ( (substr_count($this->Ini_Tmp, '[') == 0) && ($this->Ini_Ready == 1) ) {

                if (substr_count($this->Ini_Tmp, $this->Ini_Variable . '=') > 0) {
                         $this->Ini_Value = substr($this->Ini_Temp, strlen($this->Ini_Variable . '='));
                         return $this->Ini_Value;
                }

            } //fin if

        } // fin for

    } // fin function
    
} // fin class

?>