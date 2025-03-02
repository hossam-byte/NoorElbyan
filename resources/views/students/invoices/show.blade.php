<x-layout>
    <x-slot:title>
        قائمه الاقساط
    </x-slot:title>
    <x-slot:heading>
        قائمة الاقساط
    </x-slot:heading>
    <div class="container-xxl container-p-y">

        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#first-duration" aria-controls="first-duration" aria-selected="true">
                            الاقساط
                        </button>
                    </li>
                </ul>
                <div class="tab-content border-0 p-0">
                    <div class="tab-pane fade show active" id="first-duration" role="tabpanel">
                        <div class="card">

                            <div class="d-flex align-items-center justify-content-between ">
                                <h5 class="card-header d-flex gap-3">
                                    اقساط فاتورة الطالب {{ $student->name }} بتاريخ
                                    {{ $invoice->created_at->format('d-m-Y') }}
                                </h5>
                                <a href="{{ route('students.installments.create', ['student' => $student->id, 'invoice' => $invoice->id]) }}"
                                    class="btn btn-success suspend-user me-4">اضافة قسط</a>
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
                                            <th>المبلغ</th>
                                            <th>تاريخ الدفع</th>
                                            <th>الوصف</th>
                                            <th>اجراء</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($invoice->installments as $installment)
                                            <tr>
                                                <td>{{ $installment->amount }}</td>
                                                <td>{{ $installment->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $installment->description }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('students.installments.edit', ['student' => $student->id, 'invoice' => $invoice->id, 'installment' => $installment->id]) }}">
                                                                <i class="bx bx-edit alt me-1"></i> تعديل
                                                            </a>
                                                            <form
                                                                action="{{ route('students.installments.destroy', ['student' => $student->id, 'invoice' => $invoice->id, 'installment' => $installment->id]) }}"
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
    @if (session('installment_created'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var installment_created = new bootstrap.Modal(document.getElementById('installment_created'), {
                    keyboard: false
                });
                installment_created.show();
            });
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="installment_created" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center ">
                        <h3 class="text-success">تم اضافة القسط بنجاح</h3>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if (session('installment_updated'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var installment_updated = new bootstrap.Modal(document.getElementById('installment_updated'), {
                    keyboard: false
                });
                installment_updated.show();
            });
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="installment_updated" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center ">
                        <h3 class="text-success">تم تحديث القسط بنجاح</h3>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if (session('installment_deleted'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var installment_deleted = new bootstrap.Modal(document.getElementById('installment_deleted'), {
                    keyboard: false
                });
                installment_deleted.show();
            });
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="installment_deleted" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center ">
                        <h3 class="text-danger">تم حذف القسط بنجاح</h3>
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
