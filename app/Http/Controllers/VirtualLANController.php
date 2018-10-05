<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use NetIve\VirtualLAN;

class VirtualLANController extends Controller
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
        $list = VirtualLAN::all();
        return view('virtuallan.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('virtuallan.form', ['data' => new VirtualLAN()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (VirtualLAN::create($request->all()))
            return redirect('/virtuallan')->with('success', 'Virtual LAN created!');
        else
            return redirect()->back()->with('error', 'Virtual LAN create failed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = VirtualLAN::find($id);
        return view('virtuallan.form', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = VirtualLAN::find($id);
        return view('virtuallan.form', ['data' => $data]);
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
        $data = VirtualLAN::find($id);
        $updateddata = $request->only($data->getFillable());
        $data->fill($updateddata);

        if ($data->save())
            return redirect('/virtuallan')->with('success', 'Virtual LAN updated!');
        else
            return redirect()->back()->with('error', 'Virtual LAN update failed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = VirtualLAN::find($id);
        if ($data->delete())
            return redirect('/virtuallan')->with('success', 'Virtual LAN deleted!');
        else
            return redirect('/virtuallan')->with('error', 'Virtual LAN delete failed!');
    }
}
