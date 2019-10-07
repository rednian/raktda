<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Profession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ProfessionController extends Controller
{
	public function datatable()
	{
		$user = Auth::user();
		$professions = Profession::orderBy('name_en');
		return DataTables::of($professions)
			 ->addColumn('name', function($args) use ($user){
			 	if($user->LanguageId == 1){ return ucwords($args->name_en); }
			 	else{ return ucwords($args->name_ar); }
			 })
			 ->editColumn('amount', function($args){
			 	return number_format($args->amount,2).' AED';
			 })
			 ->editColumn('created_at', function($args){
			 	return $args->created_at->format('d-M-Y');
			 })
			 ->make(true);

	}
}
