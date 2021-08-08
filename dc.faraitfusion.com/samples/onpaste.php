<?php require_once "../richtexteditor/include_rte.php" ?>

<?php

	$rte=new RichTextEditor();
        
	$type = $_GET["type"];
	if(strlen($type)>0)
	{
		$rte->PasteMode=$type;
	} 
	$rte->Text="Type here";
	$rte->ContentCss="example.css";
	$rte->MvcInit();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Cleaning pasted content</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
    <script type="text/javascript" src="../changeurlparam.js"></script>
</head>
<body>
        <h1>
        Cleaning pasted content</h1>
        <p>
            By default, RichTextEditor will automatically detect/clean the dirty pasted content.
            You have full control over how contributors paste content into the Editor. For example,
            you can disable the paste function, force pasting as plain text or prompt the user
            about cleaning up the content when pasting from MS Word.
        </p>
        <div>
            <input type="radio" id="radio_1" name="type" value="" onclick="ChangeType(this.value);"/>
            <label for="radio_1">Default</label>
            <input type="radio" id="radio_2" name="type" value="disabled" onclick="ChangeType(this.value);"/>
            <label for="radio_2">Disabled</label>
            <input type="radio" id="radio_3" name="type" value="paste" onclick="ChangeType(this.value);"/>
            <label for="radio_3">Paste</label>
            <input type="radio" id="radio_4" name="type" value="pastetext" onclick="ChangeType(this.value);"/>
            <label for="radio_4">PasteText</label>
            <input type="radio" id="radio_5" name="type" value="pasteword" onclick="ChangeType(this.value);"/>
            <label for="radio_5">PasteWord</label>
            <input type="radio" id="radio_6" name="type" value="confirmword" onclick="ChangeType(this.value);"/>
            <label for="radio_6">ConfirmWord</label>
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