<?php
namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Pendaftaran\PendaftaranService;
use app\Services\Pendaftaran\RekamRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected User $users;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });

    }

    public function index()
    {
        return view('dokter.dashboard', array(
            'title' => "Dashboard Administrator | MiniProject v.1.0",
            'firstMenu' => 'dashboard',
            'secondMenu' => 'dashboard',
        ));
    }
}
