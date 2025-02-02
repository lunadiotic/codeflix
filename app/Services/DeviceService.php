<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

class DeviceService
{
    protected $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    /**
     * Mendaftarkan device baru jika belum terdaftar
     */
    public function registerDevice(User $user)
    {
        $deviceInfo = $this->getDeviceInfo();

        // Cek apakah device dengan fingerprint unik sudah ada
        $existingDevice = UserDevice::where('user_id', $user->id)
            ->where('device_type', $deviceInfo['device_type'])
            ->where('platform', $deviceInfo['platform'])
            ->where('browser', $deviceInfo['browser'])
            ->first();

        if ($existingDevice) {
            // Update last_active jika device ditemukan
            $existingDevice->update([
                'last_active' => now(),
            ]);
            session(['device_id' => $existingDevice->device_id]);
            return $existingDevice;
        }

        // Jika device baru, cek batas maksimal device
        $maxDevices = $user->getCurrentPlan()->max_devices;
        $activeDevices = UserDevice::where('user_id', $user->id)
            ->count();

        if ($activeDevices >= $maxDevices) {
            return false; // Tidak bisa login di device tambahan
        }

        // Buat device baru
        $device = UserDevice::create([
            'user_id' => $user->id,
            'device_name' => $deviceInfo['device_name'],
            'device_id' => $this->generateDeviceId(),
            'device_type' => $deviceInfo['device_type'],
            'platform' => $deviceInfo['platform'],
            'platform_version' => $deviceInfo['platform_version'],
            'browser' => $deviceInfo['browser'],
            'browser_version' => $deviceInfo['browser_version'],
            'last_active' => now(),
        ]);

        session(['device_id' => $device->device_id]);
        return $device;
    }

    /**
     * Mengambil informasi perangkat
     */
    private function getDeviceInfo()
    {
        return [
            'device_name' => $this->generateDeviceName(),
            'device_type' => $this->agent->isDesktop() ? 'desktop' : ($this->agent->isPhone() ? 'phone' : 'tablet'),
            'platform' => $this->agent->platform(),
            'platform_version' => $this->agent->version($this->agent->platform()),
            'browser' => $this->agent->browser(),
            'browser_version' => $this->agent->version($this->agent->browser())
        ];
    }

    private function generateDeviceName()
    {
        return ucfirst($this->agent->platform()) . ' - ' . ucfirst($this->agent->browser());
    }

    private function generateDeviceId()
    {
        return Str::random(32);
    }

    /**
     * Logout dari device tertentu
     */
    public function logoutDevice($deviceId)
    {
        UserDevice::where('device_id', $deviceId)->delete();
        session()->forget('device_id');
    }
}
