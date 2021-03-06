<?php

class Helper_Output {

    protected static $_css = array();
    protected static $_js = array();
    protected static $_csspath = 'css/';
    protected static $_jspath = 'js/';

    public static function factory() {
        return new Helper_Output();
    }

    public function link_css($css) {
        self::$_css[] = $css;
        return $this;
    }

    public function link_js($js) {
        self::$_js[] = $js;
        return $this;
    }

    public static function renderCss() {
        if (!empty(self::$_css)) {
            foreach (self::$_css as $key => $value) {

                $http = substr($value, 0, 4);
                if ($http == 'http') {
                    echo '<link rel="stylesheet" type="text/css" href="' . $value . '" />';
                } else {
                    echo '<link rel="stylesheet" type="text/css" href="' . URL::base() . self::$_csspath . $value . '.css" />';
                }
            }
        }
    }

    public static function renderJS() {
        if (!empty(self::$_js)) {
            foreach (self::$_js as $key => $value) {
                $http = substr($value, 0, 4);
                if ($http == 'http') {
                    echo '<script type="text/javascript" src="' . $value . '" /></script>';
                } else {
                    echo '<script type="text/javascript" src="' . URL::base() . self::$_jspath . $value . '.js" ></script>';
                }
            }
        }
    }

    public static function getDateFromUnixTime($time = false) {
        if (!$time)
            $time = time();
        return date(Kohana::$config->load('config')->get('date_format'), $time);
    }

    public static function db_name_date($date) {
        if ($date == '0000-00-00 00:00:00' || !$date) {
            return date('YFj', time());
        } else {
            return DateTime::CreateFromFormat('Y-m-d', $date)->format('YFj');
        }
    }

    public static function time_for_table($date) {
        if ($date == '0000-00-00 00:00:00' || !$date) {
            return "--";
        } else {
            return DateTime::CreateFromFormat('Y-m-d H:i:s', $date)->format('g:i a');
        }
    }

    static function hightLight($what, $where) {
        return str_replace($what, "<b>" . $what . "</b>", $where);
    }

    public static function timestampForDB($date) {
        if ($date == '00-00-0000' || !$date) {
            return date('Y-m-d H:i:s', time());
        } else {
            return DateTime::CreateFromFormat('d-m-Y', $date)->format('Y-m-d');
        }
    }

    public static function clean($post) {
        $arr = $post;
        foreach ($arr as &$value) {
            if (is_array($value)) {
                $value = self::clean($value);
            } else {
                if (!get_magic_quotes_gpc()) {
                    $value = addslashes($value);
                }
                $value = strip_tags(htmlspecialchars(stripslashes($value)));
            }
        }
        return $arr;
    }

    public static function get_next_n_days($n) {
        $result = array();
        for ($i = 0; $i < $n; $i++) {
            $result[$i][0] = date('l \(F j, Y\)', strtotime('+' . $i . 'day'));
            $result[$i][1] = self::timestampForDB(date('d-m-Y', strtotime('+' . $i . 'day')));
        }
        return $result;
    }

    public static function cut_string($string, $maxlen) {
        $len = (mb_strlen($string) > $maxlen) ? mb_strripos(mb_substr($string, 0, $maxlen), ' ') : $maxlen;
        $cutStr = mb_substr($string, 0, $len);
        return (mb_strlen($string) > $maxlen) ? $cutStr . '...' : $cutStr;
    }

    public static function create_date($i) {
        $hours = floor($i / 60);
        $minutes = $i - ($hours * 60);
        $ampm = $hours >= 12 ? "pm" : "am";
        $hours = $hours % 12;
        $hours = $hours > 9 ? $hours : "0" . $hours;
        $minutes = $minutes < 10 ? "0" . $minutes : $minutes;
        return $hours . ":" . $minutes . " " . $ampm;
    }

    public static function ago($tm, $rcs = 0) {
        $cur_tm = time();
        $dif = $cur_tm - $tm;
        $pds = array('second', 'minute', 'hour', 'day', 'week', 'month', 'year', 'decade');
        $lngh = array(1, 60, 3600, 86400, 604800, 2630880, 31570560, 315705600);
        for ($v = sizeof($lngh) - 1; ($v >= 0) && (($no = $dif / $lngh[$v]) <= 1); $v--)
            ; if ($v < 0)
            $v = 0; $_tm = $cur_tm - ($dif % $lngh[$v]);

        $no = floor($no);
        if ($no <> 1)
            $pds[$v] .='s'; $x = sprintf("%d %s ", $no, $pds[$v]);
        if (($rcs == 1) && ($v >= 1) && (($cur_tm - $_tm) > 0))
            $x .= time_ago($_tm);
        return $x . ' ago';
    }

}