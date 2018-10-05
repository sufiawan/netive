<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use NetIve\ManageableSwitch;

class ManageableSwitchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        if (ManageableSwitch::create($request->all()))
            return redirect('/manageableswitch')->with('success', 'ManageableSwitch created!');
        else
            return redirect()->back()->with('error', 'ManageableSwitch create failed!');
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
        $data = ManageableSwitch::find($id);
        $updateddata = $request->only($data->getFillable());
        $data->fill($updateddata);

        if ($data->save())
            return redirect('/manageableswitch')->with('success', 'ManageableSwitch updated!');
        else
            return redirect()->back()->with('error', 'ManageableSwitch update failed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ManageableSwitch::find($id);
        if ($data->delete())
            return redirect('/manageableswitch')->with('success', 'ManageableSwitch deleted!');
        else
            return redirect('/manageableswitch')->with('error', 'ManageableSwitch delete failed!');
    }
}
