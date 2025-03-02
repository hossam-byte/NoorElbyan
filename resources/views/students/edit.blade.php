<x-layout>
    <x-slot:title>
        تعديل بيانات الطالب - {{ $student->name }}
    </x-slot:title>
    <x-slot:heading>
        تعديل بيانات الطالب - {{ $student->name }}
    </x-slot:heading>

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Sticky Actions -->
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('students.update', $student->id) }}" class="card"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div
                        class="card-header sticky-element bg-label-secondary d-flex justify-content-end align-items-sm-center flex-column flex-sm-row">
                        <div class="action-btns">
                            <button type="button" class="btn btn-label-primary me-3">
                                <span class="align-middle">
                                    <a href="{{ route('students.index') }}" class="hover">رجوع</a>
                                </span>
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
                                        <input type="text" id="name" name="name" value="{{ $student->name }}"
                                            class="form-control" />
                                        <x-form-err name="name" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="gender">نوع الطالب</label>
                                        <select id="gender" name="gender" class="form-select">
                                            <option {{ $student->gender === 'انثي' ? 'selected' : '' }} value="انثي">
                                                انثي</option>
                                            <option {{ $student->gender === 'ذكر' ? 'selected' : '' }} value="ذكر">
                                                ذكر
                                            </option>
                                        </select>
                                        <x-form-err name="gender" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="birthdate" class="form-label">تاريخ الميلاد</label>
                                        <div class="input-group input-group-merge">
                                            <input type="date" id="birthdate" name="birthdate"
                                                value="{{ $student->birthdate }}" class="form-control" />
                                            <x-form-err name="birthdate" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="father_phone">رقم ولي امر الطالب</label>
                                        <input type="text" id="father_phone" name="father_phone"
                                            value="{{ $student->father_phone }}" class="form-control"
                                            aria-label="phone-number" />
                                        <x-form-err name="father_phone" />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="alt_father_phone">رقم ولي امر
                                            الطالب(بديل)</label>
                                        <input type="number" id="alt_father_phone" name="alt_father_phone"
                                            value="{{ $student->alt_father_phone }}" class="form-control"
                                            aria-label="phone-number" />
                                        <x-form-err name="alt_father_phone" />
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="address">محل الاقامه</label>
                                        <input name="address" class="form-control" value=" {{ $student->address }}"
                                            id="address" />
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
                                                value="{{ $student->submission_date }}" class="form-control" />
                                            <x-form-err name="submission_date" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="duration">تحديد الفتره الدراسيه</label>
                                        <select id="duration" name="duration" class="form-select">
                                            <option {{ $student->duration === 'صباحي' ? 'selected' : '' }}
                                                value="صباحي">صباحي</option>
                                            <option {{ $student->duration === 'مسائي' ? 'selected' : '' }}
                                                value="مسائي">مسائي</option>
                                        </select>
                                        <x-form-err name="duration" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="academy_class_id">تحديد الفصل الدراسي</label>
                                        <select id="academy_class_id" name="academy_class_id" class="form-select">
                                            <option selected value="{{ $student->academy_class_id }}">
                                                {{ $student->academyClass->name }}</option>
                                            @foreach ($activeClasses as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-form-err name="academy_class_id" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="driver_id">تحديد الباص</label>
                                        <select id="driver_id" name="driver_id" class="form-select" required>
                                            @if (!$student->driver_id)
                                                <option selected value="null">بدون باص</option>
                                                @foreach ($availableDrivers as $driver)
                                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                @endforeach
                                            @else
                                                @foreach ($availableDrivers as $driver)
                                                    <option value="null">بدون باص</option>
                                                    <option {{ $student->driver_id === $driver->id ? 'selected' : '' }}
                                                        value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <x-form-err name="driver_id" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="pricing_plan">تحديد خطه الاسعار</label>
                                        <select id="pricing_plan" name="pricing_plan" class="form-select">
                                            <option {{ $student->pricing_plane === 'بدون خط' ? 'selected' : '' }}
                                                value="بدون خطة">بدون خطة</option>
                                            <option {{ $student->pricing_plane === 'شهري' ? 'selected' : '' }}
                                                value="شهري">شهري</option>
                                            <option {{ $student->pricing_plane === 'ربع سنوي' ? 'selected' : '' }}
                                                value="">ربع سنوي</option>
                                            <option {{ $student->pricing_plane === 'نصف سنوي' ? 'selected' : '' }}
                                                value="نصف سنوي">نصف سنوي</option>
                                            <option {{ $student->pricing_plane === 'سنوي' ? 'selected' : '' }}
                                                value="سنوي">سنوي</option>
                                        </select>
                                        <x-form-err name="pricing_plan" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="is_archive">حالة الطالب</label>
                                        <select id="is_archive" name="is_archive" class="form-select">
                                            <option {{ $student->is_archive ? 'selected' : '' }} value="1">مؤرشف
                                            </option>
                                            <option {{ $student->is_archive ? '' : 'selected' }} value="0">مفعل
                                            </option>
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
