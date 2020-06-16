@extends('layouts.master') 
    @section('header')
    <h1>Dashboard</h1>
    @stop
    @section('content') 
      @include('partials.navigation')
      <!-- Left side column. contains the logo and sidebar -->
    
    <section class="content-wrap" style="background-image: url('{{url('webmedia/images/cricg.jpg')}}');" data-section="home" data-stellar-background-ratio="0.5" id="home-section">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true" style="height: 499px;">
          <div class="col-md-12 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
            <h1 class="mb-5" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Welcome to Live Chat</h1>
            
            <form action="#" class="search-location">
	        		<div class="row">
	        			<div class="col-lg align-items-end">
	        				
		                    <img  src="{{url('webmedia/images/download-android-new.png')}}" alt="android-new" style="width: 200px;">
		                    
	        			</div>
	        		</div>
	        	</form>
          </div>
        </div>
      </div>
    </section>
<style type="text/css">
  .page_title{
    margin-top: -135px;right: 10px;position: absolute;background: #fff;padding: 10px;border-radius: 10px;
  }
</style>

  <!--Section: Content-->
  <section  id="termscondition" data-aos="fade-up">
      <div class="container my-5">
           <div class="row justify-content-end">
					<div class="col-md-12 ">
						<div class="heading-section text-center ftco-animate">
							<span class="subheading">Welcome to Live Chat
</span>
                        <h2 class="mb-4 page_title" >Welcome to Live Chat
</h2></div>       	
				</div>
				<div class="col-md-12">
          
           
      </div>
		    </div>
        </div>
	</section>

@stop