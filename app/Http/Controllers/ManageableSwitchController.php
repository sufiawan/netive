<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NetIve\ManageableSwitch;
use Exception;
use NetIve\ManageableSwitchPort;

class ManageableSwitchController extends Controller
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
        $list = ManageableSwitch::all();
        return view('manageableswitch.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manageableswitch.form', ['data' => new ManageableSwitch()]);
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
                $csid = ManageableSwitch::create($request->all());
                for ($i=1; $i<$request->number_of_port+1; $i++)
                {
                    ManageableSwitchPort::create([
                        'manageable_switch_id' => $csid->id,
                        'port_number' => 'Port '.$i
                    ]);
                }
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Manageable Switch create failed!');
        }
        
        return redirect('/manageableswitch')->with('success', 'Manageable Switch created!');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = ManageableSwitch::find($id);
        return view('manageableswitch.form', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ManageableSwitch::find($id);
        return view('manageableswitch.form', ['data' => $data]);
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
                $data = ManageableSwitch::find($id);
                $updateddata = $request->only($data->getFillable());
                $data->fill($updateddata)->save();
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Manageable Switch update failed!');
        }
        
        return redirect('/manageableswitch')->with('success', 'Manageable Switch updated!');
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
                ManageableSwitch::find($id)->delete();
            });
        } catch (Exception $exc) {
            return redirect('/manageableswitch')->with('error', 'Manageable Switch delete failed!');
        }
        
        return redirect('/manageableswitch')->with('success', 'Manageable Switch deleted!');
    }
}
