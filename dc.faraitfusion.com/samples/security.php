<?php require_once "../richtexteditor/include_rte.php" ?>
<?php
    $rte=new RichTextEditor();  
    $rte->Name = "Editor1";
	$rte->ContentCss="example.css";
    $type = $_GET["type"];
    $policyfiletext = "";
    $_store = "";
    $file;
    $storages;
    if(strlen($type)>0)
    {
        switch ($type)
        {
            case "Administrators":
                $rte->SecurityPolicyFile = "admin.config";
                $policyfiletext = "Policy file:" .$rte->SecurityPolicyFile. "<br/>";
                break;
            case "Members":
                $rte->SecurityPolicyFile = "default.config";
                $policyfiletext = "Policy file:" .$rte->SecurityPolicyFile. "<br/>";
                break;
            case "Guest":
                $rte->SecurityPolicyFile = "guest.config";
                $policyfiletext = "Policy file:" .$rte->SecurityPolicyFile. "<br/>";
                break;
            case "John":
                $rte->SecurityPolicyFile = "admin.config";
                $file = $rte->LoadConfigFile();
                $storages = $file->GetItems("Gallery", false, true);
                $_store = $storages[1]->StoragePath . "/John";
                $rte->SetSecurity("Gallery", "*", "StoragePath", $_store);
                $policyfiletext = "Policy file:" .$rte->SecurityPolicyFile. "<br/> Gallery:" . $_store;
                break;
            case "Mary":
                $rte->SecurityPolicyFile = "default.config";
                $file = $rte->LoadConfigFile();
                $storages = $file->GetItems("Gallery", false, true);
                $_store = $storages[1]->StoragePath . "/Mary";
                $rte->SetSecurity("Gallery", "*", "StoragePath", $_store);
                $policyfiletext = "Policy file:" .$rte->SecurityPolicyFile. "<br/> Gallery:" . $_store;
                break;
            case "Tim":
                $rte->SecurityPolicyFile = "default.config";
                $file = $rte->LoadConfigFile();
                $storages = $file->GetItems("Gallery", false, true);
                $_store = $storages[1]->StoragePath . "/Tim";
                $rte->SetSecurity("Gallery", "*", "StoragePath", $_store);
                $policyfiletext = "Policy file:" .$rte->SecurityPolicyFile. "<br/> Gallery:" . $_store;
                break;
        }
    }
    $rte->MvcInit();
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RichTextEditor - Auto adjusting height</title>
    <link rel="stylesheet" href="../example.css" type="text/css" /> 
    <script type="text/javascript" src="../changeurlparam.js"></script>
</head>
<body>
        <h1>
			Personalization and Programmatic Security Example</h1>
		<p><strong>RichTextEditor is not a javascript editor.</strong> All security settings must be set in the server side. The Filter HTML code functionality in RTE allows you to accept HTML input from your users, filter it to make sure it contains only an allowed set of tags, attributes and values and then display it without leaving yourself open to XSS holes. RTE automatically <strong>detect the MIME type</strong> of the files you upload, and rejects the file if the file-extension does not match the mime type. <strong>What happen if someone renames .exe file extension as .jpg and uploads it to your server?</strong></p>
        <p>
            RTE also allows developers to assign a pre-defined set of permissions&nbsp;by&nbsp;group&nbsp;or
            individual. This prevents a normal user to access the administration functionality.
            The details of permissions are specified by an XML security policy file. Each level
            maps to a specific file. The default mappings:
        </p>
        <ul>
            <li>admin - maps to admin.config</li>
            <li>default - maps to default.config</li>
            <li>guest - maps to guest.config</li>
        </ul>
        <p>
            You can customize and extend each policy file by editing the XML security policy
            file. You can also create your own policy files that define arbitrary permission
            sets. <span class="parent" child="Security">Comparison of the sample security policy
                file</span>
        </p>
		<table>
			<tbody>
				<tr>
					<td>
						<table id="RadioList" bgcolor="#f5f5f5" border="0" style="width: 400px; border: #c0c0c0 1px solid;">
							<tbody>
								<tr>
									<td>
										<input id="RadioList_0" type="radio" name="type" value="Administrators" onclick="ChangeType(this.value);" /><label
											for="RadioList_0">
											Administrators</label>
									</td>
									<td>
										<input id="RadioList_1" type="radio" name="type" value="Members" onclick="ChangeType(this.value);"/><label
											for="RadioList_1">
											Members</label>
									</td>
									<td>
										<input id="RadioList_2" type="radio" name="type" value="Guest" onclick="ChangeType(this.value);"/><label
											for="RadioList_2">
											Guest</label>
									</td>
								</tr>
								<tr>
									<td>
										<input id="RadioList_3" type="radio" name="type" value="John" onclick="ChangeType(this.value);"/><label
											for="RadioList_3">
											John (admin)</label>
									</td>
									<td>
										<input id="RadioList_4" type="radio" name="type" value="Mary" onclick="ChangeType(this.value);"/><label
											for="RadioList_4">
											Mary (sales)</label>
									</td>
									<td>
										<input id="RadioList_5" type="radio" name="type" value="Tim" onclick="ChangeType(this.value);"/><label
											for="RadioList_5">
											Tim (financial)</label>
									</td>
								</tr>
							</tbody>
						</table>

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

					</td>
					<td width="10">
					</td>
					<td style="color: red">
						<?php echo $policyfiletext ?>
					</td>
				</tr>
			</tbody>
		</table>
                
        <?php echo $rte->GetString() ?>
</body>
</html>