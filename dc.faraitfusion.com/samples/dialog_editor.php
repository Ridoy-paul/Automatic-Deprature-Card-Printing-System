<?php require_once "../richtexteditor/include_rte.php" ?>
<?php
    $rte=new RichTextEditor();
    $rte->Text="Type here";
	$rte->ContentCss="example.css";
    $rte->Skin="smartsilver";
    $rte->MvcInit();
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Editor in a dialog</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
	<link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css" rel="stylesheet" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>

	<script type="text/javascript">
		var editor;
		function RichTextEditor_OnLoad(rteeditor) {
			editor = rteeditor;
		}
		$(function () {
			// Dialog
			$('#dialog').dialog({
				autoOpen: false,
				width: 800,
				buttons: {
					"Ok": function () {
						$("#result").html(editor.GetText());
						$(this).dialog("close");
					},
					"Cancel": function () {
						$(this).dialog("close");
					}
				}
			});

			// Dialog Link
			$('#dialog_link').click(function () {
				$('#dialog').dialog('open');
				return false;
			});

		});
	</script>
</head>
<body>
        <h1>
			Editor inside of a Dialog</h1>
		<p>
			This example shows a RichTextEditor inside of a jQuery Dialog Control.</p>
		<p>
			<button id="dialog_link">
				Show RichTextEditor in dialog</button></p>
        <div id="dialog" title="RichTextEditor in a jQuery Dialog" style="display: none;">
        <?php
        echo $rte->GetString();
        ?>
        </div>
        <br />
		<div>
			<h3>
				Dialog's post response will appear here after you submit the Dialog.:</h3>
			<div id="result">
			</div>
		</div>
</body>
</html>