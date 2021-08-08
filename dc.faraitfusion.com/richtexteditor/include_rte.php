<?php require_once "include_cs2.php" ?>
<?php require_once "server_php/phpuploader/include_phpuploader.php" ?>
<?php

error_reporting(E_ALL ^ E_NOTICE);

if(PhpUploader_GetNamespace()!="RTE")
	throw(new Exception("Uploader Namespace Error"));

if(!@$_SESSION)session_start();


// php.ini add line : extension="ext/php_gd2.dll"

function RTE_Impl_LoadImage($_x55)
{
	$_x22=pathinfo($_x55,PATHINFO_EXTENSION);
	switch(strtolower($_x22))
	{
		case "png":
			return imagecreatefrompng($_x55);
		case "gif":
			return imagecreatefromgif($_x55);
		case "jpg":
		case "jpeg":
		default:
			$name=strtolower(basename($_x55));
			if(strpos($name,".png"))
				return imagecreatefrompng($_x55);
			if(strpos($name,".gif"))
				return imagecreatefromgif($_x55);
			return imagecreatefromjpeg($_x55);
	}
}

function RTE_GetPhotoDimensions($_x55)
{
	$_x56=RTE_Impl_LoadImage($_x55);
	$_x57=array();
	$_x57["Width"]=imagesx($_x56);
	$_x57["Height"]=imagesy($_x56);
	imagedestroy($_x56);
	return $_x57;
}
function RTE_GenerateThumbnail($_x55,$_x58,$_x59,$_x60)
{
	$_x56=RTE_Impl_LoadImage($_x55);
	$_x61=imagecreatetruecolor($_x59,$_x60);
	imagecopyresized($_x61,$_x56,0,0,0,0,$_x59,$_x60,imagesx($_x56),imagesy($_x56));
	imagejpeg($_x61,$_x58);
	imagedestroy($_x56);
	imagedestroy($_x61);
}


class RichTextEditor extends CuteSoftLibrary
{
	//$_x62->Name same as $_x62->ID 
	
	public $Name="RichTextEditor";
	
	public $UploaderName;
	
	public $Version="2012010311";
	public $LoadDelay=8;
	public $RenderSupportAjax=true;
	
	public $Skin="office2007blue";
	public $Toolbar="ribbon";
	public $EnableDragDrop;
	
	public $Language;
	
	//properties
	public $ContentCss;
	public $ContentCssText;
	public $PreviewCss;
	public $PreviewCssText;
	public $ToolbarItems;
	public $DisabledItems;
	public $TextDirection;
	public $URLType;
	public $ResizeMode;
	public $PasteMode;
	public $EnterKeyTag;
	public $ShiftEnterKeyTag;
	public $EditorMode;
	public $FullScreen;
	public $ToggleBorder;
	public $ReadOnly;
	public $DesignDocType;
	public $SaveButtonScript;
	public $SaveButtonMode;
	public $ContextMenuMode;
	public $EnableContextMenu;
	public $EnableIEBorderRadius;
	public $EnableAntiSpamEmailEncoder;
	public $EnableObjectResizing;
	public $BaseHref;
	public $EditorBodyId;
	public $EditorBodyClass;
	public $EditorBodyStyle;
	public $DisableClassList;
	public $AutoParseClasses;
	public $MaxHTMLLength;
	public $MaxTextLength;
	public $AutoFocus;
	public $ShowRulers;
	public $ShowEditMode;
	public $ShowCodeMode;
	public $ShowPreviewMode;
	public $ShowTagList;
	public $ShowZoomView;
	public $ShowStatistics;
	public $ShowResizeCorner;
	public $ShowBottomBar;
	public $ShowLinkbar;
	public $ShowToolbar;
	public $ShowCodeToolbar;
	public $ShowPreviewToolbar;
	public $AllowScriptCode;
	public $UseHTMLEntities;
	public $EditCompleteDocument;
	public $TagWhiteList;
	public $TagBlackList;
	public $AttrWhiteList;
	public $AttrBlackList;
	public $StyleWhiteList;
	public $StyleBlackList;
	
	public $AjaxPostbackUrl;
	
	//properties end
	
	public $SecurityPolicyFile="default.config";
	
	public $Uploader;
	
	public $FilterBegin;
	public $FilterEnd;
	
	var $_text="";
	
