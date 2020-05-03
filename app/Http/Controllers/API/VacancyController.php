<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use App\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == "admin") {
            return Vacancy::latest()->get();
        }

        if (auth()->user()->role == "user") {
            return Vacancy::latest()->where('status', 'open')->get();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'company' => 'required|string',
            'location' => 'required|string',
            'status' => 'required|string',
            'description' => 'required|string',
        ]);

        $vacancy = new Vacancy();
        $vacancy->title = $request->title;
        $vacancy->company = $request->company;
        $vacancy->location = $request->location;
        $vacancy->status = $request->status;
        $vacancy->description = $request->description;
        $vacancy->save();

        return response([
            'status' => 'success',
            'data' => $vacancy
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->role == "admin") {
            return Vacancy::where('id', $id)->firstOrFail();
        }

        if (auth()->user()->role == "user") {
            return Vacancy::where('id', $id)->where('status', 'open')->firstOrFail();
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
