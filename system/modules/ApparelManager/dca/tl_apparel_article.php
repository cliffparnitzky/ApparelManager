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
 * Table tl_apparel_article
 */
$GLOBALS['TL_DCA']['tl_apparel_article'] = array
(

  // Config
  'config' => array
  (
    'dataContainer'           => 'Table',
    'ctable'                  => array('tl_apparel_article_variant'),
    'switchToEdit'            => true,
    'enableVersioning'        => true,
    'notSortable'             => true,
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
      'fields'                  => array('category', 'manufacturer', 'name'),
      'flag'                    => 11,
      'panelLayout'             => 'filter;sort,search,limit'
    ),
    'label' => array
    (
      'fields'                => array('manufacturer', 'name'),
      'format'                => '%s - %s',
      'label_callback'        => array('tl_apparel_article', 'prepareLabel')
    ),
    'global_operations' => array
    (
      'stockOverview' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_article']['stockOverview'],
        'href'                => 'key=stockOverview', 
        'class'               => 'header_icon header_stock_overview'
      ),
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
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_article']['edit'],
        'href'                => 'table=tl_apparel_article_variant',
        'icon'                => 'edit.gif'
      ),
      'editheader' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_article']['editheader'],
        'href'                => 'act=edit',
        'icon'                => 'header.gif'
      ),
      'copy' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_article']['copy'],
        'href'                => 'act=copy',
        'icon'                => 'copy.gif'
      ),
      'delete' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_article']['delete'],
        'href'                => 'act=delete',
        'icon'                => 'delete.gif',
        'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
      ),
      'toggle' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_article']['toggle'],
        'icon'                => 'visible.gif',
        'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
        'button_callback'     => array('tl_apparel_article', 'toggleIcon')
      ),
      'show' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_article']['show'],
        'href'                => 'act=show',
        'icon'                => 'show.gif'
      )
    )
  ),

  // Palettes
  'palettes' => array
  (
    '__selector__' => array(),
    'default'      => '{category_legend},category;{apparel_legend},manufacturer,name,number,type,details,price,productLink;{media_legend},images;{stock_legend},autoUpdateStock;{publish_legend},published'
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
    'category' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_article']['category'],
      'exclude'                 => true,
      'filter'                  => true,
      'inputType'               => 'select',
      'options_callback'        => array('tl_apparel_article', 'getCategories'),
      'eval'                    => array('mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
      'sql'                     => "varchar(32) NOT NULL default ''"
    ),
    'manufacturer' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_article']['manufacturer'],
      'exclude'                 => true,
      'filter'                  => true,
      'inputType'               => 'text',
      'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'clr w50'),
      'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    'name' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_article']['name'],
      'exclude'                 => true,
      'search'                  => true,
      'inputType'               => 'text',
      'eval'                    => array('mandatory'=>true, 'maxlength'=>512, 'tl_class'=>'w50'),
      'sql'                     => "varchar(512) NOT NULL default ''"
    ),
    'number' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_article']['number'],
      'exclude'                 => true,
      'search'                  => true,
      'inputType'               => 'text',
      'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'clr w50'),
      'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    'type' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_article']['type'],
      'exclude'                 => true,
      'filter'                  => true,
      'inputType'               => 'select',
      'options'                 => array('female', 'male', 'unisex'),
      'reference'               => &$GLOBALS['TL_LANG']['ApparelManager']['type'],
      'eval'                    => array('mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
      'sql'                     => "varchar(32) NOT NULL default ''"
    ),
    'details' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_article']['details'],
      'exclude'                 => true,
      'inputType'               => 'listWizard',
      'eval'                    => array('mandatory'=>true, 'allowHtml'=>true, 'tl_class'=>'clr'),
      'sql'                     => "blob NULL"
    ),
    'price' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_article']['price'],
      'exclude'                 => true,
      'search'                  => true,
      'inputType'               => 'text',
      'eval'                    => array('mandatory'=>true, 'maxlength'=>3, 'tl_class'=>'clr w50', 'rgxp'=>'digit'),
      'sql'                     => "varchar(3) NOT NULL default ''"
    ),
    'productLink' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_article']['productLink'],
      'exclude'                 => true,
      'search'                  => true,
      'inputType'               => 'text',
      'eval'                    => array('tl_class'=>'clr long', 'rgxp'=>'url', 'decodeEntities'=>true),
      'sql'                     => "varchar(1024) NOT NULL default ''"
    ),
    'images' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_article']['images'],
      'exclude'                 => true,
      'inputType'               => 'fileTree',
      'eval'                    => array('mandatory'=>true, 'multiple'=>true, 'fieldType'=>'checkbox', 'files'=>true, 'filesOnly'=>true, 'extensions'=>'jpg,png', 'tl_class'=>'clr m12', 'isGallery'=>true, 'orderField'=>'orderSRC'),
      'sql'                     => "blob NULL"
    ),
    'orderSRC' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_content']['orderSRC'],
      'sql'                     => "blob NULL"
    ),
    'autoUpdateStock' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_article']['autoUpdateStock'],
      'exclude'                 => true,
      'filter'                  => true,
      'inputType'               => 'checkbox',
      'eval'                    => array('tl_class'=>'w50', 'doNotCopy'=>true),
      'sql'                     => "char(1) NOT NULL default ''"
    ),
    'published' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_article']['published'],
      'exclude'                 => true,
      'filter'                  => true,
      'inputType'               => 'checkbox',
      'eval'                    => array('tl_class'=>'w50', 'doNotCopy'=>true),
      'sql'                     => "char(1) NOT NULL default ''"
    )
  )
);

