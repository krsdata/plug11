     <?php $bgUrl = env('main_slider_image'); ?>
      <section class="hero-wrap js-fullheight" style="background-image: url('<?php echo $bgUrl; ?>')" data-section="home" data-stellar-background-ratio="0.5" id="home-section">
      	<div style="position: absolute;
	  	        text-align: center;
	  	        width: 100%;
			    top: 90px;">
        <img src="{{URL::asset('webmedia/images/logo.png')}}" width="150px"  style="
			    border: 0px solid #fff;
			    border-radius: 5px;
			" align="center">
		</div>
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-12 ftco-animate" data-scrollax=" properties: { translateY: '70%' }" >
            <h1 class="mb-5" data-scrollax="properties: { translateY: '60%', opacity: 1.6 }" align="center" style="color: #FFC103">{{env('company_name')}} Fantasy League</h1>
            
            <p class="mb-5" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }" align="center">Create Team | Join Contest | Win Cash</p>
                    <div class="row" align="center">
                        <div class="col-lg align-items-end">
                             <a href="{{env('apk_url')}}">
                            <img  src="{{ URL::asset('webmedia/images/download-android-new.png')}}" alt="android-new" style="width: 200px;">
                        </a>
                        </div>
                    </div>
          </div>
        </div>
      </div>
      <!-- <div>
        
              <input type="text" name="link" style="">
              <span style="float: right;">Get Download Link</span>
      </div> -->
    </section>

    <!--Section: Content-->
    <section class="px-md-5 mx-md-5 text-center dark-grey-text about" id="workflow-section">

        <div class="container-fluid my-5 py-5 z-depth-1">

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col-md-6 mb-4 mb-md-0 heading-section">

          <span class="subheading"> </span>
            <h2 class="mb-4">What we Do?</h2>

          <p class="text-muted">We are here to help you generate income out of your interest by serving you with the best
          fantasy sports opportunity. We help accomplish your dream of playing a digital sport picking
          your favourite players with a live Leadership board to track top winners performances. Along
          with this, we undertake the fan code by serving you the hands-on experience over your
          prediction via fantasy sport.
          </p>

          <hr class="my-5">

          <p class="font-weight-bold">Follow us on:</p>

          <!--Facebook-->
          <a href="#" class="mx-1" role="button"><i class="fa fa-facebook-f"></i></a>
          <a href="#" class="mx-1" role="button"><i class="fa fa-twitter"></i></a>
          <a href="#" class="mx-1" role="button"><i class="fa fa-linkedin"></i></a>
          <a href="#" class="mx-1" role="button"><i class="fa fa-instagram"></i></a>
          <a href="#" class="mx-1" role="button"><i class="fa fa-pinterest"></i></a>
          <a href="#" class="mx-1" role="button"><i class="fa fa-youtube"></i></a>
          <a href="#" class="mx-1" role="button"><i class="fa fa-github"></i></a>
          

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-5 mb-4 mb-md-0">

          <img src="{{url('webmedia/images/app.jpg')}}" class="img-fluid" alt="">

        </div>
        <!--Grid column-->

      </div> 
      </div>


    </section>
    <!--Section: Content-->


       <!-- about works -->

    <section class="ftco-section ftco-services-2" style="background:linear-gradient(to right,#ffffff,#00bade)">
            <div class="container">
                <div class="row">
          <div class="col-md-4 heading-section ftco-animate">
            <span class="subheading">Steps</span>
            <h2 class="mb-4">Our Steps</h2>
           
            <div class="media block-6 services text-center d-block pt-md-5 mt-md-5">
              <div class="icon justify-content-center align-items-center d-flex"><span>1</span></div>
              <div class="media-body p-md-3">
                <h3 class="heading mb-3">Check Out Contest For the League</h3>
                <p class="mb-5">You are allowed to check over the participating teams based on the previous match
listings, and you can also check the entry ticket amount.</p>
                <hr>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex align-self-stretch ftco-animate mt-lg-5">
            <div class="media block-6 services text-center d-block mt-lg-5 pt-md-5 pt-lg-4">
              <div class="icon justify-content-center align-items-center d-flex"><span>2</span></div>
              <div class="media-body p-md-3">
                <h3 class="heading mb-3">Create your Best Team</h3>
                <p class="mb-5"  style="color: #000">{{env('company_name')}} gives you an opportunity to organize the best team, choosing from real-life
