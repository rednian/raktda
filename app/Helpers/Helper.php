<?php

function duration($start = null, $end = null){
    $days = Carbon\Carbon::parse($start)->diffInDays($end);
    return $days  >= 31 ? Carbon\Carbon::parse($start)->diffInMonths($end).' Month': $days.' Days';
}

function profileName($name = null, $type = null){

    $classname = ['dark', 'success', 'danger', 'warning', 'info', 'primary'];
    
    $first = explode(' ', $name);
    $first = strtoupper(substr($first[0], 0, 1));

    $html = '<div class="kt-user-card-v2">'; 
    $html .= '<div class="kt-user-card-v2__pic">'; 
    $html .= ' <div class="kt-badge kt-badge--xl kt-badge--'.$classname[array_rand($classname)].'"><span>'.$first.'</span></div>'; 
    $html .= ' </div>'; 
    $html .= ' <div class="kt-user-card-v2__details">'; 
    $html .= '  <span class="kt-user-card-v2__name">'.ucfirst($name).'</span>'; 
    $html .= '  <span class="kt-user-card-v2__email kt-link">'.ucfirst($type).'</span>'; 
    $html .= ' </div>'; 
    $html .= '</div>'; 

    return $html;

}

function humanDate($date){
    return $date-> diffForHumans();
}

function defaults($name = null, $role){
    $fname = explode(' ', $name);
    $html = '<div class="kt-user-card-v2">'; 
    $html .= ' <div class="kt-user-card-v2__pic">'; 
    $html .= ' <div class="kt-badge kt-badge--xl kt-badge--success"><span>'.strtoupper(substr($fname[0], 0, 1)).'</span></div>'; 
    $html .= '  </div>'; 
    $html .= '  <div class="kt-user-card-v2__details">'; 
    $html .= '   <span class="kt-user-card-v2__name">'.ucwords($name).'</span>'; 
    $html .= '   <span class="kt-user-card-v2__email kt-link">'.ucwords($role).'</span>'; 
    $html .= '   </div>'; 
    $html .= '   </div>'; 

    return $html;
}

function fileName($filename = null){
    $array = explode('.', $filename);
    return strtolower(array_pop($array));
}



function fileExtension($path)
{
    $ext = fileName($path);
    $className = null;
    switch ($ext) {
        case 'pdf':
            $className = 'la-file-pdf-o text-danger';
            break;
        case 'png':
            $className = 'la-file-photo-o text-warning';
            break;
        case 'jpeg':
            $className = 'la-file-photo-o text-warning';
            break;
        case 'jpg':
            $className = 'la-file-photo-otext-warning';
            break;
    }
    return '<span style="font-size:x-large" class="la ' . $className . '"></span>';
}


function language($data)
{
    $user = Auth::user()->LanguageId;

    return $user  == 1 ? $data['en'] : $data['ar'];
}


function eventType($type)
{

    $classname = null;
    if ('entertainment events / without ticket' == strtolower($type) || 'entertainment events / with ticket' == strtolower($type)) {
        $classname = 'fc-event-solid-warning';
    }
    if ('charity events / without ticket' == strtolower($type) || 'charity events / with ticket' == strtolower($type)) {
        $classname = 'fc-event-solid-info';
    }
    if ('religious  events / without ticket' == strtolower($type) || 'religious  events / with ticket' == strtolower($type)) {
        $classname = 'fc-event-light fc-event-solid-primary';
    }
    if ('business events' == strtolower($type) || 'business events' == strtolower($type)) {
        $classname = 'fc-event-solid-danger';
    }
    if ('sports events' == strtolower($type) || 'sports events' == strtolower($type)) {
        $classname = 'fc-event-solid-success';
    }

    if ('painting event' == strtolower($type)) {
        $classname = 'fc-event-solid-dark';
    }
    return $classname;
}

function eventStatus($status)
{
    $classname = null;
    if ('expired' == strtolower($status)) {
        $classname = 'fc-event-danger';
    }
    if ('active' == strtolower($status)) {
        $classname = 'fc-event-success';
    }
    return $classname;
}

function userType($type)
{
    if ($type == 1) {
        return 'private';
    }
    if ($type == 2) {
        return 'individual';
    }
    if ($type == 3) {
        return 'government';
    }
    if ($type == 4) {
        return 'employee';
    }
}



function permitStatus($status)
{
    $status = strtolower($status);
    $classname = null;
    if ($status == 'new' || $status == 'approved-unpaid' || $status == 'active') {
        $classname = 'success';
    }
    if ($status == 'send back for amendments' || $status == 'processing' || $status == 'modification request' || $status == 'modified' || $status == 'need modification' || $status == 'amended' || $status == 'pending') {
        $classname = 'warning';
    }
    if ($status == 'unprocessed' || $status == 'expired' || $status == 'rejected' || $status == 'cancelled' || $status == 'blocked') {
        $classname = 'danger';
    }
    if ($status == 'need approval') {
        $classname = 'warning';
    }
    if ($status == 'modification request') {
        $status = 'need modification';
    }

    return '<span class="kt-badge kt-badge--' . $classname . ' kt-badge--inline">' . ucwords($status) . '</span>';
}

function getTransactionReferNumber()
{
    $last_tran_d = \App\Transaction::latest()->first();
    if (empty($last_tran_d)) {
        $new_refer_no = sprintf("TRN%04d",  1);
    } else {
        $last_rn = $last_tran_d->reference_number;
        $n = substr($last_rn, 3);
        $f = substr($n, 0, 1);
        $l = substr($n, -1, 1);
        $x = 4;
        if ($f == 9 && $l == 9) {
            $x++;
        }
        $new_refer_no = sprintf("TRN%0" . $x . "d", $n + 1);
    }
    return $new_refer_no;
}

