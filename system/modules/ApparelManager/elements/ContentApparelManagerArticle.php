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
 * Class ModuleTriathlonResultsManagerResults
 *
 * Content element "apparelManagerArticle".
 * @copyright  Cliff Parnitzky 2017-2017
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class ContentApparelManagerArticle extends \ContentElement
{
  /**
   * Template
   * @var string
   */
  protected $strTemplate = 'ce_apparelManagerArticle';

  /**
   * Generate content element
   * @return string
   */
  public function generate()
  {
    if (TL_MODE == 'BE')
    {
      $objApparelArticle = \ApparelArticleModel::findByPk($this->apparelManagerArticle);
      return \ApparelManagerHelper::getArticleHtml($objApparelArticle);
    }

    return parent::generate();
  }

  /**
   * Compile content element
   */
  protected function compile()
  {
    $objApparelArticle = \ApparelArticleModel::findByPk($this->apparelManagerArticle);
    
    $this->Template->article = $objApparelArticle;
    $this->Template->type    = $GLOBALS['TL_LANG']['ApparelManager']['type'][$objApparelArticle->type];
    $this->Template->details = deserialize($objApparelArticle->details, true);
    
    $arrVariants = array();
    $arrVariantNames = array();
    $objApparelArticleVariants = \ApparelArticleVariantModel::findPublishedByPid($this->apparelManagerArticle, array('order' => "sorting"));
    if (!empty($objApparelArticleVariants))
    {
      foreach($objApparelArticleVariants as $objApparelArticleVariant)
      {
        if ($this->apparelManagerShowOnlyAvailableVariants && $objApparelArticleVariant->stock > 0 || !$this->apparelManagerShowOnlyAvailableVariants)
        {
          $arrVariants[] = $objApparelArticleVariant;
          $arrVariantNames[] = $objApparelArticleVariant->name;
        }
      }
    }
    $this->Template->variants = $arrVariants;
    $this->Template->variantNames = $arrVariantNames;
    
    $this->Template->showStock = $this->apparelManagerShowStock;
    
    $arrImages = array();
    $arrImageUUIDs = deserialize($objApparelArticle->images, true);
    foreach($arrImageUUIDs as $uuid)
    {
      $arrImages[] = \FilesModel::findByUUID($uuid);
    }
    $this->Template->images = $arrImages;
  }
}

?>