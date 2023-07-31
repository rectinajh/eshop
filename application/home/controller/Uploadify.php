<?php
/**
 * 新淘链商城
 * ============================================================================
 * * 版权所有 2015-2027 新淘链，并保留所有权利。
 * 网站地址: 
 * ----------------------------------------------------------------------------
 * 这是一个商业软件，您必须购买授权才能使用.
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 请支持正版, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 新淘链
 */ 
namespace app\home\controller;

class Uploadify extends Base {

	public function upload(){
		$func = I('func');
		$path = I('path','temp');
		$info = array(
				'num'=> I('num/d'),
				'title' => '',
				'upload' =>U('Admin/Ueditor/imageUp',array('savepath'=>$path,'pictitle'=>'banner','dir'=>'images')),
        		'fileList'=>U('Admin/Uploadify/fileList',array('path'=>$path)),
				'size' => '4M',
				'type' =>'jpg,png,gif,jpeg',
				'input' => I('input'),
				'func' => empty($func) ? 'undefined' : $func,
		);
		$this->assign('info',$info);
		return $this->fetch();
	}
	
	/*
	 删除上传的图片
	*/
	public function delupload(){
		$action= isset($_GET['action']) ? $_GET['action'] : 'del';
		$filename= isset($_GET['filename']) ? $_GET['filename'] : I('url');
		$filename= str_replace('../','',$filename);
		$filename= trim($filename,'.');
		$filename= trim($filename,'/');
		if($action=='del' && !empty($filename)){
			$size = getimagesize($filename);
			$filetype = explode('/',$size['mime']);
			if($filetype[0]!='image'){
				return false;
				exit;
			}
			unlink($filename);
			exit;
		}
	}    
}