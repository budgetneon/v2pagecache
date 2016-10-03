<?php
//
// Copyright (c) 2014 Kerry Schwab & BudgetNeon.com. All rights reserved.
// This program is free software; you can redistribute it and/or modify it
// under the terms of the the FreeBSD License .
// You may obtain a copy of the full license at:
//     http://www.freebsd.org/copyright/freebsd-license.html
//
//
?>
<?php
$_['heading_title'] = 'V2 Page Cache';
$_['text_module'] = 'Modules';
$_['text_installed'] = 'Page cache is now installed under Extensions -> Modules -> Page Cache';
$_['v2pc_return']='Return';
$_['v2pc_not_exist']='does not exist of is not a file';
$_['v2pc_not_readable']='is not readable (permissions)';
$_['v2pc_readable']='is readable';
$_['v2pc_not_writeable']='is not writeable (permissions)';
$_['v2pc_writeable']='is writeable';
$_['v2pc_php_compat']='supported (PHP 5.4 or greater)';
$_['v2pc_php_not_compat']='unsupported (PHP 5.4 or greater recommended)';
$_['v2pc_sapi_mod_php']='supported (pagecache tested with mod_php)';
$_['v2pc_sapi_fcgi']='supported (pagecache tested with fastcgi under PHP 5.4 or greater)';
$_['v2pc_sapi_fcgi_oldphp']='unsupported (known issues with fastcgi with PHP version < 5.4)';
$_['v2pc_sapi_litespeed']='supported (we work around broken http_response_code() in litespeed)';
$_['v2pc_sapi_not_tested']='unsupported (pagecache has not been tested with this SAPI)';
$_['v2pc_text_status']='Status';
$_['v2pc_only_2_3_supported']='This module is only for version 2.3 (or greater) of opencart';
$_['v2pc_err_topmarker']='Cannot find top marker in index.php';
$_['v2pc_err_bottommarker']='Cannot find bottom marker in index.php';
$_['v2pc_pagecache_disabled']='Pagecache is disabled in index.php';
$_['v2pc_pagecache_enabled']='Pagecache is enabled in index.php';
$_['v2pc_count_error']='Count of pagecache related lines is %s,should be %s. Edit %s  manually and fix!';
$_['v2pc_already_enabled']='Pagecache is already enabled';
$_['v2pc_enable_error']='Can\'t enable, status: ';
$_['v2pc_already_disabled']='Pagecache is already disabled';
$_['v2pc_disable_error']='Can\'t disable, status: ';
$_['v2pc_purged']='Purged %s files';
$_['v2pc_wait']='wait...';
$_['v2pc_label_compat']='Compatibility:';
$_['v2pc_label_status']='Status:';
$_['v2pc_header_cachestat']='Cached File Statistics';
$_['v2pc_td_cf']='Cached Files';
$_['v2pc_td_total']='Total # of Files';
$_['v2pc_td_space']='Space Used';
$_['v2pc_td_valid']='Valid';
$_['v2pc_td_expired']='Expired';
$_['v2pc_td_total']='Total';
$_['v2pc_btn_refresh']='Refresh Stats';
$_['v2pc_btn_purge']='Clear Entire Cache';
$_['v2pc_btn_purgeexp']='Clear Expired Files Only';
$_['v2pc_header_ops']='Operations';
$_['v2pc_header_settings']='Current Settings';
$_['v2pc_settings_note']='Note: Settings for reference only, changes must be made manually';
$_['v2pc_td_setting']='Setting';
$_['v2pc_td_value']='Value';
$_['v2pc_td_detail']='Detail';
$_['v2pc_expire_note']='expire time, in seconds';
$_['v2pc_lang_note']='default language';
$_['v2pc_currency_note']='default currency';
$_['v2pc_cachefolder_note']='the directory where the cache files are kept';
$_['v2pc_cachebydevice_note']='Caching by device...false means no per device cache files, otherwise, indicates method (mobiledetect or categorizr).';
$_['v2pc_addcomment_note']='Whether to add an html comment to the bottom of the cached file.';
$_['v2pc_wrapcomment_note']='Whether to wrap the html comment so it isn\'t stripped by an html minifier, like CloudFlare\'s.';
$_['v2pc_end_flush_note']='If true, we call ob_end_flush() in a loop before serving a cached page.  Improves performance, but creates issues in some environments';
$_['v2pc_skipurls_note']='A list of url patterns that should not be cached.';
$_['v2pc_enable_warn']='<b>Warning</b>: Enabling and disabling the cache modifies your main index.php file. <em>Have a backup copy of your main index.php for safety.</em><br><span>See <a target="_blank" href="http://github.com/budgetneon/v2pagecache">the documentation</a> for more info.</span>';
$_['v2pc_btn_disable']='Disable Cache';
$_['v2pc_btn_enable']='Enable Cache';
?>
