

<?php

	
	



if (isset($_POST['send'])){

	$result="";
	$nameError="";
	$emailError="";
	$subjectError="";
	$messageError="";
	require 'phpmailer/PHPMailerAutoload.php';
	include 'phpmailer/class.smtp.php';

	$mail = new PHPMailer;
	
	
	if(empty($_POST["f_name"]))
	{
		$nameError = "Name is required";
	}
	else
	{
		$nameError="";
	}
	if(empty($_POST["f_email"]))
	{
		$emailError = "Email is required";
	}
	else
	{
		$email=$_POST["f_email"];
		if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email))
		{
			$emailError = "Email format not valid";
		}
	}
	if(empty($_POST["f_subject"]))
	{
		$subjectError = "subject is required";
	}
	$f_msg = $_POST['f_msg'];
	$fmsg = implode(" ",$f_msg);
	$chcktxtbox = trim($fmsg);
	if(empty($chcktxtbox))
	{
		$messageError = "message is required";
	}
	if( !($_POST["f_name"]=='') && !($_POST["f_email"]=='') && !($_POST["f_subject"]=='') &&!($_POST["f_msg"]=='') )
	{
		if(preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email))
		{
			
			$mail->isSMTP();
			$mail->Host='mail.petrosar.my';
			$mail->Port=465;
			$mail->SMTPAuth=true;
			$mail->SMTPSecure='ssl';
			$mail->Username='admin@petrosar.my';
			$mail->Password='Petros@r!';

			$mail->setFrom('admin@petrosar.my');
			$mail->addAddress('abdshkr@gmail.com', 'Website Contact');
			$mail->addReplyTo($_POST['f_email'],$_POST['f_name']);
			$f_msg = $_POST['f_msg'];
			$fmsg = implode(" ",$f_msg);

			$mail->isHTML(true);
			$mail->Subject='Petrosar Online Contact Form : '.$_POST['f_subject'];
			$mail->Body='<p style=font-size:14pt; color:#1A6FB0; font-family:arial;> you have received a message from '.$_POST['f_name'].', '.$_POST['f_email'].'. <br><br>Message<br> '.$fmsg.'</p>';
			$location = "./contact.php#row-contact-2";
			if(!$mail->send()){
				$result="Something went wrong. Please try again";
			}
			else{
				$nametxt="";
				$result="Thank you ".$_POST['f_name']." for contacting us. We will get back to you soon!.";
				
				
			}
		}
	}
	

	


}
else if(isset($_POST['submit']))
{	
	$result1 = "";
	
	$nameError1="";
	$emailError1="";
	$posError="";
	$fileError="";
	$contactError="";
	require 'phpmailer/PHPMailerAutoload.php';
	include 'phpmailer/class.smtp.php';

	$mail = new PHPMailer;

	if(empty($_POST["cv_name"]))
	{
		$nameError1 = "Name is required";
	}
	else
	{
		$nameError1="";
	}
	if(empty($_POST["cv_mail"]))
	{
		$emailError1 = "Email is required";
	}
	else
	{
		$email=$_POST["cv_mail"];
		if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email))
		{
			$emailError1 = "Email format not valid";
		}
	}
	if(empty($_POST["cv_pos"]))
	{
		$posError = "Position application is required";
	}

	if(empty($_POST["cv_contact"]))
	{
		$contactError = "Contact Number is required";
	}

	$maxsize = 2 * 1024 * 1024; // 2 MB
	$types = array('text/pdf');
	$uploadfile = tempnam(sys_get_temp_dir(), hash('sha256', $_FILES['file']['name']));
	$filename = $_FILES['file']['name'][$key]; 
	
	if(filesize($uploadfile) == 0)
	{
		$fileError = "Please check your attachment";
	}

	if(filesize($filename) > $maxsize)
	{
		$fileError = "Max size 2MB Only";
	}


	
	if( !($_POST["cv_name"]=='') && !($_POST["cv_mail"]=='') && !($_POST["cv_pos"]=='') &&!($_POST["cv_contact"]=='') &&!($uploadfile=='')  )
	{
		if(preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email))
		{	
			if(filesize($uploadfile) < $maxsize )
			{
				$mail->isSMTP();
				$mail->Host='mail.petrosar.my';
				$mail->Port=465;
				$mail->SMTPAuth=true;
				$mail->SMTPSecure='ssl';
				$mail->Username='admin@petrosar.my';
				$mail->Password='Petros@r!';
			
				if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
					$mail->setFrom('admin@petrosar.my');
					$mail->addAddress('abdshkr@gmail.com', 'Job Applicants');
					$mail->addReplyTo($_POST['cv_mail'],$_POST['cv_name']);
					$mail->addAttachment($uploadfile, $_POST['cv_name'].'-cv.pdf');

					

					$mail->isHTML(true);
					$mail->Subject='Petrosar Online Job Application For '.$_POST['cv_pos'];
					$mail->Body='<p style=font-size:14pt; color:#1A6FB0; font-family:arial;> you have received job application from:-<br>Name : '.$_POST['cv_name'].'<br>Email : '.$_POST['cv_mail'].'<br>Contact Number : '.$_POST['cv_contact'].'<br>Position : '.$_POST['cv_pos'].'<br> Please refer to the attachment below for your reference.'; 
				
				
				}

				if(!$mail->send()){
					$result1="Something went wrong. Please try again";
				}
				else{
					$fileError ="";
					$result1="Thank you ".$_POST['cv_name']." for your application. We will get back to you soon!.";

				}
			}
			else{
				$fileError = "Max size 2MB Only";
			}
		}
	}



}
?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--CSS IMPORT-->
	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/contact.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" 
		integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" 
		crossorigin="anonymous">

	<!--JS Import And CODE-->
	<!-- jQuery library -->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> 
	<script type="text/javascript" src="./scripts/jquery/contact-txtbox.js"></script> 
	<script type="text/javascript" src="./scripts/jquery/navbar.js"></script> 

	<!-- Bootstrap JS -->
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<link rel="icon" href="./img/petrosar-icon.ico">
	<title>CONTACT - PETROSAR ACADEMY</title>

