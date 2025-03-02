<x-layout>
    <x-slot:title>
        تعديل فصل - {{$class->name}}
    </x-slot:title>
    <x-slot:heading>
        تعديل فصل - {{$class->name}}
    </x-slot:heading>

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Sticky Actions -->
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('classes.update', $class->id) }}" class="card" id="classForm">
                    @csrf
                    @method('PUT')
                    <div class="card-header sticky-element bg-label-secondary d-flex justify-content-end align-items-sm-center flex-column flex-sm-row">
                        <div class="action-btns">
                            <button type="button" class="btn btn-label-primary me-3">
                                <span class="align-middle">رجوع</span>
                            </button>
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
                                            value="{{ $class->name }}"
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
                                            value="{{ $class->number_of_seats }}"
                                            class="form-control"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="taken_seats">العدد المشغول</label>
                                        <input
                                            required
                                            type="number"
                                            id="taken_seats"
                                            name="taken_seats"
                                            value="{{ $class->taken_seats }}"
                                            class="form-control"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="available_seats">العدد المتاح</label>
                                        <input
                                            required
                                            type="number"
                                            id="available_seats"
                                            name="available_seats"
                                            value="{{ $class->available_seats }}"
                                            class="form-control"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="duration">الفترة</label>
                                        <select required id="duration" name="duration" class="form-select">
                                            <option {{ $class->duration === 'صباحي' ? 'selected' : '' }} value="صباحي">صباحي</option>
                                            <option {{ $class->duration === 'مسائي' ? 'selected' : '' }} value="مسائي">مسائي</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="status">الحالة</label>
                                        <select required id="status" name="status" class="form-select">
                                            <option {{ $class->status === 'active' ? 'selected' : '' }} value="active">يعمل</option>
                                            <option {{ $class->status === 'inactive' ? 'selected' : '' }} value="inactive">لا يعمل</option>
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

            // Function to update the available_seats or taken_seats automatically
            function updateSeats() {
                const totalSeats = parseInt(number_of_seats.value);
                const taken = parseInt(taken_seats.value);
                const available = parseInt(available_seats.value);

                if (!isNaN(totalSeats)) {
                    if (this === taken_seats) {
                        // If taken_seats is updated, calculate available_seats
                        available_seats.value = Math.max(0, totalSeats - taken);
                    } else if (this === available_seats) {
                        // If available_seats is updated, calculate taken_seats
                        taken_seats.value = Math.max(0, totalSeats - available);
                    }
                }

                // Validate the sum
                if (parseInt(taken_seats.value) + parseInt(available_seats.value) > totalSeats) {
                    validationError.style.display = 'block';
                } else {
                    validationError.style.display = 'none';
                }
            }

            // Add event listeners to inputs
            taken_seats.addEventListener('input', updateSeats);
            available_seats.addEventListener('input', updateSeats);
            number_of_seats.addEventListener('input', updateSeats);

            // Validate on form submission
            form.addEventListener('submit', function (e) {
                const totalSeats = parseInt(number_of_seats.value);
                const taken = parseInt(taken_seats.value);
                const available = parseInt(available_seats.value);

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
