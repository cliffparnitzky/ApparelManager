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
 * Table tl_apparel_order
 */
$GLOBALS['TL_DCA']['tl_apparel_order'] = array
(

  // Config
  'config' => array
  (
    'dataContainer'           => 'Table',
    'ctable'                  => array('tl_apparel_order_item'),
    'switchToEdit'            => true,
    'enableVersioning'        => true,
    'notSortable'             => true,
    'notCopyable'             => true,
    'onsubmit_callback' => array
    (
      array('tl_apparel_order', 'saveTitle')
    ),
    'sql' => array
    (
      'keys' => array
      (
        'id' => 'primary'
      )
    )
  ),

  // List
  'list' => array
  (
    'sorting' => array (
      'mode'                    => 2,
      'fields'                  => array('status'),
      'flag'                    => 11,
      'panelLayout'             => 'filter;sort,search,limit'
    ),
    'label' => array
    (
      'fields'                => array('manufacturer', 'name'),
      'format'                => '%s - %s',
      'label_callback'        => array('tl_apparel_order', 'prepareLabel')
    ),
    'global_operations' => array
    (
      'all' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
        'href'                => 'act=select',
        'class'               => 'header_edit_all',
        'attributes'          => 'onclick="Backend.getScrollOffset();"'
      )
    ),
    'operations' => array
    (
      'edit' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_order']['edit'],
        'href'                => 'table=tl_apparel_order_item',
        'icon'                => 'edit.gif'
      ),
      'editheader' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_order']['editheader'],
        'href'                => 'act=edit',
        'icon'                => 'header.gif'
      ),
      'createDeliverySheet' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_order']['createDeliverySheet'],
        'href'                => 'key=createDeliverySheet',
        'icon'                => 'system/modules/ApparelManager/assets/icon_order_delivery_sheet.png'
      ),
      'invoiceOrder' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_order']['invoiceOrder'],
        'href'                => 'key=invoiceOrder',
        'icon'                => 'system/modules/ApparelManager/assets/icon_order_invoice.png',
        'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['apparel_order_invoiceConfirm'] . '\')) return false; Backend.getScrollOffset();"',
        'button_callback'     => array('tl_apparel_order', 'invoiceOrder')
      ),
      'delete' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_order']['delete'],
        'href'                => 'act=delete',
        'icon'                => 'delete.gif',
        'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
      ),
      'show' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_order']['show'],
        'href'                => 'act=show',
        'icon'                => 'show.gif'
      )
    )
  ),

  // Palettes
  'palettes' => array
  (
    '__selector__' => array(),
    'default'      => '{order_legend},number,member;{status_legend},status,orderDate,deliverDate,invoiceDate;{creation_legend:hide},createdAt,createdBy;{alternativeEmail_legend:hide},alternativeEmail;{comment_legend:hide},comment'
  ),

  // Fields
  'fields' => array
  (
    'id' => array
    (
      'sql'                     => "int(10) unsigned NOT NULL auto_increment"
    ),
    'tstamp' => array
    (
      'sql'                     => "int(10) unsigned NOT NULL default '0'"
    ),
    'title' => array
    (
      // only needed for backend breadcrumb (stored and updated via onsubmit_callback)
      'eval'                    => array('doNotShow'=>true),
      'sql'                     => "varchar(512) NOT NULL default ''"
    ),
    'number' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_order']['number'],
      'exclude'                 => true,
      'search'                  => true,
      'inputType'               => 'text',
      'eval'                    => array('mandatory'=>true, 'maxlength'=>128, 'tl_class'=>'w50', 'unique'=>true, 'alwaysSave'=>true),
      'load_callback'           => array(array('tl_apparel_order', 'getNextNumber')),
      'sql'                     => "varchar(128) NOT NULL default ''"
    ),
    'member' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_order']['member'],
      'exclude'                 => true,
      'filter'                  => true,
      'sorting'                 => true,
      'inputType'               => 'select',
      'foreignKey'              => 'tl_member.CONCAT(firstname, " ", lastname)',
      'eval'                    => array('chosen'=>true, 'mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
      'sql'                     => "int(10) unsigned NULL",
      'relation'                => array('type'=>'hasOne', 'load'=>'eager')
    ),
    'status' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_order']['status'],
      'exclude'                 => true,
      'filter'                  => true,
      'sorting'                 => true,
      'inputType'               => 'select',
      'default'                 => \ApparelManagerHelper::ORDER_STATUS_ORDERED,
      'options'                 => array(\ApparelManagerHelper::ORDER_STATUS_PRE_ORDERED, \ApparelManagerHelper::ORDER_STATUS_ORDERED, \ApparelManagerHelper::ORDER_STATUS_DELIVERED, \ApparelManagerHelper::ORDER_STATUS_INVOICED),
      'reference'               => &$GLOBALS['TL_LANG']['ApparelManager']['status'],
      'eval'                    => array('mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'clr w50'),
      'sql'                     => "varchar(32) NOT NULL default ''"
    ),
    'orderDate' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_order']['orderDate'],
      'exclude'                 => true,
      'filter'                  => true,
      'sorting'                 => true,
      'flag'                    => 8,
      'default'                 => time(),
      'inputType'               => 'text',
      'eval'                    => array('mandatory'=>true, 'rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 clr wizard'),
      'sql'                     => "varchar(10) NOT NULL default ''"
    ),
    'deliverDate' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_order']['deliverDate'],
      'exclude'                 => true,
      'filter'                  => true,
      'sorting'                 => true,
      'flag'                    => 8,
      'inputType'               => 'text',
      'eval'                    => array('rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
      'sql'                     => "varchar(10) NOT NULL default ''"
    ),
    'invoiceDate' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_order']['invoiceDate'],
      'exclude'                 => true,
      'filter'                  => true,
      'sorting'                 => true,
      'flag'                    => 8,
      'inputType'               => 'text',
      'eval'                    => array('rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
      'sql'                     => "varchar(10) NOT NULL default ''"
    ),
    'createdAt' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_order']['createdAt'],
      'exclude'                 => true,
      'filter'                  => true,
      'sorting'                 => true,
      'default'                 => time(),
      'flag'                    => 8,
      'inputType'               => 'text',
      'eval'                    => array('mandatory'=>true, 'rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
      'sql'                     => "varchar(10) NOT NULL default ''"
    ),
    'createdBy' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_order']['createdBy'],
      'exclude'                 => true,
      'filter'                  => true,
      'sorting'                 => true,
      'default'                 => BackendUser::getInstance()->id,
      'inputType'               => 'select',
      'foreignKey'              => 'tl_user.name',
      'eval'                    => array('chosen'=>true, 'mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
      'sql'                     => "int(10) unsigned NULL",
      'relation'                => array('type'=>'hasOne', 'load'=>'eager')
    ),
    'alternativeEmail' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_order']['alternativeEmail'],
      'exclude'                 => true,
      'inputType'               => 'text',
      'eval'                    => array('maxlength'=>255, 'rgxp'=>'email', 'decodeEntities'=>true, 'tl_class'=>'w50'),
      'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    'comment' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_order']['comment'],
      'search'                  => true,
      'exclude'                 => true,
      'inputType'               => 'textarea',
      'eval'                    => array('tl_class'=>'clr', 'style'=>'min-height:60px'),
      'sql'                     => "text NULL"
    ),

  )
);

