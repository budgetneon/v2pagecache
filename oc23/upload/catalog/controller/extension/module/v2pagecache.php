<?php
class ControllerExtensionModuleV2pagecache extends Controller {
    public function index() {
       ;
    }
    public function set_cookie() {
        $cart=$this->registry->get('cart');
        global $v2pcresponse;
        $v2pcresponse=$this->registry->get('response');
        if ($cart->hasProducts()) {
            $_SESSION['carthasitems']=1;
        } else {
            unset($_SESSION['carthasitems']);
        }            
    }
}
