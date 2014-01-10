cakephp-sitemap
===============
Generates a Sitemap xml file for a Cakephp 2.4.x App

Installation
----------------------------------------------------------------

Edit you app bootstrap.php file and add:

CakePlugin::loadAll(
	array(
    		'Sitemapcake2' => array('routes' => true)
	)
);

