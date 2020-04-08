<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;

class AccountSettingsController extends Controller
{
    public function __construct(){
        $this->middleware('signed')->except([
            'store'
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.settings.account.index', ['page_title'=> 'Account Settings', 'user' => $request->user()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        try {
            $user->NameEn = $request->NameEn;
            $user->NameAr = $request->NameAr;
            $user->email = $request->email;
            $user->mobile_number = $request->mobile_number;

            if($request->has('change_username')){
                $user->username = $request->username;
            }

            if($request->has('change_password')){
                if(Hash::check($request->current_password, $user->password)){
                    $user->password = bcrypt($request->new_password);
                }else{
                    // INVALID CURRENT PASSWORD
                    $result = ['error', 'The current password you have entered was incorrect.', 'Error'];
                    return redirect()->back()->with('message', $result);
                }
            }
            $user->save();
            $result = ['success', 'Settings has been saved successfully', 'Success'];
        } catch (\Exception $e) {
            $result = ['error', $e->getMessage(), 'Error'];
        }

        return redirect()->back()->with('message', $result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }
}
