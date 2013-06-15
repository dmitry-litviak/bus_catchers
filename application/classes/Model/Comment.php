<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Model_Comment extends ORM {

    public function get_avg_rating_1($id) {
        $comments = ORM::factory('Comment')->where('company_id', '=', $id)->find_all();
        $rates = array();
        foreach ($comments as $comment) {
            $rates[] = ($comment->timeliness + $comment->comfort + $comment->wifi + $comment->empty_seating + $comment->cleanliness) / 5;
        }
        $length = count($rates);
        $result = array_sum($rates);
        if ($length) {
            $result = $result / $length;
        }
        return $result;
    }

    public function get_avg_rating($id) {
        $comments = ORM::factory('Comment')->where('company_id', '=', $id)->find_all();
        $rates = array();
        foreach ($comments as $comment) {
            $rates[] = $comment->rating;
        }
        $length = count($rates);
        $result = array_sum($rates);
        if ($length) {
            $result = $result / $length;
        }
        return $result;
    }

}