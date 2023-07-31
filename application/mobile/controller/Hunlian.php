<?php
namespace app\mobile\controller;
use app\common\logic\GoodsLogic;

use app\common\logic\ReplyLogic;

use app\common\logic\GoodsPromFactory;



use app\common\model\SpecGoodsPrice;

use think\AjaxPage;

use think\Page;

use think\Db;


class Hunlian extends MobileBase {

	public function _initialize()
	
	{
	
		parent::_initialize();
	
		if (session('?user')) {
	
			$user = session('user');
	
			$user = M('users')->where("user_id",$user['user_id'])->find();
	
			session('user', $user);  //覆盖session 中的 user
	
			$this->user = $user;
	
			$this->user_id = $user['user_id'];
	
			$this->assign('user', $user); //存储用户信息
	
		}
	
		$nologin = array(
	
				'login', 'pop_login', 'do_login', 'logout', 'verify', 'set_pwd', 'finished',
	
				'verifyHandle', 'reg', 'send_sms_reg_code', 'find_pwd', 'check_validate_code',
	
				'forget_pwd', 'check_captcha', 'check_username', 'send_validate_code', 'express',
	
		);
	
		if (!$this->user_id && !in_array(ACTION_NAME, $nologin)) {
	
			header("location:" . U('Mobile/User/login'));
	
			exit;
	
		}
	
	}

