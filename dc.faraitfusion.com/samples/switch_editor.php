<?php require_once "../richtexteditor/include_rte.php" ?>
<?php
	$rte=new RichTextEditor(); 
	$rte->Name = "rteeditor";
	$rte->ContentCss="example.css";
	$rte->Height = "360px";
	$rte->Width = "750px";
	$rte->MvcInit();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>RichTextEditor - Plain Text Switcher</title>
    <link rel="stylesheet" href="../example.css" type="text/css" /> 
    <script type="text/javascript" src="../changeurlparam.js"></script>
</head>
<body>
	<form id="form1" action="switch_editor.php" method="POST" action="<?php echo htmlentities($_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"])?>">
		<h1>
			Plain Text Switcher</h1>
		<p>
			This example demonstrates how to toggle from a plain text field to the Rich Text
			Editor with a simple button click.</p>
		<button type="button" onclick="DoToggle();">Toggle Editor</button>
		<br />
        <?php
        
        $type = $_REQUEST["toggletype"];
        $editortext = $_REQUEST["rteeditor"];
        $paneltext = $_REQUEST["textpanel"];
        $loadedtext;
        if(strlen($type)>0 && $type=="toggle")
        {
            $loadedtext = $paneltext;
            $rte->Text = $loadedtext;
            echo $rte->GetString();
        }
        else
        {
            $loadedtext  = $editortext;
        }        
        ?>
		<textarea id="textpanel" name="textpanel" style="height:360px; width:750px;">
		<?php echo html_entity_decode($loadedtext)?>
        </textarea>
        <input type="hidden" id="toggletype" name="toggletype"/>
        <script type="text/javascript">
            var toggle = '<?php echo  $type?>'||'';
            if(toggle && toggle == "toggle")
            {
                document.getElementById("textpanel").style.display = "none";
            }
            
            function DoToggle()
            {
                var form1 = document.getElementById("form1");
                var toggle_ele = document.getElementById("toggletype");
                if(!toggle)
                    toggle_ele.value = "toggle";
                else
                    toggle_ele.value = "";
                form1.submit();
            }
        </script>
	</form>
</body>
</html>