/**
 * Class tl_apparel_article
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2015
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_apparel_article extends Backend
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
   * Add an image to each record
   * @param array
   * @param string
   * @param \DataContainer
   * @param array
   * @return string
   */
  public function prepareLabel($row, $label, DataContainer $dc, $args)
  {
    $objApparelArticle = \ApparelArticleModel::findByPk($row['id']);

    return '<div class="cte_type ' . ($row['published'] ? 'published' : 'unpublished') . '">' . $row['manufacturer'] . '</div>' . \ApparelManagerHelper::getArticleHtml($objApparelArticle, true) . "\n";
  }
  
  /**
   * Return the "toggle visibility" button
   * @param array
   * @param string
   * @param string
   * @param string
   * @param string
   * @param string
   * @return string
   */
  public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
  {
    if (strlen(Input::get('tid')))
    {
      $this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
      $this->redirect($this->getReferer());
    }

    // Check permissions AFTER checking the tid, so hacking attempts are logged
    if (!$this->User->hasAccess('tl_apparel_article::published', 'alexf'))
    {
      return '';
    }

    $href .= '&amp;tid='.$row['id'].'&amp;state='.$row['published'];

    if (!$row['published'])
    {
      $icon = 'invisible.gif';
    }

    return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
  }


  /**
   * Publish/unpublish an apparel
   * @param integer
   * @param boolean
   * @param \DataContainer
   */
  public function toggleVisibility($intId, $blnVisible, DataContainer $dc=null)
  {
    // Check permissions
    if (!$this->User->hasAccess('tl_apparel_article::published', 'alexf'))
    {
      $this->log('Not enough permissions to publish/unpublish apparel ID "'.$intId.'"', __METHOD__, TL_ERROR);
      $this->redirect('contao/main.php?act=error');
    }

    $objVersions = new Versions('tl_apparel_article', $intId);
    $objVersions->initialize();

    // Trigger the save_callback
    if (is_array($GLOBALS['TL_DCA']['tl_apparel_article']['fields']['published']['save_callback']))
    {
      foreach ($GLOBALS['TL_DCA']['tl_apparel_article']['fields']['published']['save_callback'] as $callback)
      {
        if (is_array($callback))
        {
          $this->import($callback[0]);
          $blnVisible = $this->{$callback[0]}->{$callback[1]}($blnVisible, ($dc ?: $this));
        }
        elseif (is_callable($callback))
        {
          $blnVisible = $callback($blnVisible, ($dc ?: $this));
        }
      }
    }

    $time = time();

    // Update the database
    $this->Database->prepare("UPDATE tl_apparel_article SET tstamp=$time, published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
             ->execute($intId);

    $objVersions->create();
    $this->log('A new version of record "tl_apparel_article.id='.$intId.'" has been created'.$this->getParentEntries('tl_apparel_article', $intId), __METHOD__, TL_GENERAL);
  }
  
  /**
   * Return the categories, defined in system settings
   * @param \DataContainer
   * @return array
   */
  public function getCategories(DataContainer $dc)
  {
    $arrOptions = array();

    $arrCategories = \ApparelManagerHelper::getCategories();
    if (!empty($arrCategories))
    {
      foreach($arrCategories as $key=>$value)
      {
        $arrOptions[$key] = $value;
      }
    }

    return $arrOptions;
  }
}

?>