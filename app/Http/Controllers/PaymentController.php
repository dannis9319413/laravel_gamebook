<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpayAllInOne;
use OpayEncryptType;
use Exception;
use OpayPaymentMethod;
// Used to process plans
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class PaymentController extends Controller
{
    // Create a new instance with our paypal credentials
    public function __construct()
    {
        // Detect if we are running in live mode or sandbox
        if (config('paypal.settings.mode') == 'live') {
            $this->client_id = config('paypal.live_client_id');
            $this->secret = config('paypal.live_secret');
        } else {
            $this->client_id = config('paypal.sandbox_client_id');
            $this->secret = config('paypal.sandbox_secret');
        }

        // Set the Paypal API Context/Credentials
        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->client_id, $this->secret));
        $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function line_pay_reserve(Request $request)
    {
        $order = DB::table('orders')->where('id', session('order'))->get()->toArray();

        $header = array(
            'X-LINE-ChannelId: 1654548376', 'X-LINE-ChannelSecret: 167f707dbc1cc481b7bb67dbef56fe2a', 'Content-Type: application/json; charset=UTF-8'
        );

        $postData = array(
            'productName' => $order[0]->order_no, 'productImageUrl' => 'https://dewey.tailorbrands.com/production/brand_version_mockup_image/106/3079838106_62f50fa4-18a8-4f0d-a429-1cc7843b7492.png?cb=1591113312', 'amount' => $order[0]->total + $order[0]->shipping, 'currency' => "TWD", 'confirmUrl' => "http://127.0.0.1:8000/web/line_pay/confirm", 'orderId' => $request->id
        );

        $ch = curl_init("https://sandbox-api-pay.line.me/v2/payments/request");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //*curl_setopt($ch, CURLOPT_SSLVERSION, 'CURL_SSLVERSION_TLSv1');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);

        header("Location: " . $result['info']['paymentUrl']['web']);
        exit();
    }

    public function line_pay_confirm()
    {
        $order = DB::table('orders')->where('id', session('order'))->get()->toArray();

        $header = array(
            'X-LINE-ChannelId: 1654548376', 'X-LINE-ChannelSecret: 167f707dbc1cc481b7bb67dbef56fe2a', 'Content-Type: application/json; charset=UTF-8'
        );
        $confirmId = $_GET['transactionId'];

        $postData = array('amount' => $order[0]->total + $order[0]->shipping, 'currency' => "TWD");
        $ch = curl_init("https://sandbox-api-pay.line.me/v2/payments/" . $confirmId . "/confirm");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //*curl_setopt($ch, CURLOPT_SSLVERSION, 'CURL_SSLVERSION_TLSv1');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);

        DB::table('orders')->where('id', session('order'))->update(['status' => 1]);

        if ($result['returnCode'] == 0000) {
            return redirect(route('web.user.orders'))->with('payment_success', '付款成功');
        } else {
            return redirect(route('web.user.orders'))->with('payment_error', '付款失敗');
        }
    }

    function opay_request(Request $request)
    {
        $order = DB::table('orders')->where('id', $request->id)->get()->toArray();

        $order_details = DB::table('order_details')->where('order_id', $order[0]->id)->get()->toArray();

        //載入SDK(路徑可依系統規劃自行調整)
        // include('Opay.Payment.Integration.php');
        try {
            $obj = new OpayAllInOne();

            //服務參數
            $obj->ServiceURL  = "https://payment-stage.opay.tw/Cashier/AioCheckOut/V5";         //服務位置
            $obj->HashKey     = '5294y06JbISpM5x9';                                            //測試用Hashkey，請自行帶入OPay提供的HashKey
            $obj->HashIV      = 'v77hoKGq4kWxNNIS';                                            //測試用HashIV，請自行帶入OPay提供的HashIV
            $obj->MerchantID  = '2000132';                                                      //測試用MerchantID，請自行帶入OPay提供的MerchantID
            $obj->EncryptType = OpayEncryptType::ENC_SHA256;                                    //CheckMacValue加密類型，請固定填入1，使用SHA256加密

            //基本參數(請依系統規劃自行調整)
            $MerchantTradeNo = "Test" . time();

            $obj->Send['ReturnURL']         = 'http://localhost:8000/web/opay_receive'; //付款完成通知回傳的網址
            $obj->Send['MerchantTradeNo']   = $order[0]->order_no;               //訂單編號
            $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');             //交易時間
            $obj->Send['TotalAmount']       = $order[0]->total + $order[0]->shipping;    //交易金額
            $obj->Send['TradeDesc']         = $order[0]->order_no;              //交易描述
            $obj->Send['ChoosePayment']     = OpayPaymentMethod::ALL;    //付款方式
            $obj->Send['NeedExtraPaidInfo'] = 'Y';

            //訂單的商品資料
            for ($i = 0; $i < count($order_details); $i++) {
                array_push($obj->Send['Items'], array(
                    'Name' => $order_details[$i]->name, 'Price' => $order_details[$i]->price,
                    'Currency' => "元", 'Quantity' => $order_details[$i]->quantity, 'URL' => "dedwed"
                ));
            }
            //產生訂單(auto submit至OPay)
            $html = $obj->CheckOut();
            echo $html;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function opay_receive(Request $request)
    {

        //載入SDK(路徑可依系統規劃自行調整)
        // include('Opay.Payment.Integration.php');
        try {

            $obj = new OpayAllInOne();

            /* 服務參數 */
            $obj->HashKey     = '5294y06JbISpM5x9';
            $obj->HashIV      =  'v77hoKGq4kWxNNIS';
            $obj->MerchantID  = '2000132';
            $obj->EncryptType = OpayEncryptType::ENC_SHA256;

            /* 取得回傳參數 */
            $arFeedback = $obj->CheckOutFeedback();

            // 參數寫入檔案
            if (true) {
                $sLog_Path  = __DIR__ . '/sample_payment_return.log'; // LOG路徑
                $sLog = '+++++++++++++++++++++++++++++++++++++++ 接收回傳參數 ' . date('Y-m-d H:i:s') . ' ++++++++++++++++++++++++++++++++++++++++++++' . "\n";
                $fp = fopen($sLog_Path, "a+");
                fputs($fp, $sLog);
                fclose($fp);

                $sLog_File =  print_r($arFeedback, true) . "\n";
                $fp = fopen($sLog_Path, "a+");
                fputs($fp, $sLog_File);
                fclose($fp);
            }

            echo '1|OK';

            $order_no = $request['MerchantTradeNo'];

            DB::table('orders')->where('order_no', $order_no)->update(['status' => 1]);
        } catch (Exception $e) {
            if (true) {
                $sLog_Path  = __DIR__ . '/sample_payment_return.log'; // LOG路徑
                $sLog = '+++++++++++++++++++++++++++++++++++++++ 接收回傳參數(ERROR) ' . date('Y-m-d H:i:s') . ' ++++++++++++++++++++++++++++++++++++++++++++' . "\n";
                $fp = fopen($sLog_Path, "a+");
                fputs($fp, $sLog);
                fclose($fp);

                $sLog_File =  $e->getMessage() . "\n";
                $fp = fopen($sLog_Path, "a+");
                fputs($fp, $sLog_File);
                fclose($fp);
            }
        }
    }

    public function create_plan()
    {
        // Create a new billing plan
        $plan = new Plan();
        $plan->setName('App Name Monthly Billing')
            ->setDescription('Monthly Subscription to the App Name')
            ->setType('infinite');

        // Set billing plan definitions
        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName('Regular Payments')
            ->setType('REGULAR')
            ->setFrequency('Month')
            ->setFrequencyInterval('1')
            ->setCycles('0')
            ->setAmount(new Currency(array('value' => 9, 'currency' => 'USD')));

        // Set merchant preferences
        $merchantPreferences = new MerchantPreferences();
        $merchantPreferences->setReturnUrl('https://website.dev/subscribe/paypal/return')
            ->setCancelUrl('https://website.dev/subscribe/paypal/return')
            ->setAutoBillAmount('yes')
            ->setInitialFailAmountAction('CONTINUE')
            ->setMaxFailAttempts('0');

        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);

        //create the plan
        try {
            $createdPlan = $plan->create($this->apiContext);

            try {
                $patch = new Patch();
                $value = new PayPalModel('{"state":"ACTIVE"}');
                $patch->setOp('replace')
                    ->setPath('/')
                    ->setValue($value);
                $patchRequest = new PatchRequest();
                $patchRequest->addPatch($patch);
                $createdPlan->update($patchRequest, $this->apiContext);
                $plan = Plan::get($createdPlan->getId(), $this->apiContext);

                // Output plan id
                echo 'Plan ID:' . $plan->getId();
            } catch (PayPal\Exception\PayPalConnectionException $ex) {
                echo $ex->getCode();
                echo $ex->getData();
                die($ex);
            } catch (Exception $ex) {
                die($ex);
            }
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }
    }
}
