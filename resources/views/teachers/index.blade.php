<x-layout>
    <x-slot:title>
        قائمه المعلمين
    </x-slot:title>
    <x-slot:heading>
        معلومات معلمين المؤسسة
    </x-slot:heading>
    <div class="container-xxl container-p-y">

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex align-items-start justify-content-end">
            </div>
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button
                            type="button"
                            class="nav-link active"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#first-duration"
                            aria-controls="first-duration"
                            aria-selected="true">
                            صباحي
                        </button>
                    </li>
                    <li class="nav-item">
                        <button
                            type="button"
                            class="nav-link"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#second-duration"
                            aria-controls="second-duration"
                            aria-selected="false">
                            مسائي
                        </button>
                    </li>
                    <li class="nav-item">
                        <button
                            type="button"
                            class="nav-link"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#archive"
                            aria-controls="archive"
                            aria-selected="false">
                            الارشيف
                        </button>
                    </li>
                </ul>
                <div class="tab-content border-0 p-0">
                    <div class="tab-pane fade show active" id="first-duration" role="tabpanel">
                        <div class="card">
                            <div class="d-flex align-items-center justify-content-between ">
                                <h5 class="card-header d-flex gap-3">قائمة المعلمين</h5>
                                <a href="{{route('teachers.create', ['duration' => 'صباحي'])}}" class="btn btn-success m-4">اضافة معلم</a>
                            </div>
                            <div class="card-body d-flex align-items-center gap-2 mb-3">
                                <!-- Search Input -->
                                <input
                                    type="text"
                                    id="tableSearch"
                                    class="form-control"
                                    placeholder="البحث..."
                                    onkeyup="searchTable()"
                                />
                            </div>


                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>العمر</th>
                                        <th>رقم الهاتف</th>
                                        <th>الماده</th>
                                        <th>الفصل</th>
                                        <th>النوع</th>
                                        <th>الراتب</th>
                                        <th>اجراء</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                    @if($firstDurationTeachers->isEmpty())
                                        <tr class="py-4 text-center fw-bold">
                                            <td colspan="9">لا يوجد معلمين في الفترة الصباحية</td>
                                        </tr>
                                    @endif
                                    @foreach($firstDurationTeachers as $index => $teacher)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>
                                                <img class="avatar avatar-x pull-up rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                                <span class="fw-medium ms-1">{{$teacher->name}}</span>
                                            </td>
                                            <td>{{Carbon\Carbon::parse($teacher->birthdate)->age}}</td>
                                            <td>{{$teacher->phone_number}}</td>
                                            <td>{{$teacher->subject}}</td>
                                            <td>{{$teacher->academyClass->name}}</td>
                                            <td>{{$teacher->gender}}</td>
                                            <td>{{$teacher->salary}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('teachers.edit', $teacher->id)}}">
                                                            <i class="bx bx-edit-alt me-1"></i>تعديل
                                                        </a>
                                                            <a class="dropdown-item" href="{{route('teachers.show', $teacher->id)}}">
                                                                <i class="bx bx-edit-alt me-1"></i>عرض بيانات المعلم
                                                            </a>
                                                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display: inline;">
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
                                    <h5 class="card-header d-flex gap-3">قائمة المعلمين</h5>
                                    <a href="{{route('teachers.create', ['duration' => 'مسائي'])}}" class="btn btn-success m-4">اضافة معلم</a>
                                </div>
                                <div class="card-body d-flex align-items-center gap-2 mb-3">
                                    <!-- Search Input -->
                                    <input
                                        type="text"
                                        id="tableSearch"
                                        class="form-control"
                                        placeholder="البحث..."
                                        onkeyup="searchTable()"
                                    />
                                </div>


                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>العمر</th>
                                            <th>رقم الهاتف</th>
                                            <th>الماده</th>
                                            <th>الفصل</th>
                                            <th>النوع</th>
                                            <th>الراتب</th>
                                            <th>اجراء</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        @if($secondDurationTeachers->isEmpty())
                                            <tr class="py-4 text-center fw-bold">
                                                <td colspan="9">لا يوجد معلمين في الفترة المسائية</td>
                                            </tr>
                                        @endif
                                        @foreach($secondDurationTeachers as $index => $teacher)
                                            <tr>
                                                <td>{{$index+1}}</td>
                                                <td>
                                                    <img class="avatar avatar-x pull-up rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                                    <span class="fw-medium ms-1">{{$teacher->name}}</span>
                                                </td>
                                                <td>{{Carbon\Carbon::parse($teacher->birthdate)->age}}</td>
                                                <td>{{$teacher->phone_number}}</td>
                                                <td>{{$teacher->subject}}</td>
                                                <td>{{$teacher->academyClass->name}}</td>
                                                <td>{{$teacher->gender}}</td>
                                                <td>{{$teacher->salary}}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('teachers.edit', $teacher->id)}}">
                                                                <i class="bx bx-edit-alt me-1"></i>تعديل
                                                            </a>
                                                            <a class="dropdown-item" href="{{route('teachers.show', $teacher->id)}}">
                                                                <i class="bx bx-edit-alt me-1"></i>عرض بيانات المعلم
                                                            </a>
                                                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display: inline;">
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
                                    <h5 class="card-header d-flex gap-3">قائمة المعلمين</h5>
                                    </div>
                                <div class="card-body d-flex align-items-center gap-2 mb-3">
                                    <!-- Search Input -->
                                    <input
                                        type="text"
                                        id="tableSearch"
                                        class="form-control"
                                        placeholder="البحث..."
                                        onkeyup="searchTable()"
                                    />
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>العمر</th>
                                            <th>رقم الهاتف</th>
                                            <th>الماده</th>
                                            <th>الفصل</th>
                                            <th>النوع</th>
                                            <th>الراتب</th>
                                            <th>اجراء</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        @if($archiveTeachers->isEmpty())
                                            <tr class="py-4 text-center fw-bold">
                                                <td colspan="9">لا يوجد معلمين في الارشيف </td>
                                            </tr>
                                        @endif
                                        @foreach($archiveTeachers as $index => $teacher)
                                            <tr>
                                                <td>{{$index+1}}</td>
                                                <td>
                                                    <img class="avatar avatar-x pull-up rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                                    <span class="fw-medium ms-1">{{$teacher->name}}</span>
                                                </td>
                                                <td>{{Carbon\Carbon::parse($teacher->birthdate)->age}}</td>
                                                <td>{{$teacher->phone_number}}</td>
                                                <td>{{$teacher->subject}}</td>
                                                <td>{{$teacher->academyClass->name}}</td>
                                                <td>{{$teacher->gender}}</td>
                                                <td>{{$teacher->salary}}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('teachers.edit', $teacher->id)}}">
                                                                <i class="bx bx-edit-alt me-1"></i>تعديل
                                                            </a>
                                                            <a class="dropdown-item" href="{{route('teachers.show', $teacher->id)}}">
                                                                <i class="bx bx-edit-alt me-1"></i>عرض بيانات المعلم
                                                            </a>
                                                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="dropdown-item bg-label-danger">
                                                                    <i class="bx bx-trash me-1"></i>حذف
                                                                </button>
                                                            </form>                                                        </div>
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
    @if (session('teacher_created'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var teacher_created = new bootstrap.Modal(document.getElementById('teacher_created'), {
                    keyboard: false
                });
                teacher_created.show();
            });
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="teacher_created" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center ">
                        <h3 class="text-success">تم اضافة المعلم بنجاح</h3>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if (session('teacher_updated'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var teacher_updated = new bootstrap.Modal(document.getElementById('teacher_updated'), {
                    keyboard: false
                });
                teacher_updated.show();
            });
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="teacher_updated" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center ">
                        <h3 class="text-success">تم تعديل بيانات المعلم بنجاح</h3>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if (session('teacher_deleted'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var teacher_deleted = new bootstrap.Modal(document.getElementById('teacher_deleted'), {
                    keyboard: false
                });
                teacher_deleted.show();
            });
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="teacher_deleted" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center ">
                        <h3 class="text-success">تم حذف المعلم بنجاح</h3>
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
            const dropdown = document.getElementById("columnFilter");

            // Function to filter rows
            function filterTable() {
                const searchValue = searchInput.value.toLowerCase();
                const filterValue = dropdown.value;

                rows.forEach(row => {
                    const cells = Array.from(row.cells);
                    const cellText = cells.map(cell => cell.textContent.toLowerCase());

                    // Check if the row matches the search input
                    const matchesSearch = cellText.some(text => text.includes(searchValue));

                    // Check if the row matches the dropdown filter
                    const matchesFilter =
                        filterValue === "all" ||
                        filterValue === "اختر الفصل" ||
                        cells.some(cell => cell.textContent.trim() === filterValue);

                    // Show or hide rows based on the conditions
                    row.style.display = matchesSearch && matchesFilter ? "" : "none";
                });
            }

            // Event listener for search input
            searchInput.addEventListener("input", filterTable);

            // Event listener for dropdown
            dropdown.addEventListener("change", filterTable);
        });
    </script>



</x-layout>
