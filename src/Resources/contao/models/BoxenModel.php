<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package News
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace VHUG\Contao\Boxes;

use Contao\Date;
use Contao\CoreBundle\File\ModelMetadataTrait;
/**
 * Reads and writes news
 *
 * @package   Models
 * @author    Leo Feyer <https://github.com/leofeyer>
 * @copyright Leo Feyer 2005-2014
 */
class BoxenModel extends \Model
{
    use ModelMetadataTrait;
    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_boxen';

	public static function findPublishedByModuleId($intMod, array $arrOptions=array())
	{
		$t = static::$strTable;
		$arrColumns = array("$t.modul_id=?");
		$arrValues = array($intMod);

		if (!static::isPreviewMode($arrOptions))
		{
			$time = Date::floorToMinute();
			$arrColumns[] = "$t.published='1' AND ($t.start='' OR $t.start<='$time') AND ($t.stop='' OR $t.stop>'$time')";
		}

		if (!isset($arrOptions['order']))
		{
			$arrOptions['order'] = "$t.sorting";
		}

		return static::findBy($arrColumns, $arrValues, $arrOptions);
	}

}
