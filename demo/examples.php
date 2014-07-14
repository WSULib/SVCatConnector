<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Wayne State University Stack View</title>

<link rel="icon" href="favicon.ico" type="image/x-icon" />

<!-- CSS just for this page -->
<style type="text/css">
h1, h2 {
	margin: 5px 5px 10px 5px;
	padding: 0;
	color:#444;
	font-weight:normal;
}

body {
	font-family:'Helvetica', 'Arial', sans-serif;
	background:#faf5f0;
	min-width:845px;
	max-width:1145px;
	font-size: 1.1em;
  color: #333333;
  border: none;
  line-height:normal;
  margin:0px auto;
}

p {
	margin: 25px 5px 5px 5px;
	font-size: .8em;
}

.container {
	float:left;
	width:45%;
	margin:15px 15px 15px 5px;
	clear:both;
}

.explanation {
	float:left;
	width:48%;
	margin:15px 15px 15px 25px;
}

h1 {
	font-size:2.1em;
	padding-top:9px;
}

h2 {
	font-size:1.2em;	
	color:#F60;
}

a {
    color: #09F;
    text-decoration: none;
}

pre {
	background-color: #fff;
}

#nav {
	padding:0 150px 0 0;
	margin:0;
	list-style-type:none;
	float:right;
}

#nav li {
	display:block;
	float:left;
	padding:0 27px 0 0;
}

#nav li a {
  display:block;
  padding:25px 0 0 0;
}

.footer {
  clear:both;
  font-size:.7em;
  float:right;
  padding:25px 30px 25px 0;
}
</style>

<!-- stackview.css to style the stack -->
<link rel="stylesheet" href="../lib/jquery.stackview.css" type="text/css" />

<!-- stackview.js and all js dependencies -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="../lib/jquery.stackview.min.js"></script>

</head>

<body>

	<h1>Wayne State University Stack View</h1>


<div class="container">
	<form action="examples.php" class="navbar-search pull-left">
      <input type="text" placeholder="Search the shelf" name="q" class="search-query"/>
      <button type="submit" class="btn btn-small"/>
      Go
      </button>
      <button class="btn btn-small">
      <a href="/" style="color:#000">Reset the Search</a>
      </button>
    </form>	
		<div id="worldcat-stack"></div>
		
	</div>
	<?php echo $_GET['q']; ?>
	<script type="text/javascript">
    $(function () { 
		$('#worldcat-stack').stackView({
			// url: 'http://141.217.97.167/z3950/stackview/marc_to_jsonp.php',
			url: 'http://141.217.97.167/z3950/stackview/marc_to_jsonp_scan.php', 
//			url: '../php/marc_to_jsonp.php',
			jsonp: true,
			query: '<?php echo $_GET['q'];?>', 
			ribbon: 'Search Wayne State University Catalog for "<?php echo $_GET['q'];?>"'});
    });
    </script>
	
    <div class="footer">
	  </div>


<!-- js just for this page -->
<script type="text/javascript" src="http://balupton.github.com/jquery-syntaxhighlighter/scripts/jquery.syntaxhighlighter.min.js"></script>
<script type="text/javascript">$.SyntaxHighlighter.init();</script>
</body>
</html>
