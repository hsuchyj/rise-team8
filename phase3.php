<!doctype html>
<html>
<?php
session_start();
$_SESSION["score"] = $_SESSION["score"] + 1;
?>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> FAQ </title>
<link href="css/profile.css" rel="stylesheet" type="text/css">
	
<script>var __adobewebfontsappname__="dreamweaver"</script>
<script src="https://use.edgefonts.net/source-sans-pro:n2:default.js" type="text/javascript"></script>
	
</head>
<body>
<div class="container"> 
  <header>
    <h4 class="logo"> RISE </h4>
    <nav>
      <ul>
        <li><a href="#about"><a href="Rise Home Page.php">HOME</a></a></li>
		<li><a href="#about"><a href="About Page.html">ABOUT</a></a></li>
		<li><a href="#about"><a href="map.html">MAP</a></a></li>
		<li><a href="#about"><a href="FAQ.html">FAQ</a></a></li>
      </ul>
    </nav>
  </header>
	
  <div id="myProgress">
  	<?php echo '<div id="myBar"><h1>Score: <b>'. $_SESSION["score"]  . '</b></h1></div>'; ?>
  </div>
  <section class="about" id="about">
	<h2 class="hidden"> Phase 3: Story Telling Phase </h2>
    <p class="text_column"> Create Draft Language for Your Bill </p>
	<p class="text_column"> Leverage Media to Help Tell Your Story, Continue to Build Relationships & Find Co-Sponsors </p>
	<p class="text_column"> Share Your Personal Story to Help Influence Action by Testifying to Legislators </p>
  </section>
	
  <section class="about" id="about">
    <h2 class="hidden"> Congratulations! You have done your research, built a strong coalition, shared your story and officially created a law! This is the power of hope! #RiseUp! 
      If you have done all of the above statements, please hit "Next page" button to continue.</h2>
  </section>

  <div class="button"><a href="Rise Home Page.php" style="text-decoration:none"><font color=#000000> Logout </font></a></div>
  <div class="button-holder">
		<a class="btn" href="phase4.php"> Next Page</a>
	</div>
  <div class="copyright">&copy;2019 - <strong> JPMorgan Code for Good </strong></div>
</div>
</body>
</html>