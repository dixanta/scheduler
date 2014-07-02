<div region="center" border="false">
<div style="padding:20px">
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th>Schedule Id</th>
    <th>Content</th>
    <th>Posted Date</th>
    <th>Page</th>
    <th>Facebook Link</th>
  </tr>
<?php foreach($completed_tasks as $task){?>  
  <tr>
    <td><?php echo $task['schedule_id']?></td>
    <td><?php echo $task['content_title']?></td>
    <td><?php echo $task['posted_date']?></td>
    <td><a href="https://facebook.com/<?php echo $task['facebook_page_id']?>" target="_blank"><?php echo $task['facebook_page_name']?></a></td>
    <td><a href="https://facebook.com/<?php echo $task['facebook_post_id']?>" target="_blank">Link</a></td>
  </tr>
<?php }?>  
</table>

</div>
</div>