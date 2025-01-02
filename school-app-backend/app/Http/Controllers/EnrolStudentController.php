<?php

namespace App\Http\Controllers;

use App\Models\EnrolStudent;
use App\Http\Requests\EnrolStudentRequest;

class EnrolStudentController extends Controller
{
    protected $student;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(EnrolStudent $student)
    {
        $this->student = $student;
    }

    public function index()
    {
        return response()->json(['message' =>'Data retrieved Successfully', 'data' =>  $this->student->all()], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function create(EnrolStudentRequest  $request)
    {

        if($request->hasFile('school_record')){
           $school_record = $request->file('school_record')->store('school_records', 'public');
        }
        if($request->hasFile('birth_certificate')){
           $birth_certificate = $request->file('birth_certificate')->store('birth_certificates', 'public');
        }        

        $create_student = $this->student::firstOrCreate([
            'name' =>$request->name,
            'grade' => $request->grade, 
            'address'=> $request->address,
            'date_of_birth'=>  date('Y-m-d', strtotime($request->date_of_birth)),
            'phone'=> $request->phone,
            'state'=> $request->state,
            'nationality'=> $request->nationality,
           'school_record'=> $school_record,
           'birth_certificate'=> $birth_certificate,
        ]);

        if($create_student){
           return response()->json(['message' => 'Student enrolled successfully!', 'data' => $create_student], 201);
        } 
    }
}
