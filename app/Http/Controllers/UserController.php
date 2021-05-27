<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::where('role', '=', 1)->get();
        $data['title'] = "Admins";

        return view('admins.index', $data, compact('admins'));
    }

    public function operatorlist()
    {
        $admins = User::where('role', '=', 0)->get();
        $data['title'] = "Operators";

        return view('operators.index', $data, compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Users';

        return view('admins.create', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255', 'alpha'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'max:255'],
            'status' => 'required',
        ]);


        try {
            User::create([
                'status' => $request['status'],
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'role' => $request['role'],

            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                Session::flash('message', 'User email already exists');
                Session::flash('class', 'danger');

                return redirect()->back()->withInput($request->all());
            }
        }

        Session::flash('message', 'User Added Successfully');
        Session::flash('class', 'success');

        $data['title'] = 'Users';

        return redirect()->action('UserController@create');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Users';

        $user = User::find($id);
        if (!$user) return abort(404);

        return view('admins.edit', $data, compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    public function adminupdate(Request $request, $id)
    {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'max:255'],
            'status' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->status = $request->status;
        $user->role = $request->role;
        $user->password = Hash::make($request['password']);
        try {
            $user->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                Session::flash('message', 'user email already exists');
                Session::flash('class', 'danger');

                return redirect()->back()->withInput($request->all());
            }
        }

        Session::flash('message', 'User Updated Successfully');
        Session::flash('class', 'success');

        return redirect()->action('UserController@edit', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();

        return 'true';
    }

    public function operaterdel($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();

        return 'true';
    }
}
