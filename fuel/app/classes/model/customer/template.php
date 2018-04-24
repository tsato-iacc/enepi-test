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
                    default:
                        # do nothing
                        break;
                }
            }

            $body = str_replace($input, $output, $body);
        }
    }
}
