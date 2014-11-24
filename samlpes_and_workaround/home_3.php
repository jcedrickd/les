<!DOCTYPE html>
<html lang="en"><head>
<?php 
session_start(); 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/verifylogin.php');
?>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://wmsonline.aai.com.ph/favicon.ico">
    
    <title>Logistics Enterprise Systems</title>

    <!-- Bootstrap core CSS -->
    <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/offcanvas.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
    <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/jQuery/nav.js"></script>
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/style.css" />
	
	<script>
function addTab(title, url, mainmenu,mainmenu_title, submenu, submenu_title){
//latest
//alert(title+","+mainmenu+","+mainmenu_title+","+submenu+","+submenu_title);
    if(submenu != ''){
        if ($('#content1').tabs('exists', mainmenu)){
            $('#content1').tabs('select', mainmenu);
        }else{
            var content = "<div title='"+mainmenu+"' id='"+mainmenu+"m' class='easyui-tabs' style='width:100%;'></div>";
            $('#content1').tabs('add',{
                title:mainmenu,
                content:content,
                closable:true
            });
        }

        if ($("#"+mainmenu+"m").tabs('exists', submenu)){
            $("#"+mainmenu+"m").tabs('select', submenu);
        }else{
            var content = "<div title='"+submenu+"' id='"+submenu+"m' class='easyui-tabs' style='width:100%;'></div>";
            $("#"+mainmenu+"m").tabs('add',{
                title:submenu_title,
                content:content,
                closable:true
            });
        }
        if ($("#"+submenu+"m").tabs('exists', title)){
            $("#"+submenu+"m").tabs('select', title);
        }else{
            var content = '<iframe src="'+url+'" frameborder="0" scrolling="auto" id="themeframe" style="width:inherit;height:700px;"></iframe>';
            $("#"+submenu+"m").tabs('add',{
                title:title,
                content:content,
                closable:true
            });
        }
    }else{
        if ($('#content1').tabs('exists', mainmenu)){
            $('#content1').tabs('select', mainmenu);
        }else{
            var content = "<div title='"+mainmenu+"' id='"+mainmenu+"m' class='easyui-tabs' style='width:100%;'></div>";
            $('#content1').tabs('add',{
                title:mainmenu_title,
                content:content,
                closable:true
            });
        }
        if ($("#"+mainmenu+"m").tabs('exists', title)){
            $("#"+mainmenu+"m").tabs('select', title);
        }else{
            var content = '<iframe src="'+url+'" frameborder="0" scrolling="auto" id="themeframe" style="width:inherit;height:700px;"></iframe>';
            $("#"+mainmenu+"m").tabs('add',{
                title:title,
                content:content,
                closable:true
            });
        }
    }

}
	</script>
</head>
  <body>
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="color:white;">Logistics Enterprise Systems</a>
        </div>
        <div class="collapse navbar-collapse" style="float:right;">
          <ul class="nav navbar-nav">
            <li class="active"><a href="logout.php">Log Out</a></li>
            <!--li><a href="#about">About</a></li-->
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->

    <div class="container">

      <div class="row row-offcanvas row-offcanvas-left">
        <!--div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation"-->
        <!--second grid for the width--->
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            
          <div class="list-group" id="nav">
            <ul>
                <?php
