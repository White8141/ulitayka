<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use ReCaptcha\ReCaptcha;
use ReCaptcha\RequestMethod\CurlPost;

class PagesController extends Controller
{

    public function index()
    {
        return view('sections/index');
    }

    //раздел Контакты
    public function contacts()
    {
        return view('sections/contacts/contacts', [
            'tooltip' => ''
        ]);
    }
    public function order(Request $request)
    {
        //dd($request->all());

        if ($request->has('g-recaptcha-response') && $request->input('g-recaptcha-response') != null) {

            $recaptcha = new ReCaptcha($_ENV['RECAPTCHA_SECRET'], new CurlPost());
            $response = $recaptcha->verify($request->input('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);
            
            if ($response->isSuccess()) {
                $order = new Order;
                $order->name = $request->input('main_name');
                $order->phone = $request->input('main_tel');
                $order->email = $request->input('main_email');
                $order->comments = $request->input('main_comment');
                $order->save();

                //dd($order);
                $subject = "Новый заказ";
                $msg = "Заказан звонок от абонента ".$order->name.", номер телефона: ".$order->phone.", e-mail: ".$order->email;
                if ($order->comments != '') $msg = $msg.", комментарии к заказу: ".$order->comments;
                //mail ("info@ulitayka.ru", $subject, $msg, "From: http://ulitayka.ru/");
                mail ("white8141@yandex.ru", $subject, $msg, "From: http://ulitayka.ru/");

                $token = $_ENV['TELEGRAMM_TOKEN'];
                $chatid = $_ENV['TELEGRAM_CHAT_ID'];
                $mess = 'Пользователь '.$order->name.' заказал звонок на номер '.$order->phone;
                if ($order->comments != '') $mess = $mess.", комментарии к заказу: ".$order->comments;
                $tbot = file_get_contents("https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chatid."&text=".$mess);
                //dd($tbot);

                return view('sections/contacts/contacts', [
                    'tooltip' => 'Заказ принят'
                ]);
            } else {
                die(403);
            }
        } else {
            die(403);
        }


    }
    public function legend()
    {
        return view('sections/legend');
    }

    //разлел Электронный полис
    public function how_it_works()
    {
        return view('sections/policy/how_it_works');
    }
    public function included_my_insurance()
    {
        return view('sections/policy/included_my_insurance');
    }
    public function what_your_insurance()
    {
        return view('sections/policy/what_your_insurance');
    }
    public function what_e_policy()
    {
        return view('sections/policy/what_e_policy');
    }
    public function what_data()
    {
        return view('sections/policy/what_data');
    }
    public function how_get_policy()
    {
        return view('sections/policy/how_get_policy');
    }
    public function whether_print_policy()
    {
        return view('sections/policy/whether_print_policy');
    }

    //раздел Страховой случай
    public function ins_moment()
    {
        return view('sections/case/ins_moment');
    }
    public function ins_moment_full()
    {
        return view('sections/case/ins_moment_full');
    }
    public function how_get_paid()
    {
        return view('sections/case/how_get_paid');
    }
    public function how_to_avoid()
    {
        return view('sections/case/how_to_avoid');
    }
    
    //раздел Путешественникам
    public function ins_need()
    {
        return view('sections/travel/ins_need');
    }
    public function ins_for_visa()
    {
        return view('sections/travel/ins_for_visa');
    }
    public function shengen()
    {
        return view('sections/travel/shengen');
    }
    public function ins_info()
    {
        return view('sections/travel/ins_info');
    }
    //виды страховок
    public function single_ins()
    {
        return view('sections/travel/type/single_ins');
    }
    public function group_ins()
    {
        return view('sections/travel/type/group_ins');
    }
    public function med_ins()
    {
        return view('sections/travel/type/med_ins');
    }
    public function comp_ins()
    {
        return view('sections/travel/type/comp_ins');
    }
    public function abort()
    {
        return view('sections/travel/type/abort');
    }
    public function fransh_ins()
    {
        return view('sections/travel/type/fransh_ins');
    }

    //страны
    public function finland()
    {
        return view('countries/finland_info');
    }
    public function australia()
    {
        return view('countries/australia_info');
    }
    public function egypt()
    {
        return view('countries/egypt_info');
    }
    public function england()
    {
        return view('countries/england_info');
    }
    public function italy()
    {
        return view('countries/italy_info');
    }
    public function norway()
    {
        return view('countries/norway_info');
    }
    public function thailand()
    {
        return view('countries/thailand_info');
    }
    public function georgia()
    {
        return view('countries/georgia_info');
    }
    public function usa()
    {
        return view('countries/usa_info');
    }
    public function israel()
    {
        return view('countries/israel_info');
    }
    public function montenegro()
    {
        return view('countries/montenegro_info');
    }
    public function germany()
    {
        return view('countries/germany_info');
    }
}
