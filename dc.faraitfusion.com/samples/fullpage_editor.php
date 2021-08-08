<?php require_once "../richtexteditor/include_rte.php" ?>
<?php

    $rte=new RichTextEditor();
    $htmltext = "";    
    $rte->Name = "Editor1";
	$rte->ContentCss="example.css";
    $rte->TagBlackList=""; 
    $rte->StyleBlackList="";  
    $rte->AllowScriptCode="true"; 
    $rte->EditCompleteDocument="true";
    $rte->Text = "<html>
        <head>
        </head>
        <body>
            <p>Rich Text Editor: Editing full page</p>
            <p style='font-weight:bold'>Editor1.AllowScriptCode = true;<br />
            Editor1.EditCompleteDocument = true;<br />
            Editor1.TagBlackList = &quot;&quot;;</p>
        </body>
    </html>
    ";
    $rte->MvcInit();
    

	
    $htmltext = htmlentities($rte->Text);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Edit full html</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
</head>
<body>
	<form action="fullpage_editor.php" method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"])?>">
        <h1>
		    Edit full html page</h1>
	    <p>
		    This example demonstrates you can use RichTextEditor to edit full html page.
	    </p>
        <div>            
            <?php
            echo $rte->GetString();
            ?>
            <br/>
		    <button type="submit">Submit</button>
        </div>
        <br/>
        <h3>HTML Code:</h3>
		<textarea style="height:120px;width:760px;"><?php echo $htmltext ?></textarea>
    </form>
</body>
</html>