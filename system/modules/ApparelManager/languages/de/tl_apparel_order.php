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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_apparel_order']['number']           = array('Bestellnummer', 'Geben Sie die Nummer der Bestellung an.');
$GLOBALS['TL_LANG']['tl_apparel_order']['member']           = array('Besteller', 'Wählen Sie den Besteller der Bestellung aus.');
$GLOBALS['TL_LANG']['tl_apparel_order']['status']           = array('Status', 'Wählen Sie den Status der Bestellung aus.');
$GLOBALS['TL_LANG']['tl_apparel_order']['orderDate']        = array('Bestelldatum', 'Geben Sie das Bestelldatum der Bestellung an.');
$GLOBALS['TL_LANG']['tl_apparel_order']['deliverDate']      = array('Lieferdatum', 'Geben Sie das Lieferdatum der Bestellung an.');
$GLOBALS['TL_LANG']['tl_apparel_order']['invoiceDate']      = array('Abrechnungsdatum', 'Geben Sie das Abrechnungsdatum der Bestellung an.');
$GLOBALS['TL_LANG']['tl_apparel_order']['createdAt']        = array('Erstelldatum', 'Geben Sie das Datum der Erstellung dieser Bestellung an.');
$GLOBALS['TL_LANG']['tl_apparel_order']['createdBy']        = array('Ersteller', 'Geben Sie den Ersteller dieser Bestellung an.');
$GLOBALS['TL_LANG']['tl_apparel_order']['alternativeEmail'] = array('Alternative E-Mail-Adresse', 'Geben Sie eine alternative E-Mail-Adresse an, die statt der E-Mail-Adresse des Bestellers genutzt werden soll.');
$GLOBALS['TL_LANG']['tl_apparel_order']['comment']          = array('Kommentar', 'Geben Sie einen Kommentar zur Bestellung an.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_apparel_order']['order_legend']            = 'Bestellung';
$GLOBALS['TL_LANG']['tl_apparel_order']['status_legend']           = 'Status';
$GLOBALS['TL_LANG']['tl_apparel_order']['creation_legend']         = 'Erstellung';
$GLOBALS['TL_LANG']['tl_apparel_order']['alternativeEmail_legend'] = 'Alternative E-Mail';
$GLOBALS['TL_LANG']['tl_apparel_order']['comment_legend']          = 'Kommentar';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_apparel_order']['new']                 = array('Neue Bestellung', 'Ein neue Bestellung anlegen');
$GLOBALS['TL_LANG']['tl_apparel_order']['show']                = array('Details zur Bestellung', 'Details zur Bestellung ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_apparel_order']['edit']                = array('Bestellung bearbeiten', 'Bestellung ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_apparel_order']['editheader']          = array('Bestellungdetails bearbeiten', 'Details der Bestellung ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_apparel_order']['delete']              = array('Bestellung löschen', 'Bestellung ID %s löschen');
$GLOBALS['TL_LANG']['tl_apparel_order']['createDeliverySheet'] = array('Lieferschein erstellen', 'Lieferschein für Bestellung ID %s erstellen');
$GLOBALS['TL_LANG']['tl_apparel_order']['invoiceOrder']        = array('Bestellung abrechnen', 'Bestellung ID %s abrechnen');

/**
 * Messages
 */
$GLOBALS['TL_LANG']['tl_apparel_order']['warn_no_items'] = "Keine Bestellpositionen vorhanden";

/**
 * Misc
 */
$GLOBALS['TL_LANG']['tl_apparel_order']['showArticle']           = 'Artikel anzeigen';
$GLOBALS['TL_LANG']['tl_apparel_order']['delivery_title']        = 'Bestellung %s';

?>