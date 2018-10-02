<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use NetIve\AccessPoint;

class AccessPointController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(Request $request)
    {
        return Validator::make($request, [
            'ipaddress' => 'ip',
            'string' => 'required|string',
            'year' => 'required|numeric|digits:4'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aps = AccessPoint::all();
        return view('accesspoint.index', ['accesspoints' => $aps]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accesspoint.form', ['accesspoint' => new AccessPoint()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (AccessPoint::create($request->all()))
            return redirect('/accesspoint')->with('success', 'Access Point created!');
        else
            return redirect()->back()->with('error', 'Access Point create failed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ap = AccessPoint::find($id);
        return view('accesspoint.form', ['accesspoint' => $ap]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ap = AccessPoint::find($id);
        return view('accesspoint.form', ['accesspoint' => $ap]);
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
        $ap = AccessPoint::find($id);
        $data = $request->only($ap->getFillable());
        $ap->fill($data);

        if ($ap->save())
            return redirect('/accesspoint')->with('success', 'Access Point updated!');
        else
            return redirect()->back()->with('error', 'Access Point update failed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ap = AccessPoint::find($id);
        if ($ap->delete())
            return redirect('/accesspoint')->with('success', 'Access Point deleted!');
        else
            return redirect('/accesspoint')->with('error', 'Access Point delete failed!');
    }
}
