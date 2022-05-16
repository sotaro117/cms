<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index(){
        return view('admin.permissions.index', [
            'permissions'=>Permission::all()
        ]);
    }

    public function edit(Permission $permission){
        return view('admin.permissions.edit', ['permission'=>$permission]);
    }

    public function store(){
        request()->validate([
            'name'=>['required']
        ]);
        Permission::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::lower(request('slug'))
        ]);
        return back();
    }

    public function update(Permission $permission){
        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(request('name'))->slug('-');

        if($permission->isDirty('name')){
            session()->flash('permission-updated', 'Permission updated: '. request('name'));
            $permission->save();
        } else {
            session()->flash('permission-updated', 'Nothing was updated');
        }
        return back();
    }

    public function destroy(Permission $permission){
        $permission->delete();
        session()->flash('permission-deleted', 'Permission deleted: '. $permission->name);
        return back();
    }
}
