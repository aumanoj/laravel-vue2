<?php



/**



 * The Template for displaying all single posts.



 *



 * @package Pluto



 */







get_header(); ?>


<ins class="adsbygoogle"

                     style="display:inline-block;width:100%;height:90px"

                     data-ad-client="ca-pub-6901539703728543"

                     data-ad-slot="1336910245"></ins>
<style type="text/css">
/*    	#primary {width: 80%;
float: none;
padding: 15px;
    padding-top: 15px;
padding-top: 0;
background: #f7f7f7;
border: 1px solid #f2f2f2;
margin: 20px auto;
border-radius: 10px;}*/

article h1 {line-height: normal;}

.author_1 {
  width: 100%;
  height: auto;
  display: flex;
}

.author_1 div.aut {
  -ms-flex: 1;  /* IE 10 */  
  flex: 1;
  padding:10px
}

.author_1 .left-det {position: relative;}
.author_1 .left-det h3 {color: #000}
.author_1 .left-det h4 {color: #ff9a00}
.author_1 .aut .author-det {padding-left: 70px;}
.author_1 .aut .author-det p.time {color: #868686}
.author_1 .aut .img_sh {position: absolute; border-radius: 50%; top: 20px}
.social-auth {color: #868686}
.social-auth h6 {text-transform: uppercase;}
.sp-share {float: left;}
.social-auth ul {}
.social-auth ul li {display: inline-block; margin:0 3px;}
.social-auth ul li a {display: inline-block;}
.social-auth ul li img {width: 50px;}
.social-auth .sp-share span {display: block;}

    </style>                 



	<div id="primary" class="content-area ss2">
		


		<main id="main" class="site-main" role="main">
			


<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<!-- demoninja.com -->


			
			
			
		    <div class="ad-google text-center" style="padding-top: 15px;">

                

            <script>

              (adsbygoogle = window.adsbygoogle || []).push({});

            </script>



		<?php while ( have_posts() ) : the_post(); ?>







			<?php get_template_part( 'content', 'single' ); ?>







			<?php pluto_content_nav( 'nav-below' ); ?>







			<?php



				// If comments are open or we have at least one comment, load up the comment template



				/*if ( comments_open() || '0' != get_comments_number() )



					comments_template();*/



			?>







		<?php endwhile; // end of the loop. ?>







		</main><!-- #main -->



	</div><!-- #primary -->







<!--?php get_sidebar(); ?-->



<?php get_footer(); ?>