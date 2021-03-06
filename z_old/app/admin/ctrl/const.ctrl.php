<?php
class ConstCtrl extends BaseCtrl
{

    function index()
    {
        $this->setTitle('test');


        if(_g("getlist")){
            $this->getList();
        }



        $this->addCss('/assets/global/plugins/select2/select2.css');
        $this->addCss('/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css');
        $this->addCss('/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css');
//        $this->addCss('/assets/admin/layout4/css/themes/light.css');
        $this->addCss('/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css');




        $this->addJs('/assets/global/plugins/select2/select2.min.js');
        $this->addJs('/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js');
        $this->addJs('/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js');
//        $this->addJs('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js');

        $this->addJs('/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js');

        $this->addJs('/assets/global/scripts/datatable.js');
        $this->addJs('/assets/global/plugins/bootbox/bootbox.min.js');

        $this->addJs('/js/jquery.validate.min.js');
        $this->addJs('/js/additional-methods_cn.js');

        $this->addJs('/js/jquery.form.js');

        $this->addJs('/js/pop_bootbox.js');
        $this->addJs('/js/pop_ajax.js');


        $status_desc = orderModel::$_status_desc;

        $this->addHookJS("const/list_hook.html");
        $this->assign("status_desc",$status_desc);

        $this->display("const/list.html");

    }

    function edit(){
        $id = _g("id");
        if(!$id)
            echo_json("id is null",'500');

        $info = ConstModel::db()->getById($id);
        if(!$info)
            echo_json("id not in db...",'500');

//        $this->AddAssign("info",$info);


        if(_g('doings')){
            $content = _g("content");
            if(!$info)
                echo_json("??????????????????",'500');

            $data = array('content'=>$content,'up_time'=>time());
            ConstModel::db()->upById($id,$data);

            echo_json("ok",200);
        }else{
            $html = $this->_st->compile("const/edit.html");
            $html = file_get_contents($html);
            $html = str_replace("#title#",$info['title'],$html);
            $html = str_replace("#key#",$info['key'],$html);
            $html = str_replace("#content#",$info['content'],$html);

            $html = str_replace("#id#",$id,$html);

            echo_json($html);
        }


    }

    function add(){
//        $this->addCss('/assets/global/plugins/typeahead/typeahead.css');
//        $this->addJs('/assets/admin/pages/scripts/components-form-tools.js');




        if(_g('doings')){
            $address = _g("address");
            $product_desc = _g("product_desc");
            $p_type = _g("p_type");
            $openid = _g("openid");
            $memo = _g("memo");
            $price = _g("price");


            if(!$product_desc)
                echo_json("product_desc is null",'500');

            if(!$openid)
                echo_json("openid is null",'501');

            if(!$price)
                echo_json("price is null",'502');

            if(!$p_type)
                echo_json("p_type is null",'503');

            $data = array(
                'address'=>$address,
                'product_desc'=>$product_desc,
                'product_type'=>$p_type,
                'memo'=>$memo,
                'price'=>$price,
                'openid'=>$openid,
                'a_time'=>time(),
                'up_time'=>time(),
                'status'=>1,
            );

            orderModel::db()->add($data);

            echo_json("ok",200);
        }else{

            $p_type = productTypeModel::db()->getAll();
            $p_type_option = "";
            foreach($p_type as $k=>$v){
                $p_type_option .= "<option value='{$v['id']}'>{$v['title']}</option>";
            }


            $html = $this->_st->compile("order_add.html");
            $html = file_get_contents($html);
            $html = str_replace("#p_type_option#",$p_type_option,$html);
            echo_json($html);
        }




    }

    function getWhere(){
        return 1;
    }

    function getlist(){
        $records = array();
        $records["data"] = array();
        $sEcho = intval($_REQUEST['draw']);

        $where = $this->getWhere();

        $cnt = ConstModel::db()->getCount($where);

        $iTotalRecords = $cnt;//DB???????????????
        if ($iTotalRecords){
            $order_sort = _g("order");

            $order_column = $order_sort[0]['column'] ?: 0;
            $order_dir = $order_sort[0]['dir'] ?: "asc";


            $sort = array(
                'id',
                'id',
                '',
                '',
                '',
                '',
                'add_time',
            );
            $order = $sort[$order_column]." ".$order_dir;

            $iDisplayLength = intval($_REQUEST['length']);//?????????????????????
            if(999999 == $iDisplayLength){
                $iDisplayLength = $iTotalRecords;
            }else{
                $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            }

            $iDisplayStart = intval($_REQUEST['start']);//limit ??????


            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;

            $data = ConstModel::db()->getAll(" $where order by $order limit $iDisplayStart,$end");

//            $arr = orderModel::$_status_desc;
            foreach($data as $k=>$v){
//                $status = "??????";
//                if(in_array($v['status'], array_flip($arr)))
//                    $status = $arr[$v['status']];

//                $status = 0;

//                $pay_time = "";
//                if($v['a_time'])
//                    $pay_time =  date("Y-m-d H:i:s",$v['pay_time']);

//                $uname = getUnameByOid($v['openid']);
                $records["data"][] = array(
                    '<input type="checkbox" name="id[]" value="'.$v['id'].'">',
                    $v['id'],
                    $v['title'],
                    $v['content'],
                    $v['key'],
                    date("Y-m-d H:i:s",$v['up_time']),
                    date("Y-m-d H:i:s",$v['a_time']),
                    $v['status'],
//                    '<a href="#" class="btn btn-xs default red delone" data-id="'.$v['id'].'"><i class="fa fa-trash-o"></i> ??????</a>',
                    '<a href="#" class="btn btn-xs default blue-hoki upinfo" data-id="'.$v['id'].'"><i class="fa fa-trash-o"></i> ??????</a>',
                );
            }
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        echo json_encode($records);
        exit;
    }
}