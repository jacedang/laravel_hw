<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Rating extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'movie_id', 'rating'];
    public function movie(){
        return $this->hasOne('App\Movie','movie_id', 'movie_id');
    }
    //
}
