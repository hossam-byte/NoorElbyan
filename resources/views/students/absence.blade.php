
<x-layout>
    <x-slot:title>
        غياب الطلاب
    </x-slot:title>
    <x-slot:heading>
        تسجيل الغياب اليومي لطلاب المؤسسة
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
                                <h5 class="card-header d-flex gap-3">قائمة الطلاب</h5>
                            </div>

                            <div class="card-body d-flex align-items-center gap-2 mb-3">
                                <select id="columnFilter" class="form-select">
                                    <option value="default-view" selected>اختر الفصل</option>
                                    @foreach($morningClasses as $class)
                                        <option value="first-class-id-{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Default View -->
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

                            @foreach($morningClasses as $class)
                                <form id="first-class-id-{{$class->id}}" action="{{ route('students.absence.store') }}" method="POST" class="table-responsive text-nowrap d-none">
                                    @csrf
                                    <input type="hidden" name="academy_class_id" value="{{$class->id}}">
                                    <input type="hidden" name="duration" value="صباحي">
                                    <table class="table table-striped" id="dataTable-{{$class->id}}">
                                        <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>الحضور</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        @if($class->students->where('duration', 'صباحي')->isEmpty())
                                            <tr>
                                                <td class="text-center fw-bold" colspan="2">لا يوجد طلبة في هذا الفصل</td>
                                            </tr>
                                        @else
                                            @foreach($class->students->where('duration', 'صباحي') as $student)
                                                <tr>
                                                    <td>
                                                        <img class="avatar avatar-x pull-up rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                                        <span class="fw-medium ms-1">{{$student->name}}</span>
                                                        <input type="hidden" name="students[{{$student->id}}][student_id]" value="{{$student->id}}">
                                                    </td>
                                                    <td>
                                                        <!-- Hidden input to ensure 'false' is sent when unchecked -->
                                                        <input type="hidden" name="students[{{$student->id}}][is_present]" value="false">
                                                        <!-- Checkbox input to send 'true' when checked -->
                                                        <div class="form-check d-flex justify-content-center">
                                                            <input name="students[{{$student->id}}][is_present]" class="form-check-input student-checkbox" type="checkbox" value="true" {{ old('students.' . $student->id . '.is_present', true) ? 'checked' : '' }} />
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>عدد الحضور</th>
                                            <th>
                                                <span class="selected-count present">0</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>عدد الغياب</th>
                                            <th>
                                                <span class="selected-count absent">0</span>
                                            </th>
                                        </tr>
                                        </tfoot>
                                    </table>

                                    <div class="d-flex align-items-center justify-content-between mt-4 m-4">
                                        <a href="{{ route('students.absence.show', ['class' => $class->id, 'duration' => 'صباحي']) }}" class="btn btn-info">عرض الغياب الشهري</a>
                                        <button class="btn btn-primary">حفظ</button>
                                    </div>
                                </form>
                            @endforeach



                        </div>
                    </div>
                    <div class="tab-pane fade" id="second-duration" role="tabpanel">
                        <div class="card">
                            <div class="d-flex align-items-center justify-content-between ">
                                <h5 class="card-header d-flex gap-3">قائمة الطلاب</h5>
                            </div>

                            <!-- Select Dropdown -->
                            <div class="card-body d-flex align-items-center gap-2 mb-3">
                                <select id="columnFilter2" class="form-select">
                                    <option value="default-view" selected>اختر الفصل</option>
                                    @foreach($afternoonClasses as $class)
                                        <option value="second-class-id-{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Default View -->
                            <div id="second-default-view" class="table-responsive text-nowrap">
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

                            <!-- Class-Specific Views -->
                            @foreach($afternoonClasses as $class)
                                <form id="second-class-id-{{$class->id}}" action="{{ route('students.absence.store') }}" method="POST" class="table-responsive text-nowrap d-none">
                                    @csrf
                                    <input type="hidden" name="academy_class_id" value="{{$class->id}}">
                                    <input type="hidden" name="duration" value="مسائي">
                                    <table class="table table-striped" id="dataTable-{{$class->id}}">
                                        <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>الحضور</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        @if($class->students->where('duration', 'مسائي')->isEmpty())
                                            <tr>
                                                <td class="text-center fw-bold" colspan="2">لا يوجد طلبة في هذا الفصل</td>
                                            </tr>
                                        @else
                                            @foreach($class->students->where('duration', 'مسائي') as $student)
                                                <tr>
                                                    <td>
                                                        <img class="avatar avatar-x pull-up rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                                        <span class="fw-medium ms-1">{{$student->name}}</span>
                                                        <input type="hidden" name="students[{{$student->id}}][student_id]" value="{{$student->id}}">
                                                    </td>
                                                    <td>
                                                        <!-- Hidden input to ensure 'false' is sent when unchecked -->
                                                        <input type="hidden" name="students[{{$student->id}}][is_present]" value="false">
                                                        <!-- Checkbox input to send 'true' when checked -->
                                                        <div class="form-check d-flex justify-content-center">
                                                            <input name="students[{{$student->id}}][is_present]" class="form-check-input student-checkbox" type="checkbox" value="true" {{ old('students.' . $student->id . '.is_present', true) ? 'checked' : '' }} />
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>عدد الحضور</th>
                                            <th>
                                                <span class="selected-count present">0</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>عدد الغياب</th>
                                            <th>
                                                <span class="selected-count absent">0</span>
                                            </th>
                                        </tr>
                                        </tfoot>
                                    </table>

                                    <div class="d-flex align-items-center justify-content-between mt-4 m-4">
                                        <a href="{{ route('students.absence.show', ['class' => $class->id, 'duration' => 'مسائي']) }}" class="btn btn-info">عرض الغياب الشهري</a>
                                        <button class="btn btn-primary">حفظ</button>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{route('students.absence.edit')}}" class="btn btn-info">تعديل الغياب الشهري</a>

        </div>
    </div>
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

    <!-- Modal -->
    <div class="modal fade" id="absence_stored" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center ">
                        <h3 class="text-success">تم تخزين الغياب بتجاح </h3>
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
            const columnFilter = document.getElementById('columnFilter');
            const firstDefaultView = document.getElementById('first-default-view');
            const activeClassForms = @json($morningClasses->pluck('id')); // Array of class IDs for form ids

            // Hide all class-specific views initially
            function hideAllViews() {
                // Hide all class forms and default view
                activeClassForms.forEach(function (classId) {
                    const classForm = document.getElementById(`first-class-id-${classId}`);
                    if (classForm) {
                        classForm.classList.add('d-none');
                    }
                });
                firstDefaultView.classList.add('d-none');
            }

            // Show the appropriate class form or default view based on the selected class
            columnFilter.addEventListener('change', function () {
                hideAllViews();
                const selectedValue = this.value;

                if (selectedValue === 'default-view') {
                    firstDefaultView.classList.remove('d-none'); // Show default view
                } else {
                    const selectedClassForm = document.getElementById(selectedValue);
                    if (selectedClassForm) {
                        selectedClassForm.classList.remove('d-none'); // Show selected class form
                        updateSelectedCount(selectedClassForm); // Update the selected count for that class
                    }
                }
            });

            // Function to update the selected count dynamically
            function updateSelectedCount(form) {
                const checkboxes = form.querySelectorAll('.student-checkbox');
                const totalStudents = checkboxes.length; // Total number of students
                const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length; // Number of present students
                const absentCount = totalStudents - checkedCount; // Number of absent students

                // Update the present count
                const presentCountCell = form.querySelector('.selected-count.present');
                if (presentCountCell) {
                    presentCountCell.textContent = checkedCount;
                }

                // Update the absent count
                const absentCountCell = form.querySelector('.selected-count.absent');
                if (absentCountCell) {
                    absentCountCell.textContent = absentCount;
                }
            }

            // Listen for changes on checkboxes to update the selected count
            document.querySelectorAll('.student-checkbox').forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    updateSelectedCount(this.closest('form')); // Update the count for the form containing this checkbox
                });
            });

            // Initialize selected count on page load for all forms
            activeClassForms.forEach(function (classId) {
                const classForm = document.getElementById(`first-class-id-${classId}`);
                if (classForm) {
                    updateSelectedCount(classForm); // Initialize the count for this class
                }
            });

            // Initially show the default view and hide other forms
            hideAllViews();
            firstDefaultView.classList.remove('d-none');
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const columnFilter2 = document.getElementById('columnFilter2');
            const secondDefaultView = document.getElementById('second-default-view');
            const activeClassForms = @json($afternoonClasses->pluck('id')); // Array of class IDs for form ids

            // Hide all class-specific views initially
            function hideAllViews() {
                // Hide all class forms and default view
                activeClassForms.forEach(function (classId) {
                    const classForm = document.getElementById(`second-class-id-${classId}`);
                    if (classForm) {
                        classForm.classList.add('d-none');
                    }
                });
                secondDefaultView.classList.add('d-none');
            }

            // Show the appropriate class form or default view based on the selected class
            columnFilter2.addEventListener('change', function () {
                hideAllViews();
                const selectedValue = this.value;

                if (selectedValue === 'default-view') {
                    secondDefaultView.classList.remove('d-none'); // Show default view
                } else {
                    const selectedClassForm = document.getElementById(selectedValue);
                    if (selectedClassForm) {
                        selectedClassForm.classList.remove('d-none'); // Show selected class form
                        updateSelectedCount(selectedClassForm); // Update the selected count for that class
                    }
                }
            });

            // Function to update the selected count dynamically
            function updateSelectedCount(form) {
                const checkboxes = form.querySelectorAll('.student-checkbox');
                const totalStudents = checkboxes.length; // Total number of students
                const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length; // Number of present students
                const absentCount = totalStudents - checkedCount; // Number of absent students

                // Update the present count
                const presentCountCell = form.querySelector('.selected-count.present');
                if (presentCountCell) {
                    presentCountCell.textContent = checkedCount;
                }

                // Update the absent count
                const absentCountCell = form.querySelector('.selected-count.absent');
                if (absentCountCell) {
                    absentCountCell.textContent = absentCount;
                }
            }

            // Listen for changes on checkboxes to update the selected count
            document.querySelectorAll('.student-checkbox').forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    updateSelectedCount(this.closest('form')); // Update the count for the form containing this checkbox
                });
            });

            // Initialize selected count on page load for all forms
            activeClassForms.forEach(function (classId) {
                const classForm = document.getElementById(`second-class-id-${classId}`);
                if (classForm) {
                    updateSelectedCount(classForm); // Initialize the count for this class
                }
            });

            // Initially show the default view and hide other forms
            hideAllViews();
            secondDefaultView.classList.remove('d-none');
        });
    </script>




</x-layout>
