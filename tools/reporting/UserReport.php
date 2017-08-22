<?php
include_once "bootstraps.php";
include_once "libs/logger.php";
error_reporting(0);


class UserReport {
    protected $user_id;
    protected $log;
    protected $conn;
    protected $date;
    protected $date_ts;
    private $verbose = false;

    public function UserReport($user_id, $conn, $log) {
        $this->user_id = $user_id;
        $this->conn = $conn;
        $this->log = $log;
        //print $this->user_id . "::" . intval($this->user_id) . "\n";
    }
    
    public function setVerbose($verbose = false) {
        $this->verbose = $verbose;
    }

    public function process($date, $date_ts) {
        if (intval($this->user_id) > 0) {
            $this->date = $date;
            $this->date_ts = $date_ts;

            $last_user_id = $ret[0];
            
            $login_count = $this->getUserLoginCount();
            
            if ($login_count > 0) {
                $login_time_array = $this->getUserLoginTime();
                $result = $this->calculateLoginTime($login_time_array, $login_count);
                $total_login_time = $result[0];
                $avg_time_per_login = $result[1];
                $page_view_count = $this->getUserPageviewCount();
                $page_view_per_login = $page_view_count * 1.0 / $login_count;
                $redeem_count = $this->getUserRedeemCount();
                $activity_arr = $this->getUserActivityHistory();
                $user_point = $this->getUserPoint();
                $exp_point = $this->getUserExpPoint();
                $buying_part_point = $this->getUserBuyingPartPoint();
                $redeem_merchandise_point = $this->getUserRedeemMerchandisePoint();
                //var_dump($activity_arr);
                if ($this->verbose) {
                    print $this->user_id . "::" . $login_count . "->" . $total_login_time . "->" . $avg_time_per_login . "->" . $redeem_count . "->" . $user_point . "\n\n";
                }
                $this->insertUserDailyReport($page_view_per_login, $avg_time_per_login, $redeem_count,
                $page_view_count, $total_login_time, $login_count, $exp_point, $buying_part_point, $redeem_merchandise_point);
                $this->insertUserPointTotal();
                $this->insertUserLoginHistory();
                $this->insertUserRaceData();
            } else {
                $this->log->info("User ID = " . $this->user_id . " did not login");
            }
        } else {
            $this->log->info('User ID = 0');
        }
    }

    public function getUserRedeemMerchandisePoint($use_timestamp = false) {
        $login_count = 0;
        if ($use_timestamp) {
            $query = "SELECT COUNT(id) num FROM redrush.rr_purchase_merchandise
    			      WHERE purchase_date_ts >= " . $this->date_ts . " AND purchase_date_ts < " . ($this->date_ts+86400) . " 
    			      AND user_id IN (" . $this->user_id . ") GROUP BY user_id";
        } else {
            $query = "SELECT COUNT(id) num FROM redrush.rr_purchase_merchandise
			          WHERE DATE(purchase_date) = '" . $this->date . "' 
			          AND user_id = '" . $this->user_id . "' LIMIT 1";
        }
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        if ($row = mysql_fetch_assoc($rs)) {
            #print $row['user_id'] . "->" . $row['num'] . "\n";
            $login_count = $row['num'];
        }
        mysql_free_result($rs);
        return $login_count;
    }

    public function getUserBuyingPartPoint($use_timestamp = true) {
        $login_count = 0;
        if ($use_timestamp) {
            $query = "SELECT COUNT(id) num FROM redrush.tbl_purchase_part
    			      WHERE date_time_ts >= " . $this->date_ts . " AND date_time_ts < " . ($this->date_ts+86400) . " 
    			      AND user_id IN (" . $this->user_id . ") GROUP BY user_id";
        } else {
            $query = "SELECT COUNT(id) num FROM redrush.tbl_purchase_part
			          WHERE DATE(date_time) = '" . $this->date . "' 
			          AND user_id = '" . $this->user_id . "' LIMIT 1";
        }
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        if ($row = mysql_fetch_assoc($rs)) {
            #print $row['user_id'] . "->" . $row['num'] . "\n";
            $login_count = $row['num'];
        }
        mysql_free_result($rs);
        return $login_count;
    }

