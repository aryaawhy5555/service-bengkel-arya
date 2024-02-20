<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\boking_service;
use App\Models\customer;
use App\Models\detail;
use App\Models\detailsChild;
use App\Models\montir;
use App\Models\motor;
use App\Models\service;
use App\Models\User;
use App\Http\Requests\StoreserviceRequest;
use App\Http\Requests\UpdateserviceRequest;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.service.index',[
            "service" => service::all(),
        ]
    );
    }
    public function indexDetail()
    {
    // Mengambil semua layanan
    $services = Service::all();

    $details = Detail::first();

    $no_nota =$details::find('no_nota');
    // return $no_nota;  
    $detailChild = DetailsChild::where('no_nota', $no_nota)->get();
    return view('admin.detail.index', [
        "services" => $services,
        "details" => $details,
        "detailChild" => $detailChild,
    ]);
    }
   
  
    public function create()
    {
        return view('admin.service.create',[
            "montir" => montir::all(),
            "boking" => boking_service::all(),
            "admin" => User::all(),
            "motor" => motor::all(),
            "service" => service::all(),
            "barang" => barang::all(),
            "cust" => customer::all(),
        ]);
    }
    public function customerNServie(StoreServiceRequest $request)
    {

        $validateCustomer= $request->validate([
            "namacust" => 'required',
            "email" => 'required|email',
            "alamatcust" => 'required',
            "tlpcust" => 'required|numeric' ,
             
        ],[
            "tlpcust.numeric" => 'data harus berupa angka'
        ]);

        customer::create($validateCustomer);

        return redirect('/service/create')->with('success','customer has been added');

    }
    public function mootorNServie(StoreServiceRequest $request)
    {
        // dd($request);

        $validateMotor= $request->validate([
            "no_plat" => 'required',
            "kd_cust" => 'required',
            "merk" => 'required',
            "variant" => 'required' ,
            "level" => 'required' ,
        ]);

        

        motor::create($validateMotor);

        return redirect('/service/create')->with('success','data has been added');

    }
   

    public function storeService(StoreServiceRequest $request)
    {
        // dd($request->all());
        $validateService = $request->validate([
            "kd_montir" => 'required',
            'tanggal' => 'required',
            "kd_admin" => 'required',
            "kd_motor" => 'required' ,
            "total" => 'required|numeric' ,
            "keluhan" => 'required', 
        ],[
            'total.numeric' => 'data harus angka'
        ],
    );
    
    // return $validateService;
        service::create($validateService);
        return redirect('/service/create')->with('success','data has been added');
    }
    public function storeServiceNDetails(StoreServiceRequest $request)
    {
        // dd($request->all());

        $validateDetail = $request->validate([
            'no_nota' => 'required',
            'tanggal' => 'required',
            'kd_cust' => 'required',
            'jumlah' => 'required',
            'subtotal' => 'required',
        ]);
    
        Detail::create($validateDetail);
    
        $selectedKdBarang = [];
    
        $new_harga = array_filter($request->harga, fn($harga) => !is_null($harga) && $harga !== '');
        foreach ($new_harga as $index => $harga) {
            if (isset($request->kd_barang[$index])) {
                $kd_barang = $request->kd_barang[$index];
                
                $selectedKdBarang[] = $kd_barang;
    
                detailsChild::create([
                    'kd_barang' => $kd_barang,
                    'harga' => $harga,
                    'no_nota' => $request->no_nota,
                ]);
            }
        }
    
        $jumlahKdBarang = array_count_values($selectedKdBarang);
    
        foreach ($jumlahKdBarang as $kd_barang => $jumlah) {
            $barang = Barang::where('kd_barang', $kd_barang)->first();
            if ($barang && $barang->stok >= $jumlah) {
                $barang->stok -= $jumlah;
                $barang->save();
            } 
        }
    
        return redirect('/service/create')->with('success', 'Data has been added');
    }
    
    

    public function edit($no_nota)
    {

        return view('admin.service.update',[
            "barang" => service::find($no_nota)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateserviceRequest $request, $no_nota)
    {  $service = service::find($no_nota);

        // Update konfirmasi menjadi "terkonfirmasi"
        if($service->konfirmasi === null){
            $service->update(['konfirmasi' => 'terkonfirmasi']);
        }else{
            return redirect('/service')->with('success','data telah terkonfirmasi');
        }
    

        return redirect('/service')->with('success','data has been updated');   
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($no_nota)
    {
        $item = service::find($no_nota);
        service::destroy('no_nota',$item->no_nota);
        
        return redirect('/service')->with('success','data has been deleted');

    }
}
