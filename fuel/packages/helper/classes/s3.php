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

		$fmt = "%s/uploads/partner_companies/%s/lpgas/companies/%s/%s";

		return sprintf($fmt,
				getenv("FUEL_ENV"),   // develpoer/staging/production
				$e->company->partner_company_id,
				$e->company->id,
				$e->company->lpgas_company_logo);

	}

}
