<?php
	$lang2['TEMPLATES_DIR'] = TEMPLATE_DIR.$template_use;
	
	define('TEMPLATES_DIR',$lang2['TEMPLATES_DIR']);
		
	$CSSLoadFile = CSS_DIR."load.php";
	$JavascriptLoadFile = JAVA_DIR."load.php";
	include $CSSLoadFile;
	include $JavascriptLoadFile;

	include SYS_DIR."custom.php";
	
	$weboutput = '';
	
	$all_adminpage = array(
		'home' => MENU_HOME,
		'pegawai' => MENU_PEGAWAI,
		'cpanel' => MENU_HOME,
		'send' => MENU_SEND_SMS,
		'bulk' => MENU_BULK_SMS,
		'inbox' => MENU_INBOX,
		'outbox' => MENU_OUTBOX,
		'sent' => MENU_SENT_ITEM,
		'failed' => MENU_FAILED,
		'change_password' => MENU_PASS,
		'web_config' => MENU_SETUP,
		'logout' => 'Logout'
	);
	
	if ($web->check_login()==1)
	{
		//$weboutput .= '<div id="logobar"><img id="logo" border="0" src="'.SITEURL.'images/logo.png" /></div>';
		$weboutput .= '<div id="logobar"><h1>'.$web->lang['sitename'].'</h1></div>';
		$weboutput .= '<div id="menubar">'.$web->addcontent("page/admin_menu.php").'</div>';
		$weboutput .= '<div class="clear"></div>';
		$webcontent = '';
		
		if ( isset($_GET['content']) )
		{
			$ContentFileGet = $_GET['content'];
			$all_adminpage_key = array_keys($all_adminpage);
			// if (in_array($ContentFileGet,$all_adminpage_key)==true){
				if ( file_exists(CONTENTS_DIR.'page/'.$ContentFileGet.'.php') )
				{
					define('THISFILE',$ContentFileGet);
					$webcontent .= $web->addcontent('page/'.$ContentFileGet.'.php');
				} else {
					$ContentFileGet = 'home';
					$webcontent .= $web->addcontent("page/home.php");
				}
			// } else {
			// 	$ContentFileGet = 'home';
			// 	$webcontent .= $web->addcontent("page/home.php");
			// }
		} else {
			$ContentFileGet = 'home';
			$webcontent .= $web->addcontent("page/home.php");
		}
		
		$weboutput .= '<div id="page"><div id="page-head">'.$all_adminpage[$ContentFileGet].'</div><div id="page-content">'.$webcontent.'</div></div>';
		
	} else {
		$weboutput .= $web->addcontent("page/login.php");
	}
	
	$lang2['CONTENTS'] = $weboutput;
?>