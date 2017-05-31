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
 * @copyright  Cliff Parnitzky 2016-2017
 * @author     Cliff Parnitzky
 * @package    ApparelManager
 * @license    LGPL
 */

/**
 * Backend modules
 */
array_insert($GLOBALS['BE_MOD'], array_search("system", array_keys($GLOBALS['BE_MOD'])), array
(
  'apparel_manager' => array
  (
    'apparel_article' => array
    (
      'tables'        => array('tl_apparel_article', 'tl_apparel_article_variant'),
      'icon'          => 'system/modules/ApparelManager/assets/icon_apparel_article.png',
      'stylesheet'    => 'system/modules/ApparelManager/assets/apparel_manager_be.css',
      'stockOverview' => array('CliffParnitzky\Contao\ApparelManager\ApparelManagerHelper', 'showStockOverview')
    ),
    'apparel_order' => array
    (
      'tables'              => array('tl_apparel_order', 'tl_apparel_order_item'),
      'icon'                => 'system/modules/ApparelManager/assets/icon_apparel_order.png',
      'stylesheet'          => 'system/modules/ApparelManager/assets/apparel_manager_be.css',
      'createDeliverySheet' => array('CliffParnitzky\Contao\ApparelManager\ApparelManagerHelper', 'createDeliverySheet'),
      'invoiceOrder'        => array('CliffParnitzky\Contao\ApparelManager\ApparelManagerHelper', 'sendInvoiceNotification')
    )
  )
));

/**
 * Front end module
 */
$GLOBALS['FE_MOD']['apparelManager']['apparelManagerMyOrders'] = 'ModuleApparelManagerMyOrders';

/**
 * Content elements
 */
$GLOBALS['TL_CTE']['apparelManager']['apparelManagerArticle'] = 'ContentApparelManagerArticle';

/**
 * Notification Center Notification Types
 */
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['ApparelManager']['InvoiceNotification'] = array(
  'recipients'          => array('admin_email','customer_email'),
  'email_recipient_cc'  => array('admin_email','customer_email'),
  'email_recipient_bcc' => array('admin_email','customer_email'),
  'email_replyTo'       => array('admin_email'),
  'email_subject'       => array('customer_*', 'order_*'),
  'email_text'          => array('customer_*', 'order_*', 'order_positions_text', 'order_total'),
  'email_html'          => array('customer_*', 'order_*', 'order_positions_html', 'order_total')
);

?>