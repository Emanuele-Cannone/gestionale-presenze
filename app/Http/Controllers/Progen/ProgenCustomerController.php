<?php

namespace App\Http\Controllers\Progen;

use App\Http\Controllers\Controller;
use App\Http\Requests\Progen\ProgenCustomerStoreRequest;
use App\Http\Requests\Progen\ProgenUserStoreRequest;
use App\Models\Progen\ProgenCustomer;
use App\Models\User;
use App\Services\Progen\ProgenCustomerService;
use App\Services\Progen\ProgenUsersCustomerService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProgenCustomerController extends Controller
{

    public const IMPORT_TYPES = [
        0 => 'Single',
        1 => 'Massive',
        2 => 'Table',
    ];

    public const USER_TYPES = [
        0 => 'Standard',
        1 => 'Random'
    ];

    /**
     * @param ProgenCustomerService $progenCustomerService
     */
    public function __construct(readonly private ProgenCustomerService $progenCustomerService, readonly private ProgenUsersCustomerService $progenUsersCustomerService) 
    {
    }

    /**
     * @return View
     */
    public function index(): View
    {

        $progenCustomers = ProgenCustomer::paginate(15);
        return view('progen.customer.index', ['customers' => $progenCustomers]);
        // return view('progen.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('progen.customer.create', ['arrayImportTypes' => self::IMPORT_TYPES]);
    }

    /**
     * Store a newly created resource in storage.
     * @param ProgenCustomerStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ProgenCustomerStoreRequest $request): RedirectResponse
    {
        $this->progenCustomerService->create($request);

        return Redirect::route('progen.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): view
    {
        $customer = ProgenCustomer::findOrFail($id);

        $users = User::all();

        return view('progen.customer.edit', 
            [
                'customer' => $customer, 
                'users' => $users,
                'user_types' => self::USER_TYPES
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param ProgenUserStoreRequest $request
     */
    public function updateCustomerUsers(ProgenUserStoreRequest $request, String $id)
    {
        $this->progenUsersCustomerService->update($request, $id);

        return Redirect::route('progen.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
