<?php

namespace App\Http\Controllers\Api;

//import model Vacancy
use App\Models\Vacancy;
use App\Models\Candidate;
use App\Models\Apply;
//import enums ApplyStatus
use App\Enums\ApplyStatus;
//import resource ApiResource
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//import Str
use Illuminate\Support\Str;
//import facade Validator
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isList;

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
        if (Vacancy::where('vacancy_id', $request->vacancy_id)->get()->count() === 0) {
            return response()->json(new ApiResource(false, 'Vacancy not found!'), 404);
        }

        //check if candidate not found
        if (Candidate::where('candidate_id', $request->candidate_id)->get()->count() === 0) {
            return response()->json(new ApiResource(false, 'Candidate not found!'), 404);
        }

        //create apply
        $apply = Apply::create([
            'apply_id'      => Str::uuid(),
            'vacancy_id'    => $request->vacancy_id,
            'candidate_id'  => $request->candidate_id,
            'status'        => ApplyStatus::New,
        ]);

        //return response
        return response()->json(new ApiResource(true, 'Apply success saved!', $apply), 201);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'vacancy_id'    => 'required',
            'candidate_id'  => 'required',
            'status'        => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if vacancy id not found
        if (Apply::where('apply_id', $id)->get()->count() === 0) {
            return response()->json(new ApiResource(false, 'Apply not found!'), 404);
        }

        //find vacancy by vacancy ID
        $apply = Apply::where('apply_id', $id)->update(
            [
                'vacancy_id'    => $request->vacancy_id,
                'candidate_id'  => $request->candidate_id,
                'status'        => $request->status,
            ]
        );

        //return response
        return response()->json(new ApiResource(true, 'Apply success updated!', $apply), 200);
    }

    /**
     * showAllCandidateByVacancyId
     *
     * @param  mixed $id
     * @return void
     */
    public function showAllCandidateByVacancyId($id)
    {
        //find vacancy by vacancy_id
        $vacancy = Vacancy::where('vacancy_id', $id)->first();

        //check if vacancy id not found
        if ($vacancy === null) {
            return response()->json(new ApiResource(false, 'Vacancy not found!'), 404);
        }

        //find candidate who apply with specific vacancy id
        $candidates = $vacancy->applies;

        return response()->json(new ApiResource(true, 'Show all candidates who apply ' . $vacancy->title, $candidates), 200);
    }

    /**
     * showAllVacancyByCandidateId
     *
     * @param  mixed $id
     * @return void
     */
    public function showAllVacancyByCandidateId($id)
    {
        //find vacancy by vacancy_id
        $candidate = Candidate::where('candidate_id', $id)->first();

        //check if vacancy id not found
        if ($candidate === null) {
            return response()->json(new ApiResource(false, 'Candidate not found!'), 404);
        }

        //find candidate who apply with specific vacancy id
        $vacancies = $candidate->applies;

        return response()->json(new ApiResource(true, 'Show all vacancies who apply by ' . $candidate->name, $vacancies), 200);
    }
}
