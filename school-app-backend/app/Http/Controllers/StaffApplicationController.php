<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\StaffApplication;
use App\Http\Requests\StaffApplicationRequest;


class StaffApplicationController extends Controller
{

    protected $staff;

    public function __construct(StaffApplication $staff)
     {
         $this->staff = $staff;
     }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return response()->json(['message' =>'Data retrieved Successfully', 'data' =>  $this->staff->all()], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StaffApplicationRequest $request)
    {
        $create_staff =  $this->staff::firstOrCreate([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role
        ]);
        if($create_staff){
            return response()->json(['message' => 'Application submitted Successfully', 'data' =>  $create_staff], 201);
        }
    }
}
