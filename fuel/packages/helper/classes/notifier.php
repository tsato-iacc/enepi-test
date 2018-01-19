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
    public static function notifyAdminNewContact($contact)
    {
        $email = \Email::forge();
        $email->to(\Config::get('enepi.service.email'), \Config::get('enepi.service.name'));
        $email->subject("{$contact->name}様よりLPガスに関する問い合わせがありました");
        $email->html_body(\View::forge('notifier/admin/newContact', ['contact' => $contact]));
        $email->send();
    }

    public static function notifyCustomerNewContact($contact)
    {
        $email = \Email::forge();
        $email->to($contact->email, $contact->name);
        $email->subject('お問い合わせ頂き、ありがとうございます／プロパンガス一括見積もりサービス enepi（エネピ）運営事務局');
        $email->html_body(\View::forge('notifier/customer/newContact', ['contact' => $contact]));
        $email->send();
    }

    public static function notifyCompanyEstimateCancel($estimate)
    {
        $by_user = $estimate->status_reason == \Helper\CancelReasons::getValueByName('status_reason_request_by_user');
        $subject = $by_user ? "当方にてキャンセル手続きをさせていただきました" : "キャンセルのご要望を受け付けました";

        $email = \Email::forge();
        $email->to($estimate->company->partner_company->getEmails(), $estimate->company->getCompanyName());
        $email->subject($subject + '／enepi運営事務局');
        $email->html_body(\View::forge('notifier/company/estimateCancel', ['estimate' => $estimate, 'by_user' => $by_user]));
        $email->send();
    }

    public static function notifyAdminEstimateCancel($estimate)
    {
        $reason = \Helper\CancelReasons::getNameByValue($estimate->status_reason);

        $email = \Email::forge();
        $email->to(\Config::get('enepi.service.email'), \Config::get('enepi.service.name'));
        $email->subject('キャンセル');
        $email->html_body(\View::forge('notifier/admin/estimateCancel', ['estimate' => $estimate, 'reason' => $reason]));
        $email->send();
    }

    public static function notifyCustomerIntroduce($estimate)
    {
        $company_name = $estimate->company->getCompanyName();

        $email = \Email::forge();
        $email->to($estimate->contact->email, $estimate->contact->name);
        $email->subject($company_name.'とのご連絡の要望承りました／enepi運営事務局');
        $email->html_body(\View::forge('notifier/customer/introduce', ['estimate' => $estimate, 'company_name' => $company_name]));
        $email->send();
    }

    public static function notifyCompanyIntroduce($estimate)
    {
        $email = \Email::forge();
        $email->to($estimate->company->partner_company->getEmails(), $estimate->company->getCompanyName());
        $email->subject('連絡希望をいただきました／enepi運営事務局');
        $email->html_body(\View::forge('notifier/company/introduce', ['estimate' => $estimate]));
        $email->send();
    }

    public static function notifyAdminIntroduce($estimate)
    {
        $email = \Email::forge();
        $email->to(\Config::get('enepi.service.email'), \Config::get('enepi.service.name'));
        $email->subject('送客');
        $email->html_body(\View::forge('notifier/admin/introduce', ['estimate' => $estimate]));
        $email->send();
    }
}
