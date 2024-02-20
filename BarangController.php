<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Http\Requests\StorebarangRequest;
use App\Http\Requests\UpdatebarangRequest;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Barang $barang)
    {
        return view('admin.bengkel.sperpat.index',[
            "barang" => barang::all()
        ]
    );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorebarangRequest $request)
    {
        // return $request;

        $validate = $request->validate([
            "nama_barang" => 'required',
            "harga_beli" => 'required',
            "harga_barang" => 'required',
            "harga_jual" => 'required',
            "stok" => 'required' ,
            "image" => 'required|file'
        ]);

        if($request->file('image')){
            $validate['image'] = $request->file('image')->store('image-barang');
        }

        barang::create($validate);

        return redirect('/sperpat')->with('success','data has been added');

    }

    /**
     * Display the specified resource.
     */
    public function show(barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kd_barang)
    {

        return view('admin.bengkel.sperpat.update',[
            "barang" => barang::find($kd_barang)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebarangRequest $request, $kd_barang)
    {
        $barang = barang::find($kd_barang);
    
        $rules = [
            "nama_barang" => 'required',
            "harga_barang" => 'required',
            "stok" => 'required',
            "harga_beli" => 'required',
            "harga_jual" => 'required',
            "image" => 'file' // Remove the 'required' rule for the image
        ];
    
        $validate = $request->validate($rules);
    
        // Check if an image file is present in the request
        if ($request->file('image')) {
            // Delete the existing image if it exists
            if ($barang->image) {
                Storage::delete($barang->image);
            }
     
            // Store the new image
            $validate['image'] = $request->file('image')->store('image-barang');
        } else {
            // If no new image is provided, use the existing image path
            $validate['image'] = $barang->image;
        }
    
        // Update the barang record
        barang::where('kd_barang', $barang->kd_barang)
            ->update($validate);
    

        return redirect('/sperpat')->with('success','data has been updated');   
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kd_barang)
    {
        $barang = Barang::find($kd_barang);
        if($barang->image){
            Storage::delete($barang->image);
        }
        Barang::destroy($barang->kd_barang);
        
        return redirect('/sperpat')->with('success','data has been deleted');

    }
}
