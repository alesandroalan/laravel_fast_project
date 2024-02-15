<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $r)
        {
            if($r->has('filter')){
                $permissions = Permission::
                where('name', 'like', "%{$r->get('filter')}%")->orWhere('description','like',"%{$r->get('filter')}%")
                 ->paginate(25)->withQueryString();
            }else{
                $permissions = Permission::paginate(25)->withQueryString();
            }
            return view('permissions.index', ['permissions'=>$permissions]);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PermissionRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PermissionRequest $request)
    {
        $permission = new Permission;
		$permission->name = $request->input('name');
		$permission->description = $request->input('description');
        $permission->save();

        return to_route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.show',['permission'=>$permission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit',['permission'=>$permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PermissionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->name = $request->input('name');
		$permission->description = $request->input('description');
        $permission->save();

        return to_route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return to_route('permissions.index');
    }
}
