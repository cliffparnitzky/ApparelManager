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
 * Run in a custom namespace, so the class can be replaced
 */
namespace CliffParnitzky\Contao\ApparelManager;

/**
 * Class ApparelManagerHelper
 *
 * @copyright  Cliff Parnitzky 2015-2017
 * @author     Cliff Parnitzky
 * @package    Models
 */
class ApparelManagerHelper extends \Controller
{
  const ORDER_STATUS_PRE_ORDERED = 'preordered';
  const ORDER_STATUS_ORDERED     = 'ordered';
  const ORDER_STATUS_DELIVERED   = 'delivered';
  const ORDER_STATUS_INVOICED    = 'invoiced';
  
  /**
   * Show the stock overview
   */
  public function showStockOverview()
  {
    $content = '
<div class="tl_message">
  <p class="tl_info">'.$GLOBALS['TL_LANG']['tl_apparel_article']['info_includes_all_orders'].'</p>
</div>
<div id="tl_buttons">
<a href="'.ampersand(str_replace('&key=stockOverview', '', \Environment::get('request'))).'" class="header_back" title="'.specialchars($GLOBALS['TL_LANG']['MSC']['backBTTitle']).'" accesskey="b">'.$GLOBALS['TL_LANG']['MSC']['backBT'].'</a>
</div>

<h2 class="sub_headline">'.$GLOBALS['TL_LANG']['tl_apparel_article']['stockOverview'][1].'</h2>

<div class="tl_xpl">
<div class="tl_tbox">
  <table class="tl_listing" style="margin-top: 10px;">
    <tr>
      <th class="tl_folder_tlist">' . $GLOBALS['TL_LANG']['tl_apparel_article']['article'] . '</th>
      <th class="tl_folder_tlist">' . $GLOBALS['TL_LANG']['tl_apparel_article']['stock'] . '</th>
      <th class="tl_folder_tlist" style="width: 1%; text-align: center;">' . $GLOBALS['TL_LANG']['tl_apparel_article']['singlePrice'] . '</th>
      <th class="tl_folder_tlist" style="width: 1%; text-align: center;">' . $GLOBALS['TL_LANG']['tl_apparel_article']['totalPrice'] . '</th>
    </tr>';
    
    $objApparelArticles = \ApparelArticleModel::findAllPublished(array('order' => "category, manufacturer, name, type"));
    
    $stockTotalAmount = 0;
    $stockTotalPrice = 0;
    if ($objApparelArticles != null)
    {
      while ($objApparelArticles->next())
      {
        $objApparelArticleVariants = \ApparelArticleVariantModel::findPublishedByPid($objApparelArticles->id, array('order' => "sorting"));
        
        $stockVariantsTotalAmount = static::getVariantsTotal($objApparelArticleVariants);
        $stockTotalAmount += $stockVariantsTotalAmount;
        $stockVariantsTotalPrice = $objApparelArticles->price * $stockVariantsTotalAmount;
        $stockTotalPrice += $stockVariantsTotalPrice;
        
        $content .= '
    <tr onmouseover="Theme.hoverRow(this,1)" onmouseout="Theme.hoverRow(this,0)">
      <td class="tl_file_list" style="vertical-align: top; ">' . static::getArticleTitleWithNumber($objApparelArticles) . '</td>
      <td class="tl_file_list" style="vertical-align: top; ">' . (!empty($objApparelArticleVariants) ? static::getArticleVariantsHtml($objApparelArticleVariants) : "&nbsp;") . '</td>
      <td class="tl_file_list" style="vertical-align: top; text-align: right;">' . sprintf($GLOBALS['TL_LANG']['MSC']['apparel_article_price'], $objApparelArticles->price) . '</td>
      <td class="tl_file_list" style="vertical-align: top; text-align: right;">' . sprintf($GLOBALS['TL_LANG']['MSC']['apparel_article_price'], $stockVariantsTotalPrice) . '</td>
    </tr>';
      }
    }

    $content .= '
    <tr>
      <th class="tl_folder_tlist">&nbsp;</th>
      <th class="tl_folder_tlist" style="border-bottom: 3px double #afafaf; text-align: right;">' . sprintf($GLOBALS['TL_LANG']['MSC']['apparel_article_unit'], $stockTotalAmount) . '</th>
      <th class="tl_folder_tlist">&nbsp;</th>
      <th class="tl_folder_tlist" style="border-bottom: 3px double #afafaf; text-align: right;">' . sprintf($GLOBALS['TL_LANG']['MSC']['apparel_article_price'], $stockTotalPrice) . '</th>
    </tr>
  </table>
</div>
</div>

<div class="tl_formbody_submit">

<div class="tl_submit_container">
  <!-- input type="submit" name="save" id="save" class="tl_submit" accesskey="s" value="'.specialchars($GLOBALS['TL_LANG']['tl_theme']['importTheme'][0]).'" -->
</div>

</div>';
    return $content;
  }
  
