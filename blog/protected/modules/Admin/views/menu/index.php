<?php  $this->renderPartial('/default/header');?>
<form name="myform" action="?m=admin&c=menu&a=listorder" method="post">
<div class="pad-lr-10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="80">排序</th>
            <th width="100">id</th>
            <th>菜单英文名称</th>
			<th>管理操作</th>
            </tr>
        </thead>
	<tbody>
    <?php echo $tree;?>
	</tbody>
    </table>
  
    <div class="btn"><input type="submit" class="button" name="dosubmit" value="<?php echo L('listorder')?>" /></div>  </div>
</div>
</div>
</form>

</body>
</html>