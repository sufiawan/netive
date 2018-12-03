<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use NetIve\VirtualLan;
use NetIve\IpTable;
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
        Auth::User()->authorizeRoles(['administrator', 'engineer']);
        
        $list = VirtualLan::all();        
        return view('virtuallan.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::User()->authorizeRoles(['administrator', 'engineer']);
        
        return view('virtuallan.form', ['data' => new VirtualLan()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::User()->authorizeRoles(['administrator', 'engineer']);
        
        $request->validate($this->rules());
        
        try {
            DB::transaction(function() use ($request) {
                VirtualLan::create($request->all());
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Virtual LAN create failed!' . $exc->getMessage());
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
        Auth::User()->authorizeRoles(['administrator', 'engineer']);
        
        $data = VirtualLan::find($id);
        $clients = IpTable::where('vlan_id', $id)->get();
        
        return view('virtuallan.view', ['data' => $data, 'clients' => $clients]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::User()->authorizeRoles(['administrator', 'engineer']);
        
        $data = VirtualLan::find($id);
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
        Auth::User()->authorizeRoles(['administrator', 'engineer']);
        
        $request->validate($this->rules());
        
        try {
            DB::transaction(function() use ($request, $id) {
                $data = VirtualLan::find($id);
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
        Auth::User()->authorizeRoles(['administrator', 'engineer']);
        
        try {
            DB::transaction(function() use ($id) {
                VirtualLan::find($id)->delete();
            });
        } catch (Exception $exc) {
            return redirect('/virtuallan')->with('error', 'Virtual LAN delete failed!');
        }
        
        return redirect('/virtuallan')->with('success', 'Virtual LAN deleted!');
    }
}
