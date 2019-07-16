<?php

namespace App\Providers;

use App\CertificateConfig;
use App\Mail\SendEmailConvert;
use App\Mail\SendEmailConvertFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
            Mail::to('ali@gmail.com')->send(new SendEmailConvert());
        });

        Queue::failing(function ($connection, $job) {
            $findCert = CertificateConfig::orderBy('id', 'desc')->first();
            $findCert->update([
                'convert_status' => 0
            ]);
            Mail::to('ali@gmail.com')->send(new SendEmailConvertFailed());
        });
    }
}
