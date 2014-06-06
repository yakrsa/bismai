<?php
@session_start();
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
// <embed src="http://share.map.soso.com/share/panoId/10041004111116135140556/heading/196.35944967118226/pitch/20/zoom/1/pano.swf" quality="high" width="610" height="290" align="middle" allowNetworking="all" allowScriptAccess="always" allowFullScreen="true" mode="transparent" type="application/x-shockwave-flash"></embed>
// Define a destination
$targetFolder = '/Data/upload/'.$_SESSION['token'];  // Relative to the root

if (!file_exists($targetFolder)) {
		mkdir($targetFolder);
	}

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png','xls','xlsx','rar','zip','ppt','doc','docx'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	$targetFiles = rtrim($targetPath,'/') . '/' . $verifyToken.".".$fileParts['extension'];
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFiles);
		echo $targetFiles;
	} else {
		echo '文件格式错误.';
	}
}
?>