<x-layout>
    <x-slot:title>
        قائمه الاختبارات
    </x-slot:title>
    <x-slot:heading>
        قائمة الاختبارت
    </x-slot:heading>
    <div class="container-xxl container-p-y">

        <div class="container-xxl flex-grow-1 container-p-y">

{{--            <div class="d-flex align-items-start justify-content-end">--}}
{{--                <a href="#" class="btn btn-success suspend-user me-4" data-bs-target="#add-quiz" data-bs-toggle="modal">اضافة اختبار</a>--}}

{{--            </div>--}}
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button
                            type="button"
                            class="nav-link active"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#weakly-quizzes"
                            aria-controls="weakly-quizzes"
                            aria-selected="true">
                            الاختبارات الاسبوعية
                        </button>
                    </li>
                </ul>
                <div class="tab-content border-0 p-0">
                    <div class="tab-pane fade show active" id="weakly-quizzes" role="tabpanel">
                        <div class="card">
                            <div class="d-flex align-items-center justify-content-between ">
                                <h5 class="card-header d-flex gap-3">قائمة الاختبارت</h5>
                                <a href="{{route('quizzes.create', ['kind' => 'اسبوعي'])}}" class="btn btn-success m-4">اضافة اختبار</a>
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

                                <!-- Column Filter Dropdown -->
                                <select id="columnFilter" class="form-select">
                                    <option selected>اختر الفصل</option>
                                    <option value="all">عرض الكل</option>
                                    <option value="اللغة العربية">اللغة العربية</option>
                                    <option value="الحديث">الحديث</option>
                                    <option value="الفقه">الفقه</option>
                                </select>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>اسم الماد</th>
                                        <th>الفصل</th>
                                        <th>الدرجة النهائية</th>
                                        <th>تاريخ الاختبار</th>
                                        <th>اجراء</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                    @foreach($weaklyQuizzes as $quiz)
                                        <tr>
                                            <td>{{$quiz->title}}</td>
                                            <td>{{$quiz->academyClass->name}}</td>
                                            <td>{{$quiz->final_grade}}</td>
                                            <td>{{$quiz->date}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('quizzes.edit', $quiz->id)}}">
                                                            <i class="bx bx-edit-alt me-1">
                                                            </i>
                                                            تعديل
                                                        </a>
                                                        <a class="dropdown-item" href="{{route('grades.index', $quiz->id )}}">
                                                            <i class="bx bxs-help-circle me-1"></i>عرض
                                                        </a>
                                                        <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" style="display: inline;">
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
    @if (session('quiz_added'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var quiz_added = new bootstrap.Modal(document.getElementById('quiz_added'), {
                    keyboard: false
                });
                quiz_added.show();
            });
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="quiz_added" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center ">
                        <h3 class="text-success">تم اضافة الاختبار بنجاح</h3>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if (session('quiz_updated'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var quiz_updated = new bootstrap.Modal(document.getElementById('quiz_updated'), {
                    keyboard: false
                });
                quiz_updated.show();
            });
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="quiz_updated" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center ">
                        <h3 class="text-success">تم تعديل الاختبار بنجاح</h3>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if (session('quiz_deleted'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var quiz_deleted = new bootstrap.Modal(document.getElementById('quiz_deleted'), {
                    keyboard: false
                });
                quiz_deleted.show();
            });
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="quiz_deleted" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center ">
                        <h3 class="text-success">تم حذف الاختبار بنجاح</h3>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if (session('delete_warning'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var delete_warning = new bootstrap.Modal(document.getElementById('delete_warning'), {
                    keyboard: false
                });
                delete_warning.show();
            });
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="delete_warning" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center ">
                        <h3 class="text-danger">عفوا! لا يمكنك حذف الاختبار لوجود درجات مرتبطة به</h3>
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
                        if (filter === "all" || filter === "اختر الفصل" || filter === "اختر الباص" || filter === "اختر الحاله") {
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
