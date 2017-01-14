<?php
    $rawData = file( 'ranged_weapon_table.txt' );

    $rangedWeaponData = array();
    foreach( $rawData as $line )
    {
        if( (strpos($line, "#") === 0)||( strlen(trim($line))===0))
        {
            //skip
        }
        else
        {
            $fields = explode("\t", $line );
            if( count( $fields ) > 0 ){
                $id = "rwpn_" . preg_replace( "/[^a-zA-Z0-9][^a-zA-Z0-9]*/", "_", strtolower( $fields[0] ) );
                $rangedWeaponData[$id] = $fields;
            }
        }
    }

?>
