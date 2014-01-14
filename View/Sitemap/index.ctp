<?xml-stylesheet type="text/xsl" href="<?php echo $xsdurl; ?>"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" 
 		xmlns:xhtml="http://www.w3.org/1999/xhtml">
<?php 

	if(!empty($urls)) {
		foreach ($urls as $url) {
			echo $this->element('Sitemapcake2.urlblock', array('url'        => $url['url'], 
															   'altLoc'     => $url['altLoc'], 
															   'changefreq' => 'daily', 
															   'priority'   => '1.0'));
		}
	}
?>
</urlset>