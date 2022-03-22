<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wp_killer' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'H&5g oy F`}{jVoPu7ma.d4Km&T5.2L0MRF!e5V{+{2I^xyhP!|zdgr{A`3u7G|.' );
define( 'SECURE_AUTH_KEY',  'g<pL+E!BwOYV(Cygc`{RS]&<vqo0`03 mr,1>d2ToSWgh%h#c,(ND>V,0]HY5{L}' );
define( 'LOGGED_IN_KEY',    '6R?ssh}9MVz}oQhi?oE,TwQiF{)g7(-DjsYx>SJ.x[Eo+7gNoIcT}8*Rh)Xw^]@/' );
define( 'NONCE_KEY',        's@R6CQl>n}x;.10fXr)iiQKTY}w{u6B|<QbudnL tSn#s0FeZ|z>/|~-qgp|*}OL' );
define( 'AUTH_SALT',        '^*th@BBTEgGl_7^?/q/EJnHRwJH=m/<r!Ao`ua{mV1p 5sdp+R^u{)GAdp# >.>F' );
define( 'SECURE_AUTH_SALT', '#V0IGNvn@[[vC0Opg[=3G[.Zqh*K&0gqx.i$y,SH%T`&.#dUCGJ?YPDKNT|d@+&7' );
define( 'LOGGED_IN_SALT',   'hi7[qZ%FBKU`Hv;KN783.J(W=[qrsO,,-TV]GVz!DLE&rxSv#nbS^>6~:~Vj<m(a' );
define( 'NONCE_SALT',       '[m?)S6ifw3]fe4?JMF,c%xKGl%kL%D^WA&+V`@ToxZ~n_9/S%#hqBB.F_$OxgaGj' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
