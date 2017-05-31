<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2016 Leo Feyer
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
 * Add to palette
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{apparelManager_legend},apparelManagerCategories,apparelManagerDeliverySheetTemplate,apparelManagerInvoiceNotification,apparelManagerOrderNumberPattern;';

/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['apparelManagerCategories'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['apparelManagerCategories'],
  'inputType'               => 'keyValueWizard',
  'foreignKey'              => 'tl_nc_notification.title',
  'eval'                    => array('mandatory'=>true)
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['apparelManagerDeliverySheetTemplate'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['apparelManagerDeliverySheetTemplate'],
  'inputType'               => 'select',
  'options_callback'        => array('tl_settings_ApparelManager', 'getDeliverySheetTemplates'),
  'eval'                    => array('chosen'=>true, 'mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'clr w50')
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['apparelManagerInvoiceNotification'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['apparelManagerInvoiceNotification'],
  'inputType'               => 'select',
  'foreignKey'              => 'tl_nc_notification.title',
  'eval'                    => array('chosen'=>true, 'mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'clr w50')
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['apparelManagerOrderNumberPattern'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['apparelManagerOrderNumberPattern'],
  'inputType'               => 'text',
  'eval'                    => array('mandatory'=>true, 'tl_class'=>'clr w50', 'multiple'=>true, 'size'=>3, 'decodeEntities'=>true)
);

/**
 * Class tl_settings_ApparelManager
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2017
 * @author     Leo Feyer <http://www.contao.org>
 * @package    Controller
 */
class tl_settings_ApparelManager extends Backend
{
  /**
   * Return all delivery sheet templates as array
   * @return array
   */
  public function getDeliverySheetTemplates()
  {
    return $this->getTemplateGroup('apparel_mgr_');
  }
}

?>