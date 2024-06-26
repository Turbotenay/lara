<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
    {
        $contentLimitSetting = Setting::where('key', 'content_limit')->first();
        $titleLimitSetting = Setting::where('key', 'title_limit')->first();

        return view('settings.edit', compact('contentLimitSetting', 'titleLimitSetting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'content_limit' => 'required|integer',
            'title_limit' => 'required|integer',
        ]);

        Setting::updateOrCreate(['key' => 'content_limit'], ['value' => $request->content_limit]);
        Setting::updateOrCreate(['key' => 'title_limit'], ['value' => $request->title_limit]);

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}