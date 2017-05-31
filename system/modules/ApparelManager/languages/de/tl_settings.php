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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_settings']['apparelManagerCategories']            = array('Kategorien', 'Geben Sie die verfügbaren Kategorien an.');
$GLOBALS['TL_LANG']['tl_settings']['apparelManagerDeliverySheetTemplate'] = array('Lieferschein Template', 'Wählen Sie das Template (<i>apparel_mgr_ ... .html5</i>) für den Lieferschein aus.');
$GLOBALS['TL_LANG']['tl_settings']['apparelManagerInvoiceNotification']   = array('Benachrichtigung für Abrechnung', 'Wählen Sie die Benachrichtigung für die E-Mail mit der Abrechnung aus.');
$GLOBALS['TL_LANG']['tl_settings']['apparelManagerOrderNumberPattern']    = array('Format der Bestellnummer', 'Geben Sie das Format der Bestellnummer wie folgt an:<br/><b>Präfix</b> | <b>Trennzeichen</b> | <b>Suffix</b><br/><br/>Nutzen Sie Inserttags wie <i>{{date::Y}}</i> für das aktuelle Jahr, für eine fortlaufende Zahl <i>[C,2]</i> (die Ziffer gibt die Länge zwischen 1 und 9 an) und [NBSP] für führende/nachlaufende Leerzeichen (Großschreibung ist wichtig).<br/><br/>Der Platzhalter für die fortlaufende Zahl kann nur in einem der Felder verwendet werden und es dürfen keine weitereren Zeichen in dem Textfeld angegeben sein.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_settings']['apparelManager_legend'] = 'Bekleidung Manager';

?>