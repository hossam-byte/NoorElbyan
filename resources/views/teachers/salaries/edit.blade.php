<x-layout>
    <x-slot:title>
        تعديل راتب
    </x-slot:title>
    <x-slot:heading>
        تعديل راتب
    </x-slot:heading>

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Sticky Actions -->
        <div class="row">
            <div class="col-12">
                <form action="{{ route('teachers.salaries.update', [$teacher->id, $salary->id]) }}" method="POST"
                    class="card" id="salaryForm">
                    @csrf
                    @method('PATCH') <!-- Required for updating -->

                    <div
                        class="card-header sticky-element bg-label-secondary d-flex justify-content-end align-items-sm-center flex-column flex-sm-row">
                        <div class="action-btn">
                            <button type="submit" class="btn btn-primary">تحديث</button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="base_salary">الراتب الأساسي</label>
                                        <input required type="number" id="base_salary" name="base_salary"
                                            min="0" class="form-control"
                                            value="{{ old('base_salary', $salary->base_salary) }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="bonus">بدل الحافز</label>
                                        <input required type="number" id="bonus" name="bonus" min="0"
                                            class="form-control" value="{{ old('bonus', $salary->bonus) }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="loan_amount">المبلغ المستلف</label>
                                        <input required type="number" id="loan_amount" name="loan_amount"
                                            min="0" class="form-control"
                                            value="{{ old('loan_amount', $salary->loan_amount) }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="deduction">مبلغ الخصم</label>
                                        <input required type="number" id="deduction" name="deduction" min="0"
                                            class="form-control" value="{{ old('deduction', $salary->deduction) }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="total_salary">إجمالي الراتب</label>
                                        <input required type="number" id="total_salary" name="total_salary"
                                            min="0" class="form-control"
                                            value="{{ old('total_salary', $salary->total_salary) }}" readonly />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="month">الشهر</label>
                                        <input required type="text" id="month" name="month" readonly
                                            class="form-control" value="{{ old('month', $salary->month) }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="status">الحالة</label>
                                        <select required id="status" name="status" class="form-select">
                                            <option value="0" {{ $salary->status == 0 ? 'selected' : '' }}>قيد
                                                الانتظار</option>
                                            <option value="1" {{ $salary->status == 1 ? 'selected' : '' }}>مدفوع
                                            </option>
                                            <option value="2" {{ $salary->status == 2 ? 'selected' : '' }}>فشل
                                                الدفع</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const baseSalary = document.getElementById('base_salary');
            const bonus = document.getElementById('bonus');
            const loanAmount = document.getElementById('loan_amount');
            const deduction = document.getElementById('deduction');
            const totalSalary = document.getElementById('total_salary');

            function calculateTotalSalary() {
                const base = parseFloat(baseSalary.value) || 0;
                const bonusAmount = parseFloat(bonus.value) || 0;
                const loan = parseFloat(loanAmount.value) || 0;
                const deductions = parseFloat(deduction.value) || 0;
                totalSalary.value = base + bonusAmount - loan - deductions;
            }

            baseSalary.addEventListener('input', calculateTotalSalary);
            bonus.addEventListener('input', calculateTotalSalary);
            loanAmount.addEventListener('input', calculateTotalSalary);
            deduction.addEventListener('input', calculateTotalSalary);

            // Recalculate total salary on page load in case values are pre-filled
            calculateTotalSalary();
        });
    </script>
</x-layout>
