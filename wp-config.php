<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи, язык WordPress и ABSPATH. Дополнительную информацию можно найти
 * на странице {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется сценарием создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'localhost_db');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'p@ssw0rd');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется снова авторизоваться.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ifakvT2Pw`1iEg+|!,%EGUO:`&z5gxQum..2aM7f[B8)+La(;X.G[e-}SX7-Q.VX');
define('SECURE_AUTH_KEY',  'j^iyJ<$dq`XP.[m;&ygMz)}+eF@M%Q:-^xUBv<#}+wv-;rD~q)92PcY`bcY&NP/n');
define('LOGGED_IN_KEY',    'f9Ypdaq~?tWjVqO9Y=RL3Fb!viHv,,cA-|z,eR`A#{{kB{{I4}tkgcE] } $4In~');
define('NONCE_KEY',        'gg?]kBqZq2Ari$Q|Ubt vv^_kBH_pJc5Uux9rJoQ@f_zZ.;x#)sL=-lb=-DwY#R[');
define('AUTH_SALT',        'g67e_l* -},0}wIN2uf;dhZ3-:}GUmF3FH-n>BV@KkM)nP%E~G=~_LeY{,?DJy$n');
define('SECURE_AUTH_SALT', '}a34DVY];bQg%f)r_yD0k.38y?p1[@sEyIXP|6[]FS[x`EuoPA+-gD6FB}:$1=Lx');
define('LOGGED_IN_SALT',   'ZvT/M`tA9Cz [zQr//t-/?%kp]NZ5(H>U?.TJtQfRT;Z;>KF|sFT3*f9f?rEu>`Z');
define('NONCE_SALT',       'V]Od}/^e4Ukyf$#KeJ86oO8bHd,9`:HBMZ[=6{UV/bEDO%yC5zHL+L}^m~I^  4`');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Настоятельно рекомендуется, чтобы разработчики плагинов и тем использовали WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
