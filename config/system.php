<?php
// set the maximum execution time of script to 5 minutes (due to lengthy archiving processes handled by crontab)
ini_set('max_execution_time', 300);

// configure the error reporting
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
