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
 * The Admin Activity Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Admin
 */
class Controller_Admin_Activity extends Controller_Admin
{
    /**
     * Show list
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        if (!$last_request = \Model_AfterSendingActionLastRequest::find('last'))
        {
            $last_request = new \Model_AfterSendingActionLastRequest();
            $last_request->save();
        }

        $three_minute_ago = new \DateTime();
        $day_ago = new \DateTime();
        $two_days_ago = new \DateTime();
        $seven_days_ago = new \DateTime();
        $month_ago = new \DateTime();

        $three_minute_ago->modify('-3 minute');
        $day_ago->modify('-24 hour');
        $two_days_ago->modify('-2 day');
        $seven_days_ago->modify('-7 day');
        $month_ago->modify('-1 month');

        $last = \DateTime::createFromFormat('Y-m-d H:i:s', $last_request->updated_at);        

        if (true || $last <= $three_minute_ago)
        {
            $last_request->updated_at = \Date::forge()->format('mysql_date_time');
            $last_request->save();

            $unique_estimate = function (&$items)
            {
                $unique = [];

                foreach ($items as $key => $item)
                {
                    if (!in_array($item->estimate_id, $unique)) {
                        $unique[] = $item->estimate_id;
                    } else {
                        unset($items[$key]);
                    }
                }
            };

            $activity = [];

            // 紹介済みキャンセルが入ったもの
            $cancelled = \Model_Estimate_History::find('all', [
                'related' => [
                    'estimate' => [
                        'where' => [
                            ['status', \Config::get('models.estimate.status.cancelled')],
                            ['updated_at', '>=', $month_ago->format('Y-m-d H:i:s')],
                        ]
                    ]
                ],
                'where' => [
                    ['diff_json', 'LIKE', '%"verbal_ok"%'],
                    ['created_at', '<=', $day_ago->format('Y-m-d H:i:s')],
                ],
            ]);

            if ($cancelled)
            {
                $unique_estimate($cancelled);
                $this->updateActivity($activity, $cancelled, "紹介済みキャンセル");
            }

            // 「未読」のまま1日(24h)経過したもの
            $not_read = \Model_Estimate_History::find('all', [
                'related' => [
                    'estimate' => [
                        'where' => [
                            ['is_read', 0],
                            ['updated_at', '>=', $month_ago->format('Y-m-d H:i:s')],
                        ]
                    ]
                ],
                'where' => [
                    ['diff_json', 'LIKE', '%"verbal_ok"%'],
                    ['created_at', '<=', $day_ago->format('Y-m-d H:i:s')],
                ],
            ]);

            if ($not_read)
            {
                $unique_estimate($not_read);
                $this->updateActivity($activity, $not_read, "「未読」のまま1日(24h)経過");
            }

            // 「未連絡」のまま2日経過したもの
            $not_contacted = \Model_Estimate_History::find('all', [
                'related' => [
                    'estimate' => [
                        'where' => [
                            ['contacted', 0],
                            ['updated_at', '>=', $month_ago->format('Y-m-d H:i:s')],
                        ]
                    ]
                ],
                'where' => [
                    ['diff_json', 'LIKE', '%"verbal_ok"%'],
                    ['created_at', '<=', $two_days_ago->format('Y-m-d H:i:s')],
                ],
            ]);

            if ($not_contacted)
            {
                $unique_estimate($not_contacted);
                $this->updateActivity($activity, $not_contacted, "「未連絡」のまま2日経過");
            }

            // 「連絡済」で7日経過して「訪問予定日」が記入されておらず「キャンセル」にもなっていないもの
            $contacted = \Model_Estimate_History::find('all', [
                'related' => [
                    'estimate' => [
                        'where' => [
                            ['contacted', 1],
                            ['visit_scheduled_date', null],
                            ['updated_at', '>=', $month_ago->format('Y-m-d H:i:s')],
                        ]
                    ]
                ],
                'where' => [
                    ['diff_json', 'LIKE', '%"verbal_ok"%'],
                    ['created_at', '<=', $seven_days_ago->format('Y-m-d H:i:s')],
                ],
            ]);

            if ($contacted)
            {
                $unique_estimate($contacted);
                $this->updateActivity($activity, $contacted, "「連絡済」で7日経過して「訪問予定日」が記入されておらず「キャンセル」にもなっていない");
            }
            
            if ($activity)
            {
                \DB::start_transaction();
                try
                {
                    foreach ($activity as $record)
                    {
                        $same_records = \DB::select_array(['*'])
                            ->where('estimate_id', '=', $record->estimate_id)
                            ->or_where('estimate_change_log_id', '=', $record->estimate_change_log_id)
                            ->from('lpgas_after_sending_actions')
                            ->execute();

                        if ($same_records->count() > 0)
                            continue;
                        
                        $record->save();
                    }

                    \DB::commit_transaction();
                }
                catch (\Exception $e)
                {
                    throw $e;
                    
                    \Log::error($e);
                    \DB::rollback_transaction();
                }                
            }
        }

        $conditions = [
            'related' => [
                'estimate' => [
                    'related' => [
                        'company' => [
                            'related' => [
                                'partner_company',
                            ]
                        ],
                        'contact',
                    ]
                ],
                'history',
            ]
        ];

        $pager = \Pagination::forge('activity', [
            'name' => 'bootstrap4',
            'total_items' => \Model_AfterSendingAction::count($conditions),
            'per_page' => 50,
            'uri_segment' => 'page',
            'num_links' => 20,
        ]);

        $conditions['order_by'] = ['at' => 'desc'];
        $conditions['limit'] = $pager->per_page;
        $conditions['offset'] = $pager->offset;

        $activity = \Model_AfterSendingAction::find('all', $conditions);

        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/activity/index', [
            'activity' => $activity,
        ]);
    }

    private function updateActivity(&$activity, &$items, $msg)
    {
        foreach ($items as $key => $item)
        {
            $activity[] = new \Model_AfterSendingAction([
                'estimate_id' => $item->estimate->id,
                'estimate_change_log_id' => $item->id,
                'at' => $item->created_at,
                'note' => $msg,
            ]);
        }
    }
}
