<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $table = 'travel'; 

    protected $fillable = [
        'id_tanggal_keberangkatan',
        'kuota',
    ];

    public $timestamps = false; 

    
    public function passengers()
    {
        return $this->hasMany(Passenger::class, 'id_travel');
    }
}
