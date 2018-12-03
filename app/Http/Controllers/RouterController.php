<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use NetIve\NetworkDevice;

class RouterController extends Controller
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
        
        $list = NetworkDevice::where('network_device_type_id', 5)->get();
        return view('router.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::User()->authorizeRoles(['administrator']);
        
        return view('router.form', ['netdev' => new NetworkDevice()]);
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
                NetworkDevice::create($request->all() + ['network_device_type_id' => 5]);
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Router create failed!');
        }
        
        return redirect('/router')->with('success', 'Router created!');
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
        
        $netdev = NetworkDevice::find($id);
        return view('router.view', ['netdev' => $netdev]);
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
        
        $netdev = NetworkDevice::find($id);
        return view('router.form', ['netdev' => $netdev]);
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
                $data = NetworkDevice::find($id);
                $updateddata = $request->only($data->getFillable());
                $data->fill($updateddata)->save();
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Router update failed!');
        }
        
        return redirect('/router')->with('success', 'Router updated!');
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
                NetworkDevice::find($id)->delete();
            });
        } catch (Exception $exc) {
            return redirect('/router')->with('error', 'Router delete failed!');
        }
        
        return redirect('/router')->with('success', 'Router deleted!');
    }
}
