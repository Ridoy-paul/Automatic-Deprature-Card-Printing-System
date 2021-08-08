<?php require_once "../richtexteditor/include_rte.php" ?>

<?php
	$rte=new RichTextEditor();
        
	$type = $_GET["type"];
	if(strlen($type)>0)
	{
		$rte->DesignDocType=$type;
	} 
	$rte->ContentCss="example.css";
	$rte->Text="Type here";
	$rte->MvcInit();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - DesignDocType</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
    <script type="text/javascript" src="../changeurlparam.js"></script>
</head>
<body>
        <h1>
            Design DocType</h1>
        <p>
        </p>
        <div>
            <input type="radio" id="radio_1" name="type" value="" onclick="ChangeType(this.value);"/>
            <label for="radio_1">Default</label>
            <input type="radio" id="radio_2" name="type" value="html4" onclick="ChangeType(this.value);"/>
            <label for="radio_2">HTML4</label>
            <input type="radio" id="radio_3" name="type" value="html5" onclick="ChangeType(this.value);"/>
            <label for="radio_3">HTML5</label>
            <input type="radio" id="radio_4" name="type" value="xhtml" onclick="ChangeType(this.value);"/>
            <label for="radio_4">XHTML</label>
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