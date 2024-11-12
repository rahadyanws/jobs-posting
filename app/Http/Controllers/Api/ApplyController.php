<?php

namespace App\Http\Controllers\Api;

//import model Vacancy
use App\Models\Vacancy;
use App\Models\Candidate;
use App\Models\Apply;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//import resource ApiResource
use App\Http\Resources\ApiResource;

use Illuminate\Support\Str;

//import facade Validator
use Illuminate\Support\Facades\Validator;

use App\Enums\ApplyStatus;

class ApplyController extends Controller
{
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'vacancy_id'    => 'required',
            'candidate_id'  => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if vacancy not found
        if(Vacancy::where('vacancy_id', $request->vacancy_id)->get()->count() === 0){
            return response()->json(new ApiResource(false, 'Vacancy not found!'), 422);
        }

        //check if candidate not found
        if(Candidate::where('candidate_id', $request->candidate_id)->get()->count() === 0){
            return response()->json(new ApiResource(false, 'Candidate not found!'), 422);
        }

        //create apply
        $apply= Apply::create([
            'apply_id'      => Str::uuid(),
            'vacancy_id'    => $request->vacancy_id,
            'candidate_id'  => $request->candidate_id,
            'status'        => ApplyStatus::New,
        ]);

        //return response
        return new ApiResource(true, 'Apply success saved!', $apply);
    }
}