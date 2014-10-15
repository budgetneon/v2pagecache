<?php
//
// Copyright (c) 2014 Kerry Schwab & BudgetNeon.com. All rights reserved.
// This program is free software; you can redistribute it and/or modify it
// under the terms of the the FreeBSD License .
// You may obtain a copy of the full license at:
//     http://www.freebsd.org/copyright/freebsd-license.html
//
//
class V2PageCache {
    private $expire='14400'   ; // expire time, in seconds 14400 = 4 hours
    private $lang='en'        ; // default language for site
    private $currency='USD'   ; // default currency for site
    private $addcomment = true; // set to true to add a comment to the bottom
                                // of cached html pages with info+expire time
                                // only works where headers_list() works
    private $skip_urls= array(
        '#checkout/#',
        '#product/compare#',
        '#/captcha#',
        '#account/#',
        '#register/#'
    );

    private $cachefile=null;   // null specifically meaning "not known yet"
    private $oktocache=null;   // null specifically meaning "not known yet"

    // constructor
    public function V2PageCache() {
        // session initialization code verbatim 
        // from opencart's library/session.php
        if (!session_id()) {
            ini_set('session.use_only_cookies', 'On');
            ini_set('session.use_trans_sid', 'Off');
            ini_set('session.cookie_httponly', 'On');
            session_set_cookie_params(0, '/');
            session_start();
        }
        $this->cachefolder=DIR_CACHE. 'v2pagecache/';
        if (array_key_exists('language',$_SESSION)) {
            // only accept specific strings for $_SESSION['language']
            // (two small letters, optionally followed by - and more letters)
            if (preg_match('/^[a-z]{2}-*[a-zA-Z]*$/',$_SESSION['language'])) {
                $this->lang=$_SESSION['language'];
            }
        }
        if (array_key_exists('currency',$_SESSION)) {
            // only accept 3 consecutive A-Z for $_SESSION['language']
            if (preg_match('/^[A-Z]{3}$/',$_SESSION['currency'])) {
                $this->currency=$_SESSION['currency'];
            }
        }
        // store cacheability in a private variable
        $this->oktocache=$this->OkToCache();
    }
   
    public function Settings() {
        return array(
            'expire' => $this->expire,
            'lang'   => $this->lang,
            'currency' => $this->currency,
            'addcomment' => $this->addcomment,
            'cachefolder' => $this->cachefolder,
            'skip_urls'  => $this->skip_urls
        );
    }
  
    // null error handler to trap specific errors
    public function NullHandler($errno, $errstr, $errfile, $errline) {
        ;
    }

    //
    // returns either a sanitized version of the domainname associated
    // with this request, or false if the domainname is invalid or 
    // cannot be determined.
    //
    public function DomainName() {
        if (strlen($_SERVER['HTTP_HOST']) > 0) {
            $domain=$_SERVER['HTTP_HOST'];
        } elseif (strlen($_SERVER['SERVER_NAME']) > 0) {
            $domain=$_SERVER['HTTP_HOST'];
        } else {
            return false;
        }
        // handle the case of port name being in the domain, like 127.0.0.1:80
        $cpos=strrpos($domain,':');
        if ($cpos === false) {
            $port='';
        } else {
            $port='-' . substr($domain,$cpos+1);
            $domain=substr($domain,0,$cpos);
        }
        $domain = str_replace(':','-',$domain);
        // regex to match valid domain names
        $regex='/^([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])'.
          '(\.([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]{0,61}[a-zA-Z0-9]))*$/';
        if (!preg_match($regex,$domain)) {
            return false;
        }
        if (strlen($domain) > 255) {
            return false;
        }
        return $domain . $port;
    }