/*$host = "localhost"; 
$user = "postgres"; 
$pass = "javasr"; 
$db = "postgres"; 

$con=pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n"); 
$result_menu=  pg_query("SELECT * FROM menus");
pg_prepare($con,"result_submenu","SELECT submenu FROM submenus WHERE menu=$1");
pg_prepare($con,"result_page","SELECT url,page FROM pages WHERE menu=$1 AND submenu=$2");
while ($nest1=  pg_fetch_array($result_menu)){
echo "<li class='active has-sub'><a href='#'><span>".$nest1['menu']."</span></a><ul>";
$result_submenu=  pg_execute($con,"result_submenu",array($nest1['menu']));
    while($nest2=  pg_fetch_array($result_submenu)){
    //echo '<li class="has-sub"><a onClick="addMainTab('."'".str_replace(' ','_',$nest1['menu'].'-'.$nest2['submenu'])."'".','."'".$nest1['menu'].'-'.$nest2['submenu']."'".');" href="#">'.$nest2['submenu'].'</a><ul>';
    echo '<li class="has-sub"><a onClick="addMainTab('."'".str_replace(' ','_',$nest1['menu'])."'".','."'".$nest1['menu']."'".');" href="#">'.$nest2['submenu'].'</a><ul>';
    $result_page=  pg_execute($con,"result_page",array($nest1['menu'],$nest2['submenu']));
        while($nest3=  pg_fetch_array($result_page)){
        //$nest3['url']='/les/other_transaction/transaction/job_order_entry/jo_entry1.php';
        //echo '<li><a href="#" onClick="addTab('."'".str_replace(' ','_',$nest1['menu'].'-'.$nest2['submenu'])."'".','."'".$nest3['page']."'".','."'"."http://".$_SERVER['SERVER_NAME'].'/les/other_transaction/transaction/job_order_entry/jo_entry.php'."'".');">'.$nest3['page'].'</a></li>';      
        echo '<li><a href="#" onClick="addTab('."'".str_replace(' ','_',$nest1['menu'])."'".','."'".$nest3['page']."'".','."'"."http://".$_SERVER['SERVER_NAME'].'/les/other_transaction/transaction/job_order_entry/jo_entry.php'."'".');">'.$nest3['page'].'</a></li>';      
        }
        pg_free_result($result_page);
        echo '</ul></li>';//li for page
    }
    pg_free_result($result_submenu);
    echo '</ul></li>';//li for submenu
}
pg_free_result($result_menu);
pg_close($con);*/

