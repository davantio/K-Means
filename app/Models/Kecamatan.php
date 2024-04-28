<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatans';
    protected $primaryKey = 'id_kecamatan';
    protected $fillable = ['kode', 'nama'];
    public $timestamps = true;

    public function produksi()
    {
        return $this->hasMany(Produksi::class, 'id_kecamatan');
    }

    public function clustering()
    {
        return $this->hasMany(Clustering::class, 'id_kecamatan');
    }
}
