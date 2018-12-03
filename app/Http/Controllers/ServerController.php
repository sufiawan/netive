<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use NetIve\Server;
use NetIve\NetworkDevice;

class ServerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function rules()
    {
        return [
            'name', 'brand_type', 'device_username', 'device_password', 'cpu', 'hdd', 'ram' => 'required',
            'purchase_year' => 'required|numeric|digits:4',
            'ip_address' => 'nullable|ip',
            'cpu_core', 'hdd_capacity', 'ram_capacity' => 'required|numeric',
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
        
        $list = Server::all();
        return view('server.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::User()->authorizeRoles(['administrator']);
        
        return view('server.form', ['data' => new Server(), 'netdev' => new NetworkDevice()]);
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
                $netDev = NetworkDevice::create($request->all() + ['network_device_type_id' => 6]);
                Server::create($request->all() + ['network_device_id' => $netDev->id]);
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Server create failed!');
        }
        
        return redirect('/server')->with('success', 'Server created!');
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
        
        $data = Server::find($id);
        $netDev = NetworkDevice::find($data->network_device_id);
        return view('server.view', ['data' => $data, 'netdev' => $netDev]);        
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
        
        $data = Server::find($id);
        $netDev = NetworkDevice::find($data->network_device_id);
        return view('server.form', ['data' => $data, 'netdev' => $netDev]); 
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
                $srv = Server::find($id);
                $data = $request->only($srv->getFillable());
                $srv->fill($data)->save();
                
                $nd = NetworkDevice::find($srv->network_device_id);
                $data = $request->only($nd->getFillable());
                $nd->fill($data)->save();
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Server update failed!');
        }
        
        return redirect('/server')->with('success', 'Server updated!');        
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
        
        try {
            DB::transaction(function() use ($id) {
                $srv = Server::find($id);
                $srv->delete();
                NetworkDevice::find($srv->network_device_id)->delete();
            });
        } catch (Exception $exc) {
            return redirect('/server')->with('error', 'Server delete failed!');
        }
        
        return redirect('/server')->with('success', 'Server deleted!');
    }
}
