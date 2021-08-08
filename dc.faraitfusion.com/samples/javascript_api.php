<?php require_once "../richtexteditor/include_rte.php" ?>

<?php
	$rte=new RichTextEditor();
	$rte->Text="<table cellspacing=\"4\" cellpadding=\"4\" border=\"0\"><tr><td><p><img src=\"http://www.richtexteditor.com/uploads/j0262681.jpg\" alt=\"\" /></p></td> <td> <p>When your algorithmic and programming skills have reached a level which you cannot improve any further, refining your team strategy will give you that extra edge you need to reach the top. We practiced programming contests with different team members and strategies for many years, and saw a lot of other teams do so too.</p></td></tr> <tr> <td> <p> <img src=\"http://www.richtexteditor.com/uploads/PH02366J.jpg\" alt=\"\" /></p></td> <td> <p>From this we developed a theory about how an optimal team should behave during a contest. However, a refined strategy is not a must: The World Champions of 1995, Freiburg University, were a rookie team, and the winners of the 1994 Northwestern European Contest, Warsaw University, met only two weeks before that contest.</p></td></tr></table>";
	$rte->Skin="smartsilver";
	$rte->Toolbar="minimal";
	$rte->Width="600px";
	$rte->Height = "300px";
	$rte->MvcInit();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Javascript api</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
    <script type="text/javascript">
		var editor;
		function RichTextEditor_OnLoad(rteeditor) {
			editor = rteeditor;
		}

		function ClientCommand(comm, type) {
			if (!editor) return;
			var divcode = document.getElementById("div_code");
			var txtarea = document.getElementById("txt_words");
			if (type == "command") {
				comm = document.getElementById("sel_command").value;
				editor.ExecCommand(comm);
				divcode.innerHTML = "editor.ExecCommand(\"" + comm + "\");";
				return;
			}
			switch (comm) {
				case "gethtml":
					txtarea.value = editor.GetText();
					divcode.innerHTML = "editor.GetText();";
					break;
				case "sethtml":
					editor.SetText(txtarea.value);
					divcode.innerHTML = "editor.SetText();";
					break;
				case "inserthtml":
					editor.InsertHTML(txtarea.value);
					divcode.innerHTML = "editor.InsertHTML();";
					break;
				case "movehome":
					editor.SetPointInside(editor.GetBodyNode(), 0);
					divcode.innerHTML = "editor.SetPointInside(editor.GetBodyNode(),0);";
					editor.Focus();
					break;
				case "moveend":
					editor.SetPointInside(editor.GetBodyNode(), editor.GetBodyNode().GetMaxOffset());
					divcode.innerHTML = "editor.SetPointInside(editor.GetBodyNode(), editor.GetBodyNode().GetMaxOffset());";
					editor.Focus();
					break;
				case "codetab":
					editor.ExecCommand("TabCode");
					divcode.innerHTML = "editor.ExecCommand(\"TabCode\");";
					break;
				case "attachtextchanged":
					editor.AttachEvent("TextChanged", ReadEditorText);
					break;
				case "detachtextchanged":
					editor.DetachEvent("TextChanged", ReadEditorText);
					txtarea.value = "";
					break;
				case "focus":
					editor.Focus();
					break;
			}
		}
		function ReadEditorText() {
			var txtarea = document.getElementById("txt_words");
			txtarea.value = editor.GetText();
		}
	</script>
</head>
<body>
        <h1>
            JavaScript API</h1>
        <p>
            This example shows you how to use RichTextEditor JavaScript API to customize the application.
        </p>
		<div>
            <?php
            echo $rte->GetString();
            ?>
		</div>
		<br />
		<div>
			<textarea id="txt_words" rows="4" style="width:595px;">Try click the "get HTML" button</textarea>
		</div>
		<br />
		<div id="div_code" style="padding:10px;border: solid 1px #cccccc; width: 580px; height: 40px; background-color: #ffffcc; overflow-y:auto; color:Blue;">
		</div>
		<br />
		<div>
			<button type="button" onclick="ClientCommand('gethtml','js');">get HTML</button>
			<button type="button" onclick="ClientCommand('sethtml','js');">set HTML</button>
			<button type="button" onclick="ClientCommand('inserthtml','js');">insert HTML</button>
			<button type="button" onclick="ClientCommand('codetab','js');">set Active Tab to Code</button>
			<button type="button" onclick="ClientCommand('focus','js');">set Focus</button>
			<br />
			<button type="button" onclick="ClientCommand('attachtextchanged','js');">attach Event(TextChanged)</button>
			<button type="button" onclick="ClientCommand('detachtextchanged','js');">detach Event(TextChanged)</button>
			<button type="button" onclick="ClientCommand('movehome','js');">move Home</button>
			<button type="button" onclick="ClientCommand('moveend','js');">move End</button>
		</div>
		<br />
		<div>
			<select id="sel_command">
				<option value="Bold">Bold</option>
				<option value="Italic">Italic</option>
				<option value="Delete">Delete</option>
				<option value="Undo">Undo</option>
				<option value="Redo">Redo</option>
				<option value="Underline">Underline</option>
				<option value="Linethrough">Linethrough</option>
				<option value="Overline">Overline</option>
				<option value="Superscript">Superscript</option>
				<option value="Subscript">Subscript</option>
				<option value="Ucase">Ucase</option>
				<option value="Lcase">Lcase</option>
				<option value="RemoveFormat">RemoveFormat</option>
				<option value="CleanCode">CleanCode</option>
				<option value="JustifyLeft">JustifyLeft</option>
				<option value="JustifyCenter">JustifyCenter</option>
				<option value="JustifyRight">JustifyRight</option>
				<option value="JustifyFull">JustifyFull</option>
				<option value="JustifyNone">JustifyNone</option>
				<option value="LTR">Left to Right</option>
				<option value="RTL">Right to Left</option>
				<option value="InsertWbr">InsertWbr</option>
				<option value="InsertDiv">InsertDiv</option>
				<option value="InsertParagraph">InsertParagraph</option>
				<option value="InsertHorizontalRule">InsertHorizontalRule</option>
				<option value="InsertPageBreak">InsertPageBreak</option>
				<option value="InsertTopLine">InsertTopLine</option>
				<option value="InsertBottomLine">InsertBottomLine</option>
				<option value="UnLink">UnLink</option>
				<option value="InsertOrderedList">InsertOrderedList</option>
				<option value="InsertUnorderedList">InsertUnorderedList</option>
			</select>
			<button type="button" onclick="ClientCommand(null,'command');">ExecCommand</button>
		</div>
</body>
</html>