<?php
$db_config =  array(
    'test'=>
        array(
            'type'=>'mysql',
            'host'=>'127.0.0.1',
            'user'=>'mqzhifu',
            'pwd'=>'mqzhifu',
            'port'=>'3306',
            'db_name'=>'ucenter',
            'db_preifx'=>''
        ),
    'information_schema'=>
        array(
            'type'=>'mysql',
            'host'=>'127.0.0.1',
            'user'=>'root',
            'pwd'=>'root',
            'port'=>'3306',
            'db_name'=>'information_schema',
            'db_preifx'=>''
        ),
    'information_schema'=>
        array(
            'type'=>'mysql',
            'host'=>'114.112.64.130',
            'user'=>'root',
            'pwd'=>'mqzhifu',
            'port'=>'3306',
            'db_name'=>'information_schema',
            'db_preifx'=>''
        ),
    'assistant'=>
        array(
            'type'=>'mysql',
            'host'=>'127.0.0.1',
            'user'=>'root',
            'pwd'=>'root',
            'port'=>'3306',
            'db_name'=>'assistant',
            'db_preifx'=>''
        ),
    'majiang'=>
        array(
            'type'=>'mysql',
            'host'=>'127.0.0.1',
            'user'=>'root',
            'pwd'=>'mqzhifu',
            'port'=>'3306',
            'db_name'=>'majiang',
            'db_preifx'=>''
        ),
    'sanguo'=>
        array(
            'type'=>'mysql',
            'host'=>'127.0.0.1',
            'user'=>'mqzhifu',
            'pwd'=>'mqzhifu',
            'port'=>'3306',
            'db_name'=>'sanguo',
            'db_preifx'=>''
        ),
);
$GLOBALS['db_config'] = $db_config;