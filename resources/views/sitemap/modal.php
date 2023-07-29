<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
	http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
	<!-- created with Free Online Sitemap Generator www.xml-sitemaps.com -->

	<?php  
	foreach($topModel1 as $modal)
	{ 
		$modl = str_replace(' ','-',strtolower($modal->model_num));
		$brnd = strtolower($modal->manu_name);
		
		?>
		<url>
			<loc><?php echo  url('/unlock-'.urlencode($brnd).'+'.urlencode($modl));?></loc>
		</url>
	<?php  }  ?>
	<?php  
	foreach($topModel2 as $modal)
	{ 
		$modl = str_replace(' ','-',strtolower($modal->model_num));
		$brnd = strtolower($modal->manu_name);
		
		?>
		<url>
			<loc><?php echo  url('/unlock-'.urlencode($brnd).'+'.urlencode($modl));?></loc>
		</url>
	<?php  }  ?>
	<?php  
	foreach($topModel3 as $modal)
	{ 
		$modl = str_replace(' ','-',strtolower($modal->model_num));
		$brnd = strtolower($modal->manu_name);
		
		?>
		<url>
			<loc><?php echo  url('/unlock-'.urlencode($brnd).'+'.urlencode($modl));?></loc>
		</url>
	<?php  }  ?>
	
	
</urlset>