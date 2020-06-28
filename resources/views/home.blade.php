<!DOCTYPE html>

 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{url('assets/css/tailwind.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('assets/css/swiper.min.css')}}">
    <title>SportsFight</title>

    <style type="text/css">


    @font-face {
       font-family: Tunga;
       src: url(assets/fontTunga/tunga.ttf);
      }


      *{

      font-family: Tunga;
     }
    
    @media only screen and (max-width: 768px) {
    
      .win-slide-1, .win-slide-2, .win-slide-3, .test-slide-1, .test-slide-2, .foot-sllide-1, .foot-sllide-2, .foot-sllide-3{
        display: block !important;
      }

      .pt-24{
        padding: 1rem !important;
      }
      .getitnow{
        display: none;
      }

      .landing-banner{
        background-image: url("assets/image/banner5.jpg") !important;
        } 

      .content-heading{
          margin-left: 0px !important;
      }
      .footermob{
          padding: 0px !important;
          margin: 0px !important;
      }

      .mt-icon{
          margin-top: 12rem !important;
      }

      .how-to-play .pl-40{
           padding: 5px !important;
      }

      .how-to-play section.pt-5{
         padding-top: 0px !important;
      }


      .how-to-play .heading-play{
         justify-content: center !important;
      }

      .how-to-play h1{
         font-size: 1.5rem !important;
         margin-bottom: 1.5rem !important;
         text-align: center !important;
      }

      .how-to-play h2{
         font-size: 0.8rem !important;
      }

      .how-to-play p{
         font-size: 0.8rem !important;
      }

      .how-to-play .pb-12{
         padding-bottom: 1.5rem !important;
      }
      .how-to-play .mb-12{
         margin-bottom: .5rem !important;
      }
      .how-to-play  img{
         width: 70% !important; 
      }

      .get-the-app h1{
         font-size: 2.3rem !important;
      }

      .get-the-app li{
         font-size: 1.3rem !important;
      }

      .get-the-app button{
         padding-left: 0rem !important;
      }

      .app-btn{
      	padding-top: 7rem !important;
      }

      .winners .pt-8{
      	padding-top: 0px !important;
      }

      .winners .flex1, .testimonial .flex1{
         padding-top: 0px !important;
      }

      .winners .flex-col{
        margin-bottom: 0.5rem !important;
      }
      .winner-foot{
      	display: none !important;
      }

      .testimonial h1{
         margin-bottom: .5rem !important;
         padding-top: .5rem !important;
      }

      .testimonial p{
         font-size: .8rem !important;
      }

      .swiper-container-horizontal>.swiper-pagination-bullets, .swiper-pagination-custom, .swiper-pagination-fraction{
         bottom: 13% !important;
      }

      .swiper-button-prev, .swiper-button-next{
         display: none !important;
      }

      .counter{
        display: none !important;
      }
      .rahul-img{
      	background-size: contain !important;
      	background-position: center !important;
      }

      .satish-img{
      	background-size: 300px 300px !important;
      }

      .foot-content{
      	margin-top: 4rem !important;
      }

  }
    

    html, body {
      position: relative;
      height: 100%;
    }

    .swiper-container {
      width: 100%;
      height: 100%;
    }

    .swiper-pagination-bullet{
      margin: 15px 0 !important;
    }


    .swiper-pagination-bullet-active{
      background: #691dc5 !important;
    }

    .win-slide-1, .win-slide-2, .win-slide-3, .test-slide-1, .test-slide-2, .foot-sllide-1, .foot-sllide-2, .foot-sllide-3{
      display: none;
    }

  .landing-banner{
    background-image: url("assets/image/banner4a.jpg");
    background-position: initial;
    background-repeat: no-repeat;
    background-size: cover;
  } 

  .testimonial-background{
    background-image: url("assets/image/test-banner.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  } 



  .btndownload1{
    background: #8560a8 !important;
  }

  .swiper-button-next{
    right: 8rem !important;
  }

  .swiper-button-prev{
    left: 8rem;
  }

  .swiper-button-next, .swiper-button-prev{
    color: #fff !important;
  }

  .bg-insta{
    background: linear-gradient(#833ab4,#fd1d1d,#fcb045);
  }

  .mt-icon{
    margin-top: 22rem;
  }



</style>
</head>

<body>

     <nav class="flex items-center justify-between flex-wrap bg-transparent px-4 pt-1">
          <div class="flex items-center flex-shrink-0  mr-6">
              <img class="fill-current h-8 w-8 mr-2" width="54" height="54" src="assets/image/Icon_Launcher72px.png">
              <img class="h-20 w-24" src="assets/image/logo-sportsfight.png" >
          </div>
          
          <div class="block">
              <button class="flex btndownload1 uppercase text-sm items-center rounded px-4 py-1 border text-white hover:text-teal-400 hover:border-teal-400">
                  <svg class="fill-current w-4 h-8 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                  <a href="https://sportsfight.in/apk" >Download App</a>
              </button>
          </div>
    </nav>


    <div class="swiper-container swiper-container-v">
        <div class="swiper-wrapper">
          <div class="swiper-slide landing-banner">
          	
          
            <section >
               <div class="container mx-auto flex px-5 py-1 md:flex-row flex-col">
                   <div class="lg:flex-grow md:w-1/2 md:pr-16 flex flex-col md:items-start mb-16 md:mb-0 text-center front-content" style="align-items: center;">
                        <h1 class="font-black title-font text-5xl mb-4 text-dark-900">SportsFight Fantasy League</h1>
      <!-- <p class="mb-4 leading-relaxed text-dark" >Easy to join Contest and Make a big money</p>-->
                        <div class="flex lg:flex-row md:flex-col content-heading  -mt-6 -ml-20">
                          <a href="http://sportsfight.in/apk">
                            <button class="flex uppercase btndownload1 text-sm items-center rounded px-4 py-1 border text-white hover:text-teal-400 hover:border-teal-400">
                                <svg class="fill-current w-4 h-8 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                <span>Download App</span>
                            </button>
                          </a>
                        </div>
                        <div class="flex lg:flex-row md:flex-col content-heading  mt-icon -ml-20">
                            <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
                                <a class="icons border rounded-full text-white bg-blue-800 px-2 py-2" href="https://www.facebook.com/sportsfight.in">
                                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
                                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                    </svg>
                                </a>
                                <a class="icons ml-8 border rounded-full text-white bg-blue-600 px-2 py-2 " href="#">
                                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
                                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                    </svg>
                                </a>
                                <a class="icons ml-8 border rounded-full text-white bg-insta px-2 py-2" href="https://www.instagram.com/sportsfight.in">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
                                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                                    </svg>
                                </a>
                              </span>
                          </div>
                    </div>
                </div>
          </section>
     
        </div>
       
        <div class="swiper-slide how-to-play"  style="background: linear-gradient(#daceff,#d4b5df);">
                
                <!-- How to play sections -->
            <section class="text-gray-700 body-font pt-5">
                <div class="container pl-40 mx-auto flex flex-wrap heading-play">
                    <h1 class="capitalize text-5xl font-black leading-tight text-black mb-2 underline">how to play</h1>
                        <div class="flex flex-wrap w-full">
                            <div class="lg:w-2/5 md:w-1/2 md:pr-10 md:py-6">
                                <div class="flex relative pb-12">
                                    <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                        <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                    </div>
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative z-10">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-grow pl-4">
                                        <h2 class="font-black title-font text-xl text-black mb-1">CREATE YOUR TEAM</h2>
                                        <p class="leading-relaxed text-lg text-black">Use your skill to create a fantasy team.</p>
                                    </div>
                                </div>
                                <div class="flex relative pb-12">
                                    <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                        <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                    </div>
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative z-10">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                            <circle cx="12" cy="5" r="3"></circle>
                                            <path d="M12 22V8M5 12H2a10 10 0 0020 0h-3"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-grow pl-4">
                                        <h2 class="font-black title-font text-xl text-black mb-1">CHOOSE YOUR CONTEST</h2>
                                        <p class="leading-relaxed text-lg text-black">Join free & cash contest.</p>
                                    </div>
                                  </div>
                                  <div class="flex relative">
                                      <div class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative z-10">
                                          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                              <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                              <path d="M22 4L12 14.01l-3-3"></path>
                                          </svg>
                                      </div>
                                      <div class="flex-grow pl-4">
                                           <h2 class="font-black title-font text-xl text-black mb-1">WATCH YOURSELF WINNING</h2>
                                           <p class="leading-relaxed text-lg text-black mb-12">It’s now time to get ready with your players & earn exciting winnings!</p>
                                      </div>
                                  </div>
                            </div>
      
                            <img src="{{url('assets/image/app_home.jpeg')}}" width="50%">
                        </div>
                </div>
          </section>
      </div>

      <!----------------------------winner section------------------>

      <div class="swiper-slide winners" style="background: linear-gradient(#000046,#1CB5E0);">
           <div class="swiper-container swiper-container-h">
                 <div class="flex flex-col text-center w-full mb-1">
                     <h1 class="text-5xl font-bold pt-8 text-white">TOP WINNERS</h1>
                     
                  </div>
                  <div class="swiper-wrapper">
                      <div class="swiper-slide">
                           <div class="block h-full w-full text-dark text-center">
                                <div class="flex con flex-wrap pt-12 flex1 justify-center">
                                     <div class="max-w-md w-full lg:flex">
                                         <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('assets/image/anand.jpeg'); background-position: center;" >
                                         </div>
  										 <div class="border-r border-b border-l border-grey-light lg:border-l-0 lg:border-t lg:border-grey-light bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
    										    <div class="mb-8">
     	 											<p class="text-sm text-grey-dark flex items-center">
        												 <svg class="text-grey w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
          													 <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
        												 </svg>
        												Winnings:
      											    </p>
      												<div class="flex items-center px-6 py-3 bg-gray-900">
       													 <svg class="h-6 w-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
       													 	 <path d="M10 .4C4.697.4.399 4.698.399 10A9.6 9.6 0 0 0 10 19.601c5.301 0 9.6-4.298 9.6-9.601 0-5.302-4.299-9.6-9.6-9.6zm-.001 17.2a7.6 7.6 0 1 1 0-15.2 7.6 7.6 0 1 1 0 15.2zM11 9.33V4H9v6.245l-3.546 2.048 1 1.732 4.115-2.377A.955.955 0 0 0 11 10.9v-.168l4.24-4.166a6.584 6.584 0 0 0-.647-.766L11 9.33z"/>
       													</svg>
 	 											        <h1 class="mx-3  text-white font-semibold text-lg">MI VS KKR</h1>
        										    </div>
        					                        <div class="py-4 px-6">
            											 <h1 class="text-xl font-semibold text-gray-800">Anand Soni</h1>
            										     <p class="py-2 text-lg text-gray-700">Location: Sidhwalia, Bihar</p>
            											 <div class="winner-foot">
            											 <div class="flex items-center mt-4 text-gray-700">
               									             <svg class="h-6 w-6 fill-current" viewBox="0 0 512 512">
                    									           <path d="M239.208 343.937c-17.78 10.103-38.342 15.876-60.255 15.876-21.909 0-42.467-5.771-60.246-15.87C71.544 358.331 42.643 406 32 448h293.912c-10.639-42-39.537-89.683-86.704-104.063zM178.953 120.035c-58.479 0-105.886 47.394-105.886 105.858 0 58.464 47.407 105.857 105.886 105.857s105.886-47.394 105.886-105.857c0-58.464-47.408-105.858-105.886-105.858zm0 186.488c-33.671 0-62.445-22.513-73.997-50.523H252.95c-11.554 28.011-40.326 50.523-73.997 50.523z"/><g><path d="M322.602 384H480c-10.638-42-39.537-81.691-86.703-96.072-17.781 10.104-38.343 15.873-60.256 15.873-14.823 0-29.024-2.654-42.168-7.49-7.445 12.47-16.927 25.592-27.974 34.906C289.245 341.354 309.146 364 322.602 384zM306.545 200h100.493c-11.554 28-40.327 50.293-73.997 50.293-8.875 0-17.404-1.692-25.375-4.51a128.411 128.411 0 0 1-6.52 25.118c10.066 3.174 20.779 4.862 31.895 4.862 58.479 0 105.886-47.41 105.886-105.872 0-58.465-47.407-105.866-105.886-105.866-37.49 0-70.427 19.703-89.243 49.09C275.607 131.383 298.961 163 306.545 200z"/></g>
                									         </svg>
                									         <h1 class="px-2 text-sm">Team Name:</h1>
            											</div>
            											<div class="flex items-center mt-4 text-gray-700">
                										     <svg class="h-6 w-6 fill-current" viewBox="0 0 512 512">
                                                                 <path d="M256 32c-88.004 0-160 70.557-160 156.801C96 306.4 256 480 256 480s160-173.6 160-291.199C416 102.557 344.004 32 256 32zm0 212.801c-31.996 0-57.144-24.645-57.144-56 0-31.357 25.147-56 57.144-56s57.144 24.643 57.144 56c0 31.355-25.148 56-57.144 56z"/>
                										     </svg>
                                                             <h1 class="px-2 text-sm">Playing Since:</h1>
            										    </div>
            										</div>
            										</div>
    										     </div>
    										</div>
										</div> 
                                </div>
                            </div>
                        </div>
                       <!--<div class="lg:w-1/3 sm:w-1/2 p-4">
                                         <div class="flex relative">
                                             <img alt="gallery" class="absolute inset-0 w-full h-full object-cover object-center" src="{{url('assets/image/anand.jpeg')}}">
                                             <div class="px-10 py-20 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
                                                 <h2 class="tracking-widest text-3xl title-font font-black text-red-500 mb-1">Anand Soni</h2>
                                                 <h1 class="title-font text-lg font-medium text-gray-900 mb-3">Age: 24</h1>
                                                 <p class="leading-relaxed text-lg ">Location - Sidhwalia, Gopalganj, Bihar</p>
                                             </div>
                                          </div>-->
                      
                        <div class="swiper-slide">
                           <div class="block h-full w-full text-dark text-center">
                                <div class="flex con flex-wrap pt-12 flex1 justify-center">
                                     <div class="max-w-md w-full lg:flex">
                                         <div class="h-48 lg:h-auto lg:w-48 flex-none bg-no-repeat bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('assets/image/yadav.jpeg'); background-position: center;" >
                                         </div>
  										 <div class="border-r border-b border-l border-grey-light lg:border-l-0 lg:border-t lg:border-grey-light bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
    										    <div class="mb-8">
     	 											<p class="text-sm text-grey-dark flex items-center">
        												 <svg class="text-grey w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
          													 <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
        												 </svg>
        												 Winnings:
      											    </p>
      												<div class="flex items-center px-6 py-3 bg-gray-900">
       													 <svg class="h-6 w-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
       													 	 <path d="M10 .4C4.697.4.399 4.698.399 10A9.6 9.6 0 0 0 10 19.601c5.301 0 9.6-4.298 9.6-9.601 0-5.302-4.299-9.6-9.6-9.6zm-.001 17.2a7.6 7.6 0 1 1 0-15.2 7.6 7.6 0 1 1 0 15.2zM11 9.33V4H9v6.245l-3.546 2.048 1 1.732 4.115-2.377A.955.955 0 0 0 11 10.9v-.168l4.24-4.166a6.584 6.584 0 0 0-.647-.766L11 9.33z"/>
       													</svg>
 	 											        <h1 class="mx-3  text-white font-semibold text-lg">MI VS KKR</h1>
        										    </div>
        					                        <div class="py-4 px-6">
            											 <h1 class="text-xl font-semibold text-gray-800">Ram Pravesh Yadav</h1>
            										     <p class="py-2 text-lg text-gray-700">Location: Sanand, Gujrat</p>
            											<div class="winner-foot">
            											 <div class="flex items-center mt-4 text-gray-700">
               									             <svg class="h-6 w-6 fill-current" viewBox="0 0 512 512">
                    									           <path d="M239.208 343.937c-17.78 10.103-38.342 15.876-60.255 15.876-21.909 0-42.467-5.771-60.246-15.87C71.544 358.331 42.643 406 32 448h293.912c-10.639-42-39.537-89.683-86.704-104.063zM178.953 120.035c-58.479 0-105.886 47.394-105.886 105.858 0 58.464 47.407 105.857 105.886 105.857s105.886-47.394 105.886-105.857c0-58.464-47.408-105.858-105.886-105.858zm0 186.488c-33.671 0-62.445-22.513-73.997-50.523H252.95c-11.554 28.011-40.326 50.523-73.997 50.523z"/><g><path d="M322.602 384H480c-10.638-42-39.537-81.691-86.703-96.072-17.781 10.104-38.343 15.873-60.256 15.873-14.823 0-29.024-2.654-42.168-7.49-7.445 12.47-16.927 25.592-27.974 34.906C289.245 341.354 309.146 364 322.602 384zM306.545 200h100.493c-11.554 28-40.327 50.293-73.997 50.293-8.875 0-17.404-1.692-25.375-4.51a128.411 128.411 0 0 1-6.52 25.118c10.066 3.174 20.779 4.862 31.895 4.862 58.479 0 105.886-47.41 105.886-105.872 0-58.465-47.407-105.866-105.886-105.866-37.49 0-70.427 19.703-89.243 49.09C275.607 131.383 298.961 163 306.545 200z"/></g>
                									         </svg>
                									         <h1 class="px-2 text-sm">Team Name:</h1>
            											</div>
            											<div class="flex items-center mt-4 text-gray-700">
                										     <svg class="h-6 w-6 fill-current" viewBox="0 0 512 512">
                                                                 <path d="M256 32c-88.004 0-160 70.557-160 156.801C96 306.4 256 480 256 480s160-173.6 160-291.199C416 102.557 344.004 32 256 32zm0 212.801c-31.996 0-57.144-24.645-57.144-56 0-31.357 25.147-56 57.144-56s57.144 24.643 57.144 56c0 31.355-25.148 56-57.144 56z"/>
                										     </svg>
                                                             <h1 class="px-2 text-sm">Playing Since:</h1>
            										    </div>
            										</div>
            										</div>
    										     </div>
    										</div>
										</div> 
                                </div>
                            </div>
                        </div>
                      
                      <div class="swiper-slide">
                           <div class="block h-full w-full text-dark text-center">
                                <div class="flex con flex-wrap pt-12 flex1 justify-center">
                                     <div class="max-w-md w-full lg:flex">
                                         <div class="h-48 satish-img lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('assets/image/satish.jpeg'); background-position: center;" >
                                         </div>
  										 <div class="border-r border-b border-l border-grey-light lg:border-l-0 lg:border-t lg:border-grey-light bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
    										    <div class="mb-8">
     	 											<p class="text-sm text-grey-dark flex items-center">
        												 <svg class="text-grey w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
          													 <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
        												 </svg>
        												 Winnings
      											    </p>
      												<div class="flex items-center px-6 py-3 bg-gray-900">
       													 <svg class="h-6 w-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
       													 	 <path d="M10 .4C4.697.4.399 4.698.399 10A9.6 9.6 0 0 0 10 19.601c5.301 0 9.6-4.298 9.6-9.601 0-5.302-4.299-9.6-9.6-9.6zm-.001 17.2a7.6 7.6 0 1 1 0-15.2 7.6 7.6 0 1 1 0 15.2zM11 9.33V4H9v6.245l-3.546 2.048 1 1.732 4.115-2.377A.955.955 0 0 0 11 10.9v-.168l4.24-4.166a6.584 6.584 0 0 0-.647-.766L11 9.33z"/>
       													</svg>
 	 											        <h1 class="mx-3  text-white font-semibold text-lg">MI VS KKR</h1>
        										    </div>
        					                        <div class="py-4 px-6">
            											 <h1 class="text-xl font-semibold text-gray-800">Satish Rai</h1>
            										     <p class="py-2 text-lg text-gray-700">Location: Surat, Gujrat</p>
            										     <div class="winner-foot">            
            											 <div class="flex items-center mt-4 text-gray-700">
               									             <svg class="h-6 w-6 fill-current" viewBox="0 0 512 512">
                    									           <path d="M239.208 343.937c-17.78 10.103-38.342 15.876-60.255 15.876-21.909 0-42.467-5.771-60.246-15.87C71.544 358.331 42.643 406 32 448h293.912c-10.639-42-39.537-89.683-86.704-104.063zM178.953 120.035c-58.479 0-105.886 47.394-105.886 105.858 0 58.464 47.407 105.857 105.886 105.857s105.886-47.394 105.886-105.857c0-58.464-47.408-105.858-105.886-105.858zm0 186.488c-33.671 0-62.445-22.513-73.997-50.523H252.95c-11.554 28.011-40.326 50.523-73.997 50.523z"/><g><path d="M322.602 384H480c-10.638-42-39.537-81.691-86.703-96.072-17.781 10.104-38.343 15.873-60.256 15.873-14.823 0-29.024-2.654-42.168-7.49-7.445 12.47-16.927 25.592-27.974 34.906C289.245 341.354 309.146 364 322.602 384zM306.545 200h100.493c-11.554 28-40.327 50.293-73.997 50.293-8.875 0-17.404-1.692-25.375-4.51a128.411 128.411 0 0 1-6.52 25.118c10.066 3.174 20.779 4.862 31.895 4.862 58.479 0 105.886-47.41 105.886-105.872 0-58.465-47.407-105.866-105.886-105.866-37.49 0-70.427 19.703-89.243 49.09C275.607 131.383 298.961 163 306.545 200z"/></g>
                									         </svg>
                									         <h1 class="px-2 text-sm">Team Name:</h1>
            											</div>
            											<div class="flex items-center mt-4 text-gray-700">
                										     <svg class="h-6 w-6 fill-current" viewBox="0 0 512 512">
                                                                 <path d="M256 32c-88.004 0-160 70.557-160 156.801C96 306.4 256 480 256 480s160-173.6 160-291.199C416 102.557 344.004 32 256 32zm0 212.801c-31.996 0-57.144-24.645-57.144-56 0-31.357 25.147-56 57.144-56s57.144 24.643 57.144 56c0 31.355-25.148 56-57.144 56z"/>
                										     </svg>
                                                             <h1 class="px-2 text-sm">Playing Since:</h1>
            										    </div>
            										</div>
            										</div>
    										     </div>
    										</div>
										</div> 
                                </div>
                            </div>
                        </div>
                    
                    <div class="swiper-slide">
                           <div class="block h-full w-full text-dark text-center">
                                <div class="flex con flex-wrap pt-12 flex1 justify-center">
                                     <div class="max-w-md w-full lg:flex">
                                         <div class="h-48 rahul-img lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('assets/image/rahul.jpeg'); background-position: right; " >
                                         </div>
  										 <div class="border-r border-b border-l border-grey-light lg:border-l-0 lg:border-t lg:border-grey-light bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
    										    <div class="mb-8">
     	 											<p class="text-sm text-grey-dark flex items-center">
        												 <svg class="text-grey w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
          													 <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
        												 </svg>
        												 Winnings:
      											    </p>
      												<div class="flex items-center px-6 py-3 bg-gray-900">
       													 <svg class="h-6 w-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
       													 	 <path d="M10 .4C4.697.4.399 4.698.399 10A9.6 9.6 0 0 0 10 19.601c5.301 0 9.6-4.298 9.6-9.601 0-5.302-4.299-9.6-9.6-9.6zm-.001 17.2a7.6 7.6 0 1 1 0-15.2 7.6 7.6 0 1 1 0 15.2zM11 9.33V4H9v6.245l-3.546 2.048 1 1.732 4.115-2.377A.955.955 0 0 0 11 10.9v-.168l4.24-4.166a6.584 6.584 0 0 0-.647-.766L11 9.33z"/>
       													</svg>
 	 											        <h1 class="mx-3  text-white font-semibold text-lg">MI VS KKR</h1>
        										    </div>
        					                        <div class="py-4 px-6">
            											 <h1 class="text-xl font-semibold text-gray-800">Rahul Kharwar</h1>
            										     <p class="py-2 text-lg text-gray-700">Location: Sidhwalia, Bihar</p>
            										     <div class="winner-foot">            
            											 <div class="flex items-center mt-4 text-gray-700">
               									             <svg class="h-6 w-6 fill-current" viewBox="0 0 512 512">
                    									           <path d="M239.208 343.937c-17.78 10.103-38.342 15.876-60.255 15.876-21.909 0-42.467-5.771-60.246-15.87C71.544 358.331 42.643 406 32 448h293.912c-10.639-42-39.537-89.683-86.704-104.063zM178.953 120.035c-58.479 0-105.886 47.394-105.886 105.858 0 58.464 47.407 105.857 105.886 105.857s105.886-47.394 105.886-105.857c0-58.464-47.408-105.858-105.886-105.858zm0 186.488c-33.671 0-62.445-22.513-73.997-50.523H252.95c-11.554 28.011-40.326 50.523-73.997 50.523z"/><g><path d="M322.602 384H480c-10.638-42-39.537-81.691-86.703-96.072-17.781 10.104-38.343 15.873-60.256 15.873-14.823 0-29.024-2.654-42.168-7.49-7.445 12.47-16.927 25.592-27.974 34.906C289.245 341.354 309.146 364 322.602 384zM306.545 200h100.493c-11.554 28-40.327 50.293-73.997 50.293-8.875 0-17.404-1.692-25.375-4.51a128.411 128.411 0 0 1-6.52 25.118c10.066 3.174 20.779 4.862 31.895 4.862 58.479 0 105.886-47.41 105.886-105.872 0-58.465-47.407-105.866-105.886-105.866-37.49 0-70.427 19.703-89.243 49.09C275.607 131.383 298.961 163 306.545 200z"/></g>
                									         </svg>
                									         <h1 class="px-2 text-sm">Team Name:</h1>
            											</div>
            											<div class="flex items-center mt-4 text-gray-700">
                										     <svg class="h-6 w-6 fill-current" viewBox="0 0 512 512">
                                                                 <path d="M256 32c-88.004 0-160 70.557-160 156.801C96 306.4 256 480 256 480s160-173.6 160-291.199C416 102.557 344.004 32 256 32zm0 212.801c-31.996 0-57.144-24.645-57.144-56 0-31.357 25.147-56 57.144-56s57.144 24.643 57.144 56c0 31.355-25.148 56-57.144 56z"/>
                										     </svg>
                                                             <h1 class="px-2 text-sm">Playing Since:</h1>
            										    </div>
            										</div>
            										</div>
    										     </div>
    										</div>
										</div> 
                                </div>
                            </div>
                    </div>
            </div>
            <div class="swiper-pagination swiper-pagination-h"></div>
        </div>
        <div class="swiper-button-next font-black"></div>
        <div class="swiper-button-prev font-black"></div>
    </div>

      <!-------------------------get the app section---------------------->
      
      <div class="swiper-slide get-the-app" style="background: linear-gradient(#daceff,#d4b5df);">
           <section class="text-gray-700 body-font" >
                <div class="container mx-auto flex px-5 md:flex-row flex-col items-center">
                   <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                      <h1 class="title-font text-4xl mb-4 font-bold text-black">Get the app for these exclusive features</h1>
                      <p class="mb-8 leading-relaxed">
                          <li>You Practice We Pay</li>
                          <li>Invite your friends & get Rs.100 cash bonus per friend</li>
                          <li>Maximum chances of winning prizes</li>
                      </p>
    
                      <div class="flex lg:flex-row md:flex-col app-btn pt-16">
                          <button class="bg-gray-200 inline-flex py-3 px-5 rounded-lg items-center hover:bg-gray-300 focus:outline-none">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 512 512">
                                  <path d="M99.617 8.057a50.191 50.191 0 00-38.815-6.713l230.932 230.933 74.846-74.846L99.617 8.057zM32.139 20.116c-6.441 8.563-10.148 19.077-10.148 30.199v411.358c0 11.123 3.708 21.636 10.148 30.199l235.877-235.877L32.139 20.116zM464.261 212.087l-67.266-37.637-81.544 81.544 81.548 81.548 67.273-37.64c16.117-9.03 25.738-25.442 25.738-43.908s-9.621-34.877-25.749-43.907zM291.733 279.711L60.815 510.629c3.786.891 7.639 1.371 11.492 1.371a50.275 50.275 0 0027.31-8.07l266.965-149.372-74.849-74.847z"></path>
                              </svg>
                              <span class="ml-4 flex items-start flex-col leading-none">
                                  <span class="text-xs text-gray-600 mb-1">GET IT ON</span>
                                  <span class="title-font font-medium">Google Play</span>
                              </span>
                          </button>
                          <button class="bg-gray-200 inline-flex py-3 px-5 rounded-lg items-center lg:ml-4 md:ml-0 ml-4 md:mt-4 mt-0 lg:mt-0 hover:bg-gray-300 focus:outline-none">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 305 305">
                                  <path d="M40.74 112.12c-25.79 44.74-9.4 112.65 19.12 153.82C74.09 286.52 88.5 305 108.24 305c.37 0 .74 0 1.13-.02 9.27-.37 15.97-3.23 22.45-5.99 7.27-3.1 14.8-6.3 26.6-6.3 11.22 0 18.39 3.1 25.31 6.1 6.83 2.95 13.87 6 24.26 5.81 22.23-.41 35.88-20.35 47.92-37.94a168.18 168.18 0 0021-43l.09-.28a2.5 2.5 0 00-1.33-3.06l-.18-.08c-3.92-1.6-38.26-16.84-38.62-58.36-.34-33.74 25.76-51.6 31-54.84l.24-.15a2.5 2.5 0 00.7-3.51c-18-26.37-45.62-30.34-56.73-30.82a50.04 50.04 0 00-4.95-.24c-13.06 0-25.56 4.93-35.61 8.9-6.94 2.73-12.93 5.09-17.06 5.09-4.64 0-10.67-2.4-17.65-5.16-9.33-3.7-19.9-7.9-31.1-7.9l-.79.01c-26.03.38-50.62 15.27-64.18 38.86z"></path>
                                  <path d="M212.1 0c-15.76.64-34.67 10.35-45.97 23.58-9.6 11.13-19 29.68-16.52 48.38a2.5 2.5 0 002.29 2.17c1.06.08 2.15.12 3.23.12 15.41 0 32.04-8.52 43.4-22.25 11.94-14.5 17.99-33.1 16.16-49.77A2.52 2.52 0 00212.1 0z"></path>
                               </svg>
                               <span class="ml-4 flex items-start flex-col leading-none">
                                    <span class="text-xs text-gray-600 mb-1">Download on the</span>
                                    <span class="title-font font-medium">App Store</span>
                               </span>
                          </button>
                      </div>
                    </div>

    
                    <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 getitnow">
                        <div class="flex flex-wrap m-12">
                            <div class="p-4 md:w-1/2 w-full">
                                <div class="h-full bg-gray-200 p-1 rounded">
                                    <img alt="testimonial" src="assets/image/play_steps/step1.jpeg"/>
                                </div>
                            </div>
                            <div class="p-4 md:w-1/2 w-full">
                                <div class="h-full bg-gray-200 p-1 rounded">
                                    <img alt="testimonial" src="assets/image/play_steps/step2.jpeg"/>
                                </div>
                            </div>
                            <div class="p-4 md:w-1/2 w-full">
                                <div class="h-full bg-gray-200 p-1 rounded">
                                    <img alt="testimonial" src="assets/image/play_steps/step3.jpeg"/>
                                </div>
                            </div>
                            <div class="p-4 md:w-1/2 w-full">
                                <div class="h-full bg-gray-200 p-1 rounded">
                                    <img alt="testimonial" src="assets/image/play_steps/step4.jpeg"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </section>
      </div>

    <!----     testimonials------------->

      <div class="swiper-slide testimonial testimonial-background ">
          <div class="swiper-container swiper-container-h">
              <h1 class="text-5xl font-bold title-font text-white mb-12 text-center pt-8">Testimonials</h1> 
                 <div class="swiper-wrapper">
                    <div class="swiper-slide" >
                       <div class="block h-full w-full text-dark text-center">
                           <div class="flex con flex-wrap pt-8 flex1 justify-center"> 
                               <div class="p-4 md:w-1/2 w-full bg-red-500 ">
                                    <div class="h-full bg-gray-200 p-8 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="block w-5 h-5 text-gray-400 mb-4" viewBox="0 0 975.036 975.036">
                                            <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
                                        </svg>
                                        <p class="leading-relaxed mb-6">It has been quite a good experience playing on SportsFight. It has been a great experience playing on SportsFight for over 2 Month now. The overall experience has been very good. Whenever I had any queries, the Customer Care team has been very helpful.</p>
                                        <a class="inline-flex items-center">
                                        <img alt="testimonial" src="assets/image/users/manoj-1.jpeg" class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                                            <span class="flex-grow flex flex-col pl-4">
                                                <span class="title-font font-medium text-gray-900">Manoj Prasad</span>
                                                <span class="text-gray-500 text-sm">Mumbai</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                      </div>
                  </div>

                  <div class="swiper-slide">
                       <div class="block h-full w-full text-dark text-center">
                          <div class="flex flex-wrap pt-8 flex1 justify-center"> 
                              <div class="p-4 md:w-1/2 w-full bg-blue-800">
                                  <div class="h-full bg-gray-200 p-8 rounded">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="block w-5 h-5 text-gray-400 mb-4" viewBox="0 0 975.036 975.036">
                                          <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
                                      </svg>
                                      <p class="leading-relaxed mb-6">It has been quite a good experience playing on SportsFight. It has been a great experience playing on SportsFight for over 2 Month now. The overall experience has been very good. Whenever I had any queries, the Customer Care team has been very helpful.</p>
                                      <a class="inline-flex items-center">
                                          <img alt="testimonial" src="assets/image/users/rampravesh.jfif" class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                                          <span class="flex-grow flex flex-col pl-4">
                                                <span class="title-font font-medium text-gray-900">Ram Pravesh</span>
                                                <span class="text-gray-500 text-sm">Ahmedabad</span>
                                          </span>
                                      </a>
                                  </div>
                              </div>
                          </div>
                       </div>
                  </div>
                  
                  <div class="swiper-slide">
                     <div class="block h-full w-full text-dark text-center">
                         <div class="flex flex-wrap pt-8 flex1 justify-center "> 
                             <div class="p-4 md:w-1/2 w-full bg-orange-400">
                                 <div class="h-full bg-gray-200 p-8 rounded">
                                     <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="block w-5 h-5 text-gray-400 mb-4" viewBox="0 0 975.036 975.036">
                                          <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
                                     </svg>
                                     <p class="leading-relaxed mb-6">It has been quite a good experience playing on SportsFight. It has been a great experience playing on SportsFight for over 2 Month now. The overall experience has been very good. Whenever I had any queries, the Customer Care team has been very helpful.</p>
                                    <a class="inline-flex items-center">
                                        <img alt="testimonial" src="assets/image/users/kundan.jfif" class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                                        <span class="flex-grow flex flex-col pl-4">
                                          <span class="title-font font-medium text-gray-900">Kundan Roy</span>
                                          <span class="text-gray-500 text-sm">Pune(Maharashtra)</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
          <div class="swiper-pagination swiper-pagination-h"></div>
      </div>
      <div class="swiper-button-next font-black"></div>
      <div class="swiper-button-prev font-black"></div>
  </div>

    <!----    counter  + footer ----->

  <div class="swiper-slide">
      <section class="text-gray-700 body-font counter">
          <div class="container px-5 py-5 mx-auto">
              <div class="flex flex-wrap -m-4 text-center">
                  <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                      <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="text-red-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                              <path d="M8 17l4 4 4-4m-4-5v9"></path>
                              <path d="M20.88 18.09A5 5 0 0018 9h-1.26A8 8 0 103 16.29"></path>
                          </svg>
                          <h2 class="title-font font-medium text-3xl text-gray-900">2.7K</h2>
                          <p class="leading-relaxed">Downloads</p>
                      </div>
                  </div>
                  <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                      <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="text-red-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                              <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                              <circle cx="9" cy="7" r="4"></circle>
                              <path d="M23 21v-2a4 4 0 00-3-3.87m-4-12a4 4 0 010 7.75"></path>
                          </svg>
                          <h2 class="title-font font-medium text-3xl text-gray-900">1.3K</h2>
                          <p class="leading-relaxed">Users</p>
                      </div>
                  </div>
                  <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                      <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="text-red-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                            <path d="M3 18v-6a9 9 0 0118 0v6"></path>
                            <path d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z"></path>
                          </svg>
                          <h2 class="title-font font-medium text-3xl text-gray-900">74</h2>
                          <p class="leading-relaxed">Files</p>
                      </div>
                  </div>
                  <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                      <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                           <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="text-red-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
                               <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>
                            <h2 class="title-font font-medium text-3xl text-gray-900">46</h2>
                            <p class="leading-relaxed">Places</p>
                      </div>
                  </div>
              </div>
           </div>
    </section>

    <footer class="text-gray-700 body-font bg-gray-100">
        <div class="container px-5 py-24 footermob mx-auto flex md:items-center lg:items-start md:flex-row md:flex-no-wrap flex-wrap flex-col">
            <div class="w-64 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left">
                <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
                    <div class="flex items-center flex-shrink-0  mr-6">
                        <img class="fill-current h-8 w-8 mr-2" width="54" height="54" src="assets/image/Icon_Launcher72px.png">
                        <img class="h-20 w-24" src="assets/image/logo-sportsfight.png" >

                    </div>
                </a>
                <p class="mt-2 foot-content text-sm text-gray-500">An Online skills gaming organizer</p>
            </div>
            <div class="flex-grow flex flex-no-wrap md:pl-20 -mb-10 md:mt-0 mt-10 margin-footer md:text-left text-center">
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <nav class="list-none mb-10">
                         <li>
                           <a class="text-gray-600 hover:text-gray-800">Download App</a>
                         </li>
                          <li>
                           <a class="text-gray-600 hover:text-gray-800">How to Play</a>
                         </li>
                         <li>
                            <a class="text-gray-600 hover:text-gray-800">Invite Friends</a>
                         </li>
                         <li>
                            <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
                         </li>
                    </nav>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <nav class="list-none mb-10">
                        <li>
                              <a class="text-gray-600 hover:text-gray-800">About us</a>
                        </li>
                        <li>
                              <a class="text-gray-600 hover:text-gray-800">Contact us</a>
                        </li>
                    </nav>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="font-black text-sm mb-3">CATEGORIES</h2>
                        <nav class="list-none mb-10">
                           <li>
                             <a class="text-gray-600 hover:text-gray-800">Legality</a>
                           </li>
                           <li>
                             <a class="text-gray-600 hover:text-gray-800">Terms and Conditions</a>
                           </li>
                           <li>
                              <a class="text-gray-600 hover:text-gray-800">Privacy Policies</a>
                           </li>
                        </nav>
                </div>
    
            </div>
       </div>
       <div class="bg-gray-100">
            <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
                <p class="text-gray-500 text-sm text-center sm:text-left">© 2020 SportsFight —
                    <a href="#" rel="noopener noreferrer" class="text-gray-600 ml-1" target="_blank">© woodiewin.com</a>
                </p>
                <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
                    <a class="text-gray-500" href="https://www.facebook.com/sportsfight.in">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                        </svg>
                    </a>
                    <a class="ml-3 text-gray-500" href="#">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                             <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                        </svg>
                    </a>
                    <a class="ml-3 text-gray-500" href="https://www.instagram.com/sportsfight.in">
                          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                              <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                              <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                          </svg>
                    </a>
                </span>
            </div>
        </div>
    </footer>
  </div>
</div>
    <!-- Add Pagination -->
<div class="swiper-pagination swiper-pagination-v"></div>
</div>


<script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
<script>
    var swiperH = new Swiper('.swiper-container-h', {
       spaceBetween: 50,
       loop: true,

       pagination: {
         el: '.swiper-pagination-h',
         clickable: true,
       },
       navigation: {
         nextEl: '.swiper-button-next',
         prevEl: '.swiper-button-prev',
       },
    });
    var swiperV = new Swiper('.swiper-container-v', {
        direction: 'vertical',
        spaceBetween: 50,
        mousewheel: true,
        pagination: {
          el: '.swiper-pagination-v',
          clickable: true,
        },
    });
</script>

</body>
</html>