<!DOCTYPE html>
<html lang="en">


    <head>
        <meta charset="utf-8" />
        <title>Admin Dashboard</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #4 for Registeration Form" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
       <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('media/css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('media/css/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('media/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('media/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
           <link href="{{ URL::asset('media/css/bootstrap-datepaginator.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ URL::asset('media/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ URL::asset('media/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
         <link href="{{ URL::asset('assets/global/plugins/ladda/ladda-themeless.min.css') }}" rel="stylesheet" type="text/css" />
             <link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
          <link href="{{ URL::asset('assets/global/css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ URL::asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ URL::asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ URL::asset('assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

      
        <!-- END THEME GLOBAL STYLES -->
         <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{ URL::asset('media/css/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
         <link href="{{ URL::asset('media/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
         <link href="{{ URL::asset('media/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
        
        <link href="{{ URL::asset('media/css/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('media/css/jqvmap.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ URL::asset('media/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('media/css/default.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ URL::asset('media/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
             <link href="{{ URL::asset('assets/apps/css/todo-2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/pages/css/profile.min.css')}}" rel="stylesheet" type="text/css" />
      
        <!-- END THEME LAYOUT STYLES -->
       
        <link rel="shortcut icon" href="{{ URL::asset('media/img/favicon.ico')}}" />
      
        <script src="{{ URL::asset('media/js/customjs.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('media/js/customjs2.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> 
<style type="text/css">
    
.custom_action>li a{
    font-size: 12px !important
}

    .custom_sidebar span{
        font-size: 0.9em !important
        }
    .custom_search{
        background: transparent !important
    }

.page-header.navbar .top-menu .navbar-nav>li.dropdown .dropdown-toggle>i{
    font-size: 12px !important
}


 .page-header.navbar .top-menu .navbar-nav>li.dropdown-dark .custom_drop{
    background: white !important
}
.page-header.navbar .top-menu .navbar-nav>li.dropdown-dark .custom_drop>li .custom_drop_h3{
    color: white !important
}
.page-header.navbar .top-menu .navbar-nav>li.dropdown-dark .custom_drop>li .custom_scroll1 span{
    color: black !important
}

.page-header.navbar .top-menu .navbar-nav>li.dropdown-dark .custom_drop>li .custom_scroll2 span{
    color: black !important
}

.page-header.navbar .top-menu .navbar-nav>li.dropdown-dark .custom_drop>li .custom_scroll3 span{
    color: black !important
}

.page-header.navbar .top-menu .navbar-nav>li.dropdown-dark .custom_drop>li a{
    color: white !important
}
.page-header.navbar .top-menu .navbar-nav>li.dropdown-dark .custom_drop .custom_drop_li{
    background-color: linear-gradient(to right,#141E30,#243B55) !important
}

.custom_drop1>li a{
    color: #34495e !important
}
.custom_drop1>li a{
    font-size: 13px !important
}
.custom_drop1>li a>i{
    color: #34495e !important
}
.page-header.navbar .top-menu .navbar-nav>li.dropdown-dark .dropdown-menu .dropdown-menu-list>li a:hover,.page-header.navbar .top-menu .navbar-nav>li.dropdown-dark .dropdown-menu.dropdown-menu-default>li a:hover{
    background:#dadfe1 !important
    }

.custom_quicknav>li a{
    color: #34495e !important
}
.custom_quicknav>li a:hover{
    color: black !important
}
.custom_quicknav>li {
    color: #34495e !important
}

.page-quick-sidebar-wrapper .page-quick-sidebar .page-quick-sidebar-chat .page-quick-sidebar-chat-user .page-quick-sidebar-chat-user-messages .post.out .message .arrow{
    border-left-color: white !important
}

.page-quick-sidebar-wrapper .page-quick-sidebar .page-quick-sidebar-chat .page-quick-sidebar-chat-user .page-quick-sidebar-chat-user-messages .post .message{
    background-color: white !important
}
.page-quick-sidebar-wrapper .page-quick-sidebar .page-quick-sidebar-chat .page-quick-sidebar-chat-user .page-quick-sidebar-chat-user-messages .post.in .message .arrow{
    border-right-color: white !important
}

.page-quick-sidebar-wrapper .page-quick-sidebar .page-quick-sidebar-chat .page-quick-sidebar-chat-user .page-quick-sidebar-chat-user-messages .post .datetime, .page-quick-sidebar-wrapper .page-quick-sidebar .page-quick-sidebar-chat .page-quick-sidebar-chat-user .page-quick-sidebar-chat-user-messages .post .name{
    color: #95a5a6 !important
}

.page-quick-sidebar-wrapper .page-quick-sidebar .page-quick-sidebar-chat .page-quick-sidebar-chat-user .page-quick-sidebar-chat-user-messages .post .body{
    color: grey !important
}


.media:hover{
    background-color: black !important
}
.list-items>li:hover{
    background: black !important
}
.custom_table td{
    font-size: 13px;
}
.custom_table1 td{
    font-size: 13px;
}

.custom_table1 th{
    font-size: 13px;
}

.custom_nav>li a{
    font-size: 13px;
}

.sec1{
    font-size: 5px; margin-top: 11px; font-weight: bold; text-align: center;
}

.sec2{
    font-size: .6em; margin-top: 10px; font-weight: bold; text-align: center; 
}

.sec3{
    font-size: 12px; text-align: center; font-weight: bold;
}


</style>
  
</head>