  /**
   * Create the delivery sheet
   */
  public function createDeliverySheet()
  {
    $orderId = \Input::get('id');
    $objApparelOrder = \ApparelOrderModel::findByPk($orderId);
    $objApparelOrderItems = \ApparelOrderItemModel::findByPid($orderId, array('order' => "sorting"));
    $objMember = \MemberModel::findByPk($objApparelOrder->member);
    
    if (!empty($objApparelOrder) && !empty($objApparelOrderItems) && !empty($objMember))
    {
      $arrTokens = $this->getSimpleTokens($objApparelOrder, $objApparelOrderItems, $objMember, false);
      $arrTokens['order_positions_html'] = static::getOrderPositionsHtml($objApparelOrderItems, false, 10);
      
      $objTemplate = new \FrontendTemplate('apparel_mgr_delivery_sheet');
      $content = $this->replaceInsertTags($objTemplate->parse(), false);
      //$content = '<img src="http://www.rsc-lueneburg.de/files/website/_layout/Logo_TriTeamLueneburg.png" width="250px" /><h1>Test '.$orderId.'</h1>';
      $content = $this->parseSimpleTokens($content, $arrTokens);;
      
      // TCPDF configuration
      $l['a_meta_dir'] = 'ltr';
      $l['a_meta_charset'] = \Config::get('characterSet');
      $l['a_meta_language'] = substr($GLOBALS['TL_LANGUAGE'], 0, 2);
      $l['w_page'] = 'page';

      // Include library
      require_once TL_ROOT . '/system/config/tcpdf.php';

      // Create new PDF document
      $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true);

      // Set document information
      $pdf->SetCreator(PDF_CREATOR);
      $pdf->SetAuthor(PDF_AUTHOR);
      $pdf->SetTitle($objApparelOrder->number);
      $pdf->SetSubject($objApparelOrder->number);

      // Prevent font subsetting (huge speed improvement)
      $pdf->setFontSubsetting(false);

      // Remove default header/footer
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);

      // Set margins
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

      // Set auto page breaks
      $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

      // Set image scale factor
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

      // Set some language-dependent strings
      $pdf->setLanguageArray($l);

      // Initialize document and add a page
      $pdf->AddPage();

      // Set font
      $pdf->SetFont(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN);

      // Write the HTML content
      $pdf->writeHTML($content, true, 0, true, 0);

      // Close and output PDF document
      $pdf->lastPage();
      $pdf->Output(standardize(ampersand(sprintf($GLOBALS['TL_LANG']['tl_apparel_order']['delivery_title'], $objApparelOrder->number), false)) . '.pdf', 'D');
      
