<x-layout>
    <x-slot:title>
        غياب المعلمين
    </x-slot:title>
    <x-slot:heading>
        غياب معلمين المؤسسة
    </x-slot:heading>
    <div class="container-xxl container-p-y">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#first-duration" aria-controls="first-duration" aria-selected="true">
                            صباحي
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#second-duration" aria-controls="second-duration" aria-selected="false">
                            مسائي
                        </button>
                    </li>
                </ul>
                <div class="tab-content border-0 p-0">
                    <!-- Morning Tab -->
                    <div class="tab-pane fade show active" id="first-duration" role="tabpanel">
                        <div class="card">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-header d-flex gap-3">قائمة المعلمين</h5>
                            </div>
                            <div class="card-body d-flex align-items-center gap-2 mb-3">
                                <!-- Search Input for Morning Table -->
                                <input
                                    type="text"
                                    id="tableSearchMorning"
                                    class="form-control"
                                    placeholder="البحث..."
                                />
                            </div>
                            @if($morningTeachers->isEmpty())
                                <table class="table table-striped">
                                    <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="text-center fw-bold" colspan="2">لا يوجد معلمين في فترة صباحي</td>
                                    </tr>
                                    </tbody>
                                </table>
                            @else
                                <form method="POST" action="{{route('teachers.absence.store')}}" class="table-responsive text-nowrap">
                                    @csrf
                                    <input type="hidden" name="duration" value="صباحي">
                                    <table class="table table-striped" id="dataTableMorning">
                                        <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>الحضور</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        @foreach($morningTeachers as $teacher)
                                            <tr>
                                                <td>
                                                    <img class="avatar avatar-x pull-up rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                                    <span class="fw-medium ms-1">{{$teacher->name}}</span>
                                                    <input type="hidden" name="teachers[{{$teacher->id}}][teacher_id]" value="{{$teacher->id}}">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="teachers[{{$teacher->id}}][is_present]" value="false">
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input name="teachers[{{$teacher->id}}][is_present]" class="form-check-input teacher-checkbox" type="checkbox" value="true" {{ old('teachers.' . $teacher->id . '.is_present', true) ? 'checked' : '' }} />
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <!-- Footer for attendance count -->
                                        <tfoot>
                                        <tr>
                                            <th>عدد الحضور</th>
                                            <th>
                                                <span id="attendanceCountMorning">0</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>عدد الغياب</th>
                                            <th>
                                                <span id="absenceCountMorning">0</span>
                                            </th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <div class="d-flex align-items-center justify-content-between mt-4 m-4">
                                        <a href="{{route('teachers.absence.show', ['duration' => 'صباحي'])}}" class="btn btn-info">عرض الغياب الشهري</a>
                                        <button class="btn btn-primary">حفظ</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>

                    <!-- Afternoon Tab -->
                    <div class="tab-pane fade" id="second-duration" role="tabpanel">
                        <div class="card">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-header d-flex gap-3">قائمة المعلمين</h5>
                            </div>
                            <div class="card-body d-flex align-items-center gap-2 mb-3">
                                <!-- Search Input for Afternoon Table -->
                                <input
                                    type="text"
                                    id="tableSearchAfternoon"
                                    class="form-control"
                                    placeholder="البحث..."
                                />
                            </div>
                            @if($afternoonTeachers->isEmpty())
                                <table class="table table-striped">
                                    <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="text-center fw-bold" colspan="2">لا يوجد معلمين في فترة مسائي</td>
                                    </tr>
                                    </tbody>
                                </table>
                            @else
                                <form method="POST" action="{{route('teachers.absence.store')}}" class="table-responsive text-nowrap">
                                    @csrf
                                    <input type="hidden" name="duration" value="مسائي">
                                    <table class="table table-striped" id="dataTableAfternoon">
                                        <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>الحضور</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        @foreach($afternoonTeachers as $teacher)
                                            <tr>
                                                <td>
                                                    <img class="avatar avatar-x pull-up rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                                    <span class="fw-medium ms-1">{{$teacher->name}}</span>
                                                    <input type="hidden" name="teachers[{{$teacher->id}}][teacher_id]" value="{{$teacher->id}}">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="teachers[{{$teacher->id}}][is_present]" value="false">
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input name="teachers[{{$teacher->id}}][is_present]" class="form-check-input teacher-checkbox" type="checkbox" value="true" {{ old('teachers.' . $teacher->id . '.is_present', true) ? 'checked' : '' }} />
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <!-- Footer for attendance count -->
                                        <tfoot>
                                        <tr>
                                            <th>عدد الحضور</th>
                                            <th>
                                                <span id="attendanceCountAfternoon">0</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>عدد الغياب</th>
                                            <th>
                                                <span id="absenceCountAfternoon">0</span>
                                            </th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <div class="d-flex align-items-center justify-content-between mt-4 m-4">
                                        <a href="{{route('teachers.absence.show', ['duration' => 'مسائي'])}}" class="btn btn-info">عرض الغياب الشهري</a>
                                        <button class="btn btn-primary">حفظ</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{route('teachers.absence.edit')}}" class="btn btn-info">تعديل الغياب الشهري</a>

        </div>
    </div>

    <!-- Success Modals -->
    @if (session('absence_stored'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var absence_stored = new bootstrap.Modal(document.getElementById('absence_stored'), {
                    keyboard: false
                });
                absence_stored.show();
            });
        </script>
    @endif

    <div class="modal fade" id="absence_stored" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center">
                        <h3 class="text-success">تم تخزين الغياب بنجاح</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('absence_updated'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var absence_updated = new bootstrap.Modal(document.getElementById('absence_updated'), {
                    keyboard: false
                });
                absence_updated.show();
            });
        </script>
    @endif

    <div class="modal fade" id="absence_updated" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center">
                        <h3 class="text-success">تم تحديث بيانات الغياب بنجاح</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Function to filter rows based on search input
            function filterTable(tableId, searchInputId) {
                const table = document.getElementById(tableId);
                const rows = Array.from(table.getElementsByTagName("tbody")[0].rows);
                const searchInput = document.getElementById(searchInputId);

                searchInput.addEventListener("input", () => {
                    const searchValue = searchInput.value.toLowerCase();

                    rows.forEach(row => {
                        const cells = Array.from(row.cells);
                        const cellText = cells.map(cell => cell.textContent.toLowerCase());

                        // Check if the row matches the search input
                        const matchesSearch = cellText.some(text => text.includes(searchValue));

                        // Show or hide rows based on the search condition
                        row.style.display = matchesSearch ? "" : "none";
                    });
                });
            }

            // Function to update the attendance and absence counts
            function updateAttendanceCount(tableId, attendanceCountId, absenceCountId) {
                const table = document.getElementById(tableId);
                const checkboxes = table.querySelectorAll(".teacher-checkbox");
                const totalTeachers = checkboxes.length; // Total number of teachers
                const presentCount = table.querySelectorAll(".teacher-checkbox:checked").length; // Number of present teachers
                const absentCount = totalTeachers - presentCount; // Number of absent teachers

                // Update the present count
                const attendanceCount = document.getElementById(attendanceCountId);
                if (attendanceCount) {
                    attendanceCount.textContent = presentCount;
                }

                // Update the absent count
                const absenceCount = document.getElementById(absenceCountId);
                if (absenceCount) {
                    absenceCount.textContent = absentCount;
                }
            }

            // Initialize filtering and attendance count for the morning table
            filterTable("dataTableMorning", "tableSearchMorning");
            document.querySelectorAll("#dataTableMorning .teacher-checkbox").forEach(checkbox => {
                checkbox.addEventListener("change", () => updateAttendanceCount("dataTableMorning", "attendanceCountMorning", "absenceCountMorning"));
            });

            // Initialize filtering and attendance count for the afternoon table
            filterTable("dataTableAfternoon", "tableSearchAfternoon");
            document.querySelectorAll("#dataTableAfternoon .teacher-checkbox").forEach(checkbox => {
                checkbox.addEventListener("change", () => updateAttendanceCount("dataTableAfternoon", "attendanceCountAfternoon", "absenceCountAfternoon"));
            });

            // Initialize the attendance and absence counts for both tables on page load
            updateAttendanceCount("dataTableMorning", "attendanceCountMorning", "absenceCountMorning");
            updateAttendanceCount("dataTableAfternoon", "attendanceCountAfternoon", "absenceCountAfternoon");
        });    </script>
</x-layout>
