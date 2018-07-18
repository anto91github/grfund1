<?php

class AuthController extends \BaseController
{
    function autoSignin($user)
    {
        if(is_null($user)){
          return Redirect::to('user/login')
                ->with('message', SiteHelpers::alert('error','You have not registered yet '))
                ->withInput();
        } else{

            Auth::login($user);
            if(Auth::check())
            {
                $row = User::find(Auth::user()->id); 

                if($row->active =='0')
                {
                    // inactive 
                    Auth::logout();
                    return Redirect::to('user/login')->with('message', SiteHelpers::alert('error','Your Account is not active'));

                } else if($row->active=='2')
                {
                    // BLocked users
                    Auth::logout();
                    return Redirect::to('user/login')->with('message', SiteHelpers::alert('error','Your Account is BLocked'));
                } else {
                    Session::put('uid', $row->id);
                    Session::put('gid', $row->group_id);
                    Session::put('eid', $row->group_email);
                    Session::put('fid', $row->first_name.' '. $row->last_name); 
                    if(CNF_FRONT =='false') :
                        return Redirect::to('config/dashboard');                        
                    else :
                        return Redirect::to('');
                    endif;             
                    
                                        
                }
                
                
            }
        }

    }

    public function getTwitterLogin($auth=NULL)
    {
        if ($auth == 'auth')
        {
            Hybrid_Endpoint::process();
            return;
        }
        try
        {
            $oauth = new Hybrid_Auth(app_path(). '/config/twitterAuth.php');
            $provider = $oauth->authenticate('Twitter');
            $profile = $provider->getUserProfile();
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }

        return var_dump($profile).'<a href="logout">Log Out</a>';

    }    

    //this is the code for facebook Login
    public function getFacebookLogin($auth=NULL)
    {
        if ($auth == 'auth')
        {
            try
            {
                Hybrid_Endpoint::process();
            }
            catch (Exception $e)
            {
                return Redirect::to('fbauth');
            }
            return;
        }

        $oauth = new Hybrid_Auth(app_path(). '/config/fb_auth.php');        
        $provider = $oauth->authenticate('Facebook');        
        $profile = $provider->getUserProfile();

        
        $destinationPath = "uploads/users/".$profile->identifier.".jpg";  
       
        $myfile = fopen("uploads/users/".$profile->identifier.".jpg", "w");
        fclose($myfile);

        $image_profile = file_get_contents($profile->photoURL);
        file_put_contents($destinationPath, $image_profile);

        
        $user =  User::where('email','=',$profile->email)->first();
        if($user == null)
        {
        $code = rand(10000,10000000);
            
            $authen = new User;
            $authen->first_name = $profile->firstName;
            $authen->last_name = $profile->lastName;
            $authen->avatar = $profile->identifier.".jpg"; 
            $authen->email = $profile->email;            
            $authen->activation = $code;
            $authen->group_id = 3;
            $authen->password = Hash::make('password');
            $authen->active = '1';
            $authen->save();

            $user =  User::where('email','=',$profile->email)->first();
        }
        return self::autoSignin($user);

        //return var_dump($profile).'<a href="logout">Log Out</a>';
        //return var_dump($profile).'<a href="'.URL::to('user/logout').'">Log Out</a>';
    }

    //this is the method that will handle the Google Login
    public function getGoogleLogin($auth=NULL)
    {
        if ($auth == 'auth')
        {
             Hybrid_Endpoint::process();

        }
        try {
            $oauth = new Hybrid_Auth(app_path() . '/config/google_auth.php');
            $provider = $oauth->authenticate('google');
            $profile = $provider->getUserProfile();

        $destinationPath = "uploads/users/".$profile->identifier.".jpg"; 
       
        $myfile = fopen("uploads/users/".$profile->identifier.".jpg", "w");
        fclose($myfile);

        $image_profile = file_get_contents($profile->photoURL);
        file_put_contents($destinationPath, $image_profile);

             $user =  User::where('email','=',$profile->email)->first();
            if($user == null)
            {
            $code = rand(10000,10000000);
            
            $authen = new User;
            $authen->first_name = $profile->firstName;
            $authen->last_name = $profile->lastName;
            $authen->avatar = $profile->identifier.".jpg"; 
            $authen->email = $profile->email;
            $authen->activation = $code;
            $authen->group_id = 3;
            $authen->password = Hash::make('password');
            $authen->active = '1';
            $authen->save();

            $user =  User::where('email','=',$profile->email)->first();
            }
             return self::autoSignin($user);
        }
        catch(exception $e)
        {
            return $e->getMessage();
        }

        //return $profile->email.'<a href="logout">Log Out</a>';             

    }


    public function getLoggedOut()
    {
        // $hauth = new Hybrid_Auth(app_path() . '/config/twitterAuth.php');
        // $hauth = new Hybrid_Auth(app_path() . '/config/fb_auth.php');
        //You can use any of the one provider to get the variable, I am using google
        //this is important to do, as it clears out the cookie

        $fauth= new Hybrid_auth(app_path().'/config/fb_auth.php');
        $fauth->logoutAllProviders();

        $hauth=new Hybrid_auth(app_path().'/config/google_auth.php');
        $hauth->logoutAllProviders();
        //return View::make('login');

    }


}
