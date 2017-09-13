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
 * Table tl_apparel_order_item
 */
$GLOBALS['TL_DCA']['tl_apparel_order_item'] = array
(

  // Config
  'config' => array
  (
    'dataContainer'           => 'Table',
    'ptable'                  => 'tl_apparel_order',
    'enableVersioning'        => true,
    'notCopyable'             => true,
    'onload_callback' => array
    (
      array('tl_apparel_order_item', 'initPalettes')
    ),
    'ondelete_callback' => array
    (
      array('tl_apparel_order_item', 'deleteOrderItem')
    ),
    'sql' => array
    (
      'keys' => array
      (
        'id' => 'primary',
        'pid' => 'index'
      )
    )
  ),

  // List
  'list' => array
  (
    'sorting' => array (
      'mode'                    => 4,
      'fields'                  => array('sorting'),
      'flag'                    => 1,
      'panelLayout'             => 'filter;sort,search,limit',
      'headerFields'            => array('number', 'member', 'status', 'orderDate', 'deliverDate', 'invoiceDate', 'comment'),
      'header_callback'         => array('tl_apparel_order_item', 'prepareHeader'),
      'child_record_callback'   => array('tl_apparel_order_item', 'prepareChild'),
      'child_record_class'      => 'no_padding'
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
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_order_item']['edit'],
        'href'                => 'table=tl_apparel_order_item&amp;act=edit',
        'icon'                => 'edit.gif'
      ),
      'cut' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_order_item']['cut'],
        'href'                => 'act=paste&amp;mode=cut',
        'icon'                => 'cut.gif'
      ),
      'delete' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_order_item']['delete'],
        'href'                => 'act=delete',
        'icon'                => 'delete.gif',
        'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
      ),
      'showArticle' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_order_item']['showArticle'],
        'icon'                => 'system/modules/ApparelManager/assets/icon_apparel_article.png',
        'attributes'          => 'onclick="Backend.openModalIframe({\'width\':768,\'title\':\'' . $GLOBALS['TL_LANG']['tl_apparel_order_item']['showArticle'][0] . '\',\'url\':this.href});return false"',
        'button_callback'     => array('tl_apparel_order_item', 'showArticle')
      ),
      'show' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_order_item']['show'],
        'href'                => 'act=show',
        'icon'                => 'show.gif'
      )
    )
  ),

  // Palettes
  'palettes' => array
  (
    '__selector__' => array('type'),
    'default'      => '{article_legend},apparealArticle;{price_legend},specialPrice,specialPriceComment;{comment_legend:hide},comment'
  ),

  // Fields
  'fields' => array
  (
    'id' => array
    (
      'sql'                     => "int(10) unsigned NOT NULL auto_increment"
    ),
    'pid' => array
    (
      'foreignKey'              => 'tl_apparel_order.id',
      'eval'                    => array('doNotShow'=>true),
      'sql'                     => "int(10) unsigned NOT NULL default '0'",
      'relation'                => array('type'=>'belongsTo', 'load'=>'lazy')
    ),
    'sorting' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['MSC']['sorting'],
      'sorting'                 => true,
      'flag'                    => 11,
      'sql'                     => "int(10) unsigned NOT NULL default '0'"
    ),
    'tstamp' => array
    (
      'sql'                     => "int(10) unsigned NOT NULL default '0'"
    ),
    'apparealArticle' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_order_item']['apparealArticle'],
      'exclude'                 => true,
      'filter'                  => true,
      'sorting'                 => true,
      'inputType'               => 'select',
      'options_callback'        => array('ApparelManagerHelper', 'getPublishedApparelArticlesAsOptions'),
      'foreignKey'              => 'tl_apparel_article.CONCAT(manufacturer, " - ", name, " | ", number)',
      'eval'                    => array('chosen'=>true, 'mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50', 'submitOnChange'=>true),
      'sql'                     => "int(10) unsigned NULL",
      'relation'                => array('type'=>'hasOne', 'load'=>'eager')
    ),
    'apparealArticleVariant' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_order_item']['apparealArticleVariant'],
      'exclude'                 => true,
      'filter'                  => true,
      'sorting'                 => true,
      'inputType'               => 'select',
      'options_callback'        => array('tl_apparel_order_item', 'getPublishedApparealArticleVariants'),
      'foreignKey'              => 'tl_apparel_article_variant.name',
      'eval'                    => array('chosen'=>true, 'mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50', 'submitOnChange'=>true),
      'sql'                     => "int(10) unsigned NULL",
      'relation'                => array('type'=>'hasOne', 'load'=>'eager')
    ),
    'amount' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_order_item']['amount'],
      'exclude'                 => true,
      'sorting'                 => true,
      'search'                  => true,
      'inputType'               => 'text',
      'eval'                    => array('mandatory'=>true, 'maxlength'=>3, 'rgxp'=>'digit', 'tl_class'=>'w50'),
      'save_callback' => array
      (
        array('tl_apparel_order_item', 'saveAmount')
      ),
      'sql'                     => "varchar(3) NOT NULL default ''"
    ),
    'specialPrice' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_order_item']['specialPrice'],
      'exclude'                 => true,
      'search'                  => true,
      'inputType'               => 'text',
      'eval'                    => array('maxlength'=>3, 'tl_class'=>'clr w50', 'rgxp'=>'digit'),
      'sql'                     => "varchar(3) NOT NULL default ''"
    ),
    'specialPriceComment' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_order_item']['specialPriceComment'],
      'exclude'                 => true,
      'search'                  => true,
      'inputType'               => 'text',
      'eval'                    => array('maxlength'=>512, 'tl_class'=>'w50'),
      'sql'                     => "varchar(512) NOT NULL default ''"
    ),
    'comment' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_order_item']['comment'],
      'search'                  => true,
      'exclude'                 => true,
      'inputType'               => 'textarea',
      'eval'                    => array('tl_class'=>'clr', 'style'=>'min-height:60px'),
      'sql'                     => "text NULL"
    )
  )
);

