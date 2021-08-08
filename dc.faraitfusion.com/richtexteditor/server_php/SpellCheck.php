<?php
error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>
      NetSpell
    </title>

    <meta name="content-type" content="text/html ;charset=Unicode" />
    <meta http-equiv="Page-Enter" content="blendTrans(Duration=0.1)" />
    <meta http-equiv="Page-Exit" content="blendTrans(Duration=0.1)" />
	<link href="../server/resx/dialog.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="spellChecker.js"></script>
    <script type="text/javascript">

      var editor=parent.rtespellcheckeditor;
      parent.rtespellcheckdialog.resize(420,320);

      window.onload = function()
      {
		  document.getElementById('txtHtml').value = editor.GetText();

		  var speller = new spellChecker( document.getElementById('txtHtml') ) ;
		  speller.spellCheckScript = 'server-scripts/spellchecker.php' ;
		  speller.OnFinished = speller_OnFinished ;
		  speller.openChecker() ;
      }

      function speller_OnFinished( numberOCorrections )
      {
		  if ( numberOCorrections > 0 )
		  editor.SetText( document.getElementById('txtHtml').value ) ;
		  do_Close();
      }
      function do_Close()
      {
			parent.rtespellcheckdialog.close();
      }
    </script>
  </head>
  <body>
    <input type="hidden" id="txtHtml" value="">
      <iframe id="spellchecker" src="blank.html" name="spellchecker" width="100%" height="100%" frameborder="0"></iframe>
    </body>
</html>
