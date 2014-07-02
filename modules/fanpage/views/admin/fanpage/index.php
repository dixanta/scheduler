<div region="center" border="false">
<div style="padding:20px">
<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('fanpage_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
<form action="" method="post" id="fanpage-search-form">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr><td><label><?php echo lang('facebook_page_id')?></label>:</td>
<td><input type="text" name="search[facebook_page_id]" id="search_facebook_page_id"  class="easyui-validatebox"/></td>
<td><label><?php echo lang('facebook_page_name')?></label>:</td>
<td><input type="text" name="search[facebook_page_name]" id="search_facebook_page_name"  class="easyui-validatebox"/></td>
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
<table id="fanpage-table" data-options="pagination:true,title:'<?php  echo lang('fanpage')?>',pagesize:'20', rownumbers:true,toolbar:'#toolbar',collapsible:true,fitColumns:true">
    <thead>
    <th data-options="field:'checkbox',checkbox:true"></th>
    <th data-options="field:'fanpage_id',sortable:true" width="30"><?php echo lang('fanpage_id')?></th>
<th data-options="field:'facebook_page_id',sortable:true,formatter:formatLink" width="50"><?php echo lang('facebook_page_id')?></th>
<th data-options="field:'facebook_page_name',sortable:true,formatter:formatLink" width="50"><?php echo lang('facebook_page_name')?></th>
<th data-options="field:'status',sortable:true,formatter:formatStatus" width="30" align="center"><?php echo lang('status')?></th>

    <th field="action" width="100" formatter="getActions"><?php  echo lang('action')?></th>
    </thead>
</table>

<div id="toolbar" style="padding:5px;height:auto">
    <p>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_fanpage')?>"><?php  echo lang('create')?></a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_fanpage')?>"><?php  echo lang('remove_selected')?></a>
    </p>

</div> 

<div id="link-dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
    <form id="form-link" method="post" >
    <table>
		<tr>
		              <td width="34%" ><label>Content Title:</label></td>
					  <td width="66%"><input name="content_title" id="content_title" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label>Link:</label></td>
					  <td width="66%"><input name="content" id="link_content" class="easyui-validatebox" required="true"></td>
		       </tr>
		              <td width="34%" ><label><?php echo lang('status')?>:</label></td>
					  <td width="66%"><input type="radio" value="1" name="status" id="link_status1" /><?php echo lang("general_yes")?> <input type="radio" value="0" name="status" id="link_status0" /><?php echo lang("general_no")?></td>
<input type="hidden" name="fanpage_id" id="link_fanpage_id"/>
<input type="hidden" name="type" id="link_type" value="Link"/>
		       </tr>
                   </table>
    </form>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onClick="savelink()"><?php  echo  lang('general_save')?></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:$('#link-dlg').window('close')"><?php  echo  lang('general_cancel')?></a>
	</div>    
</div>
<div id="image-dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
    <form id="form-image" method="post" >
    <table>
		<tr>
		              <td width="34%" ><label>Content Title:</label></td>
					  <td width="66%"><input name="content_title" id="content_title" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label>Image:</label></td>
					  <td width="66%"><label id="upload_image_name" style="display:none"></label>
                      <input name="content" id="image_content" type="text" style="display:none"/>
                      <input type="file" id="upload_image" name="userfile" style="display:block"/>
                      <a href="#" id="change-image" title="Delete" style="display:none"><img src="<?=base_url()?>assets/icons/delete.png" border="0"/></a></td>
		       </tr>
		              <td width="34%" ><label><?php echo lang('status')?>:</label></td>
					  <td width="66%"><input type="radio" value="1" name="status" id="image_status1" /><?php echo lang("general_yes")?> <input type="radio" value="0" name="status" id="image_status0" /><?php echo lang("general_no")?></td>
                      <input type="hidden" name="fanpage_id" id="image_fanpage_id"/>
                      <input type="hidden" name="type" id="image_type" value="Photo"/>
    </table>
    </form>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onClick="saveimage()"><?php  echo  lang('general_save')?></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:$('#image-dlg').window('close')"><?php  echo  lang('general_cancel')?></a>
	</div>    
</div><div id="post-dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
    <form id="form-post" method="post" >
    <table>
		<tr>
		              <td width="34%" ><label>Content Title:</label></td>
					  <td width="66%"><input name="content_title" id="content_title" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label>Post:</label></td>
					  <td width="66%"><textarea id="post_content" name="content"></textarea></td>
		       </tr>
		              <td width="34%" ><label><?php echo lang('status')?>:</label></td>
					  <td width="66%"><input type="radio" value="1" name="status" id="post_status1" /><?php echo lang("general_yes")?> <input type="radio" value="0" name="status" id="post_status0" /><?php echo lang("general_no")?></td>
		       <input type="hidden" name="fanpage_id" id="post_fanpage_id"/>
               <input type="hidden" name="type" id="post_type" value="Post"/>
    </table>
    </form>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onClick="savepost()"><?php  echo  lang('general_save')?></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:$('#post-dlg').window('close')"><?php  echo  lang('general_cancel')?></a>
	</div>    
