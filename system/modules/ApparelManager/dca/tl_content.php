<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2017 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2017-2017
 * @author     Cliff Parnitzky
 * @package    ApparelManager
 * @license    LGPL
 */

/**
 * Add palettes to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['apparelManagerArticle']   = '{type_legend},headline,type;{apparelManager_legend},apparelManagerArticle,apparelManagerShowStock,apparelManagerShowOnlyAvailableVariants;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

/**
 * Add fields to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['apparelManagerArticle'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_content']['apparelManagerArticle'],
  'exclude'                 => true,
  'inputType'               => 'select',
  'options_callback'        => array('ApparelManagerHelper', 'getPublishedApparelArticlesAsOptions'),
  'foreignKey'              => 'tl_apparel_article.CONCAT(manufacturer, " - ", name, " | ", number)',
  'eval'                    => array('chosen'=>true, 'mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
  'sql'                     => "int(10) unsigned NULL",
  'relation'                => array('type'=>'hasOne', 'load'=>'eager')
);
$GLOBALS['TL_DCA']['tl_content']['fields']['apparelManagerShowStock'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_content']['apparelManagerShowStock'],
  'exclude'                 => true,
  'inputType'               => 'checkbox',
  'eval'                    => array('tl_class'=>'w50 clr'),
  'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['apparelManagerShowOnlyAvailableVariants'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_content']['apparelManagerShowOnlyAvailableVariants'],
  'exclude'                 => true,
  'inputType'               => 'checkbox',
  'eval'                    => array('tl_class'=>'w50'),
  'sql'                     => "char(1) NOT NULL default ''"
);

?>