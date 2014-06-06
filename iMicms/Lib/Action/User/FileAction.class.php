<?php  
class FileAction extends UserAction{  
    function index(){  
       // $file=M('file');  
       // $list=$file->select();  
       // $this->assign('filelist',$list);  
        $this->display();     
    }      
     
    function upload(){  
        //文件上传地址提交给他，并且上传完成之后返回一个信息，让其写入数据库     
        if(emptyempty($_FILES)){  
            $this->error('必须选择上传文件');     
        }else{  
            $a=$this->up();  
            if(isset($a)){  
                //写入数据库的自定义c方法  
                if($this->c($a)){  
                    $this->success('上传成功');     
                }  
                else{  
                    $this->error('写入数据库失败');     
                }  
            }else{  
                $this-error('上传文件异常，请与系统管理员联系');     
            }  
        }  
    }  
     
    private function c($data){  
       return true;  
         
    }  
     
    private function up(){  
        //完成与thinkphp相关的，文件上传类的调用     
        import('@.Org.UploadFile');//将上传类UploadFile.class.php拷到Lib/Org文件夹下  
        $upload=new UploadFile();  
        $upload->maxSize='1000000';//默认为-1，不限制上传大小  
        $upload->savePath='./Data/upload/';//保存路径建议与主文件平级目录或者平级目录的子目录来保存     
        $upload->saveRule=uniqid;//上传文件的文件名保存规则  
        $upload->uploadReplace=true;//如果存在同名文件是否进行覆盖  
        $upload->allowExts=array('jpg','jpeg','gif','png','xls','xlsx','rar','zip','ppt','doc','docx');//准许上传的文件类型  
        $upload->allowTypes=array('image/png','image/jpg','image/jpeg','image/gif');//检测mime类型  
        $upload->thumb=true;//是否开启图片文件缩略图  
        $upload->thumbMaxWidth='300,500';  
        $upload->thumbMaxHeight='200,400';  
        $upload->thumbPrefix='s_,m_';//缩略图文件前缀  
        $upload->thumbRemoveOrigin=1;//如果生成缩略图，是否删除原图  
         
        if($upload->upload()){  
            $info=$upload->getUploadFileInfo();  
            return $info;  
        }else{  
            $this->error($upload->getErrorMsg());//专门用来获取上传的错误信息的     
        }     
    }  
     
}  
?>  