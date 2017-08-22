<?php
/**
 * bot for searching facebook posts related to keywords
 */
include_once "bootstraps.php";
include_once "libs/Logger.php";
error_reporting(0);


class OverallReport {
    protected $log;
    protected $conn;
    protected $date;
    protected $date_ts;
    private $verbose = false;
    
    public function OverallReport($conn, $log) {
        $this->conn = $conn;
        $this->log = $log;
    }

    public function setVerbose($verbose = false) {
        $this->verbose = $verbose;
    }

    public function process($date, $date_ts) {
        $this->date = $date;
        $this->date_ts = $date_ts;

        $last_user_id = $ret[0];
        $user_count = $this->getUserCount();
        $login_count = $this->getOverallLoginCount();
        $total_login_time = $this->getOverallLoginTime();
        $avg_time_per_login = $total_login_time * 1.0/$login_count;
        $total_page_view = $this->getOverallPageviewCount();
        $page_view_per_login = $total_page_view * 1.0/$login_count;
        $redeem_count = $this->getOverallRedeemCount();
        $activity_arr = $this->getOverallActivityHistory();
        $total_point = $this->getOverallPoint();
        //var_dump($activity_arr);
        if ($this->verbose) {
            print $this->user_id . "::" . $login_count . "->" . $total_login_time . "->" .
                $avg_time_per_login . "->" . $total_page_view . "->" . $page_view_per_login . "->" .
                $redeem_count . "->" . $total_point . "\n\n";
        }
        $this->insertOverallReport($user_count, $page_view_per_login, $avg_time_per_login, $redeem_count,
        $total_page_view, $total_login_time, $login_count);
        $this->insertUserPerLevel();
        $this->insertOverallPageView();
        $this->insertOverallLoginHistory();
    }

    public function insertUserPerLevel() {
        $query = "REPLACE redrush_report.rp_user_level_daily(date_d, LEVEL, user_count)
			SELECT '" . $this->date . "', LEVEL, COUNT(user_id) num FROM redrush_game.racing_level GROUP BY LEVEL";
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        $this->log->status('insert to redrush_report.rp_user_level_daily',$rs);
        return $rs;
    }

    public function getUserCount() {
        $user_count = 0;
        $query = "SELECT COUNT(id) user_count FROM redrush.kana_member
        		WHERE DATE(register_date) <= '" . $this->date . "' LIMIT 1";
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        if ($row = mysql_fetch_assoc($rs)) {
            $user_count = intval($row['user_count']);
        }
        mysql_free_result($rs);
        return $user_count;
    }

    public function getOverallPageviewCount() {
        $page_view_count = 0;
        $query = "SELECT SUM(page_view_count) total_page_view FROM redrush_report.rp_user_daily
        		WHERE date_d = '" . $this->date . "' LIMIT 1";
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        if ($row = mysql_fetch_assoc($rs)) {
            $page_view_count = intval($row['total_page_view']);
        }
        mysql_free_result($rs);
        return $page_view_count;
    }

    public function getOverallLoginCount($use_timestamp = true) {
        $login_count = 0;
        $query = "SELECT SUM(login_count) total_count FROM redrush_report.rp_user_daily
        		WHERE date_d = '" . $this->date . "' LIMIT 1";
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        if ($row = mysql_fetch_assoc($rs)) {
            $login_count = intval($row['total_count']);
        }
        mysql_free_result($rs);
        return $login_count;
    }

    function getOverallLoginTime() {
        $login_time = 0;
        $query = "SELECT SUM(login_time) total_time FROM redrush_report.rp_user_daily
        		WHERE date_d = '" . $this->date . "' LIMIT 1";
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        if ($row = mysql_fetch_assoc($rs)) {
            $login_time = intval($row['total_time']);
        }
        mysql_free_result($rs);
        return $login_time;
    }

