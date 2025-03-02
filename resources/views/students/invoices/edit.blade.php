<x-layout>
    <x-slot:title>
        تعديل فاتوره
    </x-slot:title>
    <x-slot:heading>
        تعديل فاتوره
    </x-slot:heading>

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Sticky Actions -->
        <div class="row">
            <div class="col-12">
                <form
                    action="{{ route('students.invoices.update', ['student' => $studentId, 'invoice' => $invoice->id]) }}"
                    method="POST" class="card" id="classForm">
                    @csrf
                    @method('PATCH') <!-- Since it's an update operation -->

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
                                        <label class="form-label" for="term">الفصل الدراسي</label>
                                        <select required id="term" name="term" class="form-select">
                                            <option value="الاول" {{ $invoice->term == 'الاول' ? 'selected' : '' }}>
                                                الاول</option>
                                            <option value="الثاني" {{ $invoice->term == 'الثاني' ? 'selected' : '' }}>
                                                الثاني</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="kind">نوع الفاتورة</label>
                                        <select required id="kind" name="kind" class="form-select">
                                            <option value="شهري" {{ $invoice->kind == 'شهري' ? 'selected' : '' }}>شهري
                                            </option>
                                            <option value="سنوي" {{ $invoice->kind == 'سنوي' ? 'selected' : '' }}>سنوي
                                            </option>
                                            <option value="الترم الاول"
                                                {{ $invoice->kind == 'الترم الاول' ? 'selected' : '' }}>الترم الاول
                                            </option>
                                            <option value="الترم الثاني"
                                                {{ $invoice->kind == 'الترم الثاني' ? 'selected' : '' }}>الترم الثاني
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="bus_subscription">اشتراك الاتوبيس</label>
                                        <input required type="number" id="bus_subscription" name="bus_subscription"
                                            min="0" class="form-control"
                                            value="{{ $invoice->bus_subscription }}" />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="uniform_subscription">اشتراك الزي</label>
                                        <input required type="number" id="uniform_subscription"
                                            name="uniform_subscription" min="0" class="form-control"
                                            value="{{ $invoice->uniform_subscription }}" />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="discount">الخصم</label>
                                        <input required type="number" id="discount" name="discount" min="0"
                                            class="form-control" value="{{ $invoice->discount }}" />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="main_subscription">قيمة الاشتراك</label>
                                        <input required type="number" id="main_subscription" name="main_subscription"
                                            min="0" class="form-control"
                                            value="{{ $invoice->main_subscription }}" />
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
