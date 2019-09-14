<?php 
function label($label = []){
   return  '<span class="kt-badge  kt-badge--'.$label['class'].' kt-badge--inline kt-badge--pill">'.$label['status'].'</span>';
}

function check($fieldname, $id){
  $isCheck =  App\ArtistPermitRevision::where('fieldname', $fieldname)->where('artist_permit_id',$id)->where('ischeck', 1)->exists();
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


function profile($firstname = null, $lastname){
    $lastname = strtoupper(substr($lastname, 0, 1));
    $firstname = strtoupper(substr($firstname, 0, 1));
    return $firstname.$lastname;
}

function profile2($data = array()){
    $html = '<div class="kt-user-card-v2">';
    $html .= ' <div class="kt-user-card-v2__pic">';
        $name = substr($data['name'], 0, 1);
        $classes = ['info','success','danger', 'warning','primary', 'brand', 'dark'];
        $class = $classes[array_rand($classes)];
    $html .=    '<div class="kt-badge kt-badge--md kt-badge--'.$class.'"><span>'.strtoupper($name).'</span></div>';
    $html .= ' </div>';
    $html .= '  <div class="kt-user-card-v2__details"> ';
    $html .= '  <a class="kt-user-card-v2__name" href="#">'.ucwords($data['name']).'</a>';
    $html .= '  <span class="kt-user-card-v2__desc">'.ucwords($data['profession']).'</span>';
    $html .= ' </div>';
    $html .= '</div>';
    return $html;
}

function defaultProfile2($name){
    if($name){
        $name = substr($name, 0, 1);
          $classes = ['info','success','danger', 'warning','primary', 'brand', 'dark'];
          $class = $classes[array_rand($classes)];
     return '<div class="kt-badge kt-badge--md kt-badge--'.$class.'"><span>'.strtoupper($name).'</span></div>';
    }
}


function badgeName($name){
    $string = explode(' ', $name);
    $profile_name = null;
    foreach ($string as $char) { $profile_name .= substr($char, 0, 1); }
    $classes = ['info','success','danger', 'warning','primary', 'dark'];
    $class = $classes[array_rand($classes)];
    return '<div class="kt-badge kt-badge--md kt-badge--'.$class.'">'.$pro.'</div>';

}




 ?>