/**
 * Class tl_apparel_order
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2016-2017
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_apparel_order extends Backend
{
  CONST COUNTER_REGEX = '/^\[\C\,[1-9]\]$/';
  
  /**
   * Add an image to each record
   * @param array
   * @param string
   * @param \DataContainer
   * @param array
   * @return string
   */
  public function prepareLabel($row, $label, DataContainer $dc, $args)
  {
    $positions = "";

    $objApparelOrderItems = \ApparelOrderItemModel::findByPid($row['id'], array('order' => "sorting"));
    if ($objApparelOrderItems == null)
    {
      $positions .= '<span class="tl_warn_no_child_elements">' . $GLOBALS['TL_LANG']['tl_apparel_order']['warn_no_items'] . '</span>';
    }
    else
    {
      $positions = \ApparelManagerHelper::getOrderPositionsHtml($objApparelOrderItems, true);
    }

    $member = \MemberModel::findByPk($row['member']);

    return '
<div>
  <table class="tl_apparel_child apparel_order">
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_order']['number'][0] . ':</span></td><td>' . $row['number'] . '</td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_order']['member'][0] . ':</span></td><td>' . $member->firstname . " " . $member->lastname . '</td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_order']['status'][0] . ':</span></td><td>' . $GLOBALS['TL_LANG']['ApparelManager']['status'][$row['status']] . ' <img src="system/modules/ApparelManager/assets/status_' . $row['status'] . '.png" alt="' . $GLOBALS['TL_LANG']['ApparelManager']['status'][$row['status']] . '" /></td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_order']['orderDate'][0] . ':</span></td><td>' . date(\Config::get('dateFormat'), $row['orderDate']) . '</td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_order']['deliverDate'][0] . ':</span></td><td>' . ($row['deliverDate'] ? date(\Config::get('dateFormat'), $row['deliverDate']) : '-') . '</td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_order']['invoiceDate'][0] . ':</span></td><td>' . ($row['invoiceDate'] ? date(\Config::get('dateFormat'), $row['invoiceDate']) : '-') . '</td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['MSC']['ApparelManager']['creation'] . ':</span></td><td>' . sprintf($GLOBALS['TL_LANG']['MSC']['ApparelManager']['creation_format'], date(\Config::get('dateFormat'), $row['createdAt']), \UserModel::findByPk($row['createdBy'])->name) . '</td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['MSC']['ApparelManager']['items'] . ':</span></td><td>' . $positions . '</td></tr>
  </table>
</div>' . "\n";
  }

  /**
   * Store the title
   * @param object
   */
  public function saveTitle($dc)
  {
    if (!$dc instanceof \DataContainer || !$dc->id || !$dc->activeRecord)
    {
      return;
    }

    $member = \MemberModel::findByPk($dc->activeRecord->member);
    $title = $dc->activeRecord->number . " - " . $member->firstname . " " . $member->lastname;

    $this->Database->prepare("UPDATE tl_apparel_order SET title=? WHERE id=?")
             ->execute($title, $dc->id);
  }

  /**
   * Return the invoice order button
   * @param array
   * @param string
   * @param string
   * @param string
   * @param string
   * @param string
   * @return string
   */
  public function invoiceOrder($row, $href, $label, $title, $icon, $attributes)
  {
    return $row['status'] == \ApparelManagerHelper::ORDER_STATUS_DELIVERED ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.png$/i', '_.png', $icon)).' ';
  }

  /**
   * Returns the order number, if no one is set the next free number will be searched in database.
   */
  public function getNextNumber($varValue, DataContainer $dc)
  {
    if (!empty($varValue)) {
      return $varValue;
    }

    // if there is no number, we generate the next one
    $arrPattern = deserialize(\Config::get('apparelManagerOrderNumberPattern'), true);
    $prefix    = $this->replaceOrderNumberPatternPlaceholder($arrPattern[0]);
    $delimiter = $this->replaceOrderNumberPatternPlaceholder($arrPattern[1]);
    $suffix    = $this->replaceOrderNumberPatternPlaceholder($arrPattern[2]);
    
    $orderNumberRegex = $this->createOrderNumberRegex($prefix, $delimiter, $suffix);
    
    $arrCounterValues = array();
    
    $objApparelOrders = \ApparelOrderModel::findAll();
    if ($objApparelOrders != null)
    {
      while ($objApparelOrders->next())
      {
        if (preg_match($orderNumberRegex, $objApparelOrders->number))
        {
          $arrCounterValues[] = $this->extractCounterValue($objApparelOrders->number, $prefix, $delimiter, $suffix);
        }
      }
    }
    
    // sort highest to the top
    rsort($arrCounterValues);
    
    $nextNumber = 1;
    if (!empty($arrCounterValues))
    {
      $nextNumber = (int) $arrCounterValues[0] + 1;
    }

    return $this->createNextOrderNumber($nextNumber, $prefix, $delimiter, $suffix);
  }
  
  /**
   *
   */
  private function replaceOrderNumberPatternPlaceholder($strPatternPart)
  {
    $strPatternPart = str_replace("[NBSP]", " ", $strPatternPart);
    $strPatternPart = $this->replaceInsertTags($strPatternPart, false);
    return $strPatternPart;
  }
  
  /**
   *
   */
  private function isOrderNumberCounterVariable($strPatternPart)
  {
    return preg_match(static::COUNTER_REGEX, $strPatternPart);
  }
  
  /**
   *
   */
  private function getOrderNumberCounterVariableLength($strPatternPart)
  {
    $length = trim(explode(",", $strPatternPart)[1]);
    return substr($length, 0, strlen($length) - 1);
  }
  
  /**
   *
   */
  private function createOrderNumberRegex($prefix, $delimiter, $suffix)
  {
    $regex = '/^';
    $regex .= $this->replaceOrderNumberCounterVariable($prefix);
    $regex .= $this->replaceOrderNumberCounterVariable($delimiter);
    $regex .= $this->replaceOrderNumberCounterVariable($suffix);
    $regex .= '$/';
    return $regex;
  }
  
  /**
   *
   */
  private function replaceOrderNumberCounterVariable($strPatternPart)
  {
    if (!$this->isOrderNumberCounterVariable($strPatternPart))
    {
      return str_replace("/", "\/", preg_quote($strPatternPart));
    }
    return '[0-9]{' . $this->getOrderNumberCounterVariableLength($strPatternPart) . '}';
  }
  
  /**
   *
   */
  private function extractCounterValue($orderNumber, $prefix, $delimiter, $suffix)
  {
    if ($this->isOrderNumberCounterVariable($prefix))
    {
      return substr($orderNumber, 0, $this->getOrderNumberCounterVariableLength($prefix));
    }
    if ($this->isOrderNumberCounterVariable($delimiter))
    {
      return substr($orderNumber, strlen($prefix), $this->getOrderNumberCounterVariableLength($delimiter));
    }
    if ($this->isOrderNumberCounterVariable($suffix))
    {
      return substr($orderNumber,  strlen($prefix) + strlen($delimiter));
    }
  }
  
  /**
   *
   */
  private function createNextOrderNumber($nextNumber, $prefix, $delimiter, $suffix)
  {
    if ($this->isOrderNumberCounterVariable($prefix))
    {
      $prefix = $this->addLeadingZeros($nextNumber, $this->getOrderNumberCounterVariableLength($prefix));
    }
    if ($this->isOrderNumberCounterVariable($delimiter))
    {
      $delimiter = $this->addLeadingZeros($nextNumber, $this->getOrderNumberCounterVariableLength($delimiter));
    }
    if ($this->isOrderNumberCounterVariable($suffix))
    {
      $suffix = $this->addLeadingZeros($nextNumber, $this->getOrderNumberCounterVariableLength($suffix));
    }
    
    return $prefix . $delimiter . $suffix;
  }
  
  /**
   *
   */
  private function addLeadingZeros($number, $length)
  {
    $strNumber = "";
    
    for ($i = 0; $i < ($length - strlen($number)); $i++)
    {
      $strNumber .= "0";
    }
    
    $strNumber .= $number;
    return $strNumber;
  }
}

?>