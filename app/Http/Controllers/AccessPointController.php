<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use NetIve\AccessPoint;
use NetIve\NetworkDevice;

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
        Auth::User()->authorizeRoles(['administrator', 'engineer']);
        
        $aps = AccessPoint::all();
        return view('accesspoint.index', ['listdata' => $aps]);
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::User()->authorizeRoles(['administrator']);
        
        return view('accesspoint.form', ['data' => new AccessPoint(), 'netdev' => new NetworkDevice()]);
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
                $netDev = NetworkDevice::create($request->all() + ['network_device_type_id' => 1]);
                AccessPoint::create($request->all() + ['network_device_id' => $netDev->id]);
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Access Point create failed! '.$exc->getMessage());
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
        Auth::User()->authorizeRoles(['administrator', 'engineer']);
        
        $data = AccessPoint::find($id);
        $netDev = NetworkDevice::find($data->network_device_id);
        return view('accesspoint.view', ['data' => $data, 'netdev' => $netDev]);
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
        
        $data = AccessPoint::find($id);
        $netDev = NetworkDevice::find($data->network_device_id);
        return view('accesspoint.form', ['data' => $data, 'netdev' => $netDev]);
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
                $ap = AccessPoint::find($id);
                $data = $request->only($ap->getFillable());
                $ap->fill($data)->save();
                
                $nd = NetworkDevice::find($ap->network_device_id);
                $data = $request->only($nd->getFillable());
                $nd->fill($data)->save();
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
        Auth::User()->authorizeRoles(['administrator']);
        
        try {
            DB::transaction(function() use ($id) {
                $ap = AccessPoint::find($id);
                $ap->delete();
                NetworkDevice::find($ap->network_device_id)->delete();
            });
        } catch (Exception $exc) {
            return redirect('/accesspoint')->with('error', 'Access Point delete failed!');
        }
        
        return redirect('/accesspoint')->with('success', 'Access Point deleted!');           
    }
}
