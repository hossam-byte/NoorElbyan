<x-layout>
    <x-slot:title>
        اضافة معلم
    </x-slot:title>
    <x-slot:heading>
        اضافة معلم
    </x-slot:heading>

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Sticky Actions -->
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('teachers.store') }}" class="card" enctype="multipart/form-data">
                    @csrf
                    <div
                        class="card-header sticky-element bg-label-secondary d-flex justify-content-end align-items-sm-center flex-column flex-sm-row">
                        <div class="action-btns ">
                            <button type="button" class="btn btn-label-primary me-3">
                                <span class="align-middle"> رجوع</span>
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
                                            <img src="../assets/img/academy/community.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />

                                            <div class="button-wrapper">
                                                <label for="upload" class="btn btn-primary me-2" tabindex="0">
                                                    <span class="d-none d-sm-block">اضافة صورة</span>
                                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                                    <input type="file" id="upload" name="avatar" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                                </label>

                                                <button type="button" class="btn btn-outline-secondary account-image-reset" onclick="resetImage()">
                                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">مسح</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="name">الاسم</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="احمد جميل" required />
                                        <x-form-err name="name"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="gender">نوع المعلم</label>
                                        <select id="gender" name="gender" class="form-select">
                                            <option value="انثي">انثي</option>
                                            <option value="ذكر">ذكر</option>
                                        </select>
                                        <x-form-err name="gender"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="birthdate" class="form-label">تاريخ الميلاد</label>
                                        <input type="date" id="birthdate" name="birthdate" class="form-control" required />
                                        <x-form-err name="birthdate"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="phone_number">رقم الهاتف</label>
                                        <input type="number" id="phone_number" name="phone_number" class="form-control" required />
                                        <x-form-err name="phone_number"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="education">المؤهل</label>
                                        <input type="text" id="education" name="education" class="form-control" placeholder="بكالريوس تجاره" required />
                                        <x-form-err name="education"/>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" for="address">محل الاقامه</label>
                                        <input id="address" name="address" class="form-control" required/>
                                        <x-form-err name="address"/>
                                    </div>
                                </div>
                                <hr />
                                <!-- 2. Delivery Type -->
                                <h5 class="my-4">2. معلومات الاكاديميه</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="hiring_date" class="form-label">تاريخ التوظيف</label>
                                        <input type="date" id="hiring_date" name="hiring_date" class="form-control" required />
                                        <x-form-err name="hiring_date"/>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" for="subject">المادة</label>
                                        <input id="subject" name="subject" class="form-control" required/>
                                        <x-form-err name="subject"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="duration">تحديد الفتره الدراسيه</label>
                                        <input name="duration" readonly value="{{$classDuration}}" class="form-control" id="duration" />
                                        <x-form-err name="duration"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="academy_class_id">تحديد الفصل الدراسي</label>
                                        <select id="academy_class_id" name="academy_class_id" class="form-select" required>
                                            @foreach($activeClasses as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-form-err name="academy_class_id"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="salary">الراتب</label>
                                        <input type="number" id="salary" name="salary" class="form-control" required />
                                        <x-form-err name="salary"/>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- /Sticky Actions -->
    </div>
    <!-- / Content -->

</x-layout>