    //
    // returns true if the url being requested is something
    // we're allowed to cache.  We don't, for example, cache
    // https pages, or pages where the user is logged in, etc.
    public function OkToCache() {
        // don't retest if called more than once
        if ($this->oktocache != null) {
            return $this->oktocache;
        }
        // only cache GET requests
        if(!empty($_SERVER['REQUEST_METHOD']) &&
            $_SERVER['REQUEST_METHOD'] != 'GET') {
            $this->oktocache=false;
            return $this->oktocache;
        } 
        // don't cache secure pages
        if(!empty($_SERVER['HTTPS']) || 
            (array_key_exists('HTTPS', $_SERVER) && $_SERVER['HTTPS']=='on')) {
            $this->oktocache=false;
            return $this->oktocache;
        }
        // don't cache for logged in customers or affiliates
        if(!empty($_SESSION['customer_id']) ||
            !empty($_SESSION['affiliate_id'])) {
            $this->oktocache=false;
            return $this->oktocache;
        }  
        // don't cache if affiliate page, or cart has items in it
        if (!empty($_GET['affiliate']) || !empty($_SESSION['cart']))  {
            $this->oktocache=false;
            return $this->oktocache;
        } 
        // don't cache if we match one of the url patterns to skip
        foreach ($this->skip_urls as $urlpattern) {
            if (preg_match($urlpattern,$_SERVER['REQUEST_URI'])) {
                $this->oktocache=false;
                return $this->oktocache;
            }
        }
        // got here, so it must be okay to cache
        // note that while the page is "ok to cache"...
        // other problems may cause this page not to be cached. 
        // Like a 404 response for example.
        $this->oktocache=true;
        return $this->oktocache;
    }

    public function ServeFromCache() {
        if (! $this->OkToCache()) {
            return false;
        }
        $domain = $this->DomainName();
        if ($domain === false) {
            return false;
        }
        $this->domain=$domain;
        $url = http_build_query($_GET);
        $md5=md5($url);
        $subfolder=substr($md5,0,1).'/'.substr($md5,1,1).'/';
        $cacheFile = $this->cachefolder . $subfolder . $domain . '_' . 
            $this->lang . '_' . $this->currency . '_' . $md5 . '.cache';
        if (file_exists($cacheFile)) {
            if (time() - $this->expire < filemtime($cacheFile) ){
                // flush and disable the output buffer
                while(@ob_end_flush());
                readfile($cacheFile);
                return true;
            } else {
                // remove the stale cache file
                @unlink($cacheFile);
                $this->cachefile=$cacheFile;
                return false;
            }
        } else {
            $this->cachefile=$cacheFile;
            return false;
        }
    }

    public function IsHtml() {
        if (function_exists('headers_list')) {
            foreach (headers_list() as $header) {
                if (preg_match('#^content-type:\s*text/html#i',$header)) {
                    return true;
                }
            }
        }
        return false;
    }

    public function RedirectOutput($buffer) {
        if ($this->IsHtml() && $this->addcomment==true) {
            fwrite($this->outfp, $buffer .
                  "\n<!--cache host [" . htmlspecialchars($this->domain). 
                  '] uri ['.
                  htmlspecialchars($_SERVER['REQUEST_URI']) . 
                  "] (" . $this->lang . '/' . $this->currency . ") expires: ".
                  date("Y-m-d H:i:s e",time()+$this->expire).'-->'
            );
        } else {
            fwrite($this->outfp, $buffer);
        }
    }

    public function CachePage($response) {
        // if the http_response_code() function is available (php 5.4+),
        // then we will only cache pages that are "200 OK".
        //
        // This keeps us from caching, for example:
        //   - 5XX Errors that might be temporary
        //   - 404 Not Found
        if (function_exists('http_response_code')) {
            if (http_response_code() != 200) {
                return false;
            }
        }
        if ($this->cachefile != null) {
            $temp=$this->cachefile . '.lock';
            $pparts = pathinfo($temp);
            // make the directory path if it doesn't exist
            if (!is_dir($pparts['dirname'])) {
                mkdir($pparts['dirname'], 0755, true);
            }
            // get opencart to be quiet about fopen failures
            $ohandler=set_error_handler(array($this, 'NullHandler'));
            // prevent race conditions by opening first as a 
            // lockfile (via the 'x' flag to fopen), then renaming 
            // the file once we're done
            $fp=@fopen($temp,'x');
            set_error_handler($ohandler);
            if ($fp != false) {
                $this->outfp=$fp;
                ob_start(array($this,'RedirectOutput'));
                $response->setCompression(0);
                $response->output();
                $ohandler=set_error_handler(array($this, 'NullHandler'));
                while(@ob_end_flush());
                set_error_handler($ohandler);
                fclose($fp);
                rename($temp,$this->cachefile);
                return true;
            }  
            return false;
        } 
        return false;
    }
}
?>
