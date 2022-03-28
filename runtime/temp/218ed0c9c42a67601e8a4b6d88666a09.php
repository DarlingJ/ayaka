<?php /*a:2:{s:44:"F:\xampp\htdocs\ayaka\app\view\p1\index.html";i:1648450797;s:42:"F:\xampp\htdocs\ayaka\app\view\layout.html";i:1648374239;}*/ ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href=".././static/css/layout.css" rel="stylesheet" type="text/css" />
    <script src=".././static/js/boot.js" type="text/javascript"></script>
    <script src=".././static/js/common.js" type="text/javascript"></script>
    <script src=".././static/js/mini-verify.js" type="text/javascript"></script>
    <script src=".././static/js/ajaxfileupload.js" type="text/javascript"></script>
</head>
<body>
	
<h1>VO导出</h1> 
<fieldset style="width:700px;border:solid 1px #aaa;position:relative;">
	<legend>查询条件</legend>
	<div id="editForm1" style="padding:5px;">
		<table style="width:100%;">
			<span>查询有数据之后会锁定查询，如果需要重新查询，请按解锁</span>
			<tr>
				<td>
					表名：<input id="key" class="mini-textbox"   required='true' emptyText="请输入表名" style="width:150px;" onenter="onKeyEnter"/>
				</td>
			</tr>
			<tr>
				<td>
					<a class="mini-button" onclick="search()" iconCls="icon-search">查询</a>
					<a class="mini-button" onclick="unlock()" iconCls="icon-unlock">解锁</a>
				</td>
			</tr>
		</table>
	</div>
</fieldset>
<br/>
<div style="width:98%;">
	<div class="mini-toolbar" style="border-bottom:0;padding:0px;">
		<table style="width:100%;">
			<tr>
				<td style="width:100%;">
					<a class="mini-button" iconCls="icon-download" onclick="download()">导出Vo</a> 
				</td>
			</tr>
		</table>
	</div>
</div>
<div id="datagrid1" class="mini-datagrid" style="width:98%;height:60%;" allowResize="true" showPager="false"
    url="<?php echo url('p1/search')->domain(''); ?>" >
	<div property="columns">
		<div field="COLUMN_NAME" width="120" headerAlign="center" allowSort="true">字段名称</div>    
		<div field="COLUMN_TYPE" width="120" headerAlign="center" allowSort="true">字段类型</div>
		<div field="COLUMN_COMMENT" width="120" headerAlign="center" allowSort="true">字段说明</div>
	</div>
</div>

<script type="text/javascript">

	mini.parse();
	
	var grid = mini.get("datagrid1");
	var form = new mini.Form("#editForm1");
	function search()
	{
		form.validate();
        if (form.isValid() == false) 
        	{
        	mini.alert("请验证查询条件");
        	return;
        	}
		var key = mini.get("key").value;
		grid.load({"key":key});
	}
	//数据加载后
	grid.on("update",function(e){
		var gridData = grid.getData();
		if(gridData.length>0)
			{
				mini.get("key").setEnabled(false);
			}else{
				mini.get("key").setEnabled(true);
			}
	})
	function unlock()
	{
		mini.get("key").setEnabled(true);
	}
	function download()
	{
		if(mini.get("key").getEnabled())
			{
			mini.alert("查询内容属于解锁状态，需要重新锁定才能汇出文件");
			return;
			}
		var key = mini.get("key").value;
		var gridData = mini.encode(grid.getData());
		const  jsonData = new Map()
		.set("key",key)
		.set("jsondata",gridData);
		var url = "<?php echo url('p1/download')->domain(''); ?>" ;
		postFormSubmit(url,jsonData);
	}
</script>

</body>
</html>