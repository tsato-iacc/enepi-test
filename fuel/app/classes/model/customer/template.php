<?php

/**
 * class Model_Customer_Template
 */
class Model_Customer_Template extends \Orm\Model
{
    protected static $_table_name = 'customer_mail_templates';

    protected static $_properties = [
        'id',
        'name',
        'subject',
        'body',
    ];

    protected static $_observers = [
        'Orm\\Observer_Typing'
    ];

    public $_best_price = null;
    public $_best_company_name = null;

    /**
     * [validate description]
     * @param  string $factory Validation rules factory
     * @return mixed           Return Fuel\Core\Validation object
     */
    public static function validate($tracking = null)
    {
        $val = Validation::forge();

        $val->add_field('name', 'name', 'required|max_length[255]');
        $val->add_field('subject', 'subject', 'required|max_length[255]');
        $val->add_field('body', 'body', 'required|max_length[50000]');
        
        return $val;
    }

    public static function getSelectOptions()
    {
        return \Arr::pluck(\Model_Customer_Template::find('all'), 'name', 'id');        
    }

    public static function generateTemplate(&$body, &$contact)
    {
        $template = new Model_Customer_Template();
        $variables = [];
        $input = [];
        $output = [];

        if (preg_match_all('/\[:(.*?)\]/', $body, $variables))
        {
            foreach ($variables[1] as $variable)
            {
                switch ($variable)
                {
                    case 'contact_name':
                        $input[] = '[:contact_name]';
                        $output[] = $contact->name;
                        break;
                    case 'contact_email':
                        $input[] = '[:contact_email]';
                        $output[] = $contact->email;
                        break;
                    case 'matching':
                        $url = \Uri::create('lpgas/contacts/:id?'.http_build_query(['pin' => $contact->pin, 'token' => $contact->token]), ['id' => $contact->id]);
                        $input[] = '[:matching]';
                        $output[] = '<a target="_blank" href="'.$url.'">'.$url.'</a>';
                        break;
                    case 'best_company_name':
                        $template->getBestOffer($contact);
                        $input[] = '[:best_company_name]';
                        $output[] = $template->_best_company_name;
                        break;
                    case 'best_price':
                        $template->getBestOffer($contact);
                        $input[] = '[:best_price]';
                        $output[] = $template->_best_price;
                        break;
                    default:
                        # do nothing
                        break;
                }
            }

            $body = str_replace($input, $output, $body);
        }
    }

    public function getBestOffer(&$contact)
    {
        if ($this->_best_price && $this->_best_company_name)
            return;
        
        $max_saving = 0;
        $company_name = '非公開';

        $estimates = \Model_Estimate::find('all', [
            'where' => [
                ['contact_id', $contact->id],
                ['basic_price', '>=', 0],
                ['status', 'in', [2, 3]],
            ]
        ]);

        foreach ($estimates as $estimate)
        {
            $saving = $estimate->total_savings_in_year($contact);

            if ($saving > $max_saving)
            {
                $max_saving = $saving;
                $company_name = $estimate->company->getCompanyName();
            }
        }

        if ($max_saving)
        {
            $this->_best_price = number_format($max_saving);
            $this->_best_company_name = $company_name;
        }
        else
        {
            $this->_best_price = '非公開';
            $this->_best_company_name = '非公開';
        }
    }
}
