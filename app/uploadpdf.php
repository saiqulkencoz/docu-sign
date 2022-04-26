<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class uploadpdf extends Model
{
    protected $table = 'uploadpdf';

    protected $fillable = ['id','nama','pdf','signed_id','status','note','instansi_id'];

    public function instansi(){
        return $this->belongsTo(Instansi::class);
    }
}


