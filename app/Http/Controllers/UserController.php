<?php

namespace NetIve\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use NetIve\User;
use NetIve\Role;
use Exception;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        Auth::User()->authorizeRoles(['administrator']);

        $list = User::all();
        return view('user.index', ['listdata' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        Auth::User()->authorizeRoles(['administrator']);

        return view('user.form', ['data' => new User(), 'roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        Auth::User()->authorizeRoles(['administrator']);

        $request->validate([
            'nip' => 'required|numeric|digits:18|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
        ]);

        try {

            $request['password'] = Hash::make($request->password);
            if (User::create($request->all())) {
                return redirect('/user')->with('success', 'User created!');
            } else {
                return redirect()->back()->with('error', 'User create failed!');
            }
        } catch (Exception $exc) {
            return redirect()->back()->with('error', $exc->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        Auth::User()->authorizeRoles(['administrator']);

        $data = User::find($id);
        return view('user.changepassword', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
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
    public function update(Request $request, $id) {
        Auth::User()->authorizeRoles(['administrator']);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        try {
            DB::transaction(function() use ($request, $id) {
                $data = User::find($id);
                $data->name = $request->name;
                $data->email = $request->email;
                $data->role_id = $request->role_id;
                $data->save();

//                $updateddata = $request->only($data->getFillable());
//                $data->fill($updateddata)->save();
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'User update failed!');
        }

        return redirect('/user')->with('success', 'User updated!');
    }

    public function changepassword(Request $request) {
        Auth::User()->authorizeRoles(['administrator', 'engineer']);

        $request->validate([
            'password' => 'required|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            $err = ValidationException::withMessages([
                        'current_password' => ["Current password doesn't match!"]
            ]);

            throw $err;
        }

        try {
            DB::transaction(function() use ($request) {
                $data = User::find(Auth::user()->id);
                $data->password = Hash::make($request->password);
                $data->save();
            });
        } catch (Exception $exc) {
            return redirect()->back()->with('error', 'Change password failed!');
        }

        return redirect()->back()->with('success', 'Password changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
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
