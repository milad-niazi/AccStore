<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AccountRepository;
use App\Repositories\CategoryRepository;

class AccountController extends Controller
{
    protected AccountRepository $accountRepo;
    protected CategoryRepository $categoryRepo;

    public function __construct(AccountRepository $accountRepo, CategoryRepository $categoryRepo)
    {
        // $this->middleware('auth');
        $this->accountRepo = $accountRepo;
        $this->categoryRepo = $categoryRepo;
    }
    public function index(Request $request)
    {
        $categories = $this->categoryRepo->all();
        $selectedCategory = $request->query('category');

        $accounts = $this->accountRepo->all();

        if (!empty($selectedCategory)) {
            $accounts = $accounts
                ->where('category_id', (int) $selectedCategory)
                ->values();
        }

        return view('admin.accounts.index', compact('accounts', 'categories', 'selectedCategory'));
    }

    public function create()
    {
        $categories = $this->categoryRepo->all();

        return view('admin.accounts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $account = $this->accountRepo->create($request->all());
        return redirect()->route('admin.accounts.index')->with('success', 'Account created');
    }

    public function show($id)
    {
        $account = $this->accountRepo->findById($id);

        return view('admin.accounts.show', compact('account'));
    }

    public function edit($id)
    {
        $account = $this->accountRepo->findById($id);
        $categories = $this->categoryRepo->all();

        return view('admin.accounts.edit', compact('account', 'categories'));
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
