<div region="center" border="false">
<div style="padding:20px">
<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('content_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
<form action="" method="post" id="content-search-form">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr><td><label><?php echo lang('content_title')?></label>:</td>
<td><input type="text" name="search[content_title]" id="search_content_title"  class="easyui-validatebox"/></td>
<td><label><?php echo lang('added_date')?></label>:</td>
<td><input type="text" name="date[added_date][from]" id="search_added_date_from"  class="easyui-datebox"/> ~ <input type="text" name="date[added_date][to]" id="search_added_date_to"  class="easyui-datebox"/></td>
</tr>
<tr>
<td><label><?php echo lang('link')?></label>:</td>
<td><input type="text" name="search[link]" id="search_link"  class="easyui-validatebox"/></td>
<td><label><?php echo lang('text')?></label>:</td>
<td><input type="text" name="search[text]" id="search_text"  class="easyui-validatebox"/></td>
</tr>
<tr>
<td><label><?php echo lang('status')?></label>:</td>
<td><input type="radio" name="search[status]" id="search_status1" value="1"/><?php echo lang('general_yes')?>
									<input type="radio" name="search[status]" id="search_status0" value="0"/><?php echo lang('general_no')?></td>
</tr>
  <tr>
    <td colspan="4">
    <a href="javascript:void(0)" class="easyui-linkbutton" id="search" data-options="iconCls:'icon-search'"><?php  echo lang('search')?></a>  
    <a href="javascript:void(0)" class="easyui-linkbutton" id="clear" data-options="iconCls:'icon-clear'"><?php  echo lang('clear')?></a>
    </td>
    </tr>
</table>

</form>
</div>
<br/>
<table id="content-table" data-options="pagination:true,title:'<?php  echo lang('content')?>',pagesize:'20', rownumbers:true,toolbar:'#toolbar',collapsible:true,fitColumns:true">
    <thead>
    <th data-options="field:'checkbox',checkbox:true"></th>
    <th data-options="field:'content_id',sortable:true" width="30"><?php echo lang('content_id')?></th>
<th data-options="field:'content_title',sortable:true" width="50"><?php echo lang('content_title')?></th>
<th data-options="field:'added_date',sortable:true" width="50"><?php echo lang('added_date')?></th>
<th data-options="field:'image',sortable:true,formatter:formatImage" width="50" ><?php echo lang('image')?></th>
<th data-options="field:'link',sortable:true" width="50"><?php echo lang('link')?></th>
<th data-options="field:'text',sortable:true" width="50"><?php echo lang('text')?></th>
<th data-options="field:'status',sortable:true,formatter:formatStatus" width="30" align="center"><?php echo lang('status')?></th>

    <th field="action" width="100" formatter="getActions"><?php  echo lang('action')?></th>
    </thead>
</table>

<div id="toolbar" style="padding:5px;height:auto">
    <p>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_content')?>"><?php  echo lang('create')?></a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_content')?>"><?php  echo lang('remove_selected')?></a>
    </p>

</div> 

<!--for create and edit content form-->
<div id="dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
    <form id="form-content" method="post" >
    <table>
		<tr>
		              <td width="34%" ><label><?php echo lang('content_title')?>:</label></td>
					  <td width="66%"><input name="content_title" id="content_title" class="easyui-validatebox" required="true" style="width:400px"></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('image')?>:</label></td>
					  <td width="66%"><label id="upload_image_name" style="display:none"></label>
                      <input name="image" id="image" type="text" style="display:none"/>
                      <input type="file" id="upload_image" name="userfile" style="display:block"/>
                      <a href="#" id="change-image" title="Delete" style="display:none"><img src="<?=base_url()?>assets/icons/delete.png" border="0"/></a></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('link')?>:</label></td>
					  <td width="66%"><input name="link" id="link" class="easyui-validatebox" validType="url" style="width:400px"></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('text')?>:</label></td>
					  <td width="66%"><textarea name="text" id="text" style="width:400px;height:150px"></textarea></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('status')?>:</label></td>
					  <td width="66%"><input type="radio" value="1" name="status" id="status1" /><?php echo lang("general_yes")?> <input type="radio" value="0" name="status" id="status0" /><?php echo lang("general_no")?></td>
		       </tr><input type="hidden" name="content_id" id="content_id"/>
    </table>
    </form>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onClick="save()"><?php  echo  lang('general_save')?></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:$('#dlg').window('close')"><?php  echo  lang('general_cancel')?></a>
	</div>    
