<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Profession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\URL;

class ProfessionController extends Controller
{
	public function __construct(){
		$this->middleware('signed')->except([
            'datatable',
			'isexist',
			'store',
			'update',
			'destroy',
        ]);
	}

	public function datatable(Request $request)
	{
		$user = Auth::user();
		$professions = Profession::orderBy('name_en');

		return DataTables::of($professions)
		->addColumn('profession_name', function($args) use ($user){
		 	return $user->LanguageId == 1 ? ucwords($args->name_en) : ucwords($args->name_ar);
		})
		->editColumn('is_multiple', function($profession) use($request){
			if($request->user()->LanguageId == 1){
				return $profession->is_multiple ? 'Yes' : 'No';
			}
			return $profession->is_multiple ? __('YES') : __('NO');
		})
		->editColumn('amount', function($args){
		 	return number_format($args->amount, 2).' AED';
		})
		->editColumn('created_at', function($args){
		 	return '<span class="text-underline" title="'.$args->created_at->format('l h:i A | d-F-Y').'">'.humanDate($args->created_at).'</span>';
		})
		->editColumn('created_by', function($args) use($user){
            // return $args->createdBy->name;
			return $user->LanguageId == 1 ? ucwords($args->createdBy->NameEn) : ucwords($args->createdBy->NameAr);
		})
		->addColumn('actions', function($args){
			return '<button data-url="' . route('settings.profession.destroy', $args->profession_id) . '" class="btn btn-secondary btn-sm btn-elevate btn-delete">'.__('DELETE').'</button> <button data-url="' . URL::signedRoute('settings.profession.edit', $args->profession_id) . '" class="btn btn-secondary btn-sm btn-elevate btn-edit">'.__('EDIT').'</button>';
		})
		->rawColumns(['actions', 'created_at'])
		->make(true);

	}

	public function create(Request $request){
		return view('admin.settings.profession.create', ['page_title'=> 'Add New Profession']);
	}

	public function isexist(Request $request)
    {
    	if($request->name_en){
    		$prof = Profession::when($request->type && $request->type == 'update', function($q) use($request){
    			return $q->where('profession_id', '!=', $request->id);
    		})->where('name_en', $request->name_en)->exists();
    		return response()->json(($prof ? $request->name_en. ' already exist.' : true));
      	}
    	else{
    		$prof = Profession::when($request->type && $request->type == 'update', function($q) use($request){
    			return $q->where('profession_id', '!=', $request->id);
    		})->where('name_ar', $request->name_ar)->exists();
    		return response()->json(($prof ? $request->name_ar. ' already exist.' : true));
      	}
    }

	public function store(Request $request){
		try{
			$profession = Profession::create(array_merge($request->all(), ['created_by', Auth::user()->user_id] ));
			$result = ['success', __('New profession has been added'), 'Success'];

			if($request->submit_type == 'continue'){
				return redirect(URL::signedRoute('admin.setting.index') . '#profession')->with('message', $result);
			}
		}catch(Exception $e){
			$result = ['error', $e->getMessage(), 'Error'];
		}
		return redirect()->back()->with('message',$result);
	}

	public function edit(Profession $profession, Request $request){
		return view('admin.settings.profession.edit', ['page_title'=> 'Edit Profession', 'profession' => $profession]);
	}

	public function update(Profession $profession, Request $request){
		try{
			$profession->update(array_merge($request->all(), ['udpated_by', Auth::user()->user_id] ));
			$result = ['success', __('Profession has been saved successfully'), 'Success'];

			if($request->submit_type == 'continue'){
				return redirect(URL::signedRoute('admin.setting.index') . '#profession')->with('message', $result);
			}

		}catch(Exception $e){
			$result = ['error', $e->getMessage(), 'Error'];
		}
		return redirect()->back()->with('message',$result);
	}

	public function destroy(Profession $profession, Request $request){
		try{
			$profession->delete();
			$result = ['success', __('Profession has been deleted'), 'Success'];
		}catch(Exception $e){
			$result = ['error', $e->getMessage(), 'Error'];
		}
		return response()->json(['message'=>$result]);
	}
}
