<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();
        return view('admin.setting.list', ['settings' => $settings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $name = $r->name;
        $about_site = $r->about_site;
        $facebook = $r->facebook;
        $twitter = $r->twitter;
        $instagram = $r->instagram;
        $reddit = $r->reddit;
        $email = $r->email;
        $copyright = $r->copyright;

        $site = new Setting();
        $site->name = $name;
        $site->about_site = $about_site;
        $site->facebook = $facebook;
        $site->twitter = $twitter;
        $site->instagram = $instagram;
        $site->reddit = $reddit;
        $site->email = $email;
        $site->copyright = $copyright;

        if ($r->hasFile('site_logo')) {
            $image = $r->file('site_logo');
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('storage/setting', $image_new_name);
            $site->site_logo = '/storage/setting/' . $image_new_name;
        }
        $site->save();

        Session::flash('success', 'settings created successfully');
        return redirect()->route('site_settings');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('admin.setting.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
