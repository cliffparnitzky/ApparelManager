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
$GLOBALS['TL_LANG']['tl_apparel_article']['category']        = array('Kategorie', 'Wählen Sie die Kategorie des Kleidungsstücks aus.');
$GLOBALS['TL_LANG']['tl_apparel_article']['manufacturer']    = array('Hersteller', 'Geben Sie den Hersteller des Kleidungsstücks an.');
$GLOBALS['TL_LANG']['tl_apparel_article']['name']            = array('Name', 'Geben Sie den Namen des Kleidungsstücks an.');
$GLOBALS['TL_LANG']['tl_apparel_article']['number']          = array('Artikelnummer', 'Geben Sie die Artikelnummer des Kleidungsstücks an.');
$GLOBALS['TL_LANG']['tl_apparel_article']['type']            = array('Art', 'Geben Sie die Art, für wen das Kleidungsstück bestimmt ist, an.');
$GLOBALS['TL_LANG']['tl_apparel_article']['details']         = array('Details', 'Geben Sie Details zum Kleidungsstücks an.');
$GLOBALS['TL_LANG']['tl_apparel_article']['price']           = array('Preis', 'Geben Sie den Preis des Kleidungsstücks an (ohne Nachkommastellen).');
$GLOBALS['TL_LANG']['tl_apparel_article']['productLink']     = array('Produktlink', 'Geben Sie einen Link zum Produkt ein.');
$GLOBALS['TL_LANG']['tl_apparel_article']['images']          = array('Bilder', 'Wählen Sie die Bilder zum Kleidungsstück aus. Die jeweilge Größe (B x H) muss 2 x 3 sein, also z.B. 400 x 600px, 700 x 1050px oder 1000 x 1500px.');
$GLOBALS['TL_LANG']['tl_apparel_article']['autoUpdateStock'] = array('Lagerbestand automatisch aktualisieren', 'Wählen Sie ob der Lagerbestand beim Bestellen automatisch aktualisiert werden soll.');
$GLOBALS['TL_LANG']['tl_apparel_article']['published']       = array('Veröffentlichen', 'Das Kleidungsstück veröffentlichen, um eine Ausgabe im Frontend zu ermöglichen.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_apparel_article']['category_legend'] = 'Kategorisierung';
$GLOBALS['TL_LANG']['tl_apparel_article']['apparel_legend']  = 'Kleidungsdaten';
$GLOBALS['TL_LANG']['tl_apparel_article']['media_legend']    = 'Medien';
$GLOBALS['TL_LANG']['tl_apparel_article']['stock_legend']    = 'Lagerhaltung';
$GLOBALS['TL_LANG']['tl_apparel_article']['publish_legend']  = 'Veröffentlichung';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_apparel_article']['new']           = array('Neues Kleidungsstück', 'Ein neues Kleidungsstück anlegen');
$GLOBALS['TL_LANG']['tl_apparel_article']['show']          = array('Details von Kleidungsstück', 'Details von Kleidungsstück ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_apparel_article']['edit']          = array('Kleidungsstück bearbeiten', 'Kleidungsstück ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_apparel_article']['editheader']    = array('Kleidungsstückdetails bearbeiten', 'Details von Kleidungsstück ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_apparel_article']['copy']          = array('Kleidungsstück duplizieren', 'Kleidungsstück ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_apparel_article']['delete']        = array('Kleidungsstück löschen', 'Kleidungsstück ID %s löschen');
$GLOBALS['TL_LANG']['tl_apparel_article']['toggle']        = array('Kleidungsstück veröffentlichen/unveröffentlichen', 'Kleidungsstück ID %s veröffentlichen/unveröffentlichen');
$GLOBALS['TL_LANG']['tl_apparel_article']['stockOverview'] = array('Bestandsübersicht', 'Übersicht über dem Lagerbestand');

/**
 * Messages
 */
$GLOBALS['TL_LANG']['tl_apparel_article']['warn_no_published_variants'] = "Keine öffentlichen Varianten vorhanden";
$GLOBALS['TL_LANG']['tl_apparel_article']['info_includes_all_orders']   = "Es sind alle Artikel aus allen Bestellungen im System bereits abgezogen.";

/**
 * Misc
 */
$GLOBALS['TL_LANG']['tl_apparel_article']['article']     = "Kleidungsstück";
$GLOBALS['TL_LANG']['tl_apparel_article']['stock']       = 'Lagerbestand';
$GLOBALS['TL_LANG']['tl_apparel_article']['singlePrice'] = 'Einzelpreis';
$GLOBALS['TL_LANG']['tl_apparel_article']['totalPrice']  = 'Gesamtpreis';
$GLOBALS['TL_LANG']['tl_apparel_article']['totalStock']  = 'Gesamt-Lagerbestand';

?>