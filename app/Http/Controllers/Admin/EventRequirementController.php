<?php

namespace App\Http\Controllers\Admin;

use App\Requirement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class EventRequirementController extends Controller
{

	public function create()
	{
		return view('admin.settings.event.create', ['page_title']);
	}

	public function store()
	{

	}

	public function datatable(Request $request)
	{
		if($request->ajax()){
			$user = Auth::user();
			$limit = $request->length;
			$start = $request->start;
			$requirement = Requirement::where('requirement_type', 'event')->orderBy('requirement_name');
			return DataTables::of($requirement)
				 ->addColumn('name', function($requirement) use ($user){
				 	if($user->LanguageId == 1){ return ucfirst($requirement->requirement_name);}
				 	return $requirement->requirement_name_ar;
				 })
				 ->addColumn('description', function($requirement) use ($user){
//				 	if($user->LanguageId == 1){ return ucfirst($requirement->requirement_name_en);}
				 	return ucfirst($requirement->requirement_description);
				 })
				  ->addColumn('type', function($requirement) use ($user){
//				 	if($user->LanguageId == 1){ return ucfirst($requirement->requirement_name_en);}
				 	return ucfirst($requirement->requirement_description);
				 })
				  ->editColumn('date_required', function($requirement) use ($user){
				 	return __($requirement->dates_required);
				 })
				 ->make(true);
		}
	}
}
