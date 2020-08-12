<?php

namespace App\Http\Controllers;

use App\Http\Resources\RateWithMovieResource;
use App\Http\Resources\RatingResource;
use App\Rating;
use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Excel;

class TableController extends Controller
{
    //
    public function selectMovieByIdWithResource(Request $request){
        $userid = 5;
        $movies = Rating::where('user_id', $userid)->get();
        return RatingResource::collection($movies);
    }
    public function selectMovieByIdwithRelation(Request $request){
        $userid = $request->input('user_id');
        Log::debug($userid);
        $movietitle = Rating::with(['movie'])->where('user_id', $userid)->get();
        return RateWithMovieResource::collection($movietitle);
    }

    public function addRating(Request $request){
            //Create Post
//            $rate = new Rating;
//            $rate->user_id = $request->input('user_id');
//            $rate->movie_id = $request->input('movie_id');
//            $rate->rating = $request->input('rating');
//            $rate->save();
        $userid = $request->input('user_id');
        $movieid = $request->input('movie_id');
        $rating = $request->input('rating');

        $ratingData = array('user_id' => $userid, 'movie_id' => $movieid, 'rating' => $rating);
        Rating::create($ratingData);
    }

    public function deleteRating(Request $request){
        $userid = $request->input('user_id');
        $movieid = $request->input('movie_id');
        $whereArray = array('user_id'=>$userid,'movie_id'=>$movieid);
//        $id = 121;
        Rating::where($whereArray)->delete();
    }
    public function updateRating(Request $request){
//        Rating::where('id',3)->update(['movie_id'=>'267']);
        $userid = $request->input('user_id');
        $movieid = $request->input('movie_id');
        $rating = $request->input('rating');
        $whereArray = array('user_id'=>$userid,'movie_id'=>$movieid);
        DB::table('ratings')
            ->where($whereArray)
            ->update(['rating' => $rating]);
    }
    public function showRecord(Request $request){
        $userid = $request->input('user_id');
        $ratings = Rating::where('user_id', $userid)->get();
        return view('ratingRecord', compact('ratings'));
    }
}
