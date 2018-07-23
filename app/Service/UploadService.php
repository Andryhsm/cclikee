<?php
namespace App\Service;

use Carbon\Carbon;

Class UploadService
{
    const IMAGE_UPLOAD_PATH = 'upload';
    const THUMB_PATH = 'thumb';
    public function __construct()
    {
    }
    public function upload($file,$path, $append_timestamp = true)
    {
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
		if($append_timestamp){
			$image_name = $timestamp . '-' . $file->getClientOriginalName();
		} else {
			$image_name = $file->getClientOriginalName();
		}
        $file->move(public_path() .'/'.$path , $image_name);
        return $image_name;
    }
}