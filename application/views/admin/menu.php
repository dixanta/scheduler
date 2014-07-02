<div style="background-color:#EFEFEF; padding:5px;width:auto;"  class="menubar">
<a href="<?php echo site_url('admin')?>" id="menu-dashboard-button" class="easyui-linkbutton" plain="true" iconCls="icon-dashboard"><?php echo lang('dashboard_menu')?></a>

<?php if(check('System',NULL,FALSE)):?>
		<a href="javascript:void(0)" id="menu-system-button" class="easyui-menubutton" menu="#system-menu" iconCls="icon-system"><?php echo lang('system_menu')?></a>
<?php endif;?>
        <a href="<?php echo site_url('content/admin/content')?>" id="menu-system-button" class="easyui-linkbutton" plain="true" iconCls="icon-content">Content</a>
        <a href="javascript:void(0)" id="menu-design-button" class="easyui-menubutton" menu="#design-menu" iconCls="icon-content">Design</a>        
        <a href="<?php echo site_url('schedule/admin/schedule')?>" id="menu-schedule-button" class="easyui-linkbutton" plain="true" iconCls="icon-extension">Schedule</a>        
        <?php if($this->facebook->getUser()){?>
        <a href="javascript:void(0)" id="menu-facebook-button" class="easyui-menubutton" menu="#facebook-menu" iconCls="icon-tools">Facebook</a>
        <?php }?>
        <a href="javascript:void(0)" id="menu-tools-button" class="easyui-menubutton" menu="#tools-menu" iconCls="icon-tools"><?php echo lang('tools_menu')?></a>
        
        <a href="javascript:void(0)" id="logout-button" class="easyui-linkbutton" plain="true" iconCls="icon-logout"  onclick="logout()"><?php echo lang('logout_menu')?></a>
        
        <?php
   if($this->preference->item('activate_facebook')){
  ?>
        <span style="float:right">
        <?php
                if($this->facebook->getUser()){
    $logout_param=array('next'=>site_url('admin/home/facebook_logout'),
    'access_token'=>$this->facebook->getAccessToken());
        ?>
          <a href="http://facebook.com" target="_blank"><img src="https://graph.facebook.com/<?=$this->facebook->getUser()?>/picture" style="height:25px;width:25px" /></a>
                <a href="<?=$this->facebook->getLogoutUrl($logout_param)?>" class="easyui-linkbutton" plain="true">Logout From Facebook</a>
        <?php
                }else
                {
        ?>
                <a href="<? echo $this->facebook->getLoginUrl(array('scope'=>'manage_pages,read_insights,publish_stream,user_photos,offline_access,user_groups,user_events,user_birthday,friends_birthday,friends_events'))?>" class="easyui-linkbutton" plain="false">Login To Facebook</a>

        <?php
                }
        ?> 
        </span>         <?php
   } // Activate Facebook
  ?>

        
	</div>


<!-- Sub Menu of  System Menu-->
<div id="system-menu" style="width:150px">
<?php if(check('Members',NULL,FALSE)):?><div iconCls="icon-member" href="<?php echo site_url('auth/admin/members')?>" ><?php echo  lang('members_menu')?></div>
<?php endif;?>
<?php if(check('Access Control',NULL,FALSE)):?><div iconCls="icon-accesscontrol" href="<?php print site_url('auth/admin/access_control')?>"><?php echo lang('access_control_menu')?></div><?php endif;?>
<?php if(check('Settings',NULL,FALSE)):?><div href="<?php echo site_url('admin/settings')?>"  plain="false" iconCls="icon-tools"><?php echo lang('settings_menu')?></div><?php endif;?>
</div>


<div id="design-menu" style="width:150px">
<div iconCls="icon-page" href="<?php echo site_url('email_template/admin/email_template')?>">Email Templates</div>
</div>
 <?php if($this->facebook->getUser()){?>
<div id="facebook-menu" style="width:150px">
<div iconCls="icon-page" href="<?php echo site_url('facebook/admin/page')?>">Fan Pages</div>
</div>
<?php }?>

<div id="tools-menu" style="width:150px">
<div iconCls="icon-backup" href="<?php echo site_url('tools/admin/dbbackup')?>"><?php echo lang('dbbackup_menu')?></div>
<div iconCls="icon-file-editor" href="<?php echo site_url('tools/admin/feditor')?>"><?php echo lang('feditor_menu')?></div>
<div iconCls="icon-filemanager" href="<?php echo site_url('tools/admin/filemanager')?>"><?php echo lang('filemanager_menu')?></div>
<div iconCls="icon-layout" href="<?php echo site_url('layout/admin/layout')?>"><?php echo lang('layout_menu')?></div>
<div iconCls="icon-shortcut" href="<?php echo site_url('tools/admin/generators')?>"><?php echo lang('generator_menu')?></div>
<div iconCls="icon-shortcut" href="<?php echo site_url('tools/admin/shortcut')?>"><?php echo lang('shortcut_menu')?></div>
<div iconCls="icon-shortcut" href="<?php echo site_url('tools/admin/sql')?>"><?php echo lang('sql_menu')?></div>
</div>



<script language="javascript">
  function logout(){
    $.messager.defaults={ok:"OK",cancel:"<?php echo lang('general_cancel')?>"};
    $.messager.confirm('<?php echo lang('confirm')?>', '<?php echo lang('logout_confirm')?>', function(r){
    if (r){
     location.href = '<?php echo site_url('auth/logout')?>';
    }
   });
  }
 </script>