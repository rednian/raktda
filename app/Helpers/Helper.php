<?php
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
    if ($status == 'processing' || $status == 'modification request' || $status == 'modified' || $status == 'need modification' || $status == 'amended') {
        $classname = 'warning';
    }
    if ($status == 'unprocessed' || $status == 'expired' || $status == 'rejected' || $status == 'cancelled') {
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
