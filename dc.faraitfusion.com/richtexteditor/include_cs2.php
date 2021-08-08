<?php

// CuteSoft PHP Library Beta!


// Convert Error to Exception
function exception_error_handler($_x0, $_x1, $_x2, $_x3 )
{
	if($_x0==8)return false;
	throw new ErrorException($_x1, 0, $_x0, $_x2, $_x3);
}
//set_error_handler("exception_error_handler");

ob_start();

class CuteSoftLibrary
{

	function NewGuid()
	{
		return preg_replace_callback("/X/",create_function("",'return substr("0123456789ABCDEF",rand(0,15),1);'),"XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX");
	}
	
	function GetPhyRoot()
	{
		$_x4=@$_SERVER['SCRIPT_FILENAME'];
		if(!$_x4)$_x4=$_SERVER['ORIG_SCRIPT_FILENAME'];
		
		$_x5=$_SERVER['DOCUMENT_ROOT'];
		if($_x5&&$_x5==substr($_x4,0,strlen($_x5)))
		{
			$_x5=str_replace("//","/",str_replace("\\","/",$_x5));
			return $_x5;
		}

		$_x6=$_SERVER['SCRIPT_NAME'];
		$_x4=@$_SERVER['SCRIPT_FILENAME'];
		if(!$_x4)$_x4=$_SERVER['ORIG_SCRIPT_FILENAME'];
		$_x7=strpos($_x4,"\\");
		if($_x7)
			$_x4=str_replace("//","/",str_replace("\\","/",$_x4));
		$_x8=strlen($_x6);
		$_x9=strlen($_x4);
		$_x10=min($_x8,$_x9);
		$_x11=-1;
		for($_x12=0;$_x12<$_x10;$_x12++)
		{
			$_x13=substr($_x6,$_x8-$_x12-1,1);
			if($_x13=="/")
				$_x11=$_x12+1;
			if($_x13==substr($_x4,$_x9-$_x12-1,1))
				continue;
			break;
		}
		if($_x11>-1)
			return substr($_x4,0,$_x9-$_x11);
		return substr($_x4,0,$_x9-$_x8);
	}
		
	function GetWebPath($_x6)
	{
		$_x14=$this->GetPhyRoot();
		$_x4=@$_SERVER['SCRIPT_FILENAME'];
		if(!$_x4)$_x4=$_SERVER['ORIG_SCRIPT_FILENAME'];
		$_x4=str_replace("//","/",str_replace("\\","/",$_x4));
		$_x15=strlen($_x6)-(strlen($_x4)-strlen($_x14));
		$_x16=substr($_x6,0,$_x15);
		return $_x16;
	}
	
	function GetAppRoot()
	{
		return $this->GetWebPath($_SERVER['SCRIPT_NAME']);
	}
	
	function WebToPhy($_x17)
	{
		$_x16=$this->GetAppRoot();
		$_x17=$this->MakeAbsolute($_x17);
		$_x18=strlen($_x16);
		if($_x18>0)
		{
			$_x9=strlen($_x17);
			$_x17=substr($_x17,$_x18,$_x9-$_x18);
		}
		return $this->GetPhyRoot() . $_x17;
	}
	
	function MakeAbsolute($_x17)
	{
		if(substr($_x17,0,1)=="/")
			return $_x17;
		if(substr($_x17,0,1)=="~")
			return $this->GetAppRoot() . substr($_x17,1);

		$_x19=$_SERVER["SCRIPT_NAME"];
		$_x15=strlen($_x19);
		// for the condition "/demo/"
		if(substr($_x19,$_x15-1,1)=="/")
			return substr($_x19,0,$_x15-1)."/$_x17";
		// for the condtion "/demo/index.php"
		$_x20=str_replace("\\","/",dirname($_x19));
		if($_x20=="/")
			return "/$_x17";
		return $_x20."/$_x17";
	}

	
	function FileExists($_x21)
	{
		return file_exists($_x21);
	}
	function GetBaseName($_x17)
	{
		return basename(str_replace("\\","/",$_x17));
	}
	function GetFileNameWithoutExtension($_x17)
	{
		$_x17=$this->GetBaseName($_x17);
		$_x22=$this->GetExtension($_x17);
		return substr($_x17,0,strlen($_x17)-strlen($_x22));
	}
	function GetExtension($_x23)
	{
		$_x22=pathinfo($_x23,PATHINFO_EXTENSION);
		if(!$_x22)return "";
		return ".$_x22";
	}
	function GetFiles($_x24,$_x25)
	{
		if(!$_x25)$_x25="*.*";
		$_x26=glob("$_x24/$_x25");
		if(!$_x26)return array();
		return $_x26;
	}