    public function getUserLoginCount($use_timestamp = true) {
        $login_count = 0;
        if ($use_timestamp) {
            $query = "SELECT COUNT(id) num FROM redrush.tbl_activity_log
    			      WHERE date_ts >= " . $this->date_ts . " AND date_ts < " . ($this->date_ts+86400) . " 
    			      AND user_id IN (" . $this->user_id . ") AND action_id = 1 
    			      GROUP BY user_id";
        } else {
            $query = "SELECT COUNT(id) num FROM redrush.tbl_activity_log
			          WHERE DATE(date_time) = '" . $this->date . "' 
			          AND user_id = '" . $this->user_id . "' AND action_id = 1 LIMIT 1";
        }
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        if ($row = mysql_fetch_assoc($rs)) {
            #print $row['user_id'] . "->" . $row['num'] . "\n";
            $login_count = $row['num'];
        }
        mysql_free_result($rs);
        return $login_count;
    }

    public function getUserPageviewCount($use_timestamp = true) {
        $login_count = 0;
        if ($use_timestamp) {
            $query = "SELECT COUNT(id) num FROM redrush.tbl_activity_log
    			      WHERE date_ts >= " . $this->date_ts . " AND date_ts < " . ($this->date_ts+86400) . " 
    			      AND user_id IN (" . $this->user_id . ") AND action_id IN (2,7) GROUP BY user_id";
        } else {
            $query = "SELECT COUNT(id) num FROM redrush.tbl_activity_log
			          WHERE DATE(date_time) = '" . $this->date . "' 
			          AND user_id IN (" . $this->user_id . ") AND action_id IN (2,7) LIMIT 1";
        }
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        if ($row = mysql_fetch_assoc($rs)) {
            #print $row['user_id'] . "->" . $row['num'] . "\n";
            $login_count = $row['num'];
        }
        mysql_free_result($rs);
        return $login_count;
    }

    function getUserLoginTime($use_timestamp = true) {
        $login_count = 0;
        if ($use_timestamp) {
            $query = "SELECT id, ping_time_ts FROM redrush.tbl_activity_time
    			  WHERE ping_time_ts >= " . $this->date_ts . " AND ping_time_ts < " . ($this->date_ts+86400) . "
    			  AND user_id IN (" . $this->user_id . ")";
        } else {
            $query = "SELECT id, ping_time_ts FROM redrush.tbl_activity_time
    			  WHERE DATE(ping_time) = '" . $this->date_ts . "'
    			  AND user_id IN (" . $this->user_id . ")";
        }
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        $idx = -1;
        $login_time = 0;
        $last_login_time = 0;
        $time_array = array();
        while ($row = mysql_fetch_assoc($rs)) {
            #print $row['id'] . "->" . $row['ping_time_ts'] . "\n";
            if ($row['ping_time_ts'] > $last_login_time+60) {
                #print $row['id'] . "->" . $row['ping_time_ts'] . "\n";
                if ($idx > -1) {
                    $time_array[$idx] = $login_time;
                }
                $idx++;
                $login_time = 0;
            } else {
                $login_time = $login_time + $row['ping_time_ts'] - $last_login_time;
            }
            $last_login_time = $row['ping_time_ts'];
        }
        if ($idx > -1) {
            #print "->" . $last_login_time . "\n";
            $time_array[$idx] = $login_time;
        }
        #print $user_ids . "->";print_r($time_array);
        mysql_free_result($rs);
        return $time_array;
    }

    function getUserActivityHistory($num = 10, $use_timestamp = true) {
        $login_count = 0;
        if ($use_timestamp) {
            $query = "SELECT id, action_id, action_value FROM redrush.tbl_activity_log
			  WHERE date_ts >= " . $this->date_ts . " AND date_ts < " . ($this->date_ts+86400) . " 
			  AND user_id IN (" . $this->user_id . ") ORDER BY id DESC LIMIT " . $num;
        } else {
            $query = "SELECT id, action_id, action_value FROM redrush.tbl_activity_log
			  WHERE DATE(date_time) = '" . $this->date . "' 
			  AND user_id IN (" . $this->user_id . ") ORDER BY id DESC LIMIT " . $num;
        }
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        $activities_array = array();
        $idx = 0;
        while ($row = mysql_fetch_assoc($rs)) {
            $activities_array[$idx] = $row;
            $idx++;
        }
        mysql_free_result($rs);
        return $activities_array;
    }

    private function calculateLoginTime($login_time_array, $login_count) {
        $avg = 0;
        $total_time = 0;
        $login_time_array_len = sizeof($login_time_array);
        if ($login_time_array_len > 0) {
            //print_r($login_time_array);
            foreach ($login_time_array as $login_time) {
                $total_time += $login_time;
            }
            $avg = $total_time * 1.0 / $login_count;
        }
        return array($total_time,$avg);
    }

