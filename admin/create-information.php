<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
$pname=$_POST['name'];
$ptype=$_POST['category'];
$pfamily=$_POST['asnaffamily'];
$pincome=$_POST['asnafincome'];
$paddress=$_POST['address'];
$pcity=$_POST['asnafcity'];
$pstate=$_POST['asnafstate'];	
$platitude=$_POST['lat'];
$plongitude=$_POST['lng'];


$sql="INSERT INTO asnaf(name,category,AsnafFamily,AsnafIncome,address,AsnafCity,AsnafState, lat,lng) VALUES(:pname,:ptype,:pfamily,:pincome,:paddress,:pcity,:pstate,:platitude,:plongitude)";
$query = $dbh->prepare($sql);
$query->bindParam(':pname',$pname,PDO::PARAM_STR);
$query->bindParam(':ptype',$ptype,PDO::PARAM_STR);
$query->bindParam(':pfamily',$pfamily,PDO::PARAM_STR);
$query->bindParam(':pincome',$pincome,PDO::PARAM_STR);
$query->bindParam(':paddress',$paddress,PDO::PARAM_STR);
$query->bindParam(':pcity',$pcity,PDO::PARAM_STR);
$query->bindParam(':pstate',$pstate,PDO::PARAM_STR);
$query->bindParam(':platitude',$platitude,PDO::PARAM_STR);
$query->bindParam(':plongitude',$plongitude,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Information Created Successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}

	?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Admin Package Creation</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>

</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
              <!--header start here-->
<?php include('includes/header.php');?>
							
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
	<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a><i class="fa fa-angle-right"></i>Create Information </li>
            </ol>
		<!--grid-->
 	<div class="grid-form">
 
<!---->
  <div class="grid-form1">
  	       <h3>Create Informasi</h3>
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" name="package" method="post" enctype="multipart/form-data">
								

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Asnaf Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="name" id="name" placeholder="Nama Asnaf " required>
									</div>
								</div>


								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Asnaf Type</label>
									<div class="col-sm-8">
									   <select class="form-control1" name="category" id="category" onChange="MM_jumpMenu('parent',this,0)" required>
                  							
                  							<option value="" selected="selected" class="form-control">All Type</option>
                 						    <option value="FAKIR ">ASNAF FAKIR </option>
              							    <option value=" MISKIN ">ASNAF MISKIN </option>
              							    <option value=" AMIL ">ASNAF AMIL </option> 
               								<option value=" MUALLAF ">ASNAF MUALLAF </option>
               								<option value=" RIQAB  ">ASNAF RIQAB  </option>
               								<option value=" GHARIMIN  ">ASNAF GHARIMIN  </option>               							
               							 	<option value=" FISABILILLAH  ">ASNAF FISABILILLAH  </option>
               								 <option value=" IBNISABIL   ">ASNAF IBNISABIL  </option>
               							
               							 </select>
									</div>
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Asnaf Family</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="asnaffamily" id="asnaffamily" placeholder=" jumlah keluarga" required>
									</div>
								</div>


								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Asnaf Income</label>
									<div class="col-sm-8">
									   <select class="form-control1" name="asnafincome" id="asnafincome" onChange="MM_jumpMenu('parent',this,0)" required>
                  							
                  							<option value="" selected="selected" class="form-control">All Income</option>
                 						    <option value="ABOVE 1000 ">ABOVE 1000 </option>
              							    <option value="BELOW 1000 ">BELOW 1000 </option>
              							    <option value="BELOW 500 ">BELOW 500 </option> 
               								
               							
               							 </select>
									</div>
								</div>


								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Address</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="address" id="address" placeholder=" Alamat Rumah" required>
									</div>
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">City</label>
									<div class="col-sm-8">
									   <select class="form-control1" name="asnafcity" id="asnafcity" onChange="MM_jumpMenu('parent',this,0)" required>
                  							
                  							<option value="" selected="selected" class="form-control">All City</option>
                 						    <option value="MELAKA TENGAH ">MELAKA TENGAH </option>
              							    <option value="JASIN ">JASIN </option>
              							    <option value="ALOR GAJAH ">ALOR GAJAH </option> 
               								
               							
               							 </select>
									</div>
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">State</label>
									<div class="col-sm-8">
									   <select class="form-control1" name="asnafstate" id="asnafstate" onChange="MM_jumpMenu('parent',this,0)" required>
                  							
                  							<option value="" selected="selected" class="form-control">All State</option>
                 						    <option value="JOHOR">JOHOR </option>
              							    <option value="KEDAH ">KEDAH </option>
              							    <option value="MELAKA ">MELAKA </option> 
               								
               							
               							 </select>
									</div>
								</div>

								
								

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Latitude</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="lat" id="lat" placeholder=" Latitude " required>
									</div>
								</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Longitude</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="lng" id="lng" placeholder="Longitude" required>
									</div>
								</div>		


														


								<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<button type="submit" name="submit" class="btn-primary btn">Create</button>

				<button type="reset" class="btn-inverse btn">Reset</button>
			</div>
		</div>
						
					
						
						
						
					</div>
					
					</form>

     
      

      
      <div class="panel-footer">
		
	 </div>
    </form>
  </div>
 	</div>
 	<!--//grid-->

<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<?php include('includes/footer.php');?>
<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
					<?php include('includes/sidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   

</body>
</html>
<?php } ?>