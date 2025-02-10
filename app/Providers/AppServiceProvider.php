<?php

namespace App\Providers;

use App\Services\Admin\GolonganService;
use App\Services\Admin\GolonganServiceImpl;
use App\Services\Admin\KaryawanService;
use App\Services\Admin\KaryawanServiceImpl;
use App\Services\Admin\KategoriService;
use App\Services\Admin\KategoriServiceImpl;
use App\Services\Admin\ObatService;
use App\Services\Admin\ObatServiceImpl;
use App\Services\Admin\PoliklinikService;
use App\Services\Admin\PoliklinikServiceImpl;

use App\Services\Pendaftaran\PendaftaranImplementation;
use App\Services\Pendaftaran\PendaftaranService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\services';

    public $bindings = [
            KategoriService::class => KategoriServiceImpl::class,
            GolonganService::class => GolonganServiceImpl::class,
            ObatService::class => ObatServiceImpl::class,
            PoliklinikService::class => PoliklinikServiceImpl::class,
            KaryawanService::class => KaryawanServiceImpl::class,
            PendaftaranService::class => PendaftaranImplementation::class,
    ];

    public function register(): void
    {

    }


    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
