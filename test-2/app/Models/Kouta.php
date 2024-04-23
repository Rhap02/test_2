<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kouta extends Model
{
    use HasFactory;

    protected $fillable = [
        'kouta',
        'satuan_id',
        'berat',
        'harga',
        'cabang',
      
    ];
    public function enable()
    {
        $this->status = true;
        $this->save();
    }

    public function disable()
    {
        $this->status = false;
        $this->save();
    }

    
    public function satuan()
    {
        return $this->belongsTo(Satuan::class,'satuan_id','id');
    }
    
    public $timestamps = true;
}