</div>
<!--div ends-->
   
</div>
</div>
<script language="javascript" type="text/javascript">
	$(function(){
		$('#clear').click(function(){
			$('#content-search-form').form('clear');
			$('#content-table').datagrid({
				queryParams:null
				});

		});

		$('#search').click(function(){
			$('#content-table').datagrid({
				queryParams:{data:$('#content-search-form').serialize()}
				});
		});		
		$('#content-table').datagrid({
			url:'<?php  echo site_url('content/admin/content/json')?>',
			height:'auto',
			width:'auto',
			onDblClickRow:function(index,row)
			{
				edit(index);
			}
		});
	
    
    $('#change-image').on('click',function(){
			$.messager.confirm('Confirm','Are you sure to delete ?',function(r){
				if (r){
					$.post('<?php echo site_url('content/admin/content/upload_delete')?>',{filename:$('#image').val()},function(data){
					$('#image').val('');
					$('#upload_image_name').html('').hide();
					$('#change-image').hide();
					$('#upload_image').show();	
					});
				}
			});
		});
});
	
	function getActions(value,row,index)
	{
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_content')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removecontent('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_content')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
		return e+d;		
	}
	
	function formatStatus(value)
	{
		if(value==1)
		{
			return 'Yes';
		}
		return 'No';
	}
    
    	function formatImage(value)
	{
		if(value!='')
		{
			return '<img src="<?php echo base_url()?>uploads/content/thumb/' + value + '" height="50" width="50">';
		}
		return '';
	}

	function create(){
		//Create code here
		$('#form-content').form('clear');
		$('#dlg').window('open').window('setTitle','<?php  echo lang('create_content')?>');
        $('#upload_image_name').html('').hide();
		$('#change-image').hide();
		$('#upload_image').show();	
			
		
		uploadReady(); //Uncomment This function if ajax uploading
	}	

	function edit(index)
	{
		var row = $('#content-table').datagrid('getRows')[index];
		if (row){
			$('#form-content').form('load',row);
            	if(row.image!='')
			{
				$('#upload_image_name').html(row.image).show();
				$('#change-image').show();
				$('#upload_image').hide();
			}
			uploadReady(); //Uncomment This function if ajax uploading
			$('#dlg').window('open').window('setTitle','<?php  echo lang('edit_content')?>');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
	
		
	function removecontent(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#content-table').datagrid('getRows')[index];
				$.post('<?php  echo site_url('content/admin/content/delete_json')?>', {id:[row.content_id]}, function(){
					$('#content-table').datagrid('deleteRow', index);
					$('#content-table').datagrid('reload');
				});

			}
		});
	}
	
	function removeSelected()
	{
		var rows=$('#content-table').datagrid('getSelections');
		if(rows.length>0)
		{
			selected=[];
			for(i=0;i<rows.length;i++)
			{
				selected.push(rows[i].content_id);
			}
			
			$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
				if(r){				
					$.post('<?php  echo site_url('content/admin/content/delete_json')?>',{id:selected},function(data){
						$('#content-table').datagrid('reload');
					});
				}
				
			});
			
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');	
		}
		
	}
	
	function save()
	{
		$('#form-content').form('submit',{
			url: '<?php  echo site_url('content/admin/content/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-content').form('clear');
					$('#dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#content-table').datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
				} //if close
			}//success close
		
		});		
		
	}
	
	function uploadReady()
	{
		uploader=$('#upload_image');
		new AjaxUpload(uploader, {
			action: '<?php  echo site_url('content/admin/content/upload_image')?>',
			name: 'userfile',
			responseType: "json",
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					$.messager.show({title: '<?php  echo lang('error')?>',msg: 'Only JPG, PNG or GIF files are allowed'});
					return false;
				}
				//status.text('Uploading...');
			},
			onComplete: function(file, response){
				if(response.error==null){
					var filename = response.file_name;
					$('#upload_image').hide();
					$('#image').val(filename);
					$('#upload_image_name').html(filename);
					$('#upload_image_name').show();
					$('#change-image').show();
				}
                else
                {
					$.messager.show({title: '<?php  echo lang('error')?>',msg: response.error});                
                }
			}		
		});		
	}
</script>