</div>
<!--for create and edit fanpage form-->
<div id="dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
    <form id="form-fanpage" method="post" >
    <table>
		<tr>
		              <td width="34%" ><label><?php echo lang('facebook_page_id')?>:</label></td>
					  <td width="66%"><input name="facebook_page_id" id="facebook_page_id" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('facebook_page_name')?>:</label></td>
					  <td width="66%"><input name="facebook_page_name" id="facebook_page_name" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('access_token')?>:</label></td>
					  <td width="66%"><textarea name="access_token" id="access_token" class="easyui-validatebox" required="true" style="width:300px;height:100px"></textarea></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('status')?>:</label></td>
					  <td width="66%"><input type="radio" value="1" name="status" id="status1" /><?php echo lang("general_yes")?> <input type="radio" value="0" name="status" id="status0" /><?php echo lang("general_no")?></td>
		       </tr><input type="hidden" name="fanpage_id" id="fanpage_id"/>
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
			$('#fanpage-search-form').form('clear');
			$('#fanpage-table').datagrid({
				queryParams:null
				});

		});

		$('#search').click(function(){
			$('#fanpage-table').datagrid({
				queryParams:{data:$('#fanpage-search-form').serialize()}
				});
		});		
		$('#fanpage-table').datagrid({
			url:'<?php  echo site_url('fanpage/admin/fanpage/json')?>',
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
					$.post('<?php echo site_url('fanpage/admin/fanpage/upload_delete')?>',{filename:$('#image').val()},function(data){
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
	   var l = '<a href="#" onclick="link('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="Add Link"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
       var i = '<a href="#" onclick="image('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="Add Image"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
       var p = '<a href="#" onclick="post('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="Add Post"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_fanpage')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removefanpage('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_fanpage')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
		return l+i+p+e+d;		
	}
	
	function formatLink(value,row,index)
	{
		return '<a href="https://facebook.com/'+row.facebook_page_id+'" target="_blank">'+value+'</a>';
	}

	function create(){
		//Create code here
		$('#form-fanpage').form('clear');
		$('#dlg').window('open').window('setTitle','<?php  echo lang('create_fanpage')?>');
		//uploadReady(); //Uncomment This function if ajax uploading
	}	

	function edit(index)
	{
		var row = $('#fanpage-table').datagrid('getRows')[index];
		if (row){
			$('#form-fanpage').form('load',row);
			//uploadReady(); //Uncomment This function if ajax uploading
			$('#dlg').window('open').window('setTitle','<?php  echo lang('edit_fanpage')?>');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
    function link(index)
	{
	   $('#form-link').form('clear');
       var row = $('#fanpage-table').datagrid('getRows')[index];
       $('#link_fanpage_id').val(row.fanpage_id);
        $('#link_type').val('Link');
       $('#link-dlg').window('open').window('setTitle','Add Link');		
	}
    function image(index)
	{
	   $('#form-image').form('clear');
        var row = $('#fanpage-table').datagrid('getRows')[index];
       $('#image_fanpage_id').val(row.fanpage_id);
       $('#image_type').val('Photo');
       $('#image-dlg').window('open').window('setTitle','Add Image');
       uploadReady();		
	}
    function post(index)
	{
	   $('#form-post').form('clear');
        var row = $('#fanpage-table').datagrid('getRows')[index];
         $('#post_type').val('Post');
       $('#post_fanpage_id').val(row.fanpage_id);
       $('#post-dlg').window('open').window('setTitle','Add Post');		
	}
	
		
	function removefanpage(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#fanpage-table').datagrid('getRows')[index];
				$.post('<?php  echo site_url('fanpage/admin/fanpage/delete_json')?>', {id:[row.fanpage_id]}, function(){
					$('#fanpage-table').datagrid('deleteRow', index);
					$('#fanpage-table').datagrid('reload');
				});

			}
		});
	}
	
	function removeSelected()
	{
		var rows=$('#fanpage-table').datagrid('getSelections');
		if(rows.length>0)
		{
			selected=[];
			for(i=0;i<rows.length;i++)
			{
				selected.push(rows[i].fanpage_id);
			}
			
			$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
				if(r){				
					$.post('<?php  echo site_url('fanpage/admin/fanpage/delete_json')?>',{id:selected},function(data){
						$('#fanpage-table').datagrid('reload');
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
		$('#form-fanpage').form('submit',{
			url: '<?php  echo site_url('fanpage/admin/fanpage/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-fanpage').form('clear');
					$('#dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#fanpage-table').datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
				} //if close
			}//success close
		
		});		
		
	}
    function savelink()
	{
		$('#form-link').form('submit',{
			url: '<?php  echo site_url('content/admin/content/save')?>',
			onSubmit: function(param){
                
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-link').form('clear');
					$('#link-dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#fanpage-table').datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
				} //if close
			}//success close
		
		});		
		
	}
    function saveimage()
	{
		$('#form-image').form('submit',{
			url: '<?php  echo site_url('content/admin/content/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-image').form('clear');
					$('#image-dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#fanpage-table').datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
				} //if close
			}//success close
		
		});		
		
	}
    function savepost()
	{
		$('#form-post').form('submit',{
			url: '<?php  echo site_url('content/admin/content/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-post').form('clear');
					$('#post-dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#fanpage-table').datagrid('reload');	// reload the user data
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
			action: '<?php  echo site_url('fanpage/admin/fanpage/upload_image')?>',
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