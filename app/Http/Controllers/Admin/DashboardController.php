<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use HasinHayder\Tyro\Models\Role;
use HasinHayder\Tyro\Models\Privilege;
use App\Models\Student;
use App\Models\InsuranceApplication;
use App\Models\Claim;

class DashboardController extends Controller
{
    public function index()
    {
        $userModel = config('tyro-dashboard.user_model', 'App\\Models\\User');

        $stats = [
            'total_users' => class_exists($userModel) ? $userModel::count() : 0,
            'total_roles' => class_exists(Role::class) ? Role::count() : 0,
            'total_privileges' => class_exists(Privilege::class) ? Privilege::count() : 0,
            
            // Insurance specific stats
            'total_students' => Student::count(),
            'total_applications' => InsuranceApplication::count(),
            'pending_applications' => InsuranceApplication::where('status', 'pending')->count(),
            'total_claims' => Claim::count(),
            'pending_claims' => Claim::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
