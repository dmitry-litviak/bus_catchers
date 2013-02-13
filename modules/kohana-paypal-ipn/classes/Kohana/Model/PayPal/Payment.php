<?php defined('SYSPATH') or die('No direct script access.');
/*
 * @package		Auth Module
 * @author      Pap Tamas
 * @copyright   (c) 2011-2012 Pap Tamas
 * @website		https://github.com/paptamas/kohana-auth
 * @license		http://www.opensource.org/licenses/isc-license.txt
 *
 */

class Kohana_Model_PayPal_Payment extends ORM {

    protected $_table_name = 'payments';

    protected $_primary_key = 'payment_id';

    protected $_table_columns = array(
        'payment_id' => array(),
        'transaction_id' => array(),
        'parent_transaction_id' => array(),
        'payment_status' => array(),
        'gross' => array(),
        'currency' => array(),
        'payer_id' => array(),
        'payer_email' => array(),
        'payer_name' => array(),
        'payment_date' => array(),
        'info' => array()
    );

    /**
     * Check if transaction id is already registered
     *
     * @param $transaction_id
     * @param $payment_status
     * @return bool
     */
    public function is_unique($transaction_id, $payment_status)
    {
        return ! (bool) DB::select(array(DB::expr('COUNT("*")'), 'total_count'))
            ->from($this->_table_name)
            ->where('transaction_id', '=', $transaction_id)
            ->and_where('payment_status', '=', $payment_status)
            ->execute($this->_db)
            ->get('total_count');
    }
}

// END Kohana_Model_PayPal_Payment