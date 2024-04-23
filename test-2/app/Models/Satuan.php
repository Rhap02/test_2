<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $fillable = ['satuan', 'desc', 'status'];

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
}
