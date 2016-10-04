<?php
//
// Copyright (c) 2014 Kerry Schwab & BudgetNeon.com. All rights reserved.
// This program is free software; you can redistribute it and/or modify it
// under the terms of the the FreeBSD License .
// You may obtain a copy of the full license at:
//     http://www.freebsd.org/copyright/freebsd-license.html
//
//
// Перевод Slait Ruweb24@gmail.com
?>
<?php
$_['heading_title'] = 'V2 Кэш страниц';
$_['text_module'] = 'Модули';
$_['text_installed'] = 'Модуль установлен перейдите в Модули -> Модули -> V2 Кэш страниц';
$_['v2pc_return']='Вернуться';
$_['v2pc_not_exist']='Не является файлом';
$_['v2pc_not_readable']='Нет доступа для чтения файлов (разрешений)';
$_['v2pc_readable']='Доступен для чтения';
$_['v2pc_not_writeable']='Невозможно записать (нет прав)';
$_['v2pc_writeable']='Доступен для записи';
$_['v2pc_php_compat']='Поддерживается (PHP 5.4 или выше)';
$_['v2pc_php_not_compat']='Не поддерживается (рекомендуется PHP 5.4 или выше)';
$_['v2pc_sapi_mod_php']='Поддерживается (модуль проверен с mod_php)';
$_['v2pc_sapi_fcgi']='Поддерживается (модуль проверен с FastCGI под PHP 5.4 или более новые версии)';
$_['v2pc_sapi_fcgi_oldphp']='Не поддерживается (проблемы с FastCGI с PHP версии <5.4)';
$_['v2pc_sapi_litespeed']='Поддерживается (работаем http_response_code () в LiteSpeed)';
$_['v2pc_sapi_not_tested']='Не поддерживается (кэш страниц не был протестирован с этой SAPI)';
$_['v2pc_text_status']='Статус';
$_['v2pc_only_2_3_supported']='Модуль работает на opencart 2.3 (и старше)';
$_['v2pc_err_topmarker']='Не удается найти верхний маркер в index.php';
$_['v2pc_err_bottommarker']='Не удается найти нижний маркер в index.php';
$_['v2pc_pagecache_disabled']='Модуль не добавлен в index.php';
$_['v2pc_pagecache_enabled']='Модуль добавлен в index.php';
$_['v2pc_count_error']='Кол-во связанных с кэш страниц %s, должно быть %s. Исправте %s вручную!';
$_['v2pc_already_enabled']='Модуль уже включен';
$_['v2pc_enable_error']='Невозможно включить, статус: ';
$_['v2pc_already_disabled']='Модуль уже отключен';
$_['v2pc_disable_error']='Невозможно отключить, статус: ';
$_['v2pc_purged']='Очищенно %s файлов';
$_['v2pc_wait']='ждем...';
$_['v2pc_label_compat']='Совместимость:';
$_['v2pc_label_status']='Статус:';
$_['v2pc_header_cachestat']='Статистики кэша';
$_['v2pc_td_cf']='Кешированные файлы';
$_['v2pc_td_total']='Всего # файлов';
$_['v2pc_td_space']='Использованно места';
$_['v2pc_td_valid']='Действующий';
$_['v2pc_td_expired']='Истекший';
$_['v2pc_td_total']='Всего';
$_['v2pc_btn_refresh']='Обновить статистику';
$_['v2pc_btn_purge']='Очистить весь кэш';
$_['v2pc_btn_purgeexp']='Очистить только истекшие файлы';
$_['v2pc_header_ops']='Операции';
$_['v2pc_header_settings']='Текущие настройки';
$_['v2pc_settings_note']='Внимание: Настройки только для справки, изменения вы должны сделать вручную в файле system\library\v2pagecache.php';
$_['v2pc_td_setting']='Настройки';
$_['v2pc_td_value']='Значение';
$_['v2pc_td_detail']='Подробнее';
$_['v2pc_expire_note']='Время жизни кеша, сек.';
$_['v2pc_lang_note']='Язык по умолчанию';
$_['v2pc_currency_note']='Валюта по умолчанию';
$_['v2pc_cachefolder_note']='Категория, в которой хратится Кэш';
$_['v2pc_cachebydevice_note']='Кеширование мобильными устройствами. По умолчанию оключено. Можно использовать методы  (mobiledetect или categorizr).';
$_['v2pc_addcomment_note']='Добавить комментарий к кэшу, добавляет дату';
$_['v2pc_wrapcomment_note']='Будет добавлен формат комментария для CloudFlare.com';
$_['v2pc_end_flush_note']='Добавляет ob_end_flush() в цикл перед загрурузкой кэша. Увеличивает производительность, но могут быть проблемы';
$_['v2pc_skipurls_note']='Список шаблонов URL, которые не нужно кэшировать.';
$_['v2pc_enable_warn']='<b>Внимание</b>: Включение и отключение модуля изменяет файл index.php. <em>На всякий случай сделайте резервную копию файле index.php.</em><br><span>Подробнее о модуле и <a target="_blank" href="http://github.com/budgetneon/v2pagecache">документацию</a> или на <a href="http://forum.opencart-russia.ru/threads/v2pagecache-kehshirovanie-uskorenie-opencart-2-0-russkaja-versija.1490/">Русском форуме</a>.</span>';
$_['v2pc_btn_disable']='Выключить кэш';
$_['v2pc_btn_enable']='Включить кэш';
?>
