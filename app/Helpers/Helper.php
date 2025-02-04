<?php

use App\Library\Smpp;
use App\User;
use Illuminate\Support\Facades\Storage;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;
use App\Notifications\AllNotification;
use Carbon\Carbon;

function dateDuration($start, $end)
{
    $duration_in_days = Carbon::parse($end)->diffInDays($start);
    return $duration_in_days;
    // $date = Carbon::parse($permit->expired_date)->diffInDays($permit->issued_date);
}

function sms($number, $message = [])
{
    $is_payment = array_key_exists('payment', $message) ? 'payment' : 'details';
    $content = "Dear Customer,\nYour {$message['name']} application with reference number: {$message['reference_number']} has been {$message['status']}. Please click the link below for the {$is_payment}.\n{$message['url']}";
    sendSms($number, $content);
}


function sendSms($user_mobile_number = null, $message)
{
    $sender = 'RAKTOURISM';
    $smpp = new Smpp();
    $username = 'raktda';
    $password = 'Hpwfso0!';
    $destination_ip = '86.96.241.55';
    $port = '2775';

    $smpp->open($destination_ip, $port, $username, $password);

    $utf = true;
    $message = iconv('Windows-1256', 'UTF-16BE', $message);
    $smpp->send_long($sender, $user_mobile_number, $message, $utf);
    $smpp->close();
}


function requestType($type)
{
    if (in_array($type, ['amend request'])) {
        $type = 'amendment request';
    }
    return $type;
}

function duration($start = null, $end = null)
{
    // parts using either ',' or 'and' appropriately
    // $age = ($d = $diff->d) ? ' and '.$d.' '.str_plural('day', $d) : '';
    // $age = ($m = $diff->m) ? ($age ? ', ' : ' and ').$m.' '.str_plural('month', $m).$age : $age;
    // $age = ($y = $diff->y) ? $y.' '.str_plural('year', $y).$age  : $age;

    // // trim redundant ',' or 'and' parts
    // return ($s = trim(trim($age, ', '), ' and ')) ? $s.' old' : 'newborn';
    $days = Carbon::parse($start)->diff($end)->format('%m Month and %d days');
    return $days;
    return $days  >= 31 ? Carbon::parse($start)->diffInMonths($end) . ' Month' : $days . ' Days';
}

function type($name = null, $type = null)
{

    $classname = ['dark', 'success', 'danger', 'warning', 'info', 'primary'];

    $first = explode(' ', $name);
    $first = strtoupper(substr($first[0], 0, 1));

    $html = '<div class="kt-user-card-v2">';
    $html .= ' <div class="kt-user-card-v2__details">';
    $html .= '  <span class="kt-user-card-v2__name">' . ucfirst($name) . '</span>';
    $html .= '  <span class="kt-user-card-v2__email kt-link">' . ucfirst($type) . '</span>';
    $html .= ' </div>';
    $html .= '</div>';

    return $html;
}


function profileName($name = null, $type = null)
{

    $classname = ['dark', 'success', 'danger', 'warning', 'info', 'primary'];

    $first = explode(' ', $name);
    $first = strtoupper(substr($first[0], 0, 1));

    $html = '<div class="kt-user-card-v2">';
    $html .= '<div class="kt-user-card-v2__pic">';
    $html .= ' <div class="kt-badge kt-badge--xl kt-badge--' . $classname[array_rand($classname)] . '"><span>' . $first . '</span></div>';
    $html .= ' </div>';
    $html .= ' <div class="kt-user-card-v2__details">';
    $html .= '  <span class="kt-user-card-v2__name">' . ucfirst($name) . '</span>';
    $html .= '  <span class="kt-user-card-v2__email kt-link">' . ucfirst($type) . '</span>';
    $html .= ' </div>';
    $html .= '</div>';

    return $html;
}


function humanDate($date){
    if(auth()->user()->LanguageId == 2){
            Carbon::setLocale('ar');
    }

    if ($date->diffInMonths(Carbon::now()) > 1 ) {
        return $date->format('d-F-Y');
    }
    return $date->diffForHumans();
}

function defaults($name = null, $role)
{
    $fname = explode(' ', $name);
    $html = '<div class="kt-user-card-v2">';
    $html .= ' <div class="kt-user-card-v2__pic">';
    $html .= ' <div class="kt-badge kt-badge--xl kt-badge--success"><span>' . strtoupper(substr($fname[0], 0, 1)) . '</span></div>';
    $html .= '  </div>';
    $html .= '  <div class="kt-user-card-v2__details">';
    $html .= '   <span class="kt-user-card-v2__name">' . ucwords($name) . '</span>';
    $html .= '   <span class="kt-user-card-v2__email kt-link">' . ucwords($role) . '</span>';
    $html .= '   </div>';
    $html .= '   </div>';

    return $html;
}

