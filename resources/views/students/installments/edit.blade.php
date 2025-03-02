<x-layout>
    <x-slot:title>
        تعديل قسط
    </x-slot:title>
    <x-slot:heading>
        تعديل قسط
    </x-slot:heading>

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Sticky Actions -->
        <div class="row">
            <div class="col-12">
                <form
                    action="{{ route('students.installments.update', ['student' => $student->id, 'invoice' => $invoice->id, 'installment' => $installment->id]) }}"
                    method="POST" class="card" id="classForm">
                    @csrf
                    @method('PATCH')
                    <div
                        class="card-header sticky-element bg-label-secondary d-flex justify-content-end align-items-sm-center flex-column flex-sm-row">
                        <div class="action-btn">
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="amount">المبلغ</label>
                                        <input required type="number" id="amount" name="amount" min="0"
                                            class="form-control" value="{{ old('amount', $installment->amount) }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="description">الوصف</label>
                                        <input required type="text" id="description" name="description"
                                            class="form-control"
                                            value="{{ old('description', $installment->description) }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
