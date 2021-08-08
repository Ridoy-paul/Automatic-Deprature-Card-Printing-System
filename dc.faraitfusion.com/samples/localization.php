<?php require_once "../richtexteditor/include_rte.php" ?>
<?php
$rte=new RichTextEditor();
$editortext = "";
$rte->Name = "Editor1";
$rte->Height = "300px";
$type = $_GET["type"];
$rte->ContentCss="example.css";
if(strlen($type)>0)
{
    $rte->Language = $type;
}
$rte->MvcInit();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Localization</title>
    <link rel="stylesheet" href="../example.css" type="text/css" />
    <script type="text/javascript" src="../changeurlparam.js"></script>
</head>
<body>
	<form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"])?>">
       <h1>
			Built-in localization for French, Spanish, and German ...</h1>
		<p>
			RichTextEditor auto-detects Client Browser's culture setting to decide what language
			to use. If developers need server side control, we also provide API to override
			the setting acquired from client browsers(shown in example below).</p>				
        <div style="border: #c0c0c0 1px solid; background-color: #f5f5f5; padding:5px;">
            <input type="radio" id="radio_1" name="type" value="en" onclick="ChangeType(this.value);"/>
            <label for="radio_1">English</label>
            <input type="radio" id="radio_2" name="type" value="fr-FR" onclick="ChangeType(this.value);"/>
            <label for="radio_2">French</label>
            <input type="radio" id="radio_3" name="type" value="de-de" onclick="ChangeType(this.value);"/>
            <label for="radio_3">German</label>
            <input type="radio" id="radio_4" name="type" value="nl-NL" onclick="ChangeType(this.value);"/>
            <label for="radio_4">Dutch</label>
            <input type="radio" id="radio_5" name="type" value="es-ES" onclick="ChangeType(this.value);"/>
            <label for="radio_5">Spanish</label>
            <input type="radio" id="radio_6" name="type" value="it-IT" onclick="ChangeType(this.value);"/>
            <label for="radio_6">Italian</label>
            <input type="radio" id="radio_7" name="type" value="nb-NO" onclick="ChangeType(this.value);"/>
            <label for="radio_7">Norwegian</label>
            <br/>
            <input type="radio" id="radio_8" name="type" value="ru-RU" onclick="ChangeType(this.value);"/>
            <label for="radio_8">Russian</label>
            <input type="radio" id="radio_9" name="type" value="ja-JP" onclick="ChangeType(this.value);"/>
            <label for="radio_9">Japanese</label>
            <input type="radio" id="radio_10" name="type" value="zh-cn" onclick="ChangeType(this.value);"/>
            <label for="radio_10">Chinese</label>
            <input type="radio" id="radio_11" name="type" value="sv-SE" onclick="ChangeType(this.value);"/>
            <label for="radio_11">Swedish</label>
            <input type="radio" id="radio_12" name="type" value="pt-BR" onclick="ChangeType(this.value);"/>
            <label for="radio_12">Portuguese</label>
            <input type="radio" id="radio_13" name="type" value="da" onclick="ChangeType(this.value);"/>
            <label for="radio_13">Danish</label>
            <input type="radio" id="radio_14" name="type" value="he-IL" onclick="ChangeType(this.value);"/>
            <label for="radio_14">Hebrew</label>
            <br/>
            <input type="radio" id="radio_15" name="type" value="ar" onclick="ChangeType(this.value);"/>
            <label for="radio_15">Arabic</label>
            <input type="radio" id="radio_16" name="type" value="cs" onclick="ChangeType(this.value);"/>
            <label for="radio_16">CZech</label>
            <input type="radio" id="radio_17" name="type" value="tr-TR" onclick="ChangeType(this.value);"/>
            <label for="radio_17">Turkey</label>
            <input type="radio" id="radio_18" name="type" value="vi" onclick="ChangeType(this.value);"/>
            <label for="radio_18">Vietnam</label>
            <input type="radio" id="radio_19" name="type" value="th" onclick="ChangeType(this.value);"/>
            <label for="radio_19">Thai</label>
            <input type="radio" id="radio_20" name="type" value="ko-KR" onclick="ChangeType(this.value);"/>
            <label for="radio_20">Korean</label>
            <input type="radio" id="radio_21" name="type" value="" onclick="ChangeType(this.value);"/>
            <label for="radio_21">Auto Detect</label>
        </div>
        <br/>
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
        <div>            
            <?php
            echo $rte->GetString();
            ?>
            <br/>
        </div>
    </form>
</body>
</html>