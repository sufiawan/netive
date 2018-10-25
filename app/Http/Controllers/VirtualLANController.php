<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NetIve\VirtualLAN;
use Exception;

class VirtualLANController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function rules()
    {
        return [
            'name' => 'required',            
            'ip_segment' => 'required|ip'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = VirtualLAN::all();
        return view('virtuallan.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('virtuallan.form', ['data' => new VirtualLAN()]);
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
                VirtualLAN::create($request->all());
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Virtual LAN create failed!');
        }
        
        return redirect('/virtuallan')->with('success', 'Virtual LAN created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = VirtualLAN::find($id);
        return view('virtuallan.form', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = VirtualLAN::find($id);
        return view('virtuallan.form', ['data' => $data]);
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
                $data = VirtualLAN::find($id);
                $updateddata = $request->only($data->getFillable());
                $data->fill($updateddata)->save();
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Virtual LAN update failed!');
        }
        
        return redirect('/virtuallan')->with('success', 'Virtual LAN updated!');        
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
                VirtualLAN::find($id)->delete();
            });
        } catch (Exception $exc) {
            return redirect('/virtuallan')->with('error', 'Virtual LAN delete failed!');
        }
        
        return redirect('/virtuallan')->with('success', 'Virtual LAN deleted!');
    }
}
