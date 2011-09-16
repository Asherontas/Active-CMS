<div id="main">
  <div id="main-inner">
    <div id="home-display" class="rounded-10"> 
      <script type="text/javascript">

$(function() {
	$('#slideshow').cycle({
		fx:     'fade',
		timeout: 3000,
		pager:  '#slideshow-nav',
		pagerAnchorBuilder: function(idx, slide) {
			// return sel string for existing anchor
			return '#slideshow-nav li:eq(' + (idx) + ') a';
		},
		speed:  'slow'
	});

	$('#direct').click(function() {
		$('#nav li:eq(2) a').triggerHandler('click');
		return false;
	});

});

</script>
      <div id="slideshow-wrapper">
        <ul id="slideshow-nav" class="rounded-5">
          <li><a href="#" class="ie6"><!-- --></a></li>
          <li><a href="#" class="ie6"><!-- --></a></li>
          <li><a href="#" class="ie6"><!-- --></a></li>
          <li><a href="#" class="ie6"><!-- --></a></li>
        </ul>
        <div id="slideshow"> <a href="#" title="Home Image"> <img src="<?php echo TEMPLATE; ?>/images/slide_1.jpg" alt="Home Image" /> </a> <a href="#" title="Home Image"> <img src="<?php echo TEMPLATE; ?>/images/slide_2.jpg" alt="Home Image" /> </a> <a href="#" title="Home Image"> <img src="<?php echo TEMPLATE; ?>/images/slide_3.jpg" alt="Home Image" /> </a> <a href="#" title="Home Image"> <img src="<?php echo TEMPLATE; ?>/images/slide_4.jpg" alt="Home Image" /> </a> </div>
      </div>
    </div>
    <div id="home-slogan" class="rounded-10"> When you come a knockin’ we’ll start the rockin’. With Barely Corporate, you’ll be up and running with your company’s site in no time. Enjoy the awesomeness. </div>
    <div id="home-box-container">
      <div class="home-box equalize rounded-10">
        <div class="pad">
          <h2>Mucho Awesomeness.</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
          <img src="<?php echo TEMPLATE; ?>/images/home-image1.jpg" alt="" /> </div>
      </div>
      <div class="home-box equalize rounded-10">
        <div class="pad">
          <h2>Bringin' it Hardcore.</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
          <img src="<?php echo TEMPLATE; ?>/images/home-image2.jpg" alt="" /> </div>
      </div>
      <div class="home-box equalize rounded-10">
        <div class="pad">
          <h2>Latest News</h2>
          <div class="news-scroller-wrapper">
            <div class="news-scroller">
              <div>
                <p><a href="#"><strong>Barely Corporate is here!</strong></a><br />
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
                <p class="date">Posted on 1/24/2010</p>
              </div>
              <div>
                <p><a href="#"><strong>The Next News Article</strong></a><br />
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
                <p class="date">Posted on 1/24/2010</p>
              </div>
              <div>
                <p><a href="#"><strong>Featured Awesomeness</strong></a><br />
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
                <p class="date">Posted on 1/24/2010</p>
              </div>
            </div>
            <ul class="news-scroller-nav">
              <li><a href="javascript:void(0)" class="news-previous rounded-5">&laquo;</a></li>
              <li><a href="javascript:void(0)" class="news-next rounded-5">&raquo;</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>