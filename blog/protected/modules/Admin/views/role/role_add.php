<?php  $this->renderPartial('/default/header');?>

<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#rolename").formValidator({onshow:"请输入角色名称",onfocus:"角色名称不能为空。"}).inputValidator({min:1,max:999,onerror:"角色名称不能为空。"});
});
//-->
</script>
<div class="pad_10">
<div class="common-form">
<form name="myform" action="?r=Admin/Role/add" method="post" id="myform">
<table width="100%" class="table_form contentWrap">
<tr>
<td>角色名称</td> 
<td><input type="text" name="info[rolename]" value="<?php echo $info['rolename'];?>" class="input-text" id="rolename"></input></td>
</tr>
<input name="id" type="hidden" value="<?php echo $info['roleid'];?>">
<tr>
<td>角色描述</td>
<td><textarea name="info[description]" rows="2" cols="20" id="description" class="inputtext" style="height:100px;width:500px;"><?php echo $info['description'];?> </textarea></td>
</tr>
</table>

    <div class="bk15"></div>
    <input name="dosubmit" type="submit" value="提交" class="button">
</form>
</div>
</div>
</body>
</html>


