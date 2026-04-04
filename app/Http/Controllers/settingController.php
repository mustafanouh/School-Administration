<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class settingController extends Controller
{




    public function updateSettings(Request $request)
    {
        $user = auth()->user();

        foreach ($request->settings as $key => $value) {
            $user->settings()->updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
            if ($key === 'language') {

                session()->put('locale', $value);
                app()->setLocale($value);
            }
        }
        return back()->with('success', 'Settings saved successfully.');
    }


    public function edit()
    {
        $user = auth()->user()->load('settings');
        $settings = $user->settings->pluck('value', 'key')->toArray();

        return view('settings.edit', compact('settings'));
    }
}
