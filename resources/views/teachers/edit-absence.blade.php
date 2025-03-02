
<x-layout>
    <x-slot:title>
        تعديل غياب المعلمين
    </x-slot:title>
    <x-slot:heading>
        تعديل الغياب لمعلمي المؤسسة
    </x-slot:heading>
    <div class="container-xxl container-p-y">

        <div class="container-xxl flex-grow-1 container-p-y">

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
                </ul>
                <div class="tab-content border-0 p-0">
                    <div class="tab-pane fade show active" id="first-duration" role="tabpanel">
                        <div class="card">
                            <div class="d-flex align-items-center justify-content-between ">
                                <h5 class="card-header d-flex gap-3">قائمة المعلمين</h5>
                            </div>

                            <div class="card-body d-flex align-items-center gap-2 mb-3">
                                <form id="fetchRecordsForm" action="{{route('teachers.absence.edit')}}" method="GET" class="d-flex gap-2">
                                    @csrf
                                    <!-- Date Input -->
                                    <input type="date"
                                           id="absence-filter-Date-1"
                                           name="absence-filter-Date"
                                           class="form-control"
                                           required>
                                    <input type="hidden" name="absence-filter-duration" value="صباحي">

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">بحث</button>
                                </form>
                            </div>
                            @if($morningTeachers)
                                <form id="first-duration-absence-update" action="{{route('teachers.absence.store')}}" method="POST" class="table-responsive text-nowrap">
                                    @csrf
                                    <input type="hidden" name="duration" value="صباحي">
                                    <table class="table table-striped" id="dataTable-1">
                                        <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>الحضور</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        @foreach($morningTeachers as $absenceRecord)
                                            <input type="hidden" name="date" value="{{$absenceRecord->date}}">
                                            <tr>
                                                <td>
                                                    <img class="avatar avatar-x pull-up rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                                    <span class="fw-medium ms-1">{{$absenceRecord->teacher->name}}</span>
                                                    <input type="hidden" name="teachers[{{$absenceRecord->teacher->id}}][teacher_id]" value="{{$absenceRecord->teacher->id}}">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="teachers[{{$absenceRecord->teacher->id}}][is_present]" value="false">
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input name="teachers[{{$absenceRecord->teacher->id}}][is_present]" class="form-check-input teacher-checkbox" type="checkbox" value="true" {{$absenceRecord->is_present? 'checked': ''}} />
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>عدد الحضور</th>
                                            <th>
                                                <span class="morning-selected-count present">0</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>عدد الغياب</th>
                                            <th>
                                                <span class="morning-selected-count absent">0</span>
                                            </th>
                                        </tr>
                                        </tfoot>
                                    </table>

                                    <div class="d-flex align-items-center justify-content-between mt-4 m-4">
                                        <button class="btn btn-primary">حفظ</button>
                                    </div>
                                </form>
                            @else
                                <div id="first-default-view" class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>الحضور</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td class="text-center fw-bold" colspan="2">لا يوجد بيانات لعرضها</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="second-duration" role="tabpanel">
                        <div class="card">
                            <div class="d-flex align-items-center justify-content-between ">
                                <h5 class="card-header d-flex gap-3">قائمة المعلمين</h5>
                            </div>

                            <div class="card-body d-flex align-items-center gap-2 mb-3">
                                <form id="fetchRecordsForm" action="{{route('teachers.absence.edit')}}" method="GET" class="d-flex gap-2">
                                    @csrf
                                    <!-- Date Input -->
                                    <input type="date"
                                           id="absence-filter-Date-1"
                                           name="absence-filter-Date"
                                           class="form-control"
                                           required>
                                    <input type="hidden" name="absence-filter-duration" value="مسائي">

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">بحث</button>
                                </form>
                            </div>
                            @if($afternoonTeachers)
                                <form id="first-duration-absence-update" action="{{route('teachers.absence.store')}}" method="POST" class="table-responsive text-nowrap">
                                    @csrf
                                    <input type="hidden" name="duration" value="مسائي">
                                    <table class="table table-striped" id="dataTable-1">
                                        <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>الحضور</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        @foreach($afternoonTeachers as $absenceRecord)
                                            <input type="hidden" name="date" value="{{$absenceRecord->date}}">
                                            <tr>
                                                <td>
                                                    <img class="avatar avatar-x pull-up rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                                    <span class="fw-medium ms-1">{{$absenceRecord->teacher->name}}</span>
                                                    <input type="hidden" name="teachers[{{$absenceRecord->teacher->id}}][teacher_id]" value="{{$absenceRecord->teacher->id}}">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="teachers[{{$absenceRecord->teacher->id}}][is_present]" value="false">
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input name="teachers[{{$absenceRecord->teacher->id}}][is_present]" class="form-check-input teacher-checkbox" type="checkbox" value="true" {{$absenceRecord->is_present? 'checked': ''}} />
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>عدد الحضور</th>
                                            <th>
                                                <span class="morning-selected-count present">0</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>عدد الغياب</th>
                                            <th>
                                                <span class="morning-selected-count absent">0</span>
                                            </th>
                                        </tr>
                                        </tfoot>
                                    </table>

                                    <div class="d-flex align-items-center justify-content-between mt-4 m-4">
                                        <button class="btn btn-primary">حفظ</button>
                                    </div>
                                </form>
                            @else
                                <div id="first-default-view" class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>الحضور</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td class="text-center fw-bold" colspan="2">لا يوجد بيانات لعرضها</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
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

    <!-- Modal -->
    <div class="modal fade" id="absence_updated" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center ">
                        <h3 class="text-success">تم تحديث بيانات الغياب بتجاح </h3>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get all the checkboxes
            const checkboxes = document.querySelectorAll('.student-checkbox');

            // Get the elements where the counts will be displayed
            const presentCountElement = document.querySelector('.morning-selected-count.present');
            const absentCountElement = document.querySelector('.morning-selected-count.absent');

            // Function to update the counts
            function updateCounts() {
                let presentCount = 0;
                let absentCount = 0;

                // Loop through all checkboxes
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        presentCount++;
                    } else {
                        absentCount++;
                    }
                });

                // Update the displayed counts
                presentCountElement.textContent = presentCount;
                absentCountElement.textContent = absentCount;
            }

            // Add event listeners to all checkboxes
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateCounts);
            });

            // Initialize the counts on page load
            updateCounts();
        });
        document.addEventListener('DOMContentLoaded', function () {
            // Get the date input element
            const dateInput = document.getElementById('absence-filter-Date-1');

            // Get today's date in the format YYYY-MM-DD
            const today = new Date().toISOString().split('T')[0];

            // Set the max attribute to today's date
            dateInput.setAttribute('max', today);
        });
    </script>
    <script     >
        document.addEventListener('DOMContentLoaded', function () {
            // Get all the checkboxes
            const checkboxes = document.querySelectorAll('.student-checkbox');

            // Get the elements where the counts will be displayed
            const presentCountElement = document.querySelector('.afternoon-selected-count.present');
            const absentCountElement = document.querySelector('.afternoon-selected-count.absent');

            // Function to update the counts
            function updateCounts() {
                let presentCount = 0;
                let absentCount = 0;

                // Loop through all checkboxes
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        presentCount++;
                    } else {
                        absentCount++;
                    }
                });

                // Update the displayed counts
                presentCountElement.textContent = presentCount;
                absentCountElement.textContent = absentCount;
            }

            // Add event listeners to all checkboxes
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateCounts);
            });

            // Initialize the counts on page load
            updateCounts();
        });
        document.addEventListener('DOMContentLoaded', function () {
            // Get the date input element
            const dateInput = document.getElementById('absence-filter-Date-2');

            // Get today's date in the format YYYY-MM-DD
            const today = new Date().toISOString().split('T')[0];

            // Set the max attribute to today's date
            dateInput.setAttribute('max', today);
        });
    </script>


</x-layout>
