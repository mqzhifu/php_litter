<?php
set_time_limit(600);
header("Content-type:text/html;charset=utf-8");
class MsgCtrl extends BaseCtrl{
    function index(){
        if(_g("getlist")){
            $this->getList();
        }

        $categoryOptions = MsgModel::getCategorySelectOptionHtml();
        $typeOptions = MsgModel::getTypeSelectOptionHtml();

        $this->assign("categoryOptions",$categoryOptions);
        $this->assign("typeOptions",$typeOptions);

        $this->display("/people/msg_list.html");
    }


    function getWhere(){
        $where = " 1 ";
        if($mobile = _g("mobile"))
            $where .= " and mobile = '$mobile'";

        if($message = _g("message"))
            $where .= " and mobile like '%$message%'";

        if($from = _g("from")){
            $from .= ":00";
            $where .= " and add_time >= '".strtotime($from)."'";
        }

        if($to = _g("to")){
            $to .= ":59";
            $where .= " and add_time <= '".strtotime($to)."'";
        }


        return $where;
    }

    function add(){
        if(_g('opt')){
            $toUid = _g("to_uid");
            $title = _g("title");
            $content = _g("content");
            $fromUid = _g("from_uid");
            $type = _g("type");
            $category = _g("category");
            $data = array(
                'from_del'=>MsgModel::DEL_FROM_FALSE,
                'to_del'=>MsgModel::DEL_TO_FALSE,
                'is_read'=>MsgModel::FROM_READ_FALSE,
                'type'=>$type,
                'to_uid'=>$toUid,
                'from_uid'=>$fromUid,
                'a_time'=>time(),
                'title'=>$title,
                'content'=>$content,
                'category'=>$category,
            );

            $msg = MsgModel::db()->add($data);
            var_dump($msg);exit;
        }

        $categoryOptions = MsgModel::getCategorySelectOptionHtml();
        $typeOptions = MsgModel::getTypeSelectOptionHtml();

        $this->assign("categoryOptions",$categoryOptions);
        $this->assign("typeOptions",$typeOptions);

        $this->addHookJS("people/msg_add_hook.html");
        $this->display("/people/msg_add.html");
    }

    function getList(){
        //???????????????????????????
        $records = array('data'=>[],'draw'=>$_REQUEST['draw']);

        $where = $this->getDataListTableWhere();

        $cnt = MsgModel::db()->getCount($where);

        $iTotalRecords = $cnt;//DB???????????????
        if ($iTotalRecords){
            $order_sort = _g("order");

            $order_column = $order_sort[0]['column'] ?: 0;
            $order_dir = $order_sort[0]['dir'] ?: "desc";


            $sort = array(
                'id',
                'id',
                '',
                '',
                '',
                '',
                'add_time',
            );
            $order = " order by ". $sort[$order_column]." ".$order_dir;

            $iDisplayLength = intval($_REQUEST['length']);//?????????????????????
            if(999999 == $iDisplayLength){
                $iDisplayLength = $iTotalRecords;
            }else{
                $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            }

            $iDisplayStart = intval($_REQUEST['start']);//limit ??????


            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;

            $limit = " limit $iDisplayStart,$end";
            $data = MsgModel::db()->getAll($where . $order . $limit);

            foreach($data as $k=>$v){
                $row = array(
                    '<input type="checkbox" name="id[]" value="'.$v['id'].'">',
                    $v['id'],
                    $v['from_uid'],
                    $v['to_uid'],
                    $v['title'],
                    MsgModel::TYPE[$v['type']],
                    $v['content'],
                    get_default_date($v['a_time']),

//                    $v['from_del'],
//                    $v['to_del'],
                    MsgModel::DEL_FROM[$v['from_del']],
                    MsgModel::DEL_TO[$v['to_del']],
                    $v['is_read'],
                    MsgModel::TYPE[$v['category']],
                    "",
                );

                $records["data"][] = $row;
            }
        }

        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        echo json_encode($records);
        exit;
    }

    function getDataListTableWhere(){
        $where = 1;
        $openid = _g("openid");
        $sex = _g("sex");
        $status = _g("status");

        $nickname = _g('name');
//        $nickname_byoid = _g('nickname_byoid');
//        $content = _g('content');
//        $is_online = _g('is_online');
//        $uname = _g('uname');

        $from = _g("from");
        $to = _g("to");

//        $trigger_time_from = _g("trigger_time_from");
//        $trigger_time_to = _g("trigger_time_to");


//        $uptime_from = _g("uptime_from");
//        $uptime_to = _g("uptime_to");


        $id = _g("id");
        if($id)
            $where .=" and id = '$id' ";

        if($openid)
            $where .=" and openid = '$openid' ";

        if($sex)
            $where .=" and sex = '$sex' ";

        if($status)
            $where .=" and status = '$status' ";

        if($nickname)
            $where .=" and nickname = '$nickname' ";

//        if($nickname_byoid){
//            $user = wxUserModel::db()->getRow(" nickname='$nickname_byoid'");
//            if(!$user){
//                $where .= " and 0 ";
//            }else{
//                $where .=  " and openid = '{$user['openid']}' ";
//            }
//        }

//        if($content)
//            $where .= " and content like '%$content%'";

        if($from)
            $where .=" and a_time >=  ".strtotime($from);

        if($to)
            $where .=" and a_time <= ".strtotime($to);

//        if($trigger_time_from)
//            $where .=" and trigger_time_from >=  ".strtotime($trigger_time_from);
//
//        if($trigger_time_to)
//            $where .=" and trigger_time_to <= ".strtotime($trigger_time_to);
//
//        if($uptime_from)
//            $where .=" and up_time >=  ".strtotime($uptime_from);
//
//        if($uptime_to)
//            $where .=" and up_time <= ".strtotime($uptime_to);



//        if($is_online)
//            $where .=" and is_online = '$is_online' ";


//        if($uname)
//            $where .=" and uname = '$uname' ";

        return $where;
    }


}