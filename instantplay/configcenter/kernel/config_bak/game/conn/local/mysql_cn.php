<?php
$db_config =  array(

    'instantplay'=>
        array(
            'master'=>array(
                'type'=>'mysql',
                'host'=>'127.0.0.1',
                'user'=>'mqzhifu',
                'pwd'=>'mqzhifu',
                'port'=>'3306',
                'db_name'=>'instantplay',
                'db_preifx'=>'',
                'char'=>'utf8',
            ),
            'slave'=>array(
                'type'=>'mysql',
                'host'=>'127.0.0.1',
                'user'=>'mqzhifu',
                'pwd'=>'mqzhifu',
                'port'=>'3306',
                'db_name'=>'instantplay',
                'db_preifx'=>'',
                'char'=>'utf8',
            ),
        ),
    'kxgame_log'=>
        array(
            'master'=>array(
                'type'=>'mysql',
                'host'=>'127.0.0.1',
                'user'=>'mqzhifu',
                'pwd'=>'mqzhifu',
                'port'=>'3306',
                'db_name'=>'kxgame_log',
                'db_preifx'=>'',
                'char'=>'utf8',
            ),
            'slave'=>array(
                'type'=>'mysql',
                'host'=>'127.0.0.1',
                'user'=>'mqzhifu',
                'pwd'=>'mqzhifu',
                'port'=>'3306',
                'db_name'=>'kxgame_log',
                'db_preifx'=>'',
                'char'=>'utf8',
            ),
        ),


    'game_match'=>
        array(
            'master'=>array(
                'type'=>'mysql',
                'host'=>'127.0.0.1',
                'user'=>'mqzhifu',
                'pwd'=>'mqzhifu',
                'port'=>'3306',
                'db_name'=>'game_match',
                'db_preifx'=>'',
                'char'=>'utf8',
            ),
            'slave'=>array(
                'type'=>'mysql',
                'host'=>'127.0.0.1',
                'user'=>'mqzhifu',
                'pwd'=>'mqzhifu',
                'port'=>'3306',
                'db_name'=>'game_match',
                'db_preifx'=>'',
                'char'=>'utf8',
            ),
        ),
);
$GLOBALS['db_config'] = $db_config;