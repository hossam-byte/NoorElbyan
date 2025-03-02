<x-layout>
    <x-slot:title>
        قائمه الاعضاء
    </x-slot:title>
    <x-slot:heading>
        قائمة اعضاء المؤسسة
    </x-slot:heading>
    <div class="container-xxl container-p-y">

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex align-items-start justify-content-end">
                <a href="" class="btn btn-success">اضافة معلم</a>
            </div>
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button
                            type="button"
                            class="nav-link active"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#stuff"
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
                            data-bs-target="#archive"
                            aria-controls="archive"
                            aria-selected="false">
                            الارشيف
                        </button>
                    </li>
                </ul>
                <div class="tab-content border-0 p-0">
                    <div class="tab-pane fade show active" id="stuff" role="tabpanel">
                        <div class="card">
                            <div class="d-flex align-items-center justify-content-between ">
                                <h5 class="card-header d-flex gap-3">قائمة الاعضاء</h5>
                                <button href="#" class="btn btn-dark me-4" >طباعه</button>
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
                                        <th>الاسم</th>
                                        <th>اسم المستخدم</th>
                                        <th>نوع الوصول</th>
                                        <th>اجراء</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>
                                            <img class="avatar avatar-x pull-up rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                            <span class="fw-medium ms-1">مها محمد السيد اسماعيل صبحي</span>
                                        </td>
                                        <td>jimy</td>
                                        <td>مدير</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="">
                                                        <i class="bx bx-edit-alt me-1"></i>تعديل
                                                    </a>
                                                    <a class="dropdown-item" href="">
                                                        <i class="bx bx-edit-alt me-1"></i>ارشفه
                                                    </a>
                                                    <a class="dropdown-item bg-label-danger" href="">
                                                        <i class="bx bx-edit-alt me-1"></i>حذف
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img class="avatar avatar-x pull-up rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                            <span class="fw-medium ms-1">مها محمد السيد اسماعيل صبحي</span>
                                        </td>
                                        <td>jimy</td>
                                        <td>مدير</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="">
                                                        <i class="bx bx-edit-alt me-1"></i>تعديل
                                                    </a>
                                                    <a class="dropdown-item" href="">
                                                        <i class="bx bx-edit-alt me-1"></i>ارشفه
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
                    <div class="tab-pane fade" id="archive" role="tabpanel">
                        <div class="tab-pane fade show active" id="first-duration" role="tabpanel">
                            <div class="card">
                                <div class="d-flex align-items-center justify-content-between ">
                                    <h5 class="card-header d-flex gap-3">قائمة الاعضاء</h5>
                                    <button href="#" class="btn btn-dark me-4" >طباعه</button>
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
                                            <th>الاسم</th>
                                            <th>اسم المستخدم</th>
                                            <th>نوع الوصول</th>
                                            <th>اجراء</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td>
                                                <img class="avatar avatar-x pull-up rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                                <span class="fw-medium ms-1">مها محمد السيد اسماعيل صبحي</span>
                                            </td>
                                            <td>jimy</td>
                                            <td>مدير</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="">
                                                            <i class="bx bx-edit-alt me-1"></i>تعديل
                                                        </a>
                                                        <a class="dropdown-item" href="">
                                                            <i class="bx bx-edit-alt me-1"></i>ارشفه
                                                        </a>
                                                        <a class="dropdown-item bg-label-danger" href="">
                                                            <i class="bx bx-edit-alt me-1"></i>حذف
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img class="avatar avatar-x pull-up rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                                <span class="fw-medium ms-1">مها محمد السيد اسماعيل صبحي</span>
                                            </td>
                                            <td>jimy</td>
                                            <td>مدير</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="">
                                                            <i class="bx bx-edit-alt me-1"></i>تعديل
                                                        </a>
                                                        <a class="dropdown-item" href="">
                                                            <i class="bx bx-edit-alt me-1"></i>ارشفه
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

            // Function to filter rows based on search input
            function filterTable() {
                const searchValue = searchInput.value.toLowerCase();

                rows.forEach(row => {
                    const cells = Array.from(row.cells);
                    const cellText = cells.map(cell => cell.textContent.toLowerCase());

                    // Check if the row matches the search input
                    const matchesSearch = cellText.some(text => text.includes(searchValue));

                    // Show or hide rows based on the search condition
                    row.style.display = matchesSearch ? "" : "none";
                });
            }

            // Event listener for search input
            searchInput.addEventListener("input", filterTable);
        });

    </script>



</x-layout>
