<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $r)
        {
            if($r->has('filter')){
                $users = User::
                where('name', 'like', "%{$r->get('filter')}%")->orWhere('email','like',"%{$r->get('filter')}%")
                 ->paginate(25)->withQueryString();
            }else{
                $users = User::paginate(25)->withQueryString();
            }
            return view('users.index', ['users'=>$users]);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = Role::orderBy('name','asc')->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $user = new User;
		$user->name = $request->input('name');
		$user->email = $request->input('email');
        if($request->has('password') && !empty($request->input('password')))
		    $user->password = Hash::make($request->input('password'));
        $user->save();

        return to_route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show',['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name','asc')->get();
        $selected_role = $user->roles()->get()->count() > 0 ? $user->roles()->first()->id : '';
        return view('users.edit',compact('user', 'roles', 'selected_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
		$user->name = $request->input('name');
		$user->email = $request->input('email');
        if($request->has('password') && !empty($request->input('password')))
            $user->password = Hash::make($request->input('password'));
        $user->save();
        $user->roles()->sync([$request->input('roles')]);
        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->sync([]);
        $user->delete();

        return to_route('users.index');
    }
}
