<?php require_once "../richtexteditor/include_rte.php" ?>
<?php
$rte=new RichTextEditor();
$rte->MvcInit();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Editor as file selector</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
    <script type="text/javascript">
		var editor;
		var showed = false;
		function RichTextEditor_OnLoad(rteeditor) {
			editor = rteeditor; 
			if (showed)
				ShowEditorFileSelector()
		}
		function RichTextEditor_OnLoader(loader) {
			var config = loader._config;
			config.showtoolbar = false;
			config.showtoolbar_code = false;
			config.showbottombar = false;
			config.preloadplugins = "";
			var div = document.getElementById(config.containerid);
			div.style.display = "none";
		}
		function ShowEditorFileSelector() {
			showed = true;
			if (editor) {
				editor.ExecUICommand(null, "InsertDocument");
			}
		}
		function OnGetFileUrl(src) {
			document.getElementById("result").innerHTML = "You selected : " + src;
		}
		function RichTextEditor_OnTagDialogEnd(editor, info) {
			if (!showed) return;
			showed = false;
			document.getElementById("result").innerHTML = "";
			if (!info.Arguments[2])
				return;
			var link=editor.IsIncludedByTag("a");
			if (link)
			{
				var src = link.GetAttribute("href");
				OnGetFileUrl(src);
			}
			editor.SetText("");
		}
	</script>
</head>
<body>
        <h1>
		    Use RichTextEditor as file selector</h1>
	    <p>
	    </p>
	    <div style="display:none;">
		     <?php
             echo $rte->GetString();
            ?>
	    </div>
	    <br />
	    <div>
		    <button type="button" onclick="ShowEditorFileSelector();return false;">Select File</button>
	    </div>
	    <br />
	    <div id="result"></div>
</body>
</html>