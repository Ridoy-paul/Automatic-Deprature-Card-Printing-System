<?php require_once "../richtexteditor/include_rte.php" ?>
         
<?php
	$rte=new RichTextEditor();
	$bbcodetext = "";
	$rte->Text="<table cellspacing=\"4\" cellpadding=\"4\" border=\"0\"><tr><td><p><img src=\"http://www.richtexteditor.com/uploads/j0262681.jpg\" alt=\"\" /></p></td> <td> <p>When your algorithmic and programming skills have reached a level which you cannot improve any further, refining your team strategy will give you that extra edge you need to reach the top. We practiced programming contests with different team members and strategies for many years, and saw a lot of other teams do so too.</p></td></tr> <tr> <td> <p> <img src=\"http://www.richtexteditor.com/uploads/PH02366J.jpg\" alt=\"\" /></p></td> <td> <p>From this we developed a theory about how an optimal team should behave during a contest. However, a refined strategy is not a must: The World Champions of 1995, Freiburg University, were a rookie team, and the winners of the 1994 Northwestern European Contest, Warsaw University, met only two weeks before that contest.</p></td></tr></table>";
            
	$rte->Name = "Editor1";
	$rte->MvcInit();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - BBCode</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
</head>
<body>
	<form action="bbcode.php" method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"])?>">
        <h1>
			Output BBCode</h1>
		<p>
			This sample shows how to configure Rich Text Editor to output BBCode format instead
			of HTML. BBCode syntax is commonly used by forums and comment systems.
		</p>
        <div>            
            <?php
            echo $rte->GetString();
            ?>
            <br/>
		    <button type="submit">Submit</button>
        </div>
        <br/>
        <h3>BBCode:</h3>
		<textarea style="height:120px;width:760px;"><?php
                                                    if(@$_POST["Editor1"]!= "")
                                                    {
                                                        echo RTEBBCodeConverter::HTML2BBCode($rte->Text);
                                                    }
						?></textarea>
    </form>
</body>
</html>