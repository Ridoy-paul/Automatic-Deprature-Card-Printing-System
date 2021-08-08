<?php require_once "../richtexteditor/include_rte.php" ?>
<?php
	$rte=new RichTextEditor();

	$type = $_GET["type"];
	if(strlen($type)>0)
	{
		$rte->ResizeMode=$type;
	}
	else
	{
		$rte->ResizeMode="autoadjustheight";
	}

	$rte->Text="Type here";
	$rte->MvcInit();
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Auto adjusting height</title>
    <link rel="stylesheet" href="../example.css" type="text/css" /> 
    <script type="text/javascript" src="../changeurlparam.js"></script>
	<script type="text/javascript">
		var editor;
		function RichTextEditor_OnLoad(rteeditor) {
			editor = rteeditor;
		}
		function GetEditorHTML() {
			if (!editor) return;
			document.getElementById("result").innerHTML = editor.GetText();
		}
	</script>
</head>
<body>
        <h1>
            Editor Auto Adjusting Height</h1>
        <p>
            This example demonstrates how to use Editor.ResizeMode to make the Editor change
            its height based on the content. The Editor will now grow and shrink in height to
            match the content inside.
        </p>
        <div>
            <div>
                <input type="radio" id="radio_2" name="type" value="disabled" onclick="ChangeType(this.value);"/>
                <label for="radio_2">Disabled</label>
                <input type="radio" id="radio_3" name="type" value="autoadjustheight" checked="true" onclick="ChangeType(this.value);"/>
                <label for="radio_3">AutoAdjustHeight</label>
                <input type="radio" id="radio_4" name="type" value="resizeheight" onclick="ChangeType(this.value);"/>
                <label for="radio_4">ResizeHeight</label>
                <input type="radio" id="radio_5" name="type" value="resizewidth" onclick="ChangeType(this.value);"/>
                <label for="radio_5">ResizeWidth</label>
                <input type="radio" id="radio_6" name="type" value="resizeboth" onclick="ChangeType(this.value);"/>
                <label for="radio_6">ResizeBoth</label>
            </div>
            <script type="text/javascript">
                function InitParams()
                {
                    var pv = geturlparam("type") || "";
                    //if(!pv) return;
                    var radios = document.getElementsByName("type");
                    for(var i=0;i<radios.length;i++)
                    {
                        var radio = radios[i];
                        if(radio.value == pv)
                        {
                            radio.checked = true;
                            break;
                        }
                    }
                }
                InitParams();
    
                function ChangeType(v)
                {
                    changeurlparam("type", v);
                }
            </script>
            <br />
            <?php
                echo $rte->GetString();
            ?>
            <br />
            <div>
                <button type="button" onclick="GetEditorHTML();">
                    Get Content</button>
            </div>
        </div>
        <br />
        <div>
            <h3>
                Result html:</h3>
            <div id="result">
            </div>
        </div>
</body>
</html>