      // Stop script execution
      exit;
    }

    $path = \Environment::get('base') . 'contao/main.php?do=' . \Input::get('do');
    $this->redirect($path, 301);
  }

  /**
   * Send the invoice notification
   */
  public function sendInvoiceNotification()
  {
    $orderId = \Input::get('id');

    $objApparelOrder = \ApparelOrderModel::findByPk($orderId);
    $objApparelOrderItems = \ApparelOrderItemModel::findByPid($orderId, array('order' => "sorting"));
    $objMember = \MemberModel::findByPk($objApparelOrder->member);

    if (($objNotification = \NotificationCenter\Model\Notification::findByPk(\Config::get('apparelManagerInvoiceNotification'))) !== null &&
        !empty($objApparelOrder) && !empty($objApparelOrderItems) && !empty($objMember))
    {
      $arrTokens = $this->getSimpleTokens($objApparelOrder, $objApparelOrderItems, $objMember);
      $objNotification->send($arrTokens, $objMember->language);
      
      // update order (set status to invoiced and invoice date)
      $objApparelOrder->status = static::ORDER_STATUS_INVOICED;
      $objApparelOrder->invoiceDate = time();
      $objApparelOrder->save(); 

      $this->createNewVersion(\ApparelOrderModel::getTable(), $orderId);
      $this->log('A new version of record "' . \ApparelOrderModel::getTable() . '.id=' . $orderId . '" has been created', __METHOD__, TL_GENERAL);
      
      \Message::addConfirmation(sprintf($GLOBALS['TL_LANG']['MSC']['apparel_order_invoiceSuccess'], $orderId));
    }
    else
    {
      \Message::addError(sprintf($GLOBALS['TL_LANG']['ERR']['apparel_order_invoiceError'], $orderId));
    }

    $path = \Environment::get('base') . 'contao/main.php?do=' . \Input::get('do');
    $this->redirect($path, 301);
  }

  /**
   * Create the Text list of the order items.
   */
  public static function getOrderPositionsText($objApparelOrderItems)
  {
    $positions = '';

    foreach($objApparelOrderItems as $objApparelOrderItem)
    {
      $objApparelArticle = \ApparelArticleModel::findByPk($objApparelOrderItem->apparealArticle);
      $objApparelArticleVariant = \ApparelArticleVariantModel::findByPk($objApparelOrderItem->apparealArticleVariant);

      $price = $objApparelArticle->price;
      if (!empty($objApparelOrderItem->specialPrice))
      {
        $price = $objApparelOrderItem->specialPrice;
      }

      $positions .= "- "
                  . $objApparelOrderItem->amount
                  . ' x '
                  . static::getArticleTitleSimple($objApparelArticle)
                  . " - "
                  . $objApparelArticleVariant->name
                  . " : "
                  . sprintf($GLOBALS['TL_LANG']['MSC']['apparel_article_unit_price'], $price)
                  . "\n";
    }

    return $positions;
  }

  /**
   * Create the HTML table of the order items.
   */
  public static function getOrderPositionsHtml($objApparelOrderItems, $blnLinkArticle=false, $columnWidthSmall=1)
  {
    $columnWidthBig = 100 - (6 * $columnWidthSmall);
    
    $positions = '<table class="order_items" style="max-width: 800px;"><tr>';
    $positions .= '<th style="text-align: center; padding: 3px; border-right: 1px solid #afafaf;" width="' . $columnWidthSmall . '%">' . $GLOBALS['TL_LANG']['MSC']['ApparelManager']['itemNo'] . '</th>';
    $positions .= '<th style="text-align: center; padding: 3px; border-right: 1px solid #afafaf;" width="' . $columnWidthSmall . '%">' . $GLOBALS['TL_LANG']['MSC']['ApparelManager']['apparelArticleNumber'] . '</th>';
    $positions .= '<th style="text-align: left; padding: 3px; border-right: 1px solid #afafaf;" width="' . $columnWidthBig . '%">' . $GLOBALS['TL_LANG']['MSC']['ApparelManager']['apparelArticle'] . '</th>';
    $positions .= '<th style="text-align: center; padding: 3px; border-right: 1px solid #afafaf;" width="' . $columnWidthSmall . '%">' . $GLOBALS['TL_LANG']['MSC']['ApparelManager']['apparelArticleVariant'] . '</th>';
    $positions .= '<th style="text-align: center; padding: 3px; border-right: 1px solid #afafaf;" width="' . $columnWidthSmall . '%">' . $GLOBALS['TL_LANG']['MSC']['ApparelManager']['amount'] . '</th>';
    $positions .= '<th style="text-align: center; padding: 3px; border-right: 1px solid #afafaf;" width="' . $columnWidthSmall . '%">' . $GLOBALS['TL_LANG']['MSC']['ApparelManager']['singlePrice'] . '</th>';
    $positions .= '<th style="text-align: center; padding: 3px;" width="' . $columnWidthSmall . '%">' . $GLOBALS['TL_LANG']['MSC']['ApparelManager']['totalPrice'] . '</th>';
    $positions .= '</tr>';

    $itemNo = 1;
    foreach($objApparelOrderItems as $objApparelOrderItem)
    {
      $objApparelArticle = \ApparelArticleModel::findByPk($objApparelOrderItem->apparealArticle);
      $objApparelArticleVariant = \ApparelArticleVariantModel::findByPk($objApparelOrderItem->apparealArticleVariant);

      $positions .= '<tr>';
      $positions .= '<td style="text-align: center; padding: 3px; border-right: 1px solid #afafaf; border-top: 1px solid #afafaf;">' . $itemNo++ . '</td>';
      $positions .= '<td style="text-align: center; padding: 3px; border-right: 1px solid #afafaf; border-top: 1px solid #afafaf;">' . $objApparelArticle->number . '</td>';
      $positions .= '<td style="text-align: left; padding: 3px; border-right: 1px solid #afafaf; border-top: 1px solid #afafaf;">' . static::getArticleTitleSimple($objApparelArticle, $blnLinkArticle) . '</td>';
      $positions .= '<td style="text-align: center; padding: 3px; border-right: 1px solid #afafaf; border-top: 1px solid #afafaf;">' . $objApparelArticleVariant->name . '</td>';
      $positions .= '<td style="text-align: center; padding: 3px; border-right: 1px solid #afafaf; border-top: 1px solid #afafaf;">' . $objApparelOrderItem->amount . '</td>';
      $price = $objApparelArticle->price;
      if (!empty($objApparelOrderItem->specialPrice))
      {
        $price = $objApparelOrderItem->specialPrice;
      }
      $positions .= '<td style="text-align: right; padding: 3px; border-right: 1px solid #afafaf; border-top: 1px solid #afafaf;">' . sprintf($GLOBALS['TL_LANG']['MSC']['apparel_article_price'], $price) . '</td>';
      $positions .= '<td style="text-align: right; padding: 3px; border-top: 1px solid #afafaf;">' . sprintf($GLOBALS['TL_LANG']['MSC']['apparel_article_price'], $price * $objApparelOrderItem->amount) . '</td>';
      $positions .= '</tr>';
    }
    $positions .= '<tr>';
    $positions .= '<td colspan="6" style="border-top: 1px solid #afafaf;">&nbsp;</td>';
    $positions .= '<td style="text-align: right; padding: 3px; border-top: 1px solid #afafaf; font-weight: bold; border-bottom: 3px double #afafaf;">' . static::getOrderTotal($objApparelOrderItems) . '</td>';
    $positions .= '</tr>';
    $positions .= '</table>';

    return $positions;
  }

  /**
   * Sum up all items to get the total for the order.
   */
  public static function getOrderTotal($objApparelOrderItems, $blnRaw=false)
  {
    $completePrice = 0;
    if (!empty($objApparelOrderItems))
    {
      foreach($objApparelOrderItems as $objApparelOrderItem)
      {
        $objApparelArticle = \ApparelArticleModel::findByPk($objApparelOrderItem->apparealArticle);

        $price = $objApparelArticle->price;
        if (!empty($objApparelOrderItem->specialPrice))
        {
          $price = $objApparelOrderItem->specialPrice;
        }

        $completePrice += $price * $objApparelOrderItem->amount;
      }
    }

    if ($blnRaw)
    {
      return $completePrice;
    }
    
    return sprintf($GLOBALS['TL_LANG']['MSC']['apparel_article_price'], $completePrice);
  }
  
  /**
   * Create the HTML table of the article.
   */
  public static function getArticleHtml($objApparelArticle, $includeStock=false)
  {
    $GLOBALS['TL_CSS'][] = 'system/modules/ApparelManager/assets/apparel_manager_be.css';
    \System::loadLanguageFile('tl_apparel_article');
    
    $stock = "";
    
    $objApparelArticleVariants = \ApparelArticleVariantModel::findPublishedByPid($objApparelArticle->id, array('order' => "sorting"));
    if ($objApparelArticleVariants == null)
    {
      $stock = '<span class="tl_warn_no_child_elements">' . $GLOBALS['TL_LANG']['tl_apparel_article']['warn_no_published_variants'] . '</span>';
    }
    else
    {
      $stock = \ApparelManagerHelper::getArticleVariantsHtml($objApparelArticleVariants);
    }
    
    $imageWidth = 80;
    $imageHeight = 120;
    $imageSrc = "";
    $arrImages = deserialize($objApparelArticle->images, true);
    if (count($arrImages) > 0)
    {
      $objFile = \FilesModel::findByUuid($arrImages[0]);
      $imageSrc = \Image::get($objFile->path, $imageWidth, $imageHeight, 'proportional');
    }
    
    return '<div>
  <h2>' . $objApparelArticle->name . '</h2>
  <img class="apparel_image" src="' . $imageSrc . '" width="' . $imageWidth . '" height="' . $imageHeight . '" />
  <table class="tl_apparel_child">
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_article']['number'][0] . ':</span></td><td>' . $objApparelArticle->number . '</td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_article']['type'][0] . ':</span></td><td>' . $GLOBALS['TL_LANG']['ApparelManager']['type'][$objApparelArticle->type] . ' <img src="system/modules/ApparelManager/assets/type_' . $objApparelArticle->type . '.png" alt="' . $GLOBALS['TL_LANG']['ApparelManager']['type'][$objApparelArticle->type] . '" /></td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_article']['details'][0] . ':</span></td><td>- ' . implode('<br>- ', deserialize($objApparelArticle->details, true)) . '</td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_article']['price'][0] . ':</span></td><td>' . sprintf($GLOBALS['TL_LANG']['MSC']['apparel_article_price'], $objApparelArticle->price) . '</td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_article']['productLink'][0] . ':</span></td><td>' . (!empty($objApparelArticle->productLink) ? '<a href="' . $objApparelArticle->productLink . '" target="_blank">' .  trim(\StringUtil::substr($objApparelArticle->productLink, 70)) . '</a>' : '&nbsp;') . '</td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_article']['comment'][0] . ':</span></td><td>' . (!empty($objApparelArticle->comment) ? trim(\StringUtil::substr($objApparelArticle->comment, 70)) : '&nbsp;') . '</td></tr>
    ' . ($includeStock ? '<tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_article']['stock'] . ':</span></td><td>' . $stock . '</td></tr>' : '') . '
  </table>
</div>';
  }
  
  /**
   * Create the title for an article.
   */
  public static function getArticleTitleSimple($objApparelArticle, $blnLinkArticle=false)
  {
    $title = "";
    
    if ($blnLinkArticle)
    {
      $title .= '<a href="contao/main.php?do=apparel_article&amp;table=tl_apparel_article_variant&amp;id=' . $objApparelArticle->id . '&amp;popup=1&amp;rt=' . REQUEST_TOKEN . '" title="' . $GLOBALS['TL_LANG']['tl_apparel_order']['showArticle'] . '" onclick="Backend.openModalIframe({\'width\':768,\'title\':\'' . $GLOBALS['TL_LANG']['tl_apparel_order']['showArticle'] . '\',\'url\':this.href});return false">';
    }
    
    $title .= sprintf($GLOBALS['TL_LANG']['MSC']['apparel_article_title_simple'],
                      $objApparelArticle->manufacturer,
                      $objApparelArticle->name,
                      $GLOBALS['TL_LANG']['ApparelManager']['type'][$objApparelArticle->type]);
    
    if ($blnLinkArticle)
    {
      $title .= '</a>';
    }
    
    return $title;
  }
  
  /**
   * Create the title for an article.
   */
  public static function getArticleTitleWithNumber($objApparelArticle)
  {
    return sprintf($GLOBALS['TL_LANG']['MSC']['apparel_article_title_with_number'], $objApparelArticle->manufacturer,
                                                                                    $objApparelArticle->name,
                                                                                    $GLOBALS['TL_LANG']['ApparelManager']['type'][$objApparelArticle->type],
                                                                                    $objApparelArticle->number);
  }
  
  /**
   * Return all published apparel articles as array for creating a select box
   * @param \DataContainer
   * @return array
   */
  public function getPublishedApparelArticlesAsOptions()
  {
    $arrOptions = array();

    $objApparelArticles = \ApparelArticleModel::findAllPublished(array('order' => "category, manufacturer, name, type"));
    if ($objApparelArticles !== null)
    {
      while ($objApparelArticles->next())
      {
        $arrOptions[\ApparelManagerHelper::getCategories()[$objApparelArticles->category]][$objApparelArticles->id] = \ApparelManagerHelper::getArticleTitleWithNumber($objApparelArticles);
      }
    }

    return $arrOptions;
  }
  
  /**
   * Create the HTML table of the article variants.
   */
  public static function getArticleVariantsHtml($objApparelArticleVariants)
  {
    $variants = '<table class="tl_apparel_sub article_variants"><tr>';
    foreach($objApparelArticleVariants as $objApparelArticleVariant)
    {
      $variants .= '<th>' . $objApparelArticleVariant->name . '</th>';
    }
    $variants .= '</tr><tr>';
    foreach($objApparelArticleVariants as $objApparelArticleVariant)
    {
      $variants .= '<td>' . $objApparelArticleVariant->stock . '</td>';
    }
    
    $variants .= '</tr>';
    $variants .= '<tr>';
    if (count($objApparelArticleVariants) > 1)
    {
    $variants .= '<td colspan="' . (count($objApparelArticleVariants) - 1) . '" style="border-right: 0">&nbsp;</td>';
    
    }
    $variants .= '<td style="text-align: right; font-weight: bold; border-bottom: 3px double #afafaf;">' . static::getVariantsTotal($objApparelArticleVariants) . '</td>';
    $variants .= '</tr>';

    $variants .= '</table>';
    return $variants;
  }
  
  /**
   * Sum up the stock of all variants.
   */
  public static function getVariantsTotal($objApparelArticleVariants)
  {
    $completeStock = 0;
    if (!empty($objApparelArticleVariants))
    {
      foreach($objApparelArticleVariants as $objApparelArticleVariant)
      {
        $completeStock += $objApparelArticleVariant->stock;
      }
    }
    return $completeStock;
  }
  
  public static function getCategories()
  {
    $arrCategories = array();

    $arrConfiguredCategories = deserialize(\Config::get('apparelManagerCategories'), true);
    if (!empty($arrConfiguredCategories))
    {
      foreach($arrConfiguredCategories as $category)
      {
        $arrCategories[$category['key']] = $category['value'];
      }
    }

    return $arrCategories;
  }
  
  /**
   * Create the array with the simple tokens and its replacements
   */
  private function getSimpleTokens($objApparelOrder, $objApparelOrderItems, $objMember, $blnIncludeOrderPositionsHtml=true)
  {
    $arrTokens = array();
    // Administrator e-mail
    $arrTokens['admin_email'] = \Config::get('adminEmail');
    
    // User e-mail
    $arrTokens['user_email'] = \BackendUser::getInstance()->email;
    
    // Creator e-mail
    $objCreator = $objApparelOrder->getRelated('createdBy'); 
    $arrTokens['creator_email'] = $objCreator->email;

    // Customer tokens
    foreach ($objMember->row() as $strFieldName => $strFieldValue)
    {
      if ($strFieldName != 'password')
      {
        $arrTokens['customer_' . $strFieldName] = \Haste\Util\Format::dcaValue('tl_member', $strFieldName, $strFieldValue);
      }
    }
    
    // Replace e-mail aof customer with alternative e-mail address
    if (!empty($objApparelOrder->alternativeEmail))
    {
      $arrTokens['customer_email'] = $objApparelOrder->alternativeEmail;
    }

    // Order tokens
    foreach ($objApparelOrder->row() as $strFieldName => $strFieldValue)
    {
      $arrTokens['order_' . $strFieldName] = \Haste\Util\Format::dcaValue('tl_apparel_order', $strFieldName, $strFieldValue);
    }
    $arrTokens['order_positions_text'] = static::getOrderPositionsText($objApparelOrderItems);
    if ($blnIncludeOrderPositionsHtml)
    {
      $arrTokens['order_positions_html'] = static::getOrderPositionsHtml($objApparelOrderItems);
    }
    $arrTokens['order_total'] = static::getOrderTotal($objApparelOrderItems);
    return $arrTokens;
  }
}

?>