<?php require_once "../richtexteditor/include_rte.php" ?>

<?php        
	$rte=new RichTextEditor();
	$rte->ContentCss="example.css";
	$rte->Text="<p>First paragraph <b>editable</b>.</p><p contenteditable=\"false\">Second paragraph is read-only.</p><p>Third paragraph with <span contenteditable=\"false\"> non-editable content</span>.</p>";
	$rte->MvcInit();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - NonEditable contents</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
</head>
<body>
        <h1>
            NonEditable contents</h1>
        <p>
            This example displays how areas within an editor instance can be disabled from editing
            by specifying the standard-compliant contenteditable attribute on the element.
        </p>
        <?php
        echo $rte->GetString();
        ?>
</body>
</html>