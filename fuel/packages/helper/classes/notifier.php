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

class Notifier
{
    /**
     * EMAIL
     */
    public static function notifyAdminPassword(&$user, &$password)
    {
        $email = \Email::forge();
        $email->to($user->email);
        $email->subject('管理者アカウントを発行しました。');
        $email->html_body(\View::forge('notifier/admin/password', ['user' => $user, 'password' => $password]));
        $email->send();
    }

    public static function notifyCompanyPassword(&$user, &$password)
    {
        $email = \Email::forge();
        $email->to($user->email, $user->company_name);
        $email->subject('enepi(エネピ)へのご登録、誠にありがとうございます／enepi運営事務局');
        $email->html_body(\View::forge('notifier/company/password', ['user' => $user, 'password' => $password]));
        $email->send();
    }

    public static function notifyAdminNewContact(&$contact)
    {
        $email = \Email::forge();
        $email->to(\Config::get('enepi.service.email'), \Config::get('enepi.service.name'));
        $email->subject("{$contact->name}様よりLPガスに関する問い合わせがありました");
        $email->html_body(\View::forge('notifier/admin/new_contact', ['contact' => $contact]));
        $email->send();
    }

    public static function notifyCustomerNewContact(&$contact)
    {
        $email = \Email::forge();
        $email->to($contact->email, $contact->name);
        $email->subject('お問い合わせ頂き、ありがとうございます／プロパンガス一括見積もりサービス enepi（エネピ）運営事務局');
        $email->html_body(\View::forge('notifier/customer/new_contact', ['contact' => $contact]));
        $email->send();
    }

    public static function notifyCompanyEstimateCancel(&$estimate)
    {
        $by_user = $estimate->status_reason == \Helper\CancelReasons::getValueByName('status_reason_request_by_user');
        $subject = $by_user ? "当方にてキャンセル手続きをさせていただきました" : "キャンセルのご要望を受け付けました";

        $email = \Email::forge();
        $email->to($estimate->company->partner_company->getEmails(), $estimate->company->getCompanyName());
        $email->subject($subject.'／enepi運営事務局');
        $email->html_body(\View::forge('notifier/company/estimate_cancel', ['estimate' => $estimate, 'by_user' => $by_user]));
        $email->send();
    }

    public static function notifyAdminEstimateCancel(&$estimate)
    {
        $reason_id = $estimate->status_reason;
        
        if ($reason_id == 0)
            $reason_id = $estimate->contact->status_reason;

        $reason = \Helper\CancelReasons::getNameByValue($reason_id);

        $email = \Email::forge();
        $email->to(\Config::get('enepi.service.email'), \Config::get('enepi.service.name'));
        $email->subject('キャンセル');
        $email->html_body(\View::forge('notifier/admin/estimate_cancel', ['estimate' => $estimate, 'reason' => $reason]));
        $email->send();
    }

    public static function notifyCustomerIntroduce(&$estimate)
    {
        $company_name = $estimate->company->getCompanyName();

        $email = \Email::forge();
        $email->to($estimate->contact->email, $estimate->contact->name);
        $email->subject($company_name.'とのご連絡の要望承りました／enepi運営事務局');
        $email->html_body(\View::forge('notifier/customer/introduce', ['estimate' => $estimate, 'company_name' => $company_name]));
        $email->send();
    }

    public static function notifyCompanyIntroduce(&$estimate)
    {
        $email = \Email::forge();
        $email->to($estimate->company->partner_company->getEmails(), $estimate->company->getCompanyName());
        $email->subject('連絡希望をいただきました／enepi運営事務局');
        $email->html_body(\View::forge('notifier/company/introduce', ['estimate' => $estimate]));
        $email->send();
    }

    public static function notifyAdminIntroduce(&$estimate)
    {
        $email = \Email::forge();
        $email->to(\Config::get('enepi.service.email'), \Config::get('enepi.service.name'));
        $email->subject('送客');
        $email->html_body(\View::forge('notifier/admin/introduce', ['estimate' => $estimate]));
        $email->send();
    }

    public static function notifyCustomerPresent(&$estimate)
    {
        $saving = $estimate->total_savings_in_year($estimate->contact);

        $email = \Email::forge();
        $email->to($estimate->contact->email, $estimate->contact->name);
        $email->subject('プロパンガスのお見積りについて／enepi運営事務局');
        $email->html_body(\View::forge('notifier/customer/present', ['estimate' => $estimate, 'saving' => $saving]));
        $email->send();
    }

    public static function notifyAdminPresentContact(&$estimate)
    {
        $email = \Email::forge();
        $email->to(\Config::get('enepi.service.email'), \Config::get('enepi.service.name'));
        $email->subject('見積もりを送信しました');
        $email->html_body(\View::forge('notifier/admin/present_contact', ['estimate' => $estimate]));
        $email->send();
    }

    public static function notifyAdminPresentEstimate(&$estimate)
    {
        $email = \Email::forge();
        $email->to(\Config::get('enepi.service.email'), \Config::get('enepi.service.name'));
        $email->subject('紹介');
        $email->html_body(\View::forge('notifier/admin/present_estimate', ['estimate' => $estimate]));
        $email->send();
    }

    public static function notifyAdminPrePresent(&$estimate)
    {
        $email = \Email::forge();
        $email->to(\Config::get('enepi.service.email'), \Config::get('enepi.service.name'));
        $email->subject('見積もりが提示されました');
        $email->html_body(\View::forge('notifier/admin/pre_present', ['estimate' => $estimate]));
        $email->send();
    }

    /**
     * SMS
     */
    public static function notifyCustomerPin(&$contact)
    {
        // FIX ME Use sms
        if($_SERVER['FUEL_ENV'] == \Fuel::DEVELOPMENT){
            $email = \Email::forge();
            $email->to(\Config::get('enepi.service.email'), \Config::get('enepi.service.name'));
            $email->subject('SMS');
            $email->html_body("認証コード: {$contact->pin}\nこのコードをenepi本人確認画面で入力してください。");
            $email->send();

        }else{
            Mail::sms_send($contact->tel, "認証コード: {$contact->pin}\nこのコードをenepi本人確認画面で入力してください。");
        }
    }
}
