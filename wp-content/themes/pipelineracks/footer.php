<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
  <footer>
      <div class="container">
        <div class="row">
          <div class="footerLinks">
            <div class="col-lg-12 col-md-12 col-sm-12"> 
			 <?php wp_nav_menu( array( 'theme_location' => 'footer_menu', 'menu_class' => 'footNav', 'container'=>'ul' ) ); ?>
			</div>
          </div>
        </div>
		<div class="row">
		 <div class="col-lg-12 col-md-12 col-sm-12">
          <p class="copyright">&copy; 2014 Pipelineracks.com. All Rights Resevered.
		  </div>
		</div>
      </div>
    </footer>
</div>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/owl.carousel.css">

<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/owl.carousel.min.js"></script>

		<script>

jQuery(".detail-carousel").owlCarousel({
    autoplay: false,
			            items: 1,
			            loop: true,
			            margin: 10,
			            smartSpeed: 450,
			            dotData: true,
  });


			

		</script>
<?php wp_footer(); ?>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-9518327-1']);
    _gaq.push(['_setDomainName', 'none']);
    _gaq.push(['_setAllowLinker', true]);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
</script>

		

    
<script>
                                
</body>
</html>