</head>
<body>

<!--HEAD-->
<div class="head-section">
	<div class="navigation-menu">
		<nav class="navbar  navbar-fixed-top" style="padding-top:5%" id="navigation-bar">
			<div class="container-fluid" style="padding-right:7%; padding-left:7%;">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle custom-toggler" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					</button>
					<a class="navbar-brand" href="./index.html"><img src="./img/LOGO1.png" id="img-logo"></a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav navbar-right">
						<li><a id ="anav" style="border-left:2px solid white;" href="./index.html">&nbsp;&nbsp;HOME&nbsp;&nbsp;</a></li>
						<li><a id ="anav" style="border-left:2px solid white;" href="./about.html">&nbsp;&nbsp;ABOUT US&nbsp;&nbsp;</a></li>
						<li><a id ="anav" style="border-left:2px solid white;" href="./course.html">&nbsp;&nbsp;COURSE&nbsp;&nbsp;</a></li>
						<li><a id ="anav" style="border-left:2px solid white;" href="./media.html">&nbsp;&nbsp;MEDIA&nbsp;&nbsp;</a></li>
						<li><a id ="anav" style="border-left:2px solid white; border-right:2px solid white;" href="./contact.php">&nbsp;&nbsp;CONTACT US&nbsp;&nbsp;</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	<div class="container-fluid" id="head-content" >
		<div class="row">
			<div class="col-lg-5">
				<h1>Contact</h1>
			</div>
		</div>
	</div>
</div>


