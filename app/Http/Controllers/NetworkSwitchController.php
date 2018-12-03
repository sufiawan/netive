<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use NetIve\NetworkSwitch;
use NetIve\NetworkDevice;
use NetIve\SwitchPort;
use NetIve\SwitchTypes;
use NetIve\SwitchMode;
use NetIve\VirtualLan;
use NetIve\NetworkDeviceType;
use NetIve\EndDevice;
use NetIve\IpTable;
use NetIve\SwitchPortVlan;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NetworkSwitchController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    function rules() {
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
    public function index() {
        Auth::User()->authorizeRoles(['administrator', 'engineer']);

        $list = NetworkSwitch::all();
        return view('networkswitch.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        Auth::User()->authorizeRoles(['administrator']);

        return view('networkswitch.form', [
            'data' => new NetworkSwitch(),
            'netdev' => new NetworkDevice(),
            'switchtypes' => SwitchTypes::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        Auth::User()->authorizeRoles(['administrator']);

        $request->validate($this->rules());
        $portmode = ($request->switch_type_id != 1) ? 1 : NULL;

        try {
            DB::transaction(function() use ($request, $portmode) {
                $netDev = NetworkDevice::create($request->all() + ['network_device_type_id' => 7]);
                $switchid = NetworkSwitch::create($request->all() + ['network_device_id' => $netDev->id]);
                for ($i = 1; $i < $request->number_of_port + 1; $i++) {
                    SwitchPort::create([
                        'switch_id' => $switchid->id,
                        'port_number' => $i,
                        'switch_mode_id' => $portmode
                    ]);
                }
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Core Switch create failed!');
        }

        return redirect('/networkswitch')->with('success', 'Core Switch created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        Auth::User()->authorizeRoles(['administrator', 'engineer']);

        $data = NetworkSwitch::find($id);
        $netDev = NetworkDevice::find($data->network_device_id);
        $swmodes = ($data->switch_type_id == 1) ? SwitchMode::all() : SwitchMode::where('id', 1)->get();
        $hasuplink = true;
        if ($data->switch_type_id == 1) {
            $vlans = VirtualLan::all();            
        } else {
            $swportuplink = null;
            
            try {
                $swportuplink = SwitchPort::where([
                    ['switch_id', '=', $data->id],
                    ['is_uplink', '=', true]
                ])->firstOrFail();
            } catch (ModelNotFoundException $exc) {
                $vlans = null;
                $hasuplink = false;
            }
            
            if (!is_null($swportuplink)) {
                $vlans = SwitchPortVlan::where('switch_port_id', $swportuplink->id)
                        ->leftJoin('virtual_lans', 'switch_port_vlans.vlan_id', '=', 'virtual_lans.id')->get();                
            }
        }
        $ndtypes = NetworkDeviceType::all();

        return view('networkswitch.view', [
            'data' => $data,
            'netdev' => $netDev,
            'switchtypes' => SwitchTypes::all(),
            'switchmodes' => $swmodes,
            'vlans' => $vlans,
            'ndtypes' => $ndtypes,
            'has_uplink' => $hasuplink
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        Auth::User()->authorizeRoles(['administrator']);

        $data = NetworkSwitch::find($id);
        $netDev = NetworkDevice::find($data->network_device_id);
        $swmodes = ($data->switch_type_id == 1) ? SwitchMode::all() : SwitchMode::where('id', 1)->get();
        $hasuplink = true;
        if ($data->switch_type_id == 1) {
            $vlans = VirtualLan::all();            
        } else {
            $swportuplink = null;
            
            try {
                $swportuplink = SwitchPort::where([
                    ['switch_id', '=', $data->id],
                    ['is_uplink', '=', true]
                ])->firstOrFail();
            } catch (ModelNotFoundException $exc) {
                $vlans = null;
                $hasuplink = false;
            }
            
            if (!is_null($swportuplink)) {
                $vlans = SwitchPortVlan::where('switch_port_id', $swportuplink->id)
                        ->leftJoin('virtual_lans', 'switch_port_vlans.vlan_id', '=', 'virtual_lans.id')->get();                
            }
        }                
        $ndtypes = NetworkDeviceType::all();

        return view('networkswitch.form', [
            'data' => $data,
            'netdev' => $netDev,
            'switchtypes' => SwitchTypes::all(),
            'switchmodes' => $swmodes,
            'vlans' => $vlans,
            'ndtypes' => $ndtypes,
            'has_uplink' => $hasuplink
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        Auth::User()->authorizeRoles(['administrator']);

        $request->validate($this->rules());

        try {
            DB::transaction(function() use ($request, $id) {
                $sw = NetworkSwitch::find($id);
                $data = $request->only($sw->getFillable());
                $sw->fill($data)->save();

                $nd = NetworkDevice::find($sw->network_device_id);
                $data = $request->only($nd->getFillable());
                $nd->fill($data)->save();
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Core Switch update failed!');
        }

        return redirect('/networkswitch')->with('success', 'Core Switch updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Auth::User()->authorizeRoles(['administrator']);

        try {
            DB::transaction(function() use ($id) {
                SwitchPort::where('switch_id', $id)->delete();
                $sw = NetworkSwitch::find($id);
                $sw->delete();
                NetworkDevice::find($sw->network_device_id)->delete();
            });
        } catch (Exception $exc) {
            return redirect('/networkswitch')->with('error', 'Core Switch delete failed!');
        }
        return redirect('/networkswitch')->with('success', 'Core Switch deleted!');
    }

    public function ShowAvailableNetwokDevice($typeid) {
        if ($typeid == 8) {
            return DB::table('end_devices')->whereNotIn('id', function($q){
                $q->select('connected_device_id')->from('switch_ports')->where('connected_device_type_id', 8);
            })->orderBy('name')->get();
        } elseif ($typeid != 7) {
            return NetworkDevice::where('network_device_type_id', $typeid)->whereNotIn('id', function($q) use ($typeid) {
                $q->select('connected_device_id')->from('switch_ports')->where('connected_device_type_id', $typeid);
            })->get();        
        } else {
            return NetworkDevice::where('network_device_type_id', $typeid)->get();
        }
    }

    public function ShowAvailableSwitchPort($id) {
        $networkSwitch = NetworkSwitch::where('network_device_id', $id)->first();
        return SwitchPort::where('switch_id', $networkSwitch->id)->whereNull('connected_device_id')->get();
    }

    public function ShowAvailableIPAddress($vlanid) {
        $vlan = VirtualLan::find($vlanid);
        $ipTable = IpTable::where('vlan_id', $vlanid)->get();

        $unavailableIP = Array();
        foreach ($ipTable as $ip) {
            array_push($unavailableIP, $ip->ip_address);
        }

        $availableIP = Array();
        $startIP = ip2long($vlan->ip_segment);
        for ($idx = 2; $idx < 255; $idx++) {
            $generatedIP = long2ip($startIP + $idx);

            if (!in_array($generatedIP, $unavailableIP)) {
                $IPs = new IpTable;
                $IPs->ip_address = $generatedIP;

                array_push($availableIP, $IPs);
            }
        }

        return $availableIP;
    }

    public function SetPort(Request $request) {
        try {
            DB::transaction(function() use ($request) {
                $swport = SwitchPort::find($request->switch_port_id_setport);
                $swport->switch_mode_id = $request->switch_mode_id;
                $swport->save();

                foreach ($request->vlan as $vlan) {
                    SwitchPortVlan::create([
                        'switch_port_id' => $request->switch_port_id_setport,
                        'vlan_id' => $vlan
                    ]);
                }
            });
        } catch (Exception $exc) {
            return response()->json(['status' => 'false', 'message' => 'Port Set Failed!']);
        }
        return response()->json(['status' => 'true', 'message' => 'Port Set!']);
    }

    public function SetDevice(Request $request) {
        try {
            DB::transaction(function() use ($request) {
                // update switch port
                $swport = SwitchPort::find($request->switch_port_id_setdevice);
                $swport->connected_device_type_id = ($request->has('network_device_type')) ? $request->network_device_type : 7;
                $swport->connected_device_id = $request->network_device;
                $swport->save();
                
                // update connected switch uplink
                if ($swport->connected_device_type_id == 7) {                    
                    // update connected switch uplink
                    $sw = NetworkSwitch::find($swport->switch_id);
                    
                    $connswport = SwitchPort::find($request->connected_switch_port);
                    $connswport->connected_device_type_id = 7;
                    $connswport->connected_device_id = $sw->network_device_id;
                    $connswport->is_uplink = true;
                    $connswport->save();
                    
                    // update connected switch vlan
                    $connectedsw = NetworkSwitch::find($connswport->switch_id);
                    if($connectedsw->switch_type_id == 2) {
                        // only connected port update vlan
                        $swportvlans = SwitchPortVlan::where('switch_port_id', $swport->id)->get();
                        foreach ($swportvlans as $swportvlan) {
                            SwitchPortVlan::create([
                                'switch_port_id' => $connswport->id,
                                'vlan_id' => $swportvlan->vlan_id
                            ]);
                        }
                        // all port set vlan
                    } elseif($connectedsw->switch_type_id == 3) {                        
                        // get vlan
                        $swportvlan = SwitchPortVlan::where('switch_port_id', $swport->id)->first();
                        // get all switch port
                        $connectedswports = SwitchPort::where('switch_id', $connectedsw->id)->get();
                        foreach ($connectedswports as $connectedswport) {
                            SwitchPortVlan::create([
                                'switch_port_id' => $connectedswport->id,
                                'vlan_id' => $swportvlan->vlan_id
                            ]);
                        }
                    }
                } else {
                    // set ip
                    IpTable::create([
                        'ip_table_type_id' => 1,
                        'switch_port_id' => $request->switch_port_id_setdevice,
                        'vlan_id' => $request->vlan_port,
                        'ip_address' => $request->ip_address
                    ]);
                }                                          
            });
        } catch (Exception $exc) {
            return response()->json(['status' => 'false', 'message' => 'Device Set Failed!']);
        }
        return response()->json(['status' => 'true', 'message' => 'Device Set!']);
    }
    
    public function unsetDevice(Request $request) {
        try {
            DB::transaction(function() use ($request) {
                $swport = SwitchPort::find($request->switch_port_id_unsetdevice);
                $swport->connected_device_type_id = NULL;
                $swport->connected_device_id = NULL;
                $swport->save();
            });
        } catch (Exception $exc) {
            return response()->json(['status' => 'false', 'message' => 'Device unSet Failed!']);
        }
        return response()->json(['status' => 'true', 'message' => 'Device unSet!']);
    }
}
