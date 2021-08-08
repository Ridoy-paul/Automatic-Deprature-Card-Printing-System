<?php require_once "../richtexteditor/include_rte.php" ?>

<?php
    $rte=new RichTextEditor();
    $rte->Text="Type here";
    $rte->Name="Editor1";
    $rte->Height="200px";
    $rte->Skin="officexpsilver";
    $rte->Toolbar="minimal";
    $rte->MvcInit();
    

    $rte2=new RichTextEditor();
    $rte2->Text="Type here";
    $rte2->Name="Editor2";
    $rte2->Height="200px";
    $rte2->Skin="officexpblue";
    $rte2->Toolbar="email";
    $rte2->MvcInit();
    $rte2->RenderSupportAjax=false;

    $rte3=new RichTextEditor();
    $rte3->Text="Type here";
    $rte3->Name="Editor3";
    $rte3->Height="200px";
    $rte3->Skin="office2003silver2";
    $rte3->Toolbar="forum";
    $rte3->MvcInit();
    $rte3->RenderSupportAjax=false;

    $rte4=new RichTextEditor();
    $rte4->Text="Type here";
    $rte4->Name="Editor4";
    $rte4->Height="200px";
    $rte4->Skin="office2003blue";
    $rte4->Toolbar="light";
    $rte4->MvcInit();
    $rte4->RenderSupportAjax=false;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>RichTextEditor - Default Toolbar Config</title>
	<link rel="stylesheet" href="../example.css" type="text/css" />
</head>
<body>
		<h1>
			Simple Configuration example</h1>
		<p>
			This example shows the simple Configuration of editor.
		</p>
        <?php
        echo $rte->GetString();
        ?>
		<br />
        <?php
        echo $rte2->GetString();
        ?>
		<br />
        <?php
        echo $rte3->GetString();
        ?>
		<br />
        <?php
        echo $rte4->GetString();
        ?>
</body>
</html>