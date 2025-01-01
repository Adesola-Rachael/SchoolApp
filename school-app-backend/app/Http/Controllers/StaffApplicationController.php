<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\StaffApplication;
use App\Http\Requests\StaffApplicationRequest;


class StaffApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $registered_staff = StaffApplication::get();
        if($registered_staff){
            return response()->json(['Application Received Successfuly', 200, $registered_staff ]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StaffApplicationRequest $request)
    {
        $create_staff = StaffApplication::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role
        ]);
        if($create_staff){
            return response()->json(['Application submitted Successfully', 201, $create_staff ]);
        }
    }
}
