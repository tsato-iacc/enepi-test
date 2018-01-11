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

/**
 * The Admin Tracking Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Admin
 */
class Controller_Admin_Tracking extends Controller_Admin
{
    /**
     * Show list of tracking
     *
     * @access  public
     * @return  Response
     */
    public function get_index()
    {
        $this->template->title = '経由元一覧';
        $this->template->content = View::forge('admin/tracking/index', [
            'val' => \Model_Tracking::validate(),
            'tracks' => \Model_Tracking::find('all'),
            'tracks_history' => \Model_Tracking_History::find('all', ['limit' => \Config::get('enepi.tracking.admin.history_limit')]),
        ]);
    }

    /**
     * Save new tracking
     *
     * @access  public
     * @return  Response
     */
    public function post_store()
    {
        $tracking = new \Model_Tracking();

        $val = \Model_Tracking::validate($tracking);

        if ($val->run())
        {
            $tracking->set($val->validated(null, 'tracking'));

            $tracking->checkSSLSupport();

            if ($tracking->save())
                Session::set_flash('success', 'trackingを追加しました');

            Response::redirect('admin/tracking');
        }

        Session::set_flash('error', 'trackingを追加できませんでした');

        $this->template->title = 'Edit tracking';
        $this->template->content = View::forge('admin/tracking/index', [
            'val' => $val,
            'tracks' => \Model_Tracking::find('all'),
            'tracks_history' => \Model_Tracking_History::find('all', ['limit' => \Config::get('enepi.tracking.admin.history_limit')]),
        ]);
    }

    /**
     * Edit tracking
     *
     * @access  public
     * @return  Response
     */
    public function get_edit($id)
    {
        if (!$tracking = \Model_Tracking::find($id))
            throw new HttpNotFoundException;

        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/tracking/edit', [
            'val' => \Model_Tracking::validate(),
            'tracking' => $tracking,
        ]);
    }

    /**
     * Edit tracking
     *
     * @access  public
     * @return  Response
     */
    public function post_update($id)
    {
        if (!$tracking = \Model_Tracking::find($id))
            throw new HttpNotFoundException;

        $val = \Model_Tracking::validate($tracking);

        if ($val->run())
        {
            $tracking->set($val->validated(null, 'tracking'));

            if ($tracking->save())
                Session::set_flash('success', 'trackingを更新しました');

            Response::redirect('admin/tracking');
        }

        Session::set_flash('error', 'trackingを更新できませんでした');

        $this->template->title = 'Edit tracking';
        $this->template->content = View::forge('admin/tracking/edit', [
            'val' => $val,
            'tracking' => $tracking,
        ]);
    }

    /**
     * Delete tracking
     *
     * @access  public
     * @return  Response
     */
    public function get_delete($id)
    {
        // FIX ME (USE SOFT DELETE OR FLAG)
        if ($tracking = \Model_Tracking::find($id))
        {
            // if ($tracking->delete())
                Session::set_flash('success', 'trackingを削除しました');
        }

        Response::redirect('admin/tracking');
    }

    /**
     * Show statistics
     *
     * @access  public
     * @return  Response
     */
    public function action_statistics()
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/tracking/statistics', [
            'test' => 'test'
        ]);
    }
}
