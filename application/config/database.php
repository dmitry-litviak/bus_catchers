<?php defined('SYSPATH') OR die('No direct access allowed.');

$whitelist = array('buscatchers.loc');
if(in_array($_SERVER['HTTP_HOST'], $whitelist)){

    return array
    (
        'default' => array
        (
            'type'       => 'MySQL',
            'connection' => array(
                /**
                 * The following options are available for MySQL:
                 *
                 * string   hostname     server hostname, or socket
                 * string   database     database name
                 * string   username     database username
                 * string   password     database password
                 * boolean  persistent   use persistent connections?
                 * array    variables    system variables as "key => value" pairs
                 *
                 * Ports and sockets may be appended to the hostname.
                 */
                'hostname'   => 'localhost',
                'database'   => 'bus_catchers',
                'username'   => 'root',
                'password'   => 'root',
                'persistent' => FALSE,
            ),
            'table_prefix' => '',
            'charset'      => 'utf8',
            'caching'      => FALSE,
        ),
        'alternate' => array(
            'type'       => 'PDO',
            'connection' => array(
                /**
                 * The following options are available for PDO:
                 *
                 * string   dsn         Data Source Name
                 * string   username    database username
                 * string   password    database password
                 * boolean  persistent  use persistent connections?
                 */
                'dsn'        => 'mysql:host=localhost;dbname=kohana',
                'username'   => 'root',
                'password'   => 'r00tdb',
                'persistent' => FALSE,
            ),
            /**
             * The following extra options are available for PDO:
             *
             * string   identifier  set the escaping identifier
             */
            'table_prefix' => '',
            'charset'      => 'utf8',
            'caching'      => FALSE,
        )
    );

}else{
    return array
    (
        'default' => array
        (
            'type'       => 'MySQL',
            'connection' => array(
                /**
                 * The following options are available for MySQL:
                 *
                 * string   hostname     server hostname, or socket
                 * string   database     database name
                 * string   username     database username
                 * string   password     database password
                 * boolean  persistent   use persistent connections?
                 * array    variables    system variables as "key => value" pairs
                 *
                 * Ports and sockets may be appended to the hostname.
                 */
                'hostname'   => 'localhost',
                'database'   => 'bus_catchers',
                'username'   => 'root',
                'password'   => 'qwerfvbnm321Q',
                'persistent' => FALSE,
            ),
            'table_prefix' => '',
            'charset'      => 'utf8',
            'caching'      => FALSE,
        ),
        'alternate' => array(
            'type'       => 'PDO',
            'connection' => array(
                /**
                 * The following options are available for PDO:
                 *
                 * string   dsn         Data Source Name
                 * string   username    database username
                 * string   password    database password
                 * boolean  persistent  use persistent connections?
                 */
                'dsn'        => 'mysql:host=localhost;dbname=kohana',
                'username'   => 'root',
                'password'   => 'r00tdb',
                'persistent' => FALSE,
            ),
            /**
             * The following extra options are available for PDO:
             *
             * string   identifier  set the escaping identifier
             */
            'table_prefix' => '',
            'charset'      => 'utf8',
            'caching'      => FALSE,
        )
    );

}



