<x-layout>
    <x-slot:title>
        بيانات الطالب - {{ $student->name }}
    </x-slot:title>
    <x-slot:heading>
        معلومات طلاب المؤسسة
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
                                    <h4 class="mb-2">{{ $student->name }}</h4>
                                </div>
                            </div>
                        </div>
                        <h5 class="pb-2 border-bottom mb-4 mt-4">التفاصيل</h5>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <span class="fw-medium me-2">رقم ولي الامر:</span>
                                    <span>{{ $student->father_phone }}</span>
                                </li>
                                @if ($student->alt_father_phone)
                                    <li class="mb-3">
                                        <span class="fw-medium me-2">رقم ولي الامر:</span>
                                        <span>{{ $student->alt_father_phone }}</span>
                                    </li>
                                @endif
                                <li class="mb-3">
                                    <span class="fw-medium me-2">الحالة:</span>
                                    <span
                                        class="badge bg-label-{{ $student->is_archive ? 'danger' : 'success' }}">{{ $student->is_archive ? 'مؤرشف' : 'مفعل' }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">العمر:</span>
                                    <span>
                                        @php
                                            $birthdate = \Carbon\Carbon::parse($student->birthdate);
                                            $now = \Carbon\Carbon::now();
                                            $age = $birthdate->diff($now);

                                            echo $age->y . ' سنوات, ' . $age->m . ' أشهر, ' . $age->d . ' أيام';
                                        @endphp
                                    </span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">تاريخ الميلاد:</span>
                                    <span>{{ $student->birthdate }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">محل الاقامة:</span>
                                    <span>{{ $student->address }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">نوع الفاتورة:</span>
                                    <span>{{ $student->pricing_plan }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">الفتره:</span>
                                    <span>{{ $student->duration }}</span>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">الفصل:</span>
                                    <span>{{ $student->academyClass->name }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">الباص:</span>
                                    <span>{{ $student->driver_id ? $student->driver->name : 'لا يوجد باص' }}
                                    </span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium me-2">تاريخ التقديم:</span>
                                    <span>{{ $student->submission_date }}</span>
                                </li>
                            </ul>
                            <div class="d-flex justify-content-center pt-3">
                                <a href="{{ route('students.edit', $student->id) }}"
                                    class="btn btn-primary me-3">تعديل</a>
                                <a href="{{ route('students.invoices.create', $student->id) }}"
                                    class="btn btn-success suspend-user">اضافة فاتوره</a>
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
                                data-bs-target="#first-duration" aria-controls="first-duration" aria-selected="true">
                                فواتير الطالب
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#quizzes-grades" aria-controls="quizzes-grades" aria-selected="false">
                                الاختبارات
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#absence" aria-controls="absence" aria-selected="false">
                                الغياب الشهري
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content border-0 p-0">
                        <div class="tab-pane fade active show" id="first-duration" role="tabpanel">
                            <div class="card">

                                <div class="d-flex align-items-center justify-content-between ">
                                    <h5 class="card-header d-flex gap-3">قائمة الفواتير</h5>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>نوع الفاتوره</th>
                                                <th>الفصل الدراسي</th>
                                                <th>التاريخ</th>
                                                <th>الاجمالي</th>
                                                <th>المبلغ المدفوع</th>
                                                <th>المبلغ المتبقي</th>
                                                <th>الحالة</th>
                                                <th>اجراء</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @foreach ($student->invoices as $invoice)
                                                <tr>
                                                    <td>{{ $invoice->kind }}</td>
                                                    <td>{{ $invoice->term }}</td>
                                                    <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                                                    <td>{{ $invoice->total_amount }}
                                                    </td>
                                                    <td>{{ $invoice->paied_amount }}</td>
                                                    <td>{{ $invoice->remaining_amount }}</td>
                                                    <td>
                                                        @if ($invoice->status)
                                                            <span class="badge bg-label-success me-1">مدفوع</span>
                                                        @else
                                                            <span class="badge bg-label-danger me-1">غير مدفوع</span>
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
                                                                    href="{{ route('students.invoices.edit', ['student' => $student->id, 'invoice' => $invoice->id]) }}">
                                                                    <i class="bx bx-edit alt me-1"></i> تعديل
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('students.invoices.show', ['student' => $student->id, 'invoice' => $invoice->id]) }}">
                                                                    <i
                                                                        class="bx bx-edit
                                                                    alt me-1"></i>عرض
                                                                    التفاصيل
                                                                </a>
                                                                <form
                                                                    action="{{ route('students.invoices.destroy', ['student' => $student->id, 'invoice' => $invoice->id]) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="dropdown-item bg-label-danger">
                                                                        <i class="bx bx-trash me-1"></i>حذف
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
                        <div class="tab-pane fade " id="quizzes-grades" role="tabpanel">
                            <div class="card">

                                <div class="d-flex align-items-center justify-content-between ">
                                    <h5 class="card-header d-flex gap-3">قائمة الفواتير</h5>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <td>اسم الماده</td>
                                                <td>درجة الطالب</td>
                                                <td>الدرجة النهائية</td>
                                                <td>التقدير</td>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @foreach ($grades as $grade)
                                                <tr>
                                                    <td>{{ $grade->quiz->title }}</td>
                                                    <td>{{ $grade->grade }}</td>
                                                    <td>{{ $grade->quiz->final_grade }}</td>
                                                    <td>
                                                        @php
                                                            $studentGrade = $grade->grade; // Student's grade
$finalGrade = $grade->quiz->final_grade; // Final grade
$badgeClass = '';
$badgeText = '';

$percentage = ($studentGrade / $finalGrade) * 100;

if ($percentage >= 81) {
    $badgeClass = 'bg-label-success';
    $badgeText = 'ممتاز';
} elseif ($percentage >= 71) {
    $badgeClass = 'bg-label-primary';
    $badgeText = 'جيد جدا';
} elseif ($percentage >= 61) {
    $badgeClass = 'bg-label-info';
    $badgeText = 'جيد';
} elseif ($percentage >= 50) {
    $badgeClass = 'bg-label-warning';
    $badgeText = 'مقبول';
} else {
    $badgeClass = 'bg-label-danger';
    $badgeText = 'راسب';
                                                            }
                                                        @endphp

                                                        <span
                                                            class="badge {{ $badgeClass }} me-1">{{ $badgeText }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>

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

        <!-- /Modal -->
        @if (session('invoice_created'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var invoice_created = new bootstrap.Modal(document.getElementById('invoice_created'), {
                        keyboard: false
                    });
                    invoice_created.show();
                });
            </script>
        @endif

        <!-- Modal -->
        <div class="modal fade" id="invoice_created" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <div class="text-center ">
                            <h3 class="text-success">تم اضافة الفاتورة بنجاح</h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @if (session('invoice_updated'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var invoice_updated = new bootstrap.Modal(document.getElementById('invoice_updated'), {
                        keyboard: false
                    });
                    invoice_updated.show();
                });
            </script>
        @endif

        <!-- Modal -->
        <div class="modal fade" id="invoice_updated" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <div class="text-center ">
                            <h3 class="text-success">تم تعديل الفاتورة بنجاح</h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @if (session('invoice_deleted'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var invoice_deleted = new bootstrap.Modal(document.getElementById('invoice_deleted'), {
                        keyboard: false
                    });
                    invoice_deleted.show();
                });
            </script>
        @endif

        <!-- Modal -->
        <div class="modal fade" id="invoice_deleted" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <div class="text-center ">
                            <h3 class="text-danger">تم حذف الفاتورة بنجاح</h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- / Content -->


</x-layout>
