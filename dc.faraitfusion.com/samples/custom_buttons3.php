<?php require_once "../richtexteditor/include_rte.php" ?>

<?php

	$rte=new RichTextEditor();
	$rte->Text="Type here";
	$rte->Name="Editor1";
	$rte->ToolbarItems = "{bold,italic,underlinemenu}{forecolor,backcolor,fontname,fontsize}{justifyleft,justifycenter,justifyright,justifyfull}{insertorderedlist,insertunorderedlist,outdent,indent}{insertlink,insertimage,insertblockquote,syntaxhighlighter}{unlink,removeformat}//{mypanel1}";
        
        
	$rte->MvcInit();
	

	if(strlen($_REQUEST["_status"])>0)
	{
		$rte->Text = $rte->Text . "<hr/> server button clicked.";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Custom buttons</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
    <style>
	.serverbtn
	{
		height:20px;
	}
	</style>

	<script type="text/javascript">
		var loader;
		var editor;
		

		function RichTextEditor_OnCoreLoad(rteloader) {
			loader = rteloader;

			var config = loader._config;
			var toolbar = config._toolbartemplate || config.toolbar;

			var panel1 = "item_" + toolbar + "_" + config.skin + "_" + config.color + "_mypanel1";
			var define1 = jsml.class_define(panel1, "htmlcontrol");
			define1.constructor(function () {
				this["htmlcontrol_constructor"]();
				this.set_dock("left");
				var custdiv = document.getElementById("div_custom");
				this._content.appendChild(custdiv);
				custdiv.style.display="";
			});
			
		}

		function RichTextEditor_OnLoad(rteeditor) {
			editor = rteeditor;
		}

	</script>
</head>
<body>
    <form action="custom_buttons3.php" method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"])?>">
		<h1>
			Adding custom buttons (server)</h1>
		<p>
			The Rich Text Editor allows you extend the functions of the editor. You can create
			new custom buttons and add them to the editor's toolbar list.
		</p>
        <div id="div_custom" style="display: none;">
			<button id="Button1" CssClass="serverbtn">
                server button1
            </button>
		</div>
        <?php
        echo $rte->GetString();
        ?>
        <div>
            <input type="hidden" name="_status" value="1"/>
        </div>
     </form>
</body>
</html>