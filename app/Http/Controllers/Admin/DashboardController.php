<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\OrderRepository;
use App\Repositories\AccountRepository;

class DashboardController extends Controller
{
    protected $userRepo;
    protected $accountRepo;
    protected $orderRepo;

    public function __construct(
        UserRepository $userRepo,
        AccountRepository $accountRepo,
        OrderRepository $orderRepo,
    ) {
        $this->userRepo = $userRepo;
        $this->accountRepo = $accountRepo;
        $this->orderRepo = $orderRepo;
    }
    public function index()
    {
        $totalUsers = $this->userRepo->allUsersCount();
        $activeUsers = $this->userRepo->activeUsersCount();
        $newUsersLastWeek = $this->userRepo->newUsersLastWeek();

        $totalAccounts = $this->accountRepo->allAccountsCount();
        $soldAccounts = $this->accountRepo->soldAccountsCount();
        $newAccountsLastWeek = $this->accountRepo->newAccountsLastWeek();

        $totalOrders = $this->orderRepo->allOrdersCount();
        $completedOrders = $this->orderRepo->completedOrdersCount();
        $pendingOrders = $this->orderRepo->pendingOrdersCount();
        $totalRevenue = $this->orderRepo->totalRevenue();

        $dashboardData = [
            'totalUsers' => $this->userRepo->allUsersCount(),
            'activeUsers' => $this->userRepo->activeUsersCount(),
            'newUsersLastWeek' => $this->userRepo->newUsersLastWeek(),
            'totalAccounts' => $this->accountRepo->allAccountsCount(),
            'soldAccounts' => $this->accountRepo->soldAccountsCount(),
            'newAccountsLastWeek' => $this->accountRepo->newAccountsLastWeek(),
            'totalOrders' => $this->orderRepo->allOrdersCount(),
            'completedOrders' => $this->orderRepo->completedOrdersCount(),
            'pendingOrders' => $this->orderRepo->pendingOrdersCount(),
            'totalRevenue' => $this->orderRepo->totalRevenue(),
        ];

        return view('admin.dashboard', $dashboardData);
    }
}
