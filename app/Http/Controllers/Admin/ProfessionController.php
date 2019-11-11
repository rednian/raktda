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
		$professions = Profession::orderBy('name_en')->get();

		return DataTables::of($professions)
		->addColumn('profession_name', function($args) use ($user){
		 	return $user->LanguageId == 1 ? ucwords($args->name_en) : ucwords($args->name_ar);
		})
		->editColumn('is_multiple', function($profession){
			return $profession->is_multiple ? 'Yes' : 'No';
		})
		->editColumn('amount', function($args){
		 	return number_format($args->amount, 2).' AED';
		})
		->editColumn('created_at', function($args){
		 	return $args->created_at->format('d-M-Y');
		})
		->editColumn('created_by', function($args) use($user){
			return $user->LanguageId == 1 ? ucwords($args->createdBy->NameEn) : ucwords($args->createdBy->NameAr);
		})
		->addColumn('actions', function($args){
			return '<button data-url="' . route('settings.profession.destroy', $args->profession_id) . '" class="btn btn-secondary btn-sm btn-elevate btn-delete">Delete</button> <button data-url="' . route('settings.profession.edit', $args->profession_id) . '" class="btn btn-secondary btn-sm btn-elevate btn-edit">Edit</button>';
		})
		->rawColumns(['actions'])
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
			$result = ['success', 'New profession has been added', 'Success'];

			if($request->submit_type == 'continue'){
				return redirect('settings#profession')->with('message', $result);
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
			$result = ['success', 'Profession has been saved successfully', 'Success'];

			if($request->submit_type == 'continue'){
				return redirect('settings#profession')->with('message', $result);
			}

		}catch(Exception $e){
			$result = ['error', $e->getMessage(), 'Error'];
		}
		return redirect()->back()->with('message',$result);
	}

	public function destroy(Profession $profession, Request $request){
		try{
			$profession->delete();
			$result = ['success', 'Profession has been deleted', 'Success'];
		}catch(Exception $e){
			$result = ['error', $e->getMessage(), 'Error'];
		}
		return response()->json($result);
	}
}
