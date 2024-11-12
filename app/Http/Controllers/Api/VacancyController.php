<?php

namespace App\Http\Controllers\Api;

//import model Vacancy
use App\Models\Vacancy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//import resource ApiResource
use App\Http\Resources\ApiResource;

//import facade Validator
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;

class VacancyController extends Controller
{
    /**
    * index
    *
    * @return void
    */
   public function index()
   {
       //get all vacancy
       $vacancies = Vacancy::latest()->paginate(10);

       //return collection of vacancies as a resource
       return new ApiResource(true, 'Vacancies data list.', $vacancies);
   }

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
           'title'         => 'required|string|max:100',
           'description'   => 'required',
           'requirement'   => 'required',
           'status'        => 'required',
           'company_name'  => 'required|string|max:100',
       ]);

       //check if validation fails
       if ($validator->fails()) {
           return response()->json($validator->errors(), 422);
       }


       //create vacancy
       $vacancy = Vacancy::create([
           'vacancy_id'    => Str::uuid(),
           'title'         => $request->title,
           'description'   => $request->description,
           'requirement'   => $request->requirement,
           'status'        => $request->status,
           'company_name'  => $request->company_name,
       ]);

       //return response
       return new ApiResource(true, 'Vacancy success added!', $vacancy);
   }

   /**
    * show
    *
    * @param  mixed $id
    * @return void
    */
   public function show($id)
   {
       //find vacancy by vacancy_id
       $vacancy = Vacancy::where('vacancy_id', $id)->get();

       //return single vacancy as a resource
       return new ApiResource(true, 'Detail Data Vacancy!', $vacancy);
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
           'title'         => 'required|string|max:100',
           'description'   => 'required',
           'requirement'   => 'required',
           'status'        => 'required',
           'company_name'  => 'required|string|max:100',
       ]);

       //check if validation fails
       if ($validator->fails()) {
           return response()->json($validator->errors(), 422);
       }

       //check if vacancy id not found
       if(Vacancy::where('vacancy_id', $id)->get()->count() === 0){
           return new ApiResource(false, 'Vacancy not found!');
       }

       //find vacancy by vacancy ID
       $vacancy = Vacancy::where('vacancy_id', $id)->update(
           [
               'title'         => $request->title,
               'description'   => $request->description,
               'requirement'   => $request->requirement,
               'status'        => $request->status,
               'company_name'  => $request->company_name,
           ]
       );

       //return response
       return new ApiResource(true, 'Vacancy success updated!', $vacancy);
   }
}
