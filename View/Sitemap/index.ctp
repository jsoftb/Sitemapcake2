<?xml-stylesheet type="text/xsl" href="<?php echo $xsdurl; ?>"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

<?php 
	if(!empty($urls)) {
		foreach ($urls as $url) {
			echo $this->element('Sitemapcake2.urlblock', array('url'=>$url, "changefreq"=>'daily', "priority" => "0.5"));
		}
	}
?>

</urlset>