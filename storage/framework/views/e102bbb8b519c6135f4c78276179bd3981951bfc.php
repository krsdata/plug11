<footer class="ftco-footer">
          <div class="footer-top">
            <div class="container">
              <div class="row">
                <div class="col-md-3 footer-about wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                  <h3 style="border-bottom: 2px solid #fff;">About us</h3>
                  <span style="width: 200px;display: block;border-bottom: 2px solid #fff;margin-top: -4px;"></span>
                  <p class="mt-20">
                    We drive one of the biggest virtual yet fancy sports platform. Also, we help you set-up your
fan base by keeping a watch over shared posts in the feed. <a href="<?php echo e(url('about-us')); ?>" class="btn"> Read More...</a>
                  </p>  
                      </div>
                <div class="col-md-4 offset-md-1 footer-contact wow fadeInDown animated footpara " style="visibility: visible; animation-name: fadeInDown;">
                  <h3 style="border-bottom: 2px solid #fff;">Contact</h3>
                  <span style="width: 98px;display: block;border-bottom: 2px solid #fff;margin-top: -4px;"></span>
                      <p><i class="fa fa-map-marker"></i> Address: Mumbai, Maharastra </p>
                      <p><i class="fa fa-envelope"></i> Email: <a href="mailto:sportsfight@domain.com">info@sportsfight.in</a></p>
                      <p><i class="fa fa-skype"></i> Skype: info@sportsfight.in</p>
                      </div>
                      <div class="col-md-4 footer-links wow fadeInUp animated footpara" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="row">
                          <div class="col">
                            <h3 style="border-bottom: 2px solid #fff;">Links</h3>
                            <span style="width: 70px;display: block;border-bottom: 2px solid #fff;margin-top: -4px;">
                              
                            </span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">

                            <?php $__currentLoopData = $static_page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>  $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($key > 3): ?>
                            <?php continue; ?>
                            <?php endif; ?>
                            <p><a class="scroll-link" href="<?php echo e(url($result->slug)); ?>"><?php echo e($result->title); ?></a></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                          </div>
                          <div class="col-md-6">
                            <?php $__currentLoopData = $static_page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>  $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($key < 4): ?>
                            <?php continue; ?>
                            <?php endif; ?>
                            <p><a class="scroll-link" href="<?php echo e(url($result->slug)); ?>"><?php echo e($result->title); ?></a></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                          </div>
                        </div>
                      </div>
                </div>
            </div>
          </div>
          <div class="footer-bottom">
            <div class="container">
              <div class="row">
                  <div class="col footer-social">
                        <a href="#"><i class="fa fa-facebook-f"></i></a> 
              <a href="#"><i class="fa fa-twitter"></i></a> 
              <a href="#"><i class="fa fa-google-plus-g"></i></a> 
              <a href="#"><i class="fa fa-instagram"></i></a> 
              <a href="#"><i class="fa fa-pinterest"></i></a>
                      </div>
                </div>
            </div>
          </div></footer>
    
  

<div class="container-fluid">
          <div class="copyrights">
            <div class="container text-center">
              <p class="mb-0 py-2">Sportsfight © All rights reserved <?php echo e(date('Y')); ?>. </p>
            </div>
            </div>
        </div>

  <script src="<?php echo e(URL::asset('webmedia/js/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('webmedia/js/jquery-migrate-3.0.1.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('webmedia/js/popper.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('webmedia/js/bootstrap.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('webmedia/js/jquery.easing.1.3.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('webmedia/js/jquery.waypoints.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('webmedia/js/jquery.stellar.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('webmedia/js/owl.carousel.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('webmedia/js/jquery.magnific-popup.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('webmedia/js/aos.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('webmedia/js/jquery.animateNumber.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('webmedia/js/scrollax.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('webmedia/js/plugins.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('webmedia/js/main.js')); ?>"></script><!-- 
  <script src="<?php echo e(URL::asset('webmedia/js/main1.js')); ?>"></script> -->

  <script>
    $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
          $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
          $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
          $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        loop:true,
        autoplay:true,
        autoplayTimeout:1000,
        autoplayHoverPause:true,
        autoplaySpeed:5000 
        
        
    });
  });
  </script> 
  </body>
</html>
<?php /**PATH /var/www/sportsfight.in/resources/views/layouts/footer.blade.php ENDPATH**/ ?>