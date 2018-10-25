<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NetIve\UnmanageableSwitch;
use NetIve\UnmanageableSwitchPort;
use Exception;

class UnmanageableSwitchController extends Controller
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
        $list = UnmanageableSwitch::all();
        return view('unmanageableswitch.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unmanageableswitch.form', ['data' => new UnmanageableSwitch()]);
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
                $csid = UnmanageableSwitch::create($request->all());
                for ($i=1; $i<$request->number_of_port+1; $i++)
                {
                    UnmanageableSwitchPort::create([
                        'unmanageable_switch_id' => $csid->id,
                        'port_number' => 'Port '.$i
                    ]);
                }
            });
        } catch (Exception $exc) {            
            return redirect()->back()->with('error', 'Unmanageable Switch create failed!');
        }
        
        return redirect('/unmanageableswitch')->with('success', 'Unmanageable Switch created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = UnmanageableSwitch::find($id);
        return view('unmanageableswitch.form', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = UnmanageableSwitch::find($id);
        return view('unmanageableswitch.form', ['data' => $data]);
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
                $data = UnmanageableSwitch::find($id);
                $updateddata = $request->only($data->getFillable());
                $data->fill($updateddata)->save();
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Unmanageable Switch update failed!');
        }
        
        return redirect('/unmanageableswitch')->with('success', 'Unmanageable Switch updated!');
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
                UnmanageableSwitch::find($id)->delete();
            });
        } catch (Exception $exc) {
            return redirect('/unmanageableswitch')->with('error', 'Unmanageable Switch delete failed!');
        }
        
        return redirect('/unmanageableswitch')->with('success', 'Unmanageable Switch deleted!');
    }
}