function fileName($filename = null)
{
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
    $status = strtolower(trim($status));
    $classname = null;
    if (in_array($status, [
        'new', 'approved-unpaid', 'active', 'checked', 'approved', 'new request',
        'new registration', 'new request'
    ])) {
        $classname = 'success';
    }

    if (in_array($status, [
        'send back for amendments', 'processing', 'modification request',
        'modified', 'need modification', 'amended', 'pending', 'need approval', 'draft', 'unchecked', 'back',
        'pending', 'bounced back request', 'renew trade license request', 'amend request', 'amendment request'
    ])) {
        $classname = 'warning';
    }

    if (in_array($status, ['unprocessed', 'expired', 'rejected', 'cancelled', 'blocked'])) {
        $classname = 'danger';
    }


    if (in_array($status, ['modification request', 'send back for amendments', 'back', 'amended'])) {
        $status = 'Bounced Back';
    }
    //    if (in_array($status, ['modified'])) { $status = 'Bounced Back Request'; }



    return '<span class="kt-badge kt-badge--' . $classname . ' kt-badge--inline">' . __(ucwords($status)) . '</span>';
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
    $last_permit_d = \App\Event::max('permit_number');

    if (!isset($last_permit_d)) {
        $new_permit_no = sprintf("EP%04d",  1);
    } else {
        $last_pn = $last_permit_d;
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
    $last_permit_d = \App\Permit::where('permit_number', 'not like', '%-%')->max('permit_number');

    if (!isset($last_permit_d)) {
        $new_permit_no = sprintf("AP%04d",  1);
    } else {
        $last_pn = $last_permit_d;
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
    $data['status'] = 'active';
    $data['comments'] = [];
    if ($companyID) {
        $data['status'] = Auth::user()->company->status;
    }
    if ($data['status'] == 'blocked') {
        $data['comments'] = \App\CompanyComment::where('company_id', $companyID)->latest()->first();
    }
    return $data;
}

function getPaymentOrderId($from, $id)
{
    $pre =  $from == 'artist' ?  'POID1' : 'POID2';
    $last_transaction = \App\Transaction::where('transaction_type', $from)->latest()->first();
    $payment_no = '';
    // dd($last_transaction);
    if (empty($last_transaction) || $last_transaction->payment_order_id == null) {
        $payment_no = sprintf("%07d",  435);
    } else {
        $last_trn = explode('-', $last_transaction->payment_order_id);
        $last_year = $last_trn[1];
        if ($last_year == date('Y')) {
            $n = $last_trn[2];
            $f = substr($n, 0, 1);
            $l = substr($n, -1, 1);
            $x = 7;
            if ($f == 9 && $l == 9) {
                $x++;
            }
            $payment_no = sprintf("%0" . $x . "d", (int) $n + 1);
        } else {
            $payment_no = sprintf("%07d",  1);
        }
    }
    if ($from == 'event') {
        $times = \App\EventTransaction::where('event_id', $id)->distinct('transaction_id')->count('transaction_id');
        $times += 1;
    } else {
        $times = \App\ArtistPermitTransaction::where('artist_permit_id', $id)->distinct('transaction_id')->count('transaction_id');
        $times += 1;
    }

    return $pre . '-' . date('Y') . '-' . $payment_no . '-' . $times;
}

function paymentNotification($event, $artist, $files, $amount)
{
    $subject = $title = $content = $artist_permit_number = $event_permit_number = '';

    $event_permit_number = isset($event->permit_number) ? $event->permit_number : '';
    $artist_permit_number = isset($artist->permit_number) ? $artist->permit_number : '';

    if ($event && $artist) {
        $subject = 'Payment Successful to RAKTDA - Permits - #' . $event_permit_number . ', #' . $artist_permit_number;
        $title .= 'Payment for <b>#' . $event_permit_number .  ' and #' . $artist_permit_number . ' is completed successfully';
        $content = 'The payment for Event Permit <b>' . $event_permit_number . '</b> and Artist Permit  <b>' . $artist_permit_number . '</b> AED ' . number_format($amount, 2) . ' is completed successfully.  Please find the permit and payment voucher in the attachments.';
        $url = \URL::signedRoute('event.index') . '#valid';
    } else if ($event) {
        $subject = 'Payment Successful to RAKTDA - Permits - #' . $event_permit_number;
        $title .= 'Payment for <b>#' . $event_permit_number .  ' is completed successfully';
        $content = 'The payment for Event Permit <b>' . $event_permit_number . '</b> AED ' . number_format($amount, 2) . ' is completed successfully.  Please find the permit and payment voucher in the attachments.';
        $url = \URL::signedRoute('event.index') . '#valid';
    } else {
        $subject = 'Payment Successful to RAKTDA - Permits - #' . $artist_permit_number;
        $title .= 'Payment for #' . $artist_permit_number . ' is completed successfully';
        $content = 'The payment for Artist Permit  <b>' . $artist_permit_number . '</b> AED ' . number_format($amount, 2) . ' is completed successfully.  Please find the permit and payment voucher in the attachments.';
        $url = \URL::signedRoute('artist.index') . '#valid';
    }
    $buttonText = "Download Permit";
    $user = User::where('user_id', \Auth::user()->user_id)->first();
    $user->notify(new AllNotification([
        'subject' => $subject,
        'title' => $title,
        'content' => $content,
        'button' => $buttonText,
        'url' => $url,
        'mail' => true,
        'attach' => true,
        'file' => $files
    ]));
}

function calculateDateDiff($x, $y)
{
    $from = \Carbon\Carbon::parse($x);
    $to = \Carbon\Carbon::parse($y);
    $diffr = $from->diff($to);
    $term = '';
    $year = $diffr->y;
    $term .= $year ? $year . ' ' . ($year > 2 ? __('years') . ' ' :  $year > 1 ? __('years') . ' ' : __('year') . ' ') : '';
    $month = $diffr->m;
    $term .= $month ? $month . ' ' . ($month > 2 ? __('months') . ' ' : $month > 1 ? __('months') . ' ' : __('month') . ' ') : '';
    if($from == $to) return '1 day';
    $day = $diffr->d + 1;
    $term .= $day ? $day . ' ' . ($day > 2  ? __('days') : $day > 1  ? __('days') : __('day')) : '';
    return $term;
}

function diffInDays($x, $y)
{
    $from = \Carbon\Carbon::parse($x);
    $to = \Carbon\Carbon::parse($y);
    return $from->diffInDays($to);
}


function storeEventPermitPrint($id)
{
    $event_details = \App\Event::with('type', 'country')->where('event_id', $id)->first();
    $data['event_details'] = $event_details;
    $event_permit_no = $event_details->permit_number;
    if ($event_details->truck()->exists()) {
        $data['truck'] = \App\EventTruck::where('event_id', $id)->get();
    }
    if ($event_details->liquor()->exists()) {
        $data['liquor'] = \App\EventLiquor::where('event_id', $id)->first();
    }

    $directory = 'permit_downloads/event/' . $id;
    if (!Storage::has($directory)) {
        $resp = Storage::makeDirectory($directory);
    }

    PDF::loadView('permits.event.print', $data, [], [
        'title' => 'Event Permit ' . $event_permit_no,
        'default_font_size' => 10
    ])->save(storage_path('app/' . $directory) . '/EventPermit#' . $event_permit_no . '.pdf');


    if ($event_details->truck()->where('paid', 1)->exists()) {

        PDF::loadView('permits.event.truckprint', $data, [], [
            'title' => 'Truck Permit ' . $event_permit_no,
            'default_font_size' => 10
        ])->save(storage_path('app/' . $directory) . '/TruckPermit#' . $event_permit_no . '.pdf');
    }
    if ($event_details->liquor()->exists() && $event_details->liquor()->value('paid') == 1) {
        if ($event_details->liquor->provided != null || $event_details->liquor->provided != 1) {

            PDF::loadView('permits.event.liquorprint', $data, [], [
                'title' => 'Liquor Permit ' . $event_permit_no,
                'default_font_size' => 10
            ])->save(storage_path('app/' . $directory) . '/LiquorPermit#' . $event_permit_no . '.pdf');
        }
    }

    return;
}

function storeArtistPermitPrint($id)
{
    $permit_details = \App\Permit::where('permit_id', $id)->first();
    $data['permit_details'] = $permit_details;
    $data['artist_details'] = \App\ArtistPermit::where('permit_id', $id)->get();
    $data['company_details'] = Auth::user()->company;
    $artist_permit_no = $permit_details->permit_number;

    $directory = 'permit_downloads/artist/' . $id;
    if (!Storage::has($directory)) {
        $resp = Storage::makeDirectory($directory);
    }

    PDF::loadView('permits.artist.permit_print', $data, [], [
        'title' => 'Artist Permit ' . $artist_permit_no,
        'default_font_size' => 10
    ])->save(storage_path('app/' . $directory) . '/ArtistPermit#' . $artist_permit_no . '.pdf');

    return;
}

// function formatDate($date) {
//     if(auth()->user()->LanguageId != 1){
//         Carbon::setLocale('ar');
//     }
//     return Carbon::parse($date);
// }


    function getProfession($id) {
        return App\Profession::find($id);
    }

    function getExemptPercentage($transactions)
    {
        $data['artistPermit'] = [];

        if(!$transactions->artistPermitTransaction->isEmpty()){
            $data['artistPermit'] =  $transactions->artistPermitTransaction->groupBy(function ($item, $key){
                return $item->artistPermit->profession_id;
            });
            $artistTransactionArray = $transactions->artistPermitTransaction->toArray();
            $data['exempt'] = count($artistTransactionArray) > 0 ? $artistTransactionArray[0]['exempt_percentage'] : 0 ;
        }else {
            $eventTransactionArray = $transactions->eventTransaction->toArray();
            $data['exempt'] = count($eventTransactionArray) > 0 ? $eventTransactionArray[0]['exempt_percentage'] : 0 ;
        }

        return $data;
    }
