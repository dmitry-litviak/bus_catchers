PayPal IPN module for Kohana
=============================

##What is PayPal IPN and how it works
To learn about PayPal Instant Payment Notification please check out [it's official page][1], and you can also read the [IPN guide][2] if you want to fully understand the process.

###In short
If you want to sell something and be paid using PayPal, the simplest way is to use [PayPal Payments Standard][3].

####This is how it works:<br><br>

- Your website posts a form to PayPal with all the payment related values. I give you a concrete example, how this form looks like a little bit later.
- The user is now on the PayPal Payments site, and he uses his PayPal account, or credit card to pay.
- PayPal will send a notification to your server with all the payment related variables in the background.
- Your server will send all these variables back to PayPal.
- PayPal will send back an one word message to your server: "VERIFIED" or "INVALID".
- If the payment is "VERIFIED" you will process the payment.

**NOTE**: PayPal will send notifications not only when a payment is completed, but also when a payment was reversed, refunded, or if a payment is pending, etc.
You can check the `payment_status` to see, what this notification is about (in this Kohana module you can use the `get_payment_status()` method).
You should inspect the code of the module, it is well commented, and you will fully understand how it works, without too much explanation.

####So what you need to start:<br><br>

- You will need a [PayPal account][4] (of course).
- Get a merchant account (you only have to fill a simple form, it take only one minute).
- You don't want to test your web application with real money, so sign up for [PayPal sandbox][5].

##Let's implement it
Let's start with creating a `payments` table in your database.
You have to store the payments you are notified about, at least their transaction id. Why? Because it is possible that PayPal will send more notifications with the same transaction id, and you don't want to process twice the same transaction.

So here is a table, you should create:

    CREATE TABLE `payments` (
    `payment_id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
    `transaction_id` VARCHAR(64) NOT NULL,
    `parent_transaction_id` VARCHAR(64) NOT NULL,
    `payment_status` VARCHAR(32) NOT NULL,
    `gross` DECIMAL(10,2) NOT NULL,
    `currency` VARCHAR(3) NOT NULL,
    `payer_id` VARCHAR(64) NOT NULL,
    `payer_email` VARCHAR(64) NOT NULL,
    `payer_name` VARCHAR(64) NOT NULL,
    `payment_date` DATETIME NOT NULL,
    `info` TEXT NOT NULL,
    PRIMARY KEY (`payment_id`),
    INDEX `transaction_id` (`transaction_id`),
    INDEX `payer_email` (`payer_email`),
    INDEX `parent_transaction_id` (`parent_transaction_id`)
    )
    COLLATE='utf8_general_ci'
    ENGINE=InnoDB;

Saving the payments to the table is made with the `save_payment()` method. However this method is already called in the `Kohana_Controller_PayPal_IPN` controller, which controller you will extend.

Implementing PayPal IPN with this module is more than easy. After you cloned this repo to the `modules` directory, enabled the module in `bootstrap.php`, and created the `payment` table, you only need to create a controller in your `application/classes/Controller/` folder.

Here is how it should look like:

    class Controller_Ipn extends Kohana_Controller_PayPal_IPN {
        public $expected_receiver_email = 'seller@paypalsandbox.com';
    }


The `$expected_receiver_email` is the email address to which you expects the payments. I say again, you should inspect the code, to fully understand how it works. When you go live, you change this to your PayPal Primary Email.

In your controller you can override the `_process_xxx` methods, to process different kind of payments based on their `payment_status`. See controller's code.

That's it :)

Now your IPN listener controller is accesible at: *http://www.yoursite.com/ipn*.

Let's register your IPN listener! Go to PayPal -> Profile -> My selling tools -> Instant payment notifications -> Notification Url.

**Note!** If you are testing with sandbox, you have to register your sandbox IPN listener too. For this, login in PayPal Sandbox, choose a test user (a seller) and click the "Enter Sandbox Test Site". Log in with the test user, and go to: PayPal -> Profile -> My selling tools -> Instant payment notifications -> Notification Url and register your listener.

##Let's test it
You can test your listener 2 ways:

- The [sandbox test tool][6].
- Or, you can create a payment form:

        <form name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr"
        method="post">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="YOUR SANDBOX SELLER EMAIL">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="item_name" value="Digital Download">
        <input type="hidden" name="amount" value="9.99">
        <input type="hidden" name="return" value="THIS URL">
        <input type="hidden" name="notify_url" value="THE URL TO YOUR ipn.php SCRIPT">
        <input type="image" src="http://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
        </form>

As you see you can specify the notify url also in the form, but I don't think it is a good idea, for security reasons.

If you want to go live, you should use `action=https://www.paypal.com/cgi-bin/webscr` instead of the sandbox url in the form.

[1]:https://www.paypal.com/cgi-bin/webscr?cmd=p/acc/ipn-info-outside
[2]:https://www.x.com/sites/default/files/ipnguide.pdf
[3]:https://www.paypal.com/webapps/mpp/paypal-payments-standard
[4]:https://www.paypal.com
[5]:https://developer.paypal.com/
[6]:https://developer.paypal.com/cgi-bin/devscr?cmd=_ipn-link-session
