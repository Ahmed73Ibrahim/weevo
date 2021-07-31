<?php
/********************************************************/
use App\Http\Controllers\AUTH_USERS\Add_user;
use App\Http\Controllers\AUTH_USERS\Change_pass;
use App\Http\Controllers\AUTH_USERS\Login;
use App\Http\Controllers\AUTH_USERS\Reset_pass;
use App\Http\Controllers\AUTH_USERS\Deep_search;
use App\Http\Controllers\AUTH_USERS\Update_user; // test
use App\Http\Controllers\AUTH_USERS\Update_student;
use App\Http\Controllers\AUTH_USERS\AuthController;
use App\Http\Controllers\AUTH_USERS\Del_student;
use App\Http\Controllers\AUTH_USERS\Del_user;
use App\Http\Controllers\Auto\Auto_cancel;
use App\Http\Controllers\Auto\Auto_enroll;
use App\Http\Controllers\Auto\Refresh;

/********************************************************/
use App\Http\Controllers\Yellow\Course98;
use App\Http\Controllers\Yellow\Department98;
use App\Http\Controllers\Yellow\Pre_req98;
use App\Http\Controllers\Yellow\Section98;
use App\Http\Controllers\Yellow\SHC98;
use App\Http\Controllers\Yellow\List_C;
/********************************************************/
use App\Http\Controllers\F_Student\Enroll_course;
use App\Http\Controllers\F_Student\Cancel_course;
use App\Http\Controllers\F_Student\Show_degree;
/********************************************************/
use App\Http\Controllers\F_Advisor\Enter_degree;
use App\Http\Controllers\F_Advisor\Feedback98;
use App\Http\Controllers\F_Advisor\Attends;
use App\Http\Controllers\F_Advisor\Signature;
use App\Http\Controllers\F_Advisor\Search_student;
/********************************************************/
use App\Http\Controllers\Chat;
use App\Http\Controllers\F_Advisor\Layer;
use App\Http\Controllers\F_Student\Byan_nga7;
use App\Http\Controllers\F_Student\Current_courses;
use App\Http\Controllers\F_Student\Intell_advise;
use App\Http\Controllers\List_database;
use App\Http\Controllers\Z_CODEBASE\Test;
/*||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
use App\Http\Middleware\type_s;
use App\Http\Middleware\type_adv;
use App\Http\Middleware\type_admin;
/*||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request)
{
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'],function ($router)
 {

    Route::post('list_database', List_database::class . '@list_database');

    Route::post('add_user', Add_user::class . '@add_user');
    Route::post('login', Login::class . '@login');
    Route::post('change_pass', Change_pass::class . '@change_pass');
    Route::post('sendresetpasswordemail',Reset_pass::class . '@sendresetpasswordemail');
    Route::post('reset_pass',Reset_pass::class.'@resetpassword');
    Route::post('logout', AuthController::class . '@logout');
    Route::post('refresh', AuthController::class . '@refresh');
    Route::post('me', AuthController::class . '@me');
    Route::post('deep_search',Deep_search::class.'@deep_search');

 });

Route::group(['middleware' => type_admin::class, 'prefix' => '98'],function ($router)
 {
        Route::post('update_user', Update_user::class . '@update_user');
        Route::post('del_user', Del_user::class . '@del_user');
        Route::post('del_student', Del_student::class . '@del_student');
        Route::post('update_student', Update_student::class . '@update_student');
 });


Route::group(
    ['middleware' => type_admin::class, 'prefix' => 'private'],
    function ($router)
    {

        Route::post('enter_degree', [Enter_degree::class,'enter_degree']);

        Route::post('department98', [Department98::class,'department98']);
      //  Route::post('del_dep98', [Department98::class,'del_dep98']);

        Route::post('section98', [Section98::class,'section98']);
      //  Route::post('del_sec98', [Section98::class,'del_sec98']);

        Route::post('course98', [Course98::class,'course98']);
      //  Route::post('del_Course', [Course98::class,'del_Course']);

        Route::post('pre_req98', [Pre_req98::class,'pre_req98']);
     //   Route::post('del_pr98', [Pre_req98::class,'del_pr98']);

        Route::post('shc98', [SHC98::class,'shc98']);
     //   Route::post('del_shc98', [SHC98::class,'del_shc98']);

        // can't list all COURSES without link it with SHC [ SHC DISPLAY ]
    }
);

Route::group(
    ['middleware' => type_adv::class , 'api', 'prefix' => 'advisor'],
    function ($router)
    {
        Route::post('signature', [Signature::class,'signature'])->middleware(type_adv::class);
        Route::post('search_student', Search_student::class . '@search_student')->middleware(type_adv::class);
        Route::post('feedback98', Feedback98::class . '@feedback98');
        Route::post('del_feedback98', Feedback98::class . '@del_feedback98');
        Route::post('Layer_f', Layer::class . '@Layer_f');


    }
);

Route::group(
    ['middleware' => 'api', 'prefix' => 'service'],
    function ($router)
    {



        Route::post('attends', [Attends::class,'attends'])->middleware(type_s::class); // for attend LAYER 1   /////////////////////////////////////////////

        Route::get('list_departemnts', [Department98::class,'list_departemnts']);
        Route::get('list_feedbacks', Feedback98::class . '@list_feedbacks');
        Route::post('list_c', [List_C::class,'list_c']);  // all courses must DEPARTMENT [OPTIONAL::SECTION-LVL-SEMESTER]
        /*****************  CAN NOT LIST SCETIONS ONLY => SHC ****************************/
        Route::post('enroll_course', [Enroll_course::class,'enroll_course'])->middleware(type_s::class);
        Route::post('cancel_course', [Cancel_course::class,'cancel_course'])->middleware(type_s::class);
        Route::post('current_courses', [Current_courses::class,'current_courses']);
        /*****************************************************************************/
        Route::post('show_degree', Show_degree::class.'@show_degree'); // GPA - DEGREE
        /*****************************************************************************/
        Route::post('byan_nga7', Byan_nga7::class.'@byan_nga7'); // GPA - DEGREE

        Route::post('Student_Records', Byan_nga7::class.'@Student_Records'); // GPA - DEGREE

        /*****************************************************************************/
        Route::post('auto_enroll', Auto_enroll::class.'@auto_enroll'); // auto enroll
        Route::post('auto_cancel', Auto_cancel::class.'@auto_cancel'); // auto enroll


        /*****************************************************************************/
        Route::post('refresh_f', Refresh::class.'@refresh_f')->middleware(type_admin::class);
        /*****************************************************************************/
        /*****************************************************************************/
        Route::post('intell_advise', [Intell_advise::class,'intell_advise']);
        /*****************************************************************************/
        /*****************************************************************************/
    }
);

Route::group(['middleware' => 'api', 'prefix' => 'chat'],function ($router)
    {
        Route::get('messages', Chat::class . '@fetchMessages');
        Route::post('messages', Chat::class . '@sendMessage');
    });

Route::group(['middleware' => 'api', 'prefix' => 'testing'],function ($router)
    {
        Route::post('test', Test::class.'@test');
        Route::post('auto_student', Auto_student::class.'@auto_student');


    });


