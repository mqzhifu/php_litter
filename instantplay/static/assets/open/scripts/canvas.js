$(function(){
	var start1 = laydate.render({  
        elem: '#realtime_from',
        done:function(value,date){
        	if(value!=''){
        		date.month=date.month-1;
        		end1.config.min=date;
        	}
        	// if($('#realtime_from').val()!="" && $('#realtime_to').val()!=""){
        	// 	refreshRealTime();
        	// }

    	}
    });  
    var end1 = laydate.render({  
        elem: '#realtime_to',   
        done:function(value,date){
        	if(value!=''){
        		date.month=date.month-1;
        		start1.config.max=date;
        	}
        	// if($('#realtime_from').val()!="" && $('#realtime_to').val()!=""){
        	// 	refreshRealTime();
        	// }
        }
    });
    var start2 = laydate.render({  
        elem: '#visit_line_from',
        done:function(value,date){
        	if(value!=''){
        		date.month=date.month-1;
        		end2.config.min=date;
        	}
        	console.log(1)
    	}
    });  
    var end2 = laydate.render({  
        elem: '#visit_line_to',   
        done:function(value,date){
        	if(value!=''){
        		date.month=date.month-1;
        		start2.config.max=date;
        	}
        }
    });
 	var start3 = laydate.render({  
        elem: '#visit_new_reg_from',
        done:function(value,date){
        	if(value!=''){
        		date.month=date.month-1;
        		end3.config.min=date;
        	}
    	}
    });  
    var end3 = laydate.render({  
        elem: '#visit_new_reg_to',   
        done:function(value,date){
        	if(value!=''){
        		date.month=date.month-1;
        		start3.config.max=date;
        	}
        }
    });
    var start4 = laydate.render({  
        elem: '#visit_line2_from',
        done:function(value,date){
        	if(value!=''){
        		date.month=date.month-1;
        		end4.config.min=date;
        	}
    	}
    });  
    var end4 = laydate.render({  
        elem: '#visit_line2_to',   
        done:function(value,date){
        	if(value!=''){
        		date.month=date.month-1;
        		start4.config.max=date;
        	}
        }
    });
    var start5 = laydate.render({  
        elem: '#income_line_from',
        done:function(value,date){
        	if(value!=''){
        		date.month=date.month-1;
        		end5.config.min=date;
        	}
    	}
    });  
    var end5 = laydate.render({  
        elem: '#income_line_to',   
        done:function(value,date){
        	if(value!=''){
        		date.month=date.month-1;
        		start5.config.max=date;
        	}
        }
    });
    
     var start6 = laydate.render({  
        elem: '#laydate-start6',
        done:function(value,date){
        	if(value!=''){
        		date.month=date.month-1;
        		end6.config.min=date;
        	}
    	}
    });  
    var end6 = laydate.render({  
        elem: '#laydate-end6',   
        done:function(value,date){
        	if(value!=''){
        		date.month=date.month-1;
        		start6.config.max=date;
        	}
        }
    });
    ladydate1();
    $(".laydate1").change(function(){
    	ladydate1();
    	
    });
    function ladydate1(){
    	if($(".laydate1").val()=='1'){//??????24??????
    		$(".laydate1").siblings(".dateInterval").children(".laydateInput").attr("disabled",true);
    		var dateTime=new Date();
    		dateTime=dateTime.setDate(dateTime.getDate()+1);
			dateTime=new Date(dateTime);
    		laydate.render({  
		        elem: '#realtime_from',
		        value:new Date()
		    });
		    laydate.render({  
		        elem: '#realtime_to',
		        value:dateTime
		    });
		    $("#realtime_searchBtn").hide();  
    	}else{
    		$(".laydate1").siblings(".dateInterval").children(".laydateInput").attr("disabled",false);
    		$("#realtime_searchBtn").show();  
    	}
    	
    } 
    laydate2();
    $(".laydate2").change(function(){
    	laydate2();
    });
    function laydate2(){
    	if($(".laydate2").val()=='2'){//??????7???
    		$(".laydate2").siblings(".dateInterval").children(".laydateInput").attr("disabled",true);
    		var dateTime=new Date();
    		dateTime=dateTime.setDate(dateTime.getDate()+7);
			dateTime=new Date(dateTime);
    		laydate.render({  
		        elem: '#laydate-start2',
		        value:new Date()
		    });
		    laydate.render({  
		        elem: '#laydate-end2',
		        value:dateTime
		    });  
		    $("#visit_line_searchBtn").hide();  
    	}else if($(".laydate2").val()=='1'){//??????30???
    		$(".laydate2").siblings(".dateInterval").children(".laydateInput").attr("disabled",true);
			var dateTime=new Date();
    		dateTime=dateTime.setDate(dateTime.getDate()+30);
			dateTime=new Date(dateTime);
    		laydate.render({  
		        elem: '#laydate-start2',
		        value:new Date()
		    });
		    laydate.render({  
		        elem: '#laydate-end2',
		        value:dateTime
		    });  
    		$("#visit_line_searchBtn").hide();  
    	}else{
    		$(".laydate2").siblings(".dateInterval").children(".laydateInput").attr("disabled",false);
    		$("#visit_line_searchBtn").show();  
    	}
    }
    laydate3();
    $(".laydate3").change(function(){
    	laydate3();
    });
    function laydate3(){
    	if($(".laydate3").val()=='4'){//??????
    		$(".laydate3").siblings(".dateInterval").children(".laydateInput").attr("disabled",true);
    		var dateTime=new Date();
    		dateTime=dateTime.setDate(dateTime.getDate()-1);
			dateTime=new Date(dateTime);
    		laydate.render({  
		        elem: '#laydate-start3',
		        value:dateTime
		    });
		    laydate.render({  
		        elem: '#laydate-end3',
		        value:new Date()
		    });  
		    $("#visit_new_reg_searchBtn").hide();  
    	}else if($(".laydate3").val()=='2'){//??????
    		$(".laydate3").siblings(".dateInterval").children(".laydateInput").attr("disabled",true);
			var dateTime=new Date();
    		dateTime=dateTime.setDate(dateTime.getDate()-7);
			dateTime=new Date(dateTime);
    		laydate.render({  
		        elem: '#laydate-start3',
		        value:dateTime
		    });
		    laydate.render({  
		        elem: '#laydate-end3',
		        value:new Date()
		    });  
    		$("#visit_new_reg_searchBtn").hide();  
    	}else if($(".laydate3").val()=='1'){//??????
    		$(".laydate3").siblings(".dateInterval").children(".laydateInput").attr("disabled",true);
			var dateTime=new Date();
    		dateTime=dateTime.setDate(dateTime.getDate()-30);
			dateTime=new Date(dateTime);
    		laydate.render({  
		        elem: '#laydate-start3',
		        value:dateTime
		    });
		    laydate.render({  
		        elem: '#laydate-end3',
		        value:new Date()
		    });  
    		$("#visit_new_reg_searchBtn").hide();  
    	}else{
    		$(".laydate3").siblings(".dateInterval").children(".laydateInput").attr("disabled",false);
    		$("#visit_new_reg_searchBtn").show();  
    	}
    }

    laydate4();
    $(".laydate4").change(function(){
    	laydate4();
    });
    function laydate4(){
    	if($(".laydate4").val()=='1'){//??????30???
    		$(".laydate4").siblings(".dateInterval").children(".laydateInput").attr("disabled",true);
    		var dateTime=new Date();
    		dateTime=dateTime.setDate(dateTime.getDate()-30);
			dateTime=new Date(dateTime);
    		laydate.render({  
		        elem: '#laydate-start4',
		        value:dateTime
		    });
		    laydate.render({  
		        elem: '#laydate-end4',
		        value:new Date()
		    });  
		    $("#visit_line2_searchBtn").hide();  
    	}else if($(".laydate4").val()=='2'){//??????7???
    		$(".laydate4").siblings(".dateInterval").children(".laydateInput").attr("disabled",true);
			var dateTime=new Date();
    		dateTime=dateTime.setDate(dateTime.getDate()-7);
			dateTime=new Date(dateTime);
    		laydate.render({  
		        elem: '#laydate-start4',
		        value:dateTime
		    });
		    laydate.render({  
		        elem: '#laydate-end4',
		        value:new Date()
		    });  
    		$("#visit_line2_searchBtn").hide();  
    	}else{
    		$(".laydate4").siblings(".dateInterval").children(".laydateInput").attr("disabled",false);
    		$("#visit_line2_searchBtn").show();  
    	}
    }

    laydate5();
     $(".laydate5").change(function(){
    	laydate5();
    });
     function laydate5(){
     	if($(".laydate5").val()=='1'){//??????30???
    		$(".laydate5").siblings(".dateInterval").children(".laydateInput").attr("disabled",true);
    		var dateTime=new Date();
    		dateTime=dateTime.setDate(dateTime.getDate()-30);
			dateTime=new Date(dateTime);
    		laydate.render({  
		        elem: '#laydate-start5',
		        value:dateTime
		    });
		    laydate.render({  
		        elem: '#laydate-end5',
		        value:new Date()
		    });  
		    $("#income_line_searchBtn").hide();  
    	}else if($(".laydate5").val()=='2'){//??????7???
    		$(".laydate5").siblings(".dateInterval").children(".laydateInput").attr("disabled",true);
			var dateTime=new Date();
    		dateTime=dateTime.setDate(dateTime.getDate()-7);
			dateTime=new Date(dateTime);
    		laydate.render({  
		        elem: '#laydate-start5',
		        value:dateTime
		    });
		    laydate.render({  
		        elem: '#laydate-end5',
		        value:new Date()
		    });  
    		$("#income_line_searchBtn").hide();  
    	}else{
    		$(".laydate5").siblings(".dateInterval").children(".laydateInput").attr("disabled",false);
    		$("#income_line_searchBtn").show();  
    	}
     }
	
})


