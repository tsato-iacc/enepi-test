<?php
/**
 * Helper classes
*
* @package    Helper
* @version    1.0
* @author     Zazimko Alexey
* @license    MIT License
*/

namespace Helper;

class S3
{
	public static function makeImageUrl($e)
	{

		$fmt = "staging/uploads/partner_companies/%s/lpgas/companies/%s/%s";

		return sprintf($fmt,
				$e->company->partner_company_id,
				$e->company->id,
				$e->company->lpgas_company_logo);

	}

}
