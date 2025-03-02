<x-layout>
    <x-slot:title>
        بيانات الطالب اسم الطالب
    </x-slot:title>
    <x-slot:heading>
        معلومات طلاب المؤسسة
    </x-slot:heading>
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-md-12">
                <form class="card mb-4">
                    <h5 class="card-header">1.البيانات الشخصيه</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                                src="../assets/img/avatars/1.png"
                                alt="user-avatar"
                                class="d-block rounded"
                                height="100"
                                width="100"
                                id="uploadedAvatar"
                            />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2" tabindex="0">
                                    <span class="d-none d-sm-block">اضافة صورة</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input
                                        type="file"
                                        id="upload"
                                        class="account-file-input"
                                        hidden
                                        accept="image/png, image/jpeg"
                                    />
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">مسح</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">اسم العضو</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="firstName"
                                    name="firstName"
                                    value=""
                                    autofocus
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="language" class="form-label">نوع الوصول</label>
                                <select id="language" class="form-select">
                                    <option value="">اختر نوع الوصول</option>
                                    <option value="مدير">مدير</option>
                                    <option value="مشرف">مشرف</option>
                                    <option value="معلم">معلم</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">اسم المستخدم</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="organization"
                                    name="organization"
                                    placeholder="FourSw Team"
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">كلمة المرور</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="organization"
                                    name="organization"
                                    placeholder="************"
                                />
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <h5 class="card-header">2.الصلاحيات</h5>

                    <div class="card-body">
                        <div class="row">

                            <div class="table-responsive">
                                <table class="table table-striped table-borderless border-bottom">
                                    <thead>
                                    <tr>
                                        <th class="text-nowrap">نوع الصلاحيه</th>
                                        <th class="text-nowrap text-center">القائمة</th>
                                        <th class="text-nowrap text-center">اضافة</th>
                                        <th class="text-nowrap text-center">تعديل</th>
                                        <th class="text-nowrap text-center">حذف</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-nowrap">التعامل مع الطلاب</td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck1" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck2" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">التعامل مع المعلمين</td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck1" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck2" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">التعامل مع الاختبارات</td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck1" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck2" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">التعامل مع الفصول</td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck1" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck2" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">التعامل مع الاعضاء</td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck1" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck2" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">التعامل مع المصاريف</td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck1" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck2" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">التعامل مع الاعدادات</td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck1" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck2" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">حفظ</button>
                        </div>
                    </div>

                    <!-- /Account -->
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->

</x-layout>
