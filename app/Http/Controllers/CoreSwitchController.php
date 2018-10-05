<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use NetIve\CoreSwitch;

class CoreSwitchController extends Controller
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
        $list = CoreSwitch::all();
        return view('coreswitch.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coreswitch.form', ['data' => new CoreSwitch()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (CoreSwitch::create($request->all()))
            return redirect('/coreswitch')->with('success', 'CoreSwitch created!');
        else
            return redirect()->back()->with('error', 'CoreSwitch create failed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = CoreSwitch::find($id);
        return view('coreswitch.form', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = CoreSwitch::find($id);
        return view('coreswitch.form', ['data' => $data]);
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
        $data = CoreSwitch::find($id);
        $updateddata = $request->only($data->getFillable());
        $data->fill($updateddata);

        if ($data->save())
            return redirect('/coreswitch')->with('success', 'CoreSwitch updated!');
        else
            return redirect()->back()->with('error', 'CoreSwitch update failed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CoreSwitch::find($id);
        if ($data->delete())
            return redirect('/coreswitch')->with('success', 'CoreSwitch deleted!');
        else
            return redirect('/coreswitch')->with('error', 'CoreSwitch delete failed!');
    }
}