<div class="contact-section" >
	<div class="container-fluid" id="contact-content"> 
		<div class="row" id="row-stripe-line">
			<div class="col-12" id="stripline">
				<hr style="border-color:#1A6FB0; display:block; border-width: 60px; visibility: hidden;">
			</div>
		</div>
		<div class="row " id="row-contact-1">
			<div class="col-lg-3 col-md-12 col-sm-12"  id="col-contact-1"  >
				<div class="box-1">
					<h3>Address</h3> 
					<p>B325-B329,
					   <br>Level 3, Block B2,
					   <br>ICOM Square, 93450 Kuching,
					   <br>Sarawak, Malaysia.</p>
				</div>
				<hr style="border-color:#1A6FB0; display:block; border-width: 2px; ">
				<div class="box-1">
					<h3>Phone</h3>
					<p>+ 6 082 620 858</p>
				</div>
					<hr style="border-color:#1A6FB0; display:block; border-width: 2px; ">
				<div class="box-1">
					<h3>Enquiry</h3>
					<p><b>Media</b>
					   <br>If you have any media enquiries please email us at 
					   <a href = "mailto:media@petrosar.com.my?subject = Feedback&body = Message"> media@petrosar.com.my</a>
					   <br><br>    
					   <b>Investor Relations</b>
					   <br>If you have any IR enquiries please email us at <a href = "mailto:ir.info@petrosar.com.my?subject = Feedback&body = Message"> ir.info@petrosar.com.my</a>
						  
						  </p>
				</div>
			</div>
			<div class="col-lg-9 col-md-12 col-sm-12"  id="col-contact-2"  >
				<div class="cointainer" id="mapouter" >
					 <iframe id="gmap_canvas" 
					 src="https://maps.google.com/maps?q=B325-B329%2C%20Level%203%2C%20Block%20B2%2C%20ICOM%20Square%2C%2093450%20Kuching%2C%20Sarawak%2C%20Malaysia.B325-B329%2C%20Level%203%2C%20Block%20B2%2C%20ICOM%20Square%2C%2093450%20Kuching%2C%20Sarawak%2C%20Malaysia.&t=&z=13&ie=UTF8&iwloc=&output=embed" 
					 frameborder="0" 
					 scrolling="no" 
					 marginheight="0" 
					 marginwidth="0">
					 </iframe>
				</div>
			</div>
		</div>

		<div class="row" id="row-stripe-line">
			<div class="col-12">
				<hr style="border-color:#1A6FB0; display:block; border-width: 2px; ">
			</div>
		</div>

		<form action="contact.php#row-contact-2" method="POST" enctype="multipart/form-data">
			<div class="row " id="row-contact-2">
				<div class="col-lg-4 col-md-12 col-sm-12" id="col-contact-1-2">
					<h3>
						<span style="font-family:'montserrat.Light';">Do you have</span>
						<br>
						<span style="font-family:'montserrat.SemiBold'">Any Question?</span>
					</h3>
					<h4><img src="img/block-Yellow.png" style="align-content: left;"> Online Contact</h4>
				</div>

				<div class="col-lg-8 col-md-12 col-sm-12"  id="col-contact-2-2" >
					<div class="container-fluid" id="form-online">

						<div class="row">
							<div class="col-lg-6" >
								<div class="nice-wrap">
									<input class="nice-textbox" id="txtname" name="f_name" type="text" placeholder = "Please type your name" value="<?php if (!empty($nametxt)) {echo $nametxt;} ?>">
									<label class="nice-label" id="lblname" >Name</label>
									<?php if (!empty($nameError)) { ?>
										<span class="error" style="color:red;"><?php echo $nameError; ?></span>
									<?php }?>
								</div>
							</div>
							<div class="col-lg-6" >
								<div class="nice-wrap">
									<input class="nice-textbox" id="txtsubject" name="f_subject" type="text" placeholder = "Please type your subject">
									<label class="nice-label" id="lblsubject" >Subject</label>
									<?php if (!empty($subjectError)) { ?>
										<span class="error" style="color:red;"><?php echo $subjectError; ?></span>
									<?php }?>
								</div>
							</div>
						</div>
						<!-- utk message, cuba tukar ke textarea ikut contoh ni https://codepen.io/ellissei/pen/rVMqQY -->
						<div class="row">
							<div class="col-lg-6">
								<div class="nice-wrap">
									<input class="nice-textbox" id="txtemail" name="f_email" type="text" placeholder = "Please type your email">
									<label class="nice-label" id="lblemail" >Email</label>
									<?php if (!empty($emailError)) { ?>
										<span class="error" style="color:red;"><?php echo $emailError; ?></span>
									<?php }?>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="nice-wrap">
									<input class="nice-textbox" wrap="hard" type="text" id="txtmsg" placeholder = "Please type your message" name = "f_msg[]" >
									<label class="nice-label" id="lblmsg" >Message</label>
									<input class="nice-textbox" wrap="hard" type="text" id="txtmsg" name = "f_msg[]">
									<input class="nice-textbox" wrap="hard" type="text" id="txtmsg" name = "f_msg[]">
									<input class="nice-textbox" wrap="hard" type="text" id="txtmsg" name = "f_msg[]">
									<?php if (!empty($messageError)) { ?>
										<span class="error" style="color:red;"><?php echo $messageError; ?></span>
									<?php }?>
								</div>
							</div>
						</div>
							
						<div class="row" style="padding-right:15px;">
							<div class="col-12">
								<!--<a href="#" id="con-submit" class="btn btn-lg" style="float:right; margin-bottom:30px">SEND</a>-->
								<?php if (empty($result)) { ?>
									<input type="submit" name="send" value="SEND" id="con-submit" class="btn btn-lg" style="float:right; margin-bottom:30px" /> 
								<?php } else {?>

									<div class="msg" style="float:right;margin-bottom:30px; color:#1A6FB0;">
										<p><?php echo $result; ?></p>
									</div>
								<?php } ?>
									
							</div>
						</div>
						
					</div>
				</div>
			</div>
