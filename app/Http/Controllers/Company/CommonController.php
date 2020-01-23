<?php

namespace App\Http\Controllers\Company;

use Session;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CommonController extends Controller
{
    public function resetUploadsSession($id)
    {
        Session::forget(Auth::user()->user_id . '_event_doc_file_' . $id);
        Session::forget(Auth::user()->user_id . '_event_ext_' . $id);

        Session::forget(Auth::user()->user_id . '_doc_file_' . $id);
        Session::forget(Auth::user()->user_id . '_ext_' . $id);
    }

    public function getNotifications(Request $request){
        if($request->ajax()){
            $notifications = $request->user()->unreadNotifications;
            return view('layouts.notifications', ['notifications' => $notifications]);
        }
    }

    public function notifications(Request $request){
        return view('permits.notifications.index', ['page_title' => 'Notifications']);
    }

    public function getNotificationsDatatable(Request $request){
        $data = $request->user()->notifications()->orderBy('created_at');
        return Datatables::of($data)->addColumn('notification', function($notification){

            $unread = is_null($notification->read_at) ? '' : '';

            return '<div class="kt-widget3">
                        <div class="kt-widget3__item">
                            <div class="kt-widget3__header">
                                <div class="kt-widget3__user-img">
                                    <img class="kt-widget3__img" src="' . asset('/assets/media/users/default.png') . '" alt="">
                                </div>
                                <div class="kt-widget3__info">
                                    <a href="#" class="kt-widget3__username">
                                        ' . $notification->data['title'] . '
                                    </a><br>
                                    <span class="kt-widget3__time">
                                        ' . humanDate($notification->created_at) . '
                                    </span>
                                </div>
                                <span class="kt-widget3__status kt-font-info">
                                    
                                </span>
                            </div>
                            <div class="kt-widget3__body">
                                <p class="kt-widget3__text">
                                    ' . $notification->data['content'] . '
                                </p>
                            </div>
                        </div>
                    </div>';

        })->addColumn('status', function($notification){
            return is_null($notification->read_at) ? 'unread' : 'read';
        })->addColumn('url', function($notification){
            return $notification->data['url'];
        })->rawColumns(['notification'])->make(true);
    }

    public function updateAsReadNotification(Request $request){
        if($request->ajax()){
            try {
                $request->user()->notifications()->where('id', $request->id)->first()->markAsRead();
                $result = ['result' => 1];
            } catch (\Exception $e) {
                $result = ['result' => 0];
            }
            return response()->json($result);
        }
    }
}
