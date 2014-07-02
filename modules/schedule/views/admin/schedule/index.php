<div region="center" border="false">
<div style="padding:20px">
<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('schedule_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
<form action="" method="post" id="schedule-search-form">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr><td><label><?php echo lang('content_id')?></label>:</td>
<td><input type="text" name="search[content_id]" id="search_content_id"  class="easyui-numberbox"/></td>
<td><label><?php echo lang('fanpage_id')?></label>:</td>
<td><input type="text" name="search[fanpage_id]" id="search_fanpage_id"  class="easyui-numberbox"/></td>
</tr>
<tr>
<td><label><?php echo lang('post_date')?></label>:</td>
<td><input type="text" name="date[post_date][from]" id="search_post_date_from"  class="easyui-datebox"/> ~ <input type="text" name="date[post_date][to]" id="search_post_date_to"  class="easyui-datebox"/></td>
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
    <th data-options="field:'schedule_id',sortable:true" width="20">Id</th>
<th data-options="field:'content_title',sortable:true" width="50">Content Title</th>
<th data-options="field:'facebook_page_name',sortable:true" width="100">Facebook Page</th>
<th data-options="field:'post_date',sortable:true" width="50"><?php echo lang('post_date')?></th>
<th data-options="field:'is_repeat',sortable:true,formatter:formatStatus" width="50" align="center">
Repeat</th>
<th data-options="field:'time',sortable:true" width="50" align="center">
Repeat Time</th>
<th data-options="field:'report',sortable:false,formatter:formatReport" width="50" align="center">
Report</th>
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
    <table>
		<tr>
		              <td width="34%" ><label><?php echo lang('content_id')?>:</label></td>
					  <td width="66%"><input name="content_id" id="content_id"  required="true"></td>
		       
		              <td width="34%" ><label><?php echo lang('fanpage_id')?>:</label></td>
					  <td width="66%"><input name="fanpage_id" id="fanpage_id"  required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('post_date')?>:</label></td>
					  <td width="66%" colspan="3"><input name="post_date" id="post_date" class="easyui-datetimebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label>Repeat:</label></td>
					  <td width="66%" colspan="3"><input type="radio" value="1" name="is_repeat" id="is_repeat1" /><?php echo lang("general_yes")?> 
                      <input type="radio" value="0" name="is_repeat" id="is_repeat0" /><?php echo lang("general_no")?></td>
                </tr>
                <tr class="repeat">
                <td>Days:</td>
                      <td colspan="3">
                      Sunday <input type="checkbox" name="sunday" id="day1" value="1"/>
                      Monday <input type="checkbox" name="monday" id="day2" value="1"/>
                      Tuesday <input type="checkbox" name="tuesday" id="day3" value="1"/>                                            
                      Wednesday <input type="checkbox" name="wednesday" id="day4" value="1"/>
                      Thursday <input type="checkbox" name="thursday" id="day5" value="1"/><br/>
                      Friday <input type="checkbox" name="friday" id="day6" value="1"/>
                      Saturday <input type="checkbox" name="saturday" id="day7" value="1"/>
                      </td>                                                                                        
		       </tr>
               <tr class="repeat">
               <td>Time:</td>
               <td colspan="3"><input type="text" name="time" class="easyui-timespinner"/></td>
               </tr>
               <input type="hidden" name="schedule_id" id="schedule_id"/>
    </table>
    </form>
	<div id="dlg-buttons">
		
        <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onClick="save(1)">Save And Continue</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onClick="save(0)"><?php  echo  lang('general_save')?></a>
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
		

		$('#content_id,#search_content_id').combogrid({
			url:'<?=site_url('content/admin/content/json')?>',
			panelWidth:600,
			idField:'content_id',
			textField:'content_title',
			mode:'remote',
			fitcolumns:true,
			pagination:true,
			columns:[[{field:'content_id',title:'Id',width:80},
					{field:'content_title',title:'Title',width:400},]],
			/*keyHandler:{
				enter:function(data){
				},
				query:function(q){
				}
			}*/
			
		});
		
		$('#fanpage_id,#search_fanpage_id').combogrid({
			url:'<?=site_url('fanpage/admin/fanpage/json')?>',
			panelWidth:600,
			idField:'fanpage_id',
			textField:'facebook_page_name',
			mode:'remote',
			fitcolumns:true,
			pagination:true,
			columns:[[{field:'fanpage_id',title:'Id',width:80},
					{field:'facebook_page_name',title:'Title',width:400},]],
			/*keyHandler:{
				enter:function(data){
				},
				query:function(q){
				}
			}*/
			
		});		
		
	});
	
	function getActions(value,row,index)
	{
		
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_schedule')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removeschedule('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_schedule')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
		return e+d;		
	}
	
	function formatReport(value,row,index)
	{
		return '<a href="<?php echo site_url('schedule/admin/report')?>?id='+row.schedule_id+'" target="_blank">Report</a>';
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
	
	function save(c)
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