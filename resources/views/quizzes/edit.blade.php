<x-layout>
    <x-slot:title>
        تعديل الاختبار
    </x-slot:title>
    <x-slot:heading>
        تعديل الاختبار
    </x-slot:heading>

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Sticky Actions -->
        <div class="row">
            <div class="col-12">
                <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST" class="card" id="classForm">
                    @csrf
                    @method('PATCH')

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
                                        <label class="form-label" for="title">اسم المادة</label>
                                        <input
                                            required
                                            type="text"
                                            id="title"
                                            name="title"
                                            value="{{$quiz->title}}"
                                            class="form-control"/>
                                        <x-form-err name="name" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="academy_class_id">الفصل</label>
                                        <select required id="academy_class_id" name="academy_class_id" class="form-select">
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}" {{$class->id === $quiz->academyClass->id? 'selected': ''}}>{{$class->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="final_grade">الدرجة النهائية</label>
                                        <input
                                            required
                                            type="number"
                                            id="final_grade"
                                            name="final_grade"
                                            value="{{$quiz->final_grade}}"
                                            min="0"
                                            class="form-control"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="hiring_date" class="form-label">تاريخ الامتحان</label>
                                        <input type="date" id="date" value="{{$quiz->date}}" name="date" class="form-control" required />
                                        <x-form-err name="date"/>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="kind">نوع الاختبار</label>
                                        <x-form-err name="kind"/>
                                        <select required id="kind" name="kind" class="form-select">
                                            <option {{$quiz->kind === 'اسبوعي' ? 'selected': ''}} value="اسبوعي">اسبوعي</option>
                                            <option {{$quiz->kind === 'شهري' ? 'selected': ''}} value="شهري">شهري</option>
                                            <option {{$quiz->kind === 'نصف سنوي' ? 'selected': ''}} value="نصف سنوي">نصف سنوي</option>
                                        </select>
                                    </div>
                                    <!-- Error message for validation -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>
