<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \File;
use \Twitter ;

class TwitterController extends Controller
{
   private $count = 10 ;
   private $format = 'array' ;

    public function TwitterUserTimeLine(){

     $data = Twitter::getUserTimeline(['count' => $this->count , 'format' => $this->format]) ;

     return view('twitter')->with('data' , $data);

    }


    public function tweet(Request $request){

       $this->validate($request,[
           
           'tweet' => 'required'
       ]);

       $newTweet = ['status' => $request->tweet] ;

       if(!empty($request->images)){

        foreach($request->images as $key => $value){
        	$uploadMeadia = Twitter::uploadMedia(['media' => File::get($value->getRealPath())]) ;
        	if(!empty($uploadMeadia)){
        		$newTweet['media_ids'][$uploadMeadia->media_id_string] = $uploadMeadia->media_id_string ;
        	}
         }

       }


       $twitter = Twitter::postTweet($newTweet);

       return back();

    }
}