	function CreateDirectory($_x20)
	{
		if(is_dir($_x20))
			return;
		mkdir($_x20,0777);
	}
	function DeleteFile($_x17)
	{
		if(file_exists($_x17))
		{
			unlink($_x17);
		}
	}
	function DeleteDirectory($_x20)
	{
		if(!is_dir($_x20))
			return;

		foreach(scandir($_x20) as $item)
		{
			if($item=="."||$item=="..")
				continue;
			$item="$_x20/$item";
			if(is_dir($item))
				$this->DeleteDirectory($item);
			else
				$this->DeleteFile($item);
		}
		rmdir($_x20);
	}
	
	function ToJSON($item)
	{
		$_x28=gettype($item);
		switch($_x28)
		{
			case "boolean":
				return $item?"true":"false";
			case "integer":
			case "double":
				return "$item";
			case "string":
				$item=str_replace("\\","\\\\",$item);
				$item=str_replace("\r","\\\r",$item);
				$item=str_replace("\n","\\\n",$item);
				$item=str_replace("\"","\\\"",$item);
				$item=str_replace("'","\\'",$item);
				return "'$item'";
			case "array":
				if(count($item)==0)
					return "[]";
				if(array_key_exists(0,$item))	
				{
					$_x29="[";
					$_x30=count($item);
					for($_x12=0;$_x12<$_x30;$_x12++)
					{
						if($_x12>0)
							$_x29=$_x29.",";
						$_x29=$_x29.$this->ToJSON($item[$_x12]);
					}
					$_x29=$_x29."]";
					return $_x29;
				}
				else
				{
					$_x29="{";
					$_x12=0;
					foreach($item as $_x31=>$_x32)
					{
						if($_x32==null&&gettype($_x32)=="NULL")
							continue;
						if($_x12>0)
							$_x29=$_x29.",";
						$_x29=$_x29."'$_x31':".$this->ToJSON($_x32);
						$_x12++;
					}
					$_x29=$_x29."}";
					return $_x29;
				}
			case "NULL":
				return "null";
			case "object":
				if($item instanceof CuteSoftDateTime)
				{
					return $item->ToJSON();
				}
			case "resource":
			case "unknown type":
			default:
				return "'$_x28'";
		}
	}
	
	function ProcessAjaxPostback()
	{
		if(@$_GET["RTEAjaxInvoke"]!="1")
			return;
		ob_clean();
		$_x33=new CuteSoftAjaxContext();
		$_x33->Process($this);
		exit();
	}
	
	//inherits this function..
	function InvokeAjaxMethod($_x33)
	{
	
	}
	
}

class CuteSoftDateTime
{
	var $time;
	function CuteSoftDateTime($_x35)
	{
		$this->time=$_x35;
	}
	function ToJSON()
	{
		return "new Date(".($this->time*1000).")";
	}
	function GetTime()
	{
		return $this->time;
	}
}

class CuteSoftAjaxContext
{
	public $Instance;
	public $Method;
	public $Arguments;
	public $Result;
	public $Error;

	function Process($_x36)
	{
		$this->Instance=$_x36;
		try
		{
			$this->InternalProcess();
			$doc=new DOMDocument();
			$doc->loadXML("<ajax/>");
			$_x38=$doc->childNodes->item(0);
			$_x39=$doc->createElement("result");
			$this->ConvertToElement($this->Result,$_x39);
			$_x40=$doc->createElement("response");
			$_x38->appendChild($_x40);
			$_x40->appendChild($_x39);
			header("Content-Type: text/xml");
			echo $doc->saveXML();
		}
		catch(Exception $_x41)
		{
			$this->Error=$_x41;
			
			$doc=new DOMDocument();
			$doc->loadXML("<ajax/>");
			$_x38=$doc->childNodes->item(0);
			$_x42=$doc->createElement("exception");
			$_x42->setAttribute("t","Exception");
			$_x42->setAttribute("message", $_x41->getMessage()." @ ".$_x41->getFile().":".$_x41->getLine());
			$_x42->setAttribute("stacktrace", $_x41->getTraceAsString());
			$_x42->textContent=$_x41->getMessage()." @ ".$_x41->getFile().":".$_x41->getLine()."\r\n".$_x41->getTraceAsString();
			$_x38->appendChild($_x42);
			header("Content-Type: text/xml");
			echo $doc->saveXML();
		}
	}
	function InternalProcess()
	{
		$this->Method=$_POST["RTEAjaxInvoke_Method"];
		
		$_x43=$_POST["RTEAjaxInvoke_Arguments"];
		
		$_x43=str_replace("\\\\","\\",$_x43);
		
		$_x43=str_replace("-5",'"',$_x43);
		$_x43=str_replace("-4","'",$_x43);
		$_x43=str_replace("-3","&",$_x43);
		$_x43=str_replace("-2",">",$_x43);
		$_x43=str_replace("-1","<",$_x43);
		$_x43=str_replace("-0","-",$_x43);
		$_x43="<args>$_x43</args>";
		
		$this->Arguments=array();
		$doc=new DOMDocument();
		$doc->loadXML($_x43);
		$_x44=$doc->childNodes->item(0)->childNodes;
		for($_x12=0;$_x12<$_x44->length;$_x12++)
		{
			$_x45=$_x44->item($_x12);
			if($_x45->nodeType!=1)continue;
			array_push($this->Arguments,$this->ConvertFromElement($_x45));
		}
		
		$this->Result=$this->Instance->InvokeAjaxMethod($this);
	}
	
