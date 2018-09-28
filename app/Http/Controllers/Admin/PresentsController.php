<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Present;

class PresentsController extends Controller
{
    public function render(Request $request, Present $present)
    {
        if ($request->ajax()) {
            $userId = $request->userId;

            $html   = view('admin.presents._add_present', compact('present', 'userId'))->render();
        }

        return ['html' => $html ?? false];
    }

    public function store(Request $request, Present $present)
    {
        if ($request->ajax()) {
            $present->fill($request->all());
            $present->save();

            $html   = view('admin.presents._present', compact('present'))->render();
        }

        return ['html' => $html ?? false];
    }

    public function destroy(Present $present, Request $request)
    {
        if($request->ajax()) {
            $present->delete();

            return [ 
                true
            ];
        }
        
        return [
            false
        ];
    }
}
