<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;
    protected $table = 'produksi';
    protected $primaryKey = 'id';
    protected $fillable = ['tahun', 'id_kecamatan', 'luas_panen', 'hasil'];
    public $timestamps = true;

    public function kecamatans()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }

}
