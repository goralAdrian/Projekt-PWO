<!DOCTYPE html>
<html lang="pl-PL">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Zaloguj się &lsaquo;  &#8212; WordPress</title>
	<meta name="robots" content="max-image-preview:large, noindex, noarchive">
<link rel="dns-prefetch" href="//s.w.org">
<link rel="stylesheet" id="dashicons-css" href="/wp-includes/css/dashicons.min.css?ver=5.8.1" media="all">
<link rel="stylesheet" id="buttons-css" href="/wp-includes/css/buttons.min.css?ver=5.8.1" media="all">
<link rel="stylesheet" id="forms-css" href="/wp-admin/css/forms.min.css?ver=5.8.1" media="all">
<link rel="stylesheet" id="l10n-css" href="/wp-admin/css/l10n.min.css?ver=5.8.1" media="all">
<link rel="stylesheet" id="login-css" href="/wp-admin/css/login.min.css?ver=5.8.1" media="all">
	<meta name="referrer" content="strict-origin-when-cross-origin">
		<meta name="viewport" content="width=device-width">
		</head>
	<body class="login no-js login-action-login wp-core-ui  locale-pl-pl">
	<script type="text/javascript">
		document.body.className = document.body.className.replace('no-js','js');
	</script>
		<div id="login">
		<h1><a href="https://pl.wordpress.org/">Oparte na WordPressie</a></h1>
	
		<form name="loginform" id="loginform" action="/wp-login.php" method="post">
			<p>
				<label for="user_login">Nazwa użytkownika lub adres e-mail</label>
				<input type="text" name="log" id="user_login" class="input" value="" size="20" autocapitalize="off">
			</p>

			<div class="user-pass-wrap">
				<label for="user_pass">Hasło</label>
				<div class="wp-pwd">
					<input type="password" name="pwd" id="user_pass" class="input password-input" value="" size="20">
					<button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="Pokaż hasło">
						<span class="dashicons dashicons-visibility" aria-hidden="true"></span>
					</button>
				</div>
			</div>
						<p class="forgetmenot"><input name="rememberme" type="checkbox" id="rememberme" value="forever"> <label for="rememberme">Zapamiętaj mnie</label></p>
			<p class="submit">
				<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Zaloguj się">
									<input type="hidden" name="redirect_to" value="http://127.0.0.1/StronaProjekt">
									<input type="hidden" name="testcookie" value="1">
			</p>
		</form>

					<p id="nav">
								<a href="/wp-login.php?action=lostpassword">Nie pamiętasz hasła?</a>
			</p>
					<script type="text/javascript">
			function wp_attempt_focus() {setTimeout( function() {try {d = document.getElementById( "user_login" );d.focus(); d.select();} catch( er ) {}}, 200);}
wp_attempt_focus();
if ( typeof wpOnload === 'function' ) { wpOnload() }		</script>
				<p id="backtoblog">
			<a href="/">&larr; Przejdź do </a>		</p>
			</div>
	<script src="/wp-includes/js/jquery/jquery.min.js?ver=3.6.0" id="jquery-core-js"></script>
<script src="/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.3.2" id="jquery-migrate-js"></script>
<script id="zxcvbn-async-js-extra">
var _zxcvbnSettings = {"src":"http:\/\/127.0.0.1\/StronaProjekt\/wp-includes\/js\/zxcvbn.min.js"};
</script>
<script src="/wp-includes/js/zxcvbn-async.min.js?ver=1.0" id="zxcvbn-async-js"></script>
<script src="/wp-includes/js/dist/vendor/regenerator-runtime.min.js?ver=0.13.7" id="regenerator-runtime-js"></script>
<script src="/wp-includes/js/dist/vendor/wp-polyfill.min.js?ver=3.15.0" id="wp-polyfill-js"></script>
<script src="/wp-includes/js/dist/hooks.min.js?ver=a7edae857aab69d69fa10d5aef23a5de" id="wp-hooks-js"></script>
<script src="/wp-includes/js/dist/i18n.min.js?ver=5f1269854226b4dd90450db411a12b79" id="wp-i18n-js"></script>
<script id="wp-i18n-js-after">
wp.i18n.setLocaleData( { 'text directionltr': [ 'ltr' ] } );
</script>
<script id="password-strength-meter-js-extra">
var pwsL10n = {"unknown":"Nieznana siła hasła","short":"Bardzo słabe","bad":"Słabe","good":"Średnie","strong":"Silne","mismatch":"Niezgodność haseł"};
</script>
<script id="password-strength-meter-js-translations">
( function( domain, translations ) {
	var localeData = translations.locale_data[ domain ] || translations.locale_data.messages;
	localeData[""].domain = domain;
	wp.i18n.setLocaleData( localeData, domain );
} )( "default", {"translation-revision-date":"2021-09-24 22:11:57+0000","generator":"GlotPress\/3.0.0-alpha.2","domain":"messages","locale_data":{"messages":{"":{"domain":"messages","plural-forms":"nplurals=3; plural=(n == 1) ? 0 : ((n % 10 >= 2 && n % 10 <= 4 && (n % 100 < 12 || n % 100 > 14)) ? 1 : 2);","lang":"pl"},"%1$s is deprecated since version %2$s! Use %3$s instead. Please consider writing more inclusive code.":["Funkcja %1$s jest przestarzała od wersji %2$s! Użyj zamiast tego %3$s. Pomyśl o pisaniu bardziej spójnego kodu."]}},"comment":{"reference":"wp-admin\/js\/password-strength-meter.js"}} );
</script>
<script src="/wp-admin/js/password-strength-meter.min.js?ver=5.8.1" id="password-strength-meter-js"></script>
<script src="/wp-includes/js/underscore.min.js?ver=1.13.1" id="underscore-js"></script>
<script id="wp-util-js-extra">
var _wpUtilSettings = {"ajax":{"url":"\/StronaProjekt\/wp-admin\/admin-ajax.php"}};
</script>
<script src="/wp-includes/js/wp-util.min.js?ver=5.8.1" id="wp-util-js"></script>
<script id="user-profile-js-extra">
var userProfileL10n = {"user_id":"0","nonce":"b115d46927"};
</script>
<script id="user-profile-js-translations">
( function( domain, translations ) {
	var localeData = translations.locale_data[ domain ] || translations.locale_data.messages;
	localeData[""].domain = domain;
	wp.i18n.setLocaleData( localeData, domain );
} )( "default", {"translation-revision-date":"2021-09-24 22:11:57+0000","generator":"GlotPress\/3.0.0-alpha.2","domain":"messages","locale_data":{"messages":{"":{"domain":"messages","plural-forms":"nplurals=3; plural=(n == 1) ? 0 : ((n % 10 >= 2 && n % 10 <= 4 && (n % 100 < 12 || n % 100 > 14)) ? 1 : 2);","lang":"pl"},"Your new password has not been saved.":["Nowe hasło nie zostało zapisane."],"Hide":["Ukryj"],"Show":["Pokaż"],"Confirm use of weak password":["Potwierdź użycie słabego hasła"],"Hide password":["Ukryj hasło"],"Show password":["Pokaż hasło"]}},"comment":{"reference":"wp-admin\/js\/user-profile.js"}} );
</script>
<script src="/wp-admin/js/user-profile.min.js?ver=5.8.1" id="user-profile-js"></script>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
		<div class="clear"></div>
	</body>
	</html>