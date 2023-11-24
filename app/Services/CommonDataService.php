<?php
namespace App\Services;

use App\Models\InstituteInfo;
use App\Models\MasterClass;
use App\Models\MasterGroup;

class CommonDataService {
    public static function instituteList ()
    {
        $insId = session('institute_id') ? session('institute_id') : null;
        return InstituteInfo::where('status', 1)->when($insId, function ($q) use ($insId) {
            $q->where('id', $insId);
        })
        ->select('id', 'inst_name')->get();
    }


    public static function classList ()
    {
        $insId = session('institute_id') ? session('institute_id') : null;
        return MasterClass::where('status', 1)->when($insId, function ($q) use ($insId) {
            $q->where('institute_id', $insId);
        })
        ->select('id', 'class_name', 'institute_id')->get();
    }

    public static function groupList ()
    {
        $insId = session('institute_id') ? session('institute_id') : null;
        return MasterGroup::where('status', 1)->when($insId, function ($q) use ($insId) {
            $q->where('institute_id', $insId);
        })
        ->select('id', 'group_name', 'class_id', 'institute_id')->get();
    }
}
