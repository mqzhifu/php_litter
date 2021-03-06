<?php
set_time_limit(600);
header("Content-type:text/html;charset=utf-8");
class WithdrawCtrl extends BaseCtrl{
    function index(){
        if(_g("getlist")){
            $this->getList();
        }
        $this->display("/finance/withdraw_list.html");
    }

    function add(){
        $oids = _g("oids");
        if(!$oids){
            exit("oids is null");
        }

        $role = _g("role");
        if(!$role){
            exit("role is null");
        }
        $oids = explode(",",$oids);
        $priceTotal = 0;
        $showHtml = "";
        $agent = null;
        foreach ($oids as $k=>$v) {
            $order = OrderModel::db()->getById($v);
            if($order != OrderModel::STATUS_FINISH){
                $this->notice($v. " 订单非完成状态，不允许 提现");
            }

            if($role == AgentModel::ROLE_FACTORY){
                if($order['factory_withdraw_money_status'] ==OrderModel::WITHDRAW_MONEY_STATUS_OK){
                    $this->notice($v." 订单 已提取过了");
                }
            }else{
                if($order['agent_withdraw_money_status'] ==OrderModel::WITHDRAW_MONEY_STATUS_OK){
                    $this->notice($v." 订单 已提取过了");
                }
            }

            if($role != AgentModel::ROLE_FACTORY){
                $agent = AgentModel::db()->getById($order['agent_uid']);
                $fee_percent = $agent['fee_percent'] / 100;
                $price = $order['price'] * $fee_percent;
                $priceTotal += $price;
                $showHtml .= "$v($price)";
            }
        }

        if(_g('opt')){
            $data = array(
                'price'=>_g('price'),
                'orders_ids'=>_g('price'),
                'status'=>_g('price'),
                'type'=>_g('role'),
                'a_time'=>time(),
            );
            if(AgentModel::ROLE_FACTORY == $role){
                $data['admin_id'] = $this->_adminid;
            }else{
                $data['uid'] = -1;
            }

            $newId = WithdrawModel::db()->add($data);

            var_dump($newId);exit;
        }else{
//            $category = ProductCategoryModel::db()->getById($product['category_id']);
//
//            $statusSelectOptionHtml = ProductModel::getStatusSelectOptionHtml();
//            $this->assign("statusSelectOptionHtml",$statusSelectOptionHtml);
//            $this->assign("categoryName",$category['name']);
//        $this->assign("categoryOptions", ProductCategoryModel::getSelectOptionHtml());

            $this->assign("priceTotal",$priceTotal);
            $this->assign("show",$showHtml);
            $this->assign("agent",$agent);
            $this->assign("role",AgentModel::ROLE[$role]);


            $this->addJs('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js');
            $this->addJs('/assets/global/plugins/jquery-validation/js/additional-methods.min.js');

//            $this->addHookJS("/finance/withdraw_add_hook.html");
            $this->display("/finance/withdraw_add.html");
        }

    }

    function getList(){
        $this->getData();
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


    function getData(){
        $records = array();
        $records["data"] = array();
        $sEcho = intval($_REQUEST['draw']);

        $where = $this->getDataListTableWhere();

        $cnt = WithdrawModel::db()->getCount($where);

        $iTotalRecords = $cnt;//DB中总记录数
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
                '',
                '',
                'a_time',
            );
            $order = " order by ". $sort[$order_column]." ".$order_dir;

            $iDisplayLength = intval($_REQUEST['length']);//每页多少条记录
            if(999999 == $iDisplayLength){
                $iDisplayLength = $iTotalRecords;
            }else{
                $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            }

            $iDisplayStart = intval($_REQUEST['start']);//limit 起始


            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;

            $data = WithdrawModel::db()->getAll($where . $order);

            foreach($data as $k=>$v){
                $row = array(
                    '<input type="checkbox" name="id[]" value="'.$v['id'].'">',
                    $v['id'],
                    $v['uid'],
                    $v['price'],
                    $v['orders_ids'],
                    get_default_date($v['a_time']),
                    $v['status'],
                    $v['memo'],
                    $v['type'],
                    get_default_date($v['u_time']),
                    "",
                );

                $records["data"][] = $row;
            }
        }

        $records["draw"] = $sEcho;
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