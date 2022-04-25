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
}
