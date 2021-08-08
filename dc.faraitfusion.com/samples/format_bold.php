<?php require_once "../richtexteditor/include_rte.php" ?>
          
<?php
	$rte=new RichTextEditor();
        
	$type = $_GET["type"];
	if(strlen($type)>0)
	{
		if ($type == "b")
		{
			$rte->SetConfig("format_bold", "<b>");
		}
		else if ($type == "span")
		{
			$rte->SetConfig("format_bold", "<span style='font-weight:bold'>");
		}
	} 
	$rte->Text="Type here";
	$rte->MvcInit();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Formatting bold button</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
    <script type="text/javascript" src="../changeurlparam.js"></script>
    <script type="text/javascript">
		var editor;
		function RichTextEditor_OnLoad(rteeditor) {
			editor = rteeditor;
			editor.AttachEvent("TextChanged", ShowHtml);
		}
		function ShowHtml() {
			if (!editor)			return;
			var c = editor.GetText();
			if(!c) {
				document.getElementById("result").innerHTML = ""; 
				return;
			}
			document.getElementById("result").innerHTML = c.replace(/</g,"&lt;");
		}
	</script>
</head>
<body>
        <h1>
			Formatting bold button</h1>
		<p>
			RichTextEditor enables you to override and define you own custom format tags. By
			default, when you use the Bold button on the toolbar, RichTextEditor inserts a set
			of &lt;strong&gt;tags to format the selected text. The &lt;strong&gt; tags are the
			current standard for marking text as bold. If you prefer to use the &lt;b&gt;tags
			or CSS "font-weight" property instead, you can change the editor configuration to
			change the behavior of bold button.
		</p>
        <div>
            <div>
            <input type="radio" id="radio_1" name="type" value="" onclick="ChangeType(this.value);"/>
            <label for="radio_1">Default: &lt;strong&gt;</label>
            <input type="radio" id="radio_2" name="type" value="b" onclick="ChangeType(this.value);"/>
            <label for="radio_2">&lt;b&gt;</label>
            <input type="radio" id="radio_3" name="type" value="span" onclick="ChangeType(this.value);"/>
            <label for="radio_3">&lt;span style='font-weight:bold'&gt;</label>
            </div>
            <br/>            
            <?php
            echo $rte->GetString();
            ?>
        </div>
        <br />
		<div>
			<h3>
				Result html code:</h3>
			<div id="result">
			</div>
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
</body>
</html>