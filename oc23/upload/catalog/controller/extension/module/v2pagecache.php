<?php
class ControllerExtensionModuleV2pagecache extends Controller {
    public function index() {
       ;
    }
    public function set_cookie() {
        $fp=fopen("/tmp/sclog.txt","a");
        fwrite($fp,"event called\n");
        $cart=$this->registry->get('cart');
        global $v2pcresponse;
        $v2pcresponse=$this->registry->get('response');
        //$rdump=print_r($this->registry,1);
        //$cdump=print_r($cart,1);
        //fwrite($fp,"cdump [$cdump]\n");
        if ($cart->hasProducts()) {
            $_SESSION['carthasitems']=1;
        } else {
            unset($_SESSION['carthasitems']);
        }            
        fclose($fp);
    }
}

