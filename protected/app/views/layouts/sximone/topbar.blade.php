

{{--*/ $menus = SiteHelpers::menus('top') /*--}}
 	  <ul class="nav navbar-nav navbar-collapse collapse navbar-right"  id="topmenu">
		@foreach ($menus as $menu)
			 <li class="@if(Request::is($menu['module'])) active @endif" >
			 	<a 
				@if($menu['menu_type'] =='external')
					href="{{ URL::to($menu['url'])}}" 
				@else
					href="{{ URL::to($menu['module'])}}" 
				@endif
			 
				 @if(count($menu['childs']) > 0 ) class="dropdown-toggle" data-toggle="dropdown" @endif>
			 		<i class="{{$menu['menu_icons']}}"></i> <span>
					
					@if(CNF_MULTILANG ==1 && isset($menu['menu_lang']['title'][Session::get('lang')]))
						{{ $menu['menu_lang']['title'][Session::get('lang')] }}
					@else
						{{$menu['menu_name']}}
					@endif	
				
					</span>
					@if(count($menu['childs']) > 0 )
					 <b class="caret"></b> 
					@endif  
				</a> 
				@if(count($menu['childs']) > 0)
					 <ul class="dropdown-menu dropdown-menu-right">
						@foreach ($menu['childs'] as $menu2)
						 <li class=" 
						 @if(count($menu2['childs']) > 0) dropdown-submenu @endif
						 @if(Request::is($menu2['module'])) active @endif">
						 	<a 
								@if($menu['menu_type'] =='external')
									href="{{ URL::to($menu2['url'])}}" 
								@else
									href="{{ URL::to($menu2['module'])}}" 
								@endif
											
							>
								<i class="{{$menu2['menu_icons']}}"></i> 
									@if(CNF_MULTILANG ==1 && isset($menu['menu_lang']['title'][Session::get('lang')]))
										{{ $menu2['menu_lang']['title'][Session::get('lang')] }}
									@else
										{{$menu2['menu_name']}}
									@endif
								
							</a> 
							@if(count($menu2['childs']) > 0)
							<ul class="dropdown-menu dropdown-menu-right">
								@foreach($menu2['childs'] as $menu3)
									<li @if(Request::is($menu3['module'])) class="active" @endif>
										<a 
											@if($menu['menu_type'] =='external')
												href="{{ URL::to($menu3['url'])}}" 
											@else
												href="{{ URL::to($menu3['module'])}}" 
											@endif										
										
										>
											<span>
											@if(CNF_MULTILANG ==1 && isset($menu['menu_lang']['title'][Session::get('lang')]))
												{{ $menu3['menu_lang']['title'][Session::get('lang')] }}
											@else
												{{$menu3['menu_name']}}
											@endif
											
											</span>  
										</a>
									</li>	
								@endforeach
							</ul>
							@endif							
							
						</li>							
						@endforeach
					</ul>
				@endif
			</li>
		@endforeach  
			<li><a href="javascript://ajax" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-success"> My Account</span></a>
				 <ul class="dropdown-menu dropdown-menu-right">
					 @if(!Auth::check()) 
						<li><a href="{{ URL::to('user/login') }}"><i class="fa fa-sign-in"></i> Log In</a></li>
						<li><a href="{{ URL::to('user/register') }}"><i class="fa fa-user"></i> Registration</a></li>
					 @else
						<li><a href="{{ URL::to('user/profile') }}"><i class="fa fa-user "></i> My Profile </a></li>					
						<li><a href="{{ URL::to('dashboard') }}"><i class="fa fa-desktop"></i> Dashboard</a></li>	
						<li><a href="{{ URL::to('user/logout') }}"><i class="fa  fa-sign-out"></i> Log Out</a></li>					 
					 @endif						 
				 </ul>
				
			</li>

  </ul> 
 