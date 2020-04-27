<?php


namespace App\Http\Controllers\Company;


use App\EventLiquor;
use Illuminate\Support\Facades\URL;

class LiquorController
{
    public function show($id)
    {
        return EventLiquor::findorFail($id);
    }

    public function delete(Request $request){
        EventLiquor::find($request->del_liquor_id)->delete();
        $result = ['success', __('Liquor Removed Successfully'), 'Success'];
        return redirect(URL::signedRoute('event.amend', $request->del_liquor_event_id))->with('message', $result);
    }
}
