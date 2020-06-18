 <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
<?php 
    $route  =   Route::currentRouteName();

?>
<style type="text/css">
    
.scrollbar
{
     
  /*  float: left; 
    overflow-y: scroll;
    overflow-x: hidden; */
}
#scroll_bar::-webkit-scrollbar-thumb
{
    background-color: red;
    border-radius: 10px;
    background-image: -webkit-linear-gradient(0deg,
                                              rgba(255, 255, 255, 0.5) 25%,
                                              transparent 25%,
                                              transparent 50%,
                                              rgba(255, 255, 255, 0.5) 50%,
                                              rgba(255, 255, 255, 0.5) 75%,
                                              transparent 75%,
                                              transparent)
}
</style>

<div class="page-container">
 <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
        <div id="scroll_bar" class="page-sidebar scrollbar navbar-collapse collapse" style="overflow-y: scroll !important; max-height: 700px !important ">

            <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <li class="nav-item start active open">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title">Dashboard</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item start active open">
                            <a href="<?php echo e(url('admin')); ?>" class="nav-link ">
                                <i class="icon-bar-chart"></i>
                                <span class="title">Dashboard</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        </ul>
                </li>
                <?php $__currentLoopData = $main_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item start  <?php if($route==$result->title): ?> active open <?php endif; ?> <?php if($route==$result->title.'.create'): ?> active open <?php endif; ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="glyphicon glyphicon-th"></i>
                                <span class="title"><?php echo e(ucfirst($result->title)); ?></span>
                                <span class="arrow <?php if($route==$result->title): ?> open <?php endif; ?>"></span>
                            </a>
                            <ul class="sub-menu" style="display: <?php if($route==$result->title): ?> block <?php endif; ?>">
                                
                                <?php $__currentLoopData = $result->sub_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php if(\Str::contains($sub_menu->title, 'Create')): ?>

                            <li class="nav-item  <?php if($route==$result->title.'.create'): ?> active <?php endif; ?>">
                                
                                <a href="<?php echo e(route($result->title.'.create')); ?>" class="nav-link ">
                                       <i class="glyphicon glyphicon-eye-open"></i>
                                        <span class="title">
                                        <?php echo e($sub_menu->title); ?>

                                        </span>
                                    </a>
                                </li> 
                                <?php else: ?>
                                 <li class="nav-item  <?php if($route==$result->title): ?> active <?php endif; ?>">
                                    <a href="<?php echo e(route($result->title)); ?>" class="nav-link ">
                                       <i class="glyphicon glyphicon-eye-open"></i>
                                        <span class="title">
                                        <?php echo e($sub_menu->title); ?>

                                        </span>
                                    </a>
                                </li> 
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
            </ul>  
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div> 
<?php /**PATH /var/www/sportsfight.in/modules/Admin/views/partials/sidebar.blade.php ENDPATH**/ ?>