    function getUserRedeemCount($use_timestamp = true) {
        $redeem_count = 0;
        if ($use_timestamp) {
            $query = "SELECT user_id, COUNT(id) num FROM redrush.tbl_activity_log
			  WHERE date_ts >= " . $this->date_ts . " AND date_ts < " . ($this->date_ts+86400) . " 
			  AND user_id IN (" . $this->user_id . ") AND action_id = 6 
			  GROUP BY user_id";
        } else {
            $query = "SELECT user_id, COUNT(id) num FROM redrush.tbl_activity_log
			  WHERE DATE(date_time) = '" . $this->date . "' 
			  AND user_id IN (" . $this->user_id . ") AND action_id = 6 
			  GROUP BY user_id";
        }
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        if ($row = mysql_fetch_assoc($rs)) {
            #print $row['user_id'] . "->" . $row['num'] . "\n";
            $redeem_count = $row['num'];
        }
        mysql_free_result($rs);
        return $redeem_count;
    }

    function getUserPoint($use_timestamp = false) {
        $user_point = 0;
        if ($use_timestamp) {
            $query = "SELECT SUM(POINT) points FROM redrush.tbl_user_points
				WHERE user_id IN (" . $this->user_id . ")
				AND submit_date_ts >= " . $this->date_ts . " AND submit_date_ts < " . ($this->date_ts+86400);
        } else {
            $query = "SELECT SUM(POINT) points FROM redrush.tbl_user_points
				WHERE user_id IN (" . $this->user_id . ") AND DATE(submit_date) = '" . $this->date . "'";
        }
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        if ($row = mysql_fetch_assoc($rs)) {
            #print $row['user_id'] . "->" . $row['num'] . "\n";
            $user_point = intval($row['points']);
        }
        mysql_free_result($rs);
        return $user_point;
    }

    function getUserExpPoint($use_timestamp = false) {
        $user_point = 0;
        if ($use_timestamp) {
            $query = "SELECT SUM(score) points FROM redrush.tbl_exp_point
				WHERE user_id IN (" . $this->user_id . ")
				AND date_time_ts >= " . $this->date_ts . " AND date_time_ts < " . ($this->date_ts+86400);
        } else {
            $query = "SELECT SUM(score) points FROM redrush.tbl_exp_point
				WHERE user_id IN (" . $this->user_id . ") AND DATE(date_time) = '" . $this->date . "'";
        }
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        if ($row = mysql_fetch_assoc($rs)) {
            #print $row['user_id'] . "->" . $row['num'] . "\n";
            $user_point = intval($row['points']);
        }
        mysql_free_result($rs);
        return $user_point;
    }

    function insertUserDailyReport($page_view_per_login, $time_per_login, $redeem_count,
    $page_view_count, $login_time, $login_count, $exp_point, $buying_part_point, $redeem_merchandise_point) {
        $query = "REPLACE INTO redrush_report.rp_user_daily
				(date_d, user_id, page_view_per_login, 
				 time_per_login, redeem_count, page_view_count, 
				 login_time, login_count, exp_point, 
				 buying_part_point, redeem_merchandise_point)VALUES 
				('" . $this->date . "','" . $this->user_id . "','" . $page_view_per_login . "',
				 '" . $time_per_login . "','" . $redeem_count . "','" . $page_view_count . "',
				 '" . $login_time . "','" . $login_count . "','" . $exp_point . "',
				 '" . $buying_part_point . "','" . $redeem_merchandise_point . "')";
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        $this->log->status('insert to redrush_report.rp_user_daily',$rs);
        return $rs;
    }

    function insertUserPointTotal() {
        $query = "REPLACE INTO redrush_report.rp_user_point_total
				  SELECT user_id, SUM(exp_point), NOW()
				  FROM redrush_report.rp_user_daily
				  WHERE user_id IN ('" . $this->user_id . "')";
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        $this->log->status('insert to redrush_report.rp_user_point_total',$rs);
        return $rs;
    }
    
    function insertUserLoginHistory() {
        $query = "SELECT date_time, date_ts FROM redrush.tbl_activity_log
				  WHERE user_id = " . $this->user_id . " AND action_id = 1 ORDER BY id LIMIT 1";
        if ($this->verbose) {print $query . "\n";}
        $ts = 0;
        $time = "0000-00-00 00:00:00";
        $rs = mysql_query($query, $this->conn);
        if ($row = mysql_fetch_assoc($rs)) {
            $ts = intval($row['date_ts']);
            if ($ts > 0) {
                $time = $row['date_time'];
            }
        }
        if ($this->verbose) {print $query . "\n";}
        mysql_free_result($rs);
        if ($ts > 0) {
            $query = "REPLACE INTO redrush_report.rp_user_login_history
					  (user_id, first_login_time, login_count, login_time, last_update)
					  SELECT user_id, '" . $time . "', SUM(login_count), SUM(login_time), NOW()
					  FROM redrush_report.rp_user_daily
					  WHERE user_id IN ('" . $this->user_id . "')
					  GROUP BY user_id";
            if ($this->verbose) {print $query . "\n";}
            $rs = mysql_query($query, $this->conn);
            $this->log->status('insert to redrush_report.rp_user_login_history',$rs);
        } else {
            //$this->log->info('insert to redrush_report.rp_user_login_history');
            print "$user_id has no login history\n";
        } 
        return $rs;
    }

