<div region="center" border="false">
<div style="padding:20px">
<table id="page-table" title="Manage Fan page"  rownumbers="true"  collapsible="true" fitColumns="true">
    <thead>
    <th field="id" width="50">Page Id</th>
    <th field="name" width="100" formatter="formatLink">Page Name</th>
    <th field="access_token" width="200" formatter="formatToken">Access Token</th>
    <th field="action" width="100" formatter="getActions"><?=lang('action')?></th>
    </thead>
</table>


   
</div>
</div>
<script language="javascript" type="text/javascript">
	$(function(){
	
		$('#page-table').datagrid({
			url:'<?=site_url('facebook/admin/page/json')?>',
			height:'auto',
			width:'auto'
		});

	});

	function importData(index)
	{
		var row = $('#page-table').datagrid('getRows')[index];
		if (row){
			$.post('<?php echo site_url('facebook/admin/page/import')?>',{id:row.id,token:row.access_token,name:row.name},function(data){
				if(data.success)
				{
					$.messager.show({title: '<?php  echo lang('success')?>',msg:'Data Import Successful'});
				}
				else
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: 'Error Occured while importing'});
				}
				
			},'JSON');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}			
	}
	
	
	function getActions(value,row,index)
	{
		var e = '<a href="#" onclick="importData('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="Import"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		return e;		
	}
	
	
	
	
	function formatLink(value,row)
	{
		return '<a href="https://facebook.com/'+row.id+'" target="_blank">'+value+'</a>';
	}
	
	function formatToken(value,row)
	{
		return '<a href="javascript:void(0)" onclick="showToken(\''+row.access_token+'\')">SHOW ACCESS TOKEN</a>';
	}	
	
	function showToken(value)
	{
		$.messager.alert('Token',value);
	}


</script>