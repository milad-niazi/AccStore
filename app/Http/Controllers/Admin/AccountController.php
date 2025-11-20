<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AccountRepository;

class AccountController extends Controller
{
    protected $accountRepo;

    // public function __construct(AccountRepository $accountRepo)
    // {
    //     $this->middleware('auth');
    //     $this->accountRepo = $accountRepo;
    // }

    public function index()
    {
        $accounts = $this->accountRepo->all();
        return view('admin.accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('admin.accounts.create');
    }

    public function store(Request $request)
    {
        $account = $this->accountRepo->create($request->all());
        return redirect()->route('admin.accounts.index')->with('success', 'Account created');
    }

    public function edit($id)
    {
        $account = $this->accountRepo->find($id);
        return view('admin.accounts.edit', compact('account'));
    }

    public function update(Request $request, $id)
    {
        $this->accountRepo->update($id, $request->all());
        return redirect()->route('admin.accounts.index')->with('success', 'Account updated');
    }

    public function destroy($id)
    {
        $this->accountRepo->delete($id);
        return redirect()->route('admin.accounts.index')->with('success', 'Account deleted');
    }
}
