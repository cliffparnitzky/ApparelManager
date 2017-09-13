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
 * Table tl_apparel_article_variant
 */
$GLOBALS['TL_DCA']['tl_apparel_article_variant'] = array
(

  // Config
  'config' => array
  (
    'dataContainer'           => 'Table',
    'ptable'                  => 'tl_apparel_article',
    'enableVersioning'        => true,
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
      'headerFields'            => array('category', 'manufacturer', 'name', 'number', 'type', 'details', 'price', 'productLink', 'images', 'comment'),
      'header_callback'         => array('tl_apparel_article_variant', 'prepareHeader'),
      'child_record_callback'   => array('tl_apparel_article_variant', 'prepareChild'),
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
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_article_variant']['edit'],
        'href'                => 'table=tl_apparel_article_variant&amp;act=edit',
        'icon'                => 'edit.gif'
      ),
      'cut' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_article_variant']['cut'],
        'href'                => 'act=paste&amp;mode=cut',
        'icon'                => 'cut.gif'
      ),
      'copy' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_article_variant']['copy'],
        'href'                => 'act=copy',
        'icon'                => 'copy.gif'
      ),
      'delete' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_article_variant']['delete'],
        'href'                => 'act=delete',
        'icon'                => 'delete.gif',
        'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
      ),
      'toggle' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_article_variant']['toggle'],
        'icon'                => 'visible.gif',
        'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
        'button_callback'     => array('tl_apparel_article_variant', 'toggleIcon')
      ),
      'show' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_apparel_article_variant']['show'],
        'href'                => 'act=show',
        'icon'                => 'show.gif'
      )
    )
  ),

  // Palettes
  'palettes' => array
  (
    '__selector__' => array('type'),
    'default'      => '{name_legend},name;{stock_legend},stock;{comment_legend:hide},comment;{publish_legend},published'
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
      'foreignKey'              => 'tl_apparel_article.id',
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
    'name' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_article_variant']['name'],
      'exclude'                 => true,
      'sorting'                 => true,
      'search'                  => true,
      'inputType'               => 'text',
      'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
      'sql'                     => "varchar(255) NOT NULL default ''"
    ),
    'stock' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_article_variant']['stock'],
      'exclude'                 => true,
      'sorting'                 => true,
      'search'                  => true,
      'inputType'               => 'text',
      'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'rgxp'=>'digit', 'doNotCopy'=>true),
      'sql'                     => "varchar(255) NOT NULL default '0'"
    ),
    'comment' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_article_variant']['comment'],
      'search'                  => true,
      'exclude'                 => true,
      'inputType'               => 'textarea',
      'eval'                    => array('tl_class'=>'clr', 'style'=>'min-height:60px'),
      'sql'                     => "text NULL"
    ),
    'published' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_apparel_article_variant']['published'],
      'exclude'                 => true,
      'filter'                  => true,
      'inputType'               => 'checkbox',
      'eval'                    => array('tl_class'=>'w50', 'doNotCopy'=>true),
      'sql'                     => "char(1) NOT NULL default ''"
    )
  )
);