    function insertUserRaceData() {
        $freq = 0;
        $challenging = 0;
        $challenged = 0;
        $win = 0;
        $lose = 0;
        
        $query = "SELECT COUNT(id) freq FROM redrush_game.racing_history
				  WHERE user1_id = " . $this->user_id . " OR user2_id = " . $this->user_id . "";
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        if ($row = mysql_fetch_assoc($rs)) {
            $freq = intval($row['freq']);
        }
        mysql_free_result($rs);
        
        if ($freq > 0) {
            $query = "SELECT COUNT(id) win FROM redrush_game.racing_history
    				  WHERE (user1_id = " . $this->user_id . " OR user2_id = " . $this->user_id . ")
    				  AND winner = " . $this->user_id;
            if ($this->verbose) {print $query . "\n";}
            $rs = mysql_query($query, $this->conn);
            if ($row = mysql_fetch_assoc($rs)) {
                $win = intval($row['win']);
                $lose = $freq - $win;
            }
            mysql_free_result($rs);
            
            $query = "SELECT COUNT(id) challenging FROM redrush_game.racing_history
    				  WHERE user1_id = " . $this->user_id . "";
            if ($this->verbose) {print $query . "\n";}
            $rs = mysql_query($query, $this->conn);
            if ($row = mysql_fetch_assoc($rs)) {
                $challenging = intval($row['challenging']);
                $challenged = $freq - $challenging;
            }
            mysql_free_result($rs);
            $query = "REPLACE INTO redrush_report.rp_user_race_daily
					  (date_d, user_id, freq, 
					   challenging, challenged, win, lose)VALUES
					  ('" . $this->date . "', " . $this->user_id . ", " . $freq . ", 
					   " . $challenging . ", " . $challenged . ", " . $win . ", " . $lose . ")";
            if ($this->verbose) {print $query . "\n";}
            $rs = mysql_query($query, $this->conn);
            $this->log->status('insert to redrush_report.rp_user_race_daily',$rs);
            
            $query = "REPLACE INTO redrush_report.rp_user_race_total
                      (user_id, freq, challenging, challenged, win, lose, last_update)
                      SELECT user_id, SUM(freq), SUM(challenging), SUM(challenged), SUM(win), SUM(lose), NOW()
                      FROM redrush_report.rp_user_race_daily
                      WHERE user_id = " . $this->user_id;
            if ($this->verbose) {print $query . "\n";}
            $rs = mysql_query($query, $this->conn);
            $this->log->status('insert to redrush_report.rp_user_race_total',$rs);
            
            $query = "REPLACE INTO redrush_report.rp_user_race_level_daily
					  (date_d, user_id, opponent_level, freq)
            		  SELECT '" . $this->date . "', user1_id, racer2_level, COUNT(id) num 
            		  FROM redrush_game.racing_history
					  WHERE user1_id = " . $this->user_id . " GROUP BY racer2_level";
            if ($this->verbose) {print $query . "\n";}
            $rs = mysql_query($query, $this->conn);
            $this->log->status('insert to redrush_report.rp_user_race_level_daily',$rs);
            
            $query = "REPLACE INTO redrush_report.rp_user_race_level_total
					  (user_id, opponent_level, freq)
            		  SELECT user_id, opponent_level, SUM(freq) FROM redrush_report.rp_user_race_level_daily
					  WHERE user_id = " . $this->user_id;
            if ($this->verbose) {print $query . "\n";}
            $rs = mysql_query($query, $this->conn);
            $this->log->status('insert to redrush_report.rp_user_race_level_total',$rs);
        }
        return $rs;
    }
    
    public static function getAllUser($conn, $log) {
        $query = "SELECT id FROM redrush.kana_member LIMIT 10";
        $users = array();
        $i = 0;
        $rs = mysql_query($query, $conn);
        //print $conn . ":". $query . "\n";
        while ($row = mysql_fetch_assoc($rs)) {
            //print $i . " ";
            $users[$i++] = $row;
            //print $i . "\n";
        }
        mysql_free_result($rs);
        return $users;
    }

}

?>
