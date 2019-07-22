<?php 

function carbon($time = null, $tz = null)
{  
    
    $birthdate = strtotime($birthdate);

     return new \Carbon\Carbon($time, $tz);
}
