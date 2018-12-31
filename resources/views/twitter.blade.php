<!DOCTYPE html>
<html>
<head>
	<title>My Tweetz</title>
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

   <style type="text/css">

    label{
    	color: #35A7E8;
    }
   	 
   	 .mycard{

   	 	border : 1px solid #35A7E8;
   	 	margin: 2px;
   	 }

   	 i{
   	 	margin-left: 13px;
   	 }

   </style>

</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	  <a class="navbar-brand" href="#">My Tweetz</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
	      </li>
	  </div>
	</nav>

    <br><br>

    <div class="container">
     <div class="container">
     	<form action="{{route('post.tweet')}}" method="POST" enctype="multipart/form-data">
     	 {{csrf_field()}}
     	  @if(count($errors) > 0)
     	   @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
           @endforeach
     	  @endif	
		  <div class="form-group">
		    <label><b>What's Happening</b></label>
		    <textarea class="form-control" rows="3" name="tweet"></textarea>
		  </div>
		  <div class="form-group">
		  	<label><b>Upload Images</b></label>
		  	<input class="form-control-file" type="file" name="images[]" multiple>
		  </div>

		  <button class="btn btn-primary" type="submit">Tweet</button>
		</form>	     	
     </div> 
    </div>


	<br><h1 class="text-center">Your Tweets</h1><br>


	<div class="container">
	 @if(!empty($data))
	  @foreach($data as $key => $tweet)
       <div class="card mycard">
       	<div class="card-body">
       	 <h5>{{$tweet['text']}}<i class="fas fa-heart float-right">{{$tweet['favorite_count']}}</i> <i class="fas fa-redo float-right">{{$tweet['retweet_count']}}</i></h5>

       	 @if(!empty($tweet['extended_entities']['media']))
          @foreach($tweet['extended_entities']['media'] as $i)
           <img src="{{$i['media_url_https']}}" width="60" height="60" style="border-radius: 50%;">
          @endforeach
       	 @endif
       	</div>
       </div> 
      @endforeach 
     @else
       <p class="text-center">No Tweets Found</p>
	 @endif 
		
	</div>

</body>
</html>