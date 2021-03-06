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
 * @copyright  Cliff Parnitzky 2016-2016
 * @author     Cliff Parnitzky
 * @package    ApparelManager
 * @license    LGPL
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace CliffParnitzky\Contao\ApparelManager;

/**
 * Class ApparelArticleVariantModel
 *
 * @copyright  Cliff Parnitzky 2016-2016
 * @author     Cliff Parnitzky
 * @package    Models
 */
class ApparelArticleVariantModel extends \Model
{

  /**
   * Table name
   * @var string
   */
  protected static $strTable = 'tl_apparel_article_variant';
  
  /**
   * Find apparel article variants by their apparel article ID
   *
   * @param integer $intPid     The apparel article ID
   * @param array   $arrOptions An optional options array
   *
   * @return \Model\Collection|null A collection of models or null if there are no apparel article variants
   */
  public static function findByPid($intPid, array $arrOptions=array())
  {
    $t = static::$strTable;
    
    $arrColumns = array("$t.pid=?");
    $arrValues = array($intPid);
    
    if ($arrOptions['column'])
    {
      $arrColumns = array_merge($arrColumns, $arrOptions['column']);
      unset($arrOptions['column']);
    }
    if ($arrOptions['value'])
    {
      $arrValues = array_merge($arrValues, $arrOptions['value']);
      unset($arrOptions['value']);
    }

    return static::findBy($arrColumns, $arrValues, $arrOptions);
  }

  /**
   * Find published apparel article variants by their apparel article ID
   *
   * @param integer $intPid     The apparel article ID
   * @param array   $arrOptions An optional options array
   *
   * @return \Model\Collection|null A collection of models or null if there are no published apparel article variants
   */
  public static function findPublishedByPid($intPid, array $arrOptions=array())
  {
    $t = static::$strTable;
    $arrOptions['column'][] = "$t.published=1";

    return static::findByPid($intPid, $arrOptions);
  }

}