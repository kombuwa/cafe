<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Header -->
	@include('admin.include.head')
    
	<style media="screen">
    .container {
      width: 200px;
      height: 260px;
      position: relative;
      margin: 0 auto 40px;
      border: 1px solid #CCC;
      -webkit-perspective: 800px;
         -moz-perspective: 800px;
           -o-perspective: 800px;
              perspective: 800px;
    }

    #card {
      width: 100%;
      height: 100%;
      position: absolute;
      -webkit-transition: -webkit-transform 1s;
         -moz-transition: -moz-transform 1s;
           -o-transition: -o-transform 1s;
              transition: transform 1s;
      -webkit-transform-style: preserve-3d;
         -moz-transform-style: preserve-3d;
           -o-transform-style: preserve-3d;
              transform-style: preserve-3d;
    }

    #card.flipped {
      -webkit-transform: rotateY( 180deg );
         -moz-transform: rotateY( 180deg );
           -o-transform: rotateY( 180deg );
              transform: rotateY( 180deg );
    }

    #card figure {
      display: block;
      height: 100%;
      width: 100%;
      line-height: 260px;
      color: white;
      text-align: center;
      font-weight: bold;
      font-size: 140px;
      position: absolute;
      -webkit-backface-visibility: hidden;
         -moz-backface-visibility: hidden;
           -o-backface-visibility: hidden;
              backface-visibility: hidden;
    }

    #card .front {
      background: red;
    }

    #card .back {
      background: blue;
      -webkit-transform: rotateY( 180deg );
         -moz-transform: rotateY( 180deg );
           -o-transform: rotateY( 180deg );
              transform: rotateY( 180deg );
    }
  </style>
</head>

<body>
	<?php 
		$username = Session::get('current_user');
		$user_access = Session::get('user_access');
		$user_id = Session::get('user_id');
	 ?>
    <div id="wrapper">

        <!-- Navigation -->
	@include('admin.include.nav')

	<!-- Content Top -->
	@include('admin.include.cont_top')
        
                    <h1 class="page-header">Blank</h1>
        <section class="container">
	    <div id="card">
	      <figure class="front">1</figure>
	      <figure class="back">2s</figure>
	    </div>
	  	</section>

	  	<section id="options">
	    	<p><button id="flip">Flip Card</button></p>
	  	</section>
                
    	<!-- Content bottom -->
	@include('admin.include.cont_bot')
    
    </div>
    <!-- /#wrapper -->

    
    <!-- Footer -->
	@include('admin.include.foot')

</body>

</html>
