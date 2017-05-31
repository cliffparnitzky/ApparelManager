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
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['apparelManagerMyOrders'] = '{title_legend},name,headline,type;{apparelManagerFilterSort_legend},apparelManagerSortDateField,apparelManagerSortDirection;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['apparelManagerSortDateField'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_module']['apparelManagerSortDateField'],
  'exclude'                 => true,
  'inputType'               => 'select',
  'options'                 => array('orderDate', 'deliverDate', 'invoiceDate'),
  'reference'               => &$GLOBALS['TL_LANG']['tl_module']['apparelManagerSortDateFields'],
  'eval'                    => array('tl_class'=>'clr w50'),
  'sql'                     => "varchar(64) NOT NULL default 'orderDate'"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['apparelManagerSortDirection'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_module']['apparelManagerSortDirection'],
  'exclude'                 => true,
  'inputType'               => 'select',
  'options'                 => array('ASC', 'DESC'),
  'reference'               => &$GLOBALS['TL_LANG']['tl_module']['apparelManagerSortDirections'],
  'eval'                    => array('tl_class'=>'w50'),
  'sql'                     => "varchar(64) NOT NULL default 'ASC'"
);

?>