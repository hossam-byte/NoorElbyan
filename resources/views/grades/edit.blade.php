<x-layout>
    <x-slot:title>
        قائمه الاختبارات
    </x-slot:title>
    <x-slot:heading>
        قائمة الاختبارت
    </x-slot:heading>
    <div class="container-xxl container-p-y">

        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="nav-align-top mb-4">
                <div class="tab-content border-0 p-0">
                    <div class="tab-pane fade show active" id="first-duration" role="tabpanel">
                        <form class="card" method="POST" action="{{ route('grades.update') }}">
                            @csrf <!-- Include CSRF token for security -->
                            @method('PATCH') <!-- Simulate a PATCH request -->

                            <div class="d-flex align-items-center justify-content-between ">
                                <h5 class="card-header d-flex gap-3">درجات اختبار (اسم اللغه)/ فصل خالد بن الوليد</h5>
                                <button type="submit" class="btn btn-success suspend-user me-4">حفظ التعديلات</button>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>اسم الطالب</th>
                                        <th>الدرجة النهائية</th>
                                        <th>درجة الطالب</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                    @foreach($thisQuizStudentsGrades as $grade)
                                        <tr>
                                            <td>{{$grade->student->name}}</td>
                                            <td>{{$grade->quiz->final_grade}}</td>
                                            <td>
                                                <input type="hidden" name="quizId" value="{{$grade->quiz->id}}">
                                                <input type="number"
                                                       id="grade-{{$grade->id}}"
                                                       name="grades[{{$grade->id}}]"
                                                       value="{{$grade->grade}}"
                                                       class="form-control grade-input"
                                                       data-final-grade="{{$grade->quiz->final_grade}}"
                                                       aria-label="grade" />
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>



                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Select all input fields with the class "grade-input"
            const gradeInputs = document.querySelectorAll(".grade-input");

            gradeInputs.forEach(input => {
                input.addEventListener("input", function () {
                    const finalGrade = parseFloat(this.dataset.finalGrade);
                    const enteredGrade = parseFloat(this.value);

                    if (enteredGrade > finalGrade) {
                        // If the entered grade exceeds the final grade
                        this.value = finalGrade; // Reset the value to the final grade
                        alert(`الدرجة المدخلة لا يمكن أن تتجاوز الدرجة النهائية (${finalGrade}).`);
                    }
                });
            });
        });
    </script>
</x-layout>
