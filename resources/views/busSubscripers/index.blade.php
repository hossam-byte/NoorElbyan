<x-layout>
    <x-slot:title>
        قائمه الاختبارات
    </x-slot:title>
    <x-slot:heading>
        قائمة الاختبارت
    </x-slot:heading>
    <div class="container-xxl container-p-y">

        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#first-duration" aria-controls="first-duration" aria-selected="true">
                            الاختبارات
                        </button>
                    </li>
                </ul>
                <div class="tab-content border-0 p-0">
                    <div class="tab-pane fade show active" id="first-duration" role="tabpanel">
                        <div class="card">

                            <div class="d-flex align-items-center justify-content-between ">
                                <h5 class="card-header d-flex gap-3">درجات اختبار (اسم اللغه)/ فصل خالد بن الوليد</h5>
                                <a href="{{ route('grades.edit', $quizId) }}"
                                    class="btn btn-success suspend-user me-4">تعديل درجات الاختبار</a>
                                {{--                                <a href="{{route('grades.edit', $quizId)}}" class="btn btn-success suspend-user me-4" data-bs-target="#edit-quiz-grades" data-bs-toggle="modal">تعديل درجات الاختبار</a> --}}
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
                                            <th>اسم الطالب</th>
                                            <th>الدرجة النهائية</th>
                                            <th>درجة الطالب</th>
                                            <th>التقدير</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($thisQuizStudentsGrades as $grade)
                                            <tr>
                                                <td>{{ $grade->student->name }}</td>
                                                <td>{{ $grade->quiz->title }}</td>
                                                <td>{{ $grade->grade }}</td>
                                                <td>
                                                    @php
                                                        $studentGrade = $grade->grade; // Student's grade
$finalGrade = $grade->quiz->final_grade; // Final grade
$badgeClass = '';
$badgeText = '';
// Calculate the percentage of the student's grade relative to the final grade
                                                        $percentage = ($studentGrade / $finalGrade) * 100;
                                                        // Set badge text and class based on the percentage
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
                </div>
            </div>

        </div>
    </div>
    @if (session('grades_updated'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var grades_updated = new bootstrap.Modal(document.getElementById('grades_updated'), {
                    keyboard: false
                });
                grades_updated.show();
            });
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="grades_updated" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center ">
                        <h3 class="text-success">تم تحديث الدرجات بنجاح</h3>
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
