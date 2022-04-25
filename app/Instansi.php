<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'instansi';

    protected $fillable = ['id','nama'];

    public function user(){
        return $this->hasMany(User::class);
    }
    
    public function dokumen(){
        return $this->hasMany(uploadpdf::class);
    }
}