// ???????????????????????????????????????????????????
function drawLine(id,lineObj){
	var echartsLine = echarts.init(document.getElementById(id));
 	echartsLine.setOption({
	    tooltip: {
	        trigger: 'axis',
	        axisPointer: {
	           //type:'none'?????????????????????
		    },
	        //????????????????????????
			formatter:function(a){
				return a[0].seriesName+'<br/>'+lineObj.year+'.'+a[0].name+':'+a[0].data;
			}
	    },
	    grid: {
	        left: '4%',
	        right: '4%',
	        bottom: '2%',
	        containLabel: true
	    },
	    //animation: false,
	   	hoverAnimation:true,
		
	    xAxis: {
	        type: 'category',
	        boundaryGap: false,
	        data: lineObj.data_num,
	        
	    },
	    yAxis: {
	        type: 'value',
	        axisLine: {show: false},
		    axisTick: {
				show: false
			},
	    },
	    series: [
	        {
	            name:lineObj.name,
	            type:'line',
	            //symbol: 'none',  //??????????????????
	            areaStyle: {
	            	normal: {
                        color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1,
                                [
                                    {offset: 0, color: '#FFA4A4'},
                                    {offset: 1, color: '#fff'}
                                ]
                        )
                	}
	            },
	            itemStyle: {
			        normal: {
			            color: "#ff7577",
			            borderWidth:3,
			            lineStyle: {
			            	 
			                color: "#ffbdbe"
			            }
			        }
			    },
			    symbolSize:7, //??????????????????
			    showSymbol:false,
	            data:lineObj.data_date
	        }
	    ]
	});
}
function drawPie(id,pieObj){
    // ???????????????????????????????????????????????????
    var echartsPie = echarts.init(document.getElementById(id));
     echartsPie.setOption({
    	animation: false,
	    series: [
	        {
	            name:'????????????',
	            type:'pie',
	            radius: ['40%', '55%'],
	            hoverAnimation:false,
	            label: {
	                normal: {
	                    formatter: '{b}??? {c},{d}%  ',
	                }
	            },
	            data:pieObj,
	            itemStyle: {
                   
                    normal:{
                       /* color:function(params) {
                        //???????????????
                        var colorList = [          
                            	'#ffd2d2', '#ff9ab8','#ffda97'
                            ];
                            return colorList[params.dataIndex]
                         }*/
                    }
              	}
	        }
	    ]
	});
}
function drawColumn(id,columnObj){
	var echartsLine = echarts.init(document.getElementById(id));
	echartsLine.setOption({
????????????	tooltip: {
	????????????	trigger: 'item', 
			formatter:function(data){
				return data.name+'<br/>'+data.seriesName+':'+data.value;
			}
	?????? 	},
	 	grid: {
	        left: '0%',
	        right: '0%',
	        bottom: '2%',
	        containLabel: true
	    },
	??????	xAxis : [
	????????????	{
	??????????????????	type : 'category',
	??????????????????	data : columnObj.data_num
	????????????	}
	??????	],
	??????	yAxis : [
	????????????	{
	??????????????????	type : 'value',
	 			axisLine: {show: false},
				axisTick: {
					show: false
				},
	????????????	}
	??????	],
	??????	series : [{
			name:"??????",
			type:"bar",
			data:columnObj.data_date,
			roam: true,
			itemStyle: {
    			normal: {
    				color:'#ffd2d2'
    			}
    		}
	??????	}]
	})
}
function drawMap(id,max,min,MapObj){
	var max=max,
		min=min
	var echartsLine = echarts.init(document.getElementById(id));
	echartsLine.setOption({
		tooltip : {
	        trigger: 'item',
	        formatter:'{b}<br/>{c}'
	    },
	    visualMap: {
	        min: min,
	        max: max,
         	orient:"horizontal", 
	        left: 'center',
	        top: 'bottom',
	        text:[max,min],           // ??????????????????????????????
	        calculable : false,
	        itemHeight:200,
         	inRange: {
                color: ['#F75833','#FFD2D2']
            }
	    },
	   
	    series : [
	        {
	            type: 'map',
	            mapType: 'china',
	            roam: true,//???????????????
	            itemStyle: {
					normal: {
						label: {
							show: false,
						},
						areaStyle: {
							color: '#031525'
						}, //???????????????????????????????????? 
						color: '#B1D0EC',
						borderColor: '#fff' //?????????????????????
					},
					emphasis: {
						label: {
							show: false,
							
						},
						areaColor:"#B1D0EC"
					}
				},
	            data:[
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '?????????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '?????????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '??????',value: Math.round(Math.random()*1000)},
	                {name: '????????????',value: Math.round(Math.random()*1000)}
	            ]
	        }
	    ]
	})
}