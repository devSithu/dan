<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('images/admin_image//sidebar-1.jpg')}}">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo">
        <a href="{{url('/')}}" target="_blank" class="simple-text logo-normal">
            GHI
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">

{{--            <li class="nav-item @if($url=="dashboard") active @endif">--}}
{{--                <a class="nav-link" href="{{url('home')}}">--}}
{{--                    <i class="material-icons">dashboard</i>--}}
{{--                    <p>Dashboard</p>--}}
{{--                </a>--}}
{{--            </li>--}}

            <li class="nav-item @if($url=="new") active @endif">
                <a class="nav-link" href="{{url('/')}}">
                    <i class="material-icons">book</i>
                    <p>New</p>
                </a>
            </li>
            <li class="nav-item @if($url=="education") active @endif">
                <a class="nav-link" href="{{url('admin/education')}}">
                    <i class="material-icons">dashboard</i>
                    <p>Education</p>
                </a>
            </li>
            <li class="nav-item @if($url=="contact") active @endif">
                <a class="nav-link" href="{{url('admin/contact')}}">
                    <i class="material-icons">group</i>
                    <p>Emergency Contact</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{url('logout')}}">
                    <i class="material-icons">logout</i>
                    <p>Logout</p>
                </a>
            </li>

        </ul>
    </div>
</div>