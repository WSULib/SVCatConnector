<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Catalog</title>

<link rel="icon" href="favicon.ico" type="image/x-icon" />

<!-- stackview.css to style the stack -->
<link rel="stylesheet" href="lib/jquery.stackview.css" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Abril+Fatface|Open+Sans:300' rel='stylesheet' type='text/css'>

<!-- stackview.js and all js dependencies -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="lib/jquery.stackview.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>

<script type="text/javascript">
$(document).ajaxComplete(function()
     {
         var total = $(".num-found").children("span").html();
          $("li.stack-item.stack-book.heat5").each(function()
         {
          if($(this).css('zIndex') == Math.floor(total/2))
          {
            $(this).removeClass("heat5").addClass("highlight-book");
            var currentTitle = $(this).find('.spine-title').text();
            $('.current-item .title').empty().append(currentTitle);
            var num = parseInt($(this).css('zIndex'));
            var recordLink = "<a href="+obj.recordLinks[num]+" target='_blank'>View Catalog Record</a>";
            $('.current-item .record').empty().append(recordLink);
          }
      });

    $("li.stack-item").click(function() {
            var currentTitle = $(this).find('.spine-title').text();
            $('li.stack-item').not($(this)).removeClass('highlight-book').addClass('heat5');
            $(this).removeClass('heat5').addClass('highlight-book');
            $('.current-item .title').empty(currentTitle).append(currentTitle);
            var num = parseInt($(this).css('zIndex'));
            $('.current-item .record').empty().append("<a href="+obj.recordLinks[num]+" target='_blank'>View Catalog Record</a>");
    });


    $('li.stack-item a').first().prepend("<span class='prev'>&#8595; click for previous stack &#8595;</span>");
    $('li.stack-item a').last().prepend("<span class='next'>&#8593; click for next stack &#8593;</span>");
    $('.stack-item:last .prev').remove();

    $('li.stack-item').last().click(function(){
          
          var num = parseInt($(this).css('zIndex'));
          var query = obj.callNums[num];
          var currentTitle = $(this).find('.spine-title').text();
          $('.current-item .title').empty(currentTitle);
          var recordLink = "<a href="+obj.recordLinks[num]+" target='_blank'>View Catalog Record</a>";
          $('.current-item .record').empty().append(recordLink);
          nextRecords(query, this);
          $('.highlight-book').removeClass().addClass('stack-item stack-book heat5');
        });

    $('li.stack-item').first().click(function(){
          var num = parseInt($(this).css('zIndex'));
          var query = obj.callNums[num];
          var currentTitle = $(this).find('.spine-title').text();
          $('.current-item .title').empty(currentTitle);
          var recordLink = "<a href="+obj.recordLinks[num]+" target='_blank'>View Catalog Record</a>";
          $('.current-item .record').empty().append(recordLink);
          nextRecords(query);
          $('.highlight-book').removeClass().addClass('stack-item stack-book heat5');
        });


            // Tooltip
      $('li.stack-item').hover(function(){
              // Hover over code
              var num = parseInt($(this).css('zIndex'));
              status(obj, num)
              var availability = $(".status").text();
              var location = $(".location").text();
              var title = $(this).attr('title');

              $(this).data('tipText', title).removeAttr('title');
              $('<p class="tooltip"></p>').html(title+"<br><span class='tooldeets'><span class='callnum'>"+obj.callNums[num]+"</span><br><span class='availability'>"+availability+"</span> @ <span class='locationtool'>"+location+"</span></span>").appendTo('body').fadeIn();
      }, function() {
              // Hover out code
              $(this).attr('title', $(this).data('tipText'));
              $('.tooltip').remove();
      }).mousemove(function(e) {
              var mousex = e.pageX + 0; //Get X coordinates
              var mousey = e.pageY + 0; //Get Y coordinates
              $('.tooltip')
              .css({ top: mousey, left: mousex })
      });

});
</script>

</head>

<body>
  <h1>Catalog</h1>
  <h2>A book visualization and browsing tool</h2>

  <div class="current-item">
    <span class="title"></span><br>
    <span class="record"></span>
    <span class="location" style="display:none;"></span>
    <span class="status" style="display:none;"></span>
  </div>
  
  <div class="stack">
   <div class="nores"></div> 
  </div>

    <div class="search">
      <form action="index.php" class="navbar-search pull-left">
        <fieldset class="clearfix">
          <input type="search" name="q" value="Search by Call Number e.g. Z 685" onBlur="if(this.value=='')this.value='Search by Call Number e.g. Z 685'" onFocus="if(this.value=='Search by Call Number e.g. Z 685')this.value='' "> 
          <input type="submit" value="Search" class="button">
        </fieldset>
      </form> 
    </div>
  
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
  var search_type = "<?php if (isset($_GET['type'])) { $type = $_GET['type']; echo $type;} else { $type = 'lc'; echo $type;}?>";
  var query = "<?php if (isset($_GET['q'])) { $q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING); echo $q;} else { $q = 'M49'; echo $q;}?>";
  // Populate stackview
  populateStackview(query);

});
</script>
</body>
</html>
