<?php
/**
 *语音回复
**/
class VoiceresponseAction extends UserAction{
	public function index(){
		$where['uid']=session('uid');
		$where['token']=session('token');
		$res=M('Voiceresponse')->where($where)->select();
		$this->assign('info',$res);
		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function edit(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		$where['token']=session('token');
		$res=D('Voiceresponse')->where($where)->find();
		$this->assign('info',$res);
		$this->display();
	}
	public function del(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		if(D(MODULE_NAME)->where($where)->delete()){
			$this->success('操作成功',U(MODULE_NAME.'/index'));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/index'));
		}
	}
	public function imports($data){
	  
	  
	 // require_once( CORE."./Classes/PHPExcel/IOFactory.php"); 
	  require_once( CORE."./Classes/PHPExcel.php"); 
	  $inputFileType = 'Excel5';   
         	  
	  $inputFileName = CVS_ROOT."/Data/upload/".$data[0]['savename'];
	  if(!file_exists($inputFileName)) $this->errors('导入文件不存在!');
          $result = file_get_contents($inputFileName);
	  
	  if(stristr($result,"encoding=")) $this->errors('导入文件格式错误!');
	  
          $phpexcel = new PHPExcel();  
  
 
         $objPHPExcel = PHPExcel_IOFactory::createReader($inputFileType)->load($inputFileName); 
	 
  
         $objWorksheet = $objPHPExcel->getActiveSheet();//取得总行数 
         $highestRow = $objWorksheet->getHighestRow();//取得总列数 
          $uid = session('uid');	
	$token = session('token');	
        $addtime = time();
        $highestColumn = $objWorksheet->getHighestColumn(); 
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);//总列数 
        
        $headtitle=array(); 
        for ($row = 2;$row <= $highestRow;$row++) 
        { 
            $strs=array(); 
            //注意highestColumnIndex的列数索引从0开始 
            for ($col = 0;$col < $highestColumnIndex;$col++) 
            {  
                $strs[$col] =$objWorksheet->getCellByColumnAndRow($col, $row)->getValue(); 
		$strs[$col] = addslashes($strs[$col]);
            }  
	   // 关键词	标题	封面	描述	外链	内容

	     $info = array( 
                      'keyword'=>"$strs[0]", 
                      'title'=>"$strs[1]", 
		      'musicurl'=>"$strs[2]", 
		       'hqmusicurl'=>"$strs[3]", 
		        'description'=>"$strs[4]", 
			
		      'uid'=>"$uid",
                      'token'=>"$token",
		      'createtime'=>"$addtime",
		      'uptatetime'=>"$addtime",
		       
              ); 
             	
         M('Voiceresponse')->add($info);
            
        }
          return true;  
	// $this->success('导入成功',U(MODULE_NAME.'/index'));
	
	}
	public function export(){ 
	
	require_once(CORE."./Classes/PHPExcel.php");
	$inputFileType = 'Excel5';
	$objPHPExcel = new PHPExcel(); 
	$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("sjtftx")
							 ->setTitle("Office 2007 XLSX Document")
							 ->setSubject("Office 2007 XLSX  Document")
							 ->setDescription("Document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("Office 2007 openxml php")
							 ->setCategory("Result file");
	$m = $this->_get('m','trim');
	$where['uid']=session('uid');
	$where['token']= $token = session('token');
	$res=D('Voiceresponse')->where($where)->select();
	
	$myarr[] = array('keyword'=>"关键词",'title'=>"标题",'musicurl'=>"普通音乐地址",'hqmusicurl'=>"高质量音乐地址",'description'=>"描述");
        
   

     
        
	
	 
	//在<style></styel>标签中追加 CSS样式br {mso-data-placement:same-cell;} 
	 
	foreach($res as $key=>$val){ 
	       $myarr[] =  array('keyword'=>$val['keyword'],'title'=>$val['title'],'musicurl'=>$val['musicurl'],'hqmusicurl'=>$val['hqmusicurl'],'description'=>$val['description']); 
		}
	 
	 foreach($myarr as $k=>$v){
         $ks=$k+1;	 
	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$ks, $v[keyword])->setCellValue("B".$ks, $v[title])->setCellValue("C".$ks, $v[musicurl])->setCellValue("D".$ks, $v[hqmusicurl])->setCellValue("E".$ks, $v[description]);
		
         }
         $Simple = $token."语音回复"; 
         $objPHPExcel->getActiveSheet()->setTitle($Simple);
         $filename = "Voice-".$token.time().".xls";
 

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$filename);
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $inputFileType);
$objWriter->save('php://output');
exit;
	  	
	  
	}
	public function insert(){
		$this->all_insert();
	}
	public function upsave(){
		$this->all_save();
	}
	public function upload(){  
	
        //文件上传地址提交给他，并且上传完成之后返回一个信息，让其写入数据库     
        if(empty($_FILES)){  
            $this->errors('必须选择导入文件');     
	   
        }else{  
            $a=$this->up();  
            if(isset($a)){  
                //写入数据库的自定义c方法  
		 
                if($this->imports($a)){  
                     $this->successs('导入成功');     
		    
		   
                }  
                else{  
                    $this->errors('导入数据库失败');     
                }  
            }else{  
                $this-errors('导入文件异常，请与系统管理员联系');     
            }  
        }  
    }  
     
    public function c($data){  
       $data['filename']=$data['savename'];  
       
       return true;  
         
    }  
     
   public function up(){  
        
        import('@.Org.UploadFile');//将上传类UploadFile.class.php拷到Lib/Org文件夹下  
        $upload=new UploadFile();  
        $upload->maxSize='1000000';//默认为-1，不限制上传大小  
        $upload->savePath= CVS_ROOT.'./Data/upload/';//保存路径建议与主文件平级目录或者平级目录的子目录来保存     
        $upload->saveRule=uniqid;//上传文件的文件名保存规则  
        $upload->uploadReplace=true;//如果存在同名文件是否进行覆盖  
        $upload->allowExts=array('xls');//准许上传的文件类型  
       // $upload->allowTypes=array('image/png','image/jpg','image/jpeg','image/gif');//检测mime类型  
        $upload->thumb=true;//是否开启图片文件缩略图  
        $upload->thumbMaxWidth='300,500';  
        $upload->thumbMaxHeight='200,400';  
        $upload->thumbPrefix='s_,m_';//缩略图文件前缀  
        $upload->thumbRemoveOrigin=1;//如果生成缩略图，是否删除原图  
         
        if($upload->upload()){  
            $info=$upload->getUploadFileInfo();  
            return $info;  
        }else{  
            $this->errors($upload->getErrorMsg());//专门用来获取上传的错误信息的     
        }     
    }  
        
}
?>