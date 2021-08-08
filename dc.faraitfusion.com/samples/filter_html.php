<?php require_once "../richtexteditor/include_rte.php" ?>
<?php
    $rte=new RichTextEditor();
    $rte->Name="Editor1";
    $type = $_GET["type"];
    if(strlen($type)>0)
    {
        if ($type == "no")
        {
            $rte->TagBlackList = "*";
        }
        if ($type == "white")
        {
            $rte->TagWhiteList = "embed";
        }
        if ($type == "black")
        {
            $rte->TagBlackList = "div";
        }	
        if ($type == "full")
        {
            $rte->AllowScriptCode = true;
            $rte->EditCompleteDocument = true;
            $rte->TagBlackList = "";
        }
    } 
    $rte->Text="<table cellspacing=\"4\" cellpadding=\"4\" border=\"0\"><tr><td><p><img src=\"http://www.richtexteditor.com/uploads/j0262681.jpg\" alt=\"\" /></p></td> <td> <p>When your algorithmic and programming skills have reached a level which you cannot improve any further, refining your team strategy will give you that extra edge you need to reach the top. We practiced programming contests with different team members and strategies for many years, and saw a lot of other teams do so too.</p></td></tr> <tr> <td> <p> <img src=\"http://www.richtexteditor.com/uploads/PH02366J.jpg\" alt=\"\" /></p></td> <td> <p>From this we developed a theory about how an optimal team should behave during a contest. However, a refined strategy is not a must: The World Champions of 1995, Freiburg University, were a rookie team, and the winners of the 1994 Northwestern European Contest, Warsaw University, met only two weeks before that contest.</p></td></tr></table>";
    $rte->MvcInit();
    

    $htmltext = htmlentities($rte->Text);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Filtering HTML code</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
    <script type="text/javascript" src="../changeurlparam.js"></script>
</head>
<body>
	<form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"])?>">
        <h1>
			How to Filtering HTML code in Rich Text Editor?</h1>
		<p>
			The new Filtering HTML code functionality in Rich Text Editor 8 allows you to accept
			HTML input from your users, filter it to make sure it contains only an allowed set
			of tags, attributes and values and then display it without leaving yourself open
			to XSS holes.</p>
		<p>
			The possible options are:</p>
		<ul>
			<li>TagWhiteList - Allows you set a list of html tags that will not be removed from
				content sources. </li>
			<li>TagBlackList - Allows you set a list of html tags that will be removed from content
				sources. </li>
			<li>AttrWhiteList - Allows you set a list of html attributes that will not be removed
				from content sources. </li>
			<li>AttrBlackList - Allows you set a list of html attributes that will be removed from
				content sources. </li>
			<li>StyleWhiteList - Allows you set a list of style attributes that will not be removed
				from content sources. </li>
			<li>StyleBlackList - Allows you set a list of style attributes that will be removed
				from content sources.</li>
			<li>No HTML - All the HTML code will be filtered.</li>
			<li>Full HTML - The filtering is disabled. Usually this option can be used for for trusted
				users.</li>
		</ul>
        <div>
            <div>
                <input type="radio" id="radio_1" name="type" value="" onclick="ChangeType(this.value);"/>
                <label for="radio_1">Default</label>
                <input type="radio" id="radio_2" name="type" value="black" onclick="ChangeType(this.value);"/>
                <label for="radio_2">Black list : div</label>
                <input type="radio" id="radio_3" name="type" value="white" onclick="ChangeType(this.value);"/>
                <label for="radio_3">White list : embed</label>
                <input type="radio" id="radio_4" name="type" value="no" onclick="ChangeType(this.value);"/>
                <label for="radio_4">No html</label>
                <input type="radio" id="radio_5" name="type" value="full" onclick="ChangeType(this.value);"/>
                <label for="radio_5">Full html</label>
            </div>
            <br/>            
            <?php                
                echo $rte->GetString();
            ?>
            <br/>
		    <button type="submit">Submit</button>
        </div>
        <br/>
		<div>
			<h3>
				Result html code:</h3>
			<div>
				<?php echo $htmltext ?>
			</div>
		</div>
        <script type="text/javascript">
            function InitParams()
            {
                var pv = geturlparam("type") || "";
                //if(!pv) return;
                var radios = document.getElementsByName("type");
                for(var i=0;i<radios.length;i++)
                {
                    var radio = radios[i];
                    if(radio.value == pv)
                    {
                        radio.checked = true;
                        break;
                    }
                }
            }
            InitParams();
    
            function ChangeType(v)
            {
                changeurlparam("type", v);
            }
        </script>
    </form>
</body>
</html>