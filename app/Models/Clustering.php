<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clustering extends Model
{
    use HasFactory;
    protected $table = 'cluster_results';
    protected $primaryKey = 'id';
    protected $fillable = ['tahun', 'id_kecamatan', 'luas_panen', 'hasil', 'cluster'];
    public $timestamps = true;

    public function kecamatans()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }
}
