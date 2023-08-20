<?php

namespace App\Models;
use Illuminate\Support\Facades\Cache as Redis;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsModel extends Model
{
    use HasFactory;
    protected $table = 'settings';
    use HasFactory;
    public static function getData($index = ""){
        $cache_key = "settingCache";
        $adata = array();
        if (Redis::get($cache_key) != null) {
            $data = Redis::get($cache_key);
            foreach (json_decode($data) as $val) {
                $adata[$val->name] = $val->value;
            }
        }else{
            $settings = SettingsModel::where("module","core")->orwhere("module","email")->orwhere("module","wa")->get();
            
            if($settings){
                foreach ($settings as $val) {
                    $adata[$val->name] = $val->value;
                }
                Redis::set($cache_key, $settings, 'EX', 60 * 60 * 24);
            }
        }
        return isset($adata[$index]) ? $adata[$index] : "";
    }
    public static function getDataPM($index = ""){
        $settings = SettingsModel::where("module","pm")->where("name",$index)->get();
        if($settings){
            foreach ($settings as $val) {
                $adata[$val->name] = $val->value;
            }
        }
        return isset($adata[$index]) ? $adata[$index] : "";
    }
}
