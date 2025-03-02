<x-layout>
    <x-slot:title>
        اضافة طالب
    </x-slot:title>
    <x-slot:heading>
        اضافة طالب
    </x-slot:heading>

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Sticky Actions -->
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('students.store') }}" class="card" enctype="multipart/form-data">
                    @csrf
                    <div
                        class="card-header sticky-element bg-label-secondary d-flex justify-content-end align-items-sm-center flex-column flex-sm-row">
                        <div class="action-btns">
                            <button type="button" class="btn btn-label-primary me-3">
                                <span class="align-middle">رجوع</span>
                            </button>
                            <button class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <!-- 1. Delivery Address -->
                                <h5 class="mb-4">1. المعلومات الشخصيه</h5>
                                <div class="row g-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                                            <!-- Image Preview -->
                                            <img src="../assets/img/academy/community.png" alt="user-avatar"
                                                class="d-block rounded" height="100" width="100"
                                                id="uploadedAvatar" />

                                            <div class="button-wrapper">
                                                <label for="upload" class="btn btn-primary me-2" tabindex="0">
                                                    <span class="d-none d-sm-block">اضافة صورة</span>
                                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                                    <input type="file" id="upload" name="avatar"
                                                        class="account-file-input" hidden
                                                        accept="image/png, image/jpeg" />
                                                </label>

                                                <button type="button"
                                                    class="btn btn-outline-secondary account-image-reset"
                                                    onclick="resetImage()">
                                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">مسح</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-0" />
                                    <div class="col-md-6">
                                        <label class="form-label" for="name">الاسم</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="احمد جميل" required />
                                        <x-form-err name="name" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="gender">نوع الطالب</label>
                                        <select id="gender" name="gender" class="form-select" required>
                                            <option selected value="انثي">انثي</option>
                                            <option value="ذكر">ذكر</option>
                                        </select>
                                        <x-form-err name="gender" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="birthdate" class="form-label">تاريخ الميلاد</label>
                                        <div class="input-group input-group-merge">
                                            <input type="date" id="birthdate" name="birthdate" class="form-control"
                                                required />
                                            <x-form-err name="birthdate" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="father_phone">رقم ولي امر الطالب</label>
                                        <input type="number" id="father_phone" name="father_phone" class="form-control"
                                            aria-label="phone-number" required />
                                        <x-form-err name="father_phone" />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="alt_father_phone">رقم ولي امر
                                            الطالب(بديل)</label>
                                        <input type="number" id="alt_father_phone" name="alt_father_phone"
                                            class="form-control" aria-label="phone-number" />
                                        <x-form-err name="alt_father_phone" />
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="address">محل الاقامه</label>
                                        <input name="address" class="form-control" id="address" required />
                                        <x-form-err name="address" />
                                    </div>
                                </div>
                                <hr />
                                <!-- 2. Delivery Type -->
                                <h5 class="my-4">2. معلومات الاكاديميه</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="submission_date" class="form-label">تاريخ التقديم</label>
                                        <div class="input-group input-group-merge">
                                            <input type="date" id="submission_date" name="submission_date"
                                                class="form-control" required />
                                            <x-form-err name="submission_date" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="duration"> الفتره الدراسيه</label>
                                        <input name="duration" readonly value="{{ $classDuration }}"
                                            class="form-control" id="duration" />
                                        <x-form-err name="duration" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="academy_class_id">تحديد الفصل الدراسي</label>
                                        <select id="academy_class_id" name="academy_class_id" class="form-select"
                                            required>
                                            @foreach ($activeClasses as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-form-err name="academy_class_id" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="driver_id">تحديد الباص</label>
                                        <select id="driver_id" name="driver_id" class="form-select">
                                            <option selected value="">بدون باص</option>
                                            @foreach ($availableDrivers as $driver)
                                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-form-err name="bus_name" />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="pricing_plan">تحديد خطه الاسعار</label>
                                        <select id="pricing_plan" name="pricing_plan" class="form-select" required>
                                            <option selected value="بدون خطة">بدون خطة</option>
                                            <option value="شهري">شهري</option>
                                            <option value="ربع سنوي">ربع سنوي</option>
                                            <option value="نصف سنوي">نصف سنوي</option>
                                            <option value="سنوي">سنوي</option>
                                        </select>
                                        <x-form-err name="pricing_plan" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Sticky Actions -->
    </div>
    <!-- / Content -->

</x-layout>
