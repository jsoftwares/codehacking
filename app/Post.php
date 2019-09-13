<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['category_id', 'image_id', 'title', 'body'];

    //Relationships
    //Post belongsTo a User
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    //Post has one photo
    public function photo()
    {
        //Note we added image_id as 2nd parameter here bcos normally d relationship expects a photo_id in the
        //posts table, but since we have named it image_id instead, we had to tell laravel the name of the foreign key
        return $this->belongsTo('App\Photo', 'image_id');
    }

    //Post belongsTo a category
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
