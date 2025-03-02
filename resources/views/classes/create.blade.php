<x-layout>
    <x-slot:title>
        اضافة فصل
    </x-slot:title>
    <x-slot:heading>
        اضافة فصل
    </x-slot:heading>

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Sticky Actions -->
        <div class="row">
            <div class="col-12">
                <form action="{{ route('classes.store') }}" method="POST" class="card" id="classForm">
                    @csrf
                    <div class="card-header sticky-element bg-label-secondary d-flex justify-content-end align-items-sm-center flex-column flex-sm-row">
                        <div class="action-btn">
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="name">اسم الفصل</label>
                                        <input
                                            required
                                            type="text"
                                            id="name"
                                            name="name"
                                            class="form-control"/>
                                        <x-form-err name="name" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="number_of_seats">عدد المقاعد</label>
                                        <input
                                            required
                                            type="number"
                                            id="number_of_seats"
                                            name="number_of_seats"
                                            min="0"
                                            class="form-control"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="taken_seats">العدد المشغول</label>
                                        <input
                                            required
                                            type="number"
                                            id="taken_seats"
                                            name="taken_seats"
                                            min="0"
                                            class="form-control"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="available_seats">العدد المتاح</label>
                                        <input
                                            required
                                            type="number"
                                            id="available_seats"
                                            name="available_seats"
                                            min="0"
                                            class="form-control"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="duration">الفترة</label>
                                        <select required id="duration" name="duration" class="form-select">
                                            <option value="صباحي">صباحي</option>
                                            <option value="مسائي">مسائي</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="status">الحالة</label>
                                        <select required id="status" name="status" class="form-select">
                                            <option value="active">يعمل</option>
                                            <option value="inactive">لا يعمل</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Error message for validation -->
                                <div id="validationError" class="text-danger mt-3" style="display: none;">
                                    يجب ألا يتجاوز مجموع المقاعد المشغولة والمتاحة عدد المقاعد الكلي.
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('classForm');
            const number_of_seats = document.getElementById('number_of_seats');
            const taken_seats = document.getElementById('taken_seats');
            const available_seats = document.getElementById('available_seats');
            const validationError = document.getElementById('validationError');

            // Function to update seats automatically and validate
            function updateSeats() {
                const totalSeats = parseInt(number_of_seats.value) || 0;
                const taken = parseInt(taken_seats.value) || 0;
                const available = parseInt(available_seats.value) || 0;

                if (this === taken_seats || this === available_seats) {
                    // Adjust the other input based on changes
                    if (this === taken_seats) {
                        available_seats.value = Math.max(0, totalSeats - taken);
                    } else {
                        taken_seats.value = Math.max(0, totalSeats - available);
                    }
                } else if (this === number_of_seats) {
                    // Adjust both taken and available when total seats change
                    if (taken + available > totalSeats) {
                        const remainingSeats = totalSeats - taken;
                        available_seats.value = Math.max(0, remainingSeats);
                    }
                }

                // Display validation error if total exceeds the limit
                if (taken_seats.valueAsNumber + available_seats.valueAsNumber > totalSeats) {
                    validationError.style.display = 'block';
                } else {
                    validationError.style.display = 'none';
                }
            }

            // Add event listeners to inputs
            number_of_seats.addEventListener('input', updateSeats);
            taken_seats.addEventListener('input', updateSeats);
            available_seats.addEventListener('input', updateSeats);

            // Validate on form submission
            form.addEventListener('submit', function (e) {
                const totalSeats = parseInt(number_of_seats.value) || 0;
                const taken = parseInt(taken_seats.value) || 0;
                const available = parseInt(available_seats.value) || 0;

                if (taken + available > totalSeats) {
                    validationError.style.display = 'block';
                    e.preventDefault(); // Stop form submission if validation fails
                } else {
                    validationError.style.display = 'none';
                }
            });
        });
    </script>

</x-layout>
