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
	});
	
	function getActions(value,row,index)
	{
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_fanpage')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removefanpage('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_fanpage')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
		return e+d;		
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
	
	
</script>