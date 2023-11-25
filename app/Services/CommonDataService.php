<?php
namespace App\Services;

use App\Models\InstituteInfo;
use App\Models\MasterClass;
use App\Models\MasterGroup;
use App\Models\MasterShift;
use App\Models\Teacher;

class CommonDataService {
    public static function instituteList ()
    {
        $insId = session('institute_id') ? session('institute_id') : null;
        return InstituteInfo::where('status', 1)->when($insId, function ($q) use ($insId) {
            $q->where('id', $insId);
        })
        ->select('id', 'inst_name')
        ->get();
    }

    public static function teacherList ()
    {
        $insId = session('institute_id') ? session('institute_id') : null;
        
        return Teacher::where('status', 1)
        ->when($insId, function ($q) use ($insId) {
            $q->where('institute_id', $insId);
        })
        ->get()
        ->map(function ($item) {
            $data['id'] = $item->id;
            $data['teacher_name'] = $item->user->name;
            $data['auto_id'] = $item->auto_id;
            $data['institute_id'] = $item->institute_id;
            return $data;
        });
    }


    public static function classList ()
    {
        $insId = session('institute_id') ? session('institute_id') : null;
        return MasterClass::where('status', 1)->when($insId, function ($q) use ($insId) {
            $q->where('institute_id', $insId);
        })
        ->select('id', 'class_name', 'institute_id')
        ->get();
    }

    public static function groupList ()
    {
        $insId = session('institute_id') ? session('institute_id') : null;
        return MasterGroup::where('status', 1)->when($insId, function ($q) use ($insId) {
            $q->where('institute_id', $insId);
        })
        ->select('id', 'group_name', 'class_id', 'institute_id')
        ->get();
    }

    public static function shiftList ()
    {
        $insId = session('institute_id') ? session('institute_id') : null;
        return MasterShift::where('status', 1)->when($insId, function ($q) use ($insId) {
            $q->where('institute_id', $insId);
        })
        ->select('id', 'shift_name', 'institute_id')
        ->get();
    }
}
