<x-layout>
    <x-slot:title>
        لوحة التحكم
    </x-slot:title>
    <x-slot:heading>
        أحصايات المؤسسة
    </x-slot:heading>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-title d-flex align-items-center justify-content-center">
                            <div class="fs-large">
                                <i class="fa-solid fa-user-graduate"></i>
                            </div>
                        </div>
                        <span class="d-block mb-2">الطلاب المتفاعلين - صباحي</span>
                        <h3 class="card-title text-nowrap mb-2">{{$morningStudents->count()}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-title d-flex align-items-center justify-content-center">
                            <div class="fs-large">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </div>
                        </div>
                        <span class="d-block mb-2">المعلمين المتفاعلين - صباحي</span>
                        <h3 class="card-title text-nowrap mb-2">{{$morningTeachers->count()}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-title d-flex align-items-center justify-content-center">
                            <div class="fs-large">
                                <i class="fa-solid fa-school"></i>
                            </div>
                        </div>
                        <span class="d-block mb-2">الفصول المفعلة - صباحي </span>
                        <h3 class="card-title text-nowrap mb-2">{{$morningClasses->count()}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-title d-flex align-items-center justify-content-center">
                            <div class="fs-large">
                                <i class="fa-solid fa-user-clock"></i>
                            </div>
                        </div>
                        <span class="d-block mb-2 ">الطلاب المؤرشفين</span>
                        <h3 class="card-title text-nowrap mb-2">{{$archiveStudents->count()}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-title d-flex align-items-center justify-content-center">
                            <div class="fs-large">
                                <i class="fa-solid fa-user-graduate"></i>
                            </div>
                        </div>
                        <span class="d-block mb-2">الطلاب المتفاعلين - مسائي</span>
                        <h3 class="card-title text-nowrap mb-2">{{$afternoonStudents->count()}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-title d-flex align-items-center justify-content-center">
                            <div class="fs-large">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </div>
                        </div>
                        <span class="d-block mb-2">المعلمين المتفاعلين - مسائي</span>
                        <h3 class="card-title text-nowrap mb-2">{{$afternoonTeachers->count()}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-title d-flex align-items-center justify-content-center">
                            <div class="fs-large">
                                <i class="fa-solid fa-school"></i>
                            </div>
                        </div>
                        <span class="d-block mb-2">الفصول المفعلة - مسائي </span>
                        <h3 class="card-title text-nowrap mb-2">{{$afternoonClasses->count()}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-title d-flex align-items-center justify-content-center">
                            <div class="fs-large">
                                <i class="fa-solid fa-user-clock"></i>
                            </div>
                        </div>
                        <span class="d-block mb-2 ">المعلمين المؤرشفين</span>
                        <h3 class="card-title text-nowrap mb-2">{{$archiveTeachers->count()}}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-lg-6 col-xl-6 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">
                                الحضور اليومي للطلاب (صباحي)
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success"><i class="bx bx-check"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">حضور</h6>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-medium">{{$morningPresentStudents->count()}}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-danger"
                            ><i class="bx bx-x"></i
                                ></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">غياب</h6>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-medium">{{$morningAbsentStudents->count()}}</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-6 col-xl-6 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">
                                الحضور اليومي للمعلمين (صباحي)
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success"><i class="bx bx-check"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">حضور</h6>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-medium">{{$morningPresentTeachers->count()}}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-danger"
                            ><i class="bx bx-x"></i
                                ></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">غياب</h6>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-medium">{{$morningAbsentTeachers->count()}}</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-lg-6 col-xl-6 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">
                                الحضور اليومي للطلاب (مسائي)
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success"><i class="bx bx-check"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">حضور</h6>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-medium">{{$afternoonPresentStudents->count()}}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-danger"
                            ><i class="bx bx-x"></i
                                ></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">غياب</h6>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-medium">{{$afternoonAbsentStudents->count()}}</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-6 col-xl-6 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">
                                الحضور اليومي للمعلمين (مسائي)
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success"><i class="bx bx-check"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">حضور</h6>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-medium">{{$afternoonPresentTeachers->count()}}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-danger"
                            ><i class="bx bx-x"></i
                                ></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">غياب</h6>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-medium">{{$afternoonAbsentTeachers->count()}}</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">تم بناء نظام الإدارة من قبل شركة Foursw 🎉</h5>
                                <p class="mb-4">
                                    لوحة تحكم واجهة المستخدم
                                    من الألوان والبطاقات والطباعة إلى العناصر المعقدة، ستجد الوثائق الكاملة.
                                </p>

                                <a href="javascript:;" class="btn btn-sm btn-label-primary"> FOURSW.COM </a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img
                                    src="../../assets/img/illustrations/man-with-laptop-light.png"
                                    height="140"
                                    alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
