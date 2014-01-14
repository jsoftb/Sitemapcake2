<url>
      <loc><?php echo $url?></loc>
      
<?php 
      	if(!empty($altLoc)) {
      		foreach ($altLoc as $urlLoc) {
?>      			
      			<xhtml:link rel="alternate" href="<?php echo $urlLoc; ?>" />
<?php    			
      		}
		}
      ?>
      
      <lastmod><?php echo date("Y-m-d");?></lastmod>
      <changefreq><?php echo $changefreq?></changefreq>
      <priority><?php echo $priority?></priority>
</url>