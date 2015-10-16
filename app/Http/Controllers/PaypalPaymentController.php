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
      
   
      // TODO: FINISH read order data from database and create payment
      // TODO: FINISH read order data from database and create payment
      // TODO: FINISH read order data from database and create payment
      // TODO: FINISH read order data from database and create payment
      
      $payer = Paypalpayment::Payer();
      $payer->setPaymentMethod('paypal');

      $amount = Paypalpayment:: Amount();
      $amount->setCurrency('GBP');
      $amount->setTotal($order->payment->total); // This is the simple way,
      // you can alternatively describe everything in the order separately;
      // Reference the PayPal PHP REST SDK for details.

      $transaction = Paypalpayment::Transaction();
      $transaction->setAmount($amount);
      $transaction->setDescription($order->items[0]->product_name);

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
    
    public function store()
    {
        // ### Address
        // Base Address object used as shipping or billing
        // address in a payment. [Optional]
        $addr= Paypalpayment::address();
        $addr->setLine1("3909 Witmer Road");
        $addr->setLine2("Niagara Falls");
        $addr->setCity("Niagara Falls");
        $addr->setState("NY");
        $addr->setPostalCode("14305");
        $addr->setCountryCode("US");
        $addr->setPhone("716-298-1822");

        // ### CreditCard
        $card = Paypalpayment::creditCard();
        $card->setType("visa")
            ->setNumber("4758411877817150")
            ->setExpireMonth("05")
            ->setExpireYear("2019")
            ->setCvv2("456")
            ->setFirstName("Joe")
            ->setLastName("Shopper");

        // ### FundingInstrument
        // A resource representing a Payer's funding instrument.
        // Use a Payer ID (A unique identifier of the payer generated
        // and provided by the facilitator. This is required when
        // creating or using a tokenized funding instrument)
        // and the `CreditCardDetails`
        $fi = Paypalpayment::fundingInstrument();
        $fi->setCreditCard($card);

        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("credit_card")
            ->setFundingInstruments(array($fi));

        $item1 = Paypalpayment::item();
        $item1->setName('Ground Coffee 40 oz')
                ->setDescription('Ground Coffee 40 oz')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setTax(0.3)
                ->setPrice(7.50);

        $item2 = Paypalpayment::item();
        $item2->setName('Granola bars')
                ->setDescription('Granola Bars with Peanuts')
                ->setCurrency('USD')
                ->setQuantity(5)
                ->setTax(0.2)
                ->setPrice(2);


        $itemList = Paypalpayment::itemList();
        $itemList->setItems(array($item1,$item2));


        $details = Paypalpayment::details();
        $details->setShipping("1.2")
                ->setTax("1.3")
                //total of items prices
                ->setSubtotal("17.5");

        //Payment Amount
        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")
                // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
                ->setTotal("20")
                ->setDetails($details);

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types

        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'

        $payment = Paypalpayment::payment();

        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setTransactions(array($transaction));

        
        try {
            // ### Create Payment
            // Create a payment by posting to the APIService
            // using a valid ApiContext
            // The return object contains the status;
            $payment->create($this->_apiContext);
        } catch (\PPConnectionException $ex) {
            return  "Exception: " . $ex->getMessage() . PHP_EOL;
            exit(1);
        }

        dd($payment);
    } 
}
