<?php require_once "../richtexteditor/include_rte.php" ?>
<?php
    $rte=new RichTextEditor();
    $rte->LoadDelay=987654321;
    $rte->Skin="smartsilver";
    $rte->Toolbar = "email";
    $rte->ResizeMode="disabled";
    $rte->MvcInit();
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - One editor, multiple area</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
    <style type="text/css">
		.content
		{
			border: 1px solid #cccccc;
			padding: 5px;
			line-height: 22px;
			width: 300px;
		}
	</style>

	<script type="text/javascript">
		var loader;
		var editor;
		var diveditor;
		var divcontent;
		
		function RichTextEditor_OnLoader(rteloader)
		{
			loader=rteloader;
			if(divcontent)
				loader.load();
		}
		function RichTextEditor_OnLoad(rteeditor)
		{
			editor = rteeditor;
			diveditor = document.getElementById("div_editor");
			if(divcontent)
				ShowEditor()
		}

		function GetEditorHTML() {
			if (!editor || !divcontent)
				return;
			diveditor.style.display = "none";
			divcontent.innerHTML = editor.GetText();
		}

		function ShowEditor()
		{
			var t = divcontent.offsetTop;
			var l = divcontent.offsetLeft;
			diveditor.style.display = "";
			diveditor.style.zIndex = "9";
			diveditor.style.left = l + "px";
			diveditor.style.top = t + "px";
			editor.SetText(divcontent.innerHTML);
		}
		function EditMe(_div) {
			divcontent = _div;			
			if(editor)
				ShowEditor()
			else if(loader)
				loader.load();
		}
	</script>
</head>
<body>
        <h1>
			One Editor, Multiple Edit Areas</h1>
		<p>
			This example demonstrates how to have one Editor instance control different editable
			areas on a page. Double click any of the areas below to edit it's content. Then
			click the collapse button in the toolbar to remove the editor.
			<br />
		</p>
		<br />
		<div style="position: relative;">
			<div id="div_editor" style="display: none; position: absolute; background: white;
				left: 0px; top: 0px; border: 1px solid gray;">				
                <?php
                echo $rte->GetString();
                ?>
				<button type="button" onclick="GetEditorHTML();">
					Submit</button>
			</div>
			<div class="content" ondblclick="EditMe(this);">
				#1. Double click me to edit the contents</div>
			<br />
			<div class="content" ondblclick="EditMe(this);">
				#2. Double click me to edit the contents</div>
			<br />
			<div class="content" ondblclick="EditMe(this);">
				#3. Double click me to edit the contents</div>
			<br />
			<div class="content" ondblclick="EditMe(this);">
				#4. Double click me to edit the contents</div>
		</div>
</body>
</html>