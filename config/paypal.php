<?php
return array(
    // set your paypal credential
    'client_id' => env('CLIENT_ID', 'AbwIxUd_EDsTLKOqaPJfCkjdih_566XDIJ5kccBhSg5gOn4I3ahRRRp0BA-O9oLC1oTIODz-Z7jnXXHW'),
    'secret' => env('SECRET', 'EGCfSDU5W6L1Bxp9rz-z5HgdZDzXYHfweJ8uLm_Eo55P5DI5QJdRaHJ9hx6tzSaZvYtZsTxPuw_1AJk1'),

    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => env('MODE', 'sandbox'),

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);