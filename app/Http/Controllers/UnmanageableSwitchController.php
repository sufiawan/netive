<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use NetIve\UnmanageableSwitch;

class UnmanageableSwitchController extends Controller
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
        if (UnmanageableSwitch::create($request->all()))
            return redirect('/unmanageableswitch')->with('success', 'UnmanageableSwitch created!');
        else
            return redirect()->back()->with('error', 'UnmanageableSwitch create failed!');
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
        $data = UnmanageableSwitch::find($id);
        $updateddata = $request->only($data->getFillable());
        $data->fill($updateddata);

        if ($data->save())
            return redirect('/unmanageableswitch')->with('success', 'UnmanageableSwitch updated!');
        else
            return redirect()->back()->with('error', 'UnmanageableSwitch update failed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = UnmanageableSwitch::find($id);
        if ($data->delete())
            return redirect('/unmanageableswitch')->with('success', 'UnmanageableSwitch deleted!');
        else
            return redirect('/unmanageableswitch')->with('error', 'UnmanageableSwitch delete failed!');
    }
}
