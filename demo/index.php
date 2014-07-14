<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Wayne State University Stack View</title>

<link rel="icon" href="favicon.ico" type="image/x-icon" />

<!-- CSS just for this page -->
<style type="text/css">
body {
	font-family:'Helvetica', 'Arial', sans-serif;
	background: url('../lib/images/lightpaperfibers.png') #fff;
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


.explanation {
	float:left;
	width:48%;
	margin:15px 15px 15px 25px;
}

h1 {
	color: #000;
  font: 400 47px/44px Abril Fatface;
  text-align: center;
  margin: 30px 0 0 0;
  padding: 0;
}

h2 {
	color: #666;
  font: 300 18px/24px "open sans";
  margin: 0 90px 36px 0;
  padding: 0;
  text-align: right;
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

.shelf {
	z-index: -10;
  display: block;
  position: relative;
  top:-80px;
  width: 1000px;
  height: 20px;
  margin: 100px auto 0;
  background-image: -moz-linear-gradient(90deg, #d1d8de 0%, #eff1f3 100%);
  /*FF3.6+ */

  background-image: -webkit-gradient(90deg, left top, right bottom, color-stop(0%, #d1d8de), color-stop(100%, #eff1f3));
  /*Chrome,Safari4+ */

  background-image: -webkit-linear-gradient(90deg, #d1d8de 0%, #eff1f3 100%);
  /*Chrome10+,Safari5.1+ */

  background-image: -o-linear-gradient(90deg, #d1d8de 0%, #eff1f3 100%);
  /* Opera 11.10+ */

  background-image: -ms-linear-gradient(90deg, #d1d8de 0%, #eff1f3 100%);
  /*IE10+ */

  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eff1f3', endColorstr='#d1d8de', GradientType='0' );
  /* IE6-9 */

  -webkit-box-shadow: 0 2px 2px #708698, 0 4px 0 #abb8c3, 0 20px 30px -8px #000000, transparent 0 0 0, transparent 0 0 0, transparent 0 0 0;
  -moz-box-shadow: 0 2px 2px #708698, 0 4px 0 #abb8c3, 0 20px 30px -8px #000000, transparent 0 0 0, transparent 0 0 0, transparent 0 0 0;
  box-shadow: 0 2px 2px #708698, 0 4px 0 #abb8c3, 0 20px 30px -8px #000000, transparent 0 0 0, transparent 0 0 0, transparent 0 0 0;
}
.bookend_left {
  display: block;
  position: absolute;
  left: -25px;
  top: -18px;
  width: 36px;
  height: 36px;
  background-color: #ffffff;
  -webkit-transform: rotate(35deg);
  -moz-transform: rotate(35deg);
  -ms-transform: rotate(35deg);
  -o-transform: rotate(35deg);
}
.bookend_left:before {
  position: absolute;
  top: 31px;
  left: 17px;
  width: 20px;
  height: 10px;
  background-color: #ffffff;
  content: "";
  -webkit-transform: rotate(-35deg);
  -moz-transform: rotate(-35deg);
  -ms-transform: rotate(-35deg);
  -o-transform: rotate(-35deg);
}
.bookend_right {
  display: block;
  position: absolute;
  right: -25px;
  top: -18px;
  width: 36px;
  height: 36px;
  background-color: #ffffff;
  -webkit-transform: rotate(-35deg);
  -moz-transform: rotate(-35deg);
  -ms-transform: rotate(-35deg);
  -o-transform: rotate(-35deg);
}
.bookend_right:before {
  position: absolute;
  top: 31px;
  right: 17px;
  width: 20px;
  height: 10px;
  background-color: #ffffff;
  content: "";
  -webkit-transform: rotate(35deg);
  -moz-transform: rotate(35deg);
  -ms-transform: rotate(35deg);
  -o-transform: rotate(35deg);
}
.shelf .reflection {
  display: block;
  position: absolute;
  top: 20px;
  left: 1px;
  width: 99.8%;
  height: 1px;
  background-image: -moz-linear-gradient(0deg, #ffffff 0%, rgba(255, 255, 255, 0.5) 35%, #ffffff 65%, rgba(255, 255, 255, 0.7) 100%);
  /*FF3.6+ */

  background-image: -webkit-gradient(linear, left top, right top, color-stop(0%, #ffffff), color-stop(35%, rgba(255, 255, 255, 0.5)), color-stop(65%, #ffffff), color-stop(100%, rgba(255, 255, 255, 0.7)));
  /*Chrome,Safari4+ */

  background-image: -webkit-linear-gradient(0deg, #ffffff 0%, rgba(255, 255, 255, 0.5) 35%, #ffffff 65%, rgba(255, 255, 255, 0.7) 100%);
  /* Chrome10+,Safari5.1+ */

  background-image: -o-linear-gradient(0deg, #ffffff 0%, rgba(255, 255, 255, 0.5) 35%, #ffffff 65%, rgba(255, 255, 255, 0.7) 100%);
  /* Opera 11.10+ */

  background-image: -ms-linear-gradient(0deg, #ffffff 0%, rgba(255, 255, 255, 0.5) 35%, #ffffff 65%, rgba(255, 255, 255, 0.7) 100%);
  /*IE10+ */

  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='rgba(255, 255, 255, 0.7)', endColorstr='#ffffff', GradientType='0' );
  /* IE6-9 */

}

form {
  position:relative;
  z-index: 20;
}

fieldset {
  border: 0;
  margin: 0;
  padding: 0;
}

input {
  border: none;
  font-family: inherit;
  font-size: inherit;
  line-height: 1.5em;
  margin: 0;
  outline: none;
  padding: 0;
  -webkit-appearance: none;
}

input[type="search"] {
    -webkit-appearance: textfield;
    -moz-box-sizing: content-box;
    -webkit-box-sizing: content-box;
    box-sizing: content-box;
}

input[type="search"]::-webkit-search-cancel-button,
input[type="search"]::-webkit-search-decoration {
    -webkit-appearance: none;
}

.clearfix { *zoom: 1; }
.clearfix:before, .clearfix:after {
  content: "";
  display: table; 
}
.clearfix:after { clear: both; }

.container {
  height: 44px;
  left: 52.5%;
  margin: 0;
  position: absolute;
  top: 125px;
}

/* ---------- SEARCH ---------- */

.search {
  //background: #42454e;
  border-radius: 3px;
  display: inline-block;
  padding: 7px;
}

.search input {
  float: left;
}

.search input[type="search"],
.search input[type="submit"] {
  border-radius: 3px;
  font-size: 12px;
}

.search input[type="search"] {
  background: #fff;
  color: #42454e;
  border: 1px solid #ccc;
  min-width: 184px;
  padding: 6px 8px;
}

.search input[type="submit"] {
  background: #666;
  color: #fff;
  font-weight: bold;
  margin-left: 7px;
  padding: 6px 10px;
}

.search input[type="submit"]:hover {
  background: #0A453C;
}

.search input[type="search"]::-webkit-input-placeholder { color: #42454e; }
.search input[type="search"]:-moz-placeholder { color: #42454e; }
.search input[type="search"]:-ms-input-placeholder { color: #42454e; }

footer {
  text-align: center;
  font-size: 0.6em;
  color: #ccc;
}
footer a {
  color: #ccc;
}
</style>

<!-- stackview.css to style the stack -->
<link rel="stylesheet" href="../lib/jquery.stackview.css" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Abril+Fatface|Open+Sans:300' rel='stylesheet' type='text/css'>

<!-- stackview.js and all js dependencies -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="../lib/jquery.stackview.min.js"></script>
<script type="text/javascript" src="../lib/jqrotate/jquery.rotate.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $(".sample").click(function() {
        $(".search-query").val('?q=PZ7&type=lc').trigger("submit");
    });   
});
</script>
<!--js below added to rotate year on book spine and change color of book searched for -->
<script type="text/javascript">
$(document).ajaxComplete(function()
     {            
         //$('span.spine-year').jqrotate(90);
         var total = $(".num-found").children("span").html();
         $("li.stack-item.stack-book.heat5").each(function()
			{
		    if($(this).css('zIndex') == total/2)
		    {
		        $(this).removeClass("heat5").addClass("highlight-book");
            //var currentTitle = $(this).text();
            //$('.current-title').append(currentTitle);
		    }
		  });
     });
</script>

</head>

<body>

	<h1>Wayne State University Libraries Stack View</h1>
  <h2>A book visualization and browsing tool—a virtual shelf</h2>

  <!--<div class="current-title"></div>-->

	<div class="container">
    <div class="search">
      <form action="index.php" class="navbar-search pull-left">
        <fieldset class="clearfix">
          <input type="search" name="q" value="Search the shelf" onBlur="if(this.value=='')this.value='Search the shelf'" onFocus="if(this.value=='Search the shelf')this.value='' "> 
          <input type="submit" value="Search" class="button">
        </fieldset>

<!--      <input type="text" placeholder="Search the shelf" name="q" class="search-query"/>
      <button type="submit" class="btn btn-small"/>
      Go
      </button>
      <button class="btn btn-small">
      <a href="?q=PZ7&type=lc" class="sample">Sample Search</a>
      </button>-->
        </fieldet>
      </form>	
    </div>
  </div>

		
	<div class="worldcat-stack"></div>
	
	<div class="shelf">
	    <div class="bookend_left"></div>
		<div class="bookend_right"></div>
		<div class="reflection"></div>
	</div>

  <footer>
    Modified and developed from the Harvard Library Innovation Lab <a href="https://github.com/harvard-lil/stackview" target="_blank">Stackview</a> project
  </footer>

	<script type="text/javascript">
$(document).ready(function() {

$(function () { 
		$('.worldcat-stack').stackView({
			url: "../php/WSUCatalog.php",
			jsonp: true,
			search_type: '<?php if (isset($_GET['type'])) { $type = $_GET['type']; echo $type;} else { $type = 'lc'; echo $type;}?>',
			query: '<?php echo $_GET['q'];?>'});
    });
    });

    </script>

<!-- js just for this page -->
<script type="text/javascript" src="http://balupton.github.com/jquery-syntaxhighlighter/scripts/jquery.syntaxhighlighter.min.js"></script>
<script type="text/javascript">$.SyntaxHighlighter.init();</script>
</body>
</html>
