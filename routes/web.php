<?php

use App\Http\Controllers\Discussion\DiscussionController;
use App\Http\Controllers\UserManagement\RoleController;
use App\Http\Controllers\UserManagement\UserController;
use App\Http\Controllers\CourseManagement\CourseController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Assignment\AssignmentController;
use App\Http\Controllers\Material\MaterialController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [HomeController::class, 'root'])->name('root');

    //user routes
    Route::controller(UserController::class)->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/list', 'index')->name('viewusers');
            Route::get('/create', 'create')->name('adduser');
            Route::post('/store', 'store')->name('storeuser');
            Route::get('/edit/{id}', 'edit')->name('edituser');
            Route::post('/update/{id}', 'update')->name('updateuser');
            Route::delete('/delete/{id}', 'destroy')->name('deleteuser');

            //get students
            Route::get('/students', 'getStudents')->name('getstudents');
            //get teachers
            Route::get('/teachers', 'getTeachers')->name('getteachers');
        });
    });

    //role routes
    Route::controller(RoleController::class)->group(function () {
        Route::prefix('roles')->group(function () {
            Route::get('/list', 'index')->name('viewroles');
            Route::get('/create', 'create')->name('addrole');
            Route::post('/store', 'store')->name('storerole');
            Route::get('/edit/{id}', 'edit')->name('editrole');
            Route::post('/update/{id}', 'update')->name('updaterole');
            Route::delete('/delete/{id}', 'destroy')->name('deleterole');
        });
    });

    //course routes
    Route::controller(CourseController::class)->group(function () {
        Route::prefix('courses')->group(function () {
            Route::get('/list', 'index')->name('viewcourses');
            Route::get('/create', 'create')->name('addcourse');
            Route::post('/store', 'store')->name('storecourse');
            Route::get('/show/{id}', 'show')->name('showcourse');
            Route::get('/edit/{id}', 'edit')->name('editcourse');
            Route::post('/update/{id}', 'update')->name('updatecourse');
            Route::post('/delete/{id}', 'destroy')->name('deletecourse');
            Route::post('/addstudenttocourse', 'addStudentToCourse')->name('addstudenttocourse');
            Route::post('/removestudentfromcourse', 'removeStudentFromCourse')->name('removestudentfromcourse');
        });
    });

    //attendance routes
    Route::controller(AttendanceController::class)->group(function () {
        Route::prefix('attendance')->group(function () {
            Route::get('/list', 'index')->name('viewattendance');
            Route::get('/create', 'create')->name('addattendance');
            Route::post('/store', 'store')->name('storeeattendance');
            Route::get('/edit/{id}', 'edit')->name('editattendance');
            Route::post('/update/{id}', 'update')->name('updateattendance');
            Route::get('/delete/{id}', 'destroy')->name('deleteattendance');
        });
    });

    //assignment routes
    Route::controller(AssignmentController::class)->group(function () {
        Route::prefix('assignments')->group(function () {
            Route::get('/list', 'index')->name('viewassignments');
            Route::get('/create', 'create')->name('addassignment');
            Route::post('/store', 'store')->name('storeassignment');
            Route::get('/edit/{id}', 'edit')->name('editassignment');
            Route::post('/update/{id}', 'update')->name('updateassignment');
            Route::get('/delete/{id}', 'destroy')->name('deleteassignment');
            Route::get('/download/{id}', 'download')->name('downloadassignment');
        });
    });

    //material routes
    Route::controller(MaterialController::class)->group(function () {
        Route::prefix('materials')->group(function () {
            Route::get('/list', 'index')->name('viewmaterials');
            Route::get('/create', 'create')->name('addmaterial');
            Route::post('/store', 'store')->name('storematerial');
            Route::get('/edit/{id}', 'edit')->name('editmaterial');
            Route::post('/update/{id}', 'update')->name('updatematerial');
            Route::get('/delete/{id}', 'destroy')->name('deletematerial');
        });
    });

    //discussion routes
    Route::controller(DiscussionController::class)->group(function () {
        Route::prefix('discussions')->group(function () {
            Route::get('/list', 'index')->name('viewdiscussions');
            Route::get('/create', 'create')->name('adddiscussion');
            Route::post('/store', 'store')->name('storediscussion');
            Route::get('/edit/{id}', 'edit')->name('editdiscussion');
            Route::post('/update/{id}', 'update')->name('updatediscussion');
            Route::get('/delete/{id}', 'destroy')->name('deletediscussion');
        });
    });

});

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

// Update User Details

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/apps-ecommerce-products', function () {
    return view('apps-ecommerce-products');
});
