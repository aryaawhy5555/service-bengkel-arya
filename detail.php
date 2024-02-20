<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail extends Model
{
    use HasFactory;

    protected $table = 'details';
    protected $guarded = ['id'];

    public  $timestamps = false;


    // no_nota
    public function service(){
        return $this->belongsTo(service::class,'no_nota','no_nota');
    }

    public function detailsChild()
    {
        return $this->hasMany(DetailsChild::class, 'no_nota', 'no_nota');
    }
    

    public static function boot()
{
    parent::boot();

    // Menambahkan event listener saat detail dibuat
    detail::created(function ($detail) {
        $detail->updateHistorySubtotal();
    });
}
public function updateHistorySubtotal()
{
    
    $subtotalValue = $this->subtotal ? $this->sum('subtotal') : 0;

    
    riwayatSubtotal::create([
        'no_nota' => $this->no_nota,
        'tanggal' => $this->tanggal,
        'subtotal' =>$subtotalValue,
    ]);
}

}

