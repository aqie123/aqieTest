
<?php 
$code = "0000";
$code = intval($code);
//$code = (int)$code;
//var_dump(empty($code)) ;
  error_reporting(0);
  session_start();
  $ip = $_SERVER["REMOTE_ADDR"];
  echo $ip ;
  $myip = "127.0.0.1";
  if($ip==$myip){
  	// echo "yes";
  	$_SESSION['isok']='ok4';
  }else{
  	echo "<script>location.href = 'https://aqie123.github.io/Tetris/'</script>";
    exit;
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>欢迎</title>
	<link href="bootstrap/public/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="bootstrap/public/css/bootstrap.min.black.css">
	<script src="Vue/vue1.0/dist/vue.js"></script>
	<script src="Vue/learn/vue-resource.js"></script>
	<style>
	    body{
	    	color: rgb(245, 50, 50);
	    }
		table{
			margin:30px auto;
			text-align: center;
			position: fixed;
			top:110px;
			left:300px;

		}
		table td{
			display: inline-block;
			line-height: 50px;
			color:green;
		}
		table .btn{
			width:90px;
		}
		.mark{
			font-weight: bold;
			color: rgb(93, 28, 28);
		}
		.btn-danger {
		    color: rgb(255, 221, 44);
		    background-color: #ee5f5b;
		    border-color: #ee5f5b;
		}
		h1{
			text-align: center;
		}
		.gray{
			background-color: #918585;
		}
		ul{
			position: relative;
			margin-left: -40px;
		}
		li{
			width:250px;
			height: 30px;
			line-height: 30px;
			text-align: center;
			list-style: none;

		}

	</style>
</head>
<body>
	<h1>啊切</h1>

    <!-- 百度下拉菜单 -->
		<input type="text" name="" v-model="t1" @keyup="jsonp3($event)" @keydown.down="changeDown()" @keydown.up.prevent="changeUp()">
		<button @click="search()" class="btn">啊切一下</button>
		<!-- <input type="text" name="" class="weblink" placeholder="请输入网址">
    <input type="text" class="webname" placeholder="请输入网址名称"> -->
    <!-- <button class="btn mark"> 提交网址</button>  -->
        <!-- 数据展示 -->
		<ul>
			<li v-for="value in myData" :class="{gray:$index==now}">
				{{value}}
			</li>
			<p v-show="myData.length==0">暂无数据</p>
		</ul>
		<!-- 百度下拉菜单 -->
		
		<!-- 有道翻译 开始-->
		<input type="text" name="" v-model="t1"><button @click="search2()" class="btn">有道一下</button>
		<!-- 有道翻译结束 -->
			<br>
		<!-- 360搜索开始 -->
		<!-- <input type="text" name="" v-model="t1"><button @click="search3()">360一下</button> -->
		<!-- 360搜索结束 -->
		<br>
		<!-- 谷歌搜索开始 -->
		<input type="text" name="" v-model="t1" ><button @click="search4()" class="btn">Google一下</button>
		<!-- 谷歌搜索结束 -->
		<br>
		<br>
		<!-- 百度搜索开始 -->
		<input type="text" name="" v-model="t1" ><button @click="search5()" class="btn">百度云一下</button>
		<!-- 百度搜索结束 -->
    <script src="public/js/libs/jquery-3.1.1.min.js"></script>
    <script src="public/js/libs/bootstrap.min.js"></script>
		<script type="text/javascript">


		// document.write("<hr  color='red'/>");
		var k=a=b=c=0;
		var link= new Array(81);
		var linkname =new Array(81);
		length = linkname.length;
		
		// linkname[5]=linkname[5]===undefined?"aqie":linkname[5];		
		//开始手写
		link[0] = "http://www.500d.me/resume/aqie/";
		linkname[0] = "aqie";
		link[1] = "http://www.aqie.com/html5/Gomoku.html";
		linkname[1] = "五子棋";
		link[2] = "http://www.aqie.com/html5/tetris.html";
		linkname[2] = "Tetris";
		link[3] = "http://www.gits.com/games/breakbricks/index.html";
		linkname[3] = "打方块";
		link[4] = "http://www.gits.com/jq-drag/drag.html";
		linkname[4] = "拖拽排序";
		link[5] = "http://www.aqie.com/Response/src/index.html";
		linkname[5] = "响应式页面";
		link[6] = "http://www.aqie.net/jd/index.html";
		linkname[6] = "京东首页";
		link[7] = "http://www.aqie.com/webapp/";
		linkname[7] = "readapp";


		link[9] = "http://localhost:8080/#!/goods";
		linkname[9] = "Vue饿了吗";
		link[10] = "http://www.aqie.com/vue2/index.html";
		linkname[10] = "Vue2购物车";
		

		link[18] ="http://aqieframe.com/index.php?p=admin";
		linkname[18] ="aqieframe";
		link[19] ="http://www.tp.com/admin.php?c=login";
		linkname[19] ="aqiecms";
		link[20] ="http://www.yii2.com/";
		linkname[20] ="yii2shop";
		link[21] ="http://www.tp5shop.com/index/index/index";
		linkname[21] ="tp5shop";
		link[22] ="http://www.tp5blog.com";
		linkname[22] ="tp5练习";
		link[23] ="http://www.app.com";
		linkname[23] ="接口测试";
		link[24] ="http://z.cn/api/v1/banner/1";
		linkname[24] ="小程序";


		link[25] ="http://www.aqie.com/phpmyadmin";
		linkname[25] ="myadmin";
		link[26] ="http://www.aqie.com/php/aqie/databases.php";
		linkname[26] ="mysql";
		link[27] ="http://www.crawler.com";
		linkname[27] ="crawler";
		link[28] ="https://aqie.localtunnel.me/index/index/http_curl";
		linkname[28] ="微信公众号开发";
	
	

		
		linkname[36]="yii2中文网";
		link[36]="http://www.yiichina.com/doc/api/2.0";
		linkname[37]="php官网";
		link[37]="http://php.net/";
		linkname[38]="php规范";
		link[38]="https://psr.phphub.org/";
		linkname[39]="tp5";
		link[39]="http://www.thinkphp.cn/";
		linkname[40]="v2ex";
		link[40]="https://www.v2ex.com/go/php";
		linkname[41]="微信小程序";
		link[41]="https://mp.weixin.qq.com/debug/wxadoc/dev/index.html?t=201758";
		linkname[41]="微信文档";
		link[41]="https://mp.weixin.qq.com/wiki";

		

		

		


	
		linkname[54]="文章2";
		link[54]="http://www.aqie.com/php/article2/login.php";
		linkname[55]="豆瓣API";
		link[55]="https://developers.douban.com/wiki/?title=api_v2";

		linkname[63]="github";
		link[63]="https://github.com/";
		linkname[64]="job";
    link[64]="http://www.job.com";
    linkname[65]="慕课";
		link[65]="http://coding.imooc.com/";
		linkname[66]="知乎";
		link[66]="https://www.zhihu.com/";
		linkname[67]="TED";
		link[67]="https://www.ted.com/";
		linkname[68]="TED";
		link[68]="https://open.163.com/ted/";

		linkname[72]="王垠";
		link[72]="http://www.yinwang.org/";
		linkname[73]="七月";
		link[73]="https://zhuanlan.zhihu.com/oldtimes";
		

		
		
		
		
		
		
		


		//循环打出表格
		document.write('<table border="1"cellpadding="0" bgcolor="#eee" width="812px" height="450px"> ');
		for(var i=1;i<=9;i++){
			document.write("<tr>");
			for(var j=1;j<=9;j++){
				linkname[k]=linkname[k]===undefined?"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;":linkname[k];

			document.write("<td width='90px' height='50px'><a href='"+link[k]+"'target='_blank' class="+k+"><button class='btn btn-danger "+k+"'>"+linkname[k]+"</button></a></td>");
			k++;

		}
		document.write("</tr>");
		}
		document.write("</table>")
        // alert($)
        //向表格添加网址
        // var $elements = $('')
        		$(".mark").click(function(){
					
					var webname = $(".webname").val();
					var weblink = $(".weblink").val();
        			// alert(webname);
					for(var a=0;a<length;a++){
						if(linkname[a]==="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"){
							// alert(a); a=3现在

							// linkname[a]=webname;
							// alert(linkname[a]);
							// alert(linkname[2]);
							if(webname==''){
								$(".btn-danger").eq(a).text("新网址");
							}else{
								$(".btn-danger").eq(a).text(webname);
							}
							
							// $(".btn-danger").parents("a:eq(a)").attr("href",weblink);
							$(".btn-danger").eq(a).parent().attr("href",weblink);
							 break;
						}
					}
				});

     new Vue({
			el:'body',		
			data:{
				msg:'aqie',
				myData:[],
				t1:'',
				now:-1
				
			},
			json:{

			},
			methods:{
				jsonp:function(ev){			// 谷歌获取数据
					this.$http.jsonp('https://www.google.com/complete/search',{
						q:'javascript'
					},{
						jsonp:'xhr'				//callback名字
					}).then(function(res){
						alert(res.data.s)
					},function(res){
						alert(res.status)
					});

				},
				jsonp1:function(ev){			// 有道获取数据
					this.$http.jsonp('http://dsuggest.ydstatic.com/suggest.s',{
						wd:'javascript'
					},{
						jsonp:'cb'				//callback名字
					}).then(function(res){
						alert(res.data.s)
					},function(res){
						alert(res.status)
					});

				},
				jsonp2:function(ev){			// 360获取关键字
					this.$http.jsonp('https://sp0.baidu.com/5a1Fazu8AA54nxGko9WTAnF6hhy/su',{
						wd:'javascript'
					},{
						jsonp:'cb'				//callback名字
					}).then(function(res){
						alert(res.data.s)
					},function(res){
						alert(res.status)
					});

				},
				jsonp3:function(ev){			// 百度获取关键字
					if(ev.keyCode==38 ||ev.keyCode==40){    //按上下键，不再接收数据
						return
					};
					if(ev.keyCode==13){						//按回车进行搜索
						window.open('https://www.baidu.com/s?wd='+this.t1);
						this.t1='';
					}

					this.$http.jsonp('https://sp0.baidu.com/5a1Fazu8AA54nxGko9WTAnF6hhy/su',{
						wd:this.t1
					},{
						jsonp:'cb'				//callback名字
					}).then(function(res){
						this.myData=res.data.s
					},function(res){
						alert(res.status)
					});

				},
				changeDown:function(){
					this.now++;
					this.now %= this.myData.length;
					this.t1=this.myData[this.now];
				},
				changeUp:function(){
					this.now--;
					// alert(this.myData.length)   //10					
					if(this.now<0){
						this.now=this.now+this.myData.length;
						this.t1=this.myData[this.now];
					}
					// console.log(this.now)
				},
				search:function(){		// 百度搜索
					// alert(this.myData.length) 
					
					window.open('https://www.baidu.com/s?wd='+this.t1);
					this.t1='';
					this.myData=[];

				},
				search2:function(){		// 有道搜索
					window.open('http://www.youdao.com/w/eng/'+this.t1+'/#keyfrom=dict2.index');
				},
				search4:function(){		// 谷歌搜索
					window.open('https://www.google.com/#q='+this.t1+'&*');
				},
				search5:function(){		// 百度搜索
					window.open('http://baiduyun.57fx.cn/so-result.html?keyword='+this.t1);
				},
			},

		})

     console.log(({}+{}).length);
	</script>
</body>
</html>