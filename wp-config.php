<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'projet10' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '%af(rX_9:Lsq5>C{zCzI*oqLA9Uw0siqaOrBZ.Ml*o#uO~.Ulwd{P}H ^7:Ys(K]' );
define( 'SECURE_AUTH_KEY',  '*BXZPm+l+}L6^w;fr)DQazU(UZmTF=<PM8g:nN2pHq!5JBNDTc+H|,ND+wOP%&o_' );
define( 'LOGGED_IN_KEY',    ']tZhXKE(2I;WP2eGM.0.iy{7|B&26dWMH z1xb9A3J>Gtly%%JUcgMwe1J0WHqw;' );
define( 'NONCE_KEY',        '~[&cjj^ Dc#8}WNDneygptYy,59M1R1D|jQ.PlAPje[C^W>kxlLevA1$T^C~1|q@' );
define( 'AUTH_SALT',        'PjbQ5_$#&4BuEiC6ZwLtMiF<IkEjhCXVUI1ElKZ0)[KAJ>EJ[/=Yn8FOINqWH=z6' );
define( 'SECURE_AUTH_SALT', 'l4yNj#z9a]>vM{u6iBgDO7daMf%lmdd6;n2TEK_]59c8_(pGgN#5q},tUJxk9-0]' );
define( 'LOGGED_IN_SALT',   'Obr!g(szK74q= nR]W{P$``L2&8O 4&sIGNMZP4,[tfl^4z;S4ITh3aw5Wrh^@&&' );
define( 'NONCE_SALT',       'bxHn_7cLr;=tdgGUv$%S:+/!&iJoI?%mRT(L9%Q#aH3hMM}CruK6nsxfX[L5xAZX' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'alacs_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
