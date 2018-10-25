<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NetIve\AccessPoint;
use Exception;

class AccessPointController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function rules()
    {
        return [
            'brand_type', 'device_username', 'device_password' => 'required',
            'purchase_year' => 'required|numeric|digits:4',
            'ip_address' => 'nullable|ip'            
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aps = AccessPoint::all();
        return view('accesspoint.index', ['accesspoints' => $aps]);
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accesspoint.form', ['accesspoint' => new AccessPoint()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules());
        
        try {
            DB::transaction(function() use ($request) {
                AccessPoint::create($request->all());
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Access Point create failed!');
        }
        
        return redirect('/accesspoint')->with('success', 'Access Point created!');                    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ap = AccessPoint::find($id);
        return view('accesspoint.form', ['accesspoint' => $ap]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ap = AccessPoint::find($id);
        return view('accesspoint.form', ['accesspoint' => $ap]);
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
        $request->validate($this->rules());
        
        try {
            DB::transaction(function() use ($request, $id) {
                $ap = AccessPoint::find($id);
                $data = $request->only($ap->getFillable());
                $ap->fill($data)->save();                
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Access Point update failed!');
        }                          
        
        return redirect('/accesspoint')->with('success', 'Access Point updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function() use ($id) {
                AccessPoint::find($id)->delete();
            });
        } catch (Exception $exc) {
            return redirect('/accesspoint')->with('error', 'Access Point delete failed!');
        }
        
        return redirect('/accesspoint')->with('success', 'Access Point deleted!');           
    }
}
