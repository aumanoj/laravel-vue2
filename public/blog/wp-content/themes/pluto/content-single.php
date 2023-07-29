<?php



/**



 * @package Pluto



 */



?>







<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



	<header class="entry-header">



		<h1 class="entry-title"><?php the_title(); ?></h1>







		<div class="entry-meta">



			<?php pluto_posted_on(); ?>



		</div><!-- .entry-meta -->



	</header><!-- .entry-header -->



	<?php if (has_post_thumbnail() ) : ?>



    <div id="post_thumbnail">



    	<?php the_post_thumbnail(); ?>



	</div>



    <?php endif; ?>



	<div class="entry-content">

	<?php echo do_shortcode('[addtoany]');?>

<ins class="adsbygoogle"

                     style="display:inline-block;width:100%;height:90px"

                     data-ad-client="ca-pub-6901539703728543"

                     data-ad-slot="1336910245"></ins>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<!-- UnlockNinja.com -->

		    <div class="ad-google text-center" style="padding-top: 15px;">

                

            <script>

              (adsbygoogle = window.adsbygoogle || []).push({});

            </script>

		<?php the_content(); ?>



		<?php



			/*wp_link_pages( array(



				'before' => '<div class="page-links">' . __( 'Pages:', 'pluto' ),



				'after'  => '</div>',



			) );*/



		?>



	</div><!-- .entry-content -->



<?php /* ?>

<footer class="entry-meta">



		<?php



			//translators: used between list items, there is a space after the comma



			$category_list = get_the_category_list( __( ', ', 'pluto' ) );







			//translators: used between list items, there is a space after the comma 



			$tag_list = get_the_tag_list( '', __( ', ', 'pluto' ) );







			if ( ! pluto_categorized_blog() ) {



				// This blog only has 1 category so we just need to worry about tags in the meta text



				if ( '' != $tag_list ) {



					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'pluto' );



				} else {



					$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'pluto' );



				}







			} else {



				// But this blog has loads of categories so we should probably display them here



				if ( '' != $tag_list ) {



					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'pluto' );



				} else {



					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'pluto' );



				}







			} // end check for categories on this blog







			printf(



				$meta_text,



				$category_list,



				$tag_list,



				get_permalink(),



				the_title_attribute( 'echo=0' )



			);



		?>







		<?php edit_post_link( __( 'Edit', 'pluto' ), '<span class="edit-link">', '</span>' ); ?>



	</footer>

<?php */ ?>

	<!-- .entry-meta -->



</article><!-- #post-## -->



