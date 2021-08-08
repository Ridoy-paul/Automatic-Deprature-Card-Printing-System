<?php require_once "../richtexteditor/include_rte.php" ?>

<?php
    $rte=new RichTextEditor();
	$rte->ContentCss="example.css";
        
    $type = $_GET["type"];
    if(strlen($type)>0)
    {
        $rte->URLType=$type;
    }
        
    $rte->Text="<div>
		<a href=\"some.htm\">This is a relative path</a><br />
		<br />
		<a href=\"/some.htm\">This is a Site Root Relative path</a>
		<br />
		<br />
		<a href=\"http://somesite/some.htm\">This is a absolute path.</a><br />
		<br />
		<a href=\"#tips\">This is a link to anchor.</a><br />
	</div>";
    $rte->MvcInit();
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Relative, Absolute URLs<</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
    <script type="text/javascript" src="../changeurlparam.js"></script>
</head>
<body>
       <h1>
		Relative or Absolute URLs, which do you prefer?</h1>
	    <p>
		    With RichTextEditor, you have the choice of using either a relative or absolute
		    URL.
	    </p>
        <div>
            <input type="radio" id="radio_null" name="type" value="" onclick="ChangeType(this.value);"/>
            <label for="radio_null">Default</label>
            <input type="radio" id="radio_1" name="type" value="absolute" onclick="ChangeType(this.value);"/>
            <label for="radio_1">Absolute URLs</label>
            <input type="radio" id="radio_2" name="type" value="siterelative" onclick="ChangeType(this.value);"/>
            <label for="radio_2">SiteRelative URLs</label>
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