<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use NetIve\User;
use NetIve\Role;
use Exception;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function rules()
    {
        return [
            'nip' => 'required|numeric|digits:18',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::User()->authorizeRoles(['administrator']);
        
        $list = User::all();
        return view('user.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::User()->authorizeRoles(['administrator']);
        
        return view('user.form', ['data' => new User(), 'roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::User()->authorizeRoles(['administrator']);
        
        $request->validate($this->rules());
        
        $request['password'] = Hash::make($request->password);
        if (User::create($request->all()))
            return redirect('/user')->with('success', 'User created!');
        else
            return redirect()->back()->with('error', 'User create failed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Auth::User()->authorizeRoles(['administrator']);
        
        $data = User::find($id);
        return view('user.form', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::User()->authorizeRoles(['administrator']);
        
        $data = User::find($id);
        return view('user.form', ['data' => $data, 'roles' => Role::all()]);
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
        Auth::User()->authorizeRoles(['administrator']);
        
        $request->validate($this->rules());
        
        try {
            DB::transaction(function() use ($request, $id) {
                $data = User::find($id);
                $updateddata = $request->only($data->getFillable());
                $data->fill($updateddata)->save();
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'User update failed!');
        }
        
        return redirect('/user')->with('success', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::User()->authorizeRoles(['administrator']);
        
        try {
            DB::transaction(function() use ($id) {
                User::find($id)->delete();
            });
        } catch (Exception $exc) {
            return redirect('/user')->with('error', 'User delete failed!');
        }
                
        return redirect('/user')->with('success', 'User deleted!');           
    }
}
