<?php require_once "../richtexteditor/include_rte.php" ?>
 <?php
    $rte=new RichTextEditor();
    $rte->Name="Editor1";
    $rte->Skin="office2003silver";
    $rte->Toolbar="email";
    $rte->Width="720px";
	$rte->Height="300px";
    $rte->Text="Tab #1 content";
    $rte->MvcInit();
    
	
    $rte2=new RichTextEditor();
    $rte2->Name="Editor2";
    $rte2->Skin="office2003blue";
    $rte2->Toolbar="email";
    $rte2->Width="720px";
    $rte2->Height="300px";
    $rte2->Text="Tab #2 content";
    $rte2->MvcInit();
    $rte2->RenderSupportAjax=false;
				 
    $rte3=new RichTextEditor();
    $rte3->Name="Editor3";
    $rte3->Skin="office2010blue2";
    $rte3->Toolbar="email";
    $rte3->Width="720px";
    $rte3->Height="300px";
    $rte3->Text="Tab #3 content";
    $rte3->MvcInit();
    $rte3->RenderSupportAjax=false;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Editor inside jQuery tabs</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

	<style type="text/css">
		#wrapper
		{
			width: 800px;
		}
		ul.tabs
		{
			width: 800px;
			margin: 0;
			padding: 0;
		}
		ul.tabs li
		{
			display: block;
			float: left;
			padding: 0 5px;
		}
		ul.tabs li a
		{
			display: block;
			float: left;
			padding: 5px;
			font-size: 0.8em;
			background-color: #e0e0e0;
			color: #666;
			text-decoration: none;
		}
		.selected
		{
			font-weight: bold;
		}
		.tab-content
		{
			clear: both;
			border: 1px solid #ddd;
			padding: 10px;
		}
	</style>

	<script type="text/javascript">
		$(document).ready(function () {
			$('.tabs a').click(function () {
				switch_tabs($(this));
			});

			switch_tabs($('.defaulttab'));
		});

		function switch_tabs(obj) {
			$('.tab-content').hide();
			$('.tabs a').removeClass("selected");
			var id = obj.attr("rel");
			$('#' + id).show();
			obj.addClass("selected");
		}
		var editors = [];
		function RichTextEditor_OnLoad(rteeditor) {
			editors.push(rteeditor);
		}

		function GetEditorHTML(num) {
			var editor;
			for (var i = 0; i < editors.length; i++) {
				if (editors[i]._config.skin_div.id.indexOf(num) >= 0) {
					editor = editors[i];
					break;
				}
			}
			$("#result").html(editor.GetText());
		}
	</script>
</head>
<body>
        <h1>
			Editor inside jQuery tabs</h1>
		<p>
			This example demonstrates how to render an Editor inside of jQuery tabs.
		</p>
		<div id="wrapper">
			<ul class="tabs">
				<li><a href="#" class="defaulttab" rel="tabs1">Tab #1</a></li>
				<li><a href="#" rel="tabs2">Tab #2</a></li>
				<li><a href="#" rel="tabs3">Tab #3</a></li>
			</ul>
			<div class="tab-content" id="tabs1">
                 <?php
                     echo $rte->GetString();
                ?>
				<div>
					<button type="button" onclick="GetEditorHTML('1');">
						Get Content</button></div>
			</div>
			<div class="tab-content" id="tabs2">                
                 <?php
                 echo $rte2->GetString();
                ?>
				<div>
					<button type="button" onclick="GetEditorHTML('2');">
						Get Content</button></div>
			</div>
			<div class="tab-content" id="tabs3">
            
                 <?php
                 echo $rte3->GetString();
                ?>
				<div>
					<button type="button" onclick="GetEditorHTML('3');">
						Get Content</button></div>
			</div>
		</div>
		<br />
		<div>
			<h3>
				Result html:</h3>
			<div id="result">
			</div>
		</div>    
</body>
</html>