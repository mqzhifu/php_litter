<?php
$code = array(
    200=>'成功',
    //系统相关
    5000=>'默认值，未知错误',
    5001=>'此接口必须为登陆状态',
    5002=>'请求IP在黑名单中',
    5003=>'请求IP在短时间内，请求次数过于频繁',
    5005=>'curl错误',
    5006=>'发送短信-XX秒只能发送XX次',
    5007=>'发送短信-一天内只允许发送XX次',

    5008=>'发送短信-配置表里的短信内容为空',
    5009=>'发送短信-运营商发送失败',

    //用户相关
    6001=>'用户未登陆',
    6003=>'#name#号已注册',
    6004=>'用户在黑名单中',
    6101=>'用户在短时间内，请求次数过于频繁',



    //各种参数为空
    8000=>'cellphone(手机号为空)-为空',
    8001=>'ps(密码)-为空',
    8002=>'uid为空',
    8003=>'key为空',
    8004=>'type为空',
    8005=>'ruleId为空',
    8006=>'appid为空',//oauth
    8007=>'timestamp为空',
    8008=>'authentication为空',
    8008=>'imgCode为空',//图片验证码
    8009=>'name为空',
    8010=>'ps为空',
    8011=>'uniqueCode为空',
    8012=>'pic为空',
    8013=>'confimPs为空',
    8014=>'code为空',
    8015=>'addr为空',
    8016=>'userinfo为空',//用户于3方登陆、修改用户个人信息
    8017=>'上传图片 post input name 为空',
    8018=>'上传图片 内容 为空',
    8019=>'所有参数均为空',
    8020=>'$configId为空',
    8021=>'num为空',
    8022=>'srcUid 为空',
    8023=>'targetUid 为空',
    8024=>'taskId 为空',
    8025=>'keyword为空',
    8026=>'touid为空',
    8027=>'gameid为空',
    8028=>'list为空',
    8029=>'goodsId为空',
    8030=>'uniqueId为空',
    8031=>'nickname为空',
    8032=>'avatar为空',
    8033=>'status为空',
    8034=>'email为空',



//    5003=>'token验证错误',
//    5004=>'key验证错误',
//    8005=>'登陆-无须重复登陆',
    8101=>'邮箱格式错误',
    8102=>'格式错误,md5',
    8105=>'token解出的UID，但不是整型',
    //各种-数据格式-验证-错误
    8109=>'token解析失败',//
    8110=>'code验证失败',//
    8112=>'路径错误',
    8113=>'目录不是777',
    8114=>'图片大于2MB',
    8115=>'文件扩展名错误',
    8116=>'文件类型错误',
    8117=>'文件上传失败1',
    8118=>'文件上传失败2',
    8119=>'手机号格式错误',


    8200=>'没有数据需要更新',
    8201=>'',
    8202=>'',
    8203=>'金币不足',
    8204=>'',
    8205=>'用户日常任务-今日已添加',
    8206=>'用户没有今日任务',
    8207=>'任务已经完成',
    8208=>'任务已经领取奖励',
    8209=>'num >= 0 ',
    8210=>'type值错误',
    8211=>'',
    8212=>'',
    8213=>'',
    8215=>'',
    8216=>'该任务不是您的，请不要冒领',
    8217=>'任务还未完成',
    8218=>'任务已刷新',
    8219=>'已领取过了',
    8220=>'num <=0 ',
    8221=>'$rewardId不是自己的',
    8222=>'targetUid不等于TOKEN-Uid',
    8223=>'',
    8224=>'',
    8225=>'',
    8226=>'',
    8227=>'没有升级日志记录',
    8228=>'已领取',
    8229=>'',
    8230=>'token已失效，请重新登陆',
    8231=>'redis中没有token，用户并没有登陆过',
    8232=>'参数中的token解出来的UID，与redis中token不一致',
    8233=>'不是整型',
    8234=>'广告表数据为空，无法获取最大随机数',
    8235=>'用户没有绑定facebook',
    8236=>'目标用户关闭了PUSH，无法PUSH消息',
    8237=>'目标用户把发送用户加入了黑名单，无法PUSH消息',
    8238=>'30秒前刚刚领过',
    8239=>'今日金币已达上限',
    8240=>'商品库存不足',
    8241=>'积分不足',
    8242=>'type值错误，必须为3方平台类型',
    8243=>'已经绑定过了',
    8244=>'只有注册类型为<游客>才可以绑定',
    8245=>'status值错误',
    8246=>'请不要重复收藏',
    8247=>'请不要重复关注',
    8248=>'已为好友，请不要重复申请添加',
    8249=>'一个小时内，只能对同一用户，发起一次好友申请',
    8250=>'非好好关系，不能操作',
    8251=>'好友，记录缺失',
    8252=>'请不要重复拉黑',
    8253=>'对方并没有在黑名单中',
    8254=>'不能关注自己',
    8255=>'不能加自己',
    8256=>'并没有好友申请记录',
    8257=>'状态错误',

    //Db相关,也就是参数传过来的ID 到DB中查找不到
    1000=>'uid不在DB中',
    1001=>'ruleId不在DB中',
    1002=>'token解出的UID，未在DB中',
    1003=>'appid错误，不在DB中',
    1004=>'并没有发送过短信',
    1005=>'db status 状态已失效',
    1006=>'登陆用户不在DB中',
    1007=>'找回密码，地址不在DB中',
    1008=>'$configId不在DB中',
    1009=>'$srcUid不在DB中',
    1010=>'$targetUid不在DB中',
    1011=>'taskId不在DB中',
    1012=>'$rewardId不在DB中',
    1013=>'gameId不在DB中',
    1014=>'goodsId不在DB中',



    9991=>'系统(php)抛出异常',
    9992=>'系统(php)error',
    9993=>'系统(php)fatal error',

);
$GLOBALS['code'] = $code;