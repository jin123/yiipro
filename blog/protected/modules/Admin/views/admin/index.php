<?php  $this->renderPartial('/default/header');?>
<div class="pad_10">
<div class="table-list">
<form name="myform" action="?m=admin&c=role&a=listorder" method="post">
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th width="10%">用户id</th>
		<th width="10%" align="left" >用户名</th>
		<th width="10%" align="left" >所属角色</th>
		<th width="15%" >操作</th>
		</tr>
        </thead>
        <tbody>
<?php 
if(is_array($datalist)){
	foreach($datalist as $info){
?>
<tr>
<td width="10%" align="center"><?php echo $info['userid'];?></td>
<td width="10%" ><?php echo $info['username'];?></td>
<td width="10%" ><?php echo $info['rolename'];?></td>
<td width="15%"  align="center">
<a href="javascript:edit(<?php echo $info['userid'];?>, '<?php echo $info['username'];?>')">编辑</a> | 

<a href="javascript:confirmurl('?r=Admin/Admin/delete&userid=<?php echo $info['userid']?>', '确认删除')">删除</a>
</td>
</tr>
<?php 
	}
}
?>
</tbody>
</table>
 <div id="pages"> <?php echo $pages?></div>
</form>
</div>
</div>
</body>
</html>
<script type="text/javascript">
<!--
	function edit(id, name) {
		window.top.art.dialog({title:'编辑--'+name, id:'edit', iframe:'?r=Admin/Admin/add&userid='+id ,width:'500px',height:'400px'}, 	function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;
		var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
	}
//-->
</script>