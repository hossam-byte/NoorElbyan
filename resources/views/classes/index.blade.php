<x-layout>
    <x-slot:title>
        قائمه الفصول
    </x-slot:title>
    <x-slot:heading>
        معلومات فصول المؤسسة
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
                            data-bs-target="#first-duration-classes"
                            aria-controls="first-duration-classes"
                            aria-selected="true">
                            الفصول (الفتره الصباحيه)
                        </button>
                    </li>
                    <li class="nav-item">
                        <button
                            type="button"
                            class="nav-link"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#second-duration-classes"
                            aria-controls="second-duration-classes"
                            aria-selected="false">
                            الفصول (الفتره المسائية)
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
                    <div class="tab-pane fade show active" id="first-duration-classes" role="tabpanel">
                        <div class="card">

                            <div class="d-flex align-items-center justify-content-between ">
                                <h5 class="card-header d-flex gap-3">قائمة الفصول</h5>
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
                                    @foreach($morningClasses as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach

                                </select>

                            </div>


                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الفصل</th>
                                        <th>عدد المقاعد</th>
                                        <th>العدد المشغول</th>
                                        <th>العدد المتاح</th><th>اجراء</th>
                                    </tr>
                                    </thead>
                                        <tbody class="table-border-bottom-0">
                                        @if($morningClasses->isEmpty())
                                            <tr class="py-4 text-center fw-bold">
                                                <td colspan="7">لا يوجد فصول في الفتره الصباحيه</td>
                                            </tr>
                                        @endif
                                    @foreach($morningClasses as $index => $class)
                                        <tr>
                                            <td>{{$index +1}}</td>
                                            <td>{{$class->name}}</td>
                                            <td>{{$class->number_of_seats}}</td>
                                            <td>{{$class->taken_seats}}</td>
                                            <td>{{$class->available_seats}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('classes.edit', $class->id)}}">
                                                            <i class="bx bx-edit-alt me-1">
                                                            </i>
                                                            تعديل
                                                        </a>
                                                        <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display: inline;">
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
                    <div class="tab-pane fade" id="second-duration-classes" role="tabpanel">
                        <div class="card">

                            <div class="d-flex align-items-center justify-content-between ">
                                <h5 class="card-header d-flex gap-3">قائمة الفصول</h5>
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
                                    @foreach($afternoonClasses as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach

                                </select>

                            </div>


                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الفصل</th>
                                        <th>عدد المقاعد</th>
                                        <th>العدد المشغول</th>
                                        <th>العدد المتاح</th><th>اجراء</th>
                                    </tr>
                                    </thead>
                                        <tbody class="table-border-bottom-0">
                                        @if($afternoonClasses->isEmpty())
                                            <tr class="py-4 text-center fw-bold">
                                                <td colspan="7">لا يوجد فصول في الفتره المسائية</td>
                                            </tr>
                                        @endif
                                    @foreach($afternoonClasses as $index => $class)
                                        <tr>
                                            <td>{{$index +1}}</td>
                                            <td>{{$class->name}}</td>
                                            <td>{{$class->number_of_seats}}</td>
                                            <td>{{$class->taken_seats}}</td>
                                            <td>{{$class->available_seats}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('classes.edit', $class->id)}}">
                                                            <i class="bx bx-edit-alt me-1">
                                                            </i>
                                                            تعديل
                                                        </a>
                                                        <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display: inline;">
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
                    <div class="tab-pane fade" id="archive" role="tabpanel">
                        <div class="tab-pane fade show active" id="first-duration" role="tabpanel">
                            <div class="card">

                                <div class="d-flex align-items-center justify-content-between ">
                                    <h5 class="card-header d-flex gap-3">قائمة الفصول</h5>
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
                                        @foreach($inActiveClasses as $class)
                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach

                                    </select>

                                </div>


                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم الفصل</th>
                                            <th>عدد المقاعد</th>
                                            <th>العدد المشغول</th>
                                            <th>العدد المتاح</th>
                                            <th>اجراء</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        @if($inActiveClasses->isEmpty())
                                            <tr class="py-4 text-center fw-bold">
                                                <td colspan="7">لا يوجد فصول في الارشيف </td>
                                            </tr>
                                        @endif
                                        @foreach($inActiveClasses as $index => $class)
                                            <tr>
                                                <td>{{$index +1}}</td>
                                                <td>{{$class->name}}</td>
                                                <td>{{$class->number_of_seats}}</td>
                                                <td>{{$class->taken_seats}}</td>
                                                <td>{{$class->available_seats}}</td>
                                                <td>
                                                    <span class="badge bg-label-success me-1">{{$class->duration}}</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('classes.edit', $class->id)}}">
                                                                <i class="bx bx-edit-alt me-1">
                                                                </i>
                                                                تعديل
                                                            </a>
                                                            <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display: inline;">
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
        @if (session('class_added'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var class_added = new bootstrap.Modal(document.getElementById('class_added'), {
                        keyboard: false
                    });
                    class_added.show();
                });
            </script>
        @endif

        <!-- Modal -->
        <div class="modal fade" id="class_added" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center ">
                            <h3 class="text-success">تم اضافة الفصل بنجاح</h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @if (session('class_updated'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var class_updated = new bootstrap.Modal(document.getElementById('class_updated'), {
                        keyboard: false
                    });
                    class_updated.show();
                });
            </script>
        @endif

        <!-- Modal -->
        <div class="modal fade" id="class_updated" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center ">
                            <h3 class="text-success">تم تعديل الفصل بنجاح</h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

        @if (session('class_deleted'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var class_deleted = new bootstrap.Modal(document.getElementById('class_deleted'), {
                        keyboard: false
                    });
                    class_deleted.show();
                });
            </script>
        @endif

        <!-- Modal -->
        <div class="modal fade" id="class_deleted" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center ">
                            <h3 class="text-success">تم حذف الفصل بنجاح</h3>
                        </div>

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
