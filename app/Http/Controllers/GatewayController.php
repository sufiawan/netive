<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use NetIve\Gateway;

class GatewayController extends Controller
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
        $list = Gateway::all();
        return view('gateway.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gateway.form', ['data' => new Gateway()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gateway::create($request->all()))
            return redirect('/gateway')->with('success', 'Gateway created!');
        else
            return redirect()->back()->with('error', 'Gateway create failed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Gateway::find($id);
        return view('gateway.form', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Gateway::find($id);
        return view('gateway.form', ['data' => $data]);
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
        $data = Gateway::find($id);
        $updateddata = $request->only($data->getFillable());
        $data->fill($updateddata);

        if ($data->save())
            return redirect('/gateway')->with('success', 'Gateway updated!');
        else
            return redirect()->back()->with('error', 'Gateway update failed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Gateway::find($id);
        if ($data->delete())
            return redirect('/gateway')->with('success', 'Gateway deleted!');
        else
            return redirect('/gateway')->with('error', 'Gateway delete failed!');
    }
}
