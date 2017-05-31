<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @package ApparelManager
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'CliffParnitzky',
	'CliffParnitzky\Contao\ApparelManager',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'CliffParnitzky\Contao\ApparelManager\ApparelManagerHelper'         => 'system/modules/ApparelManager/classes/ApparelManagerHelper.php',

	// Elements
	'CliffParnitzky\Contao\ApparelManager\ContentApparelManagerArticle' => 'system/modules/ApparelManager/elements/ContentApparelManagerArticle.php',

	// Models
	'CliffParnitzky\Contao\ApparelManager\ApparelArticleModel'          => 'system/modules/ApparelManager/models/ApparelArticleModel.php',
	'CliffParnitzky\Contao\ApparelManager\ApparelArticleVariantModel'   => 'system/modules/ApparelManager/models/ApparelArticleVariantModel.php',
	'CliffParnitzky\Contao\ApparelManager\ApparelOrderItemModel'        => 'system/modules/ApparelManager/models/ApparelOrderItemModel.php',
	'CliffParnitzky\Contao\ApparelManager\ApparelOrderModel'            => 'system/modules/ApparelManager/models/ApparelOrderModel.php',

	// Modules
	'CliffParnitzky\Contao\ApparelManager\ModuleApparelManagerMyOrders' => 'system/modules/ApparelManager/modules/ModuleApparelManagerMyOrders.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'apparel_mgr_delivery_sheet' => 'system/modules/ApparelManager/templates/apparel_manager',
	'ce_apparelManagerArticle'   => 'system/modules/ApparelManager/templates/elements',
	'mod_apparelManagerMyOrders' => 'system/modules/ApparelManager/templates/modules',
));