/**
 * Class tl_apparel_article_variant
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2016-2016
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_apparel_article_variant extends Backend
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
    $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_article']['category'][0]] = $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_article']['category'][0]];

    $typeKey = array_search($arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_article']['type'][0]], $GLOBALS['TL_LANG']['ApparelManager']['type']);
    $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_article']['type'][0]] = $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_article']['type'][0]] . ' <img src="system/modules/ApparelManager/assets/type_' . $typeKey . '.png" alt="' . $GLOBALS['TL_LANG']['ApparelManager']['type'][$typeKey] . '" />';

    $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_article']['price'][0]] = sprintf($GLOBALS['TL_LANG']['MSC']['apparel_article_price'], $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_article']['price'][0]]);

    $productLink = $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_article']['productLink'][0]];
    $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_article']['productLink'][0]] = (!empty($productLink) ? '<a href="' . $productLink . '" target="_blank">' .  trim(\StringUtil::substr($productLink, 70)) . '</a>' : '&nbsp;');

    // add images
    $imageWidth = 60;
    $imageHeight = 90;
    $images = "";
    if (!empty($arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_article']['images'][0]]))
    {
      $arrImages = explode(', ', $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_article']['images'][0]]);
      foreach ($arrImages as $image)
      {
        $imageSrc = \Image::get($image, $imageWidth, $imageHeight, 'proportional');
        $images .= '<img src="' . $imageSrc . '" width="' . $imageWidth . '" height="' . $imageHeight . '" /> ';
      }
    }
    $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_article']['images'][0]] = $images;

    $comment = $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_article']['comment'][0]];
    $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_article']['comment'][0]] = (!empty($comment) ? trim(\StringUtil::substr($comment, 70)) : '&nbsp;');
    
    // ensure correct order (due to order problemes, this hack is needed)
    $strKeyProduktLink = $GLOBALS['TL_LANG']['tl_apparel_article']['productLink'][0];
    $strKeyImages = $GLOBALS['TL_LANG']['tl_apparel_article']['images'][0];
    $strComment = $GLOBALS['TL_LANG']['tl_apparel_article']['comment'][0];
    $entryProduktLink = $arrHeaderFields[$strKeyProduktLink];
    $entryImages = $arrHeaderFields[$strKeyImages];
    $entryComment = $arrHeaderFields[$strComment];
    unset($arrHeaderFields[$strKeyProduktLink]);
    unset($arrHeaderFields[$strKeyImages]);
    unset($arrHeaderFields[$strComment]);
    $arrHeaderFields[$strKeyProduktLink] = $entryProduktLink;
    $arrHeaderFields[$strKeyImages] = $entryImages;
    $arrHeaderFields[$strComment] = $entryComment;

    // adding the total stock value
    $objApparelArticleVariants = \ApparelArticleVariantModel::findPublishedByPid($dc->id);
    $arrHeaderFields[$GLOBALS['TL_LANG']['tl_apparel_article']['totalStock']] = sprintf($GLOBALS['TL_LANG']['MSC']['apparel_article_unit'], \ApparelManagerHelper::getVariantsTotal($objApparelArticleVariants));

    return $arrHeaderFields;
  }

  /**
   * Prepare each child element
   * @param array
   * @return string
   */
  public function prepareChild($row)
  {
    // TODO calculate real stock

    return '
<div class="cte_type ' . ($row['published'] ? 'published' : 'unpublished') . '">' . $GLOBALS['TL_LANG']['tl_apparel_article_variant']['variant'] . '</div>
<div>
  <h2>' . $row['name'] . '</h2>
  <table class="tl_apparel_child">
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_article_variant']['stock'][0] . ':</span></td><td>' . sprintf($GLOBALS['TL_LANG']['MSC']['apparel_article_unit'], $row['stock']) . '</td></tr>
    <tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_apparel_article_variant']['comment'][0] . ':</span></td><td>' . (!empty($row['comment']) ? trim(\StringUtil::substr($row['comment'], 70)) : '&nbsp;') . '</td></tr>
  </table>
</div>' . "\n";
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
    if (!$this->User->hasAccess('tl_apparel_article_variant::published', 'alexf'))
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
   * Publish/unpublish an apparel variant
   * @param integer
   * @param boolean
   * @param \DataContainer
   */
  public function toggleVisibility($intId, $blnVisible, DataContainer $dc=null)
  {
    // Check permissions
    if (!$this->User->hasAccess('tl_apparel_article_variant::published', 'alexf'))
    {
      $this->log('Not enough permissions to activate/deactivate results competition ID "'.$intId.'"', __METHOD__, TL_ERROR);
      $this->redirect('contao/main.php?act=error');
    }

    $objVersions = new Versions('tl_apparel_article_variant', $intId);
    $objVersions->initialize();

    // Trigger the save_callback
    if (is_array($GLOBALS['TL_DCA']['tl_apparel_article_variant']['fields']['published']['save_callback']))
    {
      foreach ($GLOBALS['TL_DCA']['tl_apparel_article_variant']['fields']['published']['save_callback'] as $callback)
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
    $this->Database->prepare("UPDATE tl_apparel_article_variant SET tstamp=$time, published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
             ->execute($intId);

    $objVersions->create();
    $this->log('A new version of record "tl_apparel_article_variant.id='.$intId.'" has been created'.$this->getParentEntries('tl_apparel_article_variant', $intId), __METHOD__, TL_GENERAL);
  }


}

?>
