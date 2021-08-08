<?php require_once "../richtexteditor/include_rte.php" ?>
<?php
    $rte=new RichTextEditor();
    $rte->Text="Type here";
	$rte->ContentCss="example.css";
    $rte->MvcInit();
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Default Toolbar Config</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
</head>
<body>
        <h1>
            Default Toolbar Config</h1>
        <p>
            This example simply shows the default toolbar config.
        </p>
        <?php


        echo $rte->GetString();
        ?>
</body>
</html>