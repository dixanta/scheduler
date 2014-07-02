<div region="center" border="false">
<div style="padding:20px">
<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('schedule_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
<form action="" method="post" id="schedule-search-form">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr><td><label><?php echo lang('schedule_name')?></label>:</td>
<td><input type="text" name="search[schedule_name]" id="search_schedule_name"  class="easyui-validatebox"/></td>
<td><label><?php echo lang('created_date')?></label>:</td>
<td><input type="text" name="date[created_date][from]" id="search_created_date_from"  class="easyui-datebox"/> ~ <input type="text" name="date[created_date][to]" id="search_created_date_to"  class="easyui-datebox"/></td>
</tr>
<tr>
<td><label><?php echo lang('is_repeat')?></label>:</td>
<td><input type="radio" name="search[is_repeat]" id="search_is_repeat1" value="1"/><?php echo lang('general_yes')?>
									<input type="radio" name="search[is_repeat]" id="search_is_repeat0" value="0"/><?php echo lang('general_no')?></td>
<td><label><?php echo lang('status')?></label>:</td>
<td><input type="radio" name="search[status]" id="search_status1" value="1"/><?php echo lang('general_yes')?>
									<input type="radio" name="search[status]" id="search_status0" value="0"/><?php echo lang('general_no')?></td>
</tr>
<tr>
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
<table id="schedule-table" data-options="pagination:true,title:'<?php  echo lang('schedule')?>',pagesize:'20', rownumbers:true,toolbar:'#toolbar',collapsible:true,fitColumns:true">
    <thead>
    <th data-options="field:'checkbox',checkbox:true"></th>
    <th data-options="field:'schedule_id',sortable:true" width="30"><?php echo lang('schedule_id')?></th>
<th data-options="field:'schedule_name',sortable:true" width="50"><?php echo lang('schedule_name')?></th>
<th data-options="field:'created_date',sortable:true" width="50"><?php echo lang('created_date')?></th>
<th data-options="field:'is_repeat',sortable:true" width="50"><?php echo lang('is_repeat')?></th>
<th data-options="field:'status',sortable:true,formatter:formatStatus" width="30" align="center"><?php echo lang('status')?></th>

    <th field="action" width="100" formatter="getActions"><?php  echo lang('action')?></th>
    </thead>
</table>

<div id="toolbar" style="padding:5px;height:auto">
    <p>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_schedule')?>"><?php  echo lang('create')?></a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_schedule')?>"><?php  echo lang('remove_selected')?></a>
    </p>

</div> 

<!--for create and edit schedule form-->
<div id="dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
        <form id="form-schedule" method="post" >
