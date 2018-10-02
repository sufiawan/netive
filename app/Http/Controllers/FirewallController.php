<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use NetIve\Firewall;

class FirewallController extends Controller
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
        $list = Firewall::all();
        return view('firewall.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('firewall.form', ['data' => new Firewall()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Firewall::create($request->all()))
            return redirect('/firewall')->with('success', 'Firewall created!');
        else
            return redirect()->back()->with('error', 'Firewall create failed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Firewall::find($id);
        return view('firewall.form', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Firewall::find($id);
        return view('firewall.form', ['data' => $data]);
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
        $data = Firewall::find($id);
        $updateddata = $request->only($data->getFillable());
        $data->fill($updateddata);

        if ($data->save())
            return redirect('/firewall')->with('success', 'Firewall updated!');
        else
            return redirect()->back()->with('error', 'Firewall update failed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Firewall::find($id);
        if ($data->delete())
            return redirect('/firewall')->with('success', 'Firewall deleted!');
        else
            return redirect('/firewall')->with('error', 'Firewall delete failed!');
    }
}
