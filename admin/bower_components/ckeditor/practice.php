<?php include 'db.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Index</title>
<link rel="Shortcut Icon" href="../favicon.png" type="image/x-png">
<link href="include/css/style.css" rel="stylesheet" type="text/css" />
 <script type='text/javascript' src='http://code.jquery.com/jquery-1.10.1.js'></script>
 
  <style type='text/css'>
 html, body { width:100%;height:100%; margin:0;  background:#FDFDFF;} 
.container{font-size:14px; margin:0 auto; width:100%;}
.test_content{margin:10px 0;}
.scroller_anchor{height:0px; margin:0; padding:0;}
.scroller{border:0px solid #CCC; margin:0; z-index:100; height:45px; top: 0;right:0; text-align:center;left: 0;margin-bottom: 0; font-size:22px;width:100%; position:relative; background-color:#A2CD5A; padding:7px 0 0 0;
-webkit-transform: translate(0,0%);
-moz-transform: translate(0,0%);
-ms-transform: translate(0,0%);
-o-transform: translate(0,0%);
transform: translate(0,0%);
-webkit-transition-property: background, border, -webkit-transform;
-moz-transition-property: background, border, transform;
-ms-transition-property: background, border, -ms-transform;
-o-transition-property: background, border, -o-transform;
transition-property: background, border, transform;
-webkit-transition-duration: 600ms;
-moz-transition-duration: 600ms;
-ms-transition-duration: 600ms;
-o-transition-duration: 600ms;
transition-duration: 600ms;
-webkit-transition-timing-function: ease-out;
-moz-transition-timing-function: ease-out;
-ms-transition-timing-function: ease-out;
-o-transition-timing-function: ease-out;
transition-timing-function: ease-out;
}

.nav{list-style:none; padding:0px; margin:0px;}
.nav li{display:inline-block;}
.nav li a {color:white;}
.left{}
.trick{margin-top:-50px; padding-top:50px;}
.sloozis{background:#CCC;
            border:0px solid #000;
            position:fixed;
            top:-52px;
-webkit-transform: translate(0,100%);
-moz-transform: translate(0,100%);
-ms-transform: translate(0,100%);
-o-transform: translate(0,100%);
transform: translate(0,100%);}
.active{background:pink !important;}

.ebutton{width:100px; height:30px; background: #005BB7; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#FFF; text-align:center; padding:8px 12px 8px 12px; border-radius:6px; cursor:pointer;text-decoration:none; }
.ebutton:hover{ background: #F90;text-decoration:none;}
.ebutton a{text-decoration:none; color:#FFFFFF; }
.ebutton a:hover{text-decoration:none; color:#FFFFFF;}

.ebutton2{width:140px; height:30px; background: #090; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#FFF; text-align:center; padding:8px 12px 8px 12px; border-radius:6px; cursor:pointer; text-decoration:none; }
.ebutton2:hover{ background: #F90; text-decoration:none;}
.ebutton2 a{text-decoration:none; color:#FFFFFF; }
.ebutton2 a:hover{text-decoration:none; color:#FFFFFF;}
  </style>
  


<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
// This function will be executed when the user scrolls the page.
$(window).scroll(function(e) {
    // Get the position of the location where the scroller starts.
    var scroller_anchor = $(".scroller_anchor").offset().top;
    
    // Check if the user has scrolled and the current position is after the scroller's start location and if its not already fixed at the top 
    if ($(this).scrollTop() >= scroller_anchor && $('.scroller').css('position') != 'fixed') 
    {    // Change the CSS of the scroller to hilight it and fix it at the top of the screen.
        $('.scroller').addClass('sloozis');
        // Changing the height of the scroller anchor to that of scroller so that there is no change in the overall height of the page.
        $('.scroller_anchor').css('height', '50px');
    } 
    else if ($(this).scrollTop() < scroller_anchor && $('.scroller').css('position') != 'relative') 
    {    // If the user has scrolled back to the location above the scroller anchor place it back into the content.
        
        // Change the height of the scroller anchor to 0 and now we will be adding the scroller back to the content.
        $('.scroller_anchor').css('height', '0px');
        
        // Change the CSS and put it back to its original position.
        $('.scroller').removeClass('sloozis');
    }
    var lastId,
    topMenu = $(".nav"),
    topMenuHeight = topMenu.outerHeight()+10,
    // All list items
    menuItems = topMenu.find("a"),
    // Anchors corresponding to menu items
    scrollItems = menuItems.map(function(){
      var item = $($(this).attr("href"));
      if (item.length) { return item; }
    });
    
   // Get container scroll position
   var fromTop = $(this).scrollTop()+topMenuHeight;
   
   // Get id of current scroll item
   var cur = scrollItems.map(function(){
     if ($(this).offset().top < fromTop)
       return this;
   });
   // Get the id of the current element
   cur = cur[cur.length-1];
   var id = cur && cur.length ? cur[0].id : "";
   
   if (lastId !== id) {
       lastId = id;
       // Set/remove active class
       menuItems
         .parent().removeClass("active")
         .end().filter("[href=#"+id+"]").parent().addClass("active");
   }                   
});

 $(document).ready(function(e) {
        
        $('#nav ul li a').bind('click', function(e) {
            e.preventDefault();
            $('html,body').animate({scrollTop: $(this.hash).offset().top});                                                         
        });     
         });





});//]]>  

</script>

<!-- code end -->

<style type="text/css">

#wpage {width: 100%;}
#section1 {width:100%; height:50px; background:<?php echo $color1 ?>;}
.toplpage {width:180px;  float:left; font-size:14px; font-family:Arial, Helvetica, sans-serif; font-style:italic; color: #FFC; padding-left:10px; font-weight:bold;  padding-top:10px;}
.toprpage {float:right; padding-right:15px;font-size:20px; font-family:Arial, Helvetica, sans-serif; font-style:italic; color:#FFF; padding-top:10px;}

#section2 {width:100%; height:48px; background:<?php echo $color3 ?>;}
#section2x {width:1000px;}
.section2a {width:70%;  float:left; font-size:14px; font-family:Arial, Helvetica, sans-serif; color:#369; padding-left:10px;  padding-top:15px; text-decoration:none;}
.section2b {float:right; padding-right:15px; padding-top:10px;}

#section3 {width:100%; background:url(images/ebookbg.gif) repeat; min-height: calc(100% - 100px); /* IE9+ and future browsers */
 min-height: -moz-calc(100% - 100px); /* Firefox */
 min-height: -webkit-calc(100% - 100px); /* Chrome, Safari */}

#section4 {width:100%;}
.link { color: #369; text-decoration:none;}
.link:hover {text-decoration:underline;}
 #toTop {
    position: fixed;
    bottom: 0px;
    right: 2px;
    display: none;
	z-index:5000;
    }
</style>
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
$(window).scroll(function() {
    if ($(this).scrollTop()) {
        $('#toTop').fadeIn();
    } else {
        $('#toTop').fadeOut();
    }
});
});//]]>  

</script>
</head>
<body style="background:#FFFFFF;">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
 

</tr>
  <tr bgcolor="#F0FFF0" bordercolor="#000000" border="2">
    <td align="center">
	
		<img src="images/logo.png" width="160" height="60" alt="Logo" /></td>
    <td colspan="2" align="right" style="padding:5px;">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- add7 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-8090673809775219"
     data-ad-slot="5976273006"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script></td>
  </tr>
   <tr><td colspan="3"> <div class="scroller_anchor"></div>
    
    <!-- This div will be displayed as fixed bar at the top of the page, when user scrolls -->
    <div class="scroller">
   <table width="100%" align="center">
   <tr><td> <div id="buttongreen">Home</div></td>
   <td><div id="buttongreen">
   	<?
	$query="select * from class where coursename = '1' and status='Y' ORDER BY ID asc";
	$result=mysql_query($query);
 
			// Here we define the number of columns
	echo "<select>";	// The container table with $cols columns
	do{
		// All the rows will have $cols columns even if
									// the records are less than $cols
			$row=mysql_fetch_array($result);
			if($row){
				$img = $row['pic1'];
 ?>
 <option><a href="subjectdetails.php?class=<?php echo $row[ID] ?>" style="text-decoration:none;"><div id="buttongreen"><?php echo $row[classname] ?></div></a></option> 
<?
			}
			else{
				echo "&nbsp;";	//If there are no more records at the end, add a blank column
			}
		}
	while($row);
	echo "</select>";
 ?>
   
   
   
   
   
   
   
   
   
   
   
   
  
   </div></td>
   <td><div id="buttongreen">Competitive</div></td>
   <td><div id="buttongreen">Professionals</div></td>
   <td><div id="buttongreen">Register</div></td>
   <td><div id="buttongreen">Sign Up</div></td>
   <td><input type="text" name="search" style="width:200px; height:25px; border-radius:20px; border:1px solid <?php echo $color2 ?>; padding-left:10px;background: url('images/searchbg.gif') right no-repeat;" value="<?php echo $_GET[search] ?>" placeholder="search" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }" /></td>
   </tr></table>
    </div>
   <!-- code end ---> 
   </td></tr>
   <tr>
        <td valign="top" colspan="2">
	  <div class="headline">Practice Unlimited Online Tests for Free</div>
<table align="center" width="100%" cellpadding="2" cellspacing="5">
<tr><td>
	  <div id="academic" valign="top" style="margin:30px;">
	  <div id="academicsub">Free Online Practice Tests on CBSE Based Pattern for Academic Classes</div>
	  <div id="academiccontent">
	<table width="100%" cellpadding="2" cellspacing="5">
	<tr>
	<td width="30%" align="center">    
  <div id="academicimage">
  
  <?
	$query="select * from course where ID = '1' and status='Y' ORDER BY ID asc";
	$result=mysql_query($query);
 
	$cols=1;		// Here we define the number of columns
		// The container table with $cols columns
	do{
		
		for($i=1;$i<=$cols;$i++){	// All the rows will have $cols columns even if
									// the records are less than $cols
			$row=mysql_fetch_array($result);
			if($row){
				$img = $row['pic'];
 ?>
 <center>
  <img src="upload/images/<?=$img ?>" width="130" height="130" style="border-radius:5px;" />
  <?
			}
			else{
				echo "<td>&nbsp;</td>";	//If there are no more records at the end, add a blank column
			}
		}
	} while($row);
	
 ?>
  </div>
	</td>
		<td width="70%">
				
	<?
	$query="select * from class where coursename = '1' and status='Y' ORDER BY ID asc";
	$result=mysql_query($query);
 
	$cols=4;		// Here we define the number of columns
	echo "<table>";	// The container table with $cols columns
	do{
		echo "<tr>";
		for($i=1;$i<=$cols;$i++){	// All the rows will have $cols columns even if
									// the records are less than $cols
			$row=mysql_fetch_array($result);
			if($row){
				$img = $row['pic1'];
 ?>
        <td>
            <table>
                <tr valign="top">
                    <td style="font-size:11px; font-family:Verdana, Geneva, sans-serif; color:#090; text-align:center;"><a href="subjectdetails.php?class=<?php echo $row[ID] ?>" style="text-decoration:none;"><div id="buttongreen"><?php echo $row[classname] ?></div></a></td> <!-- columns can have both text and images -->
                    <td>&nbsp;</td>
                    <td width="50">&nbsp;</td>	<!-- Create gap between columns -->
                </tr>
           </table>
        </td>
<?
			}
			else{
				echo "<td>&nbsp;</td>";	//If there are no more records at the end, add a blank column
			}
		}
	} while($row);
	echo "</table>";
 ?>
  
				<br/>
'Practice makes Perfect'. So Don't wait anymore. Start practicing now!!!</td></tr></table>
</div></div>
</td></tr>
<tr>
<td>
	  <div id="competitive" valign="top" style="margin:30px;">
	  <div id="competitivesub">Free Online Practice Tests for Various Competitive Exams Conducted in India</div>
	  <div id="academiccontent">
	<table width="100%" cellpadding="2" cellspacing="5">
	<tr>
	<td width="30%" align="center">    
  <div id="academicimage">
  <?
	$query="select * from course where ID = '2' and status='Y' ORDER BY ID asc";
	$result=mysql_query($query);
 
	$cols=1;		// Here we define the number of columns
		// The container table with $cols columns
	do{
		
		for($i=1;$i<=$cols;$i++){	// All the rows will have $cols columns even if
									// the records are less than $cols
			$row=mysql_fetch_array($result);
			if($row){
				$img = $row['pic'];
 ?>
 <center><h2><?php echo $row[coursename]?></h2>
  <img src="upload/images/<?=$img ?>" width="130" height="130" style="border-radius:5px;" />
  <?
			}
			else{
				echo "<td>&nbsp;</td>";	//If there are no more records at the end, add a blank column
			}
		}
	} while($row);
	
 ?>
  </div>  
  </center>
	</div></td>
		<td width="70%">
		<?
	$query="select * from class where coursename = '2' and status='Y' ORDER BY ID asc";
	$result=mysql_query($query);
 
	$cols=4;		// Here we define the number of columns
	echo "<table>";	// The container table with $cols columns
	do{
		echo "<tr>";
		for($i=1;$i<=$cols;$i++){	// All the rows will have $cols columns even if
									// the records are less than $cols
			$row=mysql_fetch_array($result);
			if($row){
				$img = $row['pic1'];
 ?>
        <td>
            <table>
                <tr valign="top">
                    <td style="font-size:11px; font-family:Verdana, Geneva, sans-serif; color:#090; text-align:center;"><a href="subjectdetails.php?class=<?php echo $row[ID] ?>" style="text-decoration:none;"><div id="buttongreen"><?php echo $row[classname] ?></div></a></td> <!-- columns can have both text and images -->
                    <td>&nbsp;</td>
                    <td width="50">&nbsp;</td>	<!-- Create gap between columns -->
                </tr>
           </table>
        </td>
<?
			}
			else{
				echo "<td>&nbsp;</td>";	//If there are no more records at the end, add a blank column
			}
		}
	} while($row);
	echo "</table>";
 ?>
Above classes contains the online practice test of corresponding subjects like Reasoning aptitude Quantiative Current Affairs etc.</td></tr></table>
</div></div></td></tr>

<tr><td>
	  <div id="professional" valign="top" style="margin:30px;">
	  <div id="professionalsub">Free Online Practice Tests for Various Professional Exams in Conducted in India</div>
	  <div id="academiccontent">
	<table width="100%" cellpadding="2" cellspacing="5">
	<tr>
	<td width="30%" align="center">    
  <div id="academicimage">
  <?
	$query="select * from course where ID = '3' and status='Y' ORDER BY ID asc";
	$result=mysql_query($query);
 
	$cols=1;		// Here we define the number of columns
		// The container table with $cols columns
	do{
		
		for($i=1;$i<=$cols;$i++){	// All the rows will have $cols columns even if
									// the records are less than $cols
			$row=mysql_fetch_array($result);
			if($row){
				$img = $row['pic'];
 ?>
 <center><h2><?php echo $row[coursename]?></h2>
  <img src="upload/images/<?=$img ?>" width="130" height="130" style="border-radius:5px;" />
  <?
			}
			else{
				echo "<td>&nbsp;</td>";	//If there are no more records at the end, add a blank column
			}
		}
	} while($row);
	
 ?>
  </div>
  </center>
	</div></td>
		<td width="70%"><?
	$query="select * from class where coursename = '3' and status='Y' ORDER BY ID asc";
	$result=mysql_query($query);
 
	$cols=4;		// Here we define the number of columns
	echo "<table>";	// The container table with $cols columns
	do{
		echo "<tr>";
		for($i=1;$i<=$cols;$i++){	// All the rows will have $cols columns even if
									// the records are less than $cols
			$row=mysql_fetch_array($result);
			if($row){
				$img = $row['pic1'];
 ?>
        <td>
            <table>
                <tr valign="top">
                    <td style="font-size:11px; font-family:Verdana, Geneva, sans-serif; color:#090; text-align:center;"><a href="subjectdetails.php?class=<?php echo $row[ID] ?>" style="text-decoration:none;"><div id="buttongreen"><?php echo $row[classname] ?></div></a></td> <!-- columns can have both text and images -->
                    <td>&nbsp;</td>
                    <td width="50">&nbsp;</td>	<!-- Create gap between columns -->
                </tr>
           </table>
        </td>
<?
			}
			else{
				echo "<td>&nbsp;</td>";	//If there are no more records at the end, add a blank column
			}
		}
	} while($row);
	echo "</table>";
 ?>
Above classes contains the online practice test of different subjects like Zoology Botany Math Engineering Mathematics Applied Sciences Management and Computer Subjects like Operating System Java DBMS etc
</td></tr></table>
</div></div></td></tr>
 </table>
</td>

	
	   <td width="260" valign="top" style="padding-top:10px;">
	<div id="rightadv">
	<div id="leftsub" align="center">Sponsored Links</div>
	<div id="leftcontent">
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 200x90 link add -->
<ins class="adsbygoogle"
     style="display:inline-block;width:200px;height:90px"
     data-ad-client="ca-pub-8090673809775219"
     data-ad-slot="6986829008"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
    
    <br /><br />
	
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 250x250new -->
<ins class="adsbygoogle"
     style="display:inline-block;width:250px;height:250px"
     data-ad-client="ca-pub-8090673809775219"
     data-ad-slot="4172963403"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script><br /><br />

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 250x250new -->
<ins class="adsbygoogle"
     style="display:inline-block;width:250px;height:250px"
     data-ad-client="ca-pub-8090673809775219"
     data-ad-slot="4172963403"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<br />
</div>
 </div></td>
  </tr>
  <tr>
    <td colspan="2"><div id="leftadvchange" style="margin:30px;">
	<div id="leftadvchangesub">Sponsored Links</div>
    <div id="academiccontent">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- add9 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:580px;height:160px;"
     data-ad-client="ca-pub-8090673809775219"
     data-ad-slot="9119712600"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>


<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 160x90 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:140px;height:160px"
     data-ad-client="ca-pub-8090673809775219"
     data-ad-slot="5010568209"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<br /></div></div></div></td>
  </tr>
  
  <tr height="80" bgcolor="#A2CD5A">
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

</body>
</html>
