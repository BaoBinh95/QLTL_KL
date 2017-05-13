<!-- header -->
<div class="header">
    <div class="logo">
        <a href="#" style="text-decoration:none;">QLTL</a>
    </div>
    <div class="header-right">
        <span class="menu"><img src="{{ asset('images/menu.png') }}" alt=""/></span>
            <ul class="nav1">
                <li><a href="{{ route('admin.dashboard') }}">{{  trans('label.dashboard') }}</a></li>
                <li><a href="{{ route('documents.index') }}">{{  trans('label.document') }}</a></li>
                <li><a href="{{ route('typedocuments.index') }}">{{  trans('label.type_doc') }}</a></li>
                <li><a href="{{ route('departments.index') }}">{{  trans('label.department') }}</a></li>
                <li><a href="{{ action('UserController@index') }}">{{  trans('label.user') }}</a></li>
                @if (Auth::guest())
                <li><a href="{{ url('/login') }}">{{  trans('label.login') }}</a></li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {!! Html::image(Auth::user()->avatar, null, ['class'=> 'img-responsive', 'id' => 'avatar_display']) !!}
                        {{ Auth::user()->name }} <i class="fa fa-angle-down"></i> <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li> <a href="{{ route('user.mydocuments') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i> Tài liệu của tôi</a> </li>
                        <li> <a href="{{ route('users.show', auth()->id()) }}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a> </li>
                        <li>
                            <a href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                {{ trans('label.logout') }}
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>

                    </ul>
                </li>
                @endif
            </ul>
    </div>
    <div class="clearfix"></div>
</div>
