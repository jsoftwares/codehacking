<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    public $uploads = '/images/';
    protected $fillable = ['file'];


    //Uploaded photo accessor
    public function getFileAttribute($photo){
        return $this->uploads.$photo;
    }
}
