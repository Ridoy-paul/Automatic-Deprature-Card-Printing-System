<?php require_once "../richtexteditor/include_rte.php" ?>

<?php
	$rte=new RichTextEditor();
        
	$type = $_GET["type"];
	if(strlen($type)>0)
	{
		$rte->ContextMenuMode=$type;
	} 
	$rte->Text="Type here";
	$rte->MvcInit();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - ContextMenu mode</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
    <script type="text/javascript" src="../changeurlparam.js"></script>
</head>
<body>
        <h1>
			Context menu customization</h1>
		<p>
			RichTextEditor is a context sensitive application, it is aware of it's context and
			acts accordingly. There are many ways to control the context menu behaviors within
			RichTextEditor:
		</p>
        <div>
            <input type="radio" id="radio_1" name="type" value="" onclick="ChangeType(this.value);"/>
            <label for="radio_1">Default</label>
            <input type="radio" id="radio_2" name="type" value="simple" onclick="ChangeType(this.value);"/>
            <label for="radio_2">Simple</label>
            <input type="radio" id="radio_3" name="type" value="minimal" onclick="ChangeType(this.value);"/>
            <label for="radio_3">Minimal</label>
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