<?php

  
function unikat($dat, $stup, $query, $stup2, $query2){

    if(file_exists($dat))
    {
        $f = fopen($dat,'r');
        while(($redak = fgets($f, 4096)) !== false)
        {
            $polje = explode("::", $redak);
            if($polje[$stup] === $query && $polje[$stup2] === $query2)
            {
                return false;
            }
        }
        fclose($f);
    }
    
    return true;
    
}


?>