<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use NetIve\BandwidthManagement;

class BandwidthManagementController extends Controller
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
        $list = BandwidthManagement::all();
        return view('bandwidthmanagement.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bandwidthmanagement.form', ['data' => new BandwidthManagement()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (BandwidthManagement::create($request->all()))
            return redirect('/bandwidthmanagement')->with('success', 'Bandwidth Management created!');
        else
            return redirect()->back()->with('error', 'Bandwidth Management create failed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = BandwidthManagement::find($id);
        return view('bandwidthmanagement.form', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = BandwidthManagement::find($id);
        return view('bandwidthmanagement.form', ['data' => $data]);
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
        $data = BandwidthManagement::find($id);
        $updateddata = $request->only($data->getFillable());
        $data->fill($updateddata);

        if ($data->save())
            return redirect('/bandwidthmanagement')->with('success', 'Bandwidth Management updated!');
        else
            return redirect()->back()->with('error', 'Bandwidth Management update failed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = BandwidthManagement::find($id);
        if ($data->delete())
            return redirect('/bandwidthmanagement')->with('success', 'Bandwidth Management deleted!');
        else
            return redirect('/bandwidthmanagement')->with('error', 'Bandwidth Management delete failed!');
    }
}
