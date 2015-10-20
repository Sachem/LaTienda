<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Paypalpayment;
use Redirect;

class PaypalPaymentController extends Controller
{
     /**
      * object to authenticate the call.
      * @param object $_apiContext
      */
    private $_apiContext;
    
    
    /**
     * Set the ClientId and the ClientSecret.
     * @param
     *string $_ClientId
     *string $_ClientSecret
     */
    private $_ClientId = 'AZj2P44LF78B5mLTK0R3ls4s4ek16fSblvEQABFvHJsohmsFegAm1XFo_AEc2FW74YYSKVhFAA1RJ0GA';
    private $_ClientSecret='EFNxIGROZ0Y7_yBmoZn3JJcZrYiUrdRL1JRYQIjHLUSYNrP0K23uIYS4rVRwV7ZDn17dxi42Vou14ubr';


    public function __construct()
    {
      // $this->_cred= Paypalpayment::OAuthTokenCredential();
      
              // ### Api Context
        // Pass in a `ApiContext` object to authenticate
        // the call. You can also send a unique request id
        // (that ensures idempotency). The SDK generates
        // a request id if you do not pass one explicitly.

        $this->_apiContext = Paypalpayment::ApiContext($this->_ClientId, $this->_ClientSecret);

        // Uncomment this step if you want to use per request
        // dynamic configuration instead of using sdk_config.ini

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => __DIR__.'/../PayPal.log',
            'log.LogLevel' => 'FINE'
        ));
    }
    
    /**
     * 
     * @param int $order_id 
     */
    public function getCheckout($order_id) 
    {
      $order = \App\CatalogOrder::with('items.product', 'payment', 'delivery_address', 'user')->find($order_id);

      $paypal_items = [];
      foreach ($order->items as $order_item)
      {
        $paypal_item = Paypalpayment::item();
        $paypal_item->setName($order_item->product_name)
                ->setDescription('#' . $order_item->id)
                ->setCurrency('GBP')
                ->setQuantity($order_item->quantity)
                ->setPrice($order_item->product_price);
        
        $paypal_items[] = $paypal_item;
      }


      $itemList = Paypalpayment::itemList();
      $itemList->setItems($paypal_items);
      
      $payer = Paypalpayment::Payer();
      $payer->setPaymentMethod('paypal');

      $amount = Paypalpayment:: Amount();
      $amount->setCurrency('GBP');
      $amount->setTotal($order->payment->total); 

      $transaction = Paypalpayment::Transaction();
      $transaction->setAmount($amount);
      $transaction->setItemList($itemList);
      $transaction->setDescription('Secret Luxury Order #' . $order->id);

      $redirectUrls = Paypalpayment:: RedirectUrls();
      $redirectUrls->setReturnUrl(action('PaypalPaymentController@getDone'));
      $redirectUrls->setCancelUrl(action('PaypalPaymentController@getCancel'));

      $payment = Paypalpayment::Payment();
      $payment->setIntent('sale');
      $payment->setPayer($payer);
      $payment->setRedirectUrls($redirectUrls);
      $payment->setTransactions(array($transaction));

      //dd([$payer, $amount, $transaction, $redirectUrls, $payment]);
      
      try {
          $response = $payment->create($this->_apiContext);
      } catch (PayPal\Exception\PayPalConnectionException $ex) {
          echo $ex->getCode(); // Prints the Error Code
          echo $ex->getData(); // Prints the detailed error message 
          die($ex);
      } catch (Exception $ex) {
          die($ex);
      }
      
      $order_payment = \App\Payment::find($order->payment_id);
      // this is Paypal's payment id
      $order_payment->transaction_id = $response->id;
      $order_payment->save();
      
      $redirectUrl = $response->links[1]->href;

      return Redirect::to( $redirectUrl );
    }
    
    public function getDone(Request $request)
    {
      
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');


        $payment = Paypalpayment::getById($id, $this->_apiContext);

        $paymentExecution = Paypalpayment::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        
        
        try {
            $executePayment = $payment->execute($paymentExecution, $this->_apiContext);
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode(); // Prints the Error Code
            echo $ex->getData(); // Prints the detailed error message 
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }

        
        // write to database that payment complete
        \App\Payment::where('transaction_id', $id)->update(['status' => 'complete']);
        
        // TODO: send e-mails
        

        // Thank the user for the purchase
        return view('catalog.checkout.checkout_step_3');
    }

    public function getCancel()
    {
        // Curse and humiliate the user for cancelling this most sacred payment (yours)
        return view('catalog.checkout.cancel');
    }
     
}
