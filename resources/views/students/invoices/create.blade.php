<x-layout>
    <x-slot:title>
        اضافة فاتوره
    </x-slot:title>
    <x-slot:heading>
        اضافة فاتوره
    </x-slot:heading>

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Sticky Actions -->
        <div class="row">
            <div class="col-12">
                <form action="{{ route('students.invoices.store', $studentId) }}" method="POST" class="card"
                    id="classForm">
                    @csrf
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
                                        <label class="form-label" for="term"> الفصل الدراسي</label>
                                        <select required id="term" name="term" class="form-select">
                                            <option value="الاول">الاول</option>
                                            <option value="الثاني">الثاني</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="kind">نوع الفاتورة</label>
                                        <select required id="kind" name="kind" class="form-select">
                                            <option value="شهري">شهري</option>
                                            <option value="سنوي">سنوي</option>
                                            <option value="الترم الاول">الترم الاول</option>
                                            <option value="الترم الثاني">الترم الثاني</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="bus_subscription">اشتراك الاتوبيس</label>
                                        <input required type="number" id="bus_subscription" name="bus_subscription"
                                            min="0" class="form-control" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="uniform_subscription">اشتراك الزي</label>
                                        <input required type="number" id="uniform_subscription"
                                            name="uniform_subscription" min="0" class="form-control" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="discount">الخصم</label>
                                        <input required type="number" id="discount" name="discount"
                                            min="0"class="form-control" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="main_subscription">قيمة الاشتراك</label>
                                        <input required type="number" id="main_subscription" name="main_subscription"
                                            min="0" class="form-control" />
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
