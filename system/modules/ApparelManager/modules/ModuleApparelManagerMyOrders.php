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
 * Run in a custom namespace, so the class can be replaced
 */
namespace CliffParnitzky\Contao\ApparelManager;

/**
 * Class ModuleApparelManagerMyOrders
 *
 * Front end module "apparelManagerMyOrders".
 * @copyright  Cliff Parnitzky 2017-2017
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class ModuleApparelManagerMyOrders extends \Module
{
  /**
   * Template
   * @var string
   */
  protected $strTemplate = 'mod_apparelManagerMyOrders';

  /**
   * Generate module
   * @return string
   */
  public function generate()
  {
    if (TL_MODE == 'BE')
    {
      $objTemplate = new \BackendTemplate('be_wildcard');

      $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['apparelManagerMyOrders'][0]) . ' ###';
      $objTemplate->title = $this->headline;
      $objTemplate->id = $this->id;
      $objTemplate->link = $this->name;
      $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

      return $objTemplate->parse();
    }

    return parent::generate();
  }

  /**
   * Compile module
   */
  protected function compile()
  {
    if (!FE_USER_LOGGED_IN)
    {
      $this->Template->hasError = true;
      $this->Template->errorMessage = $GLOBALS['TL_LANG']['ERR']['ApparelManager']['notAuthenticatedMyOrders'];
    }
    else
    {
      global $objPage;
      
      $this->import('FrontendUser', 'User');
      
      $arrOrders = array();
      $objApparelOrder = \ApparelOrderModel::findBy('member', $this->User->id, array('order' => $this->apparelManagerSortDateField . " " . $this->apparelManagerSortDirection));
      
      if ($objApparelOrder != null)
      {
        $count = 0;
        while ($objApparelOrder->next())
        {
          $objApparelOrderItems = \ApparelOrderItemModel::findByPid($objApparelOrder->id, array('order' => "sorting"));
          
          if (!empty($objApparelOrderItems))
          {
            $arrOrders[] = array
            (
              'id'     => $objApparelOrder->id,
              'class'  => 'order ' . ((($count % 2) == 0) ? 'even' : 'odd') . (($count == 0) ? ' first' : '') . (($count + 1 == count($objApparelOrder)) ? ' last' : ''),
              'number' => $objApparelOrder->number,
              'status' => array
              (
                'raw'   => $objApparelOrder->status,
                'value' => $GLOBALS['TL_LANG']['ApparelManager']['status'][$objApparelOrder->status]
              ),
              'orderDate' => array
              (
                'raw'   => $objApparelOrder->orderDate,
                'value' => \Date::parse($objPage->dateFormat, $objApparelOrder->orderDate),
              ),
              'deliverDate' => array
              (
                'raw'   => $objApparelOrder->deliverDate,
                'value' => \Date::parse($objPage->dateFormat, $objApparelOrder->deliverDate),
              ),
              'invoiceDate' => array
              (
                'raw'   => $objApparelOrder->invoiceDate,
                'value' => \Date::parse($objPage->dateFormat, $objApparelOrder->invoiceDate),
              ),
              'comment' => $objApparelOrder->comment,
              'createdAt' => array
              (
                'raw'   => $objApparelOrder->createdAt,
                'value' => \Date::parse($objPage->dateFormat, $objApparelOrder->createdAt),
              ),
              'createdBy' => array
              (
                'raw'   => $objApparelOrder->createdBy,
                'value' => \UserModel::findByPk($objApparelOrder->createdBy)->name,
              ),
              'orderTotal' => array
              (
                'raw'   => \ApparelManagerHelper::getOrderTotal($objApparelOrderItems, true),
                'value' => \ApparelManagerHelper::getOrderTotal($objApparelOrderItems),
              ),
              'orderPositions' => array
              (
                'html' => \ApparelManagerHelper::getOrderPositionsHtml($objApparelOrderItems)
              )
            );
          }
          $count++;
        }
      }
      
      $this->Template->orders = $arrOrders;
    }
  }
}

?>