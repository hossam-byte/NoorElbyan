<?php

namespace App\Http\Controllers;

use App\Models\InvoiceInstallment;
use App\Models\Invoice;
use App\Models\Student;
use Illuminate\Http\Request;

class InvoiceInstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Student $student, Invoice $invoice)
    {
        return view("students.installments.create", compact("student","invoice"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Student $student, Invoice $invoice, Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // Update the invoice's paied_amount and remaining_amount
        $invoice->paied_amount += $validatedData['amount'];
        $invoice->remaining_amount = $invoice->total_amount - $invoice->paied_amount;
        $invoice->save(); // Save changes to the database

        if($invoice->remaining_amount == 0) {
            $invoice->status = 1; // Mark the invoice as paid
            $invoice->save();
        } else {
            $invoice->status = 0; // Mark the invoice as unpaid
            $invoice->save();
        }

        // Create a new installment
        InvoiceInstallment::create([
            'invoice_id' => $invoice->id,
            'amount' => $validatedData['amount'],
            'description' => $validatedData['description'],
        ]);

        session()->flash('installment_created', true);
        return redirect()->route('students.invoices.show', ['student' => $student->id, 'invoice' => $invoice->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceInstallment $invoiceInstallment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student, Invoice $invoice, InvoiceInstallment $installment)
    {
        return view("students.installments.edit", compact("student","invoice","installment"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student, Invoice $invoice, InvoiceInstallment $installment)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // Calculate the difference between old and new amount
        $difference = $validatedData['amount'] - $installment->amount;

        // Update the invoice's paid and remaining amounts
        $invoice->paied_amount += $difference;
        $invoice->remaining_amount = $invoice->total_amount - $invoice->paied_amount;
        $invoice->save(); // Save changes to the invoice


        if($invoice->remaining_amount == 0) {
            $invoice->status = 1; // Mark the invoice as paid
            $invoice->save();
        } else {
            $invoice->status = 0; // Mark the invoice as unpaid
            $invoice->save();
        }
        // Update the installment details
        $installment->update([
            'amount' => $validatedData['amount'],
            'description' => $validatedData['description'],
        ]);

        session()->flash('installment_updated', true);
        return redirect()->route('students.invoices.show', ['student' => $student->id, 'invoice' => $invoice->id]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student, Invoice $invoice, InvoiceInstallment $installment)
    {
        $invoice->paied_amount -= $installment->amount;
        $invoice->remaining_amount = $invoice->total_amount - $invoice->paied_amount;
        $invoice->save();

        $installment->delete();

        session()->flash('installment_deleted', true);
        return redirect()->route('students.invoices.show', ['student' => $student->id, 'invoice' => $invoice->id]);
    }

}
