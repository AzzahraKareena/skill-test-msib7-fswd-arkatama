<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $table = 'penumpang'; 

    protected $fillable = [
        'id_travel',
        'kode_booking',
        'nama',
        'jenis_kelamin',
        'kota',
        'usia',
        'tahun_lahir',
        'created_at',
    ];

    public $timestamps = false; 
    
    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = strtoupper($value);
    }

    
    public function setKotaAttribute($value)
    {
        $this->attributes['kota'] = strtoupper($value);
    }

   
    public function travel()
    {
        return $this->belongsTo(Travel::class, 'id_travel');
    }

 
    public static function generateBookingCode($travelId, $orderNumber)
    {
        $yearMonth = date('ym');
        return sprintf('%s%04d%04d', $yearMonth, $travelId, $orderNumber);
    }
}
