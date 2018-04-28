<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Floor;
use Auth;

class ManagerFloorController extends Controller
{
    public function index(){
        $user = Auth::guard('employee')->user();
        $loginAdminId = $user->id;
        $loginAdminRole = $user->getRoleNames();
        return view('admin.floors.index',compact('loginAdminId','loginAdminRole' ));
    }
    public function  get_data(){
        $floors = Floor::with('employee:name,id')->get();
        return datatables()->of($floors)->toJson();
    }
    public function edit($id){
        $floor = Floor::findOrFail($id);
        return view('admin.floors.edit',compact('floor'));
    }
    public function create(){
        return view('admin.floors.create');
    }
    
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $floor=new Floor;
        $floor->name = $request->name;
        $floor->number = mt_rand(1000, 9999);
        $floor->save();
        return redirect()->route('floors.index')->
                with('success','Floor  added successfully');
    }
    public function delete(Request $request)
    {    
        if($request->ajax()){
            $floor =Floor::findOrFail($request->id)->delete();
            return response()->json(['deleteStatus'=> $floor  ]);
        }    
    }

   
    

    
    public function update(Request $request, $id)
    {   
        $request->validate([
            'name' => 'required',
        ]);
        $floor =Floor::findOrFail($id);
        $floor->name = $request->name;
        $floor->save();
        return redirect()->route('floors.index')
                ->with('success','floors updated successfully');
    }
    
}