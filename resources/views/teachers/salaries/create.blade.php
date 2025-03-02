<x-layout>
    <x-slot:title>
        إضافة راتب
    </x-slot:title>
    <x-slot:heading>
        إضافة راتب
    </x-slot:heading>

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Sticky Actions -->
        <div class="row">
            <div class="col-12">
                <form action="{{ route('teachers.salaries.store', $teacher->id) }}" method="POST" class="card"
                    id="salaryForm">
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
                                        <label class="form-label" for="base_salary">الراتب الأساسي</label>
                                        <input required type="number" id="base_salary" name="base_salary"
                                            value="{{ $teacher->salary }}" min="0" class="form-control" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="bonus">بدل الحافز</label>
                                        <input type="number" id="bonus" name="bonus" min="0"
                                            class="form-control" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="loan_amount">المبلغ المستلف</label>
                                        <input type="number" id="loan_amount" name="loan_amount" min="0"
                                            class="form-control" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="deduction">مبلغ الخصم</label>
                                        <input type="number" id="deduction" name="deduction" min="0"
                                            class="form-control" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="total_salary">إجمالي الراتب</label>
                                        <input required type="number" id="total_salary" name="total_salary"
                                            min="0" class="form-control" readonly />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="month">الشهر</label>
                                        <input required type="text" id="month" name="month" readonly
                                            class="form-control" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="status">الحالة</label>
                                        <select required id="status" name="status" class="form-select">
                                            <option value="0">قيد الانتظار</option>
                                            <option value="1">مدفوع</option>
                                            <option value="2">فشل الدفع</option>
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

    @if (session('salary_duplicate'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var salaryDuplicate = new bootstrap.Modal(document.getElementById('salary_duplicate'), {
                    keyboard: false
                });
                salaryDuplicate.show();
            });
        </script>
    @endif

    <!-- Modal for Duplicate Salary -->
    <div class="modal fade" id="salary_duplicate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center">
                        <h3 class="text-danger">تمت إضافة راتب لهذا الشهر من قبل!</h3>
                    </div>
                </div>
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

            // Set the base salary from PHP variable
            const teacherSalary = parseFloat("{{ $teacher->salary }}") || 0;
            baseSalary.value = teacherSalary; // Set initial value

            function calculateTotalSalary() {
                const base = parseFloat(baseSalary.value) || 0;
                const bonusAmount = parseFloat(bonus.value) || 0;
                const loan = parseFloat(loanAmount.value) || 0;
                const deductions = parseFloat(deduction.value) || 0;
                totalSalary.value = base + bonusAmount - loan - deductions;
            }

            // Initial calculation when page loads
            calculateTotalSalary();

            baseSalary.addEventListener('input', calculateTotalSalary);
            bonus.addEventListener('input', calculateTotalSalary);
            loanAmount.addEventListener('input', calculateTotalSalary);
            deduction.addEventListener('input', calculateTotalSalary);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const monthInput = document.getElementById('month');

            // Get current month and year
            const date = new Date();
            const months = [
                "يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو",
                "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"
            ];
            const currentMonth = months[date.getMonth()];
            const currentYear = date.getFullYear();

            // Set default value
            monthInput.value = `${currentMonth} ${currentYear}`;
        });
    </script>

</x-layout>
