<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use NetIve\EndDevice;

class EndDeviceController extends Controller
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
        $list = EndDevice::all();
        return view('enddevice.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('enddevice.form', ['data' => new EndDevice()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (EndDevice::create($request->all()))
            return redirect('/enddevice')->with('success', 'EndDevice created!');
        else
            return redirect()->back()->with('error', 'EndDevice create failed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = EndDevice::find($id);
        return view('enddevice.form', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = EndDevice::find($id);
        return view('enddevice.form', ['data' => $data]);
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
        $data = EndDevice::find($id);
        $updateddata = $request->only($data->getFillable());
        $data->fill($updateddata);

        if ($data->save())
            return redirect('/enddevice')->with('success', 'EndDevice updated!');
        else
            return redirect()->back()->with('error', 'EndDevice update failed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = EndDevice::find($id);
        if ($data->delete())
            return redirect('/enddevice')->with('success', 'EndDevice deleted!');
        else
            return redirect('/enddevice')->with('error', 'EndDevice delete failed!');
    }
}