/**
 * Class tl_apparel_order_item
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2016-2016
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_apparel_order_item extends Backend
{
  /**
   * Import the back end user object
   */
  public function __construct()
  {
    parent::__construct();
    $this->import('BackendUser', 'User');
  }

  /**
   * Prepare the header
   * @param  $arrHeaderFields  the headerfields given from list->sorting
   * @param  DataContainer $dc a DataContainer Object
   * @return Array             The manipulated headerfields
   */
  public function prepareHeader($arrHeaderFields, DataContainer $dc)
  {
    $statusKey = array_search($arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_order']['status'][0]], $GLOBALS['TL_LANG']['ApparelManager']['status']);
    $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_order']['status'][0]] = $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_order']['status'][0]] . ' <img src="system/modules/ApparelManager/assets/status_' . $statusKey . '.png" alt="' . $GLOBALS['TL_LANG']['ApparelManager']['status'][$statusKey] . '" />';
    
    $comment = $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_order']['comment'][0]];
    $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_order']['comment'][0]] = (!empty($comment) ? trim(\String::substr($comment, 70)) : '&nbsp;');
    
    $objApparelOrder = \ApparelOrderModel::findByPk(\Input::get('id'));
    $arrHeaderFields[$GLOBALS['TL_LANG']['MSC']['ApparelManager']['creation']] = sprintf($GLOBALS['TL_LANG']['MSC']['ApparelManager']['creation_format'], date(\Config::get('dateFormat'), $objApparelOrder->createdAt), \UserModel::findByPk($objApparelOrder->createdBy)->name);

    $objApparelOrderItems = \ApparelOrderItemModel::findByPid(\Input::get('id'), array('order' => "sorting"));
    $arrHeaderFields[$GLOBALS['TL_LANG']['MSC']['ApparelManager']['totalPrice']] = \ApparelManagerHelper::getOrderTotal($objApparelOrderItems);

    return $arrHeaderFields;
  }

  /**
   * Prepare each child element
   * @param array
   * @return string
   */
  public function prepareChild($row)
  {
    $objApparelArticle = \ApparelArticleModel::findByPk($row['apparealArticle']);
    $objApparelArticleVariant = \ApparelArticleVariantModel::findByPk($row['apparealArticleVariant']);

    return '
<div>
  <h2>' . \ApparelManagerHelper::getArticleTitleWithNumber($objApparelArticle) . '</h2>
  <table class="tl_apparel_child">
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_order_item']['apparealArticleVariant'][0] . ':</span></td><td>' . $objApparelArticleVariant->name . '</td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_order_item']['amount'][0] . ':</span></td><td>' . $row['amount'] . '</td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_order_item']['originalPrice'] . ':</span></td><td>' . sprintf($GLOBALS['TL_LANG']['MSC']['apparel_article_price'], $objApparelArticle->price) . '</td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_order_item']['specialPrice'][0] . ':</span></td><td>' . ($row['specialPrice'] ? sprintf($GLOBALS['TL_LANG']['MSC']['apparel_article_price'], $row['specialPrice']) : "") . '</td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_order_item']['specialPriceComment'][0] . ':</span></td><td>' . (!empty($row['specialPriceComment']) ? trim(\String::substr($row['specialPriceComment'], 70)) : '&nbsp;') . '</td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_order_item']['comment'][0] . ':</span></td><td>' . (!empty($row['comment']) ? trim(\String::substr($row['comment'], 70)) : '&nbsp;') . '</td></tr>
  </table>
</div>' . "\n";
  }

  /**
   * Return all published apparel article vaariants as array
   * @param \DataContainer
   * @return array
   */
  public function getPublishedApparealArticleVariants(DataContainer $dc)
  {
    $arrOptions = array();

    $objApparelArticle = \ApparelArticleModel::findByPk($dc->activeRecord->apparealArticle);
    
    $objApparelArticleVariants = \ApparelArticleVariantModel::findPublishedByPid($objApparelArticle->id, array('order' => "sorting"));
    if ($objApparelArticleVariants !== null)
    {
      while ($objApparelArticleVariants->next())
      {
        if ($objApparelArticle->autoUpdateStock)
        {
          $arrOptions[$objApparelArticleVariants->id] = sprintf($GLOBALS['TL_LANG']['tl_apparel_order_item']['variantStockFormat'], $objApparelArticleVariants->name, $objApparelArticleVariants->stock);
        }
        else
        {
          $arrOptions[$objApparelArticleVariants->id] = $objApparelArticleVariants->name;
        }
      }
    }

    return $arrOptions;
  }

  /**
   * Initialize the palettes when loading
   * @param \DataContainer
   */
  public function initPalettes()
  {
    if (\Input::get('act') == "edit")
    {
      $objApparelOrderItem = \ApparelOrderItemModel::findByPk(\Input::get('id'));
      if ($objApparelOrderItem != null && $objApparelOrderItem->apparealArticle > 0)
      {
        $palette = '{article_legend},apparealArticle,apparealArticleVariant';
        if ($objApparelOrderItem->apparealArticleVariant > 0)
        {
          $palette .= ',amount';
        }
        $palette .= ';';
        $GLOBALS['TL_DCA']['tl_apparel_order_item']['palettes']['default'] = str_replace('{article_legend},apparealArticle;', $palette, $GLOBALS['TL_DCA']['tl_apparel_order_item']['palettes']['default']);
      }
    }
  }

  /**
   * Update stock when saving the amount
   * @param mixed
   * @param \DataContainer
   * @return mixed
   * @throws \Exception
   */
  public function saveAmount($varValue, DataContainer $dc)
  {
    // FIXME: currently a variant change is currently not possible
    
    $objApparelArticle = \ApparelArticleModel::findByPk($dc->activeRecord->apparealArticle);
    if ($objApparelArticle->autoUpdateStock)
    {
      $oldValue = 0;
      if (is_numeric($dc->activeRecord->amount))
      {
        $oldValue = $dc->activeRecord->amount;
      }

      $amountDifference = $oldValue - $varValue;

      if ($amountDifference <> 0 && $dc instanceof \DataContainer && $dc->activeRecord && $dc->activeRecord->apparealArticleVariant)
      {
        $objApparelArticleVariant = \ApparelArticleVariantModel::findByPk($dc->activeRecord->apparealArticleVariant);
        if ($objApparelArticleVariant != null)
        {
          $objApparelArticleVariant->stock = $objApparelArticleVariant->stock + $amountDifference;
          $objApparelArticleVariant->save();

          $this->createNewVersion(\ApparelArticleVariantModel::getTable(), $dc->activeRecord->apparealArticleVariant);
          $this->log('A new version of record "' . \ApparelArticleVariantModel::getTable() . '.id=' . $orderId . '" has been created', __METHOD__, TL_GENERAL);
        }
        
        $msg = "";
        if ($amountDifference > 0)
        {
          $msg = $GLOBALS['TL_LANG']['MSC']['apparel_order_item_increasedStockSuccess'];
        }
        else if ($amountDifference < 0)
        {
          $msg = $GLOBALS['TL_LANG']['MSC']['apparel_order_item_decreasedStockSuccess'];
          $amountDifference = ($amountDifference * -1);
        }
        
        $objApparelArticle = \ApparelArticleModel::findByPk($dc->activeRecord->apparealArticle);
        
        \Message::addConfirmation(sprintf($msg, \ApparelManagerHelper::getArticleTitleWithNumber($objApparelArticle), $objApparelArticleVariant->name, $amountDifference));
      }
    }

    return $varValue;
  }

  /**
   * Update stock when deleting the order item
   * @param object
   */
  public function deleteOrderItem($dc)
  {
    if ($dc instanceof \DataContainer && $dc->activeRecord && $dc->activeRecord->apparealArticleVariant)
    {
      $objApparelArticleVariant = \ApparelArticleVariantModel::findByPk($dc->activeRecord->apparealArticleVariant);
      if ($objApparelArticleVariant != null)
      {
        $objApparelArticleVariant->stock = $objApparelArticleVariant->stock + $dc->activeRecord->amount;
        $objApparelArticleVariant->save();

        $this->createNewVersion(\ApparelArticleVariantModel::getTable(), $dc->activeRecord->apparealArticleVariant);
        $this->log('A new version of record "' . \ApparelArticleVariantModel::getTable() . '.id=' . $orderId . '" has been created', __METHOD__, TL_GENERAL);
      }

      \Message::addConfirmation(sprintf($GLOBALS['TL_LANG']['MSC']['apparel_order_item_increasedStockSuccess'], $dc->activeRecord->apparealArticleVariant, $dc->activeRecord->amount));
    }
  }
  
  /**
   * Return the show article button
   *
   * @param array  $row
   * @param string $href
   * @param string $label
   * @param string $title
   * @param string $icon
   * @param string $attributes
   *
   * @return string
   */
  public function showArticle($row, $href, $label, $title, $icon, $attributes)
  {
    return '<a href="'.$this->addToUrl('do=apparel_article&amp;table=tl_apparel_article_variant&amp;id='.$row['apparealArticle']).'&amp;popup=1" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
  } 
}

?>