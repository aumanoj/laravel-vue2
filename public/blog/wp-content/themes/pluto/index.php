<?php

/**

 * The main template file.

 *

 * This is the most generic template file in a WordPress theme

 * and one of the two required files for a theme (the other being style.css).

 * It is used to display a page when nothing more specific matches a query.

 * E.g., it puts together the home page when no home.php file exists.

 * Learn more: http://codex.wordpress.org/Template_Hierarchy

 *

 * @package Pluto

 */



get_header(); ?>

	<ins class="adsbygoogle"

                     style="display:inline-block;width:100%;height:90px"

                     data-ad-client="ca-pub-6901539703728543"

                     data-ad-slot="1336910245"></ins>

    <style type="text/css">
    	/*#primary {width: 80%;
float: none;
padding: 15px;
    padding-top: 15px;
padding-top: 0;
background: #f7f7f7;
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

    <!--div class="author_1">
				
				<div class="aut left-det">
					<a href="#"><img alt="Shanthi S" class="img_sh" src="https://cdn.inc42.com/wp-content/uploads/2019/09/Shanthi1-60x60.jpg"  width="60" height="60"></a>
					<div class="author-det">
						<h3>Shashank</h3>
						<h4>Inc42 Staff</h4>
						<p class="time"><span>14 Feb 20</span> &nbsp; <span>13 min read</span></p>

					</div>

				</div>

				<div class="aut social-auth">
				<h6>Share Story</h6>
				<div class="sp-share">
					<span>120</span>
					<span>Share</span>
				</div>
				<ul>
					<li><a href="https://www.facebook.com/pages/Unlockninja/1383330261986097" class="Facebook"><img src="https://www.unlockninja.com/blog/wp-content/plugins/zilla-social/images/16px/Facebook.png" alt="Facebook"></a></li>
					<li><a href="https://plus.google.com/+UnlockNinjaUnlocking" class="Google+"><img src="https://www.unlockninja.com/blog/wp-content/plugins/zilla-social/images/16px/Google+.png" alt="Google+"></a></li>
					<li><a href="https://twitter.com/NinjaUnlock" class="Twitter"><img src="https://www.unlockninja.com/blog/wp-content/plugins/zilla-social/images/16px/Twitter.png" alt="Twitter"></a></li>
					


				</ul>
					

				</div>


			</div-->             

	<div id="primary" class="content-area">



		<main id="main" class="site-main" role="main">

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<!-- UnlockNinja.com -->

		    <div class="ad-google text-center" style="">

                

            <script>

              (adsbygoogle = window.adsbygoogle || []).push({});

            </script>


            



		<?php if ( have_posts() ) : ?>



			<?php /* Start the Loop */ ?>

			<?php while ( have_posts() ) : the_post(); ?>



				<?php

					/* Include the Post-Format-specific template for the content.

					 * If you want to override this in a child theme, then include a file

					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.

					 */

					get_template_part( 'content', get_post_format() );

				?>



			<?php endwhile; ?>



			<?php do_action('pluto-content-below'); ?>



		<?php else : ?>



			<?php get_template_part( 'no-results', 'index' ); ?>p



		<?php endif; ?>



		</main><!-- #main -->

	</div><!-- #primary -->



<!--?php get_sidebar(); ?-->

<?php get_footer(); ?>