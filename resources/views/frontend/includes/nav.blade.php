<nav class="navbar navbar-expand-lg fixed-top navbar-transparent" color-on-scroll="300">
        <div class="container">
			<div class="navbar-translate">
	            <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-bar"></span>
					<span class="navbar-toggler-bar"></span>
					<span class="navbar-toggler-bar"></span>
	            </button>
	            {{ link_to_route('frontend.index', app_name(), [], ['class' => 'navbar-brand']) }}
			</div>
	        <div class="collapse navbar-collapse" id="navbarToggler">
	            <ul class="navbar-nav ml-auto">
                @if (! $logged_in_user)         
                    <li class="nav-item">
                        <a href="{{ route('frontend.auth.login') }}" class="nav-link"><i class="fas fa-sign-in-alt"></i>{{ trans('labels.frontend.auth.login_button') }}</a>
                    </li>
                    @if (Route::has('frontend.auth.register'))                    
                    <li class="nav-item">
                        <a href="{{ route('frontend.auth.register') }}" class="nav-link"><i class="fas fa-sign-in-alt"></i>{{ trans('labels.frontend.auth.register_button') }}</a>
                    </li>
                    @endif
                @else
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" id="dropdownMenuButton" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ $logged_in_user->username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-danger" aria-labelledby="dropdownMenuButton">
                            @permission('view-backend')
                            <a href="{{ route('admin.index') }}" class="dropdown-item"><i class="fas fa-tools"></i>{{ trans('navs.frontend.user.administration') }}</a>
                            @endauth
                            <a href="{{ route('frontend.user.account') }}" class="dropdown-item"><i class="fas fa-user"></i>{{ trans('navs.frontend.user.account') }}</a>
                            <a href="{{ route('frontend.auth.logout') }}" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>{{ trans('navs.general.logout') }}</a>
                        </div>
                    </li>
                @endif
                @if (config('locale.status') && count(config('locale.languages')) > 1)
                    <li class="dropdown nav-item">
                        <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('menus.language-picker.language') }}</a>
                        @include('includes.partials.lang')
                    </li>
                @endif
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Polub na Facebook'u" data-placement="bottom" href="#" target="_blank">
                            <i class="fab fa-facebook-square"></i><p class="d-lg-none">Facebook</p>
                        </a>
                    </li>
	            </ul>
	        </div>
		</div>
    </nav>
    @include('includes.partials.messages')