<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateAppSettingsRequest;


class SettingsController extends Controller
{
   
    protected $settingsPath = 'settings.json';

    public function showAppSettings(){
        $settings = $this->getSettings();
       
        return view('settings.app-settings', array_merge($settings, [
            'name1' => "Settings",
            'name2' => "Settings",
            'name3' => "App Settings",
        ]));
    }

    public function showMailSettings(){
        return view('settings.mail-settings',
        [
            'name1' => "Settings",
            'name2' => "Settings",
            'name3' => "Mail Settings",
        ]);
    }

   public function updateAppSettings(UpdateAppSettingsRequest $request)
    {
        $settings = [
            'footer_link_url'  => $request->footer_link_url,
            'footer_link_name' => $request->footer_link_name,
            'footer_link_text' => $request->footer_link_text,
        ];

        $this->updateImage($request, 'logo_dark_image',  $settings);
        $this->updateImage($request, 'logo_light_image', $settings);
        $this->updateImage($request, 'logo_dark_icon',   $settings);
        $this->updateImage($request, 'logo_light_icon',  $settings);

        $this->saveSettings($settings);

        return redirect()->route('settings.app-settings')
            ->with('success', 'Settings updated successfully.');
    }

    

    public function updateMailSettings(Request $request)
    {
        $request->validate([
            'mail_mailer' => 'required',
            'mail_from_address' => 'required|email',
            'mail_host' => 'required_if:mail_mailer,==,smtp',
            'mail_port' => 'required_if:mail_mailer,==,smtp',
            'mail_username' => 'required_if:mail_mailer,==,smtp',
            'mail_password' => 'required_if:mail_mailer,==,smtp',
        ]);
    
        $data = $request->only([
            'mail_mailer',
            'mail_from_address',
            'mail_host',
            'mail_port',
            'mail_username',
            'mail_password',
        ]);
    
        foreach ($data as $key => $value) {
            $this->setEnvironmentValue(strtoupper($key), $value);
        }
        //\Artisan::call('config:cache');
    
        return back()->with('success', 'Mail settings updated successfully.');
    }
    
    protected function setEnvironmentValue($envKey, $envValue)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
    
        $str = preg_replace("/^{$envKey}=.*/m", "{$envKey}={$envValue}", $str);
    
        file_put_contents($envFile, $str);
    }
    
 
    protected function updateImage(Request $request, $imageKey, &$settings)
    {
        if ($request->hasFile($imageKey)) {
            // Store the new image and update the settings
            $path = $request->file($imageKey)->store('websettings', 'public');
            $settings[$imageKey] = $path;
        }
    }
    
    
    protected function getSettings()
    {
        return config('websettings');
    }
    
    
    protected function saveSettings(array $settings)
    {
        $envFile = app()->environmentFilePath();
        $envContents = file_get_contents($envFile);
    
        foreach ($settings as $key => $value) {
            $envKey = strtoupper($key); // Ensure keys are uppercase
    
            // Escape double quotes within values and wrap in quotes
            $escapedValue = addslashes($value); // Escape special characters
            $formattedValue = "\"{$escapedValue}\"";
    
            // Check if the key already exists in the .env file
            if (preg_match("/^{$envKey}=.*/m", $envContents)) {
                // Update the existing key
                $envContents = preg_replace(
                    "/^{$envKey}=.*$/m",
                    "{$envKey}={$formattedValue}",
                    $envContents
                );
            } else {
                // Add the key if it doesn't exist
                $envContents .= "\n{$envKey}={$formattedValue}";
            }
        }
    
        // Write the updated contents back to the .env file
        file_put_contents($envFile, $envContents);
        \Cache::forget('app_settings');
    
        // Clear the config cache to reflect changes
        \Artisan::call('config:clear');
    }
    
    










    public function clearCache(Request $request){
        // Clear application cache
        \Artisan::call('cache:clear');

        // Clear route cache
        \Artisan::call('route:clear');

        // Clear config cache
        \Artisan::call('config:clear');

        // Clear compiled views
        \Artisan::call('view:clear');

        // Optionally, you can add more cache clearing commands as needed

        // Return a response, such as redirecting back with a success message
        return back()->with('success', 'Cache cleared successfully!');
   }
}
