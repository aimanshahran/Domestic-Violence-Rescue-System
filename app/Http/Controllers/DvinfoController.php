<?php

namespace App\Http\Controllers;
use App\Models\DVInfo;
use DB;
use Illuminate\Http\Request;
use Auth;

class DvinfoController extends Controller
{
    public function show()
    {
        $dvinfos = DVInfo::select(
            'dv_information.id AS id', 'users.name AS name', 'dv_information.title AS title', 'dv_information.content AS content', 'dv_category.name AS categoryName',
            'dv_information.updated_at AS updated_at')
            ->leftjoin('users', 'dv_information.user_id', '=', 'users.id')
            ->leftjoin('dv_category', 'dv_information.category_id', '=', 'dv_category.id')
            ->get();

        if (!$dvinfos) {
            abort(404);
        }

        return view('dv-information.index',compact('dvinfos'));
    }

    public function edit(DVInfo $dvinfo)
    {
        $dvinfos = DVInfo::select(
            'dv_information.id AS id', 'users.name AS name', 'dv_information.title AS title', 'dv_information.content AS content', 'dv_category.name AS categoryName',
            'dv_information.updated_at AS updated_at')
            ->leftjoin('users', 'dv_information.user_id', '=', 'users.id')
            ->leftjoin('dv_category', 'dv_information.category_id', '=', 'dv_category.id')
            ->get();

        if (!$dvinfos) {
            abort(404);
        }

        return view('dv-information.edit',compact('dvinfos'));
    }

    public function update(Request $request, DVInfo $dvinfo)
    {
        $request->validate([
            'title-introduction' => ['required','string', 'max:255'],
            'content-introduction' => ['required', 'string']
        ]);

        $dvinfo->fill($request->post())->save();

        return redirect()->back()->with('success','DV Information updated successfully');
    }
}