	function ConvertFromElement($element)
	{
		switch($element->getAttribute("t"))
		{
			case "undefined":
				return null;
			case "null":
				return null;
			case "boolean":
				switch(strtolower($element->getAttribute("v")))
				{
					case "true":	return true;
					case "1":		return true;
					case "-1":		return true;
					case "false":	return false;
					case "0":		return false;
					default:
						throw(new Exception("invalid boolean expression:".$element->getAttribute("v")));
				}
			case "number":
				return $element->getAttribute("v")+0;
			case "string":
				return $element->getAttribute("v");
			case "datetime":
				return new CuteSoftDateTime($element->getAttribute("v")/1000);
			case "array":
				$_x47=array();
				$_x44=$element->childNodes;
				for($_x12=0;$_x12<$_x44->length;$_x12++)
				{
					$_x45=$_x44->item($_x12);
					if($_x45->nodeType!=1)continue;
					array_push($_x47,$this->ConvertFromElement($_x45));
				}
				return $_x47;
			case "complex":
				$_x48=new CuteSoftLibrary_Dynamic();
				$_x44=$element->childNodes;
				for($_x12=0;$_x12<$_x44->length;$_x12++)
				{
					$_x45=$_x44->item($_x12);
					if($_x45->nodeType!=1)continue;
					$_x48->SetValue($_x45->getAttribute("p"),$this->ConvertFromElement($_x45));
				}
				return $_x48;
			default:
				throw(new Exception("unknown @t : ".$element->getAttribute("t")));
		}
	}
	function ConvertToElement($item,$element)
	{
		if($item===null)
		{
			$element->setAttribute("t","null");
			return;
		}
		
		$_x28=gettype($item);
		switch($_x28)
		{
			case "boolean":
				$element->setAttribute("t","boolean");
				$element->setAttribute("v",$item?"true":"false");
				return;
			case "integer":
			case "double":
				$element->setAttribute("t","number");
				$element->setAttribute("v",$item);
				return;
			case "string":
				$element->setAttribute("t","string");
				$element->setAttribute("v",$item);
				return;
			case "array":
				if(count($item)==0)
				{
					$element->setAttribute("t","array");
					return;
				}
				if(array_key_exists(0,$item))	
				{
					$element->setAttribute("t","array");
					foreach($item as $_x49)
					{
						$_x50=$element->ownerDocument->createElement("i");
						$this->ConvertToElement($_x49,$_x50);
						$element->appendChild($_x50);
					}
				}
				else
				{
					$element->setAttribute("t","complex");
					foreach($item as $_x51=>$_x49)
					{
						$_x50=$element->ownerDocument->createElement("i");
						$_x50->setAttribute("p",$_x51);
						$this->ConvertToElement($_x49,$_x50);
						$element->appendChild($_x50);
					}
				}
				return;
			case "NULL":
				$element->setAttribute("t","null");
				return;
			case "object":
				if($item instanceof CuteSoftDateTime)
				{
					$element->setAttribute("t","datetime");
					$element->setAttribute("v",$item->GetTime()*1000);
					return;
				}
				$element->setAttribute("t","complex");
				foreach($item as $_x51=>$_x49)
				{
					if($_x49===null)
						continue;
					$_x50=$element->ownerDocument->createElement("i");
					$_x50->setAttribute("p",$_x51);
					$this->ConvertToElement($_x49,$_x50);
					$element->appendChild($_x50);
				}
				return;
			case "resource":
			case "unknown type":
			default:
				$element->setAttribute("t","null");
				return;
		}
	}
}

class CuteSoftLibrary_Dynamic
{
	function SetValue($name,$value)
	{
		$this->$name=$value;
	}
	function __set($name,$value)
	{
		$this->$name=$value;
	}
	function __get($_x54)
	{
		return $this->$_x54;
	}
}

?>