</form>
<form action="contact.php#row-contact-3" method="POST" enctype="multipart/form-data">
			<div class="row " id="row-contact-3">
				<div class="col-lg-4 col-md-12 col-sm-12"  id="col-contact-1-3">
					<span>
						<h3 style="display:inline;">Job</h3>
						<h3 style="font-weight:600; display:inline;">Application</h3>
					</span>
					<h4 style="color:#FEE014;"><img src="img/block-Yellow.png" style="align-content: left;"> Online Submission</h4>
				</div>
				<div class="col-lg-8 col-md-12 col-sm-12"  id="col-contact-2-3">
					<div class="container-fluid" id="form-cv">
						<div class="row">
							<div class="col-lg-6" >
								<div class="nice-wrap">
									<input class="nice-textbox" id="txtname1" type="text" placeholder = "Please type your name" name="cv_name">
									<label class="nice-label" id="lblname1" >Name</label>
									<?php if (!empty($nameError1)) { ?>
										<span class="error" style="color:red;"><?php echo $nameError1; ?></span>
									<?php }?>
								</div>
							</div>
							<div class="col-lg-6" >
								<div class="nice-wrap">
									<input class="nice-textbox" id="txtposition" type="text" placeholder = "Your position applied" name="cv_pos">
									<label class="nice-label" id="lblposition" >Position Applied</label>
									<?php if (!empty($posError)) { ?>
										<span class="error" style="color:red;"><?php echo $posError; ?></span>
									<?php }?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6" >
								<div class="nice-wrap">
									<input class="nice-textbox" id="txtemail1" type="text" placeholder = "Please type your email" name="cv_mail">
									<label class="nice-label" id="lblemail1" >Email</label>
									<?php if (!empty($emailError1)) { ?>
										<span class="error" style="color:red;"><?php echo $emailError1; ?></span>
									<?php }?>
								</div>
							</div>
							<div class="col-lg-6" >
								<div class="upload-wrap"style="border-bottom:2px solid #1A6FB0; padding-bottom:5px;" >
									<div class="row" style="margin-top:0;  padding:0;">
										<div class="col-xs-12 col-md-6 col-lg-6" style="margin-top:0; margin-left:0; padding:0; ">
											<p id="txtUpload">UPLOAD CV / RESUME</p>
											
												<p style="font-style:'HelvaticaNeue Light'; font-size:1rem; color:#1A6FB0;">Max Size: 2MB</p>
											
										</div>
										<div class="col-xs-12 col-md-6 col-lg-6" style="margin-top:0; margin-left:0; padding:0; ">
											<!--
											<label for="file"><input name="file" type="file" id="file" accept="application/pdf" class="inputFile" style="width: 0.1px; height: 0.1px; opacity: 0; overflow: hidden;position: absolute; z-index: -1;">Choose File</label>
										
											<br style="line-height:35px;">
										
											<div class="fieldControl">
												<div class="customFile rightBtn" data-display="vertical" data-label="Choose File..">
													<span class="selectedFile">No file selected</span>
													<input type="file" name="file" id="file" accept="application/pdf" value="Profession" />
												</div>
											</div>	-->
											<div class="customFile rightBtn" data-display="vertical" data-label="Choose File..">
											<input id="upload" type="file" name="file" id="file" accept="application/pdf" style="display:none;"/>
											<a class="btn-upload" id="upload_link" data-label="Choose File..">Choose File..</a>
									
											<br>
											<br>
											<?php if (!empty($fileError)) { ?>
												<span class="error" style="color:red;"><?php echo $fileError; ?></span>
											<?php } else {?>
												
												<p class="selectedFile"style="float:right;font-family:'HelveticaNeue Light'; font-size:1rem; color:#1A6FB0;">No file choosen</p>
											<?php }?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6" >
								<div class="nice-wrap">
									<input class="nice-textbox" id="txtContact" type="text" placeholder = "Please type your contact no" name="cv_contact">
									<label class="nice-label" id="lblContact" >Contact No</label>
									<?php if (!empty($contactError)) { ?>
											<span class="error" style="color:red;"><?php echo $contactError; ?></span>
									<?php }?>
								</div>
							</div>
							<div class="col-lg-6" >
								<div class="nice-wrap">
									<!--<a href="#" id="con-submit" class="btn btn-lg" style="float:right; margin-bottom:30px">SUBMIT</a>-->
									<?php if (empty($result1)) { ?>
								   		<input type="submit" name="submit" value="SUBMIT" id="con-submit" class="btn btn-lg" style="float:right; margin-bottom:30px" /> 
									<?php } else {?>

											<div class="msg" style="float:right;margin-bottom:30px; color:#1A6FB0;">
												<p><?php echo $result1; ?></p>
											</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="footer-1">
        <div class="container-fluid">
        <div class="row">
        <div class="col-lg-5 ">
								<a href="./index.html"><img src="./img/LOGO-FOOT.png"></a>
                <br>
                <br>
                <table id="address">
                <tr>
                <td style="width:150px;  vertical-align: text-top;">
                   <P class="text-white">Address</P>
                </td>
                <td style="width:230px;" >
                   <P class="text-white">B325-B329<br>
                                  Level 3, Block B2<br>
                                  ICOM Square, 93450 Kuching<br>
                                  Sarawak, Malaysia.</P>
                </td>
                </tr>
                </table>
                          
        </div>
        
        <div class="col-lg-2">
                <a href='./about.html' id ="link-foot"><h4>ABOUT US</h4></a>
                <hr style="border-color:grey; display:block; border-width: 1px;">
                <p><a href='./about.html#visionmission' id ="link-foot">Our Vision</a><br>
                <a href='./about.html#visionmission' id ="link-foot">Our Mission</a><br>
                <a href='./about.html#valueable' id ="link-foot">Our Value</a><br>
                <a href='./about.html#team' id ="link-foot">Meet Our Team</a><br>
              
        </div>
        <div class="col-lg-3">
                <a href='./course.html' id ="link-foot"><h4>COURSES</h4></a>
                <hr style="border-color:grey; display:block; border-width: 1px;">
                <p><a href='./course.html#col-gas' id ="link-foot">Petroleum & Gas</a><br>
                <a href='./course.html#col-tcimf' id ="link-foot">Training & Consultancy in Management Field</a><br>
                <a href='./course.html#col-drone' id ="link-foot">Drone Operator License Training Course</a><br>
                <a href='./course.html#col-adobe' id ="link-foot">ADOBE</a><br>
                <a href='./course.html#col-driving' id ="link-foot">Defensive Driving Course</a><br>
                <a href='./course.html#col-comp' id ="link-foot">CompTIA</a></p>
        
                
        </div>
        <div class="col-lg-2" >
				<a href='./contact.php' id ="link-foot"><h4>CONTACT</h4></a>
                <hr style="border-color:grey; display:block; border-width: 1px;">
                 <span><a href="https://www.facebook.com/petrosaracademy/" id ="link-foot"><i class="fab fa-facebook-f">&nbsp;</i></a>
                <a href="https://twitter.com/infopetrosar?lang=en" id ="link-foot">&nbsp;<i class="fab fa-twitter">&nbsp;</i></a> 
                <a href="https://www.instagram.com/petrosaracademyofficial/?hl=en" id ="link-foot">&nbsp;<i class="fab fa-instagram"></i></a></span>
                <br>
                <br>
                 
                <table id="address">
                    <tr>
                      <td style="width:120px;  vertical-align: text-top;">
                          <P class="text-white">Tel<br>
                          Media<br>
                          IR</P>
                      </td>
                      <td style="width:230px;" >
                          <P class="text-white">+ 082 620 858<br>
                              media@petrosar.com.my<br>
                              ir.info@petrosar.com.my</P>
                      </td>
                    </tr>
                </table>
            </div>
        </div>
        
        </div>
        </div>
        
        <div class="last-foot">
        <div class="container-fluid">
        <div class="row" style="margin-top:1%;">
        <div class="col-lg-12" style="text-align: center;">
                <p>© Copyright 2018. Petrosar Sarawak All Rights Reserved.</p>
        </div>
        
        </div>
        </div>
        </div>

<!--JS Import And CODE-->
<script>
	(function($) {
    $.fn.mnFileInput = function(params) {
        this.change(function(e) {
          $valueDom = $(this).closest('.customFile').find('.selectedFile');
          // $valueDom.addClass('inProgress');
          var filename = $('.customFile').data('label');
          if(e.target){
            var fullPath = e.target.value;
            filename = fullPath.replace(/^.*[\\\/]/, '');
            $valueDom.text(filename);
            // $valueDom.removeClass('inProgress');
          }
        });
    };
})(jQuery);

$(".customFile > input").mnFileInput();

/*
$(".customFile > input").change(function(e) {
  $valueDom = $(this).closest('.customFile').find('.selectedFile');
  // $valueDom.addClass('inProgress');
  var filename = $('.customFile').data('label');
  if(e.target){
    var fullPath = e.target.value;
    filename = fullPath.replace(/^.*[\\\/]/, '');
    $valueDom.text(filename);
    // $valueDom.removeClass('inProgress');
  }
});
*/
	</script>
<script>
	$(function(){
$("#upload_link").on('click', function(e){
    e.preventDefault();
    $("#upload:hidden").trigger('click');
});
});
</script>



</body>
</html>