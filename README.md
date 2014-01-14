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

Configuration
----------------------------------------------------------------

By default the home of the site is included in the sitemaps. To disable it
Configure::write('Sitemapcake2.options', array('includeHome' => false));

To add alternate locations for the url listed (for instance for multilanguage), do:
----------------------------------------------------------------

Configure::write('Sitemapcake2.AlternateLoc', array("altLocs" => array(
																		array("params" => array("language"=>"cat"),
																			  "lang" => "ca"),
																		array("params" => array("language"=>"fr"),
																			  "lang" => "fr"),
																	    array("params" => array("language"=>"eng"),
																	  		  "lang" => "en")
																	  )));
																	  
To add Controllers urls to the sitemap
----------------------------------------------------------------																	  
																	  
Configure::write('Sitemapcake2.Controller', array(array('name' => 'Pages', 
														'excludeActions' => array('home'),
														'includeActions' => array('cookies')),
												  array('name' => 'Products', 
												  		'excludeActions' => array('family', 'catalog', 'catalogFamily', 'view')),
												  array('name' => 'Employment'),
												  array('name' => 'Forms',
												  		'excludeActions' => array('formok', 'cancelrequest')),
												  array('name' => 'Educapersonalizados',
												        'excludeActions' => array('b2c', 'news'))));
To add records from a Model to the sitemap.
The idField is optional. By default is looking the field id when retrieving the records
The conditions options is optional. Same format as conditions Cakephp
----------------------------------------------------------------
Configure::write('Sitemapcake2.Model', array(array('name' => 'Product', 
												   'controller' => 'Products', 
												   'idField' => "id_producto",
												   'conditions' => array('Product.activo_producto' => 1))));

