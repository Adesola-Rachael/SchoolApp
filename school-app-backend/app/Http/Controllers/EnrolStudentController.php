<?php

namespace App\Http\Controllers;

use App\Models\EnrolStudent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EnrolStudentRequest;

class EnrolStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_student = EnrolStudent::all();
        if($get_student){
            return response()->json(['Application submitted Successfully', 200, $get_student ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request  $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'grade' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string',
            'state' => 'required|string',
            'nationality' => 'required|string',
            'school_record' => 'required|file',
            'birth_certificate' => 'required|file',
        ]);

        if($request->hasFile('school_record')){
           // $school_record = $request->file('school_record')->store('public');
            //$school_record = Storage::disk('public')->put('/school_record', $request->file('school_record'));
            $validated['school_record'] = $request->file('school_record')->store('school_records', 'public');

            //file('school_record')->store('public');


        }
        if($request->hasFile('birth_certificate')){
            //$birth_certificate = $request->file('birth_certificate')->store('public/birth_certificate');
            $validated['birth_certificate'] = $request->file('birth_certificate')->store('birth_certificates', 'public');

        }
        $create_student = EnrolStudent::create($validated);
        
        // $create_student = EnrolStudent::create([
        //     'name' =>$request->name,
        //     'grade' => $request->grade, 
        //     'address'=> $request->address,
        //     'date_of_birth'=>  date('Y-m-d', strtotime($request->date_of_birth)),
        //     'phone'=> $request->phone,
        //     'state'=> $request->state,
        //     'nationality'=> $request->nationality,
        //     'school_record'=> $school_record,
        //     'birth_certificate'=> $birth_certificate,
        // ]);
        if($create_student){
            return response()->json(['message' => 'Student enrolled successfully!', 'data' => $create_student], 201);

        }
    }

   
}
