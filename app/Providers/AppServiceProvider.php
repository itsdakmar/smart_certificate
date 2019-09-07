<?php

namespace App\Providers;

use App\CertificateConfig;
use App\Mail\SendEmailConvert;
use App\Mail\SendEmailConvertFailed;
use App\User;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function __construct(\Illuminate\Contracts\Foundation\Application $app)
    {
        parent::__construct($app);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Queue::after(function (JobProcessed $event) {
            $findCert = CertificateConfig::orderBy('id', 'desc')->first();
            $findCert->update([
                'convert_status' => 2
            ]);
            $user = User::whereHas("roles", function($q){ $q->whereIn("name", ["Admin","Secretariat"]); })->pluck('email');


            Mail::to([$user])->send(new SendEmailConvert());
        });

        Queue::failing(function ($connection, $job) {
            $findCert = CertificateConfig::orderBy('id', 'desc')->first();
            $findCert->update([
                'convert_status' => 0
            ]);
            $user = User::whereHas("roles", function($q){ $q->whereIn("name", ["Admin","Secretariat"]); })->pluck('email');


            Mail::to([$user])->send(new SendEmailConvertFailed($job));
        });
    }
}
