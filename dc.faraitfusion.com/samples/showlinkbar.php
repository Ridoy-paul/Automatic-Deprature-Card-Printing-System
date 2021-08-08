<?php require_once "../richtexteditor/include_rte.php" ?>

<?php
	$rte=new RichTextEditor();   
	$rte->ContentCss="example.css";     
	$type = $_GET["type"];
	if(strlen($type)>0)
	{        
		if(strtolower($type)=="true"|| $type=="1")
			$rte->ShowLinkbar=true;
		else
			$rte->ShowLinkbar=false;
	}        
	$rte->Text="Type here";
	$rte->MvcInit();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Show or hide link editing box</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
    <script type="text/javascript" src="../changeurlparam.js"></script>
</head>
<body>
        <h1>
            Show or hide link editing box</h1>
        <p>
            When a hyperlink is selected, a link editing box will be displayed in the editor.
            You can turn it off by setting this property to "false".
        </p>
        <div>
            <input type="radio" id="radio_2" name="type" value="true" checked="true" onclick="ChangeType(this.value);"/>
            <label for="radio_2">True</label>
            <input type="radio" id="radio_3" name="type" value="false" onclick="ChangeType(this.value);"/>
            <label for="radio_3">False</label>
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