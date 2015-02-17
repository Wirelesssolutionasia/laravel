
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> Log   <small> View All logs </small></h3>
      </div>

		  <ul class="breadcrumb">
			<li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home'); }}</a></li>
			<li><a href="{{ URL::to('config') }}"> Error Logs </a></li>
		  </ul>
		
		  
    </div>

	<div class="page-content-wrapper">  
	@if(Session::has('message'))
	  
		   {{ Session::get('message') }}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		
<div class="block-content">
	<ul class="nav nav-tabs" >
	  <li ><a href="{{ URL::to('config')}}">{{ Lang::get('core.tab_siteinfo'); }} </a></li>
	  <li ><a href="{{ URL::to('config/email') }}" >{{ Lang::get('core.tab_email'); }}</a></li>
	  <li ><a href="{{ URL::to('config/security') }}" > {{ Lang::get('core.tab_loginsecurity'); }}  </a></li>
	  <li ><a href="{{ URL::to('config/translation') }}" >  Translation   </a></li>
	    <li  class="active"><a href="{{ URL::to('config/log') }}" >  Clear Cache & Logs  </a></li>
	</ul>	
<div class="tab-content">
	  <div class="tab-pane active use-padding" id="info">	
	 {{ Form::open(array('url'=>'config/email/', 'class'=>'form-vertical row')) }}
	
	<div class="col-sm-6">
	
		<fieldset > <legend> Session Cache Template   </legend>
		  <div class="form-group">
			<label for="ipt" class=" control-label">Error logs  </label>		
			<label class="label label-danger"> {{  $filesize }} </label> 		
		  </div>  
		
		  <div class="form-group">
			<label for="ipt" class=" control-label"> Template Cache </label>		
				
		  </div>  
		  
		<div class="form-group">   
			<a href="{{ URL::to('config/clearlog') }}" class="btn btn-primary" > Clear cache and logs </a>	 
		</div>
	
  	</fieldset>


	</div> 


 	
 </div>
 {{ Form::close() }}
</div>
</div>
</div>
</div>