<div id="tt" class="easyui-tabs" style="width:550px;height:250px;">
    <div title="Details" style="padding:20px;">
        
    <table>
		<tr>
		              <td width="34%" ><label><?php echo lang('schedule_name')?>:</label></td>
					  <td width="66%"><input name="schedule_name" id="schedule_name" class="easyui-validatebox" required="true"></td>
		       </tr>
               		<tr>
		              <td width="34%" ><label><?php echo lang('time_zone')?>:</label></td>
					  <td width="66%">
                      <select name="time_zone" id="time_zone">
                      <option value="US">USA</option>
                      <option value="NP">Nepal</option>
                      </select></td>
		       </tr>
               <tr>
		              <td width="34%" ><label><?php echo lang('is_repeat')?>:</label></td>
					  <td width="66%"><input type="radio" value="1" name="is_repeat" id="is_repeat1" /><?php echo lang("general_yes")?> <input type="radio" value="0" name="is_repeat" id="is_repeat0" /><?php echo lang("general_no")?></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('status')?>:</label></td>
					  <td width="66%"><input type="radio" value="1" name="status" id="status1" /><?php echo lang("general_yes")?> <input type="radio" value="0" name="status" id="status0" /><?php echo lang("general_no")?></td>
		       </tr><input type="hidden" name="schedule_id" id="schedule_id"/>
    </table>
    
    </div>
    <div title="Sunday" data-options="" style="overflow:auto;padding:20px;">
        <div id="sunday-spinner-1">
        <input type="text" name="time[0][]" class="easyui-timespinner"/>
        <a href="javascript:void(0)">Delete</a>
        </div>
    </div>
    <div title="Monday" data-options="" style="padding:20px;">
        <div id="monday-spinner-1">
        <input type="text" name="time[1][]" class="easyui-timespinner"/>
        <a href="javascript:void(0)">Delete</a>
        </div>
    </div>
    <div title="Tuesday" data-options="" style="padding:20px;">
        <div id="tuesday-spinner-1">
        <input type="text" name="time[2][]" class="easyui-timespinner"/>
        <a href="javascript:void(0)">Delete</a>
        </div>
    </div>
    <div title="Wednesday" data-options="" style="padding:20px;">
        <div id="wednesday-spinner-1">
        <input type="text" name="time[3][]" class="easyui-timespinner"/>
        <a href="javascript:void(0)">Delete</a>
        </div>
    </div>
    <div title="Thursday" data-options="" style="padding:20px;">
        <div id="thursday-spinner-1">
        <input type="text" name="time[4][]" class="easyui-timespinner"/>
        <a href="javascript:void(0)">Delete</a>
        </div>
    </div>
    <div title="Friday" data-options="" style="padding:20px;">
        <div id="friday-spinner-1">
        <input type="text" name="time[5][]" class="easyui-timespinner"/>
        <a href="javascript:void(0)">Delete</a>
        </div>
    </div>
    <div title="Saturday" data-options="" style="padding:20px;">
        <div id="saturday-spinner-1">
        <input type="text" name="time[6][]" class="easyui-timespinner"/>
        <a href="javascript:void(0)">Delete</a>
        </div>
    </div>
                    
</div>   
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
			$('#schedule-search-form').form('clear');
			$('#schedule-table').datagrid({
				queryParams:null
				});

		});

		$('#search').click(function(){
			$('#schedule-table').datagrid({
				queryParams:{data:$('#schedule-search-form').serialize()}
				});
		});		
		$('#schedule-table').datagrid({
			url:'<?php  echo site_url('schedule/admin/schedule/json')?>',
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
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_schedule')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removeschedule('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_schedule')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
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

	function create(){
		//Create code here
		$('#form-schedule').form('clear');
		$('#dlg').window('open').window('setTitle','<?php  echo lang('create_schedule')?>');
		//uploadReady(); //Uncomment This function if ajax uploading
	}	

	function edit(index)
	{
		var row = $('#schedule-table').datagrid('getRows')[index];
		if (row){
			$('#form-schedule').form('load',row);
			//uploadReady(); //Uncomment This function if ajax uploading
			$('#dlg').window('open').window('setTitle','<?php  echo lang('edit_schedule')?>');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
	
		
	function removeschedule(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#schedule-table').datagrid('getRows')[index];
				$.post('<?php  echo site_url('schedule/admin/schedule/delete_json')?>', {id:[row.schedule_id]}, function(){
					$('#schedule-table').datagrid('deleteRow', index);
					$('#schedule-table').datagrid('reload');
				});

			}
		});
	}
	
	function removeSelected()
	{
		var rows=$('#schedule-table').datagrid('getSelections');
		if(rows.length>0)
		{
			selected=[];
			for(i=0;i<rows.length;i++)
			{
				selected.push(rows[i].schedule_id);
			}
			
			$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
				if(r){				
					$.post('<?php  echo site_url('schedule/admin/schedule/delete_json')?>',{id:selected},function(data){
						$('#schedule-table').datagrid('reload');
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
		$('#form-schedule').form('submit',{
			url: '<?php  echo site_url('schedule/admin/schedule/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-schedule').form('clear');
					$('#dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#schedule-table').datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
				} //if close
			}//success close
		
		});		
		
	}
	
	
</script>