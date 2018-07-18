<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
function curPageURL() {
    $pageURL = 'http';
    //if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
     $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
     $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
   }

/* Code Improvment By  mailbeez */
if (defined('CNF_MULTILANG') && CNF_MULTILANG == 1) {
    $lang = (Session::get('lang') != "" ? Session::get('lang') : CNF_LANG);
    App::setLocale($lang);
}
/* End Improvment mailbeez */

Route::controller('user', 'UserController'); 
Route::get('/', 'HomeController@index');
Route::controller('home', 'HomeController');
Route::controller('blog', 'BlogController');
include('pageroutes.php');
Route::post('edit-profile/updateprofile', 'HomeController@postUpdateprofile');

Route::controller('create-project', 'CreateProjectController');
Route::post('create-project/newproject', 'CreateProjectController@postNewproject');
Route::get('create-project-content', 'CreateProjectContentController@getIndex');
Route::post('create-project-content/contentproject', 'CreateProjectContentController@postContentproject');

Route::get('show-project/{alias}', 'HomeController@index');
Route::get('showMessages/{alias}', 'HomeController@index');
Route::get('showMessageUser/{alias}', 'HomeController@index');
Route::post('showproject/addMessages', 'HomeController@postAddMessages');
Route::post('account/addMessages', 'HomeController@postAddMessagesUser');
Route::post('showproject/viewMessages', 'HomeController@postViewMessages');
Route::get('manage-project/{alias}', 'HomeController@index');

Route::post('manage-project/updateproject', 'ManageProjectController@postUpdateProject');
Route::post('manage-project/updatecontent', 'ManageProjectController@postUpdateContentProject');
Route::post('manage-project/addreward', 'ManageProjectController@postAddReward');
Route::post('manage-project/addpost', 'ManageProjectController@postAddPosting');
Route::get('manage-project/deletepost', 'ManageProjectController@getDeletePosting');

Route::post('manage-project/editpost', 'ManageProjectController@postEditPosting');


Route::post('change-password/changepassword', 'UserController@postChangepassword');
Route::post('forgot-password/forgotpassword', 'ForgotPasswordController@requestPassword');
Route::post('show-project/submitpledge', 'HomeController@postSubmitpledge');
Route::post('submitpledge/{pm}', 'HomeController@postSubmitpledge');
Route::post('show-project/topuppledge', 'HomeController@postTopuppledge');
Route::get('finish-payment', 'HomeController@index');
Route::post('payment-landing', 'HomeController@index');

Route::controller('browse',  'BrowseFileController');
//Route::get('browse',  'BrowseFileController@getIndex');
Route::post('upload', function(){
    
    // Required: anonymous function reference number as explained above.
    $funcNum = $_GET['CKEditorFuncNum'] ;
    // Optional: instance name (might be used to load a specific configuration file or anything else).
    $CKEditor = $_GET['CKEditor'] ;
    // Optional: might be used to provide localized messages.
    $langCode = $_GET['langCode'] ;

    try{
        // Check the $_FILES array and save the file. Assign the correct path to a variable ($url).
        $tmpName = $_FILES['upload']['tmp_name'];
        $name = $_FILES["upload"]["name"];
        $file_name = explode(".", $name);                                
        $name2 = $file_name[0];
        $ext = $file_name[1];
        $location="uploads/project/";
        if (!file_exists($location)) {
            mkdir("uploads/project", 0777);
        }
        
        $image_info = getimagesize($_FILES["upload"]["tmp_name"]);
        $image_width = $image_info[0];
        $image_height = $image_info[1];

        $n = 0;
        do{ 
            $query = "SELECT name FROM user_image where name = '".$name."' ";
            $rs = DB::select($query);            
                if($rs != null)
                {                
                    $n++;                                                   
                    $name = $name2."(".$n.").".$ext;            
                }        
                //if($n == 5) break;
        }while($rs != null);

        move_uploaded_file($tmpName, $location.$name);
        //$url = 'http://'.$_SERVER['SERVER_NAME'].'/'.$location.$name;
        $url = 'http://'.$_SERVER['HTTP_HOST'].'/'.$location.$name;        
        // Usually you will only assign something here if the file could not be uploaded.
        date_default_timezone_set("Asia/Jakarta");
        $data = array(
                'url'=>$url,
                'name'=>$name,
                'width'=>$image_width,
                'height'=>$image_height,
                'upload_time'=>date('Y-m-d h:i:s'),
                'user_id'=>Auth::id()
            );
        
        $id = DB::table('user_image')->insertGetId(
                $data
            );
        
        $message = 'Upload File Success';
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
    }catch(Exception $e){
        $message = 'Upload File Failed. Err : '.$e->getMessage();
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '', '$message');</script>";
    }

    
});
Route::get('topuppledge/{id}', 'HomeController@topupPledge');
 
Route::group(array('before' => 'auth'), function() 
{
	/* CORE APPLICATION DONT DELETE IT */
	Route::controller('pages', 'PagesController');
	Route::controller('users', 'UsersController');
	Route::controller('groups', 'GroupsController');
	Route::controller('menu', 'MenuController');
	Route::controller('dashboard', 'DashboardController');
	Route::controller('module', 'ModuleController');
	Route::controller('config', 'ConfigController');
	Route::controller('logs', 'LogsController');
	Route::controller('blogadmin', 'BlogadminController');
	Route::controller('blogcategories', 'BlogcategoriesController');
	Route::controller('blogcomment', 'BlogcommentController');
	/* END CORE APPLICATION  */
	
	/* Dynamic Routers */
	include('moduleroutes.php');
});	

Route::get('/halo', function()
{
    return "Halo, bro";
});

//Route::get('fbauth/{auth?}', 'AuthController@getFacebookLogin');
Route::get('fbauth/{auth?}',array('as'=>'facebookAuth','uses'=>'AuthController@getFacebookLogin'));
Route::get('twitterAuth/{auth?}',array('as'=>'twitterAuth','uses'=>'AuthController@getTwitterLogin'));
Route::get('gauth/{auth?}',array('as'=>'gauth','uses'=>'AuthController@getGoogleLogin'));

Route::post('newsletter/send', 'UserController@blastEmail');

Route::post('report/view', 'ReportNewProjectController@viewReport');

Route::get('submit-project/{alias}','HomeController@index');

Route::get('push-new-project','CreateProjectController@getPushNewProject');

Route::post('create-project-content/addreward','CreateProjectContentController@postAddContentReward');
Route::get('notification','HomeController@getNotification');
Route::get('payment/{status}','HomeController@getPayment');
Route::get('widgetShow/{alias}','WidgetController@showWidget');
Route::get('widgetMed/{alias}','WidgetController@showWidgetMed');
Route::get('WidgetSml/{alias}','WidgetController@showWidgetSml');
Route::get('widgetGen','WidgetController@showWidgetGen');
Route::get('widgetGenMed','WidgetController@showWidgetGenMed');
Route::get('widgetGenSml','WidgetController@showWidgetGenSml');
Route::get('getWidget','GetWidgetController@WidgetSelect');
Route::get('getWidgetProject','GetWidgetController@WidgetSelectProject');

Route::get('slide','SlideController@showSlider');
Route::get('slideEn','SlideController@showSliderEn');

Route::get('emailMessageNotif','EmailNotifController@showEmailNotif');
Route::get('homeVideo', 'HomeVideoController@showvideo');

//Route::get('home','HomeController@index');