include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
//query the main menu which user is authorized
$result_menu=sybase_query("SELECT DISTINCT menu_category.mcat_name,menu_main.mcategory_ctrlno FROM menu_main 
INNER JOIN user_access_mod ON menu_main.mmain_ctrlno=user_access_mod.mmain_ctrlno
INNER JOIN menu_category ON menu_category.mcategory_ctrlno=menu_main.mcategory_ctrlno
WHERE user_access_mod.user_code='$username' AND user_access_mod.mod_stat_code='S0001' AND 
(menu_category.mcat_name <> 'MODE OF SERVICE' AND menu_category.mcat_name <> 'MAIN')
ORDER BY menu_category.mcat_name ASC");
while($nest1=sybase_fetch_array($result_menu)){
//echo "<li class='active has-sub'><a href='#' onClick="addMainTab('."'".str_replace(' ','_',$nest1['mcat_name'])."'".','."'".$nest1['mcat_name']."'".');"><span>".$nest1['mcat_name']."</span></a><ul>";
echo '<li class="active has-sub"><a onClick="addMainTab('."'".str_replace(' ','_',$nest1['mcat_name'])."'".','."'".$nest1['mcat_name']."'".');" href="#">'.$nest1['mcat_name'].'</a><ul>';
//query the submenu which user is authorized
$result_submenu=sybase_query("SELECT DISTINCT a.mcategory_sub,b.mcat_name FROM menu_main a 
INNER JOIN menu_category b ON b.mcategory_ctrlno=a.mcategory_sub 
INNER JOIN user_access_mod ON a.mmain_ctrlno=user_access_mod.mmain_ctrlno
WHERE a.mcategory_ctrlno=$nest1[mcategory_ctrlno] AND  user_access_mod.user_code='$username' AND user_access_mod.mod_stat_code='S0001'
ORDER BY b.mcat_name ASC");
//determine if main menu has submenu if there is no submenu then show the page directly
$result_check_submenu=sybase_query("SELECT mcategory_sub,mmain_name,url FROM menu_main WHERE mcategory_ctrlno=$nest1[mcategory_ctrlno] ORDER BY mmain_name ASC");
	while($check_submenu=sybase_fetch_array($result_check_submenu)){
		if($check_submenu['mcategory_sub']==0 || $check_submenu['mcategory_sub'] == NULL || $check_submenu['mcategory_sub']== ''){
		//echo '<li><a href="#" onClick="addNoSubTab('."'".$nest1['mcat_name'].'-'.$check_submenu['mmain_name']."'".');">'.$check_submenu['mmain_name'].'</a></li>';
		echo '<li><a href="#" onClick="addTab('."'".$check_submenu['mmain_name']."'".','."'"."http://".$_SERVER['SERVER_NAME']."/".$check_submenu['url']."'".','."'".str_replace(' ','_',$nest1['mcat_name'])."'".','."'".$nest1['mcat_name']."'".','."''".','."''".');">'.$check_submenu['mmain_name'].'</a></li>';
		}
	}
	sybase_free_result($result_check_submenu);
	//when main menu has submenu then loop
	while($nest2=sybase_fetch_array($result_submenu)){
	//echo '<li class="has-sub"><a onClick="addMainTab('."'".str_replace(' ','_',$nest1['mcat_name'].'-'.$nest2['mcat_name'])."'".','."'".$nest1['mcat_name'].'-'.$nest2['mcat_name']."'".');" href="#">'.$nest2['mcat_name'].'</a><ul>';
	echo '<li class="has-sub"><a href="#">'.$nest2['mcat_name'].'</a><ul>';
        $result_page=sybase_query("SELECT mmain_name,url FROM menu_main INNER JOIN user_access_mod ON menu_main.mmain_ctrlno=user_access_mod.mmain_ctrlno
	WHERE user_access_mod.user_code='$username' AND user_access_mod.mod_stat_code='S0001' AND menu_main.mcategory_sub=$nest2[mcategory_sub] AND menu_main.mcategory_ctrlno=$nest1[mcategory_ctrlno]
	ORDER BY mmain_name ASC");
		while($nest3=sybase_fetch_array($result_page)){
		//echo '<li><a href="#" onClick="addTab('."'".str_replace(' ','_',$nest1['mcat_name'].'-'.$nest2['mcat_name'])."'".','."'".$nest3['mmain_name']."'".','."'"."http://".$_SERVER['SERVER_NAME'].'/les/other_transaction/transaction/job_order_entry/helloworld.php'."'".');">'.$nest3['mmain_name'].'</a></li>';
		//echo '<li><a href="#" onClick="addTab('."'".str_replace(' ','_',$nest1['mcat_name'].'-'.$nest2['mcat_name'])."'".','."'".$nest3['mmain_name']."'".','."'"."http://".$_SERVER['SERVER_NAME']."/les/other_transaction/transaction/job_order_entry/jo_entry.php"."'".');">'.$nest3['mmain_name'].'</a></li>';
		echo '<li><a href="#" onClick="addTab('."'".$nest3['mmain_name']."'".','."'"."http://".$_SERVER['SERVER_NAME']."/".$nest3['url']."'".','."'".str_replace(' ','_',$nest1['mcat_name'])."'".','."'".$nest1['mcat_name']."'".','."'".str_replace(' ','_',$nest2['mcat_name'])."'".','."'".$nest2['mcat_name']."'".');">'.$nest3['mmain_name'].'</a></li>';
		}
		echo '</ul></li>';//li for page
	}
	sybase_free_result($result_submenu);
	echo '</ul></li>';
}
sybase_free_result($result_menu);
sybase_close($link);
   ?>
            </ul>
          </div>
        </div>
        <!--second grid for the width--->
        <div class="col-xs-12 col-sm-9 easyui-tabs" id="content1">
          <p class="pull-left visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
        </div><!--/span-->
        
      </div><!--/row-->

      <hr>

      <footer>
        <p style="float:right">Logged in as <?php echo @$_SESSION['fullname']; ?></p>
        <?php include($_SERVER['DOCUMENT_ROOT'].'les/includes/footer.php'); ?>
      </footer>

    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/ie10-viewport-bug-workaround.js"></script>

    <script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/offcanvas.js"></script>
  </body>
</html>