function generateEventPermitNumber()
{
    $last_permit_d = \App\Event::where('permit_number', 'not like', '%-%')->latest()->first();

    if (!isset($last_permit_d->permit_number)) {
        $new_permit_no = sprintf("EP%04d",  1);
    } else {
        $last_pn = $last_permit_d->permit_number;
        $n = substr($last_pn, 2);
        $f = substr($n, 0, 1);
        $l = substr($n, -1, 1);
        $x = 4;
        if ($f == 9 && $l == 9) {
            $x++;
        }
        $new_permit_no = sprintf("EP%0" . $x . "d", $n + 1);
    }
    return $new_permit_no;
}

function generateArtistPermitNumber()
{
    $last_permit_d = \App\Permit::orderBy('created_at', 'desc')->where('permit_number', 'not like', '%-%')->first();

    if (!isset($last_permit_d->permit_number)) {
        $new_permit_no = sprintf("AP%04d",  1);
    } else {
        $last_pn = $last_permit_d->permit_number;
        $n = substr($last_pn, 2);
        $f = substr($n, 0, 1);
        $l = substr($n, -1, 1);
        $x = 4;
        if ($f == 9 && $l == 9) {
            $x++;
        }
        $new_permit_no = sprintf("AP%0" . $x . "d", $n + 1);
    }
    return $new_permit_no;
}


function artistStatus($status)
{
    $classname = $status == 'active' ? 'success' : 'danger';
    return '<span class="kt-badge kt-badge--' . $classname . ' kt-badge--inline">' . ucwords($status) . '</span>';
}

function label($label = [])
{
    return '<span class="kt-badge  kt-badge--' . $label['class'] . ' kt-badge--inline kt-badge--pill">' . $label['status'] . '</span>';
}

function is($model, $fieldname)
{
    if ($model->check()->exists()) {
        if ($model->check()->first()->checklist()->exists()) {
            $check = $model->check()->first()->checklist()->where('fieldname', $fieldname)->first();
            if ($check) {
                if ($fieldname == $check->fieldname) {
                    return true;
                }
            }
        }
    }

    return false;
}

function getDocumentType($filename = null)
{
    if (!empty($filename)) {
        $filename = explode('.', $filename);
        $filename = strtolower(end($filename));
        if ($filename == 'jpg' || $filename == 'jpeg' || $filename == 'png') {
            $filename = 'image';
        } else if ($filename == 'pdf') {
            $filename = 'pdf';
        } else {
            $filename = 'unknown document type';
        }
        return $filename;
    }
}

function defaultProfile($fname, $lastname)
{
    $fname = substr($fname, 0, 1);
    $lastname = substr($lastname, 0, 1);
    return strtoupper($fname . $lastname);
}

function profile($firstname = null, $lastname)
{
    $lastname = strtoupper(substr($lastname, 0, 1));
    $firstname = strtoupper(substr($firstname, 0, 1));
    return $firstname . $lastname;
}

function profile2($data = [])
{
    $html = '<div class="kt-user-card-v2">';
    $html .= ' <div class="kt-user-card-v2__pic">';
    $name = substr($data['name'], 0, 1);
    $classes = ['info', 'success', 'danger', 'warning', 'primary', 'brand', 'dark'];
    $class = $classes[array_rand($classes)];
    $html .= '<div class="kt-badge kt-badge--md kt-badge--' . $class . '"><span>' . strtoupper($name) . '</span></div>';
    $html .= ' </div>';
    $html .= '  <div class="kt-user-card-v2__details"> ';
    $html .= '  <a class="kt-user-card-v2__name" href="#">' . ucwords($data['name']) . '</a>';
    $html .= '  <span class="kt-user-card-v2__desc">' . ucwords($data['profession']) . '</span>';
    $html .= ' </div>';
    $html .= '</div>';
    return $html;
}

function defaultProfile2($name)
{
    if ($name) {
        $name = substr($name, 0, 1);
        $classes = ['info', 'success', 'danger', 'warning', 'primary', 'brand', 'dark'];
        $class = $classes[array_rand($classes)];
        return '<div class="kt-badge kt-badge--md kt-badge--' . $class . '"><span>' . strtoupper($name) . '</span></div>';
    }
}

function badgeName($name)
{
    $string = explode(' ', $name);
    $profile_name = null;
    foreach ($string as $char) {
        $profile_name .= substr($char, 0, 1);
    }
    $classes = ['info', 'success', 'danger', 'warning', 'primary', 'dark'];
    $class = $classes[array_rand($classes)];
    return '<div class="kt-badge kt-badge--md kt-badge--' . $class . '">' . $pro . '</div>';
}

function getSettings()
{
    return \App\GeneralSetting::first();
}

function getLangId()
{
    return \Auth::user()->LanguageId;
}

function translateAr($word)
{
    $trans = App\ArabicTranslation::where('english', 'like', $word);
    if ($trans->exists()) {
        if (Auth::user()->LanguageId != 1) {
            return $trans->first()->arabic;
        }
    }
    return $word;
}

function check_is_blocked()
{
    $companyID  = Auth::user()->EmpClientId;
    $data['status'] = 'active';$data['comments'] = [];
    if($companyID){
        $data['status'] = Auth::user()->company->status;
    }
    if($data['status'] == 'blocked'){
        $data['comments'] = \App\CompanyComment::where('company_id', $companyID)->latest()->first();
    }
    return $data ;
}


