<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\View\View
	 */
	public function upload(Request $request)
	{
		if ($request->file->isValid()) {
			$file = $request->file('file');
			//Move Uploaded File
			$destinationPath = 'upload/redactor_upload_images/';
			$uploaded_file_name = time() . '_' . $file->getClientOriginalName();
			$file->move($destinationPath, $uploaded_file_name);
			$arr = ["url" => url($destinationPath . $uploaded_file_name)];
			return response()->json($arr);
		}

	}

	public function getImages()
	{
		$arr = [];
		return response()->json($arr);
	}

	public function uploadCKeditor(Request $request)
	{
		$limited_ext = array(".jpg", ".jpeg", ".png", ".gif", ".bmp");
		$limited_type = array("image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp");
		$not_allowed = array(".php", ".exe", ".zip", ".rar", ".js", ".txt", ".css", ".html", ".htm", ".doc", ".docx");

		$nameUpload = strtolower(basename($_FILES['upload']['name']));
		$typeUpload = strtolower($_FILES['upload']['type']);

		if (isset($_FILES['upload']) && strlen($nameUpload) > 1) {
			if (in_array($typeUpload, $limited_type)) {
				if ($_FILES['upload']['size'] > 0) {
					$check = getimagesize($_FILES["upload"]["tmp_name"]);
					if ($check !== false && in_array($check['mime'], $limited_type)) {
						$notAllowFlag = 0;
						foreach ($not_allowed as $notAllow) {
							$pos = strpos($nameUpload, $notAllow);
							if ($pos !== false) {
								$notAllowFlag = 1;
							}
						}
						if ($notAllowFlag == 0) {
							$ext = strrchr($nameUpload, '.');
							if (in_array($ext, $limited_ext)) {
								$funcNum = $_GET['CKEditorFuncNum'];
								// Optional: instance name (might be used to load a specific configuration file or anything else).
								$CKEditor = $_GET['CKEditor'];
								// Optional: might be used to provide localized messages.
								$langCode = $_GET['langCode'];
								$uploadurl = url('upload/redactor_upload_images');
								$uploaddir = public_path('upload/redactor_upload_images'); //$uploaddir set permission 777 (unix)

								$new_file_name = rand(100000, 999999) . $ext;
								while (is_file($uploaddir . $new_file_name)) {
									$new_file_name = rand(100000, 999999) . $ext;
								}
								if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploaddir . $new_file_name)) {
									$url = $uploadurl . $new_file_name;
									$re = "window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', 'Uploaded successfully...');";
								} else {
									$re = 'alert("Unable to upload the file");';
								}
							} else {
								$re = 'alert("Please select an allowed files ( JPG, PNG, GIF, BMP)...");';
							}
						} else {
							$re = 'alert("Please select an allowed files ( JPG, PNG, GIF, BMP)...");';
						}
					} else {
						$re = 'alert("Please select an allowed files ( JPG, PNG, GIF, BMP)...");';
					}
				} else {
					$re = 'alert("File size cannot be null!");';
				}
			} else {
				$re = 'alert("Please select an allowed files ( JPG, PNG, GIF, BMP)...");';
			}
		} else {
			$re = 'alert("Error!");';
		}
		echo "<script>$re;</script>";
		exit;
	}


	public function browse()
	{

	}
}
