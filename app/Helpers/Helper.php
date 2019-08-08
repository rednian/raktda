<?php 

function label($label = []){
   return  '<span class="kt-badge  kt-badge--'.$label['class'].' kt-badge--inline kt-badge--pill">'.$label['status'].'</span>';
}

function check($fieldname, $id){
  $isCheck =  App\ArtistPermitRivision::where('fieldname', $fieldname)->where('artist_permit_id',$id)->where('ischeck', 1)->exists();
  return $isCheck ? 'checked' : '';
}

function getDocumentType($filename = null){
    if(!empty($filename)){
        $filename = explode('.', $filename);
        $filename = strtolower(end($filename));
        if($filename == 'jpg' || $filename  == 'jpeg' || $filename == 'png'){ $filename = 'image';}
        else if($filename == 'pdf'){ $filename = 'pdf';}
        else{ $filename = 'unknown document type';}
        return $filename;
    }
}

function defaultProfile($name, $isHidden = false){
    $string = explode(' ', $name);
    $profile_name = null;
    
    foreach ($string as $index => $char) { 
        if($index < 2){
         $profile_name .= substr($char, 0, 1); 
        }
    }

    $hidden = $isHidden ? 'kt-hidden': '';

    $classes = ['info','success','danger', 'warning','primary'];
    $class = 'kt-widget__pic--'.$classes[array_rand($classes)].' kt-font-'.$classes[array_rand($classes)].' '.$hidden;
    $html = '<div class="kt-widget__pic '.$class.' kt-font-boldest kt-font-light ">';
    $html .= strtoupper($profile_name);
    $html .= '</div>';

    return $html;

}


function badgeName($name){
    $string = explode(' ', $name);
    $profile_name = null;
    foreach ($string as $char) { $profile_name .= substr($char, 0, 1); }
    $classes = ['info','success','danger', 'warning','primary'];
    $class = $classes[array_rand($classes)];
    return '<div class="kt-badge kt-badge--md kt-badge--'.$class.'">'.$pro.'</div>';
}




 ?>