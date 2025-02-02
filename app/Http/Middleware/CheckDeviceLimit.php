<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserDevice;
use App\Services\DeviceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckDeviceLimit
{
    protected $deviceService;

    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return $next($request);
        }

        if ($request->routeIs('login') || $request->routeIs('logout')) {
            return $next($request);
        }

        $sessionDeviceId = session('device_id');

        // Cek apakah session device_id masih valid di database
        $device = UserDevice::where('user_id', $user->id)
            ->where('device_id', $sessionDeviceId)
            ->first();

        if (!$device) {
            // Jika tidak ada, coba daftarkan ulang
            $device = $this->deviceService->registerDevice($user);

            if (!$device) {
                Auth::logout();
                return redirect()->route('login')
                    ->withErrors(['device' => 'Anda telah mencapai batas maksimum perangkat. Silakan logout dari perangkat lain.']);
            }
        }

        return $next($request);
    }
}
