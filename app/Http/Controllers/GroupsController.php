<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Group;
use App\Http\Requests\GroupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $r)
        {
            if($r->has('filter')){
                $groups = Role::
                where('name', 'like', "%{$r->get('filter')}%")
                 ->paginate(25)->withQueryString();
            }else{
                $groups = Role::paginate(25)->withQueryString();
            }
            return view('groups.index', ['groups'=>$groups]);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        try {
            $roles = Role::orderBy('name','asc')->get();
            $permissions = Permission::orderBy('description','asc')->get();
        }catch (\Exception $e){
            return Redirect::route('groups.index')->withErrors("Erro: ({$e->getMessage()}).");
        }
        return view('groups.create', compact('roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GroupRequest $request)
    {
        try {
            $group = new Role;
            $group->name = $request->input('name');
            $group->save();
            $permissions = $request->input('permissions');
            $group->permissions()->sync($permissions);
        }catch (\Exception $e){
            return Redirect::route('groups.create')->withErrors("Erro: ({$e->getMessage()}).");
        }

        return to_route('groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $group = Role::findOrFail($id);
        return view('groups.show',['group'=>$group]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        try {
            $roles = Role::orderBy('name','asc')->get();
            $permissions = Permission::orderBy('description','asc')->get();
            $group = Role::findOrFail($id);
            $selected_permissions = $group->permissions()->get()->count() > 0 ? $group->permissions()->pluck('id')->toArray() : array();
        }catch (\Exception $e){
            return Redirect::route('groups.index')->withErrors("Erro: ({$e->getMessage()}).");
        }
        return view('groups.edit',compact('group','roles','selected_permissions','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GroupRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GroupRequest $request, $id)
    {
        try {
            $group = Role::findOrFail($id);
            $group->name = $request->input('name');
            $group->save();
            $permissions = $request->input('permissions');
            $group->permissions()->sync($permissions);
        }catch (\Exception $e){
            return Redirect::route('groups.edit',['id' => $id])->withErrors("Erro: ({$e->getMessage()}).");
        }
        return to_route('groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $group = Role::findOrFail($id);
            $group->permissions()->sync([]);
            $group->delete();
        }catch (\Exception $e){
            return Redirect::route('groups.index')->withErrors("Erro: ({$e->getMessage()}).");
        }
        return to_route('groups.index');
    }
}
