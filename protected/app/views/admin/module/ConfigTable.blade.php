  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> Edit Module : {{ $row->module_name }} <small> Manage Installed Module </small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('') }}">Home</a></li>
		<li><a href="{{ URL::to('module') }}">{{ Lang::get('core.t_module') }}</a></li>
        <li class="active">  Table Grid Editor </li>
      </ul>		  
	  
    </div>

	 <div class="page-content-wrapper m-t"> 
	@include('admin.module.tab',array('active'=>'table'))

@if(Session::has('message'))
       {{ Session::get('message') }}
@endif

 {{ Form::open(array('url'=>$module.'/savetable/'.$module_name, 'class'=>'form-horizontal')) }}
<div class="sbox">
	<div class="sbox-title"><h5> Table Grid  </h5></div>
	<div class="sbox-content">	
	 <div class="table-responsive">
			<table class="table table-striped table-bordered" id="table">
			<thead class="no-border">
			  <tr>
				<th scope="col">No</th>
				<th scope="col">Table</th>
				<th scope="col">Field</th>
				<th scope="col"><i class="icon-link"></i></th>
				<th scope="col" data-hide="phone">Title / Caption </th>
				<th scope="col" data-hide="phone">Show</th>
				<th scope="col" data-hide="phone">View </th>
				<th scope="col" data-hide="phone">Sortable</th>
				<th scope="col" data-hide="phone">Download</th>
				<th scope="col" data-hide="phone">Image / File </th>
			  </tr>
			 </thead> 
			<tbody class="no-border-x no-border-y">	
			<?php usort($tables, "SiteHelpers::_sort"); ?>
			  <?php $num=0; foreach($tables as $rows){
					$id = ++$num;
			  ?>
			  <tr >
				<td class="index"><?php echo $id;?></td>
				<td><?php echo $rows['alias'];?></td>
				<td ><strong><?php echo $rows['field'];?></strong>
				<input type="hidden" name="field[<?php echo $id;?>]" id="field" value="<?php echo $rows['alias'];?>" />			</td>
				<td >
				<span class=" xlick btn-primary btn-xs tips" title="Lookup Display" 
					onclick="SximoModal('{{ URL::to($module.'/conn/'.$row->module_id.'?field='.$rows['field'].'&alias='.$rows['alias']) }}' ,' Connect Field : {{ $rows['field']}} ' )"
					>
						<i class="fa fa-external-link"></i>
					</span>
				</td>
				<td >           
					<input name="label[<?php echo $id;?>]" type="text" class="form-control input-sm " 
					id="label" value="<?php echo $rows['label'];?>" />
				</td>				
				<td>
				<label >
				<input name="view[<?php echo $id;?>]" type="checkbox" id="view" value="1" 
				<?php if($rows['view'] == 1) echo 'checked="checked"';?>/>
				</label>
				</td>
				<td>
				<label >
				<input name="detail[<?php echo $id;?>]" type="checkbox" id="detail" value="1" 
				<?php if($rows['detail'] == 1) echo 'checked="checked"';?>/>
				</label>
				</td>
				<td>
				<label >
				<input name="sortable[<?php echo $id;?>]" type="checkbox" id="sortable" value="1" 
				<?php if($rows['sortable'] == 1) echo 'checked="checked"';?>/>
				</label>
				</td>
				<td>
				<label >
				<input name="download[<?php echo $id;?>]" type="checkbox" id="download" value="1" 
				<?php if($rows['download'] == 1) echo 'checked="checked"';?>/>
				</label>
				</td>
				<td>
				<input type="checkbox" name="attr_image_active[<?php echo $id;?>]" value="1" <?php if($rows['attribute']['image']['active']==1) echo 'checked' ;?> style="float:left;"/> 
				<input type="text" name="attr_image[<?php echo $id;?>]" class="form-control input-sm" style="width:80%; margin-left:5px; float:left;" 
							 value="<?php echo $rows['attribute']['image']['path'];?>" placeholder="Path to file / image " />
				
				<input type="hidden" name="frozen[<?php echo $id;?>]" value="<?php echo $rows['frozen'];?>" />
				<input type="hidden" name="search[<?php echo $id;?>]" value="<?php echo $rows['search'];?>" />
				<input type="hidden" name="hidden[<?php echo $id;?>]" value="<?php if(isset($rows['hidden'])) echo $rows['hidden'];?>" />
				<input type="hidden" name="align[<?php echo $id;?>]" value="<?php if(isset($rows['align'])) echo $rows['align'];?>" />
				<input type="hidden" name="width[<?php echo $id;?>]" value="<?php echo $rows['width'];?>" />
				<input type="hidden" name="alias[<?php echo $id;?>]" value="<?php echo $rows['alias'];?>" />
				<input type="hidden" name="field[<?php echo $id;?>]" value="<?php echo $rows['field'];?>" />
				<input type="hidden" name="sortlist[<?php echo $id;?>]" class="reorder" value="<?php echo $rows['sortlist'];?>" />
				<input type="hidden" name="attr_link_active[<?php echo $id;?>]" value="1" />
				<input type="hidden" name="attr_link[<?php echo $id;?>]" class="form-control input-sm"  value="" />
				<input type="hidden" name="attr_target[<?php echo $id;?>]" class="form-control input-sm"  value="" />
				<input type="hidden" name="attr_link_html[<?php echo $id;?>]" class="form-control input-sm"  value="" />	
				<input type="hidden" name="attr_image_width[<?php echo $id;?>]" />  
				<input type="hidden" name="attr_image_height[<?php echo $id;?>]" />
				<input type="hidden" name="attr_image_html[<?php echo $id;?>]"    />	
				<input type="hidden" name="conn_valid[<?php echo $id;?>]"   
				value="<?php if(isset($rows['conn']['valid'])) echo $rows['conn']['valid'];?>"  />
				<input type="hidden" name="conn_db[<?php echo $id;?>]"   
				value="<?php if(isset($rows['conn']['db'])) echo $rows['conn']['db'];?>"  />	
				<input type="hidden" name="conn_key[<?php echo $id;?>]"  
				value="<?php if(isset($rows['conn']['key'])) echo  $rows['conn']['key'];?>"   />
				<input type="hidden" name="conn_display[<?php echo $id;?>]" 
				value="<?php if(isset($rows['conn']['display'])) echo   $rows['conn']['display'];?>"    />			 
				
				</td>
				
			  </tr>
			  <?php } ?>
			  </tbody>
			</table>
			</div>
	 <div class="infobox infobox-info fade in">
	  <button type="button" class="close" data-dismiss="alert"> x </button>  
	  <p> <strong>Tips !</strong> Drag and drop rows to re ordering lists </p>	
	</div>	
					
			<button type="submit" class="btn btn-primary"> Save Changes </button>
			<input type="hidden" name="module_id" value="{{ $row->module_id }}" />
			 {{ Form::close() }}
		
	</div>	
</div></div>
<script>
$(document).ready(function() {


	var fixHelperModified = function(e, tr) {
		var $originals = tr.children();
		var $helper = tr.clone();
		$helper.children().each(function(index) {
			$(this).width($originals.eq(index).width())
		});
		return $helper;
		},
		updateIndex = function(e, ui) {
			$('td.index', ui.item.parent()).each(function (i) {
				$(this).html(i + 1);
			});
			$('.reorder', ui.item.parent()).each(function (i) {
				$(this).val(i + 1);
			});			
		};
		
	$("#table tbody").sortable({
		helper: fixHelperModified,
		stop: updateIndex
	});		
});
</script>
<style>
	.xlick { cursor:pointer;}
	.popover { width:600px;}
</style>
