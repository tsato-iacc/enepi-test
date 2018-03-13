<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Fuel\Tasks;

use Dompdf\Dompdf;
use Dompdf\CanvasFactory;
use Dompdf\Exception;
use Dompdf\FontMetrics;
use Dompdf\Options;
use FontLib\Font;

class LoadFont
{
	public static function run()
	{
		$dompdf = new DOMPDF();
		$fontname = "jgothic";
		$normal = "public/assets/fonts/fonts-japanese-gothic.ttf";
		$bold = null;
		$italic = null;
		$bold_italic = null;
	  
	  $fontMetrics = $dompdf->getFontMetrics();
	  
	  // Check if the base filename is readable
	  if ( !is_readable($normal) )
	    throw new Exception("Unable to read '$normal'.");
	  
	  $dir = dirname($normal);
	  $basename = basename($normal);
	  $last_dot = strrpos($basename, '.');
	  
	  if ($last_dot !== false) {
	    $file = substr($basename, 0, $last_dot);
	    $ext = strtolower(substr($basename, $last_dot));
	  } else {
	    $file = $basename;
	    $ext = '';
	  }
	  
	  if ( !in_array($ext, array(".ttf", ".otf")) ) {
	    throw new Exception("Unable to process fonts of type '$ext'.");
	  }

	  // Try $file_Bold.$ext etc.
	  $path = "$dir/$file";
	  
	  $patterns = array(
	    "bold"        => array("_Bold", "b", "B", "bd", "BD"),
	    "italic"      => array("_Italic", "i", "I"),
	    "bold_italic" => array("_Bold_Italic", "bi", "BI", "ib", "IB"),
	  );
	  
	  foreach ($patterns as $type => $_patterns) {
	    if ( !isset($$type) || !is_readable($$type) ) {
	      foreach($_patterns as $_pattern) {
	        if ( is_readable("$path$_pattern$ext") ) {
	          $$type = "$path$_pattern$ext";
	          break;
	        }
	      }
	      
	      if ( is_null($$type) )
	        echo ("Unable to find $type face file.\n");
	    }
	  }

	  $fonts = compact("normal", "bold", "italic", "bold_italic");
	  $entry = array();
	  
	  // Copy the files to the font directory.
	  foreach ($fonts as $var => $src) {
	    if ( is_null($src) ) {
	      $entry[$var] = $dompdf->getOptions()->get('fontDir') . '/' . mb_substr(basename($normal), 0, -4);
	      continue;
	    }

	    // Verify that the fonts exist and are readable
	    if ( !is_readable($src) )
	      throw new Exception("Requested font '$src' is not readable");
	    
	    $dest = $dompdf->getOptions()->get('fontDir') . '/' . basename($src);
	    if ( !is_writeable(dirname($dest)) )
	      throw new Exception("Unable to write to destination '$dest'.");
	    
	    echo "Copying $src to $dest...\n";
	    
	    if ( !copy($src, $dest) )
	      throw new Exception("Unable to copy '$src' to '$dest'");
	    
	    $entry_name = mb_substr($dest, 0, -4);
	    
	    echo "Generating Adobe Font Metrics for $entry_name...\n";
	    
	    $font_obj = Font::load($dest);
	    $font_obj->saveAdobeFontMetrics("$entry_name.ufm");
	    $font_obj->close();
	    $entry[$var] = $entry_name;
	  }

	  // Store the fonts in the lookup table
	  $fontMetrics->setFontFamily($fontname, $entry);
	  
	  // Save the changes
	  $fontMetrics->saveFontFamilies();
	}
}

/* End of file tasks/loadfont.php */
