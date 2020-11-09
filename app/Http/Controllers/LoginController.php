<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function line_login()
    {
        $url = "https://access.line.me/oauth2/v2.1/authorize?response_type=code&client_id=1654563996&redirect_uri=http://127.0.0.1:8000/web/line_receive&state=Neo&scope=openid%20email%20profile";
        return redirect($url);
    }

    public function line_receive()
    {
        //取得Access Token
        $code = $_GET['code'];
        $header = array('Content-Type: application/x-www-form-urlencoded');
        $postData = http_build_query(['grant_type' => 'authorization_code', 'code' => $code, 'redirect_uri' => 'http://127.0.0.1:8000/web/line_receive', 'client_id' => '1654563996', 'client_secret' => '59e1baa23a620f0922a4583c2c0dcd44']);
        $ch = curl_init("https://api.line.me/oauth2/v2.1/token");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);

        //透過Access Token用GET取得使用者資料
        $url = "https://api.line.me/v2/profile";
        $header2 = array('Authorization: Bearer ' . $result['access_token']);
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $url);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $header2);
        $result2 = json_decode(curl_exec($ch2), true);

        $user = new User();
        $has_third_id = count(DB::table('users')->where('third_id', $result2['userId'])->get()->toArray());

        if ($has_third_id > 0) {
            $user->update(['third_id' => $result2['userId'], 'name' => $result2['displayName']]);
        } else {
            $user->create(['third_id' => $result2['userId'], 'name' => $result2['displayName']]);
        }
        session()->put('user', ['id' => $result2['userId'], 'name' => $result2['displayName'], 'picture' => $result2['pictureUrl']]);
        return redirect(route('index'));
    }

    public function facebook_login()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebook_receive()
    {
        $result = Socialite::driver('facebook')->user();
        print_r($result);
        $user = new User();
        $has_third_id = count(DB::table('users')->where('third_id', $result['id'])->get()->toArray());
        if ($has_third_id > 0) {
            $user->update(['third_id' => $result['id'], 'email' => $result['email'], 'name' => $result['name']]);
        } else {
            $user->create(['third_id' => $result['id'], 'email' => $result['email'], 'name' => $result['name']]);
        }
        session()->put('user', ['id' => $result['id'], 'email' => $result['email'], 'name' => $result['name'], 'picture' => $result->avatar]);
        return redirect(route('index'));
    }

    public function google_login()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_receive()
    {
        $result = Socialite::driver('google')->user();
        $user = new User();
        $has_third_id = count(DB::table('users')->where('third_id', $result['id'])->get()->toArray());

        if ($has_third_id > 0) {
            $user->update(['third_id' => $result['id'], 'email' => $result['email'], 'name' => $result['name']]);
        } else {
            $user->create(['third_id' => $result['id'], 'email' => $result['email'], 'name' => $result['name']]);
        }
        session()->put('user', ['id' => $result['id'], 'email' => $result['email'], 'name' => $result['name'], 'picture' => $result->avatar]);
        return redirect(route('index'));
    }
}