players and get paid for your knowledge & expertise by winning the cash rewards.
</p>
                <hr>
              </div>
            </div>      
          </div>
          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services text-center d-block">
              <div class="icon justify-content-center align-items-center d-flex"><span>3</span></div>
              <div class="media-body p-md-3">
                <h3 class="heading mb-3">Pay Small And Win Big</h3>
                <p class="mb-5" style="color: #000">Pay small and win big is the concept of winning a considerable amount by taking part in
the contest with a small token of entry amount. Not just this, but also all the participants
are getting rewarded based on their ranks.</p>
                <hr>
              </div>
            </div>      
          </div>
        </div>
            </div>
            
        </section>  
        <!-- Screenshot -->

        
    
        <section class="service-area " id="howork-section" style="margin-top: 50px">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-tittle text-center heading-section">
                            <span class="subheading">Help with Sports Fight</span>
                            <h2>How Can We Help with</h2>
                        </div>
                    </div>
                </div>
                <!-- Section caption -->
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="services-caption text-center mb-30">
                            <div class="service-icon">
                                <span class="flaticon-businessman"></span>
                            </div> 
                            <div class="service-cap">
                                <h4><a href="#">Easily Manage</a></h4>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="services-caption active text-center mb-30">
                            <div class="service-icon">
                                <span class="flaticon-pay"></span>
                            </div> 
                            <div class="service-cap">
                                <h4><a href="#">Get Payments Easily</a></h4>
                                <p></p>
                            </div>
                        </div>
                    </div> 
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="services-caption text-center mb-30">
                            <div class="service-icon">
                                <span class="flaticon-plane"></span>
                            </div> 
                            <div class="service-cap">
                                <h4><a href="#">Quick Messaging</a></h4>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
    <div class="jumbotron jumbotron-fluid">
          <div class="container center">
            <h1>App Screenshot</h1>
            
          </div>
      </div>
    <section class=" ftco-properties" id="properties-section" style="margin-bottom: 30px">
         
          <div class="applic-apps " style="margin-bottom: 0px !important">
            <div class="container-fluid">
                <div class="row" >
                    <!-- slider Heading -->
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div class="single-cases-info heading-section mb-30">
                            <span class="subheading">Screenshots</span>
                            <h3 style="color: #00bade;">Apps<br> Screenshot</h3>
                            
                        </div>
                    </div>
                    <style type="text/css">
                      .cloned {
                       width: 200px;margin-right: 10px;border: 3px solid #fff;border-radius: 7px; }
                    </style>
                   
                    <div class="col-xl-8 col-lg-8 col-md-col-md-8" style="max-height: 435px">
                        <div class="app-active owl-carousel owl-loaded owl-drag" style="width: 10000px !important"> 
      
                        <div class="owl-stage-outer">

                           
                          <div class="owl-item cloned" style="width: 200px;  margin-right: 10px">
                            <div class="single-cases-img">
                                <img src="{{url('webmedia/images/s1.jpeg')}}" alt="">
                            </div>
                          </div>

                          <div class="owl-item cloned" style="width: 200px; margin-right: 10px">
                            <div class="single-cases-img">
                                <img src="{{url('webmedia/images/s2.jpeg')}}" alt="">
                            </div>
                          </div>

                          <div class="owl-item cloned" style="width: 200px; margin-right: 10px">
                            <div class="single-cases-img">
                                <img src="{{url('webmedia/images/s3.jpeg')}}" alt="">
                            </div>
                          </div>
                          <div class="owl-item cloned" style="width: 200px;  margin-right: 10px">
                            <div class="single-cases-img">
                                <img src="{{url('webmedia/images/s4.jpeg')}}" alt="">
                            </div>
                          </div>
                          
                    </div>
                </div>
            </div> 
    </section>
    <div class="jumbotron jumbotron-fluid" style="margin: 0px">
          <div class="container center">
            <h1>Reach us at {{env('company_email')}} </h1>
            
          </div>
      </div> 