    /*
     * 订单列表
     */
    public function mobileHome(){//首页调取
        $user = session('user');
       
        $user = M('users')->where("user_id", $user['user_id'])->find();
        $uuser=M("shiming")->where("userid",$user['user_id'])->find();
        if($uuser){
            $puser=M("loves")->where("userid",$user['user_id'])->find();
            if($puser){
                $shiming=2;
            }else{
                $shiming=3;
            }
        }else{
            $shiming=1;
        }
        $images=M("loves")->where(array("ishot"=>2,"isout"=>2,'sex'=>1))->order("sort asc")->limit(6)->select();//人气男神
        $images2=M("loves")->where(array("ishot"=>2,"isout"=>2,'sex'=>2))->order("sort asc")->limit(6)->select();//人气女神
        //首页icon
        $icon=1;
        $this->assign('icon',$icon);
        $this->assign("images2",$images2);
        $this->assign("shiming",$shiming);
        $this->assign("images",$images);
        return $this->fetch();
    }
    public function huoqu(){//购买用户联系方式
        $id=$_GET["id"];
        $user = session('user');
        $user = M('users')->where("user_id", $user['user_id'])->find();
        $info=M('loves')->where("id={$id}")->find();
        $mobile=$info['mobile'];
        if($mobile==''){
        	echo 4;
        }else if($user["pay_points"] >= 100){
            $jian=M("users")->where("user_id", $user['user_id'])->setDec("pay_points",100);
            if($jian){
                $data["userid"]=$user["user_id"];
                $data["lovesid"]=$id;
                $data["addtime"]=date("Y-m-d H:i:s",time());
                $add=M("uloves")->add($data);
                if($add){
                    echo 1;
                }else{
                    echo 2;
                }
            }
        }else{
            echo 3;
        }
    }
    public function xindong(){
        $user = session('user');
        $suoyou=M("uloves")->where(array("userid"=>$user["user_id"]))->select();
        foreach($suoyou as $k=>$v){
            $images[$k]=M("loves")->where(array("id"=>$v["lovesid"],"isout"=>2))->find();
        }
        $this->assign("images",$images);
        return $this->fetch(); 
    }
    public function mobileImMan(){//我是男生
    	$user = session('user');
        $pany_count = DB::name('loves')->where(array("sex"=>1,"isout"=>2))->order('sort asc')->count();
        $page = new Page($pany_count, 12);
        $show = $page->show();
        $pany_list = DB::name('loves')
        ->where(array("sex"=>1,"isout"=>2))
        ->order('sort asc')
        ->limit($page->firstRow, $page->listRows)
        ->select();
        
        foreach ($pany_list as $key=>$val){
            $info2=M("uloves")->where(array("lovesid"=>$val["id"],'userid'=>$user['user_id']))->find();
        	if($info2){
        		$pany_list[$key]['a']=1;
        	}else{
                $pany_list[$key]['a']=2;
            }
        }

        $this->assign('list', $pany_list);
        $this->assign('page', $show);
        $this->assign('pager', $page);
        if($pany_list){
        	if ($_GET['is_ajax']) {
        		return $this->fetch('ajax_mobileImMan');
        	}
        }else{
        	$this->ajaxReturn(1);
        }
       
        $info=M("shiming")->where(array("userid"=>$user["user_id"]))->find();
        $sex=$info['sex'];
        $this->assign('sex',$sex);
        return $this->fetch();
    }
    public function mobileImGirl(){//我是女生
        $user = session('user');
        $pany_count = DB::name('loves')->where(array("sex"=>2,"isout"=>2))->order('sort asc')->count();
        $page = new Page($pany_count, 12);
        $show = $page->show();
        $pany_list = DB::name('loves')
        ->where(array("sex"=>2,"isout"=>2))
        ->order('sort asc')
        ->limit($page->firstRow, $page->listRows)
        ->select();
        $info2=M("uloves")->where(array("userid"=>$user["user_id"]))->select();
        foreach ($pany_list as $key=>$val){
        	$info2=M("uloves")->where(array("lovesid"=>$val["id"],'userid'=>$user['user_id']))->find();
            if($info2){
                $pany_list[$key]['a']=1;
            }else{
                $pany_list[$key]['a']=2;
            }
        }
        $this->assign('list', $pany_list);
        $this->assign('page', $show);
        $this->assign('pager', $page);
        if($pany_list){
        	if ($_GET['is_ajax']) {
        		return $this->fetch('ajax_mobileImGirl');
        	}
        }else{
        	$this->ajaxReturn(1);
        }
       
        $info=M("shiming")->where(array("userid"=>$user["user_id"]))->find();
        $sex=$info['sex'];
        $this->assign('sex',$sex);
        return $this->fetch();
    }
    public function topic(){//新闻列表
        return $this->fetch();
    }
    public function mobileViews(){//个人详情
        $id=$_GET["id"];
        $user = session('user');
        
        $suoyou=M("users")->where(array("user_id"=>$user["user_id"]))->find();
        //查询是否实名认证
        $shiming=M('shiming')->where(array("userid"=>$user["user_id"]))->find();
        if($shiming){
        	$queding=M("uloves")->where(array("userid"=>$suoyou["user_id"],"lovesid"=>$id))->find();
        	if($queding){
        		$yimai=1;
        	}else{
        		$yimai=2;
        	}
        	$image=M("loves")->where(array("id"=>$id))->find();
        	$info=M("shiming")->where(array("userid"=>$user["user_id"]))->find();
        	$sex=$info['sex'];
        	
        	$this->assign('sex',$sex);
        	$this->assign('yimai',$yimai);
        	$this->assign("image",$image);
        	return $this->fetch();
        }else{
        	
        	$this->error('请先实名认证',U('Mobile/Hunlian/getrenzheng'));
        }
       
       
    }
    public function mobileUpload(){//个人资料
        $user = session('user');
        $user = M('users')->where("user_id", $user['user_id'])->find();
        $uuser=M("loves")->where("userid",$user['user_id'])->find();
        $uusers=M("shiming")->where("userid",$user['user_id'])->find();
        if($uusers){
            $this->assign("uusers",$uusers);
            if($uuser){
                $this->assign("uuser",$uuser);
            }
        }
       
        return $this->fetch();
    }
    /**
     * 获取文件的扩展名
     * @param unknown $file
     * @return mixed
     */
    function getimg($path,$url){
    
    	$aext = explode('.', $url);
    	$ext = end($aext);
    
    	$name = $path.'/'. time() . '.' . $ext;
    	$source=file_get_contents($url);
    	file_put_contents($name,$source);
    	return $name;
    }
  /**
   * 资料上传
   */
    public function uploads(){
        $user = session('user');
         $user = M('users')->where("user_id", $user['user_id'])->find();
        $uuser=M("shiming")->where("userid",$user['user_id'])->find();
        if($uuser){
            $uusers=M("loves")->where("userid",$user['user_id'])->find();
            if($uusers){
                $add=M("loves")->where("userid",$user['user_id'])->save($_POST);
            }else{
                $_POST["name"]=$uuser["name"];
                $_POST["identitynum"]=$uuser["identitynum"];
                $_POST["sex"]=$uuser["sex"];
                $_POST["userid"]=$uuser["userid"];
                $_POST['age']=$uuser['age'];
                $add=M("loves")->add($_POST); 
            }
            if($add){
                echo 1;
            }else{
                echo 2;
            }
        }else{
            echo "请先进行实名认证，再上传资料";
        } 
    }
    public function is_idcard($id) //验证身份证信息
            { 
              $id = strtoupper($id); 
              $regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/"; 
              $arr_split = array(); 
              if(!preg_match($regx, $id)) 
              { 
                return FALSE; 
              } 
              if(15==strlen($id)) //检查15位 
              { 
                $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/"; 
              
                @preg_match($regx, $id, $arr_split); 
                //检查生日日期是否正确 
                $dtm_birth = "19".$arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4]; 
                if(!strtotime($dtm_birth)) 
                { 
                  return FALSE; 
                } else { 
                  return TRUE; 
                } 
              } 
              else      //检查18位 
              { 
                $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/"; 
                @preg_match($regx, $id, $arr_split); 
                $dtm_birth = $arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4]; 
                if(!strtotime($dtm_birth)) //检查生日日期是否正确 
                { 
                  return FALSE; 
                } 
                else
                { 
                  //检验18位身份证的校验码是否正确。 
                  //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。 
                  $arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2); 
                  $arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'); 
                  $sign = 0; 
                  for ( $i = 0; $i < 17; $i++ ) 
                  { 
                    $b = (int) $id{$i}; 
                    $w = $arr_int[$i]; 
                    $sign += $b * $w; 
                  } 
                  $n = $sign % 11; 
                  $val_num = $arr_ch[$n]; 
                  if ($val_num != substr($id,17, 1)) 
                  { 
                    return FALSE; 
                  } //phpfensi.com 
                  else
                  { 
                    return TRUE; 
                  } 
                } 
              } 
            } 
  
  /**
   * 实名认证
   */
   
    public function getrenzheng(){
    	if($_POST){
    		$num=$_POST["num"];
    		$date=strtotime(substr($num,6,8));//获得出生年月日的时间戳
    		$today=time();//获得今日的时间戳
    		$diff=floor(($today-$date)/86400/365);//得到两个日期相差的大体年数
    		//strtotime加上这个年数后得到那日的时间戳后与今日的时间戳相比
    		$age=strtotime(substr($num,6,8).' +'.$diff.'years')>$today?($diff+1):$diff;
    		$name=$_POST["name"];
    		$true=$this->is_idcard($num);
    		if($true){
    			$user = session('user');
    			$user = M('users')->where("user_id", $user['user_id'])->find();
    			$uuser=M("shiming")->where("userid",$user['user_id'])->find();
    			$ppser=M("shiming")->where("identitynum",$num)->find();
    			if($uuser || $ppser){
    				echo 4;
    			}else{
    				$length=strlen($num);
    				if($length == 15){
    					$sexs=substr($num, 14,1);
    					if($sexs%2 == 1){
    						$data["sex"]=1;
    					}else{
    						$data["sex"]=2;
    					}
    				}else{
    					$sexs=substr($num, 16,1);
    					if($sexs % 2 != 0){
    						$data["sex"]=1;
    					}else{
    						$data["sex"]=2;
    					}
    				}
    				$data["userid"]=$user["user_id"];
    				$data["name"]=$name;
    				$data["identitynum"]=$num;
    				$data['age']=$age;
    				$add=M('shiming')->add($data);
    				if($add){
    					echo 1;
    				}else{
    					echo 2;
    				}
    			}
    		}else{
    			echo 3;
    		}
    	}else{
    		$user = session('user');
    		$user = M('users')->where("user_id", $user['user_id'])->find();
    		$uuser=M("shiming")->where("userid",$user['user_id'])->find();
    		if($uuser){
    			$this->assign("user",$uuser);
    		}
    		return $this->fetch();
    	}
    }
    /**
     * 搜索查询
     */
    public function look(){
    	$search=I('search');
    	
    	$where['name']=array('like',"%{$search}%");//写查询条件
    	
    	$re=M('loves')->where($where)->find();
    	$id=$re['id'];
    	$this->ajaxReturn(['status'=>1,'id'=>$id]);
    	 if($re){
    		$this->ajaxReturn(['status'=>1,'id'=>$id]);
    	}else{
    		$this->ajaxReturn(['status'=>0]);
    	}  
    }
    public function mobileMyCenter(){
        $user = session('user');
        $row = M('loves')->where("userid", $user['user_id'])->find();
        //查询人气推荐
        if($row['sex']==1){
        	$where=" sex=2 ";
        }else{
        	$where=" sex=1 ";
        }
        $where.=" and ishot=2 and isout=2";
        $tuijian=M('loves')->where($where)->order("sort asc")->limit(0,8)->select();
        $this->assign('tuijian',$tuijian);
        $this->assign('row',$row);
        return $this->fetch();
    }
    public function mobileSelect(){
        //猜你喜欢
        $user = session('user');
        $row = M('loves')->where("userid", $user['user_id'])->find();
        if(IS_POST){
            //查询

            $year=$_POST['year'];
            $years=$_POST['years'];
            $height=$_POST['height'];
            $heights=$_POST['heights'];
            $gain=$_POST['gain'];
            $is_marry=$_POST['is_marry'];
            $sexs=$_POST['sex'];
            $strs="select * from tp_loves where 1=1 ";
            $condition="";
            if($sexs){
                $condition.=" and sex='{$sexs}'";
            }
            if($year && !$years){
                $condition.=" and age='{$year}'";
            }elseif($year && $year){
                $condition.=" and age>'{$year}' and age<'{$years}'";
            }elseif(!$year && $years){
                $condition.=" and age='{$years}'";
            }
            if($height && !$heights){
                $condition.=" and height>'{$height}'";
            }elseif($height && $heights){
                $condition.=" and height>'{$height}' and height<'{$heights}'";
            }elseif(!$height && $heights){
                $condition.=" and height='{$heights}'";
            }
            if($gain){
                 $condition.=" and gain>='{$gain}'";
            }
            if($is_marry){
                $condition.=" and is_marry='{$is_marry}'";
                
            }
            $condition.=" order by sort asc limit 0,200";
            $cond=$strs.$condition;
            //$searchCount=M('loves')->query($cond);

            //$pany_count=count($searchList);

            //$page = new Page($pany_count, 12);
            //$show = $page->show();

            $searchList =M('loves')->query($cond);

            if($searchList){
                $list='';
                foreach ($searchList as $k => $v) {
                    $list.="<li>";
                    $list.="<a href='mobileViews?id=".$v['id']."'>";
                    $list.="<img src=".$v['image1'].">";
                    $list.="<p><span>".$v['age']."</span>岁/<span>".$v['height']."</span>cm</p>";
                    $list.="</a>";
                    $list.="</li>";
                }
                echo $list;
            }else{
                echo 1;
            }
            
        }else{
	        if($row['sex']==1){
	                $num=M('loves')->where("isout=2 and sex=2")->count();
	            }else{
	                $num=M('loves')->where("isout=2 and sex=1")->count();
	            }
	            $nums=$num-4;  
	            if($nums<=0){
	                $numss=0;
	            }else{
	                $numss=rand(1,$nums);
	            }
	            if($row['sex']==1){
	
	                $cai=M('loves')->where("isout=2 and sex=2")->limit($numss,4)->select();
	            }else{
	                 $a=rand();
	                $cai=M('loves')->where("isout=2 and sex=1")->limit($numss,4)->select();
	            }
	            $this->assign('cai',$cai);
	            return $this->fetch();
        }
        

        
        
    }

    /**
     * 上传个人照片
     */
 	public function mobileMyPhoto(){
    	$user = session('user');
    	$row = M('loves')->where("userid", $user['user_id'])->find();
    	$this->assign('row',$row);
    	return $this->fetch();
    }
    /**
     * 更多人气男
     */
    public function moreman(){
    	$pany_count = DB::name('loves')->where(array("ishot"=>2,"isout"=>2,'sex'=>1))->order('sort asc')->count();
    	$page = new Page($pany_count,12);
    	$show = $page->show();
    	$pany_list = DB::name('loves')
    	->where(array("ishot"=>2,"isout"=>2,'sex'=>1))
    	->order('sort asc')
    	->limit($page->firstRow, $page->listRows)
    	->select();
    	$this->assign('list', $pany_list);
    	$this->assign('page', $show);
    	$this->assign('pager', $page);
    	if($pany_list){
    		if ($_GET['is_ajax']) {
    			return $this->fetch('ajax_moreman');
    		}
    	}else{
    		$this->ajaxReturn(1);
    	}
    	return $this->fetch();
    	return $this->fetch();
    }
    /**
     * 更多人气女
     */
    public function moregirl(){
    	
    	
    	$pany_count = DB::name('loves')->where(array("ishot"=>2,"isout"=>2,'sex'=>2))->order('sort asc')->count();
    	$page = new Page($pany_count, 12);
    	$show = $page->show();
    	$pany_list = DB::name('loves')
    	->where(array("ishot"=>2,"isout"=>2,'sex'=>2))
    	->order('sort asc')
    	->limit($page->firstRow, $page->listRows)
    	->select();
    	$this->assign('list', $pany_list);
    	$this->assign('page', $show);
    	$this->assign('pager', $page);
    	if($pany_list){
    		if ($_GET['is_ajax']) {
    			return $this->fetch('ajax_moregirl');
    		}
    	}else{
    		$this->ajaxReturn(1);
    	}
    	return $this->fetch();
    }
    /*
    更新信息
     */
    public function mobileMyMsg(){
        $user=session('user');
        $userid=$user['user_id'];

        if(IS_POST){
            
            $data['name']=$_POST['name'];
            $data['brithday']=$_POST['brithday'];
            $data['gain'] =$_POST['gain'];
            $data['height']=$_POST['height'];
            $data['workstatus']=$_POST['workstatus'];
            $data['explain']=$_POST['explain'];
            $data['record']=$_POST['record'];
            $rs=M("loves")->where("userid='{$userid}'")->save($data);
            if($rs){
                echo 1;
            }else{
                echo 2;
            }
        }else{
            $users=M('loves')->where("userid='{$userid}'")->find();
            $this->assign('user',$users);
            return $this->fetch();
       }
    }
}