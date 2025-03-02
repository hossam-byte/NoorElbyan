<x-layout>
    <x-slot:title>
        بيانات المعلم - {{ $teacher->name }}
    </x-slot:title>
    <x-slot:heading>
        معلومات معلمين المؤسسة
    </x-slot:heading>

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- User Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                <!-- User Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <img class="img-fluid rounded my-4" src="../../assets/img/avatars/10.png" height="110"
                                    width="110" alt="User avatar" />
                                <div class="user-info text-center">
                                    <h4 class="mb-2">{{ $teacher->name }}</h4>
                                </div>
                            </div>
                        </div>
                        <h5 class="pb-2 border-bottom mb-4 mt-4">التفاصيل</h5>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <span class="fw-medium me-2">رقم الهاتف:</span>
                                    <span>{{ $teacher->phone_number }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">المؤهل:</span>
                                    <span>{{ $teacher->education }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">العمر:</span>
                                    <span>{{ Carbon\Carbon::parse($teacher->birthdate)->age }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">تاريخ الميلاد:</span>
                                    <span>{{ $teacher->birthdate }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">محل الاقامة:</span>
                                    <span>{{ $teacher->address }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">الفتره:</span>
                                    <span>{{ $teacher->duration }}</span>
                                <li class="mb-3">
                                    <span class="fw-medium me-2"> المادة:</span>
                                    <span>{{ $teacher->subject }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">التخصص الدراسي:</span>
                                    <span>{{ $teacher->education }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">الفصل:</span>
                                    <span>{{ $teacher->academyClass->name }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">الراتب:</span>
                                    <span>{{ $teacher->salary }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">تاريخ التوظيف:</span>
                                    <span>{{ $teacher->hiring_date }}</span>
                                </li>
                            </ul>
                            <div class="d-flex justify-content-center pt-3">
                                <a href="{{ route('teachers.edit', $teacher->id) }}"
                                    class="btn btn-primary me-3">تعديل</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ User Sidebar -->

            <!-- User Content -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#salary" aria-controls="first-duration" aria-selected="true">
                                الراتب
                            </button>
                        </li>
                        {{-- <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#bonus" aria-controls="second-duration" aria-selected="false">
                                اضافة حافز
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#advance" aria-controls="archive" aria-selected="false">
                                اضافة سلفة
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#deduction" aria-controls="archive" aria-selected="false">
                                اضافة خصم
                            </button>
                        </li> --}}
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#absence" aria-controls="absence" aria-selected="false">
                                الغياب الشهري
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content border-0 p-0">
                        <div class="tab-pane fade show active" id="salary" role="tabpanel">
                            <div class="card">

                                <div class="d-flex align-items-center justify-content-between ">
                                    <h5 class="card-header d-flex gap-3">سجل الراتب الشهري</h5>
                                    <a href="{{ route('teachers.salaries.create', $teacher->id) }}"
                                        class="btn btn-success suspend-user me-4">اضافة الراتب</a>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>الراتب</th>
                                                <th>بدل الحافز</th>
                                                <th>المبلخ المستلف</th>
                                                <th>مبلغ الخصم</th>
                                                <th>اجمالي الراتب</th>
                                                <th>الشهر</th>
                                                <th>الحالة</th>
                                                <th>اجراء</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @foreach ($teacher->salaries as $salary)
                                                <tr>
                                                    <td>{{ $salary->base_salary }}</td>
                                                    <td>{{ $salary->bonus }}</td>
                                                    <td>{{ $salary->loan_amount }}</td>
                                                    <td>{{ $salary->deduction }}</td>
                                                    <td>{{ $salary->total_salary }}</td>
                                                    <td>{{ $salary->month }}</td>
                                                    <td>
                                                        @if ($salary->status == 0)
                                                            <span class="badge bg-warning">الانتظار</span>
                                                        @elseif ($salary->status == 1)
                                                            <span class="badge bg-success">مدفوع</span>
                                                        @elseif ($salary->status == 2)
                                                            <span class="badge bg-danger">مرفوض</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('teachers.salaries.edit', ['teacher' => $salary->teacher_id, 'salary' => $salary->id]) }}">
                                                                    <i class="bx bx-edit-alt me-1"></i> تعديل
                                                                </a>
                                                                <form
                                                                    action="{{ route('teachers.salaries.destroy', ['teacher' => $salary->teacher_id, 'salary' => $salary->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="dropdown-item bg-label-danger"
                                                                        onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                                        <i class="bx bx-trash me-1"></i> حذف
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                        {{-- <div class="tab-pane fade " id="bonus" role="tabpanel">
                            <div class="card">

                                <div class="d-flex align-items-center justify-content-between ">
                                    <h5 class="card-header d-flex gap-3">سجل اضافة الحوافز</h5>
                                    <a href="#" class="btn btn-success suspend-user me-4"
                                        data-bs-target="#add-bonus" data-bs-toggle="modal">اضافة الراتب</a>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>المبلغ</th>
                                                <th>التاريخ</th>
                                                <th>اجراء</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <tr>
                                                <td>10000</td>
                                                <td>ديسمبر</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="">
                                                                <i class="bx bx-edit-alt me-1"></i>تعديل
                                                            </a>
                                                            <a class="dropdown-item bg-label-danger" href="">
                                                                <i class="bx bx-edit-alt me-1"></i>حذف
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                        <div class="tab-pane fade " id="advance" role="tabpanel">
                            <div class="card">

                                <div class="d-flex align-items-center justify-content-between ">
                                    <h5 class="card-header d-flex gap-3">سجل اضافة السلف</h5>
                                    <a href="#" class="btn btn-success suspend-user me-4"
                                        data-bs-target="#add-advance" data-bs-toggle="modal">اضافة سلفة</a>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>المبلغ</th>
                                                <th>التاريخ</th>
                                                <th>اجراء</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <tr>
                                                <td>10000</td>
                                                <td>ديسمبر</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="">
                                                                <i class="bx bx-edit-alt me-1"></i>تعديل
                                                            </a>
                                                            <a class="dropdown-item bg-label-danger" href="">
                                                                <i class="bx bx-edit-alt me-1"></i>حذف
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                        <div class="tab-pane fade " id="deduction" role="tabpanel">
                            <div class="card">

                                <div class="d-flex align-items-center justify-content-between ">
                                    <h5 class="card-header d-flex gap-3">سجل اضافة الخصم</h5>
                                    <a href="#" class="btn btn-success suspend-user me-4"
                                        data-bs-target="#add-deduction" data-bs-toggle="modal">اضافة خصم</a>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>المبلغ</th>
                                                <th>التاريخ</th>
                                                <th>اجراء</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <tr>
                                                <td>10000</td>
                                                <td>ديسمبر</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="">
                                                                <i class="bx bx-edit-alt me-1"></i>تعديل
                                                            </a>
                                                            <a class="dropdown-item bg-label-danger" href="">
                                                                <i class="bx bx-edit-alt me-1"></i>حذف
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div> --}}
                        <div class="tab-pane fade" id="absence" role="tabpanel">
                            <div class="card">

                                <div class="d-flex align-items-center justify-content-between ">
                                    <h5 class="card-header d-flex gap-3">قائمة الغياب الخاصه بشهر -
                                        {{ $currentMonth->locale('ar')->isoFormat('MMMM') }}</h5>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <td>اليوم</td>
                                                <td>التاريخ</td>
                                                <td>الحضور</td>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @php
                                                $currentYear = now()->format('Y'); // Current year
                                                $currentMonthNumber = \Carbon\Carbon::parse($currentMonth)->format('m'); // Get month number from name
                                                $daysInMonth = \Carbon\Carbon::createFromFormat(
                                                    'Y-m',
                                                    "{$currentYear}-{$currentMonthNumber}",
                                                )->daysInMonth; // Number of days
                                            @endphp

                                            @for ($day = 1; $day <= $daysInMonth; $day++)
                                                @php
                                                    // Create a Carbon instance for the current day
                                                    $date = \Carbon\Carbon::create(
                                                        $currentYear,
                                                        $currentMonthNumber,
                                                        $day,
                                                    );
                                                    // Format the day name in Arabic
                                                    $dayName = $date->locale('ar')->isoFormat('dddd'); // Full day name in Arabic
                                                    // Format the date as "Y-m-d" for comparison
                                                    $formattedDate = $date->format('Y-m-d');
                                                    // Find the absence record for this date
                                                    $absenceRecord = $monthlyAbsence->firstWhere(
                                                        'date',
                                                        $formattedDate,
                                                    );
                                                @endphp
                                                <tr>
                                                    <td>{{ $dayName }}</td>
                                                    <td>{{ $date->format('d/m/Y') }}</td>
                                                    <td>
                                                        @if ($absenceRecord)
                                                            {{-- If an absence record exists for this date --}}
                                                            @if ($absenceRecord->is_present)
                                                                @php
                                                                    $attendanceDaysNum++;
                                                                @endphp
                                                                <div class="badge badge-center bg-label-success">
                                                                    <i class="fa-solid fa-check"></i>
                                                                </div>
                                                            @else
                                                                @php
                                                                    $absenceDaysNum++;
                                                                @endphp
                                                                <div class="badge badge-center bg-label-danger">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </div>
                                                            @endif
                                                        @else
                                                            {{-- If no absence record exists for this date --}}
                                                            <div class="form-check">
                                                                <input class="form-check-input" style="padding: 10px"
                                                                    type="checkbox" disabled />
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                        <tfoot class="mt-2">
                                            <tr>
                                                <th colspan="2">عدد ايام الحضور</th>
                                                <th>
                                                    <span class="selected-count">{{ $attendanceDaysNum }}</span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="2">عدد ايام الغياب</th>
                                                <th>
                                                    <span class="selected-count">{{ $absenceDaysNum }}</span>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
            <!--/ User Content -->
        </div>

        <!-- Modal -->
        <!-- Edit User Modal -->
        <div class="modal fade" id="add-bonus" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <form id="addTaxForm" class="row g-3" onsubmit="return false">
                            <div class="col-md-12">
                                <label class="form-label" for="">مبلغ الحافز</label>
                                <input type="number" id="alt-num" class="form-control" />
                            </div>
                            <div class="col-md-12">
                                <label for="student-birth" class="form-label">تاريخ الاضافة</label>
                                <div class="input-group input-group-merge">
                                    <input type="date" id="student-birth" name="student-birth"
                                        class="form-control" required />
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">اضافة الحافز</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    الغاء
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="add-advance" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <form id="addTaxForm" class="row g-3" onsubmit="return false">
                            <div class="col-md-12">
                                <label class="form-label" for="">مبلغ السلفة</label>
                                <input type="number" id="alt-num" class="form-control" />
                            </div>
                            <div class="col-md-12">
                                <label for="student-birth" class="form-label">تاريخ الاضافة</label>
                                <div class="input-group input-group-merge">
                                    <input type="date" id="student-birth" name="student-birth"
                                        class="form-control" required />
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">اضافة السلفة</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    الغاء
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="add-deduction" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <form id="addTaxForm" class="row g-3" onsubmit="return false">
                            <div class="col-md-12">
                                <label class="form-label" for="">مبلغ الخصم</label>
                                <input type="number" id="alt-num" class="form-control" />
                            </div>
                            <div class="col-md-12">
                                <label for="student-birth" class="form-label">تاريخ الاضافة</label>
                                <div class="input-group input-group-merge">
                                    <input type="date" id="student-birth" name="student-birth"
                                        class="form-control" required />
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">اضافة الخصم</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    الغاء
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Edit User Modal -->
        @if (session('salary_addeded'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var salaryAdded = new bootstrap.Modal(document.getElementById('salary_addeded'), {
                        keyboard: false
                    });
                    salaryAdded.show();
                });
            </script>
        @endif

        @if (session('salary_updated'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var salaryUpdated = new bootstrap.Modal(document.getElementById('salary_updated'), {
                        keyboard: false
                    });
                    salaryUpdated.show();
                });
            </script>
        @endif

        @if (session('salary_deleted'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var salaryDeleted = new bootstrap.Modal(document.getElementById('salary_deleted'), {
                        keyboard: false
                    });
                    salaryDeleted.show();
                });
            </script>
        @endif

        <!-- Modal for Salary Added -->
        <div class="modal fade" id="salary_addeded" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <div class="text-center ">
                            <h3 class="text-success">تم إضافة الراتب بنجاح</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Salary Updated -->
        <div class="modal fade" id="salary_updated" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <div class="text-center ">
                            <h3 class="text-primary">تم تحديث الراتب بنجاح</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Salary Deleted -->
        <div class="modal fade" id="salary_deleted" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <div class="text-center ">
                            <h3 class="text-danger">تم حذف الراتب بنجاح</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- / Content -->


</x-layout>
