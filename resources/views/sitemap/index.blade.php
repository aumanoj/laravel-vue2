<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">


    <url>
  		<loc><?php echo  url('/'); ?></loc>
  		<lastmod>2020-06-06T09:08:12+00:00</lastmod>
  		<priority>1.00</priority>
	</url>
	
	<?php  
		foreach($brands as $brand)
		{ 
			$brnd = strtolower($brand->name);
			?>
  			<url>
  				<loc><?php echo  url('/unlock/'.$brnd); ?></loc> 
			</url>
	<?php  } ?>

	<?php 
		foreach($modals as $modal)
		{	
			if ($modal->brand->status == 1)
			{
				$modl = strtolower($modal->name);
				$brnd = strtolower($modal->brand->name);

			?>
			<url>
				<loc><?php echo url('/unlock/'.$brnd.'/'.$modl); ?></loc>
			</url>
	<?php }}  ?>
</urlset>
