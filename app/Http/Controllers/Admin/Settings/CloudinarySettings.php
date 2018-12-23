<?php
/**
 * Created by PhpStorm.
 * User: jtam
 * Date: 12/23/18
 * Time: 11:30 AM
 */
namespace App\Http\Controllers\Admin\Settings;


class CloudinarySettings{
    public function __construct()
    {
    	//Do your magic here
        $this->cloudinary = \App\Cloudinary::all()->first->get();

    }
    public function setup_cloudinary(){
        $cloudinary_settings = \Cloudinary::config(array(
            "cloud_name" => $this->cloudinary->cloud_name,
            "api_key" => $this->cloudinary->api_key,
            "api_secret" => $this->cloudinary->api_secret
        ));
        return $cloudinary_settings;
    }
}

