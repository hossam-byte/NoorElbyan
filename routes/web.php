<?php

use App\Http\Controllers\AcademyClassController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentAbsenceController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\TeacherAbsenceController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\InvoiceInstallmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('auth.login');});


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

// CLASSES
    Route::get('/classes', [AcademyClassController::class, 'index'])->name('classes.index');
    Route::get('/classes/create', [AcademyClassController::class, 'create'])->name('classes.create');
    Route::post('/classes', [AcademyClassController::class , 'store'])->name('classes.store');
    Route::put('/classes/{class}', [AcademyClassController::class , 'update'])->name('classes.update');
    Route::delete('/classes/{class}', [AcademyClassController::class , 'destroy'])->name('classes.destroy');
    Route::get('/classes/{class}/edit', [AcademyClassController::class , 'edit'])->name('classes.edit');

// STUDENTS
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::patch('/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::get('/students/{student}/show', [StudentController::class, 'show'])->name('students.show');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');


    Route::post('/students/absence', [StudentAbsenceController::class, 'store'])->name('students.absence.store');
    Route::get('/students/absence', [StudentAbsenceController::class, 'index'])->name('students.absence.index');
    Route::get('/students/absence-h', [StudentAbsenceController::class, 'show'])->name('students.absence.show');
    Route::get('/students/edit-absence', [StudentAbsenceController::class, 'edit'])->name('students.absence.edit');
//    Route::get('/students/fetch-absence', [StudentAbsenceController::class, 'fetchAbsence'])->name('students.absence.fetch');

//  STUDENT INVOICES
    Route::get('/students/{student}/invoices/create', [StudentController::class, 'createInvoice'])->name('students.invoices.create');
    Route::post('/students/{student}/invoices', [StudentController::class, 'storeInvoice'])->name('students.invoices.store');
    Route::patch('/students/{student}/invoices/{invoice}', [StudentController::class, 'updateInvoice'])->name('students.invoices.update');
    Route::delete('/students/{student}/invoices/{invoice}', [StudentController::class, 'destroyInvoice'])->name('students.invoices.destroy');
    Route::get('/students/{student}/invoices/{invoice}/show', [StudentController::class, 'showInvoice'])->name('students.invoices.show');
    Route::get('/students/{student}/invoices/{invoice}/edit', [StudentController::class, 'editInvoice'])->name('students.invoices.edit');

//  STUDENT INVOICE INSTALLMENTS
Route::get('/students/{student}/invoices/{invoice}/installments/create', [InvoiceInstallmentController::class, 'create'])->name('students.installments.create');
Route::post('/students/{student}/invoices/{invoice}/installments', [InvoiceInstallmentController::class, 'store'])->name('students.installments.store');
Route::patch('/students/{student}/invoices/{invoice}/installments/{installment}', [InvoiceInstallmentController::class, 'update'])->name('students.installments.update');
Route::get('/students/{student}/invoices/{invoice}/installments/{installment}/edit', [InvoiceInstallmentController::class, 'edit'])->name('students.installments.edit');
Route::delete('/students/{student}/invoices/{invoice}/installments/{installment}', [InvoiceInstallmentController::class, 'destroy'])->name('students.installments.destroy');


// TEACHERS

    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
    Route::patch('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/teachers/{teacher}', action: [TeacherController::class, 'destroy'])->name('teachers.destroy');
    Route::get('/teachers/{teacher}/show', [TeacherController::class, 'show'])->name('teachers.show');
    Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');


    Route::post('/teachers/absence', [TeacherAbsenceController::class, 'store'])->name('teachers.absence.store');
    Route::get('/teachers/absence', [TeacherAbsenceController::class, 'index'])->name('teachers.absence.index');
    Route::get('/teachers/absence-h', [TeacherAbsenceController::class, 'show'])->name('teachers.absence.show');
    Route::get('/teachers/edit-absence', [TeacherAbsenceController::class, 'edit'])->name('teachers.absence.edit');


    // TEACHER SALARIES
    Route::get('/teachers/{teacher}/salaries/create', [TeacherController::class, 'createSalary'])->name('teachers.salaries.create');
    Route::post('/teachers/{teacher}/salaries', [TeacherController::class, 'storeSalary'])->name('teachers.salaries.store');
    Route::get('/teachers/{teacher}/salaries/{salary}/edit', [TeacherController::class, 'editSalary'])->name('teachers.salaries.edit');
    Route::patch('/teachers/{teacher}/salaries/{salary}', [TeacherController::class, 'updateSalary'])->name('teachers.salaries.update');
    Route::delete('/teachers/{teacher}/salaries/{salary}', [TeacherController::class, 'destroySalary'])->name('teachers.salaries.destroy');



// QUIZZES
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
    Route::patch('/quizzes/{quiz}', [QuizController::class, 'update'])->name('quizzes.update');
    Route::delete('/quizzes/{quiz}', [QuizController::class, 'destroy'])->name('quizzes.destroy');
//    Route::get('/quizzes/{quiz}/show', [QuizController::class, 'show'])->name('quizzes.show');
    Route::get('/quizzes/{quiz}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');

// GRADES
    Route::get('/{quiz}/grades', [GradeController::class, 'index'])->name('grades.index');
    Route::patch('/grades/update', [GradeController::class, 'update'])->name('grades.update');
    Route::get('/{quiz}/grades/edit', [GradeController::class, 'edit'])->name('grades.edit');

// DRIVERS
    Route::get('/drivers', [DriverController::class, 'index'])->name('drivers.index');
    Route::get('/drivers/create', [DriverController::class, 'create'])->name('drivers.create');
    Route::patch('/drivers/{driver}', [DriverController::class, 'update'])->name('drivers.update');
    Route::delete('/drivers/{driver}', action: [DriverController::class, 'destroy'])->name('drivers.destroy');
    Route::post('/drivers', [DriverController::class , 'store'])->name('drivers.store');
    Route::get('/drivers/{driver}/show', [DriverController::class, 'show'])->name('drivers.show');
    Route::get('/drivers/{driver}/edit', [DriverController::class, 'edit'])->name('drivers.edit');


// BUS SUBSCRIBERS
    // Route::get('/bus-subscribers', [::class, 'index'])->name('bus-subscribers.index');


// STUFF
    Route::get('/stuff', function () {return view('stuff.index');})->name('stuff.index');
    Route::get('/stuff/create', function () {return view('stuff.create');})->name('stuff.create');
});




// ERRORS
//    Route::get('/page-40', function () {return view('errors.40');})->name('errors.40');
Route::fallback(function () {
    return view('errors.404'); // Your custom 404 view
})->name('fallback');

require __DIR__.'/auth.php';
