<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreaccountRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class AdminAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.Account.index',[
            
            "users" =>   User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Account.CRUD.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreaccountRequest $request)
    {

        $validatedData = $request->validate([
            "username"  => "required|unique:admins",
            "password"  =>  "required|min:4",
            "image"     =>  "image|file",
            "level"      =>  "required"
        ]);

        
        if($request->file('image')){
            $validatedData['image']  =   $request->file('image')->store('imageProfil-account');
        }

        $validatedData['password']  = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/admin')->with('success','Account has been created');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
 
        return view('admin.Account.CRUD.show',[
            "user"      => User::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * 
     * 
     */
    public function edit($id){
        // dd($id);

       return view('admin.Account.CRUD.edit',[
        "user"     => User::find($id),
       ]);
    }

    /**
     * Update the specified resource in storage.
     */     
    public function update(Request $request,$id)
    {

        $user = User::find($id);

        // dd($user->image);

         $rules  =   [
            "username"      => "required",
            "image"     =>  "image|file",
        ];

     
        if ($request->username != $user->username) {
            $rules['username']  =   'required';
        }
      
        
        
        $validatedData = $request->validate($rules);
        
        if ($request->file('image')) {
            if (($user->image) != null) {
                Storage::delete($user->image);
            }
        $validatedData['image'] =   $request->file('image')->store('imageProfil-account');
        }

        

        User::where('id', $user->id)->update($validatedData);

        return redirect('/adminAccount')->with('success', 'data done edid');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user->image){
            Storage::delete($user->image);
        }

        User::destroy('id',$user->id);
        return redirect('/admin')->with('success','data has been deleted');   
    }
}
