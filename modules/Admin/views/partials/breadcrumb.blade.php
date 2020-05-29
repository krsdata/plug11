<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{ url('admin') }}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ url($route_url)  }}">{{ $heading  }}</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">{{ $page_action }}</span>
    </li>
</ul>
