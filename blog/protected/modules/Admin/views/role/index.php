<?php  $this->renderPartial('/default/header');?>
<div class="table-list pad-lr-10">
<form name="myform" action="?m=admin&c=role&a=listorder" method="post">
    <table width="100%" cellspacing="0">
       <thead>
		<tr>
		<th width="10%">ID</th>
		<th width="15%" align="left">角色名称</th>
		<th width="265" align="left">角色描述</th>
		<th class="text-c">管理操作</th>
		</tr>
		</thead>
<tbody>
<?php 
if(is_array($info)){
	foreach($info as $info){
?>
<tr>
<td width="10%" align="center"><?php echo $info->roleid;?></td>
<td width="15%"  ><?php echo $info->rolename;?></td>
<td width="265" ><?php echo $info->description;?></td>
<td class="text-c">
<a href="javascript:setting_role(<?php echo $info->roleid;?>, '<?php echo $info->rolename;?>')">权限设置</a>
|
<!-- <a onclick="setting_cat_priv(4, '总编')" href="javascript:void(0)">栏目权限</a>
| -->
<a href="?m=admin&c=role&a=member_manage&roleid=4&menuid=50&pc_hash=GKDMVg">成员管理</a>
|
<a href="?r=Admin/Role/add&id=<?php echo $info->roleid;?>&menuid=<?php echo $_GET['menuid'];?>&pc_hash=GKDMVg">修改</a>
|
<a href="javascript:confirmurl('?r=Admin/Role/delete&id=<?php echo $info->roleid;?>&menuid=<?php echo $_GET['menuid'];?>&pc_hash=GKDMVg', '是否删除?')">删除</a>
</td>
</tr>
<?php } } ?>
</tbody>
</table>
</form>
</div>
</body>
<script type="text/javascript">
function setting_role(id, name) {
	window.top.art.dialog({title:'设置《'+name+'》',id:'edit',iframe:'?r=Admin/Role/priv_setting&show_header=1&roleid='+id,width:'700',height:'100'});
	}
	function setting_cat_priv(id, name) {
	window.top.art.dialog({title:'栏目权限《'+name+'》',id:'edit',iframe:'?m=admin&c=role&a=setting_cat_priv&roleid='+id,width:'700',height:'100'});
	} 
</script>
</html>
