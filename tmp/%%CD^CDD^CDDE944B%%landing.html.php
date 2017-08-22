<?php /* Smarty version 2.6.13, created on 2012-03-27 17:34:07
         compiled from RedRushWeb//landing.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MARLBORO RED RUSH</title>
<?php echo '
<link href="css/redrush.css" rel="stylesheet" type="text/css" />
<link href="css/parallax.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.5.js"></script>
<script type="text/javascript" src="js/parallax.js"></script>
<script type="text/javascript" src="js/jquery-animate-css-rotate-scale.js"></script>
<script type="text/javascript" src="js/jqueryResize.js"></script>
<script type="text/javascript" src="js/jquery-css-transform.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="css/ie7.css">
<![endif]-->
<!--[if gt IE 7]>
	<link rel="stylesheet" type="text/css" href="css/ie8.css">
<![endif]-->
<style type="text/css">
	@-moz-document url-prefix()
	{
		.wstep4
		{
			position:absolute;
			top:50%;
			margin:200px 0 0 0;
		}
		
	}
</style>
<script language="JavaScript" type="text/javascript">
<!--
//v1.7
// Flash Player Version Detection
// Detect Client Browser type
// Copyright 2005-2008 Adobe Systems Incorporated.  All rights reserved.
var isIE  = (navigator.appVersion.indexOf("MSIE") != -1) ? true : false;
var isWin = (navigator.appVersion.toLowerCase().indexOf("win") != -1) ? true : false;
var isOpera = (navigator.userAgent.indexOf("Opera") != -1) ? true : false;
function ControlVersion()
{
	var version;
	var axo;
	var e;
	// NOTE : new ActiveXObject(strFoo) throws an exception if strFoo isn\'t in the registry
	try {
		// version will be set for 7.X or greater players
		axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7");
		version = axo.GetVariable("$version");
	} catch (e) {
	}
	if (!version)
	{
		try {
			// version will be set for 6.X players only
			axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6");
			
			// installed player is some revision of 6.0
			// GetVariable("$version") crashes for versions 6.0.22 through 6.0.29,
			// so we have to be careful. 
			
			// default to the first public version
			version = "WIN 6,0,21,0";
			// throws if AllowScripAccess does not exist (introduced in 6.0r47)		
			axo.AllowScriptAccess = "always";
			// safe to call for 6.0r47 or greater
			version = axo.GetVariable("$version");
		} catch (e) {
		}
	}
	if (!version)
	{
		try {
			// version will be set for 4.X or 5.X player
			axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.3");
			version = axo.GetVariable("$version");
		} catch (e) {
		}
	}
	if (!version)
	{
		try {
			// version will be set for 3.X player
			axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.3");
			version = "WIN 3,0,18,0";
		} catch (e) {
		}
	}
	if (!version)
	{
		try {
			// version will be set for 2.X player
			axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
			version = "WIN 2,0,0,11";
		} catch (e) {
			version = -1;
		}
	}
	
	return version;
}
// JavaScript helper required to detect Flash Player PlugIn version information
function GetSwfVer(){
	// NS/Opera version >= 3 check for Flash plugin in plugin array
	var flashVer = -1;
	
	if (navigator.plugins != null && navigator.plugins.length > 0) {
		if (navigator.plugins["Shockwave Flash 2.0"] || navigator.plugins["Shockwave Flash"]) {
			var swVer2 = navigator.plugins["Shockwave Flash 2.0"] ? " 2.0" : "";
			var flashDescription = navigator.plugins["Shockwave Flash" + swVer2].description;
			var descArray = flashDescription.split(" ");
			var tempArrayMajor = descArray[2].split(".");			
			var versionMajor = tempArrayMajor[0];
			var versionMinor = tempArrayMajor[1];
			var versionRevision = descArray[3];
			if (versionRevision == "") {
				versionRevision = descArray[4];
			}
			if (versionRevision[0] == "d") {
				versionRevision = versionRevision.substring(1);
			} else if (versionRevision[0] == "r") {
				versionRevision = versionRevision.substring(1);
				if (versionRevision.indexOf("d") > 0) {
					versionRevision = versionRevision.substring(0, versionRevision.indexOf("d"));
				}
			}
			var flashVer = versionMajor + "." + versionMinor + "." + versionRevision;
		}
	}
	// MSN/WebTV 2.6 supports Flash 4
	else if (navigator.userAgent.toLowerCase().indexOf("webtv/2.6") != -1) flashVer = 4;
	// WebTV 2.5 supports Flash 3
	else if (navigator.userAgent.toLowerCase().indexOf("webtv/2.5") != -1) flashVer = 3;
	// older WebTV supports Flash 2
	else if (navigator.userAgent.toLowerCase().indexOf("webtv") != -1) flashVer = 2;
	else if ( isIE && isWin && !isOpera ) {
		flashVer = ControlVersion();
	}	
	return flashVer;
}
// When called with reqMajorVer, reqMinorVer, reqRevision returns true if that version or greater is available
function DetectFlashVer(reqMajorVer, reqMinorVer, reqRevision)
{
	versionStr = GetSwfVer();
	if (versionStr == -1 ) {
		return false;
	} else if (versionStr != 0) {
		if(isIE && isWin && !isOpera) {
			// Given "WIN 2,0,0,11"
			tempArray         = versionStr.split(" "); 	// ["WIN", "2,0,0,11"]
			tempString        = tempArray[1];			// "2,0,0,11"
			versionArray      = tempString.split(",");	// [\'2\', \'0\', \'0\', \'11\']
		} else {
			versionArray      = versionStr.split(".");
		}
		var versionMajor      = versionArray[0];
		var versionMinor      = versionArray[1];
		var versionRevision   = versionArray[2];
        	// is the major.revision >= requested major.revision AND the minor version >= requested minor
		if (versionMajor > parseFloat(reqMajorVer)) {
			return true;
		} else if (versionMajor == parseFloat(reqMajorVer)) {
			if (versionMinor > parseFloat(reqMinorVer))
				return true;
			else if (versionMinor == parseFloat(reqMinorVer)) {
				if (versionRevision >= parseFloat(reqRevision))
					return true;
			}
		}
		return false;
	}
}
function AC_AddExtension(src, ext)
{
  if (src.indexOf(\'?\') != -1)
    return src.replace(/\\?/, ext+\'?\'); 
  else
    return src + ext;
}
function AC_Generateobj(objAttrs, params, embedAttrs) 
{ 
  var str = \'\';
  if (isIE && isWin && !isOpera)
  {
    str += \'<object \';
    for (var i in objAttrs)
    {
      str += i + \'="\' + objAttrs[i] + \'" \';
    }
    str += \'>\';
    for (var i in params)
    {
      str += \'<param name="\' + i + \'" value="\' + params[i] + \'" /> \';
    }
    str += \'</object>\';
  }
  else
  {
    str += \'<embed \';
    for (var i in embedAttrs)
    {
      str += i + \'="\' + embedAttrs[i] + \'" \';
    }
    str += \'> </embed>\';
  }
  document.write(str);
}
function AC_FL_RunContent(){
  var ret = 
    AC_GetArgs
    (  arguments, ".swf", "movie", "clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
     , "application/x-shockwave-flash"
    );
  AC_Generateobj(ret.objAttrs, ret.params, ret.embedAttrs);
}
function AC_SW_RunContent(){
  var ret = 
    AC_GetArgs
    (  arguments, ".dcr", "src", "clsid:166B1BCA-3F9C-11CF-8075-444553540000"
     , null
    );
  AC_Generateobj(ret.objAttrs, ret.params, ret.embedAttrs);
}
function AC_GetArgs(args, ext, srcParamName, classid, mimeType){
  var ret = new Object();
  ret.embedAttrs = new Object();
  ret.params = new Object();
  ret.objAttrs = new Object();
  for (var i=0; i < args.length; i=i+2){
    var currArg = args[i].toLowerCase();    
    switch (currArg){	
      case "classid":
        break;
      case "pluginspage":
        ret.embedAttrs[args[i]] = args[i+1];
        break;
      case "src":
      case "movie":	
        args[i+1] = AC_AddExtension(args[i+1], ext);
        ret.embedAttrs["src"] = args[i+1];
        ret.params[srcParamName] = args[i+1];
        break;
      case "onafterupdate":
      case "onbeforeupdate":
      case "onblur":
      case "oncellchange":
      case "onclick":
      case "ondblclick":
      case "ondrag":
      case "ondragend":
      case "ondragenter":
      case "ondragleave":
      case "ondragover":
      case "ondrop":
      case "onfinish":
      case "onfocus":
      case "onhelp":
      case "onmousedown":
      case "onmouseup":
      case "onmouseover":
      case "onmousemove":
      case "onmouseout":
      case "onkeypress":
      case "onkeydown":
      case "onkeyup":
      case "onload":
      case "onlosecapture":
      case "onpropertychange":
      case "onreadystatechange":
      case "onrowsdelete":
      case "onrowenter":
      case "onrowexit":
      case "onrowsinserted":
      case "onstart":
      case "onscroll":
      case "onbeforeeditfocus":
      case "onactivate":
      case "onbeforedeactivate":
      case "ondeactivate":
      case "type":
      case "codebase":
      case "id":
        ret.objAttrs[args[i]] = args[i+1];
        break;
      case "width":
      case "height":
      case "align":
      case "vspace": 
      case "hspace":
      case "class":
      case "title":
      case "accesskey":
      case "name":
      case "tabindex":
        ret.embedAttrs[args[i]] = ret.objAttrs[args[i]] = args[i+1];
        break;
      default:
        ret.embedAttrs[args[i]] = ret.params[args[i]] = args[i+1];
    }
  }
  ret.objAttrs["classid"] = classid;
  if (mimeType) ret.embedAttrs["type"] = mimeType;
  return ret;
}
// -->
</script>
'; ?>

</head>
<!--[if !IE]><!-->


<body id="landing" style="overflow: auto;" data-rendering="true" onload="document.getElementById('loading').style.display = 'none'; document.body.style.overflow = 'auto'; setrightheight();">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "RedRushWeb/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    
<div  id="container" style="height:9000px;">
  <div id="red">
    <div class="w1000">
      <div style="opacity: 1;" id="intro">
        <h1>this is<br />
          what you<br />
          signed up for</h1>
      </div><!-- END #intro -->
      <div style="position: fixed; top: 0px;" id="thecars">
        <div style="opacity: 1;" id="mobil1"></div>
        <div style="opacity: 0;" id="mobil2"></div>
        <div style="opacity: 0;" id="mobil3"></div>
      </div><!-- END #thecars -->
    </div><!-- END .w1000 -->
  </div><!-- END #red -->
  
  <div class="w1000">
        <div id="step2" style="position:fixed">
          <div id="step2bg">
            <h1 id="text1">THRILL YOUR<br />SENSES.</h1>
            <h2 id="text2" style="opacity: 0;">YOUR BEST EXPERIENCE YET.</h2>
            <div id="talent1" style="opacity: 0;"></div>
            <div id="talent2" style="opacity: 0;"></div>
          </div> <!-- END #step2bg -->
        </div> <!-- END #step2 -->
       
        <div style="position: fixed;  opacity: 0;" id="step3">
              <div id="peoples2"></div>
              <div id="car3" style="opacity: 0;"></div>
              <div id="car4" style="opacity: 0;"></div>
        </div><!-- #step3 -->
        <div class="wstep4">
        <div style="opacity: 0;" id="step4">
          <div class="wrapper">
            <div class="logo"> <a href="#">&nbsp;</a> </div>
            <!-- .logo -->
            <div class="panel" style="margin:120px 0 0 -300px;">
              <div class="entry">
                <div class="welcome-box">
                  <h1>Welcome, racers!</h1>
                  <p>RedRush invites you to join your peers in an immersive journey of high-charged fun, designed around the exciting world of Motorsport. Experience the thrills and get a chance to experience an unforgettable week in Italy! </p>
                </div>
                <!-- .welcome-box -->
                <div class="video-home" style="position:absolute;">
                                    <!-- saved from url=(0013)about:internet -->
                    <script language="JavaScript" type="text/javascript">
                        AC_FL_RunContent(
                            'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
                            'width', '440',
                            'height', '380',
                            'src', 'video/video_landing',
                            'quality', 'high',
                            'pluginspage', 'http://www.adobe.com/go/getflashplayer',
                            'align', 'middle',
                            'play', 'false',
                            'loop', 'true',
                            'scale', 'showall',
                            'wmode', 'transparent',
                            'devicefont', 'false',
                            'id', 'video_landing',
                            'bgcolor', '#ffffff',
                            'name', 'video/video_landing',
                            'menu', 'true',
                            'allowFullScreen', 'false',
                            'allowScriptAccess','sameDomain',
                            'movie', 'video/video_landing',
                            'salign', ''
                            ); //end AC code
                    </script>
                    <noscript>
                        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="440" height="380" id="video/video_landing" align="middle">
                        <param name="allowScriptAccess" value="sameDomain" />
                        <param name="allowFullScreen" value="false" />
                        <param name="movie" value="video/video_landing.swf" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="bgcolor" value="#ffffff" />	<embed src="video/video_landing.swf" quality="high" wmode="transparent" bgcolor="#ffffff" width="440" height="380" name="video/video_landing" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
                        </object>
                    </noscript>
                    
               </div>
                <!-- .video-home -->
              </div>
              <!-- .entry -->
            </div>
            <!-- .panel -->
            <div class="peoples" style="margin:120px 0 0 -680px;"></div>
          </div>
          <!-- .wrapper -->
        </div>
        </div>
  </div><!-- .w1000 -->
  <a  id="scrolldown"></a>
 
</div> <!-- END #container -->


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "RedRushWeb/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<!--<![endif]-->    
    <div id="iepar">
    	
<!--[if IE]><!-->

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "RedRushWeb/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    
  <div id="red-ie">
    <div class="w1000">
      <div style="opacity: 1; z-index:1;" id="intro">
        <h1 style="font-size:100px;">this is<br />
          what you<br />
          signed up for</h1>
      </div>
      <!-- END #intro -->
        <div id="mobil2-ie"></div>
    </div>
  </div>
  <div id="step2-ie">
        <h1 id="text1" style="margin:40px 0 0 -500px;">THRILL YOUR<br />
          SENSES.</h1>
        <h2 id="text2" style="opacity: 1; margin:380px 0 0 -490px;">YOUR BEST EXPERIENCE YET.</h2>
        <div id="talent1" style="opacity: 1;"></div>
        <div id="talent2" style="opacity: 1; margin:220px 0 0 -500px;"></div>
  </div>
  <div id="step3-ie">
      <div id="peoples2" style="top:500px;"></div>
      <div id="car4" style="opacity: 1;"></div>
        <div id="talent1" style="opacity: 1;"></div>
        <div id="talent2" style="opacity: 1; margin:220px 0 0 -500px;"></div>
  </div>
      
        <div style="opacity: 1;" id="step4-ie">
          <div class="wrapper">
            <div class="logo"> <a href="#">&nbsp;</a> </div>
            <!-- .logo -->
            <div class="panel" style="margin:120px 0 0 -300px;">
              <div class="entry">
                <div class="welcome-box">
                  <h1>Welcome, racers!</h1>
                  <p>RedRush invites you to join your peers in an immersive journey of high-charged fun, designed around the exciting world of Motorsport. Experience the thrills and get a chance to experience an unforgettable week in Italy! </p>
                </div>
                <!-- .welcome-box -->
                <div class="video-home" style="position:absolute;">
                                    <!-- saved from url=(0013)about:internet -->
                    <script language="JavaScript" type="text/javascript">
                        AC_FL_RunContent(
                            'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
                            'width', '440',
                            'height', '380',
                            'src', 'video/video_landing',
                            'quality', 'high',
                            'pluginspage', 'http://www.adobe.com/go/getflashplayer',
                            'align', 'middle',
                            'play', 'false',
                            'loop', 'true',
                            'scale', 'showall',
                            'wmode', 'transparent',
                            'devicefont', 'false',
                            'id', 'video_landing',
                            'bgcolor', '#ffffff',
                            'name', 'video/video_landing',
                            'menu', 'true',
                            'allowFullScreen', 'false',
                            'allowScriptAccess','sameDomain',
                            'movie', 'video/video_landing',
                            'salign', ''
                            ); //end AC code
                    </script>
                    <noscript>
                        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="440" height="380" id="video/video_landing" align="middle">
                        <param name="allowScriptAccess" value="sameDomain" />
                        <param name="allowFullScreen" value="false" />
                        <param name="movie" value="video/video_landing.swf" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="bgcolor" value="#ffffff" />	<embed src="video/video_landing.swf" quality="high" wmode="transparent" bgcolor="#ffffff" width="440" height="380" name="video/video_landing" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
                        </object>
                    </noscript>
                    
               </div>
                <!-- .video-home -->
              </div>
              <!-- .entry -->
            </div>
            <!-- .panel -->
            <div class="peoples" style="margin:120px 0 0 -680px;"></div>
          </div>
          <!-- .wrapper -->
        </div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "RedRushWeb/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--<![endif]-->
    </div>
</body>

</html>