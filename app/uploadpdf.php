<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class uploadpdf extends Model
{
    protected $table = 'uploadpdf';

    protected $fillable = ['id','nama','pdf'];
}
