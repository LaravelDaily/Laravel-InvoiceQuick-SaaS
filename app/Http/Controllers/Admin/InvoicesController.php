<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInvoiceRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Invoice;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class InvoicesController
 * @package App\Http\Controllers\Admin
 */
class InvoicesController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $invoices = Invoice::with(['customer'])->get();

        return view('admin.invoices.index', compact('invoices'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $customers = Customer::all();

        return view('admin.invoices.create', compact('customers'));
    }

    /**
     * @param StoreInvoiceRequest $request
     * @return RedirectResponse
     */
    public function store(StoreInvoiceRequest $request)
    {
        Invoice::create($request->all());

        return redirect()->route('admin.invoices.index');

    }

    /**
     * @param Invoice $invoice
     * @return Factory|View
     */
    public function edit(Invoice $invoice)
    {
        $customers = Customer::all();

        return view('admin.invoices.edit', compact('invoice', 'customers'));
    }

    /**
     * @param UpdateInvoiceRequest $request
     * @param Invoice $invoice
     * @return RedirectResponse
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->all());

        return redirect()->route('admin.invoices.index');

    }

    /**
     * @param Invoice $invoice
     * @return Factory|View
     */
    public function show(Invoice $invoice)
    {
        return view('admin.invoices.show', compact('invoice'));
    }

    /**
     * @param Invoice $invoice
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return back();

    }

    /**
     * @param MassDestroyInvoiceRequest $request
     * @return ResponseFactory|\Illuminate\Http\Response
     */
    public function massDestroy(MassDestroyInvoiceRequest $request)
    {
        Invoice::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
