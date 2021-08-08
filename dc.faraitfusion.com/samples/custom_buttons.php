<?php require_once "../richtexteditor/include_rte.php" ?>

<?php
	$rte=new RichTextEditor();
	$rte->Text="Type here";
	$rte->ToolbarItems = "{bold,italic,underlinemenu}{forecolor,backcolor,fontname,fontsize}{justifyleft,justifycenter,justifyright,justifyfull}{insertorderedlist,insertunorderedlist,outdent,indent}{insertlink,insertimage,insertblockquote,syntaxhighlighter}{unlink,removeformat}//{mybutton1}";
	$rte->MvcInit();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Custom buttons</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
</head>
<body>
        <script type="text/javascript">
		var loader;
		var editor;

		function RichTextEditor_OnCoreLoad(rteloader) {
			loader = rteloader;

			var config = loader._config;
			var toolbar = config._toolbartemplate || config.toolbar;
			//mybutton1 is added in Editor1.ToolbarItems
			var btnname = "item_" + toolbar + "_" + config.skin + "_" + config.color + "_mybutton1";
			var basetype = "image_" + config.skin + "_" + config.color;

			var define = jsml.class_define(btnname, basetype);
			define.constructor(function () {
				this[basetype + "_constructor"]();
				this.set_imagename("openfolder");
				this.set_tooltip("My custom button!");
			});
			define.attach("click", function () {
				if (!editor) return;
				
				alert("You clicked a custom button");
				
				editor.AppendHTML("<hr /> You clicked a custom button");
			});
		}

		function RichTextEditor_OnLoad(rteeditor) {
			editor = rteeditor;
		}
		</script>

		<h1>
			Add custom buttons</h1>
		<p>
			The Rich Text Editor allows you extend the functions of the editor. You can create
			new custom buttons and add them to the editor's toolbar list.
		</p>
        <?php
        echo $rte->GetString();
        ?>
</body>
</html>