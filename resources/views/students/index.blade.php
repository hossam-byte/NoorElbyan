@php use Carbon\Carbon; @endphp
<x-layout>
    <x-slot:title>
        قائمه الطلاب
    </x-slot:title>
    <x-slot:heading>
        معلومات طلاب المؤسسة
    </x-slot:heading>
    <div class="container-xxl container-p-y">

        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="d-flex align-items-start justify-content-end">

            </div>
            <div class="d-flex align-items-center justify-content-between ">
                <h4 class="py-3 mb-4"><span class="text-light fw-bold">العام الدراسي يبدأ في /</span> 01-10-2024</h4>
            </div>
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#first-duration" aria-controls="first-duration" aria-selected="true">
                            صباحي
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#second-duration" aria-controls="second-duration" aria-selected="false">
                            مسائي
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#archive" aria-controls="archive" aria-selected="false">
                            الارشيف
                        </button>
                    </li>
                </ul>
                <div class="tab-content border-0 p-0">
                    <div class="tab-pane fade show active" id="first-duration" role="tabpanel">
                        <div class="card">

                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-header d-flex gap-3">قائمة الطلاب</h5>
                                <a href="{{ route('students.create', ['duration' => 'صباحي']) }}"
                                    class="btn btn-success m-4">اضافة طالب</a>
                            </div>
                            <div class="card-body d-flex align-items-center gap-2 mb-3">
                                <!-- Search Input -->
                                <input type="text" id="tableSearch" class="form-control" placeholder="البحث..."
                                    onkeyup="searchTable()" />
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>النوع</th>
                                            <th>السن</th>
                                            <th>رقم ولي الامر</th>
                                            <th>العنوان</th>
                                            <th>نوع الفاتورة</th>
                                            <th>الفصل</th>
                                            <th>الفتره</th>
                                            <th>الحاله</th>
                                            <th>اسم الباص</th>
                                            <th>اجراء</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @if ($firstDurationStudents->isEmpty())
                                            <tr class="py-4 text-center fw-bold">
                                                <td colspan="9">لا يوجد طلاب في الارشيف </td>
                                            </tr>
                                        @endif
                                        @foreach ($firstDurationStudents as $index => $student)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <img class="avatar avatar-x pull-up rounded-circle"
                                                        src="../../assets/img/avatars/6.png" alt="Avatar"
                                                        class="rounded-circle" />
                                                    <span class="fw-medium ms-1">{{ $student->name }}</span>
                                                </td>
                                                <td>{{ $student->gender }}</td>
                                                <td>{{ Carbon::parse($student->birthdate)->age }}</td>
                                                <td>{{ $student->father_phone }}</td>
                                                <td>{{ $student->address }}</td>
                                                <td>{{ $student->pricing_plan }}</td>
                                                <td>{{ $student->academyClass->name }}</td>
                                                <td>{{ $student->duration }}</td>
                                                @php
                                                    $currentYear = now()->year;
                                                    $targetDate = Carbon::create($currentYear, 10, 1); // October 1 of the current year

                                                    // Convert the birthdate string to a Carbon instance
                                                    $birthdate = Carbon::parse($student->birthdate);

                                                    // Calculate the student's age as of the target date
                                                    $age = $birthdate->diffInYears($targetDate);
                                                @endphp

                                                @if ($age >= 6 && $age <= 9)
                                                    <td>
                                                        <span class="badge bg-label-success me-1">مؤهل</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="badge bg-label-danger me-1">غير مؤهل</span>
                                                    </td>
                                                @endif
                                                <td>{{ $student->driver_id ? $student->driver->name : 'لا يوجد باص' }}
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
                                                                href="{{ route('students.edit', $student->id) }}">
                                                                <i class="bx bx-edit-alt me-1"></i>تعديل
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('students.show', $student->id) }}">
                                                                <i class="bx bx-edit-alt me-1"></i>عرض بيانات الطالب
                                                            </a>
                                                            <form
                                                                action="{{ route('students.destroy', $student->id) }}"
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
                    <div class="tab-pane fade" id="second-duration" role="tabpanel">
                        <div class="tab-pane fade show active" id="first-duration" role="tabpanel">
                            <div class="card">
                                <div class="d-flex align-items-center justify-content-between ">
                                    <h5 class="card-header d-flex gap-3">قائمة الطلاب</h5>
                                    <a href="{{ route('students.create', ['duration' => 'مسائي']) }}"
                                        class="btn btn-success m-4">اضافة طالب</a>
                                </div>
                                <div class="card-body d-flex align-items-center gap-2 mb-3">
                                    <!-- Search Input -->
                                    <input type="text" id="tableSearch" class="form-control" placeholder="البحث..."
                                        onkeyup="searchTable()" />
                                </div>


                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الاسم</th>
                                                <th>النوع</th>
                                                <th>السن</th>
                                                <th>رقم ولي الامر</th>
                                                <th>العنوان</th>
                                                <th>نوع الفاتورة</th>
                                                <th>الفصل</th>
                                                <th>الفتره</th>
                                                <th>الحاله</th>
                                                <th>اسم الباص</th>
                                                <th>اجراء</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @if ($secondDurationStudents->isEmpty())
                                                <tr class="py-4 text-center fw-bold">
                                                    <td colspan="9">لا يوجد طلاب في الارشيف </td>
                                                </tr>
                                            @endif
                                            @foreach ($secondDurationStudents as $index => $student)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <img class="avatar avatar-x pull-up rounded-circle"
                                                            src="../../assets/img/avatars/6.png" alt="Avatar"
                                                            class="rounded-circle" />
                                                        <span class="fw-medium ms-1">{{ $student->name }}</span>
                                                    </td>
                                                    <td>{{ $student->gender }}</td>
                                                    <td>{{ Carbon::parse($student->birthdate)->age }}</td>
                                                    <td>{{ $student->father_phone }}</td>
                                                    <td>{{ $student->address }}</td>
                                                    <td>{{ $student->pricing_plan }}</td>
                                                    <td>
                                                        {{ $student->academyClass === 0 ? 'بدون فصل' : $student->academyClass->name }}
                                                    </td>
                                                    <td>{{ $student->duration }}</td>
                                                    @php
                                                        $currentYear = now()->year;
                                                        $targetDate = Carbon::create($currentYear, 10, 1); // October 1 of the current year

                                                        // Convert the birthdate string to a Carbon instance
                                                        $birthdate = Carbon::parse($student->birthdate);

                                                        // Calculate the student's age as of the target date
                                                        $age = $birthdate->diffInYears($targetDate);
                                                    @endphp

                                                    @if ($age >= 6 && $age <= 9)
                                                        <td>
                                                            <span class="badge bg-label-success me-1">مؤهل</span>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="badge bg-label-danger me-1">غير مؤهل</span>
                                                        </td>
                                                    @endif
                                                    <td>{{ $student->bus_name }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('students.edit', $student->id) }}">
                                                                    <i class="bx bx-edit-alt me-1"></i>تعديل
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('students.show', $student->id) }}">
                                                                    <i class="bx bx-edit-alt me-1"></i>عرض بيانات
                                                                    الطالب
                                                                </a>
                                                                <form
                                                                    action="{{ route('students.destroy', $student->id) }}"
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
                    </div>
                    <div class="tab-pane fade" id="archive" role="tabpanel">
                        <div class="tab-pane fade show active" id="first-duration" role="tabpanel">
                            <div class="card">
                                <div class="d-flex align-items-center justify-content-between ">
                                    <h5 class="card-header d-flex gap-3">قائمة الطلاب</h5>
                                </div>
                                <div class="card-body d-flex align-items-center gap-2 mb-3">
                                    <!-- Search Input -->
                                    <input type="text" id="tableSearch" class="form-control"
                                        placeholder="البحث..." onkeyup="searchTable()" />
                                </div>


                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الاسم</th>
                                                <th>النوع</th>
                                                <th>السن</th>
                                                <th>رقم ولي الامر</th>
                                                <th>العنوان</th>
                                                <th>نوع الفاتورة</th>
                                                <th>الفصل</th>
                                                <th>الفتره</th>
                                                <th>الحاله</th>
                                                <th>اسم الباص</th>
                                                <th>اجراء</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @if ($archiveStudents->isEmpty())
                                                <tr class="py-4 text-center fw-bold">
                                                    <td colspan="9">لا يوجد طلاب في الارشيف </td>
                                                </tr>
                                            @endif
                                            @foreach ($archiveStudents as $index => $student)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <img class="avatar avatar-x pull-up rounded-circle"
                                                            src="../../assets/img/avatars/6.png" alt="Avatar"
                                                            class="rounded-circle" />
                                                        <span class="fw-medium ms-1">{{ $student->name }}</span>
                                                    </td>
                                                    <td>{{ $student->gender }}</td>
                                                    <td>{{ Carbon::parse($student->birthdate)->age }}</td>
                                                    <td>{{ $student->father_phone }}</td>
                                                    <td>{{ $student->address }}</td>
                                                    <td>{{ $student->pricing_plan }}</td>
                                                    <td>{{ $student->academyClass->name }}</td>
                                                    <td>{{ $student->duration }}</td>
                                                    @php
                                                        $currentYear = now()->year;
                                                        $targetDate = Carbon::create($currentYear, 10, 1); // October 1 of the current year

                                                        // Convert the birthdate string to a Carbon instance
                                                        $birthdate = Carbon::parse($student->birthdate);

                                                        // Calculate the student's age as of the target date
                                                        $age = $birthdate->diffInYears($targetDate);
                                                    @endphp

                                                    @if ($age >= 6 && $age <= 9)
                                                        <td>
                                                            <span class="badge bg-label-success me-1">مؤهل</span>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="badge bg-label-danger me-1">غير مؤهل</span>
                                                        </td>
                                                    @endif
                                                    <td>{{ $student->bus_name }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('students.edit', $student->id) }}">
                                                                    <i class="bx bx-edit-alt me-1"></i>تعديل
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('students.show', $student->id) }}">
                                                                    <i class="bx bx-edit-alt me-1"></i>عرض بيانات
                                                                    الطالب
                                                                </a>
                                                                <form
                                                                    action="{{ route('students.destroy', $student->id) }}"
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
                    </div>
                </div>
            </div>

        </div>
    </div>
    @if (session('student_created'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var student_created = new bootstrap.Modal(document.getElementById('student_created'), {
                    keyboard: false
                });
                student_created.show();
            });
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="student_created" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center ">
                        <h3 class="text-success">تم اضافة الطالب بنجاح</h3>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if (session('student_updated'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var student_updated = new bootstrap.Modal(document.getElementById('student_updated'), {
                    keyboard: false
                });
                student_updated.show();
            });
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="student_updated" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center ">
                        <h3 class="text-success">تم تعديل بيانات الطالب بنجاح</h3>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if (session('student_deleted'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var student_deleted = new bootstrap.Modal(document.getElementById('student_deleted'), {
                    keyboard: false
                });
                student_deleted.show();
            });
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="student_deleted" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center ">
                        <h3 class="text-success">تم حذف الطالب بنجاح</h3>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const table = document.getElementById("dataTable");
            const rows = Array.from(table.getElementsByTagName("tbody")[0].rows);
            const searchInput = document.getElementById("tableSearch");
            const dropdowns = document.querySelectorAll("select[id='columnFilter']");

            // Function to filter rows
            function filterTable() {
                const searchValue = searchInput.value.toLowerCase();
                const filters = Array.from(dropdowns).map(dropdown => dropdown.value);

                rows.forEach(row => {
                    const cells = Array.from(row.cells);
                    const cellText = cells.map(cell => cell.textContent.toLowerCase());

                    // Check if the row matches the search input
                    const matchesSearch = cellText.some(text => text.includes(searchValue));

                    // Check if the row matches all active dropdown filters
                    const matchesFilters = filters.every((filter, index) => {
                        if (filter === "all" || filter === "اختر الفصل" || filter ===
                            "اختر الباص" || filter === "اختر الحاله") {
                            return true;
                        }
                        return cells.some(cell => cell.textContent.trim() === filter);
                    });

                    // Show or hide rows based on the conditions
                    row.style.display = matchesSearch && matchesFilters ? "" : "none";
                });
            }

            // Event listener for search input
            searchInput.addEventListener("input", filterTable);

            // Event listeners for dropdowns
            dropdowns.forEach(dropdown => {
                dropdown.addEventListener("change", filterTable);
            });
        });
    </script>


</x-layout>
