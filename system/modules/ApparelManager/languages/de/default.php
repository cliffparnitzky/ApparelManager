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
 * Apparel article type
 */
$GLOBALS['TL_LANG']['ApparelManager']['type']['female'] = "Damen";
$GLOBALS['TL_LANG']['ApparelManager']['type']['male']   = "Herren";
$GLOBALS['TL_LANG']['ApparelManager']['type']['unisex'] = "Unisex";

/**
 * Apparel order status
 */
$GLOBALS['TL_LANG']['ApparelManager']['status'][\ApparelManagerHelper::ORDER_STATUS_PRE_ORDERED] = "Vorbestellt";
$GLOBALS['TL_LANG']['ApparelManager']['status'][\ApparelManagerHelper::ORDER_STATUS_ORDERED]     = "Bestellt";
$GLOBALS['TL_LANG']['ApparelManager']['status'][\ApparelManagerHelper::ORDER_STATUS_DELIVERED]   = "Geliefert";
$GLOBALS['TL_LANG']['ApparelManager']['status'][\ApparelManagerHelper::ORDER_STATUS_INVOICED]    = "Abgerechnet";

/**
 * Errors
 */
$GLOBALS['TL_LANG']['ERR']['apparel_order_invoiceError']                 = "Die Bestellung ID %s konnte nicht abgerechnet werden. Für weitere Informationen prüfen Sie das System-Log.";
$GLOBALS['TL_LANG']['ERR']['ApparelManager']['notAuthenticatedMyOrders'] = "Sie müssen angemeldet sein, um ihre Bestellungen zu sehen.";

/**
 * Misc
 */
$GLOBALS['TL_LANG']['MSC']['apparel_article_price']             = "%s,- EUR";
$GLOBALS['TL_LANG']['MSC']['apparel_article_unit']              = "%s Stück";
$GLOBALS['TL_LANG']['MSC']['apparel_article_unit_price']        = "%s,- EUR/Stück";
$GLOBALS['TL_LANG']['MSC']['apparel_article_title_simple']      = "%s - %s (%s)";
$GLOBALS['TL_LANG']['MSC']['apparel_article_title_with_number'] = "%s - %s (%s) | Art. Nr.: %s";
$GLOBALS['TL_LANG']['MSC']['apparel_order_invoiceConfirm']      = "Soll die Bestellung ID %s wirklich abgerechnet werden?";
$GLOBALS['TL_LANG']['MSC']['apparel_order_invoiceSuccess']      = "Die Bestellung ID %s wurde abgerechnet.";
$GLOBALS['TL_LANG']['MSC']['apparel_order_item_price_comment']  = "<br>(%s)";

$GLOBALS['TL_LANG']['MSC']['apparel_order_item_increasedStockSuccess'] = "Lagerbestand für %s - %s um %s erhöht.";
$GLOBALS['TL_LANG']['MSC']['apparel_order_item_decreasedStockSuccess'] = "Lagerbestand für %s - %s um %s vermindert.";

$GLOBALS['TL_LANG']['MSC']['ApparelManager']['noOrders'] = "Bisher sind keine Bestellungen vorhanden.";

$GLOBALS['TL_LANG']['MSC']['ApparelManager']['itemNo']                = 'Pos.';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['apparelArticleNumber']  = 'Art.&nbsp;Nr.';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['apparelArticle']        = 'Kleidungsstück';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['apparelArticleVariant'] = 'Variante';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['amount']                = 'Menge';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['singlePrice']           = 'Einzelpreis';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['totalPrice']            = 'Gesamtpreis';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['items']                 = 'Bestellpositionen';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['number']                = 'Bestellnummer';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['status']                = 'Status';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['orderDate']             = 'Bestelldatum';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['deliverDate']           = 'Lieferdatum';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['invoiceDate']           = 'Abrechnungsdatum';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['createdAt']             = 'Erstelldatum';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['createdBy']             = 'Ersteller';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['comment']               = 'Kommentar';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['creation']              = 'Erstellung';
$GLOBALS['TL_LANG']['MSC']['ApparelManager']['creation_format']       = 'am %s von %s erstellt';


/**
 * Frontend
 */
$GLOBALS['TL_LANG']['ApparelManager']['CTE']['details'] = 'Details';
$GLOBALS['TL_LANG']['ApparelManager']['CTE']['sizes']   = 'Größen';
$GLOBALS['TL_LANG']['ApparelManager']['CTE']['stock']   = 'Lagerbestand';
$GLOBALS['TL_LANG']['ApparelManager']['CTE']['images']  = 'Bilder';
$GLOBALS['TL_LANG']['ApparelManager']['CTE']['price']   = 'Preis';
$GLOBALS['TL_LANG']['ApparelManager']['CTE']['zoom']    = 'Vergrößern';

?>