	function get_XHTML()
	{
		return $this->ApplyFilter($this->_text,"ConvertToXHTML");
	}
	function get_Text()
	{
		return $this->_text;
	}
	function set_Text($_x63)
	{
		if(!$_x63)
		{
			$this->_text="";
		}
		else
		{
			$this->_text=$this->ApplyFilter($_x63);
		}
	}
	
  
	function ServerMapPath($_x64_path)
	{
		if(substr($_x64_path, 0, 1)!="/")
		{
			$ThisFileName = basename($_SERVER['PHP_SELF']); // get the file name
			$_x65 = str_replace($ThisFileName,"",$_SERVER['PHP_SELF']);   // get the directory path
			$_x64_path=$_x65.$_x64_path;
		}
		if(!(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'))
		{    
		  return $_SERVER["DOCUMENT_ROOT"].$_x64_path; 
		}
		else
		{
		  return ucfirst($_SERVER["DOCUMENT_ROOT"]).$_x64_path; 
		}
	}
	function LoadFile($FilePath)
	{
		$this-LoadHTML($FilePath);
	}	
	function LoadHTML($FilePath)
	{
		$FilePath=$this->ServerMapPath($FilePath);
		if (file_exists($FilePath) && is_readable ($FilePath)) 
		{
			$_x66="";
			$_x21_handle = fopen($FilePath, "r");
			while (!feof($_x21_handle)) {
				$_x66 .=fgets($_x21_handle);
			}
			fclose($_x21_handle);
			$this->Text=$_x66;
		}
		else
		{    
			if (!file_exists($FilePath))
			{
				$this->Text="File ".$FilePath." doesn't exist";
			}
			elseif (!is_readable($FilePath))
			{
				$this->Text="File ".$FilePath." is not readable.";
			}
		}    
	} 
	
	function LoadFormData($_x63)
	{
		if($_x63==null)return;
		$this->set_Text($_x63);
	}
	
	function __set($_x54,$_x67)
	{
		switch($_x54)
		{
			case "ID":
				$this->Name=$_x67;
				return;
			case "TempDirectory":
				$this->Uploader->TempDirectory=$_x67;
				return;
			case "Text":
			case "XHTML":
				$this->set_Text($_x67);
				return;
			
		}
		
		$this->$_x54=$_x67;
	}
	function __get($_x54)
	{
		switch($_x54)
		{
			case "ID":
				return $this->Name;
			case "TempDirectory":
				return $this->Uploader->TempDirectory;
			case "Text":
				return $this->get_Text();
			case "XHTML":
				return $this->get_XHTML();
		}
		
		return $this->$_x54;
	}
	
	
	
	
	var $RTEClient;
	
	function RichTextEditor()
	{
		$this->Uploader=new PhpUploader();
		$this->Uploader->ManualStartUpload=true;
		$this->Uploader->MultipleFilesUpload=true;
		$this->Uploader->AllowedFileExtensions="";	//,bmp
		$this->RTEClient=str_replace("\\","/",dirname(dirname(dirname($this->Uploader->ResourceDirectory)))."/");    
    ///$this->RTEClient=dirname($_SERVER['SCRIPT_NAME']).'/richtexteditor/';
		$this->Uploader->LicenseUrl=$this->RTEClient."load.php?type=license&_temp=".time();
	}
	
	function JSEncode($_x68)
	{
		$_x68=str_replace("\\","\\\\",$_x68);
		$_x68=str_replace("\r","\\\r",$_x68);
		$_x68=str_replace("\n","\\\n",$_x68);
		$_x68=str_replace("\"","\\\"",$_x68);
		$_x68=str_replace("'","\\'",$_x68);
		
		return $_x68;
	}
	
	public $TabSpaces;
	public $Width="775px";
	public $Height="320px";
	
	var $_configs=array();
	
	function SetConfig($name,$value)
	{
		$this->_configs[$name]=$value;
	}
	
	
	var $_seclist=array();

	function SetSecurity($category, $storageid, $_x71, $_x72)
	{
		if ($category == null)
			return;
		$category = trim($category);
		if(strlen($category)== 0)
			return;

		if (strpos($category,",")!==false)
		{
			foreach (explode(",",$category) as $_x73)
			{
				$this->SetSecurity($_x73, $storageid, $_x71, $_x72);
			}
			return;
		}

		$_x74 = new RTERuntimeSecurity();
		$_x74->category = $category;
		$_x74->storageid = $storageid;
		$_x74->name = $_x71;
		$_x74->value = $_x72;
		
		array_push($this->_seclist,$_x74);
	}
		
	function LoadConfigFile()
	{
		$_x21 = $this->WebToPhy($this->RTEClient . "config/" . $this->SecurityPolicyFile);
		$_x21 = new RTEConfigFile( $_x21 );
		
		if (count($this->_seclist)==0)
			return $_x21;

		foreach($this->_seclist as $_x74)
		{
			$_x75 = false;
			$_x76 = null;
			foreach ($_x21->_items as $cs)
			{
				if ($_x74->category != "*" && $_x74->category != $cs->Category)
					continue;
				if ($cs->StorageId == null && ($_x76 == null || $_x74->category == $cs->Category))
					$_x76 = $cs;
				if ($_x74->storageid != "*" && $_x74->storageid != $cs->StorageId)
					continue;
				$name=$_x74->name;
				$cs->SetValue($name,$_x74->value);
				$_x75 = true;
			}
			if (!$_x75 && $_x76 != null && $_x74->storageid != "*")
			{
				$cs = $_x76->Clone();
				$cs->StorageId = $_x74->storageid;
				if ($cs->StorageName == null)
					$cs->StorageName = $_x74->storageid;
				array_push($_x21->_items,$cs);
				$name=$_x74->name;
				$cs->$name=$_x74->value;
			}
		}

		return $_x21;
	}
	


	
	function GetInitScriptCode()
	{
		$_x78=array();

		$_x78["servertype"]="PHP";
		
		$_x78["folder"]=$this->RTEClient;
		$_x78["uniqueid"]=$this->Name;
		$_x78["containerid"]=$this->Name."_div";
		
		if($this->UploaderName)
			$_x78["uploaderid"]=$this->UploaderName;
		else
			$_x78["uploaderid"]=$this->Name."_uploader";
		
		$_x78["width"]=$this->Width;
		$_x78["height"]=$this->Height;
		
		$_x78["skin"]=$this->Skin;
		$_x78["toolbar"]=$this->Toolbar;
		$_x78["tabkeyhtml"]=$this->TabSpaces;
		
		$_x78["enabledragdrop"]=$this->EnableDragDrop;
		
		$_x78["contentcss"]=$this->ContentCss;
		$_x78["contentcsstext"]=$this->ContentCssText;
		$_x78["previewcss"]=$this->PreviewCss;
		$_x78["previewcsstext"]=$this->PreviewCssText;
		$_x78["toolbaritems"]=$this->ToolbarItems;
		$_x78["disableditems"]=$this->DisabledItems;
		$_x78["textdirection"]=$this->TextDirection;
		$_x78["urltype"]=$this->URLType;
		$_x78["resize_mode"]=$this->ResizeMode;
		$_x78["paste_default_command"]=$this->PasteMode;
		$_x78["enterkeytag"]=$this->EnterKeyTag;
		$_x78["shiftenterkeytag"]=$this->ShiftEnterKeyTag;
		$_x78["initialtabmode"]=$this->EditorMode;
		$_x78["initialfullscreen"]=$this->FullScreen;
		$_x78["initialtoggleborder"]=$this->ToggleBorder;
		$_x78["readonly"]=$this->ReadOnly;
		$_x78["designdoctype"]=$this->DesignDocType;
		$_x78["savebuttonscript"]=$this->SaveButtonScript;
		$_x78["savebuttonmode"]=$this->SaveButtonMode;
		$_x78["contextmenumode"]=$this->ContextMenuMode;
		$_x78["enablecontextmenu"]=$this->EnableContextMenu;
		$_x78["enableieborderradius"]=$this->EnableIEBorderRadius;
		$_x78["antispamemailencoder"]=$this->EnableAntiSpamEmailEncoder;
		$_x78["enableobjectresizing"]=$this->EnableObjectResizing; 
		$_x78["basehref"]=$this->BaseHref;   
		$_x78["editorbodyid"]=$this->EditorBodyId;   
		$_x78["editorbodyclass"]=$this->EditorBodyClass;   
		$_x78["editorbodystyle"]=$this->EditorBodyStyle;   
		$_x78["disableclasslist"]=$this->DisableClassList;   
		$_x78["autoparseclasses"]=$this->AutoParseClasses;   
		$_x78["maxhtmllength"]=$this->MaxHTMLLength;   
		$_x78["maxtextlength"]=$this->MaxTextLength;   
		$_x78["autofocus"]=$this->AutoFocus;	
		$_x78["showrulers"]=$this->ShowRulers; 
		$_x78["showeditmode"]=$this->ShowEditMode; 
		$_x78["showcodemode"]=$this->ShowCodeMode; 
		$_x78["showpreviewmode"]=$this->ShowPreviewMode; 
		$_x78["showtaglist"]=$this->ShowTagList; 
		$_x78["showzoomview"]=$this->ShowZoomView; 
		$_x78["showstatistics"]=$this->ShowStatistics; 
		$_x78["showresizecorner"]=$this->ShowResizeCorner; 
		$_x78["showbottombar"]=$this->ShowBottomBar; 
		$_x78["showlinkbar"]=$this->ShowLinkbar;  
		$_x78["showtoolbar"]=$this->ShowToolbar;   
		$_x78["showtoolbar_code"]=$this->ShowCodeToolbar;   
		$_x78["showtoolbar_view"]=$this->ShowPreviewToolbar;   
		$_x78["allowscriptcode"]=$this->AllowScriptCode;   
		$_x78["htmlencode"]=$this->UseHTMLEntities;   
		$_x78["editcompletedocument"]=$this->EditCompleteDocument;   
		$_x78["tagwhitelist"]=$this->TagWhiteList;   
		$_x78["tagblacklist"]=$this->TagBlackList;   
		$_x78["attrwhitelist"]=$this->AttrWhiteList;   
		$_x78["attrblacklist"]=$this->AttrBlackList; 
		$_x78["stylewhitelist"]=$this->StyleWhiteList;
		$_x78["styleblacklist"]=$this->StyleBlackList;
		$_x78["ajaxpostbackurl"]=$this->AjaxPostbackUrl;
		
		//ClientFolder 
		$_x79=$this->Language;
		if(!$_x79)
		{
			$_x79=explode(",",$_SERVER['HTTP_ACCEPT_LANGUAGE']);
			$_x79=strtolower($_x79[0]);
		}
		
		//echo $_x79;
		
		$_x80="lang,more";
		
		if(file_exists($this->WebToPhy($this->RTEClient . "lang/more-".$_x79.".js")))
		{
			$_x80="more-".$_x79.",".$_x80;
		}
		if(file_exists($this->WebToPhy($this->RTEClient . "lang/lang-".$_x79.".js")))
		{
			$_x80="lang-".$_x79.",".$_x80;
		}
		
		if(strpos($_x79,"-"))
		{
			$_x79=explode("-",$_x79);
			$_x79=$_x79[0];
						
			if(file_exists($this->WebToPhy($this->RTEClient . "lang/more-".$_x79.".js")))
			{
				$_x80="more-".$_x79.",".$_x80;
			}
			if(file_exists($this->WebToPhy($this->RTEClient . "lang/lang-".$_x79.".js")))
			{
				$_x80="lang-".$_x79.",".$_x80;
			}
			
		}
		
		$_x78["langfiles"]=$_x80;
		
		$_x78["licenseurl"]=$this->Uploader->LicenseUrl;
		$_x78["uploaderresourcehandler"]=$this->RTEClient."server_php/phpuploader/ajaxuploaderhandler.php";
		
				
		foreach($this->_configs as $name=>$value)
		{
			$_x78[$name]=$value;
		}
		
		
		$_x68="window.rteloader=CreateRTELoader(";
		$_x68=$_x68.$this->ToJSON($_x78);
		$_x68=$_x68.");rteloader.startLoadTimer(" . $this->LoadDelay . ");";
		return $_x68;
	}
	
	
	
	
	
	function ToString()
	{
		$_x68="<!--RichTextEditor-->";
		
		$_x68=$_x68."<div id='".$this->Name."_div' style='width:".$this->Width.";height:".$this->Height."'>";
		
		$_x81 = $this->GetInitScriptCode();

		if ($this->RenderSupportAjax)
		{
			$_x81 = "function initcode(){" . $_x81 . "};\r\nif(window.CreateRTELoader) return initcode();"
				. "\r\nvar scripturl='" . $this->JSEncode($this->RTEClient) . "scripts/loader.js?'+new Date().getTime();"
				. <<<STR
var xh=window.XMLHttpRequest?new window.XMLHttpRequest():window.ActiveXObject('Microsoft.XMLHTTP');
xh.onreadystatechange=function()
{
if(xh.readyState<4)return;
xh.onreadystatechange=new Function('','');
if(xh.status==0)return;
if(xh.status!=200)return alert('Failed to load RichTextEditor loader : http '+xh.status+' , '+scripturl);
var runc=new Function('','eval(arguments[0])');
runc(xh.responseText);
initcode();
};
xh.open('GET',scripturl,true);
xh.send('');
STR;

			$_x81 = htmlentities($_x81);
			$_x81=str_replace("'","&#39;",$_x81);
			$_x81=str_replace("\r","",$_x81);
			$_x81=str_replace("\n","",$_x81);

			$_x68=$_x68."<img src='" . htmlentities($this->RTEClient) . "images/zip.gif' onload='this.style.display=&quot;none&quot; ; $_x81' style='position:absolute;' />";
		}
		else
		{
			$_x68=$_x68."<script type='text/javascript' src='" . htmlentities($this->RTEClient) . "scripts/loader.js'></script>";
			$_x68=$_x68."<script type='text/javascript'>$_x81</script>";
		}
		
		
		$_x68=$_x68."</div>";
		$_x68=$_x68."<input type='hidden' name='".$this->Name."' id='".$this->Name."' value=\"". htmlentities($this->Text) ."\"/>";
		
		return $_x68;
	}

	function Render()
	{
		return $this->ToString();
	}
	function GetString()
	{
		return $this->ToString();
	}
	
	function MvcInit()
	{
		if($this->UploaderName)
			$this->Uploader->Name=$this->UploaderName;
		else
			$this->Uploader->Name=$this->Name."_uploader";
		
		if($this->Uploader->_IsUploadRequest())
		{
			ob_clean();
			$this->Uploader->PreProcessRequest();
			$this->Uploader->WriteValidationOK("");
		}
		else if(@$_GET["RTEAjaxInvoke"]=="1")
		{		
			if($_POST['RTEAjaxInvoke_Control']!=$this->Name)
				return;
			if(@$_GET['UseUploadModule']!=null)
				throw (new Exception("Upload request failed for unknown reason."));
		
			
			$this->ProcessAjaxPostback();
		}
	}
	
	
	
	
	function ApplyFilter($_x82, $_x83="None")
	{
		$_x21 = $this->LoadConfigFile();
		$item = $_x21->GetDefaultItem();

		$_x43 = new RTEFilterEventArgs();
		$_x43->HtmlCode = $_x82;

		if ($this->FilterBegin != null)
			$this->FilterBegin($this, $_x43);

		$_x84 = new RTEFilter();
		$_x84->Option = option;
		$_x84->URLType = $this->URLType;
		$_x84->UseHTMLEntities = $this->UseHTMLEntities;
		$_x84->AllowScriptCode = $this->AllowScriptCode;
		$_x84->EditCompleteDocument = $this->EditCompleteDocument;

		$_x85 = new RTEMatchHandler();
		$_x85->TagWhiteList = RTEMatchList::Parse($this->TagWhiteList, $item->TagWhiteList);
		$_x85->TagBlackList = RTEMatchList::Parse($this->TagBlackList, $item->TagBlackList);
		$_x85->AttrWhiteList = RTEMatchList::Parse($this->AttrWhiteList, $item->AttrWhiteList);
		$_x85->AttrBlackList = RTEMatchList::Parse($this->AttrBlackList, $item->AttrBlackList);
		$_x85->StyleWhiteList = RTEMatchList::Parse($this->StyleWhiteList, $item->StyleWhiteList);
		$_x85->StyleBlackList = RTEMatchList::Parse($this->StyleBlackList, $item->StyleBlackList);
		$_x85->InitFilter($_x84);

		$_x43->HtmlCode = $_x84->Apply($_x43->HtmlCode);

		if ($this->UseSimpleAmpersand)
			$_x43->HtmlCode = str_replace("&amp;","&",$_x43->HtmlCode);

		if ($this->MaxHTMLLength > 0)
		{
			if (strlen($_x43->HtmlCode) > $this->MaxHTMLLength)
				$_x43->HtmlCode = "";
		}
		if ($this->MaxTextLength > 0)
		{
			if (strlen($_x43->HtmlCode) > $this->MaxTextLength && strlen(RTEUtil::ExtractPlainTextWithLinefeedsOutOfHtml($_x43->HtmlCode)) > $this->MaxTextLength)
			{
				$_x43->HtmlCode = "";
			}
		}

		if ($this->FilterEnd != null)
			$this->FilterEnd($this, $_x43);

		return $_x43->HtmlCode;
	}
	
	
	
	
	
	
	
	function InvokeAjaxMethod($_x33)
	{
		switch($_x33->Method)
		{
			case "AjaxGetStorages":
				return $this->AjaxGetStorages($_x33->Arguments[0]);
			case "AjaxGetFolderInfo":
				return $this->AjaxGetFolderInfo($_x33->Arguments[0]);
			case "AjaxGetFolderNodes":
				return $this->AjaxGetFolderNodes($_x33->Arguments[0]);
			case "AjaxGetFolderItem":
				return $this->AjaxGetFolderItem($_x33->Arguments[0],$_x33->Arguments[1]);
			case "AjaxFindPathItem":
				return $this->AjaxFindPathItem($_x33->Arguments[0],$_x33->Arguments[1]);
			
			case "AjaxMoveItems":
				return $this->AjaxMoveItems($_x33->Arguments[0],$_x33->Arguments[1],$_x33->Arguments[2]);
			case "AjaxCopyItems":
				return $this->AjaxCopyItems($_x33->Arguments[0],$_x33->Arguments[1],$_x33->Arguments[2]);
			case "AjaxDeleteItems":
				return $this->AjaxDeleteItems($_x33->Arguments[0],$_x33->Arguments[1]);
			
			case "AjaxCreateFolder":
				return $this->AjaxCreateFolder($_x33->Arguments[0],$_x33->Arguments[1]);
			case "AjaxChangeName":
				return $this->AjaxChangeName($_x33->Arguments[0],$_x33->Arguments[1],$_x33->Arguments[2]);
			
			case "AjaxGetUploaderHTML":
				return $this->AjaxGetUploaderHTML();
			case "AjaxUploadFiles":
				return $this->AjaxUploadFiles($_x33->Arguments[0],$_x33->Arguments[1],$_x33->Arguments[2]);
			
			case "AjaxInitImage":
				return $this->AjaxInitImage($_x33->Arguments[0],$_x33->Arguments[1]);
			case "AjaxCommitImage":
				return $this->AjaxCommitImage($_x33->Arguments[0],$_x33->Arguments[1],$_x33->Arguments[2]);
			case "AjaxSaveImage":
				return $this->AjaxSaveImage($_x33->Arguments[0],$_x33->Arguments[1],$_x33->Arguments[2]);
			case "AjaxLoadTemplate":
				return $this->AjaxLoadTemplate($_x33->Arguments[0],$_x33->Arguments[1]);
			
			default:
				throw(new Exception("Invalid method:$_x33->Method"));
		}
	}
	
	function CreateFileManager($category,$storageid)
	{
		$_x21 = $this->LoadConfigFile();
		$_x74 = null;
		foreach ($_x21->GetAvailableItems($category) as $_x86)
		{
			if ($_x86->StorageId == $storageid)
			{
				$_x74 = $_x86;
				break;
			}
		}

		if ($_x74 == null)
			throw (new Exception("Invalid storage : " . $category . ":" . $storageid));

		$_x87 = new RTEFileManager(new RTEWebFileProvider());
		$_x87->Init($_x74);
		return $_x87;
	}

	
	function CloneFolderArgument($_x24)
	{
		$_x88=new RTEStorage();
		$_x88->CloneFrom($_x24);
		return $_x88;
	}
	function CloneOptionArgument($_x83)
	{
		$_x89=new RTEGetItemOption();
		if($_x83!=null)
			$_x89->CloneFrom($_x83);
		return $_x89;
	}
	
	
	function AjaxGetStorages($category)
	{
		$_x21 = $this->LoadConfigFile();
		$_x90 = $_x21->GetAvailableItems($category);
		$_x47 = array();

		for ($_x12 = 0; $_x12 < count($_x90);$_x12++)
		{
			$_x74 = $_x90[$_x12];
			$_x91 = new RTEStorage();
			$_x91->Category = $category;
			$_x91->UrlPath = "/";
			$_x91->LoadFrom($_x74);

			$_x92 = $this->CreateFileManager($category,$_x74->StorageId);
			$_x91->UrlPrefix = $_x92->GetUrlPrefix($_x91);
			$_x92->Dispose();

			$_x47[$_x12] = $_x91;
		}
		
		return $_x47;
	}
	
	function AjaxGetFolderInfo($_x24)
	{
		$_x24=$this->CloneFolderArgument($_x24);

		$_x92 = $this->CreateFileManager($_x24->Category,$_x24->ID);
		
		$_x39=$_x92->AjaxGetFolderInfo($_x24);
		
		$_x92->Dispose();
		
		return $_x39;
	}
	function AjaxGetFolderNodes($_x24)
	{
		$_x24=$this->CloneFolderArgument($_x24);

		$_x92 = $this->CreateFileManager($_x24->Category,$_x24->ID);
		
		$_x39=$_x92->AjaxGetFolderNodes($_x24);
		
		$_x92->Dispose();
		
		return $_x39;
	}
	
	function AjaxGetFolderItem($_x24,$_x83)
	{
		$_x24=$this->CloneFolderArgument($_x24);
		$_x83=$this->CloneOptionArgument($_x83);
		
		$_x92 = $this->CreateFileManager($_x24->Category,$_x24->ID);
		
		$_x39=$_x92->AjaxGetFolderItem($_x24,$_x83);
		
		$_x92->Dispose();
		
		return $_x39;
	}
		
	function AjaxFindPathItem($_x24,$_x23)
	{
		$_x24=$this->CloneFolderArgument($_x24);
		
		$_x92 = $this->CreateFileManager($_x24->Category,$_x24->ID);
		
		$_x39=$_x92->AjaxFindPathItem($_x24,$_x23);
		
		$_x92->Dispose();
		
		return $_x39;
	}
	
	function AjaxMoveItems($_x24,$_x93,$_x94)
	{
		$_x24=$this->CloneFolderArgument($_x24);
		
		$_x92 = $this->CreateFileManager($_x24->Category,$_x24->ID);
		
		$_x39=$_x92->AjaxMoveItems($_x24,$_x93,$_x94);
		
		$_x92->Dispose();
		
		return $_x39;
	}
	function AjaxCopyItems($_x24,$_x93,$_x94)
	{
		$_x24=$this->CloneFolderArgument($_x24);
		
		$_x92 = $this->CreateFileManager($_x24->Category,$_x24->ID);
		
		$_x39=$_x92->AjaxCopyItems($_x24,$_x93,$_x94);
		
		$_x92->Dispose();
		
		return $_x39;
	}
	function AjaxDeleteItems($_x24,$_x94)
	{
		$_x24=$this->CloneFolderArgument($_x24);
		
		$_x92 = $this->CreateFileManager($_x24->Category,$_x24->ID);
		
		$_x39=$_x92->AjaxDeleteItems($_x24,$_x94);
		
		$_x92->Dispose();
		
		return $_x39;
	}
	
	
	function AjaxCreateFolder($_x24, $_x23)
	{
		$_x24=$this->CloneFolderArgument($_x24);
		
		$_x92 = $this->CreateFileManager($_x24->Category,$_x24->ID);
		
		$_x39=$_x92->AjaxCreateFolder($_x24,$_x23);
		
		$_x92->Dispose();
		
		return $_x39;
	}
	
	function AjaxChangeName($_x24, $_x95, $_x96)
	{
		$_x24=$this->CloneFolderArgument($_x24);
		
		$_x92 = $this->CreateFileManager($_x24->Category,$_x24->ID);
		
		$_x39=$_x92->AjaxChangeName($_x24, $_x95, $_x96);
		
		$_x92->Dispose();
		
		return $_x39;
	}
	
	
	function AjaxGetUploaderHTML()
	{
		$_x19=$_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"];
		$_x97=strpos($_x19,"RTEAjaxInvoke");
		if($_x97!==false)
			$_x19=substr($_x19,0,$_x97);

		$this->Uploader->UploadUrl=$_x19;
		return $this->Uploader->GetString();
	}
	
	function AjaxUploadFiles($_x24,$_x83,$_x98)
	{
		$_x99=explode("/",$_POST[$this->Uploader->Name]);
		
		if(count($_x99)==0)
			return array();
		
		$_x100=array();
		
		if($_x98)
		{
			foreach(explode("|",$_x98) as $_x101)
			{
				$_x102=explode("/",$_x101);
				if(count($_x102)!=2)
					continue;
				$_x100[$_x102[0]]=$_x102[1];
			}
		}
		
		$list=array();
		$_x90=array();
		$_x104=0;
		
		$_x24=$this->CloneFolderArgument($_x24);
		
		$_x92 = $this->CreateFileManager($_x24->Category,$_x24->ID);
	
		foreach($_x99 as $_x105)
		{
			$_x106=$this->Uploader->GetUploadedFile($_x105);
			if(!$_x106)
				continue;
			$_x104+=$_x106->FileSize;
			array_push($_x90,$_x106);
		}
		
		$_x92->VerifyStorageSize($_x24,$_x104);
		
		foreach($_x90 as $item)
		{
			$_x23=$item->FileName;
			$_x107=$_x100[strtolower($item->FileGuid)];
			if($_x107&&strlen($_x107)>3)
				$_x23=$_x107;
			
			//TODO:customzie event..
			
			$_x21=$_x92->AjaxCreateFile($_x24, $_x23, $_x83, $this, $item);

			if (!$_x21)
				throw (new Exception("Failed to create file " . $_x23));

			array_push($list,$_x21);
			if(file_exists($item->FilePath))
				$item->Delete();
		}

		$_x92->Maintain($_x24);
		
		$_x92->Dispose();

		return $list;
	}
	
	
	function AjaxInitImage($_x24,$_x23)
	{
		throw(new Exception("Not impl for rtepaint4"));
	}
	
	function AjaxCommitImage($_x24,$_x23,$_x108)
	{
		throw(new Exception("Not impl for rtepaint4"));
	}
	
	function AjaxSaveImage($_x24,$_x23,$_x109)
	{
		$_x24=$this->CloneFolderArgument($_x24);
		
		$_x92 = $this->CreateFileManager($_x24->Category,$_x24->ID);
		
		$_x39=$_x92->AjaxSaveImage($_x24, $_x23,$_x109);
		
		$_x92->Dispose();
		
		return $_x39;
	}
	
	function AjaxLoadTemplate($_x24,$_x23)
	{
		if ($_x24->Category != "Template")
			throw (new Exception("invalid argument"));

		$_x24=$this->CloneFolderArgument($_x24);
		
		$_x92 = $this->CreateFileManager($_x24->Category,$_x24->ID);
		
		$_x39=$_x92->AjaxLoadData($_x24, $_x23,true);
		
		$_x92->Dispose();
		
		return $_x39;
	}
			
}

class RTERuntimeSecurity
{
	public $category;
	public $storageid;
	public $name;
	public $value;
	public $_x110;
}

class RTEFileManager
{
	var $provider;
	function RTEFileManager($provider)
	{
		$this->provider=$provider;
	}
	var $_sec;
	function Init($_x74)
	{
		$this->_sec=$_x74;
		$this->provider->Init($_x74);
	}
	function Dispose()
	{
		$this->provider->Dispose();
	}
	
	function GetUrlPrefix($_x112)
	{
		return $this->provider->GetUrlPrefix($_x112);
	}
	
	function GetSecurity($_x24)
	{
		if($this->_sec->StorageId==$_x24->ID)
				return $this->_sec;
		throw (new Exception("Invalid storage id : " . $_x24->ID));
	}
	
	function GetFolderId($_x24)
	{
		if($_x24 == null)
			throw(new Exception("folder null"));

		$_x113 = $this->provider->GetRootId($_x24);

		$_x114 = explode("/",str_replace("\\","/",$_x24->UrlPath));
		if(count($_x114)==0)
			return $_x113;
		foreach($_x114 as $_x115)
		{
			if(!$_x115||$_x115=="")
				continue;
			if(strlen($_x115)==0)
				continue;
			if ($_x115 == "_cache")
				return null;
			if($_x115=="..")
				$_x113 = $this->provider->GetParentId($_x113);
			else
				$_x113 = $this->provider->HasFolder($_x113, $_x115);
		}
		
		return $_x113;
	}
	
	function Maintain($_x24)
	{
		$_x113 = $this->GetFolderId($_x24);
		if(!$_x113)
			return;
		$this->MaintainFolder($_x113);
	}
	function MaintainFolder($_x113)
	{
		/*
		Hashtable ht = LoadCache(fid, CACHE_FOLDER_NAME . "_image.cache");
		if (ht == null)
			return;
		Hashtable files = (Hashtable)ht["files"];
		if (files == null)
			return;
		int removecount = 0;
		foreach (string filename in new ArrayList(files.Keys))
		{
			PathItem item = $this->provider->GetItem(fid, new RTEGetItemOption(), filename);
			if ($item == null)
			{
				files.Remove($_x23);
				removecount++;
			}
		}
		SaveCache(fid, CACHE_FOLDER_NAME . "_image.cache", ht);
		*/
	}
	
	function VerifyStorageSize($_x24, $_x116)
	{
		$_x117 = $this->GetSecurity($_x24);
		$_x24->LoadFrom($_x117);

		if ($_x117->MaxFolderSize <= 0)
			return;
		if ($_x116 < $_x117->MaxFolderSize * 1024)
		{
			$_x118 = $this->provider->CalcStorageSize($_x24);
			if ($_x116 + $_x118 < $_x117->MaxFolderSize * 1024)
				return;
		}
		throw (new Exception("ERROR:MaxFolderSize: is " . $_x117->MaxFolderSize . " KB"));
	}

	function AjaxGetFolderInfo($_x24)
	{
		$_x117 = $this->GetSecurity($_x24);
		$_x24->LoadFrom($_x117);

		$_x119 = new CuteSoftLibrary_Dynamic();
		$_x119->FolderSize = $this->provider->CalcStorageSize($_x24);
		$_x119->Extensions = $_x117->Extensions;
		$_x119->MimeTypes = $_x117->MimeTypes;
		$_x119->LargeImageMode = $_x117->LargeImageMode;
		$_x119->MaxFileSize = $_x117->MaxFileSize;
		$_x119->MaxFolderSize = $_x117->MaxFolderSize;
		$_x119->MaxImageWidth = $_x117->MaxImageWidth;
		$_x119->MaxImageHeight = $_x117->MaxImageHeight;
		return $_x119;
	}
	
	function AjaxGetFolderNodes($_x24)
	{
		$_x117 = $this->GetSecurity($_x24);
		$_x24->LoadFrom($_x117);

		$_x113 = $this->GetFolderId($_x24);
		if ($_x113 == null)
			return null;

		return $this->provider->GetFolderNodes($_x113);
	}
	
	function AjaxFindPathItem($_x24,$_x23)
	{
		$this->ValidateFileName($_x23);

		$_x117 = $this->GetSecurity($_x24);
		$_x24->LoadFrom($_x117);

		$_x113 = $this->GetFolderId($_x24);
		if ($_x113 == null)
			return null;

		return $this->provider->GetItem($_x113, new RTEGetItemOption(), $_x23);
	}
	
	function AjaxGetFolderItem($_x24,$_x83)
	{
		$_x117 = $this->GetSecurity($_x24);
		$_x24->LoadFrom($_x117);

		$_x113 = $this->GetFolderId($_x24);
		if ($_x113 == null)
			return null;
		
		$_x120=new RTEFolderItem();
		$_x120->UrlPath=$this->provider->GetUrlPath($_x113);
		$_x120->UrlPrefix = $this->provider->GetUrlPrefix($_x24);
		$list=array();
		
		if ($this->provider->GetParentId($_x113) != null)
		{
			$_x121 = new RTEPathItem();
			$_x121->IsFolder = true;
			$_x121->Name = "..";
			$_x121->Size = 0;
			array_push($list,$_x121);
		}

		$_x84 = new RTEFileFilter($_x24->Extensions);
		foreach($this->provider->GetFolders($_x113, $_x83) as $item)
		{
			if($item->Name=="_cache")
				continue;
			array_push($list,$item);
		}
		
		foreach($this->ApplyFileOptionArray($_x24, $_x113, $_x83, $this->provider->GetFiles($_x113, $_x83)) as $item)
		{
			array_push($list,$item);
		}
		$_x120->Items=$list;
		return $_x120;
	}
	
	function AjaxChangeName($_x24, $_x95, $_x96)
	{
		$this->ValidateFileName($_x95);
		$this->ValidateFileName($_x96);
		
		if(pathinfo($_x95,PATHINFO_EXTENSION)!=pathinfo($_x96,PATHINFO_EXTENSION))
			throw (new Exception("ERROR:InvalidExt:Invalid file extension:" . newname));

		$_x117 = $this->GetSecurity($_x24);
		$_x24->LoadFrom($_x117);

		$_x113 = $this->GetFolderId($_x24);
		if ($_x113 == null)
			return null;

		$item = $this->provider->GetItem($_x113, new RTEGetItemOption(), $_x95);
		if ($item == null)
			return null;

		if ($item->IsFolder)
		{
			if (!$_x117->AllowRenameFolder)
				throw (new Exception("ERROR:AllowRenameFolder: is false"));

			$_x117->ValidateFolderName($_x96);

			$this->provider->ChangeFolderName($_x113, $_x95, $_x96);
		}
		else
		{
			if (!$_x117->AllowRenameFile)
				throw (new Exception("ERROR:AllowRenameFile: is false"));

			$_x117->ValidateFileName($_x96);

			$this->provider->ChangeFileName($_x113, $_x95, $_x96);
		}

		$this->MaintainFolder($_x113);

		return $_x96;
	}
	
	function AjaxCreateFolder($_x24, $_x23)
	{
		$this->ValidateFileName($_x23);
		
		$_x117 = $this->GetSecurity($_x24);
		$_x24->LoadFrom($_x117);

		if (!$_x117->AllowCreateFolder)
			throw (new Exception("ERROR:AllowCreateFolder: is false"));

		$_x117->ValidateFolderName($_x23);

		$_x113 = $this->GetFolderId($_x24);
		if ($_x113 == null)
			return null;

		$this->provider->CreateFolder($_x113, $_x23);
		return $this->provider->GetItem($_x113, new RTEGetItemOption(), $_x23);
	}
	
	
	function AjaxCreateFile($_x24, $_x23, $_x83, $_x122, $_x106)
	{
		$this->ValidateFileName($_x23);

		$_x117 = $this->GetSecurity($_x24);
		$_x24->LoadFrom($_x117);

		if (!$_x117->AllowUpload)
			throw (new Exception("ERROR:AllowUpload: is false"));

		$_x117->ValidateFileName($_x23);

		$_x113 = $this->GetFolderId($_x24);
		if ($_x113 == null)
			return null;

		if (!$_x117->AllowOverride)
		{
			if ($this->provider->GetItem($_x113, new RTEGetItemOption(), $_x23) != null)
			{
				throw (new Exception("ERROR:AllowOverride: is false"));
			}
		}

		$_x123="." . strtolower(pathinfo($_x23,PATHINFO_EXTENSION));
		$_x124 = false;
		foreach(explode(",", strtolower($_x117->Extensions)) as $_x125)
		{
			$_x22=str_replace("*","",$_x125);
			if(substr($_x22,0,1)!=".")$_x22=".".$_x22;
			if($_x123==$_x22)
			{
				$_x124=true;
				break;
			}
		}

		if (!$_x124)
			throw (new Exception("ERROR:InvalidExt:Don't allow upload extension '" . $_x123 . "'."));
		
		$_x126=false;
		switch($_x123)
		{
			case ".png":
			case ".jpg":
			case ".jpeg":
			case ".gif":
			case ".bmp":
				$_x126=true;
				break;
		}
		
		if($_x126&& ($_x117->LargeImageMode=="deny"||$_x117->LargeImageMode=="resize") )
		{
			$_x59=null;
			if($_x117->MaxImageWidth&&$_x117->MaxImageWidth>0)
				$_x59=$_x117->MaxImageWidth;
			$_x60=null;
			if($_x117->MaxImageHeight&&$_x117->MaxImageHeight>0)
				$_x60=$_x117->MaxImageHeight;
			if( $_x59 || $_x60 )
			{
				$_x127=false;
				$_x57=RTE_GetPhotoDimensions($_x106->FilePath);
				if($_x59&&$_x57["Width"]>$_x59)
					$_x127="width";
				if($_x60&&$_x57["Height"]>$_x60)
					$_x127="height";
				if($_x127&&$_x117->LargeImageMode=="deny")
				{
					if($_x127=="width")
						throw (new Exception("ERROR:MaxImageWidth: is $_x59"));
					else
						throw (new Exception("ERROR:MaxImageHeight: is $_x60"));
				}
				if($_x127&&$_x117->LargeImageMode=="resize")
				{
					$_x128=$_x59?$_x59:88888888;
					$_x129=$_x60?$_x60:88888888;
					$_x130=min($_x128/$_x57["Width"],$_x129/$_x57["Height"]);
					$_x128=floor($_x130*$_x57["Width"]);
					$_x129=floor($_x130*$_x57["Height"]);
					RTE_GenerateThumbnail($_x106->FilePath,$_x106->FilePath,$_x128,$_x129);
				}
			}
		}
		
		$this->provider->CreateFile($_x113, $_x23, $_x106);

		return $this->ApplyFileOptionSingle($_x24, $_x113, $_x83, $this->provider->GetItem($_x113, $_x83, $_x23));
	}
	
	function AjaxDeleteItems($_x24,$_x94)
	{
		$_x117 = $this->GetSecurity($_x24);
		$_x24->LoadFrom($_x117);

		$_x113 = $this->GetFolderId($_x24);
		if ($_x113 == null)
			return null;


		foreach ($_x94 as $name)
		{
			if (substr($name,strlen($name)-1,1) == ".")
				continue;

			$item = $this->provider->GetItem($_x113, new RTEGetItemOption(), $name);
			if ($item == null)
				continue;
			
			if ($item->IsFolder)
			{
				if (!$_x117->AllowDeleteFolder)
					throw (new Exception("ERROR:AllowDeleteFolder: is false"));

				$this->provider->DeleteFolder($_x113, $name);
			}
			else
			{
				if (!$_x117->AllowDeleteFile)
					throw (new Exception("ERROR:AllowDeleteFile: is false"));

				$this->provider->DeleteFile($_x113, $name);
			}
		}

		$this->MaintainFolder($_x113);
	}
	
	function AjaxMoveItems($_x24,$_x93,$_x94)
	{
		$_x117 = $this->GetSecurity($_x24);
		$_x24->LoadFrom($_x117);

		$_x113 = $this->GetFolderId($_x24);
		if ($_x113 == null)
			return null;
		
		$_x131 = $this->GetFolderId($_x93);
		if ($_x131 == null)
			return null;
		
		foreach($_x94 as $name)
		{
			if (substr($name,strlen($name)-1,1) == ".")
				continue;
			
			$item = $this->provider->GetItem($_x113, new RTEGetItemOption(), $name);
			if ($item == null)
				continue;

			if (!$_x117->AllowOverride)
			{
				if ($this->provider->GetItem($_x131, new RTEGetItemOption(), $name) != null)
				{
					throw (new Exception("ERROR:AllowOverride: is false"));
				}
			}

			if ($item->IsFolder)
			{
				if (!$_x117->AllowMoveFolder)
					throw (new Exception("ERROR:AllowMoveFolder: is false"));

				$this->provider->MoveFolder($_x113, $_x131, $item->Name);
			}
			else
			{
				if (!$_x117->AllowMoveFile)
					throw (new Exception("ERROR:AllowMoveFile: is false"));

				$this->provider->MoveFile($_x113, $_x131, $item->Name);
			}
		}

		$this->MaintainFolder($_x113);
	}
	
	function AjaxCopyItems($_x24,$_x93,$_x94)
	{
		$_x117 = $this->GetSecurity($_x24);
		$_x24->LoadFrom($_x117);

		$_x113 = $this->GetFolderId($_x24);
		if ($_x113 == null)
			return null;
		
		$_x131 = $this->GetFolderId($_x93);
		if ($_x131 == null)
			return null;
		
		foreach($_x94 as $name)
		{
			if (substr($name,strlen($name)-1,1) == ".")
				continue;
			
			$item = $this->provider->GetItem($_x113, new RTEGetItemOption(), $name);
			if ($item == null)
				continue;

			if (!$_x117->AllowOverride)
			{
				if ($this->provider->GetItem($_x131, new RTEGetItemOption(), $name) != null)
				{
					throw (new Exception("ERROR:AllowOverride: is false"));
				}
			}

			if ($item->IsFolder)
			{
				if (!$_x117->AllowCopyFolder)
					throw (new Exception("ERROR:AllowCopyFolder: is false"));

				$this->provider->CopyFolder($_x113, $_x131, $item->Name);
			}
			else
			{
				if (!$_x117->AllowCopyFile)
					throw (new Exception("ERROR:AllowCopyFile: is false"));

				$this->provider->CopyFile($_x113, $_x131, $item->Name);
			}
		}

		$this->MaintainFolder($_x113);
	}
	
	
	function ValidateFileName($_x23)
	{
		if($_x23==null||strlen($_x23)==0)throw(new Exception("empty filename $_x23"));
		if(strpos($_x23,"/")!==false||strpos($_x23,"\\")!==false)throw(new Exception("invalid filename (1)"));
		if(substr($_x23,strlen($_x23)-1,1)==".")throw(new Exception("invalid filename (2)"));
	}
	function ApplyFileOptionArray($_x24,$_x113,$_x83,$_x90)
	{
		return $_x90;
	}
	function ApplyFileOptionSingle($_x24,$_x113,$_x83,$item)
	{
		return $item;
	}
	
	function AjaxLoadData($_x24, $_x23,$_x132)
	{
		$this->ValidateFileName($_x23);

		$_x117 = $this->GetSecurity($_x24);
		$_x24->LoadFrom($_x117);

		$_x113 = $this->GetFolderId($_x24);
		if ($_x113 == null)
			return null;

		$item = $this->provider->GetItem($_x113, new RTEGetItemOption(), $_x23);
		if ($item == null)
			return null;

		if ($item->IsFolder)
			return null;
		
		return $this->provider->LoadFile($_x113,$_x23,$_x132);
	}
	

	
	function AjaxSaveImage($_x24,$_x23,$_x109)
	{
		$this->ValidateFileName($_x23);

		$_x117 = $this->GetSecurity($_x24);
		$_x24->LoadFrom($_x117);

		$_x117->ValidateFileName($_x23);
		
		$_x113 = $this->GetFolderId($_x24);
		if ($_x113 == null)
			return null;
		
		$item = $this->provider->GetItem($_x113, new RTEGetItemOption(), $_x23);
		if ($item == null)
			return null;

		if (!$_x117->AllowUpload)
			throw (new Exception("ERROR:AllowUpload: is false"));

		if (!$_x117->AllowOverride)
			throw (new Exception("ERROR:AllowOverride: is false"));


		$_x123="." . strtolower(pathinfo($_x23,PATHINFO_EXTENSION));
		$_x124 = false;
		foreach(explode(",", strtolower($_x117->Extensions)) as $_x125)
		{
			$_x22=str_replace("*","",$_x125);
			if(substr($_x22,0,1)!=".")$_x22=".".$_x22;
			if($_x123==$_x22)
			{
				$_x124=true;
				break;
			}
		}

		if (!$_x124)
			throw (new Exception("ERROR:InvalidExt:Don't allow upload extension '" . $_x123 . "'."));
		
		$_x126=false;
		switch($_x123)
		{
			case ".jpeg":
			case ".jpg":
			case ".png":
			case ".gif":
			case ".bmp":
				$_x126 = true;
				break;
		}
		
		if (!$_x126)
			return null;
			
		$_x133=base64_decode($_x109);
		
		$this->provider->WriteFileData($_x113, $_x23, $_x133);

		return $this->ApplyFileOptionSingle($_x24, $_x113, new RTEGetItemOption(), $this->provider->GetItem($_x113, $_x83, $_x23));
		
		
	}
	
}

function Path_TrimEndSeparator($_x17)
{
	$_x134=substr($_x17,strlen($_x17)-1,1);
	if($_x134=="/"||$_x134=="\\")
		$_x17=substr($_x17,0,strlen($_x17)-1);
	return $_x17;
}


class RTEWebFileProvider
{
	public $cs;
	var $_sec;
	var $_webpath;
	var $_phypath;
	
	function RTEWebFileProvider()
	{
		$this->cs=new CuteSoftLibrary();
	}
	
	function Init($_x74)
	{
		$this->_sec=$_x74;
		$this->_webpath=$this->cs->MakeAbsolute($_x74->StoragePath)."/";
		$this->_phypath=$this->cs->WebToPhy($this->_webpath);
	}
	function Dispose()
	{
	}
	
	function GetZoneWebPath($_x135)
	{
		if($this->_sec->StorageId==$_x135)
			return $this->_webpath;
		throw (new Exception("Invalid zone"));
	}
	function GetZonePhyPath($_x135)
	{
		if($this->_sec->StorageId==$_x135)
			return $this->_phypath;
		throw (new Exception("Invalid zone"));
	}
	
	function GetRootId($_x136)
	{
		return new RTEFolderID($_x136->ID, $this->GetZonePhyPath($_x136->ID), $_x136->Category, $_x136->Extensions);
	}


	function GetUrlPath($_x137)
	{
		$_x138=$this->GetZonePhyPath($_x137->ZoneID);
		$_x17=substr($_x137->Value,strlen($this->_phypath)-1);
		return str_replace("\\","/",$_x17);
	}
	
	function GetUrlPrefix($_x136)
	{
		$_x17=$this->GetZoneWebPath($_x136->ID);
		$_x17=str_replace("\\","/",$_x17);
		return Path_TrimEndSeparator($_x17);
	}
	
	function CalcStorageSize($_x136)
	{
		$_x138=$this->GetZonePhyPath($_x136->ID);
		return $this->CalcDirectorySize(Path_TrimEndSeparator($_x138));
	}
	
	function CalcDirectorySize($_x17)
	{
		if(!is_dir($_x17))
			return 0;
		$_x57=0;
		foreach(glob($_x17."/*.*") as $_x139)
		{
			if(substr($_x139,strlen($_x139)-1,1)==".")
				continue;
			if(is_dir($_x139))
				$_x57+=$this->CalcDirectorySize($_x17);
			else
				$_x57+=filesize($_x139);
		}
		return $_x57;
	}

	function GetParentId($_x137)
	{
		$_x138 = $this->GetZonePhyPath($_x137->ZoneID);
		$_x17 = Path_TrimEndSeparator($_x137->Value);

		$_x140=strrpos($_x17,"\\");
		$_x141=strrpos($_x17,"/");
		if($_x140==false)$_x140=$_x141;
		else if($_x141!=false)$_x140=max($_x140,$_x141);
		if($_x140==false)return null;
		
		$_x17 = substr($_x17,0,$_x140 + 1);
	
		$_x97=strpos($_x17,$_x138);
		
		if($_x97!==0)
			return null;
		
		return new RTEFolderID($_x137->ZoneID,$_x17,$_x137->Category,$_x137->Extensions);

	}
	function HasFolder($_x137, $_x142)
	{
		$_x143=$_x137->Value.$_x142;
		if(!is_dir($_x143))
			return null;
		$_x17=$_x143."/";
		return new RTEFolderID($_x137->ZoneID,$_x17,$_x137->Category,$_x137->Extensions);
	}
	
	function GetFolderNodes($_x137)
	{
		$_x90=$this->GetFolders($_x137, new RTEGetItemOption());
		$_x144=array();
		foreach($_x90 as $item)
		{
			$_x45=new RTEFolderNode();
			$_x45->Name=$item->Name;
			array_push($_x144,$_x45);
			$_x143=$this->HasFolder($_x137,$item->Name);
			if($_x143)
				$_x45->SubNodes=$this->GetFolderNodes($_x143);
		}
		return $_x144;
	}
	
	function GetFolders($_x137, $_x83)
	{
		if (!is_dir($_x137->Value))
			return array();

		$list = array();
		foreach(scandir($_x137->Value) as $name)
		{
			if($name=="."||$name=="..")
				continue;
			$_x145=$_x137->Value.$name;
			if(!is_dir($_x145))
				continue;
			$item=$this->GetFolderItem($_x145, $_x137->Filter, $_x83);
			if($this->IsHiddenItem($item))
				continue;
			array_push($list,$item);
		}

		return $list;
	}
	function GetFiles($_x137, $_x83)
	{
		if (!is_dir($_x137->Value))
			return array();

		$_x146 = $_x137->Filter->GetFiles($_x137->Value);
		$list = array();
		foreach($_x146 as $_x145)
		{
			$item=$this->GetFileItem($_x83,$_x145);
			if($this->IsHiddenItem($item))
				continue;
			array_push($list,$item);
		}
		return $list;
	}
	
	function IsHiddenItem($item)
	{
		if ($item->Name == ".."||$item->Name == ".")
			return true;
		if ($item->IsFolder && $item->Name=="_cache")
			return true;
		return false;
	}

	function GetItem($_x137, $_x83, $name)
	{
		if ($name == ".."||$name == ".")
			return null;

		$_x145 = $_x137->Value . $name;
		
		if (is_dir($_x145))
			return $this->GetFolderItem($_x145, $_x137->Filter, $_x83);
		if (file_exists($_x145))
			return $this->GetFileItem($_x83, $_x145);
		return null;
	}

	function GetFileItem($_x83, $_x145)
	{
		$item = new RTEPathItem();
		$item->IsFolder = false;
		$item->Name = $this->cs->GetBaseName($_x145);
		$_x119 = null;
		if ($_x83->GetSize || $_x83->GetTime)
		{
			if ($_x83->GetSize)
				$item->Size=filesize($_x145);
			else
				$item->Size = -1;
			if ($_x83->GetTime)
				$item->Time=filectime($_x145)*1000;
		}
		return $item;
	}


	function GetFolderItem($_x145, $_x84, $_x83)
	{
		$item = new RTEPathItem();
		$item->IsFolder = true;
		$item->Name = $this->cs->GetBaseName($_x145);
		$item->Size = -1;
		if ($_x83->GetSize)
		{
			$item->Size = 0;
			/*
			try
			{
				$item->Size = Directory.GetFiles(fullname).Length; // $_x84->GetFiles(fullname).Count;
				foreach (string subdir in SafeGetDirectories(fullname))
				{
					if (subdir.EndsWith(RTEFileManager.CACHE_FOLDER_NAME))
					{
						string n = Path.GetFileName(subdir);
						if (n == RTEFileManager.CACHE_FOLDER_NAME)
							continue;
					}
					$item->Size++;
				}
			}
			catch
			{
			}
			*/
		}
		return $item;
	}
	
	
	function LoadFile($_x137, $_x23,$_x132)
	{
		$_x145 = $_x137->Value . $_x23;

		if (!file_exists($_x145))
			throw (new Exception($_x23 . " does not exist"));

		$_x57=filesize($_x145);
		//$_x147=get_magic_quotes_runtime();
		//set_magic_quotes_runtime(0);
		$_x148="rb";
		if($_x132)
			$_x148="rt";
		$_x149=fopen($_x145,$_x148);
		$_x133=fread($_x149,$_x57);
		fclose($_x149);
		//set_magic_quotes_runtime($_x147);
		return $_x133;
	}
	

	function WriteFileData($_x137, $_x23, $_x133)
	{
		$_x145 = $_x137->Value . $_x23;

		if (is_dir($_x145))
			throw (new Exception($_x23 . " is a folder"));

		if (!is_dir($_x137->Value))
			mkdir($_x137->Value,0777);

		$_x129=PhpUploader_FileOpen(__FILE__,__LINE__,$_x145,"w+b");
		PhpUploader_FileWrite(__FILE__,__LINE__,$_x129,$_x133);
		PhpUploader_FileClose(__FILE__,__LINE__,$_x129);
	}
	function CreateFile($_x137, $_x23, $_x106)
	{
		$_x145 = $_x137->Value . $_x23;

		if (is_dir($_x145))
			throw (new Exception($_x23 . " is a folder"));

		if (!is_dir($_x137->Value))
			mkdir($_x137->Value,0777);

		$_x106->MoveTo($_x145);
	}
	function CreateFolder($_x137, $_x23)
	{
		$_x145 = $_x137->Value . $_x23;
		if (file_exists($_x145))
			throw (new Exception($_x23 . " is a file"));
			
		$item = $this->GetItem($_x137, new RTEGetItemOption(), $_x23);
		if ($item != null)
			return;
		mkdir($_x145,0777);
	}
	function DeleteFile($_x137, $_x23)
	{
		$_x145 = $_x137->Value . $_x23;
		if (file_exists($_x145))
			unlink($_x145);
	}
	function DeleteFolder($_x137,  $_x23)
	{
		$_x145 = $_x137->Value . $_x23;
		$this->cs->DeleteDirectory($_x145);
	}
	function ChangeFileName($_x137, $_x23, $_x96)
	{
		$_x150 = $_x137->Value . $_x23;
		$_x151 = $_x137->Value . $_x96;
		rename($_x150, $_x151);
	}
	function ChangeFolderName($_x137,  $_x23, $_x96)
	{
		$_x150 = $_x137->Value . $_x23;
		$_x151 = $_x137->Value + newname;
		$this->Directory_Move(fullname1, fullname2, $_x137->Filter);
	}
	function MoveFile($_x137, $_x152, $_x23)
	{
		$_x150 = $_x137->Value . $_x23;
		$_x151 = $_x152->Value . $_x23;
		$this->File_Move($_x150, $_x151);
	}
	function MoveFolder($_x137,  $_x152, $_x23)
	{
		$_x150 = $_x137->Value . $_x23;
		$_x151 = $_x152->Value . $_x23;
		$this->Directory_Move($_x150, $_x151, $_x137->Filter);
	}

	function CopyFile($_x137, $_x152, $_x23)
	{
		$_x150 = $_x137->Value . $_x23;
		$_x151 = $_x152->Value . $_x23;
		$this->File_Copy($_x150, $_x151);
	}
	function CopyFolder($_x137,  $_x152, $_x23)
	{
		$_x150 = $_x137->Value . $_x23;
		$_x151 = $_x152->Value . $_x23;
		$this->Directory_Copy($_x150, $_x151, $_x137->Filter);
	}
	
	function Directory_Copy($_x153, $_x154, $_x84)
	{
		if(!is_dir($_x154))
			mkdir($_x154,0777);
		
		foreach(glob($_x153."/*.*") as $item)
		{
			$name=basename($item);
			if(is_dir($item))
			{
				$this->Directory_Copy($item,$_x154."/".$name,$_x84);
			}
			else
			{
				$this->File_Copy($item,$_x154."/".$name);
			}
		}
	}
	function Directory_Move($_x153, $_x154, $_x84)
	{
		if(!is_dir($_x154))
			mkdir($_x154,0777);

		foreach(glob($_x153."/*.*") as $item)
		{
			$name=basename($item);
			if(is_dir($item))
			{
				$this->Directory_Move($item,$_x154."/".$name,$_x84);
			}
			else
			{
				$this->File_Move($item,$_x154."/".$name);
			}
		}
	}
	
	function File_Copy($_x153, $_x154)
	{
		if (!file_exists($_x153)) return;
		if(file_exists($_x154))
			unlink($_x154);
		copy($_x153,$_x154);
	}
	
	function File_Move($_x153, $_x154)
	{
		if (!file_exists($_x153)) return;
		if(file_exists($_x154))
			unlink($_x154);
		rename($_x153,$_x154);
	}
}




class RTEFileFilter
{
	var $_exts;
	function RTEFileFilter($_x155)
	{
		if($_x155)
			$this->_exts=explode(",",str_replace(".","",str_replace("*","",strtolower($_x155))));
		else
			$this->_exts=array();
	}
	function Match($_x23)
	{
		if(count($this->_exts)==0)
			return true;
		
		$_x22=strtolower(pathinfo($_x23,PATHINFO_EXTENSION));
		foreach($this->_exts as $_x125)
		{
			if($_x125==$_x22)
				return true;
		}
		return false;
	}

	function GetFiles($_x20)
	{
		$_x20=Path_TrimEndSeparator($_x20);
		$_x25="*.*";
		$_x26=glob("$_x20/*.*");
		if(!$_x26)return array();
		$list=array();
		foreach($_x26 as $_x21)
		{
			if($this->Match($_x21))
				array_push($list,$_x21);
		}
		return $list;
	}

	//public static FileFilter All = new FileFilter(null);
	//public static FileFilter Image = new FileFilter(".bmp,.jpg,.jpeg,.gif,.png".Split(','));


}
class RTEGetItemOption
{	
	public $GetSize;
	public $GetTime;
	public $GetDimensions;
	public $GetThumbnails;
	
	function CloneFrom($_x83)
	{
		$this->GetSize = $_x83->GetSize;
		$this->GetTime = $_x83->GetTime;
		$this->GetDimensions = $_x83->GetDimensions;
		$this->GetThumbnails = $_x83->GetThumbnails;
	}
}

class RTEStorage
{
	public $ID;
	public $Name;
	public $Category;
	
	public $UrlPath;
	public $UrlPrefix;
	
	public $Extensions;
	public $MimeTypes;
	public $AllowUpload;
	public $AllowCopyFile;
	public $AllowRenameFile;
	public $AllowDeleteFile;
	public $AllowOverride;
	public $AllowCreateFolder;
	public $AllowCopyFolder;
	public $AllowMoveFolder;
	public $AllowRenameFolder;
	public $AllowDeleteFolder;
	public $MaxFolderSize;
	public $MaxImageWidth;
	public $MaxImageHeight;	

	function LoadFrom($_x74)
	{
		$this->ID = $_x74->StorageId;
		$this->Name = $_x74->StorageName;
		
		$this->CloneAttributes($_x74);
	}
	function CloneFrom($_x91)
	{
		$this->ID = $_x91->ID;
		$this->Name = $_x91->Name;
		$this->Category = $_x91->Category;
		$this->UrlPath = $_x91->UrlPath;
		$this->UrlPrefix = $_x91->UrlPrefix;
	
		$this->CloneAttributes($_x91);
	}
	function CloneAttributes($_x91)
	{
		$this->Extensions = $_x91->Extensions;
		$this->MimeTypes = $_x91->MimeTypes;
		$this->AllowUpload = $_x91->AllowUpload;
		$this->AllowCopyFile = $_x91->AllowCopyFile;
		$this->AllowMoveFile = $_x91->AllowMoveFile;
		$this->AllowRenameFile = $_x91->AllowRenameFile;
		$this->AllowDeleteFile = $_x91->AllowDeleteFile;
		$this->AllowOverride = $_x91->AllowOverride;
		$this->AllowCreateFolder = $_x91->AllowCreateFolder;
		$this->AllowCopyFolder = $_x91->AllowCopyFolder;
		$this->AllowMoveFolder = $_x91->AllowMoveFolder;
		$this->AllowRenameFolder = $_x91->AllowRenameFolder;
		$this->AllowDeleteFolder = $_x91->AllowDeleteFolder;
		$this->MaxFolderSize = $_x91->MaxFolderSize;
		$this->MaxImageWidth = $_x91->MaxImageWidth;
		$this->MaxImageHeight = $_x91->MaxImageHeight;
	}
}
class RTEFolderItem extends RTEStorage
{
	public $Items;
}

class RTEFolderInfo
{
	public $FolderSize;
	public $Extensions;
	public $MimeTypes;
	public $LargeImageMode;
	public $MaxFileSize;
	public $MaxFolderSize;
	public $MaxImageWidth;
	public $MaxImageHeight;
}

class RTEFolderNode
{
	public $Name;
	public $SubNodes;
}

class RTEPathItem
{
	public $IsFolder;
	public $Name;
	public $Size;
	public $Time;
	public $Width;
	public $Height;
	public $Thumbnail;

	function IsImage()
	{
		$_x22=".".strtolower(pathinfo($this->Name,PATHINFO_EXTENSION));
		switch($_x22)
		{
			case ".jpeg":
			case ".jpg":
			case ".gif":
			case ".png":
			case ".bmp":
				return true;
		}
		return false;
	}
}

class RTEFolderID
{
	public $ZoneID;
	public $Value;
	public $Category;
	public $Extensions;
	public $Filter;
	
	function RTEFolderID($_x135, $_x63, $category,$_x155)
	{
		if ($_x135 == null)
			throw (new Exception("zoneid is null"));
		if ($_x63 == null)
			throw (new Exception("val is null"));

		$this->ZoneID = $_x135;
		$this->Value = $_x63;
		$this->Category = $category;
		$this->Extensions = $_x155;
		$this->Filter=new RTEFileFilter($_x155);
	}
}



class RTEConfigFile
{
	public $doc;
	public $_items=array();
	
	function RTEConfigFile($_x21)
	{
		array_push($this->_items,new RTEConfigSecurity());
		
		$this->doc=new DOMDocument();
		$this->doc->load($_x21);
		
		$_x156=$this->doc->childNodes->item(0);
		$_x144=$_x156->childNodes;
		for($_x12=0;$_x12<$_x144->length;$_x12++)
		{
			$_x45=$_x144->item($_x12);
			if($_x45->nodeType!=1)continue;
			if($_x45->nodeName=="watermarks")
			{
				$this->ParseWatermarks($_x45, $this->_items);
				continue;
			}
			if($_x45->nodeName=="security")
			{
				$this->ParseSecurity($_x45, $this->_items);
				continue;
			}
			if($_x45->nodeName=="category")
			{
				$this->ParseCategory($_x45);
				continue;
			}
			throw (new Exception("Invalid element '$_x45->nodeName'"));
				
		}
	}
	
	function GetDefaultItem()
	{
		return $this->_items[0];
	}
	
	function ParseCategory($element)
	{
		$_x157 = $element->getAttribute("for");

		if ( !$_x157 || $_x157 == "*")
			throw (new Exception("<category> node must specify attribute 'for'"));

		$list = array();
	
		foreach (explode(",",$_x157) as $category)
		{
			if(!$category)
				continue;
			$item = $this->FindItem($category, null);
			if (!$item)
			{
				$item = $this->_items[0]->DoClone();
				$item->Category = $category;
				array_push($this->_items,$item);
			}
			array_push($list,$item);
		}

		$_x158 = $list;
	
		$_x144=$element->childNodes;
		for($_x12=0;$_x12<$_x144->length;$_x12++)
		{
			$_x139=$_x144->item($_x12);
			if($_x139->nodeType!=1)continue;

			if ($_x139->nodeName == "security")
			{
				$this->ParseSecurity($_x139, $_x158);
				continue;
			}
			if ($_x139->nodeName == "storage")
			{
				$this->ParseStorage($_x139, $_x158);
				continue;
			}
			throw (new Exception("Invalid element '" .$_x139->nodeName."' under '" . $element->nodeName . "'"));
		}
	
		
	}
	function ParseSecurity($element,$_x158)
	{
		$_x54 = $element->getAttribute("name");
		foreach($_x158 as $_x74)
			$_x74->$_x54=$element->textContent;
	}
	
	function ParseStorage($element, $_x159)
	{
		$_x160 = $element->getAttribute("id");

		if (!$_x160)
			throw (new Exception("<storage> node missing attribute 'id'"));

		$_x158 = array();
		for ($_x12 = 0; $_x12 < count($_x159); $_x12++)
		{
			$_x74=$this->FindItem($_x159[$_x12]->Category, $_x160);
			if (!$_x74)
			{
				$_x74 = $_x159[$_x12]->DoClone();
				$_x74->StorageId = $_x160;
				$_x74->StorageName = $_x160;
				array_push($this->_items,$_x74);
				
			}
			$_x158[$_x12] = $_x74;
		}

		$_x144=$element->childNodes;
		for($_x12=0;$_x12<$_x144->length;$_x12++)
		{
			$_x139=$_x144->item($_x12);
			if($_x139->nodeType!=1)continue;
			
			if ($_x139->nodeName == "security")
			{
				$this->ParseSecurity($_x139, $_x158);
				continue;
			}
			throw (new Exception("Invalid element '" .$_x139->nodeName. "' under '" .$element->nodeName. "'"));
		}
	}
		
	function ParseWatermarks()
	{
	}
	
	function FindItem($category, $storageid)
	{
		foreach ($this->_items as $item)
		{
			if ( $item->Category == $category &&  $item->StorageId == $storageid)
				return $item;
		}
		return null;
	}
	
	function GetAvailableItems($category)
	{
		return $this->GetItems($category,false,false);
	}
	function GetItems($category,$_x161,$_x162)
	{
		$list = array();
		foreach ($this->_items as $item)
		{
			if ($item->Category != $category)
				continue;
			if ($item->AllowAccess == false && !$_x161)
				continue;
			if ($_x162||$item->StorageId != null)
			{
				array_push($list,$item);
			}
		}
		return $list;
	}

}

class RTEConfigSecurity
{
	function RTEConfigSecurity()
	{
		$this->AllowAccess=true;
	}
	
	function DoClone()
	{
		
		$_x74=new RTEConfigSecurity();
		foreach($this as $_x31=>$_x32)
		{
			$_x74->$_x31=$_x32;
		}
		return $_x74;
	}
	
	function __set($_x54,$_x67)
	{
		$this->SetValue($_x54,$_x67);
	}
	function SetValue($_x54,$_x67)
	{
		switch($_x54)
		{
			case "DrawWatermarks":
			case "AllowAccess":
			case "AllowUpload":
			case "AllowCopyFile":
			case "AllowMoveFile":
			case "AllowRenameFile":
			case "AllowDeleteFile":
			case "AllowOverride":
			case "AllowCreateFolder":
			case "AllowCopyFolder":
			case "AllowMoveFolder":
			case "AllowRenameFolder":
			case "AllowDeleteFolder":
				switch(strtolower($_x67))
				{
					case "true":
					case "1":
					case "yes":
						$_x67=true;
						break;
					default:
						$_x67=false;
						break;
				}
			default:
				break;
		}
		
		$this->$_x54=$_x67;
	}
	function __get($_x54)
	{
		return $this->$_x54;
	}
	
	function ValidateFileName($name)
	{
		if(!$this->FilePattern)
			return;
		if(preg_match("/".str_replace("\\u","\\x",$this->FilePattern)."/",$name)==0)
			throw (new Exception("ERROR:FilePattern:"));
	}
	function ValidateFolderName($name)
	{
		if(!$this->FolderPattern)
			return;
		if(preg_match("/".str_replace("\\u","\\x",$this->FolderPattern)."/",$name)==0)
			throw (new Exception("ERROR:FilePattern:"));
	}

}

function rtefilter_strpos($_x68,$_x163,$_x97=null)
{
	$_x97=strpos($_x68,$_x163,$_x97);
	if($_x97===false)
		return -1;
	return $_x97;
}

class RTEFilterEventArgs
{
	public $HtmlCode;
}

class RTEFilter
{
	public $Option = "None";
	public $AllowScriptCode = false;
	public $EditCompleteDocument = false;
	public $CheckTag;
	public $CheckAttr;
	public $CheckStyle;
	public $UseHTMLEntities = true;
	public $URLType = "Default";
	

	function Apply($_x82)
	{
		if ($_x82 == null)
			return "";

		$_x164 = $this->ParseHtmlCode($_x82);

		$this->BuildRelation($_x164);

		if (!$this->AllowScriptCode) 
			$this->RemoveScriptCode($_x164);

		if (!$this->EditCompleteDocument)
			$this->RemoveOuterCode($_x164);

		if ($this->CheckTag != null||$this->CheckAttr != null||$this->CheckStyle != null)
			$this->DoCheckTagAttrStyle($_x164);
		if ($this->URLType != "Default")
			$this->DoFixURLType($_x164);

		if ($this->UseHTMLEntities)
			$this->DoEncodeToEntity($_x164);

		if ($this->Option == "HTML2BBCode")
		{
			return RTEBBCodeConverter::HTML2BBCodeForNode($_x164);
		}

		return $this->Render($_x164);
	}


	function DoFixURLType($_x164)
	{
		$_x165 = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
		$_x166 = $_x165.'://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

		$_x167=explode('/',rawurl);
		
		$_x168=implode('/',array_splice($_x167,0,3));
		$_x169 = implode('/',array_splice($_x167,0,count($_x167)-1))."/";
		
		$_x170=strlen($_x168);

		for ($_x45 = $_x164; $_x45 != null; $_x45 = $_x45->NextNode)
		{
			if($_x45->NodeType!="Element")
				continue;
				
			for($_x171=$_x45->element->HeadAttribute;$_x171!=null;$_x171= $_x171 == null ? $element->HeadAttribute : $_x171->NextNode )
			{
				$_x63 = $_x171->Value;

				if (RTEUtil::IsNullOrEmpty(val))
					continue;

				if ($_x171->NameLower != "src" && $_x171->NameLower != "href")
					continue;

				if ($this->URLType == "SiteRelative")
				{
					if (rtefilter_strpos($_x63,"://") == -1)
						continue;
					if(strlen($_x63)<$_x170+1)
						continue;
					if(substr($_x63,$_x170,1)!="/")
						continue;
					if(substr($_x63,0,$_x170)!=$_x168)
						continue;
					$_x171->Value = $_x172($_x63,$_x170);
				}
				else if ($this->URLType == "Absolute")
				{
					if (rtefilter_strpos($_x63,"://") != -1)
						continue;
					if ($_x172($_x63,0,1) == '/')
						$_x171->Value = $_x168 . $_x63;
					else
						$_x171->Value = $_x169 . $_x63;
				}

			}
		}
	}

	function DoCheckTagAttrStyle($_x164)
	{

		$_x173 = false;
		if ($this->CheckAttr != null) $_x173 = true;
		else if ($this->CheckStyle != null) $_x173 = true;

		for ($_x45 = $_x164; $_x45 != null; $_x45 = $_x45->NextNode)
		{
			if($_x45->NodeType!="Element")
				continue;
			
			if ($this->CheckTag != null && !$this->CheckTag->CheckTag($_x45->NameLower))
			{
				$element=$_x45;
				$_x45 = $_x45->PrevNode;
				$element->Remove($element->IsTSS());
				continue;
			}

			if (!$_x173)
				continue;

			for ($_x171 = $_x45->HeadAttribute; $_x171 != null; $_x171 = $_x171 == null ? $_x45->HeadAttribute : $_x171->NextNode)
			{
				if ($this->CheckAttr!=null&&!$this->CheckAttr->CheckAttr($_x45->NameLower, $_x171->NameLower, $_x171->ValueLower))
				{
					$_x171 = $_x171->PrevNode;
					$_x45->RemoveAttribute($_x171);
					continue;
				}
				if ($this->CheckStyle != null && $_x171->NameLower == "style")
				{
					$_x114=explode(";",$_x171->Value);
					$_x174 = false;
					for ($_x12 = 0; $_x12 < count(parts); $_x12++)
					{
						$_x115 = trim($_x114[i]);
						if (strlen($_x115).Length == 0)
						{
							$_x114[i] = null;
							continue;
						}
						$_x102=explode(":",$_x115,2);
						if (count($_x102)==1)
						{
							$_x114[i] = null;
							$_x174 = true;
							continue;
						}
						$_x175 = strtolower(trim($_x102[0]));
						$_x176 = strtolower(trim($_x102[1]));
						if (strlen($_x175) == 0 || strlen($_x176) == 0)
						{
							$_x114[i] = null;
							$_x174 = true;
							continue;
						}
						if (!$this->CheckStyle->CheckStyle($_x45->NameLower, $_x175, $_x176))
						{
							$_x114[i] = null;
							$_x174 = true;
							continue;
						}
					}
					if ($_x174)
					{
						$_x177 = "";
						foreach ($_x114 as $_x115)
						{
							if(RTEUtil::IsNullOrEmpty($_x115))
								continue;
							if(strlen($_x177)==0)
								$_x177=$_x115;
							else
								$_x177=$_x177.";".$_x115;
						}
						$_x171->Value = $_x177;
					}
				}
			}

		}
	}

	function DoEncodeToEntity($_x164)
	{
		for ($_x45 = $_x164; $_x45 != null; $_x45 = $_x45->NextNode)
		{
			if($_x45->NodeType=="Element")
			{
				if($_x45->NameLower=="script")
					continue;
			}
			$_x45->EncodeToEntity();
		}
	}

	function RemoveOuterCode($_x164)
	{
		for ($_x45 = $_x164; $_x45 != null; $_x45 = $_x45->NextNode)
		{
			if($_x45->NodeType!="Element")
				continue;

			switch ($_x45->NameLower)
			{
				case "html":
				case "body":
					$element=$_x45;
					$_x45 = $_x45->PrevNode;
					$element->Remove(false);
					break;
				case "!doctype":
				case "head":
				case "title":
				case "meta":
				case "base":
				case "basefont":
					$element=$_x45;
					$_x45 = $_x45->PrevNode;
					$element->Remove(true);
					break;
			}
		}
	}

	function RemoveScriptCode($_x164)
	{
		for ($_x45 = $_x164; $_x45 != null; $_x45 = $_x45->NextNode)
		{
			if($_x45->NodeType!="Element")
				continue;

			if ($_x45->NameLower == "script" || $_x45->NameLower == "link")
			{
				$_x178=$_x45;
				$_x45 = $_x45->PrevNode;
				$_x178->Remove(true);
				continue;
			}

			if ($_x45->NameLower == "style")
			{
				if ($_x45->EndTag == null)
				{
					$element=$_x45;
					$_x45 = $_x45->PrevNode;
					$element->Remove(true);
					continue;
				}

				//TODO: parse into InnerText , check whether its has @import

				$element=$_x45;
				$_x45 = $_x45->PrevNode;
				$element->Remove(true);
				continue;

			}

			for ($_x171 = $_x45->HeadAttribute; $_x171 != null; $_x171 = $_x171 == null ? $_x45->HeadAttribute : $_x171->NextNode)
			{
				if (substr($_x171->NameLower,0,1) == 'o' && substr($_x171->NameLower,1,1) == 'n')
				{
					$_x171=$_x171->PrevNode;
					$_x45->RemoveAttribute($_x171);
					continue;
				}
				if ($_x171->Value == null)
					continue;

				//TODO: make better
				if (rtefilter_strpos($_x171->ValueLower,"javascript:") != -1)
				{
					$_x171 = $_x171->PrevNode;
					$_x45->RemoveAttribute($_x171);
					continue;
				}
				if ($_x171->NameLower == "style")
				{
					//TODO: make better
					if (rtefilter_strpos($_x171->ValueLower,"behavior")!= -1 || rtefilter_strpos($_x171->ValueLower,"expression") != -1)
					{
						$_x171 = $_x171->PrevNode;
						$_x45->RemoveAttribute($_x171);
						continue;
					}
				}
			}

		}
	}


	function Render($_x164)
	{
		$_x177 = new RTEStringBuilder();
		for ($_x45 = $_x164; $_x45 != null; $_x45 = $_x45->NextNode)
			$_x45->WriteHtmlCode($_x177);
		return $_x177->ToString();
	}

	function BuildRelation($_x164)
	{
		$_x179 = array();
		$_x180=0;
		
		for ($_x45 = $_x164; $_x45 != null; $_x45 = $_x45->NextNode)
		{
			if ($_x180 > 0)
			{
				$_x45->Parent = $_x179[$_x180-1];
			}
			
			if($_x45->NodeType!="Element")
				continue;

			if ($_x45->IsEndTag)
			{
				while ($_x180 > 0)
				{
					$_x181 = $_x179[$_x180-1];
					$_x180--;
					array_pop($_x179);
					if ($_x181->NameLower == $_x45->NameLower)
					{
						$_x181->EndTag = $_x45;
						break;
					}
				}
			}
			else if (!$_x45->IsClosed)
			{
				array_push($_x179,$_x45);
				$_x180++;
			}
		}
	}

	function ParseHtmlCode($_x82)
	{
		$_x164 = new RTEFilterNode();
		$_x182 = $_x164;

		$_x15 = strlen($_x82);
		$_x97 = 0;

		while ($_x97<$_x15)
		{

			$_x183 = rtefilter_strpos($_x82,"<",$_x97);
			if ($_x183 == -1 || $_x183 == $_x15 - 1)
			{
				$_x182=$this->InsertNode(new RTEFilterText(substr($_x82,$_x97, $_x15 - $_x97)), $_x182);
				break;
			}

			if ($_x183 > $_x97)
			{
				$_x182=$this->InsertNode(new RTEFilterText(substr($_x82,$_x97, $_x183 - $_x97)), $_x182);
				$_x97 = $_x183;
			}

			$_x184 = substr($_x82,$_x183+1,1);

			if ($_x184 != '/')
			{
				if ($_x184 == '!')
				{
					if ( $_x183 + 3 < $_x15 && substr($_x82,$_x183 + 2,1) != '-' && substr($_x82,$_x183 + 3,1) != '-')
					{
						$_x185 = rtefilter_strpos($_x82,"-->", $_x183 + 3);
						if ($_x185 != -1)
							$_x185 = $_x185 + 3;
						else
							$_x185 = $_x15;
						$_x182=$this->InsertNode(new RTEFilterComment(substr($_x82,$_x183, $_x185 - $_x183)), $_x182);
						$_x97 = $_x185;
						continue;
					}
				}
				else if ($_x184 == '%' || $_x184 == '?')
				{
					$_x185 = $_x183 + 3 >= $_x15 ? -1 : substr($_x82,$_x184 . ">", $_x183 + 3);
					if ($_x185 != -1)
						$_x185 = $_x185 + 2;
					else
						$_x185 = $_x15;
					$_x182=$this->InsertNode(new RTEFilterOhter(substr($_x82, $_x183, $_x185 - $_x183)), $_x182);
					$_x97 = $_x185;
					continue;
				}
				else if (!RTEUtil::IsLetter($_x184))
				{
					$_x45 = new RTEFilterText("<" . $_x184);
					$_x182=$this->InsertNode($_x45, $_x182);
					$_x97 = $_x183 + 2;
					continue;
				}
			}

			$_x185 = rtefilter_strpos($_x82,'>', $_x183 + 1);
			if ($_x185 == -1)
			{
				$_x182=$this->InsertNode(new RTEFilterText(substr($_x82,$_x97, $_x15 - $_x97)), $_x182);
				break;
			}
			
			$_x185++;

			$element=new RTEFilterElement(substr($_x82,$_x97, $_x185 - $_x97));
			if ($element->IsValid)
			{
				$_x182=$this->InsertNode($element, $_x182);
			}

			$_x97 = $_x185;
		}

		$_x182->NextNode = new RTEFilterNode();
		$_x182->NextNode->PrevNode = $_x182;

		return $_x164;
	}

	function InsertNode($_x45, $_x182)
	{
		$_x182->NextNode = $_x45;
		$_x45->PrevNode = $_x182;
		return $_x45;
	}
	

}

class RTEFilterNode
{
	public $NodeType="Node";
	public $RawCode;
	public $PrevNode;
	public $NextNode;
	public $Parent;
	public $IsModified = false;

	function WriteHtmlCode($_x186)
	{
		$_x186->Append($this->RawCode);
	}
	function EncodeToEntity()
	{
	}

	function ParseNodeName($_x29, $_x187)
	{
		$_x140 = $_x187;
		$_x188=strlen($_x29);
		for (; $_x140 < $_x188; $_x140++)
		{
			$_x30=substr($_x29,$_x140,1);
			if ($_x30=='!'||$_x30 == ':' || $_x30 == '-' || $_x30 == '_')
				continue;
			$_x189=ord($_x30);
			if($_x189>=48&&$_x189<58)
				continue;
			if($_x189>=65&&$_x189<91)
				continue;
			if($_x189>=97&&$_x189<123)
				continue;
			break;
		}
		if ($_x140 > $_x187)
			return substr($_x29,$_x187,$_x140-$_x187);
		return null;
	}
	function SkipWhiteSpace($_x29, $_x187)
	{
		$_x188=strlen($_x29);
		while ($_x187 < $_x188)
		{
			$_x30=substr($_x29,$_x187,1);
			if($_x30==' '||$_x30=='\r'||$_x30=='\n'||$_x30=='\t')
			{
				$_x187++;
			}
			else
			{
				return $_x187;
			}
		}
		return $_x187;
	}
	function HtmlDecode($_x29)
	{
		if ($_x29 == null) 
			return "";
		return html_entity_decode($_x29);
	}


	function HtmlEncode($_x29)
	{
		if ($_x29 == null) 
			return "";
		$_x29=htmlentities($_x29);
		$_x29=str_replace("&#160;", "&nbsp;",$_x29);
		$_x29=str_replace("'", "&apos;",$_x29);
		return $_x29;
	}
}

class RTEFilterText extends RTEFilterNode
{
	public $NewCode = null;
	function RTEFilterText($_x29)
	{
		$this->NodeType="Text";

		$this->RawCode = $_x29;
	}

	function WriteHtmlCode($_x186)
	{
		if ($this->IsModified)
			$_x186->Append($this->NewCode);
		else
			$_x186->Append($this->RawCode);
	}
	function EncodeToEntity()
	{
		$_x29 = $this->HtmlEncode($this->HtmlDecode($this->RawCode));
		if ($_x29 != $this->RawCode)
		{
			$this->IsModified = true;
			$this->NewCode = $_x29;
		}
	}
}
class RTEFilterComment extends RTEFilterNode
{
	function RTEFilterComment($_x29)
	{
		$this->NodeType="Comment";
		$this->RawCode = $_x29;
	}
}
class RTEFilterOhter extends RTEFilterNode
{
	function RTEFilterOhter($_x29)
	{
		$this->NodeType="Other";
		$this->RawCode = $_x29;
	}
}
class RTEFilterElement extends RTEFilterNode
{
	function RTEFilterElement($_x29)
	{
		$this->NodeType="Element";
		
		$this->RawCode = $_x29;

		$_x15 = strlen($_x29);

		$_x184 = substr($_x29,1,1);
		if ($_x184 == '/')
			$this->IsEndTag = true;
		
		$this->Name = $this->ParseNodeName($_x29, $this->IsEndTag ? 2 : 1);
		if ($this->Name == null)
			return;
		$this->NameLower = strtolower($this->Name);

		$_x190=strlen($this->Name) + ($this->IsEndTag ? 2 : 1);
		$_x97 = $_x190;

		while($_x97 < $_x15)
		{
			$_x184 = substr($_x29,$_x97,1);

			if($_x184==' '||$_x184=='\r'||$_x184=='\n'||$_x184=='\t')
			{
				$_x97++;
				continue;
			}


			if ($_x184 == '>')
			{
				$this->IsValid = true;
				return;
			}

			if ($_x184 == '/')
			{
				if ($_x97 == $_x15 - 2 && !$this->IsEndTag)
				{
					$this->IsClosed = true;
					$this->IsValid = true;
				}
				return;
			}

			if ($_x97 == $_x190)
				return;//invalid

			$_x191 = $this->ParseNodeName($_x29, $_x97);
			if ($_x191 == null)
				return;//not valid

			$_x192 = $_x97;
			
			$_x97 += strlen($_x191);

			$_x97=$this->SkipWhiteSpace($_x29, $_x97);

			$_x184 = substr($_x29,$_x97,1);
			
			if ($_x184 != '=')
			{
				//attribute without value
				$this->AddAttribute(new RTEFilterAttribute(substr($_x29,$_x192,$_x97-$_x192),$_x191));
				continue;
			}
			
			$_x97++;

			//attribute with value
			$_x97=$this->SkipWhiteSpace($_x29, $_x97);

			$_x184 = substr($_x29,$_x97,1);
			if ($_x184 == '>')
			{
				$this->AddAttribute(new RTEFilterAttribute(substr($_x29,$_x192,$_x97-$_x192),$_x191));
				break;
			}

			if ($_x184 == '"' || $_x184 == '\'')
			{
				$_x97++;
				$_x193 = rtefilter_strpos($_x29,$_x184,$_x97);
				if ($_x193 == -1)
					return;//invalid
				$_x194 = new RTEFilterAttribute(substr($_x29,$_x192, $_x193 + 1 - $_x192), $_x191);
				$_x194->Quote = $_x184;
				$_x194->SetValueCode(substr($_x29,$_x97, $_x193 - $_x97));
				$this->AddAttribute($_x194);
				$_x97 = $_x193 + 1;
			}
			else
			{
				$_x193 = $_x97+1;
				for (; $_x193 < $_x15;$_x193++ )
				{
					$_x184 = substr($_x29,$_x193,1);
					if ($_x184 == '>')
						break;
					if ($_x184 == '/' && $_x193 == $_x15 - 2)
						break;
					if($_x184==' '||$_x184=='\r'||$_x184=='\n'||$_x184=='\t')
						break;
				}
				$_x194 = new RTEFilterAttribute(substr($_x29,$_x192, $_x193 - $_x192), $_x191);
				$_x194->SetValueCode( substr($_x29,$_x97, $_x193 - $_x97) );
				$this->AddAttribute($_x194);
				$_x97 = $_x193;
			}

		}

		$this->IsValid = true;
	}

	function Remove($_x195)
	{
		$_x196 = $this->PrevNode;
		$_x197 = $this->NextNode;

		if ($this->EndTag != null)
		{
			if ($_x195)
				$_x197 = $this->EndTag->NextNode;
			else
				$this->EndTag->Remove(false);
		}

		if ($_x196 != null) $_x196->NextNode = $_x197;
		if ($_x197 != null) $_x197->PrevNode = $_x196;
	}

	function GetAttribute($_x175)
	{
		for ($_x194 = $this->HeadAttribute; $_x194 != null; $_x194 = $_x194->NextNode)
		{
			if ($_x194->NameLower == $_x175)
				return $_x194->Value;
		}
		return null;
	}

	function RemoveAttribute($_x194)
	{
		$_x196 = $_x194->PrevNode;
		$_x197 = $_x194->NextNode;

		if ($_x196 != null)
			$_x196->NextNode = $_x197;
		else
			$this->HeadAttribute = $_x197;
		if ($_x197 != null)
			$_x197->PrevNode = $_x196;
		else
			$this->LastAttribute = $_x196;

		$this->IsModified = true;
	}

	function EncodeToEntity()
	{
		for ($_x194 = $this->HeadAttribute; $_x194 != null; $_x194 = $_x194->NextNode)
		{
			$_x194->EncodeToEntity();
		}
	}

	function AddAttribute($_x194)
	{
		$_x194->Parent = $this;
		if ($this->HeadAttribute == null)
		{
			$this->HeadAttribute = $_x194;
			$this->LastAttribute = $_x194;
			return;
		}
		$_x194->PrevNode = $this->LastAttribute;
		$this->LastAttribute->NextNode = $_x194;
		$this->LastAttribute = $_x194;
	}

	function WriteHtmlCode($_x186)
	{
		if (!$this->IsModified)
		{
			$_x186->Append($this->RawCode);
			return;
		}

		if ($this->IsEndTag)
		{
			$_x186->Append("</");
			$_x186->Append($this->Name);
			$_x186->Append(">");
			return;
		}
		$_x186->Append("<");
		$_x186->Append($this->Name);

		for ($_x194 = $this->HeadAttribute; $_x194 != null; $_x194 = $_x194->NextNode)
		{
			$_x186->Append(" ");
			$_x194->WriteHtmlCode($_x186);
		}

		if ($this->IsClosed)
			$_x186->Append("/");
		$_x186->Append(">");
	}

	public $Name;
	public $NameLower;
	public $IsValid = false;
	public $EndTag;
	public $IsEndTag = false;
	public $IsClosed = false;
	public $HeadAttribute;
	public $LastAttribute;

	public $BBCodeEndTagCode;

	function IsTSS()
	{
		switch ($this->NameLower)
		{
			case "script":
			case "style":
			case "textarea":
				return true;
		}
		return false;
	}
}

class RTEFilterAttribute extends RTEFilterNode
{
	function RTEFilterAttribute($_x29, $_x191)
	{
		$this->NodeType="Attribute";
		
		$this->RawCode = $_x29;
		$this->Name = $_x191;
		$this->NameLower = strtolower($_x191);
	}

	function WriteHtmlCode($_x186)
	{
		if (!$this->IsModified)
		{
			$_x186->Append($this->RawCode);
			return;
		}

		$_x186->Append($this->Name);
		if ($this->_value == null && $this->_valcode == null)
			return;
		$_x186->Append("=");
		if ($this->Quote != null)
			$_x186->Append($this->Quote);
		if ($this->_valcode != null)
			$_x186->Append($this->_valcode);
		else
			$_x186->Append($this->HtmlEncode($this->_value));
		if ($this->Quote != null)
			$_x186->Append($this->Quote);
	}

	function EncodeToEntity()
	{
		if($this->_valcode==null)
			return;
		$this->_valuelower = null;
		$this->_value = $this->HtmlDecode($this->_valcode);
		$_x198 = $this->HtmlEncode($this->_value);
		if ($_x198 == $this->_valcode)
			return;
		$this->_valcode = null;
		$this->IsModified = true;
		if ($this->Parent != null) $this->Parent->IsModified = true;
	}

	public $Name;
	public $NameLower; 
	public $Quote; 
	private $_valcode;
	private $_value;
	private $_valuelower;
	
	function __set($_x54,$_x67)
	{
		switch($_x54)
		{
			case "Value":
				$this->_value = $_x67;
				$this->_valcode = null;
				$this->_valuelower = null;
				$this->IsModified = true;
				if($this->Parent!=null)$this->Parent->IsModified = true;
				return;
		}
		
		$this->$_x54=$_x67;
	}
	function __get($_x54)
	{
		switch($_x54)
		{
			case "ValueLower":
				if($this->_valuelower!=null)
					return $this->_valuelower;
				if ($this->Value == null)
					return null;
				$this->_valuelower = strtolower($this->_value);
				return $this->_valuelower;
			case "Value":
				if ($this->_value != null)
					return $this->_value;
				if ($this->_valcode == null)
					return null;
				$this->_value = $this->HtmlDecode($this->_valcode);
				return $this->_value;
		}
		
		return $this->$_x54;
	}
	

	function SetValueCode($_x199)
	{
		$this->_value = null;
		$this->_valcode = $_x199;
		$this->_valuelower = null;
	}
}



class RTEBBCodeNode
{
	public $Name;//null means text!
	public $Value;
	public $PrevNode;
	public $NextNode;
	public $EndTag;
	public $Parent;

	function __get($_x54)
	{
		switch($_x54)
		{
			case "IsEndTag":
				if (RTEUtil::IsNullOrEmpty($this->Name))
					return false;
				if (substr($this->Name,0,1) == '/')
					return true;
				return false;
		}
	}
	
	public $IsClosed = false;

	static function CreateText($_x200)
	{
		$_x45 = new RTEBBCodeNode();
		$_x45->Value = $_x200;
		return $_x45;
	}
	static function CreateTag($name, $_x63)
	{
		$_x45 = new RTEBBCodeNode();
		$_x45->Name = $name;
		$_x45->Value = $_x63;
		return $_x45;
	}

	function GetInnerText()
	{
		$_x177 = new RTEStringBuilder();
		for ($_x45 = $this->NextNode; $_x45 != null; $_x45 = $_x45->NextNode)
		{
			if ($_x45->Name != null)
				break;
			if ($_x45->Value != null)
				$_x177->Append($_x45->Value);
		}
		return $_x177->ToString();
	}
}

class RTEBBCodeConverter
{
	static function HTML2BBCode($_x68)
	{
		$_x84=new RTEFilter();
		$_x84->Option="HTML2BBCode";
		return $_x84->Apply($_x68);
	}
	
	static function HTML2BBCodeForNode($_x164)
	{
		$_x201=new RTEBBCodeConverter();
		return $_x201->HTML2BBCodeForNodeInstance($_x164);
	}
	function HTML2BBCodeForNodeInstance($_x164)
	{
		$_x177 = new RTEStringBuilder();
		for ($_x45 = $_x164; $_x45 != null; $_x45 = $_x45->NextNode)
		{
			if($_x45->NodeType=="Text")
			{
				$_x177->Append(html_entity_decode($_x45->IsModified?$_x45->NewCode:$_x45->RawCode));
				continue;
			}
			
			if($_x45->NodeType!="Element")
				continue;
			
			if ($_x45->IsEndTag)
			{
				$_x177->Append($_x45->BBCodeEndTagCode);
				continue;
			}
			
			if ($_x45->IsClosed)
			{
				switch ($_x45->NameLower)
				{
					case "br":
					case "hr":
						$_x177->Append("\r\n");
						break;
					case "img":
						$_x153 = $_x45->GetAttribute("src");
						if (RTEUtil::IsNullOrEmpty($_x153))
							break;
						$_x177->Append("[img]");
						$_x177->Append($_x153);
						$_x177->Append("[/img]");
						break;
				}
				continue;
			}

			if ($_x45->EndTag == null)
				continue;

			switch ($_x45->NameLower)
			{
				case "font":
					$_x202 = $_x45->GetAttribute("name");
					if (!RTEUtil::IsNullOrEmpty($_x202))
					{
						$_x177->Append("[face=" . $_x202 . "]");
						$_x45->EndTag->BBCodeEndTagCode = "[/face]" . $_x45->EndTag->BBCodeEndTagCode;
					}
					$_x57 = $_x45->GetAttribute("size");
					if (!RTEUtil::IsNullOrEmpty($_x57))
					{
						$_x177->Append("[size=" . $_x57 . "]");
						$_x45->EndTag->BBCodeEndTagCode = "[/size]" . $_x45->EndTag->BBCodeEndTagCode;
					}
					break;
				case "strike":
				case "s":
					$_x177->Append("[s]");
					$_x45->EndTag->BBCodeEndTagCode = "[/s]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "u":
					$_x177->Append("[u]");
					$_x45->EndTag->BBCodeEndTagCode = "[/u]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "em":
				case "i":
					$_x177->Append("[i]");
					$_x45->EndTag->BBCodeEndTagCode = "[/i]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "strong":
				case "b":
					$_x177->Append("[b]");
					$_x45->EndTag->BBCodeEndTagCode = "[/b]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "sup":
					$_x177->Append("[sup]");
					$_x45->EndTag->BBCodeEndTagCode = "[/sup]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "sub":
					$_x177->Append("[sub]");
					$_x45->EndTag->BBCodeEndTagCode = "[/sub]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "h1":
				case "h2":
				case "h3":
				case "h4":
				case "h5":
				case "h6":
					$_x177->Append("[h=" . $_x45->NameLower .Substring(1) . "]");
					$_x45->EndTag->BBCodeEndTagCode = "[/h]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "pre":
					$_x177->Append("[pre]");
					$_x45->EndTag->BBCodeEndTagCode = "[/pre]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "p":
				case "div":
				case "fieldset":
					$_x177->Append("[p]");
					$_x45->EndTag->BBCodeEndTagCode = "[/p]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "legend":
					$_x45->EndTag->BBCodeEndTagCode = "\r\n" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "blockquote":
					$_x177->Append("[quote]");
					$_x45->EndTag->BBCodeEndTagCode = "[/quote]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "table":
				case "tr":
				case "td":
					$_x177->Append("[" . $_x45->NameLower . "]");
					$_x45->EndTag->BBCodeEndTagCode = "[/" . $_x45->NameLower . "]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "th":
					$_x177->Append("[td]");
					$_x45->EndTag->BBCodeEndTagCode = "[/td]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "a":
					$_x203 = $_x45->GetAttribute("href");
					if (RTEUtil::IsNullOrEmpty(href))
						break; ;
					$_x177->Append("[url=" . $_x203 . "]");
					$_x45->EndTag->BBCodeEndTagCode = "[/url]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "textarea":
					$_x177->Append("[code]");
					$_x45->EndTag->BBCodeEndTagCode = "[/code]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "ul":
					$_x177->Append("[list]");
					$_x45->EndTag->BBCodeEndTagCode = "[/list]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "ol":
					$_x177->Append("[list=1]");
					$_x45->EndTag->BBCodeEndTagCode = "[/list]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
				case "li":
					$_x177->Append("[*]");
					break;
				case "center":
					$_x177->Append("[align=center]");
					$_x45->EndTag->BBCodeEndTagCode = "[/align]" . $_x45->EndTag->BBCodeEndTagCode;
					break;
			}

			$_x204 = $_x45->GetAttribute("style");

			if (RTEUtil::IsNullOrEmpty($_x204))
				continue;
			
			foreach (explode(";",$_x204) as $_x205)
			{
				$_x97 = rtefilter_strpos($_x205,":");
				if ($_x97 == -1)
					continue;

				$value = trim(substr($_x205,$_x97 + 1));
				if (strlen($value)== 0 || rtefilter_strpos($value,'[') != -1 || rtefilter_strpos($value,']') != -1)
					continue;

				$_x206 = strtolower(trim(substr($_x205,0, $_x97)));

				switch ($_x206)
				{
					case "vertical-align":
						if (strtolower($value) == "sub")
						{
							$_x177->Append("[sub]");
							$_x45->EndTag->BBCodeEndTagCode = "[/sub]" . $_x45->EndTag->BBCodeEndTagCode;
						}
						if (strtolower($value) == "super")
						{
							$_x177->Append("[sup]");
							$_x45->EndTag->BBCodeEndTagCode = "[/sup]" . $_x45->EndTag->BBCodeEndTagCode;
						}
						break;
					case "text-align":
						$_x177->Append("[align=" . $value . "]");
						$_x45->EndTag->BBCodeEndTagCode = "[/align]" . $_x45->EndTag->BBCodeEndTagCode;
						break;
					case "font-weight":
						if (strtolower($value) == "bold")
						{
							$_x177->Append("[b]");
							$_x45->EndTag->BBCodeEndTagCode = "[/b]" . $_x45->EndTag->BBCodeEndTagCode;
						}
						break;
					case "font-style":
						if (strtolower($value) == "italic")
						{
							$_x177->Append("[i]");
							$_x45->EndTag->BBCodeEndTagCode = "[/i]" . $_x45->EndTag->BBCodeEndTagCode;
						}
						break;
					case "text-decoration":
						if (rtefilter_strpos(strtolower($value),"underline")!=-1)
						{
							$_x177->Append("[u]");
							$_x45->EndTag->BBCodeEndTagCode = "[/u]" . $_x45->EndTag->BBCodeEndTagCode;
						}
						if (rtefilter_strpos(strtolower($value),"line-through")!=-1)
						{
							$_x177->Append("[s]");
							$_x45->EndTag->BBCodeEndTagCode = "[/s]" . $_x45->EndTag->BBCodeEndTagCode;
						}
						break;
					case "font-famliy":
						$_x177->Append("[face=" . $value . "]");
						$_x45->EndTag->BBCodeEndTagCode = "[/face]" . $_x45->EndTag->BBCodeEndTagCode;
						break;
					case "font-size":
						$_x177->Append("[size=" . $value . "]");
						$_x45->EndTag->BBCodeEndTagCode = "[/size]" . $_x45->EndTag->BBCodeEndTagCode;
						break;
					case "color":
						$_x177->Append("[color=" . $value . "]");
						$_x45->EndTag->BBCodeEndTagCode = "[/color]" . $_x45->EndTag->BBCodeEndTagCode;
						break;
				}
			}
		}
		return $_x177->ToString();
	}
	static function BBCode2HTML($_x29)
	{
		$_x201=new RTEBBCodeConverter();
		return $_x201->BBCode2HTMLInstance($_x29);
	}
	function BBCode2HTMLInstance($_x29)
	{
		if ($_x29 == null)
			return "";
		
		$_x177 = new RTEStringBuilder();
		$_x164 = $this->ParseBBCode($_x29);
		$this->BuildRelation($_x164);

		for ($_x45 = $_x164; $_x45 != null; $_x45 = $_x45->NextNode)
		{
			if ($_x45->Name == null)
			{
				if ($_x45->Value != null)
				{
					$_x177->Append(str_replace("\n","<br/>",str_replace("\r","",htmlentities($_x45->Value))));
				}
				continue;
			}
			switch (strtolower($_x45->Name))
			{
				case "*":
					$_x177->Append("<li>");
					break;
				case "list":
					$_x177->Append("<ol>");
					break;
				case "/list":
					$_x177->Append("</ol>");
					break;
				case "sub":
					$_x177->Append("<sub>");
					break;
				case "/sub":
					$_x177->Append("</sub>");
					break;
				case "sup":
					$_x177->Append("<sup>");
					break;
				case "/sup":
					$_x177->Append("</sup>");
					break;
				case "s":
					$_x177->Append("<s>");
					break;
				case "/s":
					$_x177->Append("</s>");
					break;
				case "u":
					$_x177->Append("<u>");
					break;
				case "/u":
					$_x177->Append("</u>");
					break;
				case "i":
					$_x177->Append("<i>");
					break;
				case "/i":
					$_x177->Append("</i>");
					break;
				case "b":
					$_x177->Append("<b>");
					break;
				case "/b":
					$_x177->Append("</b>");
					break;
				case "h":
					if ($_x45->EndTag == null)
						break;
					$_x45->EndTag->Value = $_x45->Value;
					$_x177->Append("<h" . $_x45->Value . ">");
					break;
				case "/h":
					if ($_x45->Value == null)
						break;
					$_x177->Append("</h" . $_x45->Value . ">");
					break;
				case "img":
					$_x177->Append("<img src='");
					if ($_x45->Value!=null)
					{
						$_x177->Append(HttpUtility.HtmlEncode($_x45->Value));
						$_x177->Append("'/>");
					}
					break;
				case "/img":
					$_x177->Append("'/>");
					break;
				default:
					$_x177->Append("[");
					$_x177->Append($_x45->Name);
					$_x177->Append("]");
					break;
				case "url":
					$_x177->Append("<a href='");
					if ($_x45->Value != null)
					{
						$_x177->Append(HttpUtility.HtmlEncode($_x45->Value));
					}
					else
					{
						$_x177->Append($_x45->GetInnerText());
					}
					$_x177->Append("'>");
					break;
				case "/url":
					$_x177->Append("</a>");
					break;
				case "email":
					$_x177->Append("<a href='mailto:");
					if ($_x45->Value != null)
					{
						$_x177->Append(HttpUtility.HtmlEncode($_x45->Value));
					}
					else
					{
						$_x177->Append($_x45->GetInnerText());
					}
					$_x177->Append("'>");
					break;
				case "/email":
					$_x177->Append("</a>");
					break;
				case "color":
					$_x177->Append("<font");
					if ($_x45->Value != null)
					{
						$_x177->Append(" color='");
						$_x177->Append(HttpUtility.HtmlEncode($_x45->Value));
						$_x177->Append("'");
					}
					$_x177->Append(">");
					break;
				case "/color":
					$_x177->Append("</font>");
					break;
				case "face":
					$_x177->Append("<font");
					if ($_x45->Value != null)
					{
						$_x177->Append(" name='");
						$_x177->Append(HttpUtility.HtmlEncode($_x45->Value));
						$_x177->Append("'");
					}
					$_x177->Append(">");
					break;
				case "/face":
					$_x177->Append("</font>");
					break;
				case "size":
					$_x177->Append("<font");
					if ($_x45->Value != null)
					{
						if ($this->OnlyNumber($_x45->Value))
						{
							$_x177->Append(" size='");
							$_x177->Append(HttpUtility.HtmlEncode($_x45->Value));
							$_x177->Append("'"); 
						}
						else
						{
							$_x177->Append(" style='font-size:");
							$_x177->Append(HttpUtility.HtmlEncode($_x45->Value));
							$_x177->Append("'");
						}
					}
					$_x177->Append(">");
					break;
				case "/size":
					$_x177->Append("</font>");
					break;
				case "align":
					$_x177->Append("<div style='");
					if ($_x45->Value != null)
					{
						$_x177->Append("text-align:");
						$_x177->Append(HttpUtility.HtmlEncode($_x45->Value));
					}
					$_x177->Append("'>");
					break;
				case "/align":
					$_x177->Append("</div>");
					break;
				case "quote":
					$_x177->Append("<blockquote>");
					break;
				case "/quote":
					$_x177->Append("</blockquote>");
					break;
				case "pre":
					$_x177->Append("<pre>");
					break;
				case "/pre":
					$_x177->Append("</pre>");
					break;
				case "p":
					$_x177->Append("<p>");
					break;
				case "/p":
					$_x177->Append("</p>");
					break;
				case "table":
					$_x177->Append("<table>");
					break;
				case "/table":
					$_x177->Append("</table>");
					break;
				case "tr":
					$_x177->Append("<tr>");
					break;
				case "/tr":
					$_x177->Append("</tr>");
					break;
				case "td":
					$_x177->Append("<td>");
					break;
				case "/td":
					$_x177->Append("</td>");
					break;
				case "code":
					$_x177->Append("<textarea class='ubb_tag_code' style='width:400px;height:240px;'>");
					break;
				case "/code":
					$_x177->Append("</textarea>");
					break;
			}
		}
		return $_x177->ToString();
	}

	function ParseBBCode($_x82)
	{
		$_x164 = new RTEBBCodeNode();
		$_x182 = $_x164;

		$_x15 = strlen($_x82);
		$_x207 = $_x15 - 1;
		$_x97 = 0;
		
		while ($_x97 < $_x15)
		{
			$_x183 = rtefilter_strpos($_x82,'[', $_x97);
			if ($_x183 == -1 || $_x183 == $_x207)
			{
				$_x182=$this->InsertNode(RTEBBCodeNode::CreateText(substr($_x82,$_x97, $_x15 - $_x97)), $_x182);
				break;
			}

			$_x208 = strpos($_x82,']', $_x183);
			if ($_x208 == -1)
			{
				$_x182=$this->InsertNode(RTEBBCodeNode::CreateText(substr($_x82,$_x97, $_x15 - $_x97)), $_x182);
				break;
			}

			if ($_x183 > $_x97)
			{
				$_x182=$this->InsertNode(RTEBBCodeNode::CreateText(substr($_x82,$_x97, $_x183 - $_x97)), $_x182);
				$_x97 = $_x183;
			}

			$_x184 = substr($_x82,$_x183 + 1,1);

			if ($_x184!='/'&&!RTEUtil::IsLetter($_x184))
			{
				if ($_x184 == '*' && $_x183 + 2 == $_x208)
				{
					$_x182=$this->InsertNode(RTEBBCodeNode::CreateTag("*", null), $_x182);
					$_x97 = $_x183 + 3;
					continue;
				}

				$_x182=$this->InsertNode(RTEBBCodeNode::CreateText("[" . $_x184), $_x182);
				$_x97 = $_x183 + 2;
				continue;
			}

			$_x209=false;
				
			for ($_x183 = $_x97+2; $_x183 < $_x15; $_x183++)
			{
				$_x184 = substr($_x82,$_x183,1);
				if ($_x184 == ']')
				{
					$_x182=$this->InsertNode(RTEBBCodeNode::CreateTag(substr($_x82,$_x97 + 1, $_x183 - $_x97 - 1), null), $_x182);
					$_x97 = $_x208 + 1;
					$_x209=true;
					break;
				}
				if ($_x184 == '=')
				{
					$_x182=$this->InsertNode(RTEBBCodeNode::CreateTag(substr($_x82,$_x97 + 1, $_x183 - $_x97 - 1), substr($_x82,$_x183 + 1, $_x208 - $_x183 - 1)), $_x182);
					$_x97 = $_x208 + 1;
					$_x209=true;
					break;
				}
				if (RTEUtil::IsLetter($_x184))
					continue;
				break;
			}
			
			if($_x209)
				continue;
				
			$_x97++;

		}

		$_x182->NextNode = new RTEBBCodeNode();
		$_x182->NextNode->PrevNode = $_x182;

		return $_x164;
	}
	function BuildRelation($_x164)
	{
		$_x179 = array();
		$_x180=0;
		for ($_x45 = $_x164; $_x45 != null; $_x45 = $_x45->NextNode)
		{
			if ($_x45->Name == null)
				continue;
			if ($_x45->IsEndTag)
			{
				$_x210=strtolower(substr($_x45->Name,1));
				while ($_x180 > 0)
				{
					$_x181 = array_pop($_x179);
					$_x180--;
					if($_x181->NameLower==$_x210)
					{
						$_x181->EndTag = $_x45;
						break;
					}
				}
			}
			else
			{
				if ($_x180 > 0)
				{
					$_x45->Parent = $_x179[$_x180-1];
				}
				if (!$_x45->IsClosed)
				{
					array_push($_x179,$_x45);
					$_x180++;
				}
			}
		}
	}
	function InsertNode($_x45, $_x182)
	{
		$_x182->NextNode = $_x45;
		$_x45->PrevNode = $_x182;
		return $_x45;
	}

	function OnlyNumber($_x68)
	{
		if (RTEUtil::IsNullOrEmpty($_x68))
			return true;
		$_x15=strlen($_x68);
		for($_x12=0;$_x12<$_x15;$_x12++)
		{
			$_x189=ord(substr($_x68,$_x12,1));
			if($_x189>=48&&$_x189<58)
				continue;
			return false;
		}
		return true;
	}
}


class RTEAllMatchItem
{
	public $NextItem;
	function IsMatch($_x175, $_x176)
	{
		return true;
	}
}
class RTENameMatchItem
{
	public $NextItem;
	public $MatchName;
	function IsMatch($_x175, $_x176)
	{
		if($_x175 == $this->MatchName)
		{
			
			return true;
		}
		return false;
	}
}

class RTEMatchList
{
	static function Parse($_x211, $_x212)
	{
		if ($_x211 == null)
			$_x211 = $_x212;
		if ($_x211 == null)
			return null;
		return RTEMatchList::ParseItem($_x211);
	}
	static function ParseItem($_x213)
	{
		if ($_x213 == null)
			return null;
		$_x213=trim($_x213);
		if (strlen($_x213)== 0)
			return null;

		$list = new RTEMatchList();
		if ($_x213 == "*")
		{
			$list->_item = new RTEAllMatchItem();
			return $list;
		}

		$_x214 = null;
		$_x215 = null;

		foreach (explode(",",strtolower($_x213)) as $_x101)
		{
			$_x115 = trim($_x101);
			if(strlen($_x115)==0)
				continue;
			$item = new RTENameMatchItem();
			$item->MatchName = $_x115;

			if ($_x214 == null)
			{
				$_x214 = $item;
				$_x215 = $item;
			}
			else
			{
				$_x215->NextItem = $item;
				$_x215 = $item;
			}
		}

		$list->_item = $_x214;
		return $list;
	}


	public $_item;

	function IsMatch($_x175, $_x176)
	{
		if($this->_item==null)
		{
			return true;
		}
		for ($item = $this->_item; $item != null; $item = $item->NextItem)
		{
			if ($item->IsMatch($_x175, $_x176))
				return true;
		}
		return false;
	}
}


class RTEMatchHandler
{
	public $TagWhiteList;
	public $TagBlackList;
	public $AttrWhiteList;
	public $AttrBlackList;
	public $StyleWhiteList;
	public $StyleBlackList;

	function InitFilter($_x84)
	{
		if ($this->TagWhiteList != null || $this->TagBlackList != null)
			$_x84->CheckTag = $this;
		if ($this->AttrWhiteList != null || $this->AttrBlackList != null)
			$_x84->CheckAttr = $this;
		if ($this->StyleWhiteList != null || $this->StyleBlackList != null)
			$_x84->CheckStyle = $this;
	}
	function CheckTag($_x175)
	{
		if ($this->TagBlackList != null)
			if ($this->TagBlackList->IsMatch($_x175, ""))
				return false;
		if ($this->TagWhiteList != null)
			if (!$this->TagWhiteList->IsMatch($_x175, ""))
				return false;
		return true;
	}
	function CheckAttr($_x216, $_x175, $_x176)
	{
		if ($this->AttrBlackList != null)
			if ($this->AttrBlackList->IsMatch($_x175, $_x176))
				return false;
		if ($this->AttrWhiteList != null)
			if (!$this->AttrWhiteList->IsMatch($_x175, $_x176))
				return false;
		return true;
	}
	function CheckStyle($_x216, $_x175, $_x176)
	{
		if ($this->StyleBlackList != null)
			if ($this->StyleBlackList->IsMatch($_x175, $_x176))
				return false;
		if ($this->StyleWhiteList != null)
			if (!$this->StyleWhiteList->IsMatch($_x175, $_x176))
				return false;
		return true;
	}
}

class RTEUtil
{
	static function IsNullOrEmpty($_x68)
	{
		if($_x68==null)
			return true;
		if($_x68=="")
			return true;
		return false;
	}
	static function IsLetter($_x30)
	{
		$_x189=ord($_x30);
		
		if($_x189>=65&&$_x189<91)
			return true;
		if($_x189>=97&&$_x189<123)
			return true;
		return false;
	}
	static function ExtractPlainTextWithLinefeedsOutOfHtml($_x217)
	{
		return $_x217;
	}
}
class RTEStringBuilder
{
	var $list=array();
	function Append($_x68)
	{
		if($_x68)array_push($this->list,$_x68);
	}
	function ToString()
	{
		return implode("",$this->list);
	}
}



?>