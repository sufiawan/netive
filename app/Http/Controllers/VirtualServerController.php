<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use NetIve\VirtualServer;

class VirtualServerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function rules()
    {
        return [
            'name' => 'required',                        
            'cpu_core', 'hdd', 'ram' => 'required|numeric',
        ];
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::User()->authorizeRoles(['administrator']);
        
        $request->validate($this->rules());
        
        try {
            DB::transaction(function() use ($request) {                
                VirtualServer::create($request->all());
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Virtual Server create failed!');
        }
        
        return redirect('/server/'.$request->server_id.'/edit')->with('success', 'Virtual Server created!');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Auth::User()->authorizeRoles(['administrator']);
        
        return view('virtualserver.form', ['data' => new VirtualServer([ 'server_id' => $id ])]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::User()->authorizeRoles(['administrator']);
        
        $data = VirtualServer::find($id);
        return view('virtualserver.form', ['data' => $data]); 
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
        Auth::User()->authorizeRoles(['administrator']);
        
        $request->validate($this->rules());
        
        try {
            DB::transaction(function() use ($request, $id) {                
                $vs = VirtualServer::find($id);
                $data = $request->only($vs->getFillable());
                $vs->fill($data)->save();
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Virtual Server update failed!');
        }
        
        return redirect('/server/'.$request->server_id.'/edit')->with('success', 'Virtual Server updated!');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::User()->authorizeRoles(['administrator']);
        
        $vs = VirtualServer::find($id);
        
        try {
            DB::transaction(function() use ($vs) {                
                $vs->delete();
            });
        } catch (Exception $exc) {
            return redirect('/server/'.$vs->server_id.'/edit')->with('error', 'Virtual Server delete failed!');
        }
        
        return redirect('/server/'.$vs->server_id.'/edit')->with('success', 'Virtual Server deleted!');
    }
}
