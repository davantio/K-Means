<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produksi extends Model
{
    use HasFactory;
    protected $table = 'produksi';
    protected $primaryKey = 'id';
    protected $fillable = ['tahun', 'id_kecamatan', 'luas_panen', 'hasil'];
    public $timestamps = true;

    //Mendefinisikan event listener untuk model
    protected static function boot()
    {
        parent::boot();

        //Event listener untuk event 'created'
        static::created(function ($produksi) {
            //Memanggil metode 'markFor..' dengan parameter new
            self::markForReclustering('new');
        });

        static::updated(function ($produksi) {
            self::markForReclustering('update');
        });

        static::deleted(function ($produksi) {
            self::markForReclustering('delete');
        });
    }

    //Membuat metode untuk menangani jenis event
    private static function markForReclustering($type)
    {
        //Memperbarui/membuat record yang ada berdasarkan kondisi
        DB::table('reclustering_status')->updateOrInsert(
            ['id' => 1],
            ['needs_reclustering' => true, 'type' => $type]
        );
    }

    public function kecamatans()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }

}
