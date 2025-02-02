<?php

namespace App\Http\Middleware;

use App\Models\UserDevice;
use App\Services\DeviceService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RemoveDeviceBeforeLogout
{
    protected $deviceService;

    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan middleware hanya berjalan jika user mengakses route logout
        if ($this->isLogoutRequest($request)) {
            $deviceId = Session::get('device_id');

            if ($deviceId) {
                $this->deviceService->logoutDevice($deviceId);
            }
        }

        return $next($request);
    }

    private function isLogoutRequest(Request $request): bool
    {
        // Periksa apakah request ini adalah logout dari Laravel Fortify
        return $request->is('logout') || Route::currentRouteName() === 'logout';
    }
}
