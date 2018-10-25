<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NetIve\EndDevice;
use Exception;

class EndDeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function rules()
    {
        return [
            'name' => 'required',            
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
        $list = EndDevice::all();
        return view('enddevice.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('enddevice.form', ['data' => new EndDevice()]);
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
                EndDevice::create($request->all());
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'End Device create failed!');
        }
        
        return redirect('/enddevice')->with('success', 'End Device created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = EndDevice::find($id);
        return view('enddevice.form', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = EndDevice::find($id);
        return view('enddevice.form', ['data' => $data]);
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
                $data = EndDevice::find($id);
                $updateddata = $request->only($data->getFillable());
                $data->fill($updateddata)->save();
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'End Device update failed!');
        }
        
        return redirect('/enddevice')->with('success', 'End Device updated!');
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
                EndDevice::find($id)->delete();
            });
        } catch (Exception $exc) {
            return redirect('/enddevice')->with('error', 'End Device delete failed!');
        }
        
        return redirect('/enddevice')->with('success', 'End Device deleted!');
    }
}
