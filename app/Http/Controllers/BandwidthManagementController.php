<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NetIve\BandwidthManagement;
use Exception;

class BandwidthManagementController extends Controller
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
        $list = BandwidthManagement::all();
        return view('bandwidthmanagement.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bandwidthmanagement.form', ['data' => new BandwidthManagement()]);
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
                BandwidthManagement::create($request->all());
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Bandwidth Management create failed!');
        }
        
        return redirect('/bandwidthmanagement')->with('success', 'Bandwidth Management created!');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = BandwidthManagement::find($id);
        return view('bandwidthmanagement.form', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = BandwidthManagement::find($id);
        return view('bandwidthmanagement.form', ['data' => $data]);
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
                $data = BandwidthManagement::find($id);
                $updateddata = $request->only($data->getFillable());
                $data->fill($updateddata)->save();
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Bandwidth Management update failed!');
        }
        
        return redirect('/bandwidthmanagement')->with('success', 'Bandwidth Management updated!');               
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
                BandwidthManagement::find($id)->delete();
            });
        } catch (Exception $exc) {
            return redirect('/bandwidthmanagement')->with('error', 'Bandwidth Management delete failed!');
        }
        
        return redirect('/bandwidthmanagement')->with('success', 'Bandwidth Management deleted!');           
    }
}
