<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Jenssegers\Agent\Agent;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class UpdateLastLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        // Inisialisasi Agent
        $agent = new Agent();

        // Ambil User Agent
        $agent->setUserAgent($this->request->header('User-Agent'));

        // Dapatkan perangkat dan sistem operasi
        $browser = $agent->browser(); // Nama perangkat (contoh: iPhone, Windows)
        $platform = $agent->platform(); // Nama sistem operasi (contoh: Android, Windows)
        $platformVersion = $agent->version($platform); // Versi sistem operasi

        // Simpan data ke database
        $user->update([
            'last_login_at' => now(),
            'user_agent' => "{$browser} ({$platform} {$platformVersion})", // Gabungkan informasi
        ]);
    }
}
