<?php require_once "../richtexteditor/include_rte.php" ?>


<?php
	$rte=new RichTextEditor();
        
	$type = $_GET["type"];
	if(strlen($type)>0)
	{
		$rte->EnterKeyTag=$type;
	}  
	$rte->Text="Type here";
	$rte->MvcInit();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Enter mode</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
    <script type="text/javascript" src="../changeurlparam.js"></script>
</head>
<body>
        <h1>
			Enter Mode: Paragraph or LineBreak?</h1>
		<p>
			Rich Text Editor can be configured to define the behaviour of the ENTER KEY. You
			use &lt;p&gt;, &lt;br /&gt; or &lt;div&gt; tags when you press enter. In either
			mode &lt;br&gt; tags can be created by using shift+enter.</p>
        <div>
            <input type="radio" id="radio_1" name="type" value="" onclick="ChangeType(this.value);"/>
            <label for="radio_1">Default</label>
            <input type="radio" id="radio_2" name="type" value="p" onclick="ChangeType(this.value);"/>
            <label for="radio_2">P</label>
            <input type="radio" id="radio_3" name="type" value="br" onclick="ChangeType(this.value);"/>
            <label for="radio_3">BR</label>
            <input type="radio" id="radio_4" name="type" value="div" onclick="ChangeType(this.value);"/>
            <label for="radio_4">DIV</label>
        </div>
        <br/>
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
        <?php
        echo $rte->GetString();
        ?>
</body>
</html>