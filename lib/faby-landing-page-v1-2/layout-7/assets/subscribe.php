<?php

require_once 'MailChimp.php';
use \DrewM\MailChimp\MailChimp;

// Email address verification
function isEmail($email) { return filter_var($email, FILTER_VALIDATE_EMAIL); }

 
if($_POST) {
 
    $mailchimp_api_key = 'YOUR-API-KEY'; // enter your MailChimp API Key
	// ****
	$mailchimp_list_id = 'YOUR-LIST-ID'; // enter your MailChimp List ID
	// ****
 
	$subscriber_firstname    =    addslashes( trim( $_POST['subscribe-firstname'] ) );
	$subscriber_lastname     =    addslashes( trim( $_POST['subscribe-lastname'] ) );
    $subscriber_email        =    addslashes( trim( $_POST['subscribe-email'] ) );
    
    $array = array('firstnameMsg' => '', 
    		       'lastnameMsg' => '', 
    		       'emailMsg' => '',
    		       'mailchimpErrorMsg' => '',
    		       'successMsg' => ''
                  );
 
    if( $subscriber_firstname == '' )  { $array['firstnameMsg'] = 'Empty first name! '; }
    if( $subscriber_lastname == '' )   { $array['lastnameMsg'] = 'Empty last name! '; }
    if( !isEmail($subscriber_email) )  { $array['emailMsg'] = 'Invalid email address!'; }
    
    if( $subscriber_firstname != '' && $subscriber_lastname != '' && isEmail($subscriber_email) ) {
        
        $MailChimp = new MailChimp($mailchimp_api_key);
        
        $result = $MailChimp->post("lists/$mailchimp_list_id/members", [
        		'email_address' => $subscriber_email,
        		'status'        => 'pending',
        		'merge_fields' => ['FNAME' => $subscriber_firstname, 'LNAME' => $subscriber_lastname],
        ]);
        
        if($result == false) {
            $array['mailchimpErrorMsg'] = 'An error occurred! Please try again later.';
        }
        else {
            $array['successMsg'] = 'Thanks for your subscription! We sent you a confirmation email.';
        }
        
    }
    
    echo json_encode($array);
 
}
 
?>