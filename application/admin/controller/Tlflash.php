<?php 
namespace app\admin\controller;

use think\Db;
use think\Page;
class Tlflash extends Base{
	public function index(){
		return $this->fetch();
	}

	public function tllist(){
		$p = empty($_REQUEST['p']) ? 1 : $_REQUEST['p'];

        $size = empty($_REQUEST['size']) ? 20 : $_REQUEST['size'];

		$flash=M('tlflash')->order('addtime desc')->page("$p,$size")->select();
		$count = M('tlflash')->count();// 查询满足要求的总记录数
		$page=new Page($count,$size);
		$this->assign('pager',$page);
		$this->assign('flash',$flash);
		return $this->fetch();
	}

	public function add_flash(){
		$id=$_GET['id'];
		if($id){
			$flash=M('tlflash')->where("id=$id")->find();
			$this->assign('flash',$flash);
			return $this->fetch();
		}else{
			if(IS_POST){
				$data=I('post.');
				$data['addtime']=time();
				if($data['id']){
					$rs=M('tlflash')->where(array('id'=>$data['id']))->save($data);
				}else{
					$rs=M('tlflash')->add($data);
				}
				
				if($rs){
					echo 1;
				}else{
					echo 2;
				}
			}else{
			    return $this->fetch();
			}
				
		}
		
	}

	public function del_flash(){
		if(IS_POST){
			$id=I('id');
			if($id){
				$rs=M('tlflash')->where("id=$id")->delete();
				if($rs){
					echo 1;
				}else{
					echo 2;
				}
			}else{
				echo 3;
			}
		}
	}
	
	public function changetlTableVal(){  

            $table = 'tlflash'; // 表名

            $id_name = I('id'); // 表主键id名

            $id_value = I('id_value'); // 表主键id值

            $field  = I('field'); // 修改哪个字段

            $value  = I('value'); // 修改字段值                        

            M($table)->where("$id = $id_value")->save(array($field=>$value)); // 根据条件保存修改的数据

    }
	
}