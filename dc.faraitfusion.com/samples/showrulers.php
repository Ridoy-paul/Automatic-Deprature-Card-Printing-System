<?php require_once "../richtexteditor/include_rte.php" ?>

<?php
	$rte=new RichTextEditor();
	$rte->ShowRulers=true;
	$rte->Skin = "office2010blue2";
	$rte->Text="Type here";
	$rte->ContentCss="example.css";
	$rte->MvcInit();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Display the Ruler</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
</head>
<body>
        <h1>
            Use rulers for guidance</h1>
        <p>
            In RichTextEditor, you can use rulers guide your page layout in Design view. Rulers
			appear across the top and down the left side of the editing window.
        </p>
        <?php
        echo $rte->GetString();
        ?>
</body>
</html>