    function getOverallActivityHistory($num = 10, $use_timestamp = true) {
        $login_count = 0;
        if ($use_timestamp) {
            $query = "SELECT id, action_id, action_value FROM redrush.tbl_activity_log
			  WHERE date_ts >= " . $this->date_ts . " AND date_ts < " . ($this->date_ts+86400) . " 
			  ORDER BY id DESC LIMIT " . $num;
        } else {
            $query = "SELECT id, action_id, action_value FROM redrush.tbl_activity_log
			  WHERE DATE(date_time) = '" . $this->date . "' 
			  ORDER BY id DESC LIMIT " . $num;
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

    function getOverallRedeemCount() {
        $redeem_count = 0;
        $query = "SELECT SUM(redeem_count) total_redeem FROM redrush_report.rp_user_daily
        		WHERE date_d = '" . $this->date . "' LIMIT 1";
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        if ($row = mysql_fetch_assoc($rs)) {
            #print $row['user_id'] . "->" . $row['num'] . "\n";
            $redeem_count = $row['total_redeem'];
        }
        mysql_free_result($rs);
        return $redeem_count;
    }

    function getOverallPoint($use_timestamp = false) {
        $user_point = 0;
        if ($use_timestamp) {
            $query = "SELECT SUM(POINT) points FROM redrush.tbl_user_points
				WHERE submit_date_ts >= " . $this->date_ts . " AND submit_date_ts < " . ($this->date_ts+86400);
        } else {
            $query = "SELECT SUM(POINT) points FROM redrush.tbl_user_points
				WHERE DATE(submit_date) = '" . $this->date . "'";
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

    function insertOverallReport($user_count, $page_view_per_login, $time_per_login, $redeem_count,
    $page_view_count, $login_time, $login_count) {
        $query = "REPLACE INTO redrush_report.rp_overall_daily
				(date_d, user_count, page_view_per_login, 
				 time_per_login, redeem_count, page_view_count, 
				 login_time, login_count)VALUES 
				('" . $this->date . "','" . $user_count . "','" . $page_view_per_login . "',
				 '" . $time_per_login . "','" . $redeem_count . "','" . $page_view_count . "',
				 '" . $login_time . "','" . $login_count . "')";
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        $this->log->status('insert to redrush_report.rp_overall_daily',$rs);
        return $rs;
    }

    function insertOverallPageView($use_timestamp = true) {
        if ($use_timestamp) {
            $query = "REPLACE INTO redrush_report.rp_overall_pageview_daily(date_d, action_id, title, pageview_count)
					  SELECT DATE(date_time), action_id, action_value, COUNT(id) FROM redrush.tbl_activity_log
                      WHERE date_ts >= " . $this->date_ts . " AND date_ts < " . ($this->date_ts+86400) . "
                      AND action_id IN (7) GROUP BY DATE(date_time), action_id, action_value";
        } else {
            $query = "REPLACE INTO redrush_report.rp_overall_pageview_daily(date_d, action_id, title, pageview_count)
					  SELECT DATE(date_time), action_id, action_value, COUNT(id) FROM redrush.tbl_activity_log
                      WHERE DATE(date_time) = '" . $this->date . "' AND action_id IN (7)
                      GROUP BY DATE(date_time), action_id, action_value";
        }
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        $this->log->status('insert PAGE to redrush_report.rp_overall_pageview_daily',$rs);
        if ($use_timestamp) {
            $query = "REPLACE INTO redrush_report.rp_overall_pageview_daily(date_d, action_id, title, pageview_count)
					  SELECT DATE(A.date_time), A.action_id, B.title, COUNT(A.id) FROM redrush.tbl_activity_log A
                      INNER JOIN redrush.rr_news B ON A.action_value = B.id
            		  WHERE A.date_ts >= " . $this->date_ts . " AND A.date_ts < " . ($this->date_ts+86400) . "
                      AND A.action_id IN (2) GROUP BY DATE(A.date_time), A.action_id, A.action_value";
        } else {
            $query = "REPLACE INTO redrush_report.rp_overall_pageview_daily(date_d, action_id, title, pageview_count)
					  SELECT DATE(A.date_time), A.action_id, B.title, COUNT(A.id) FROM redrush.tbl_activity_log A
                      INNER JOIN redrush.rr_news B ON A.action_value = B.id
            		  WHERE DATE(A.date_time) = '" . $this->date . "' AND A.action_id IN (2)
                      GROUP BY DATE(A.date_time), A.action_id, A.action_value";
        }
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        $this->log->status('insert ARTICLE to redrush_report.rp_overall_pageview_daily',$rs);
        return $rs;
    }
    
    function insertOverallLoginHistory($use_timestamp = true) {
        if ($use_timestamp) {
            $query = "REPLACE INTO redrush_report.rp_overall_login_history_daily
            		  (date_d, HOUR, day_of_week, login_count)
					  SELECT DATE(date_time), HOUR(date_time), DAYOFWEEK(date_time)-1, COUNT(id)
                      FROM redrush.tbl_activity_log
                      WHERE date_ts >= " . $this->date_ts . " AND date_ts < " . ($this->date_ts+86400) . "
                      AND action_id = 1 GROUP BY DATE(date_time), HOUR(date_time)";
        } else {
            $query = "REPLACE INTO redrush_report.rp_overall_login_history_daily
                      (date_d, HOUR, day_of_week, login_count)
                      SELECT DATE(date_time), HOUR(date_time), DAYOFWEEK(date_time)-1, COUNT(id)
                      FROM redrush.tbl_activity_log
                      WHERE DATE(date_time) = '" . $this->date . "' AND action_id = 1
                      GROUP BY DATE(date_time), HOUR(date_time)";
        }
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        $this->log->status('insert to redrush_report.rp_overall_login_history_daily',$rs);
        
        $peak_date = '0000-00-00';
        $peak_date_count = 0;
        $query = "SELECT date_d, SUM(login_count) num
				  FROM redrush_report.rp_overall_login_history_daily
				  GROUP BY date_d ORDER BY num DESC LIMIT 1";
        if ($this->verbose) {print $query . "\n";}
        $rs = mysql_query($query, $this->conn);
        if ($row = mysql_fetch_assoc($rs)) {
            if (!is_null($row['date_d'])) {
                $peak_date = $row['date_d'];
                $peak_date_count = $row['num'];
            }
        }
        mysql_free_result($rs);
        if ($peak_date_count > 0) {
            $peak_hour = 0;
            $peak_hour_count = 0;
            $query = "SELECT HOUR, SUM(login_count) num
    				  FROM redrush_report.rp_overall_login_history_daily
    				  GROUP BY HOUR ORDER BY num DESC LIMIT 1";
            if ($this->verbose) {print $query . "\n";}
            $rs = mysql_query($query, $this->conn);
            if ($row = mysql_fetch_assoc($rs)) {
                if (!is_null($row['HOUR'])) {
                    $peak_hour = $row['HOUR'];
                    $peak_hour_count = $row['num'];
                }
            }
            mysql_free_result($rs);
            
            $peak_dow = 0;
            $peak_dow_count = 0;
            $query = "SELECT day_of_week, SUM(login_count) num
    				  FROM redrush_report.rp_overall_login_history_daily
    				  GROUP BY day_of_week ORDER BY num DESC LIMIT 1";
            if ($this->verbose) {print $query . "\n";}
            $rs = mysql_query($query, $this->conn);
            if ($row = mysql_fetch_assoc($rs)) {
                if (!is_null($row['day_of_week'])) {
                    $peak_dow = $row['day_of_week'];
                    $peak_dow_count = $row['num'];
                }
            }
            mysql_free_result($rs);
            
            $query = "TRUNCATE redrush_report.rp_overall_login_history";
            if ($this->verbose) {print $query . "\n";}
            $rs = mysql_query($query, $this->conn);
            $this->log->status('truncate redrush_report.rp_overall_login_history',$rs);
            $query = "REPLACE INTO redrush_report.rp_overall_login_history
					  (date, date_login_count, hour, 
					   hour_login_count, day_of_week, dow_login_count,last_update)VALUES
					  ('" . $peak_date . "','" . $peak_date_count . "','" . $peak_hour . "',
					   '" . $peak_hour_count . "','" . $peak_dow . "','" . $peak_dow_count . "',NOW())";

            if ($this->verbose) {print $query . "\n";}
            $rs = mysql_query($query, $this->conn);
            $this->log->status('insert to redrush_report.rp_overall_login_history',$rs);
        }
        
        mysql_free_result($rs);
        return $rs;
    }

}

?>
