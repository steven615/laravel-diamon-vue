<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    protected $activitylog = '';

    public function __construct(ActivityLog $activitylog)
    {
        $this->activitylog = $activitylog;
    }


    public function index(Request $request)
    {
        $filter = $request->input('filter', '');
        $data = null;

        if($filter) {
            $filter = '%' . $filter . '%';

            $data = $this->activitylog->where(function($query) use ($filter){
                $query->where('code', 'LIKE', $filter)
                    ->orWhere('name', 'LIKE', $filter)
                    ->orWhere('description', 'LIKE', $filter)
                    ->orWhere('image', 'LIKE', $filter)
                    ->orWhere('price', 'LIKE', $filter)
                    ->orWhere('category', 'LIKE', $filter)
                    ->orWhere('quantity', 'LIKE', $filter)
                    ->orWhere('inventoryStatus', 'LIKE', $filter)
                    ->orWhere('rating', 'LIKE', $filter);
            })
                ->get();
        } else {
            $data = $this->activitylog->get();
        }

        return response()->json(['data' => $data]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->except([]);
        $activitylog = new ActivityLog($input);
        $activitylog->save();
        return response()->json(['data' => $activitylog]);
    }


    public function show(ActivityLog $activitylog)
    {
        //
    }


    public function edit($id)
    {
        $data = $this->activitylog->where('activitylog.id','=',$id)
            ->get()->first();
        return response()->json(['data' => $data]);
    }


    public function update(Request $request, ActivityLog $activitylog)
    {
        $input = $request->except([]);

        $activitylog->update($input);
        return response()->json(['data' => $activitylog]);
    }

    public function destroy($id)
    {
        $ids = explode(",", $id);
        ActivityLog::destroy($ids);
        return response()->json(['status' => 'OK', 'ids' => $ids]);
    }
}
