<?php
	$url = base64_decode($_GET['url']);
   	$ch = curl_init($url);
	      
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	     
	$ret = curl_exec($ch);
	curl_close($ch);

	$posBeg = strpos($ret, 'SelectHdate">') + 13;
	$posEnd = strpos($ret, '</div>', $posBeg);
	$date = substr($ret, $posBeg, $posEnd - $posBeg);
	$date = str_replace('年', '-', $date);
	$date = str_replace('月', '-', $date);
	$date = str_replace('日', 'T00:00:01+00:00', $date);

	$posBeg = strpos($ret, 'photo intro_photo');
	$posBeg = strpos($ret, 'src="', $posBeg) + 5;
	$posEnd = strpos($ret, '"', $posBeg);
	$pic = substr($ret, $posBeg, $posEnd - $posBeg);

	/*$posBeg = strpos($ret, '<a href="/author');
	$posBeg = strpos($ret, '>', $posBeg) + 1;
	$posEnd = strpos($ret, '</a>', $posBeg);*/
	$posBeg = strpos($ret, 'og:title" content=\'') + 19;
	$posBeg = strpos($ret, '（', $posBeg);
	$posEnd = strpos($ret, '）', $posBeg);
	$author = substr($ret, $posBeg, $posEnd - $posBeg);
	$author = str_replace('（', '', $author);

	$posBeg = strpos($ret, 'og:title" content=\'') + 19;
	$posEnd = strpos($ret, '\'', $posBeg);
	$title = substr($ret, $posBeg, $posEnd - $posBeg);
	$posBeg = strpos($title, '（');
	$title = substr($title, 0, $posBeg);

	$posBeg = strpos($ret, '<p>');
	$posEnd = strpos($ret, '</p>', $posBeg) + 4;
	$content = substr($ret, $posBeg, $posEnd - $posBeg);
	$content = str_replace('<br />', '<br/>', $content);
	$posBeg = strpos($content, '<br/><br/>');
	$content = substr($content, 0, $posBeg);
	$content = str_replace('<br/><br/>', '<br/>', $content);
	$content = str_replace('<br/>', '<br/><br/>', $content);
	$content = str_replace('http://www.facebook.com/mrleeyee', '', $content);
	
	$contentNew = '
	<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="zh-TW"
 xmlns:fb="http://ogp.me/ns/fb#" prefix="og: http://ogp.me/ns#">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="zh-TW"
 xmlns:fb="http://ogp.me/ns/fb#" prefix="og: http://ogp.me/ns#">
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html lang="zh-TW" xmlns:fb="http://ogp.me/ns/fb#" prefix="og: http://ogp.me/ns#">
<!--<![endif]-->
<head>
<link rel="shortcut icon" href="http://polymerhk.com/wp-content/uploads/2016/01/polymer_favicon.png" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="pingback" href="http://polymerhk.com/xmlrpc.php">
<title>港人奴性指數 | 胡迪 | 聚言時報 Polymer</title>
<style type="text/css">
@font-face {
	font-family: 'socialfans';
	src: url('http://polymerhk.com/wp-content/plugins/socialfans-counter/assets/font/socialfans.eot?v=4.4.1');
	src: url('http://polymerhk.com/wp-content/plugins/socialfans-counter/assets/font/socialfans.eot?v=4.4.1#iefix') format('embedded-opentype'),
	url('http://polymerhk.com/wp-content/plugins/socialfans-counter/assets/font/socialfans.woff?v=4.4.1') format('woff'),
	url('http://polymerhk.com/wp-content/plugins/socialfans-counter/assets/font/socialfans.ttf?v=4.4.1') format('truetype'),
	url('http://polymerhk.com/wp-content/plugins/socialfans-counter/assets/font/socialfans.svg?v=4.4.1') format('svg');
	font-weight: normal;
	font-style: normal;
}
</style>
<style type="text/css">
@font-face {
	font-family: 'fontawesome';
	src: url('http://polymerhk.com/wp-content/plugins/socialfans-counter/assets/font/fontawesome.eot?v=4.4.1');
	src: url('http://polymerhk.com/wp-content/plugins/socialfans-counter/assets/font/fontawesome.eot?v=4.4.1#iefix') format('embedded-opentype'),
	url('http://polymerhk.com/wp-content/plugins/socialfans-counter/assets/font/fontawesome.woff?v=4.4.1') format('woff'),
	url('http://polymerhk.com/wp-content/plugins/socialfans-counter/assets/font/fontawesome.woff2?v=4.4.1') format('woff2'),
	url('http://polymerhk.com/wp-content/plugins/socialfans-counter/assets/font/fontawesome.ttf?v=4.4.1') format('truetype'),
	url('http://polymerhk.com/wp-content/plugins/socialfans-counter/assets/font/fontawesome.svg?v=4.4.1') format('svg');
	font-weight: normal;
	font-style: normal;
}
</style>

<meta name="description" content="澳洲人權組織「自由行基金會」《全球奴隸指數》報告，指出香港政府是反奴役最不積極政府之一，有人說港豬的心態就是奴隸的象徵，而同時又出現90後見工與職場奴性的討論。" />
<link rel="canonical" href="http://polymerhk.com/articles/2016/06/06/31905/" />
<link rel="publisher" href="https://plus.google.com/+Polymerhk" />
<meta property="og:locale" content="zh_TW" />
<meta property="og:type" content="article" />
<meta property="og:title" content="港人奴性指數 | 胡迪 | 聚言時報 Polymer" />
<meta property="og:description" content="澳洲人權組織「自由行基金會」《全球奴隸指數》報告，指出香港政府是反奴役最不積極政府之一，有人說港豬的心態就是奴隸的象徵，而同時又出現90後見工與職場奴性的討論。" />
<meta property="og:url" content="http://polymerhk.com/articles/2016/06/06/31905/" />
<meta property="og:site_name" content="聚言時報 Polymer" />
<meta property="article:publisher" content="https://www.facebook.com/GaldenPolymer" />
<meta property="article:tag" content="奴隸" />
<meta property="article:tag" content="港奴" />
<meta property="article:tag" content="奴性" />
<meta property="article:section" content="本地" />
<meta property="article:published_time" content="2016-06-06T15:14:54+08:00" />
<meta property="article:modified_time" content="2016-06-06T15:20:56+08:00" />
<meta property="og:updated_time" content="2016-06-06T15:20:56+08:00" />
<meta property="og:image" content="https://i0.wp.com/polymerhk.com/wp-content/uploads/2016/06/4934555.jpg?fit=700%2C398" />
<meta property="og:image:secure_url" content="https://i0.wp.com/polymerhk.com/wp-content/uploads/2016/06/4934555.jpg?fit=700%2C398" />
<meta property="og:image:width" content="700" />
<meta property="og:image:height" content="398" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="澳洲人權組織「自由行基金會」《全球奴隸指數》報告，指出香港政府是反奴役最不積極政府之一，有人說港豬的心態就是奴隸的象徵，而同時又出現90後見工與職場奴性的討論。" />
<meta name="twitter:title" content="港人奴性指數 | 胡迪 | 聚言時報 Polymer" />
<meta name="twitter:site" content="@galdenpolymer" />
<meta name="twitter:image" content="https://i0.wp.com/polymerhk.com/wp-content/uploads/2016/06/4934555.jpg?fit=700%2C398" />
<meta name="twitter:creator" content="@galdenpolymer" />

<link rel='dns-prefetch' href='//polymerhk.com' />
<link rel='dns-prefetch' href='//s0.wp.com' />
<link rel='dns-prefetch' href='//secure.gravatar.com' />
<link rel='dns-prefetch' href='//fonts.googleapis.com' />
<link rel='dns-prefetch' href='//s.w.org' />
<link rel="alternate" type="application/rss+xml" title="訂閱 聚言時報 Polymer &raquo;" href="http://polymerhk.com/feed/" />
<link rel="alternate" type="application/rss+xml" title="訂閱 聚言時報 Polymer &raquo; 迴響" href="http://polymerhk.com/comments/feed/" />
<link rel="alternate" type="application/rss+xml" title="訂閱 聚言時報 Polymer &raquo; 港人奴性指數 迴響" href="http://polymerhk.com/articles/2016/06/06/31905/feed/" />
<script type="text/javascript">
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/11\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/11\/svg\/","svgExt":".svg","source":{"concatemoji":"http:\/\/polymerhk.com\/wp-includes\/js\/wp-emoji-release.min.js?ver=efaa517a940fe7044dadf64128491d1e"}};
			!function(a,b,c){function d(a,b){var c=String.fromCharCode;l.clearRect(0,0,k.width,k.height),l.fillText(c.apply(this,a),0,0);var d=k.toDataURL();l.clearRect(0,0,k.width,k.height),l.fillText(c.apply(this,b),0,0);var e=k.toDataURL();return d===e}function e(a){var b;if(!l||!l.fillText)return!1;switch(l.textBaseline="top",l.font="600 32px Arial",a){case"flag":return!(b=d([55356,56826,55356,56819],[55356,56826,8203,55356,56819]))&&(b=d([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]),!b);case"emoji":return b=d([55358,56760,9792,65039],[55358,56760,8203,9792,65039]),!b}return!1}function f(a){var c=b.createElement("script");c.src=a,c.defer=c.type="text/javascript",b.getElementsByTagName("head")[0].appendChild(c)}var g,h,i,j,k=b.createElement("canvas"),l=k.getContext&&k.getContext("2d");for(j=Array("flag","emoji"),c.supports={everything:!0,everythingExceptFlag:!0},i=0;i<j.length;i++)c.supports[j[i]]=e(j[i]),c.supports.everything=c.supports.everything&&c.supports[j[i]],"flag"!==j[i]&&(c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&c.supports[j[i]]);c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&!c.supports.flag,c.DOMReady=!1,c.readyCallback=function(){c.DOMReady=!0},c.supports.everything||(h=function(){c.readyCallback()},b.addEventListener?(b.addEventListener("DOMContentLoaded",h,!1),a.addEventListener("load",h,!1)):(a.attachEvent("onload",h),b.attachEvent("onreadystatechange",function(){"complete"===b.readyState&&c.readyCallback()})),g=c.source||{},g.concatemoji?f(g.concatemoji):g.wpemoji&&g.twemoji&&(f(g.twemoji),f(g.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>
<script>
					advanced_ads_ready=function(){var fns=[],listener,doc=typeof document==="object"&&document,hack=doc&&doc.documentElement.doScroll,domContentLoaded="DOMContentLoaded",loaded=doc&&(hack?/^loaded|^c/:/^loaded|^i|^c/).test(doc.readyState);if(!loaded&&doc){listener=function(){doc.removeEventListener(domContentLoaded,listener);window.removeEventListener("load",listener);loaded=1;while(listener=fns.shift())listener()};doc.addEventListener(domContentLoaded,listener);window.addEventListener("load",listener)}return function(fn){loaded?setTimeout(fn,0):fns.push(fn)}}();
			</script><style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>
<link rel='stylesheet' id='footenote_css-css' href='http://polymerhk.com/wp-content/plugins/jquery-hover-footnotes/footnote-voodoo.css?ver=efaa517a940fe7044dadf64128491d1e' type='text/css' media='all' />
<link rel='stylesheet' id='contact-form-7-css' href='http://polymerhk.com/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=5.0.3' type='text/css' media='all' />
<link rel='stylesheet' id='socialfans-widget-style-css' href='http://polymerhk.com/wp-content/plugins/socialfans-counter/assets/css/socialfans-style.css?ver=4.4.1' type='text/css' media='all' />
<link rel='stylesheet' id='fontawesome-widget-style-css' href='http://polymerhk.com/wp-content/plugins/socialfans-counter/assets/css/font-awesome.min.css?ver=4.4.1' type='text/css' media='all' />
<link rel='stylesheet' id='wordpress-popular-posts-css-css' href='http://polymerhk.com/wp-content/plugins/wordpress-popular-posts/public/css/wpp.css?ver=4.1.1' type='text/css' media='all' />
<link rel='stylesheet' id='dashicons-css' href='http://polymerhk.com/wp-includes/css/dashicons.min.css?ver=efaa517a940fe7044dadf64128491d1e' type='text/css' media='all' />
<link rel='stylesheet' id='font-awesome-css' href='http://polymerhk.com/wp-content/themes/edition/css/font-awesome/css/font-awesome.min.css?ver=4.3.0' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-css' href='http://polymerhk.com/wp-content/themes/edition/css/bootstrap.min.css?ver=efaa517a940fe7044dadf64128491d1e' type='text/css' media='all' />
<link rel='stylesheet' id='theme-styles-css' href='http://polymerhk.com/wp-content/themes/edition_child/style.css?ver=efaa517a940fe7044dadf64128491d1e' type='text/css' media='all' />
<style id='theme-styles-inline-css' type='text/css'>
/* Custom CSS */ 
                     #footnotediv {z-index: 120;}

.badge {background: 0 0;}

p {color: #474747;}

.sharedaddy .sd-content ul {list-style-type:none;}
.sharedaddy .sd-content ul li {padding-left: 0;}
.sharedaddy .sd-content ul>li:before {content: "";}

#footer {margin-top: 20px;}                
</style>
<!--[if IE 8]>
<link rel='stylesheet' id='ie8-css'  href='http://polymerhk.com/wp-content/themes/edition/css/ie8.css?ver=1.7.4' type='text/css' media='all' />
<![endif]-->
<link rel='stylesheet' id='jetpack-widget-social-icons-styles-css' href='http://polymerhk.com/wp-content/plugins/jetpack/modules/widgets/social-icons/social-icons.css?ver=20170506' type='text/css' media='all' />
<link rel='stylesheet' id='redux-google-fonts-tw_options-css' href='http://fonts.googleapis.com/css?family=Lato%3A900%2C300%2C700%2C400&#038;ver=1505740891' type='text/css' media='all' />
<link rel='stylesheet' id='social-logos-css' href='http://polymerhk.com/wp-content/plugins/jetpack/_inc/social-logos/social-logos.min.css?ver=1' type='text/css' media='all' />
<link rel='stylesheet' id='jetpack_css-css' href='http://polymerhk.com/wp-content/plugins/jetpack/css/jetpack.css?ver=6.3.3' type='text/css' media='all' />
<link rel='stylesheet' id='themewich-shortcodes-css' href='http://polymerhk.com/wp-content/plugins/themewich-shortcodes/css/themewich-shortcodes.css?ver=efaa517a940fe7044dadf64128491d1e' type='text/css' media='all' />
<script type='text/javascript' src='http://polymerhk.com/wp-includes/js/jquery/jquery.js?ver=1.12.4'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.1'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/plugins/jquery-hover-footnotes/footnote-voodoo.js?ver=efaa517a940fe7044dadf64128491d1e'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var related_posts_js_options = {"post_heading":"h4"};
/* ]]> */
</script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/plugins/jetpack/_inc/build/related-posts/related-posts.min.js?ver=20150408'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/plugins/fd-footnotes/fdfootnotes.js?ver=1.34'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/plugins/themewich-shortcodes/js/modernizr.min.js?ver=2.8.2'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var wpp_params = {"rest_api":"1","sampling_active":"0","sampling_rate":"100","ajax_url":"http:\/\/polymerhk.com\/wp-json\/wordpress-popular-posts\/v1\/popular-posts\/","action":"update_views_ajax","ID":"31905","token":"7118951163","debug":""};
/* ]]> */
</script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/plugins/wordpress-popular-posts/public/js/wpp-4.1.0.min.js?ver=4.1.1'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/themes/edition/js/fixto.min.js?ver=0.3.0'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/themes/edition/js/respond.min.js?ver=1.4.2'></script>
<link rel='https://api.w.org/' href='http://polymerhk.com/wp-json/' />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://polymerhk.com/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://polymerhk.com/wp-includes/wlwmanifest.xml" />
<link rel='shortlink' href='https://wp.me/p6goKr-8iB' />
<link rel="alternate" type="application/json+oembed" href="http://polymerhk.com/wp-json/oembed/1.0/embed?url=http%3A%2F%2Fpolymerhk.com%2Farticles%2F2016%2F06%2F06%2F31905%2F" />
<link rel="alternate" type="text/xml+oembed" href="http://polymerhk.com/wp-json/oembed/1.0/embed?url=http%3A%2F%2Fpolymerhk.com%2Farticles%2F2016%2F06%2F06%2F31905%2F&#038;format=xml" />
<meta property="fb:app_id" content="1438310899736479" /><script type="text/javascript">/* <![CDATA[ */ jQuery.post("http://polymerhk.com/wp-admin/admin-ajax.php", { action: "wmp_update", id: 31905, token: "64371e01cc" }); /* ]]> */</script><meta name="google-site-verification" content="8uAbENV8fJD1lRDVYqHPtjOyYf9qlIsJpqeI5WzUF2Q" />
<link rel='dns-prefetch' href='//v0.wordpress.com' />
<link rel='dns-prefetch' href='//i0.wp.com' />
<link rel='dns-prefetch' href='//i1.wp.com' />
<link rel='dns-prefetch' href='//i2.wp.com' />
<style type='text/css'>img#wpstats{display:none}</style>

<style type="text/css">
                      .badge a,
        .widget .tagcloud a,
        .woocommerce span.onsale,
        .badgesliver.highlight, .sharing a .sharecircle,
        .tabswrap ul.tabs li a.active, .tabswrap ul.tabs li a:hover,
        .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
        .breakdown .line,
        .woocommerce #respond input#submit.alt,
        .woocommerce a.button.alt,
        .woocommerce button.button.alt,
        .woocommerce input.button.alt { background:#6c7a89; }           .pagetitleloading .pagercontainer #bx-pager a.active,
        .pagetitleloading .pagercontainer #bx-pager a:hover,
        a.more-link, .regular-posts a.more-link, .woocommerce a.button,
        .woocommerce #respond input#submit.alt, .woocommerce a.button.alt,
        .woocommerce #respond input#submit, .woocommerce input.button,
        .woocommerce button.button.alt, .woocommerce input.button.alt,
        .pie, .c100 .bar, .c100.p51 .fill, .c100.p52 .fill,
        .c100.p53 .fill, .c100.p54 .fill, .c100.p55 .fill,
        .c100.p56 .fill, .c100.p57 .fill, .c100.p58 .fill,
        .c100.p59 .fill, .c100.p60 .fill, .c100.p61 .fill,
        .c100.p62 .fill, .c100.p63 .fill, .c100.p64 .fill,
        .c100.p65 .fill, .c100.p66 .fill, .c100.p67 .fill,
        .c100.p68 .fill, .c100.p69 .fill, .c100.p70 .fill,
        .c100.p71 .fill, .c100.p72 .fill, .c100.p73 .fill,
        .c100.p74 .fill, .c100.p75 .fill, .c100.p76 .fill,
        .c100.p77 .fill, .c100.p78 .fill, .c100.p79 .fill,
        .c100.p80 .fill, .c100.p81 .fill, .c100.p82 .fill,
        .c100.p83 .fill, .c100.p84 .fill, .c100.p85 .fill,
        .c100.p86 .fill, .c100.p87 .fill, .c100.p88 .fill,
        .c100.p89 .fill, .c100.p90 .fill, .c100.p91 .fill,
        .c100.p92 .fill, .c100.p93 .fill, .c100.p94 .fill,
        .c100.p95 .fill, .c100.p96 .fill, .c100.p97 .fill,
        .c100.p98 .fill, .c100.p99 .fill, .c100.p100 .fill,
        .tw-button, a.tw-button, .tw-postshortcode a.more-link { border-color:#6c7a89; }           a, a:hover, #share-box span, .thumbintro span a,
        .c100:hover > span, a.more-link,
        span.highlight,
        .score,
        .button,
        .tw-button,
        a.tw-button,
        a.button,
        a.more-link,
        .woocommerce a.button,
        .woocommerce ul.products li.product .price,
        .woocommerce .woocommerce-product-rating .star-rating,
        .woocommerce #respond input#submit, .woocommerce input.button,
        #submit,
        .tw-postshortcode a.more-link,
        input[type=submit],
        .single .authorinfo.not-full a:hover,
        .tw-button, a.tw-button, .tw-postshortcode a.more-link { color:#6c7a89; }           .tabswrap ul.tabs a:hover, a.more-link:hover,
        .regular-posts a.more-link:hover,.button:hover,
        .tw-button:hover,
        a.tw-button:hover,
        a.button:hover,
        a.more-link:hover,
        .woocommerce a.button:hover,
        .woocommerce #respond input#submit:hover, .woocommerce input.button:hover,
        #submit:hover,
        .tw-postshortcode a.more-link:hover,
        input[type=submit]:hover,
        .button:active,
        .tw-button:active,
        a.tw-button:active,
        a.button:active,
        a.more-link:active,
        #submit:active,
        .tw-postshortcode a.more-link:active,
        input[type=submit]:active { background:#6c7a89; }           .pagetitleloading .pagercontainer .bx-slider-pager a.active,
        .pagetitleloading .pagercontainer .bx-slider-pager a:hover,
        .button,
        .tw-button,
        a.tw-button,
        a.button,
        a.more-link,
        #submit,
        .tw-postshortcode a.more-link,
        input[type=submit],
        .top-nav.altnav #menu > ul > li > a:hover,
        .top-nav.altnav #menu > ul > li.sfHover > a,
        .top-nav.altnav #menu > ul > li.current_page_item > a { border-color:#6c7a89; }           .badge a:before, .badgesliver.highlight:before { border-right-color:#6c7a89; }           .badge a:after, .badgesliver.highlight:after { border-left-color:#6c7a89; }           *::selection { background:#6c7a89; }           .badge a.category-23,
          .highlight_category_23 a.more-link:hover,
          .highlight_category_23 .tagcloud.badge a,
          .highlight_category_23 .widget .tagcloud a,
          .highlight_category_23 .sharing a.post-share .sharecircle,
          .highlight_category_23 input[type=submit]:hover,
          .highlight_category_23 #submit:hover,
          .highlight_category_23 .breakdown .line,
          .highlight_category_23 .ie8 .c100,
          .highlight_category_23 .ie8 .section .c100,
          .highlight_category_23 .ie8 .section .inner-content .c100 { background:#198964; }.highlight_category_23 .postcontent p a,
          .tiny-details a.category-23:hover,
          .highlight_category_23 .commentwrapper p a,
          .highlight_category_23 .singlecomment a:hover,
          .highlight_category_23 #respond a:hover,
          .highlight_category_23 .postcontent p a:hover,
          .highlight_category_23 #share-box span,
          .highlight_category_23 .breakdown .c100:hover > span,
          .highlight_category_23 .reviewtop .c100:hover > span,
          .highlight_category_23 .score,
          .highlight_category_23 .tw-button,
          .highlight_category_23 a.tw-button,
          .highlight_category_23 a.button,
          .highlight_category_23 a:hover,
          .highlight_category_23 a.more-link,
          .highlight_category_23 #submit,
          .highlight_category_23 .tw-postshortcode a.more-link,
          .highlight_category_23 input[type=submit],
          .highlight_category_23 .authorinfo.not-full a:hover { color:#198964; }.highlight_category_23 .pie,
          .highlight_category_23 .c100 .bar,
          .highlight_category_23 .c100 .fill,
          .highlight_category_23 a.more-link,
          .highlight_category_23 #submit,
          .highlight_category_23 input[type=submit],
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_23 a.active,
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_23 a:hover { border-color:#198964; }.badge a.category-23:after,
          .single .highlight_category_23 .tagcloud.badge a:after { border-left-color:#198964; }.badge a.category-23:before,
          .single .highlight_category_23 .tagcloud.badge a:before { border-right-color:#198964; }.badge a.category-24,
          .highlight_category_24 a.more-link:hover,
          .highlight_category_24 .tagcloud.badge a,
          .highlight_category_24 .widget .tagcloud a,
          .highlight_category_24 .sharing a.post-share .sharecircle,
          .highlight_category_24 input[type=submit]:hover,
          .highlight_category_24 #submit:hover,
          .highlight_category_24 .breakdown .line,
          .highlight_category_24 .ie8 .c100,
          .highlight_category_24 .ie8 .section .c100,
          .highlight_category_24 .ie8 .section .inner-content .c100 { background:#457cb0; }.highlight_category_24 .postcontent p a,
          .tiny-details a.category-24:hover,
          .highlight_category_24 .commentwrapper p a,
          .highlight_category_24 .singlecomment a:hover,
          .highlight_category_24 #respond a:hover,
          .highlight_category_24 .postcontent p a:hover,
          .highlight_category_24 #share-box span,
          .highlight_category_24 .breakdown .c100:hover > span,
          .highlight_category_24 .reviewtop .c100:hover > span,
          .highlight_category_24 .score,
          .highlight_category_24 .tw-button,
          .highlight_category_24 a.tw-button,
          .highlight_category_24 a.button,
          .highlight_category_24 a:hover,
          .highlight_category_24 a.more-link,
          .highlight_category_24 #submit,
          .highlight_category_24 .tw-postshortcode a.more-link,
          .highlight_category_24 input[type=submit],
          .highlight_category_24 .authorinfo.not-full a:hover { color:#457cb0; }.highlight_category_24 .pie,
          .highlight_category_24 .c100 .bar,
          .highlight_category_24 .c100 .fill,
          .highlight_category_24 a.more-link,
          .highlight_category_24 #submit,
          .highlight_category_24 input[type=submit],
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_24 a.active,
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_24 a:hover { border-color:#457cb0; }.badge a.category-24:after,
          .single .highlight_category_24 .tagcloud.badge a:after { border-left-color:#457cb0; }.badge a.category-24:before,
          .single .highlight_category_24 .tagcloud.badge a:before { border-right-color:#457cb0; }.badge a.category-25,
          .highlight_category_25 a.more-link:hover,
          .highlight_category_25 .tagcloud.badge a,
          .highlight_category_25 .widget .tagcloud a,
          .highlight_category_25 .sharing a.post-share .sharecircle,
          .highlight_category_25 input[type=submit]:hover,
          .highlight_category_25 #submit:hover,
          .highlight_category_25 .breakdown .line,
          .highlight_category_25 .ie8 .c100,
          .highlight_category_25 .ie8 .section .c100,
          .highlight_category_25 .ie8 .section .inner-content .c100 { background:#c6325d; }.highlight_category_25 .postcontent p a,
          .tiny-details a.category-25:hover,
          .highlight_category_25 .commentwrapper p a,
          .highlight_category_25 .singlecomment a:hover,
          .highlight_category_25 #respond a:hover,
          .highlight_category_25 .postcontent p a:hover,
          .highlight_category_25 #share-box span,
          .highlight_category_25 .breakdown .c100:hover > span,
          .highlight_category_25 .reviewtop .c100:hover > span,
          .highlight_category_25 .score,
          .highlight_category_25 .tw-button,
          .highlight_category_25 a.tw-button,
          .highlight_category_25 a.button,
          .highlight_category_25 a:hover,
          .highlight_category_25 a.more-link,
          .highlight_category_25 #submit,
          .highlight_category_25 .tw-postshortcode a.more-link,
          .highlight_category_25 input[type=submit],
          .highlight_category_25 .authorinfo.not-full a:hover { color:#c6325d; }.highlight_category_25 .pie,
          .highlight_category_25 .c100 .bar,
          .highlight_category_25 .c100 .fill,
          .highlight_category_25 a.more-link,
          .highlight_category_25 #submit,
          .highlight_category_25 input[type=submit],
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_25 a.active,
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_25 a:hover { border-color:#c6325d; }.badge a.category-25:after,
          .single .highlight_category_25 .tagcloud.badge a:after { border-left-color:#c6325d; }.badge a.category-25:before,
          .single .highlight_category_25 .tagcloud.badge a:before { border-right-color:#c6325d; }.badge a.category-100,
          .highlight_category_100 a.more-link:hover,
          .highlight_category_100 .tagcloud.badge a,
          .highlight_category_100 .widget .tagcloud a,
          .highlight_category_100 .sharing a.post-share .sharecircle,
          .highlight_category_100 input[type=submit]:hover,
          .highlight_category_100 #submit:hover,
          .highlight_category_100 .breakdown .line,
          .highlight_category_100 .ie8 .c100,
          .highlight_category_100 .ie8 .section .c100,
          .highlight_category_100 .ie8 .section .inner-content .c100 { background:#7c55c7; }.highlight_category_100 .postcontent p a,
          .tiny-details a.category-100:hover,
          .highlight_category_100 .commentwrapper p a,
          .highlight_category_100 .singlecomment a:hover,
          .highlight_category_100 #respond a:hover,
          .highlight_category_100 .postcontent p a:hover,
          .highlight_category_100 #share-box span,
          .highlight_category_100 .breakdown .c100:hover > span,
          .highlight_category_100 .reviewtop .c100:hover > span,
          .highlight_category_100 .score,
          .highlight_category_100 .tw-button,
          .highlight_category_100 a.tw-button,
          .highlight_category_100 a.button,
          .highlight_category_100 a:hover,
          .highlight_category_100 a.more-link,
          .highlight_category_100 #submit,
          .highlight_category_100 .tw-postshortcode a.more-link,
          .highlight_category_100 input[type=submit],
          .highlight_category_100 .authorinfo.not-full a:hover { color:#7c55c7; }.highlight_category_100 .pie,
          .highlight_category_100 .c100 .bar,
          .highlight_category_100 .c100 .fill,
          .highlight_category_100 a.more-link,
          .highlight_category_100 #submit,
          .highlight_category_100 input[type=submit],
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_100 a.active,
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_100 a:hover { border-color:#7c55c7; }.badge a.category-100:after,
          .single .highlight_category_100 .tagcloud.badge a:after { border-left-color:#7c55c7; }.badge a.category-100:before,
          .single .highlight_category_100 .tagcloud.badge a:before { border-right-color:#7c55c7; }.badge a.category-634,
          .highlight_category_634 a.more-link:hover,
          .highlight_category_634 .tagcloud.badge a,
          .highlight_category_634 .widget .tagcloud a,
          .highlight_category_634 .sharing a.post-share .sharecircle,
          .highlight_category_634 input[type=submit]:hover,
          .highlight_category_634 #submit:hover,
          .highlight_category_634 .breakdown .line,
          .highlight_category_634 .ie8 .c100,
          .highlight_category_634 .ie8 .section .c100,
          .highlight_category_634 .ie8 .section .inner-content .c100 { background:#52b3d9; }.highlight_category_634 .postcontent p a,
          .tiny-details a.category-634:hover,
          .highlight_category_634 .commentwrapper p a,
          .highlight_category_634 .singlecomment a:hover,
          .highlight_category_634 #respond a:hover,
          .highlight_category_634 .postcontent p a:hover,
          .highlight_category_634 #share-box span,
          .highlight_category_634 .breakdown .c100:hover > span,
          .highlight_category_634 .reviewtop .c100:hover > span,
          .highlight_category_634 .score,
          .highlight_category_634 .tw-button,
          .highlight_category_634 a.tw-button,
          .highlight_category_634 a.button,
          .highlight_category_634 a:hover,
          .highlight_category_634 a.more-link,
          .highlight_category_634 #submit,
          .highlight_category_634 .tw-postshortcode a.more-link,
          .highlight_category_634 input[type=submit],
          .highlight_category_634 .authorinfo.not-full a:hover { color:#52b3d9; }.highlight_category_634 .pie,
          .highlight_category_634 .c100 .bar,
          .highlight_category_634 .c100 .fill,
          .highlight_category_634 a.more-link,
          .highlight_category_634 #submit,
          .highlight_category_634 input[type=submit],
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_634 a.active,
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_634 a:hover { border-color:#52b3d9; }.badge a.category-634:after,
          .single .highlight_category_634 .tagcloud.badge a:after { border-left-color:#52b3d9; }.badge a.category-634:before,
          .single .highlight_category_634 .tagcloud.badge a:before { border-right-color:#52b3d9; }.badge a.category-635,
          .highlight_category_635 a.more-link:hover,
          .highlight_category_635 .tagcloud.badge a,
          .highlight_category_635 .widget .tagcloud a,
          .highlight_category_635 .sharing a.post-share .sharecircle,
          .highlight_category_635 input[type=submit]:hover,
          .highlight_category_635 #submit:hover,
          .highlight_category_635 .breakdown .line,
          .highlight_category_635 .ie8 .c100,
          .highlight_category_635 .ie8 .section .c100,
          .highlight_category_635 .ie8 .section .inner-content .c100 { background:#3a539b; }.highlight_category_635 .postcontent p a,
          .tiny-details a.category-635:hover,
          .highlight_category_635 .commentwrapper p a,
          .highlight_category_635 .singlecomment a:hover,
          .highlight_category_635 #respond a:hover,
          .highlight_category_635 .postcontent p a:hover,
          .highlight_category_635 #share-box span,
          .highlight_category_635 .breakdown .c100:hover > span,
          .highlight_category_635 .reviewtop .c100:hover > span,
          .highlight_category_635 .score,
          .highlight_category_635 .tw-button,
          .highlight_category_635 a.tw-button,
          .highlight_category_635 a.button,
          .highlight_category_635 a:hover,
          .highlight_category_635 a.more-link,
          .highlight_category_635 #submit,
          .highlight_category_635 .tw-postshortcode a.more-link,
          .highlight_category_635 input[type=submit],
          .highlight_category_635 .authorinfo.not-full a:hover { color:#3a539b; }.highlight_category_635 .pie,
          .highlight_category_635 .c100 .bar,
          .highlight_category_635 .c100 .fill,
          .highlight_category_635 a.more-link,
          .highlight_category_635 #submit,
          .highlight_category_635 input[type=submit],
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_635 a.active,
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_635 a:hover { border-color:#3a539b; }.badge a.category-635:after,
          .single .highlight_category_635 .tagcloud.badge a:after { border-left-color:#3a539b; }.badge a.category-635:before,
          .single .highlight_category_635 .tagcloud.badge a:before { border-right-color:#3a539b; }.badge a.category-1729,
          .highlight_category_1729 a.more-link:hover,
          .highlight_category_1729 .tagcloud.badge a,
          .highlight_category_1729 .widget .tagcloud a,
          .highlight_category_1729 .sharing a.post-share .sharecircle,
          .highlight_category_1729 input[type=submit]:hover,
          .highlight_category_1729 #submit:hover,
          .highlight_category_1729 .breakdown .line,
          .highlight_category_1729 .ie8 .c100,
          .highlight_category_1729 .ie8 .section .c100,
          .highlight_category_1729 .ie8 .section .inner-content .c100 { background:#22313f; }.highlight_category_1729 .postcontent p a,
          .tiny-details a.category-1729:hover,
          .highlight_category_1729 .commentwrapper p a,
          .highlight_category_1729 .singlecomment a:hover,
          .highlight_category_1729 #respond a:hover,
          .highlight_category_1729 .postcontent p a:hover,
          .highlight_category_1729 #share-box span,
          .highlight_category_1729 .breakdown .c100:hover > span,
          .highlight_category_1729 .reviewtop .c100:hover > span,
          .highlight_category_1729 .score,
          .highlight_category_1729 .tw-button,
          .highlight_category_1729 a.tw-button,
          .highlight_category_1729 a.button,
          .highlight_category_1729 a:hover,
          .highlight_category_1729 a.more-link,
          .highlight_category_1729 #submit,
          .highlight_category_1729 .tw-postshortcode a.more-link,
          .highlight_category_1729 input[type=submit],
          .highlight_category_1729 .authorinfo.not-full a:hover { color:#22313f; }.highlight_category_1729 .pie,
          .highlight_category_1729 .c100 .bar,
          .highlight_category_1729 .c100 .fill,
          .highlight_category_1729 a.more-link,
          .highlight_category_1729 #submit,
          .highlight_category_1729 input[type=submit],
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_1729 a.active,
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_1729 a:hover { border-color:#22313f; }.badge a.category-1729:after,
          .single .highlight_category_1729 .tagcloud.badge a:after { border-left-color:#22313f; }.badge a.category-1729:before,
          .single .highlight_category_1729 .tagcloud.badge a:before { border-right-color:#22313f; }.badge a.category-1732,
          .highlight_category_1732 a.more-link:hover,
          .highlight_category_1732 .tagcloud.badge a,
          .highlight_category_1732 .widget .tagcloud a,
          .highlight_category_1732 .sharing a.post-share .sharecircle,
          .highlight_category_1732 input[type=submit]:hover,
          .highlight_category_1732 #submit:hover,
          .highlight_category_1732 .breakdown .line,
          .highlight_category_1732 .ie8 .c100,
          .highlight_category_1732 .ie8 .section .c100,
          .highlight_category_1732 .ie8 .section .inner-content .c100 { background:#e67e22; }.highlight_category_1732 .postcontent p a,
          .tiny-details a.category-1732:hover,
          .highlight_category_1732 .commentwrapper p a,
          .highlight_category_1732 .singlecomment a:hover,
          .highlight_category_1732 #respond a:hover,
          .highlight_category_1732 .postcontent p a:hover,
          .highlight_category_1732 #share-box span,
          .highlight_category_1732 .breakdown .c100:hover > span,
          .highlight_category_1732 .reviewtop .c100:hover > span,
          .highlight_category_1732 .score,
          .highlight_category_1732 .tw-button,
          .highlight_category_1732 a.tw-button,
          .highlight_category_1732 a.button,
          .highlight_category_1732 a:hover,
          .highlight_category_1732 a.more-link,
          .highlight_category_1732 #submit,
          .highlight_category_1732 .tw-postshortcode a.more-link,
          .highlight_category_1732 input[type=submit],
          .highlight_category_1732 .authorinfo.not-full a:hover { color:#e67e22; }.highlight_category_1732 .pie,
          .highlight_category_1732 .c100 .bar,
          .highlight_category_1732 .c100 .fill,
          .highlight_category_1732 a.more-link,
          .highlight_category_1732 #submit,
          .highlight_category_1732 input[type=submit],
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_1732 a.active,
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_1732 a:hover { border-color:#e67e22; }.badge a.category-1732:after,
          .single .highlight_category_1732 .tagcloud.badge a:after { border-left-color:#e67e22; }.badge a.category-1732:before,
          .single .highlight_category_1732 .tagcloud.badge a:before { border-right-color:#e67e22; }.badge a.category-1825,
          .highlight_category_1825 a.more-link:hover,
          .highlight_category_1825 .tagcloud.badge a,
          .highlight_category_1825 .widget .tagcloud a,
          .highlight_category_1825 .sharing a.post-share .sharecircle,
          .highlight_category_1825 input[type=submit]:hover,
          .highlight_category_1825 #submit:hover,
          .highlight_category_1825 .breakdown .line,
          .highlight_category_1825 .ie8 .c100,
          .highlight_category_1825 .ie8 .section .c100,
          .highlight_category_1825 .ie8 .section .inner-content .c100 { background:#db0a5b; }.highlight_category_1825 .postcontent p a,
          .tiny-details a.category-1825:hover,
          .highlight_category_1825 .commentwrapper p a,
          .highlight_category_1825 .singlecomment a:hover,
          .highlight_category_1825 #respond a:hover,
          .highlight_category_1825 .postcontent p a:hover,
          .highlight_category_1825 #share-box span,
          .highlight_category_1825 .breakdown .c100:hover > span,
          .highlight_category_1825 .reviewtop .c100:hover > span,
          .highlight_category_1825 .score,
          .highlight_category_1825 .tw-button,
          .highlight_category_1825 a.tw-button,
          .highlight_category_1825 a.button,
          .highlight_category_1825 a:hover,
          .highlight_category_1825 a.more-link,
          .highlight_category_1825 #submit,
          .highlight_category_1825 .tw-postshortcode a.more-link,
          .highlight_category_1825 input[type=submit],
          .highlight_category_1825 .authorinfo.not-full a:hover { color:#db0a5b; }.highlight_category_1825 .pie,
          .highlight_category_1825 .c100 .bar,
          .highlight_category_1825 .c100 .fill,
          .highlight_category_1825 a.more-link,
          .highlight_category_1825 #submit,
          .highlight_category_1825 input[type=submit],
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_1825 a.active,
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_1825 a:hover { border-color:#db0a5b; }.badge a.category-1825:after,
          .single .highlight_category_1825 .tagcloud.badge a:after { border-left-color:#db0a5b; }.badge a.category-1825:before,
          .single .highlight_category_1825 .tagcloud.badge a:before { border-right-color:#db0a5b; }.badge a.category-4,
          .highlight_category_4 a.more-link:hover,
          .highlight_category_4 .tagcloud.badge a,
          .highlight_category_4 .widget .tagcloud a,
          .highlight_category_4 .sharing a.post-share .sharecircle,
          .highlight_category_4 input[type=submit]:hover,
          .highlight_category_4 #submit:hover,
          .highlight_category_4 .breakdown .line,
          .highlight_category_4 .ie8 .c100,
          .highlight_category_4 .ie8 .section .c100,
          .highlight_category_4 .ie8 .section .inner-content .c100 { background:#198964; }.highlight_category_4 .postcontent p a,
          .tiny-details a.category-4:hover,
          .highlight_category_4 .commentwrapper p a,
          .highlight_category_4 .singlecomment a:hover,
          .highlight_category_4 #respond a:hover,
          .highlight_category_4 .postcontent p a:hover,
          .highlight_category_4 #share-box span,
          .highlight_category_4 .breakdown .c100:hover > span,
          .highlight_category_4 .reviewtop .c100:hover > span,
          .highlight_category_4 .score,
          .highlight_category_4 .tw-button,
          .highlight_category_4 a.tw-button,
          .highlight_category_4 a.button,
          .highlight_category_4 a:hover,
          .highlight_category_4 a.more-link,
          .highlight_category_4 #submit,
          .highlight_category_4 .tw-postshortcode a.more-link,
          .highlight_category_4 input[type=submit],
          .highlight_category_4 .authorinfo.not-full a:hover { color:#198964; }.highlight_category_4 .pie,
          .highlight_category_4 .c100 .bar,
          .highlight_category_4 .c100 .fill,
          .highlight_category_4 a.more-link,
          .highlight_category_4 #submit,
          .highlight_category_4 input[type=submit],
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_4 a.active,
          .pagetitleloading .pagercontainer .bx-slider-pager .highlight_category_4 a:hover { border-color:#198964; }.badge a.category-4:after,
          .single .highlight_category_4 .tagcloud.badge a:after { border-left-color:#198964; }.badge a.category-4:before,
          .single .highlight_category_4 .tagcloud.badge a:before { border-right-color:#198964; }      </style>

<style type="text/css" title="dynamic-css" class="options-output">#logo, .top-ad, .regular-nav #menu, .regular-nav .searchnav{padding-top:25px;padding-bottom:25px;}.section .slidecaption .slidetitle,
                              .section .slidecaption h1,
                              .single-post .pagetitle .title,
                              #share-box h4{font-family:Lato;text-transform:uppercase;font-weight:900;font-style:normal;font-size:60px;}.grid .thumbovertext .title,
                       .carousel .carouselpost .thumbovertext .title,
                       .full-image-section .fullsection .title,
                       .single .no-full-image h1.title{font-family:Lato;text-transform:uppercase;font-weight:900;font-style:normal;font-size:44px;}.regulargrid .title,
                        .carousel.half-carousel .carouselpost .thumbovertext .title,
                        .halfgrid .thumbovertext .title,
                       .related .thumbovertext .title{font-family:Lato;text-transform:uppercase;font-weight:900;font-style:normal;font-size:28px;}.pagetitle .title,
                       #logo a,
                        .woocommerce-page .page-title,
                        .woocommerce div.product .product_title,
                       .full-post .full-image-section .fullsection .title{font-family:Lato;text-transform:uppercase;font-weight:900;font-style:normal;font-size:32px;}.pagertitle, .full-taxonomy .fullsection .subtitle, .pagetitle .subheadline{font-family:Lato;font-weight:300;font-style:normal;}.section-title span,
		        .woocommerce .entry-content h2,
		        .woocommerce-cart h2,
		        .woocommerce .related.products h2,
		        .woocommerce-checkout h2,
		        .widget h3.widget-title,
		        .widget h2.widget-title,
		        .widget h4.widget-title{font-family:Lato;text-transform:uppercase;letter-spacing:1px;font-weight:700;font-style:normal;}.sf-menu li > a{font-family:Lato;text-transform:uppercase;letter-spacing:1px;font-weight:normal;font-style:normal;font-size:12px;}.tiny-details, .badge, .badge a, .thumboverdate,
		        .badgesliver, .sharing a .sharetitle, a.button.outline,
		        .woocommerce a.button, .woocommerce div.product form.cart .button,
		        .woocommerce button, .woocommerce button.button,
		        .woocommerce .added_to_cart.wc-forward,
		        .woocommerce #respond input#submit, .woocommerce input.button,
		        a.more-link, .tagcloud.badge h5,
		        a.post-edit-link, .tabswrap ul.tabs li a,
		        ul.sf-menu li.megamenu .menu-item-type-custom > a,
		        ul.sf-menu li.megamenu .menu-item-type-custom .menu-item-type-custom > a,
		        .breaking, .breaking-title, .divider span, cite,
		        #breadcrumbs li, .woocommerce .woocommerce-breadcrumb{font-family:Lato;text-transform:uppercase;letter-spacing:2px;font-weight:400;font-style:normal;font-size:10px;}h1, .postcontent.no-review > p:first-child:first-letter{font-family:Lato;font-weight:300;font-style:normal;font-size:58px;}h2, blockquote, blockquote p{font-family:Lato;font-weight:300;font-style:normal;font-size:28px;}h3, .woocommerce ul.products li.product h3, .woocommerce h3 label{font-family:Lato;font-weight:400;font-style:normal;font-size:22px;}h4, h5, h6{font-family:Lato;font-weight:700;font-style:normal;}p, ul, ol, body, h4.review-title{font-family:Lato;font-weight:400;font-style:normal;font-size:16px;}</style><meta data-pso-pv="1.2.1" data-pso-pt="singlePost" data-pso-th="7000cba5b46c678a508398c6f0d1b879"></head>
<body class="post-template-default single single-post postid-31905 single-format-standard edition desktop-device altnav gecko linux edition child theme sticky-nav-enabled">
<div class="mm-page">
<div id="preloaded-images">
<img src="http://polymerhk.com/wp-content/themes/edition/images/loading-spin.svg" width="1" height="1" alt="Image" />
</div>

<div class="top-bar">
<div class="container">
<div class="topbar-left">

<div class="breaking range-weekly tw-vertical">

<div class="breaking-title">
熱門文章 </div>

<div class="breaking-ticker">
<ul class="news-ticker tw-vertical" data-delay="6" data-animation="vertical">
<li><a href="http://polymerhk.com/articles/2016/06/26/32425/" title="犯罪心理檔案系列(1)：你知道誰在悄悄跟蹤你嗎？">犯罪心理檔案系列(1)：你知道誰在悄悄跟蹤你嗎？... </a></li>
<li><a href="http://polymerhk.com/articles/2016/03/01/28852/" title="君子喻於義 小人喻於利">君子喻於義 小人喻於利</a></li>
<li><a href="http://polymerhk.com/articles/2016/06/09/32020/" title="好筆要玩：斷血流．硬橡膠羽觸">好筆要玩：斷血流．硬橡膠羽觸</a></li>
<li><a href="http://polymerhk.com/articles/2015/08/09/19387/" title="識寫禱文嘅一定係用粵文">識寫禱文嘅一定係用粵文</a></li>
</ul>
</div>
</div>
<script>
						jQuery(document).ready(function() {
							(function($){
								var newsticker = $('.news-ticker'),
									$delay 		= parseInt(newsticker.attr('data-delay') + '000'),
									$animation 	= newsticker.attr('data-animation');

								if ($animation == 'scroll') {
									$ticker = newsticker.bxSlider({
										useCSS: false,
										pager: false,
										ticker: true,
										tickerHover: true,
										autoHover: true,
										speed: $delay * 4
									});
								} else {
									$ticker = newsticker.bxSlider({
										useCSS: false,
										autoHover: true,
										mode: $animation,
										auto: true,
										pager: false,
										pause: $delay
									});
								}
							})(jQuery);
						});
					</script>
</div>
<div class="topbar-right">
<a href="https://www.facebook.com/GaldenPolymer" class="" target="_blank"><i class="fa fa-facebook"></i></a><a href="https://twitter.com/GaldenPolymer" class="" target="_blank"><i class="fa fa-twitter"></i></a><a href="https://plus.google.com/+Polymerhk" class="" target="_blank"><i class="fa fa-google-plus-square"></i></a><a href="https://www.instagram.com/hkpolymer/" class="" target="_blank"><i class="fa fa-instagram"></i></a> </div>
</div>
</div>

<div class="top-nav altnav">
<div class="container top-nav-inner">

<div id="logo">
<h2> <a href="http://polymerhk.com">
<span class="logosizer" class="retina" style="max-width: 300px">
<img src="http://polymerhk.com/wp-content/uploads/2016/01/polymer_logo.png" alt="聚言時報 Polymer" />
</span>
</a>
</h2>
</div>

<div class="mobile-link table-cell">
<a href="#mobilemenu"><i class="fa fa-bars"></i></a>
</div>
<div class="top-ad">
<div class="alignright">
  <script language="JavaScript"> var zflag_nid="1044"; var zflag_cid="2386/2385"; var zflag_sid="512"; var zflag_width="728"; var zflag_height="90"; var zflag_sz="14"; </script> <script language="JavaScript" src="//d8.zedo.com/jsc/d8/fo.js"></script>  </div>
<div class="clear"></div>
</div>
</div>
<div class="altcontainer">
<div class="container">

<div id="menu">
<ul id="menu-polymer_top" class="sf-menu"><li id="menu-item-41" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-41"><a href="http://polymerhk.com/articles/category/%e6%99%82%e5%a0%b1%e6%9c%88%e5%88%8a/">Polymer 月刊</a>
<ul class="sub-menu">
<li id="menu-item-25200" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-25200"><a href="https://issuu.com/galdenpolymer">issuu 網上閱讀</a></li>
<li id="menu-item-26413" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-26413"><a href="#">2016年</a>
<ul class="sub-menu">
<li id="menu-item-32840" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-32840"><a href="http://polymerhk.com/articles/2016/07/06/32795/">七月號/2016</a></li>
<li id="menu-item-32841" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-32841 customsection"><a href="http://polymerhk.com/articles/2016/06/07/31884/">六月號/2016</a></li>
<li id="menu-item-31596" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-31596 customsection"><a href="http://polymerhk.com/articles/category/%e6%99%82%e5%a0%b1%e6%9c%88%e5%88%8a/%e4%ba%94%e6%9c%88%e8%99%9f2016/">五月號/2016</a></li>
<li id="menu-item-30036" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-30036 customsection"><a href="http://polymerhk.com/articles/2016/04/04/29979/">四月號/2016</a></li>
<li id="menu-item-29822" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-29822 customsection"><a href="http://polymerhk.com/articles/2016/03/13/29190/">三月號/2016</a></li>
<li id="menu-item-29089" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-29089 customsection"><a href="http://polymerhk.com/articles/2016/02/05/27492/">二月號/2016</a></li>
<li id="menu-item-26412" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-26412 customsection"><a href="http://polymerhk.com/articles/2016/01/09/26197/">一月號/2016</a></li>
</ul>
</li>
<li id="menu-item-25043" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-25043"><a href="#">2015年</a>
<ul class="sub-menu">
<li id="menu-item-25042" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-25042"><a href="/articles/2015/12/04/24981/">十二月號/2015</a></li>
<li id="menu-item-23798" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-23798"><a href="/articles/2015/11/04/23780/">十一月號/2015</a></li>
<li id="menu-item-22314" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-22314"><a href="/articles/2015/10/04/22308/">十月號/2015</a></li>
<li id="menu-item-19636" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-19636"><a href="/articles/2015/08/13/19535/">八月號/2015</a></li>
<li id="menu-item-17957" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-17957"><a href="/articles/2015/07/04/17946/">七月號/2015</a></li>
<li id="menu-item-16524" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-16524"><a href="/articles/2015/06/03/16412/">六月號/2015</a></li>
<li id="menu-item-15488" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-15488"><a href="/articles/2015/05/05/15396/">五月號/2015</a></li>
<li id="menu-item-14303" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-14303"><a href="/articles/2015/04/05/14239/">四月號/2015</a></li>
<li id="menu-item-13318" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-13318"><a href="/articles/2015/03/05/13262/">三月號/2015</a></li>
<li id="menu-item-11972" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-11972"><a href="/articles/2015/02/05/11941/">二月號/2015</a></li>
<li id="menu-item-10415" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-10415"><a href="/articles/2015/01/04/10349/">一月號/2015</a></li>
</ul>
</li>
<li id="menu-item-25044" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-25044"><a href="#">2014年</a>
<ul class="sub-menu">
<li id="menu-item-10460" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-10460"><a href="/articles/2014/12/05/9254/">十二月號/2014</a></li>
<li id="menu-item-8310" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-8310"><a href="/articles/2014/11/04/8185/">十一月號/2014</a></li>
<li id="menu-item-8315" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-8315"><a href="https://www.facebook.com/GaldenPolymer/photos/a.382761165184419.1073741826.374401906020345/568411076619426/?type=1&#038;permPage=1">十月刊 (從缺)</a></li>
<li id="menu-item-6491" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6491"><a href="/articles/2014/09/04/6104/">九月號/2014</a></li>
<li id="menu-item-4799" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4799"><a href="/articles/2014/08/04/4769/">八月號/2014</a></li>
<li id="menu-item-4798" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4798"><a href="/articles/2014/07/12/4172/">七月號/2014</a></li>
<li id="menu-item-3612" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3612"><a href="/articles/2014/06/05/3568/">六月號/2014</a></li>
<li id="menu-item-6520" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6520"><a href="/articles/2014/05/04/6515/">五月號/2014</a></li>
<li id="menu-item-2675" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2675"><a href="/articles/2014/04/05/2410/">四月號/2014</a></li>
<li id="menu-item-1320" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1320"><a href="/articles/2014/03/06/1183/">三月號/2014</a></li>
<li id="menu-item-672" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-672"><a href="/articles/2014/02/04/624/">二月號/2014</a></li>
<li id="menu-item-459" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-459"><a href="/articles/2014/01/04/268/">一月號/2014</a></li>
</ul>
</li>
<li id="menu-item-25045" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-25045"><a href="#">2013年</a>
<ul class="sub-menu">
<li id="menu-item-42" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-42 customsection"><a href="http://polymerhk.com/articles/category/%e6%99%82%e5%a0%b1%e6%9c%88%e5%88%8a/%e5%8d%81%e4%ba%8c%e6%9c%88%e8%99%9f2013/">十二月號/2013</a></li>
<li id="menu-item-74" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-74 customsection"><a href="http://polymerhk.com/articles/category/%e6%99%82%e5%a0%b1%e6%9c%88%e5%88%8a/%e5%8d%81%e4%b8%80%e6%9c%88%e8%99%9f2013/">十一月號/2013</a></li>
<li id="menu-item-43" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-43 customsection"><a href="http://polymerhk.com/articles/category/%e6%99%82%e5%a0%b1%e6%9c%88%e5%88%8a/%e5%8d%81%e6%9c%88%e5%89%b5%e5%88%8a%e8%99%9f2013/">十月創刊號/2013</a></li>
</ul>
</li>
<li id="menu-item-6497" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-6497"><a href="#">特刊 Special Issue</a>
<ul class="sub-menu">
<li id="menu-item-21361" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-21361"><a href="/articles/2015/09/15/21237/">【香港人的未來】文集/2015</a></li>
<li id="menu-item-6496" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6496"><a href="http://polymerhk.com/special_71_2014/">膠登時報七一特刊/2014</a></li>
<li id="menu-item-87" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-87 customsection"><a href="http://polymerhk.com/articles/category/special/%e9%9b%99%e5%8d%81%e7%89%b9%e5%88%8a2013/">雙十特刊/2013</a></li>
</ul>
</li>
</ul>
</li>
<li id="menu-item-226" class="menu-item menu-item-type-taxonomy menu-item-object-category current-post-ancestor current-menu-parent current-post-parent menu-item-226 customsection"><a href="http://polymerhk.com/articles/category/local-hk/">本地</a></li>
<li id="menu-item-228" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-228 customsection"><a href="http://polymerhk.com/articles/category/worldwide/">國際</a></li>
<li id="menu-item-225" class="menu-item menu-item-type-taxonomy menu-item-object-category current-post-ancestor current-menu-parent current-post-parent menu-item-has-children menu-item-225 customsection"><a href="http://polymerhk.com/articles/category/lifestyle/">生活文化</a>
<ul class="sub-menu">
<li id="menu-item-10986" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-10986 customsection"><a href="http://polymerhk.com/articles/category/%e7%a7%91%e6%8a%80/">科技</a></li>
<li id="menu-item-12583" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-12583 customsection"><a href="http://polymerhk.com/articles/category/sport/">體育</a></li>
<li id="menu-item-25845" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-25845 customsection"><a href="http://polymerhk.com/articles/category/lifestyle/mtr-failure-report/">港鐵故障記事錄</a></li>
<li id="menu-item-24213" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-24213 customsection"><a href="http://polymerhk.com/articles/category/lifestyle/%e7%9f%ad%e7%af%87%e5%b0%8f%e8%aa%aa/">短篇小說</a></li>
<li id="menu-item-23147" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-23147 customsection"><a href="http://polymerhk.com/articles/category/lifestyle/%e6%8e%a2%e8%b3%be%e5%af%ab%e9%9a%b1/">探賾寫隱</a></li>
</ul>
</li>
<li id="menu-item-22570" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-22570 customsection"><a href="http://polymerhk.com/articles/category/%e7%a5%9e%e7%a7%98%e5%ad%b8/">神秘學</a>
<ul class="sub-menu">
<li id="menu-item-22569" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-22569 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e4%b8%96%e7%95%8c%e6%b7%b1%e8%99%95%e7%9a%84%e5%bc%95%e8%b7%af%e8%80%85/">世界深處的引路者</a></li>
<li id="menu-item-4573" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4573 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e6%81%90%e6%87%bc%e9%b3%a5-scary-bird/">恐懼蒐集家</a></li>
<li id="menu-item-23061" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-23061 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e8%b6%85%e8%87%aa%e7%84%b6%e6%8e%a2%e7%b4%a2%e8%80%85/">超自然探索者</a></li>
<li id="menu-item-25476" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-25476 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/oworld_apocalypse/">異界默示錄</a></li>
</ul>
</li>
<li id="menu-item-35112" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-35112 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e9%a6%99%e6%b8%af%e6%b0%91%e6%97%8f%e9%bb%a8-%e3%80%8a%e7%9c%be%e8%ad%b0%e3%80%8b/">香港民族黨—《眾議》</a></li>
<li id="menu-item-1306" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-1306 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/">專欄</a>
<ul class="sub-menu">
<li id="menu-item-1773" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1773 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e8%86%a0%e7%99%bb%e9%9f%b3%e6%a8%82%e5%8f%b0/">膠登音樂台</a></li>
<li id="menu-item-4510" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-4510 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e8%82%9d%e9%86%a3%e7%88%86%e8%a3%82/">肝醣爆裂</a>
<ul class="sub-menu">
<li id="menu-item-25336" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-25336 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e9%98%bf%e7%be%a4%e5%b8%b6%e8%b7%af/">阿群帶路</a></li>
</ul>
</li>
<li id="menu-item-1308" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1308 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/zannanza-%e6%8a%98%e7%bf%bc%e7%9a%84%e4%bc%8a%e5%8d%a1%e6%b4%9b%e6%96%af/">Zannanza &#8211; 折翼的伊卡洛斯</a></li>
<li id="menu-item-1790" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1790 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e8%b2%a7%e5%8f%8b%e6%97%a5%e8%a8%98%e6%bc%ab%e7%95%ab-%e5%91%80%e5%b0%87/">貧友日記漫畫 – 呀將</a></li>
<li id="menu-item-6524" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-6524 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e5%a4%a7%e6%9c%89%e6%8c%87%e5%8d%97%e8%a1%8c/">大有指南行</a></li>
<li id="menu-item-21019" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-21019 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/hermit-city/">大隱隱於市</a></li>
<li id="menu-item-22394" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-22394 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/fanf_swater/">風流屎水</a></li>
<li id="menu-item-29911" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-29911 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e9%a6%99%e6%b8%af%e4%ba%ba%e8%ab%96/">香港人論</a></li>
<li id="menu-item-27915" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-27915 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/chua-chua/">擦膠仔Chua Chua</a></li>
<li id="menu-item-30840" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-30840 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/kow-loon-road/">九龍論道</a></li>
<li id="menu-item-32590" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-32590 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/cantonia/">萬馬歸元</a></li>
<li id="menu-item-35545" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-35545 customsection"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/openroom/">OpenRoom</a></li>
</ul>
</li>
<li id="menu-item-50" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-50 customsection"><a href="http://polymerhk.com/%e6%8a%95%e7%a8%bf/">我想投稿</a></li>
<li id="menu-item-22317" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-22317 customsection"><a href="http://polymerhk.com/%e8%83%8c%e6%99%af%e5%8f%8a%e5%ae%97%e6%97%a8/">關於 Polymer</a>
<ul class="sub-menu">
<li id="menu-item-12615" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12615 customsection"><a href="http://polymerhk.com/%e8%83%8c%e6%99%af%e5%8f%8a%e5%ae%97%e6%97%a8/">背景及宗旨</a></li>
<li id="menu-item-12614" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12614 customsection"><a href="http://polymerhk.com/%e7%89%88%e6%ac%8a%e5%8f%8a%e5%85%8d%e8%b2%ac%e8%81%b2%e6%98%8e/">版權及免責聲明</a></li>
<li id="menu-item-14206" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-14206 customsection"><a href="http://polymerhk.com/donation/">贊助聚言時報</a></li>
<li id="menu-item-12612" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12612 customsection"><a href="http://polymerhk.com/%e5%8f%8b%e5%a5%bd%e9%80%a3%e7%b5%90/">友好連結</a></li>
<li id="menu-item-12616" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12616 customsection"><a href="http://polymerhk.com/%e8%a8%82%e9%96%b1%e5%8f%8a%e8%81%af%e7%b5%a1/">訂閱及聯絡</a></li>
</ul>
</li>
</ul>

<div class="searchnav">

<div class="search-form search">
<form role="search" method="get" name="SearchForm" class="search-form" action="http://polymerhk.com/">
<label>
<input type="search" class="search-field" placeholder="搜尋文章..." value="" name="s" title="搜尋文章..." />
</label>
</form>
<i class="fa fa-search searchbutton"></i>
</div>
 </div>
<div class="clear"></div>
</div>

</div>
<div class="clear"></div>
</div>
</div>

<nav id="mobilemenu">
<ul><li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-41"><a href="http://polymerhk.com/articles/category/%e6%99%82%e5%a0%b1%e6%9c%88%e5%88%8a/">Polymer 月刊</a>
<ul class="sub-menu">
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-25200"><a href="https://issuu.com/galdenpolymer">issuu 網上閱讀</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-26413"><a href="#">2016年</a>
<ul class="sub-menu">
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-32840"><a href="http://polymerhk.com/articles/2016/07/06/32795/">七月號/2016</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-post menu-item-32841"><a href="http://polymerhk.com/articles/2016/06/07/31884/">六月號/2016</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-31596"><a href="http://polymerhk.com/articles/category/%e6%99%82%e5%a0%b1%e6%9c%88%e5%88%8a/%e4%ba%94%e6%9c%88%e8%99%9f2016/">五月號/2016</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-post menu-item-30036"><a href="http://polymerhk.com/articles/2016/04/04/29979/">四月號/2016</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-post menu-item-29822"><a href="http://polymerhk.com/articles/2016/03/13/29190/">三月號/2016</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-post menu-item-29089"><a href="http://polymerhk.com/articles/2016/02/05/27492/">二月號/2016</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-post menu-item-26412"><a href="http://polymerhk.com/articles/2016/01/09/26197/">一月號/2016</a></li>
</ul>
</li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-25043"><a href="#">2015年</a>
<ul class="sub-menu">
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-25042"><a href="/articles/2015/12/04/24981/">十二月號/2015</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-23798"><a href="/articles/2015/11/04/23780/">十一月號/2015</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-22314"><a href="/articles/2015/10/04/22308/">十月號/2015</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-19636"><a href="/articles/2015/08/13/19535/">八月號/2015</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-17957"><a href="/articles/2015/07/04/17946/">七月號/2015</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-16524"><a href="/articles/2015/06/03/16412/">六月號/2015</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-15488"><a href="/articles/2015/05/05/15396/">五月號/2015</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-14303"><a href="/articles/2015/04/05/14239/">四月號/2015</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-13318"><a href="/articles/2015/03/05/13262/">三月號/2015</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-11972"><a href="/articles/2015/02/05/11941/">二月號/2015</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-10415"><a href="/articles/2015/01/04/10349/">一月號/2015</a></li>
</ul>
</li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-25044"><a href="#">2014年</a>
<ul class="sub-menu">
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-10460"><a href="/articles/2014/12/05/9254/">十二月號/2014</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-8310"><a href="/articles/2014/11/04/8185/">十一月號/2014</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-8315"><a href="https://www.facebook.com/GaldenPolymer/photos/a.382761165184419.1073741826.374401906020345/568411076619426/?type=1&#038;permPage=1">十月刊 (從缺)</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6491"><a href="/articles/2014/09/04/6104/">九月號/2014</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4799"><a href="/articles/2014/08/04/4769/">八月號/2014</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4798"><a href="/articles/2014/07/12/4172/">七月號/2014</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3612"><a href="/articles/2014/06/05/3568/">六月號/2014</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6520"><a href="/articles/2014/05/04/6515/">五月號/2014</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2675"><a href="/articles/2014/04/05/2410/">四月號/2014</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1320"><a href="/articles/2014/03/06/1183/">三月號/2014</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-672"><a href="/articles/2014/02/04/624/">二月號/2014</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-459"><a href="/articles/2014/01/04/268/">一月號/2014</a></li>
</ul>
</li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-25045"><a href="#">2013年</a>
<ul class="sub-menu">
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-42"><a href="http://polymerhk.com/articles/category/%e6%99%82%e5%a0%b1%e6%9c%88%e5%88%8a/%e5%8d%81%e4%ba%8c%e6%9c%88%e8%99%9f2013/">十二月號/2013</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-74"><a href="http://polymerhk.com/articles/category/%e6%99%82%e5%a0%b1%e6%9c%88%e5%88%8a/%e5%8d%81%e4%b8%80%e6%9c%88%e8%99%9f2013/">十一月號/2013</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-43"><a href="http://polymerhk.com/articles/category/%e6%99%82%e5%a0%b1%e6%9c%88%e5%88%8a/%e5%8d%81%e6%9c%88%e5%89%b5%e5%88%8a%e8%99%9f2013/">十月創刊號/2013</a></li>
</ul>
</li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-6497"><a href="#">特刊 Special Issue</a>
<ul class="sub-menu">
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-21361"><a href="/articles/2015/09/15/21237/">【香港人的未來】文集/2015</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6496"><a href="http://polymerhk.com/special_71_2014/">膠登時報七一特刊/2014</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-87"><a href="http://polymerhk.com/articles/category/special/%e9%9b%99%e5%8d%81%e7%89%b9%e5%88%8a2013/">雙十特刊/2013</a></li>
</ul>
</li>
</ul>
</li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category current-post-ancestor current-menu-parent current-post-parent menu-item-226"><a href="http://polymerhk.com/articles/category/local-hk/">本地</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-228"><a href="http://polymerhk.com/articles/category/worldwide/">國際</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category current-post-ancestor current-menu-parent current-post-parent menu-item-has-children menu-item-225"><a href="http://polymerhk.com/articles/category/lifestyle/">生活文化</a>
<ul class="sub-menu">
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-10986"><a href="http://polymerhk.com/articles/category/%e7%a7%91%e6%8a%80/">科技</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-12583"><a href="http://polymerhk.com/articles/category/sport/">體育</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-25845"><a href="http://polymerhk.com/articles/category/lifestyle/mtr-failure-report/">港鐵故障記事錄</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-24213"><a href="http://polymerhk.com/articles/category/lifestyle/%e7%9f%ad%e7%af%87%e5%b0%8f%e8%aa%aa/">短篇小說</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-23147"><a href="http://polymerhk.com/articles/category/lifestyle/%e6%8e%a2%e8%b3%be%e5%af%ab%e9%9a%b1/">探賾寫隱</a></li>
</ul>
</li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-22570"><a href="http://polymerhk.com/articles/category/%e7%a5%9e%e7%a7%98%e5%ad%b8/">神秘學</a>
<ul class="sub-menu">
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-22569"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e4%b8%96%e7%95%8c%e6%b7%b1%e8%99%95%e7%9a%84%e5%bc%95%e8%b7%af%e8%80%85/">世界深處的引路者</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4573"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e6%81%90%e6%87%bc%e9%b3%a5-scary-bird/">恐懼蒐集家</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-23061"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e8%b6%85%e8%87%aa%e7%84%b6%e6%8e%a2%e7%b4%a2%e8%80%85/">超自然探索者</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-25476"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/oworld_apocalypse/">異界默示錄</a></li>
</ul>
</li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-35112"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e9%a6%99%e6%b8%af%e6%b0%91%e6%97%8f%e9%bb%a8-%e3%80%8a%e7%9c%be%e8%ad%b0%e3%80%8b/">香港民族黨—《眾議》</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-1306"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/">專欄</a>
<ul class="sub-menu">
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1773"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e8%86%a0%e7%99%bb%e9%9f%b3%e6%a8%82%e5%8f%b0/">膠登音樂台</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-4510"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e8%82%9d%e9%86%a3%e7%88%86%e8%a3%82/">肝醣爆裂</a>
<ul class="sub-menu">
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-25336"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e9%98%bf%e7%be%a4%e5%b8%b6%e8%b7%af/">阿群帶路</a></li>
</ul>
</li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1308"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/zannanza-%e6%8a%98%e7%bf%bc%e7%9a%84%e4%bc%8a%e5%8d%a1%e6%b4%9b%e6%96%af/">Zannanza &#8211; 折翼的伊卡洛斯</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1790"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e8%b2%a7%e5%8f%8b%e6%97%a5%e8%a8%98%e6%bc%ab%e7%95%ab-%e5%91%80%e5%b0%87/">貧友日記漫畫 – 呀將</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-6524"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e5%a4%a7%e6%9c%89%e6%8c%87%e5%8d%97%e8%a1%8c/">大有指南行</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-21019"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/hermit-city/">大隱隱於市</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-22394"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/fanf_swater/">風流屎水</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-29911"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/%e9%a6%99%e6%b8%af%e4%ba%ba%e8%ab%96/">香港人論</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-27915"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/chua-chua/">擦膠仔Chua Chua</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-30840"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/kow-loon-road/">九龍論道</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-32590"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/cantonia/">萬馬歸元</a></li>
<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-35545"><a href="http://polymerhk.com/articles/category/%e5%b0%88%e6%ac%84/openroom/">OpenRoom</a></li>
</ul>
</li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-50"><a href="http://polymerhk.com/%e6%8a%95%e7%a8%bf/">我想投稿</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-22317"><a href="http://polymerhk.com/%e8%83%8c%e6%99%af%e5%8f%8a%e5%ae%97%e6%97%a8/">關於 Polymer</a>
<ul class="sub-menu">
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12615"><a href="http://polymerhk.com/%e8%83%8c%e6%99%af%e5%8f%8a%e5%ae%97%e6%97%a8/">背景及宗旨</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12614"><a href="http://polymerhk.com/%e7%89%88%e6%ac%8a%e5%8f%8a%e5%85%8d%e8%b2%ac%e8%81%b2%e6%98%8e/">版權及免責聲明</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-14206"><a href="http://polymerhk.com/donation/">贊助聚言時報</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12612"><a href="http://polymerhk.com/%e5%8f%8b%e5%a5%bd%e9%80%a3%e7%b5%90/">友好連結</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12616"><a href="http://polymerhk.com/%e8%a8%82%e9%96%b1%e5%8f%8a%e8%81%af%e7%b5%a1/">訂閱及聯絡</a></li>
</ul>
</li>
</ul> </nav>

<div id="sitecontainer">

<div class="has-sidebar has-thumbnail has-full-image no-review no-sharing author-box-enabled related-enabled no-dropcap highlight_category_23 post-31905 post type-post status-publish format-standard has-post-thumbnail hentry category-local-hk category-lifestyle category-120 tag-711 tag-2601 tag-3214">

<div class="pagetitleloading background-imaged loading-dark">
<div class="pagetitle item imagewrapper full-image">

<div class="imagecover">
<img src="https://i0.wp.com/polymerhk.com/wp-content/uploads/2016/06/4934555.jpg?fit=700%2C398" alt="" class="top-bg-image" style="opacity:0;" onload="jQuery(this).animate({'opacity': '1'}, 500);" />
</div>

<div class="overlay"></div>

<div class="posttitle slidecaptionwrap">
<div class="slidecaptioncenter container">
<div class="slidecaption">
<div class="col-md-8">

<div class="badge"><a href="http://polymerhk.com/articles/category/local-hk/" class="category-23" title="More 本地 Posts">本地</a><a href="http://polymerhk.com/articles/category/lifestyle/" class="category-25" title="More 生活文化 Posts">生活文化</a><a href="http://polymerhk.com/articles/category/%e6%8a%95%e7%a8%bf/" class="category-120" title="More 投稿 Posts">投稿</a><div class="clear"></div></div>

<h1 class="title entry-title">
港人奴性指數 </h1>

<div class="byline">

<img src="https://i1.wp.com/polymerhk.com/wp-content/uploads/2016/06/dsc_3884.jpg?fit=32%2C38" width="32" height="38" alt="胡迪" class="avatar avatar-38 wp-user-avatar wp-user-avatar-38 alignnone photo" />

<span class="author vcard tiny-details">
By
<span class="fn">
<a href="http://polymerhk.com/articles/author/woody/" title="由 胡迪 發表" rel="author">胡迪</a> </span>
<span class="mobiledate">
<span class="tw-bullet">&nbsp;&bull;&nbsp;</span>
2 年 ago </span>
</span>
</div>
</div>
 </div>
</div>
</div>


<span></span>
<div class="date updated">
<span class="day">
06 </span>
<p>
<span class="month">
六月 </span>
<br />
<span class="year">
2016 </span>
</p>
</div>
</div>
</div>

<div class="container">
<div class="rightside">
<div class="postcontentwrap">
<div class="rightcontent">
<div class="postcontent content">
<div class="poldes-googletop" id="poldes-477231827"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle" style="display:inline-block;width:300px;height:250px;" data-ad-client="ca-pub-2900580706071663" data-ad-slot="1337634436"></ins>
<script> 
(adsbygoogle = window.adsbygoogle || []).push({}); 
</script>
</div><p>澳洲人權組織「自由行基金會」《全球奴隸指數》報告，指出香港政府是反奴役最不積極政府之一，有人說港豬的心態就是奴隸的象徵，而同時又出現90後見工與職場奴性的討論。</p>
<p>馬克思指異化是資本主義的結果。作為一個資本主義社會，香港人的階級觀念十分強烈，資本家主導了市場和社會的權力，無產階級成為了他們的工具，馬克思指，工人失去對工作的控制，在工作上沒有自主。因此在資本主義市場下，勞動階層的存在變成了資本家的工具，習慣了「被控制」。馬克思認為無產階級與資產階級在本質上應互相敵對，因為資本家的利益與工人的利益存在矛盾。長年累月的思想教育，社會上宣揚的普世價值要人滿足於「安定繁榮」，就以香港為例，香港人最自豪的獅子山精神叫人刻苦、忍耐，於是他們在受到剝削、不公平對待時也只會忍耐，失去了抗爭的意慾，本來應對立的勞資關係變成了純粹服從的「主僕關係」，無產階級自願地成為別人的奴隸，而這群人在社會上卻是「大多數」。更可怕的是，當無產階級中有人奮起抗爭時，這群奴性重的人反而維護資產階級的一方，馬克思主義者認為，這些與資產階級合作的人被稱作「資產階級的走狗」。</p>
<p>雨傘革命其間，反對佔領的人說：「佢地阻住我返工」，這種話反映了人在長時間受到控制甚至壓迫的情況下，將自己變成了奴隸，形成異化。他們失卻了自己身為人本來的意義，亦忘記了自己工作的目的，認為自己的存在就是為了「返工」，如同馬克思的異化論所說，工人從來都不是自主、自我實現的人類存在，他只能以資產階級欲其所是的模式而存在。在異化的過程中，工人不但對自己的存在意義扭曲，更甚者，他們會要求別人異化，這是畸型的社會中出現的奴性思維。</p>
<p><strong>奴性的特徵</strong></p>
<p>網上有一篇文章《奴性的三個特徵》，三個特徵分別是：缺乏獨立思想、缺乏平等精神、對權力頂禮膜拜。缺乏平等精神很易理解，就是有很重的階級觀念，奴性重的人都會認為自己比較低等。從社會的結構上看，當權者定立種種規條，最主要是令人服從於制度之下，易於控制。文章以中國為例，指缺乏獨立的思想是二千多年愚民統治的結果，獨尊儒術，一家思想獨霸天下，人民只能接受當權者規定的思想，否則就會受到懲罰。這種情況在中國以外也一樣，跟隨制度、守規矩成為了「公民」的首要條件，亦是當權者最喜歡用來控制人的方法，令人不懂得反抗，最後失去了獨立思考。沒有獨立思考的人，無法在工作中尋回自己的價值，他們為求穩定，只會盲目跟從上級的指示，將自己變成奴隸。因此，奴性思維的形成其實不難理解。</p>
<p>電影《出埃及記》也有對奴性思維的批判，主角（任達華飾）做出超過了自己職責範圍的工作後，受到上司打壓。電影中用樓梯作為場景，暗示詹建業與上司的階級關係，從兩人的對話以及其中一幕顯示的字句「我會做好呢份工」，表達人對工作沒有自主權的無奈，一旦不服從上級的指令，就是對權力作出反抗。<br />
這種對權力的反抗不一定有效，電影《作死不離三兄弟》就有以下情節，一名學生因為要造出自己的發明而耽誤了功課，此事不被校長接受，學生最後自殺。無論在工作上以至教育制度也一樣，人都受制於上層定下的「框框」，當作出反抗的行為時，就被視為挑戰制度、挑戰權威的表現。而這種階級差距的恐懼與無力感則再度加重人的奴性，迫使人屈居於制度之下。</p>
<p>《奴性的三個特徵》指出人對權力頂禮膜拜有兩個原因，第一是官本位意識，當官成為人生追求的最高目標，權力成為圖騰。第二是權力的殘酷，人民對權力的恐懼，久而久之，恐懼與無奈轉化成敬畏。權力多數集中在政府的領袖或精英身上，形成了威權主義。威權主義指政府要求人民絕對服從其權威，而不是個人的思想和行動自由，簡單來說就是掌握權力，壓抑人民的一方。有人說，學校是社會的縮影，這樣《作死不離三兄弟》中的校長就是當權者的角色，學生所接受的教育就是當權者要人民遵守的規則。學生長時間被灌輸單一的思想、價值觀後，沒有獨立自主的人形同物件，失去自身價值的人形同異化。</p>
<p><strong>奴性與教育</strong></p>
<p>說到教育的意義，Pink Floyd 的Another brick in the wall 一曲說出了重點，歌詞是說: “We don&#8217;t need no education We don&#8217;t need no thought control” 我們不需要教育，不需要思想控制。現代社會的教育制度就是要人服從，學校訂立種種校規，教育學生要守規矩，即是說，一個人成長的頭十幾年，就是要你異化的階段，學生成為同一制度下的產物，失去了自我、個人的獨特性。完成了教育階段後 “All in all you&#8217;re just another brick in the wall”學生就成為了牆上的另一塊磚頭。馬克思認為資本主義社會造成異化，因為每個人藉着勞動為社會添磚加瓦，每個個體只是工具。原來教育已經是無產階級面臨異化的第一步，然而學生在成長時期被洗腦，失去獨立思想又正是《奴性的三個特徵》的第一點，可見整個社會制度就是把人民培育成奴隸。</p>
<p>在教育問題上，李怡先生認為「問」比「學」更重要，他指法國會考的哲學考題是考察年輕心靈的深刻程度，能刺激他們思考，認識到人生有不同的做法和想法。考題使人感受到社會對某些價值的重視與維護，也是對年輕人的尊重。填鴨式教育制度不會設這種考試。反過來說，填鴨式教育就是對學生批判思考的阻礙，它將同一思考模式，完完整整地對學生進行洗腦，造出一批又一批沒有獨特性的人。</p>
<p>假如身為教師也重奴性，又能教出怎樣的學生呢？當整個社會上奴性重的人過多，社會就無法進步。《單向度的人》一書指出，現代人失去追求和批判能力，而趨向社會極權化。現代社會沒有了對立，人也失去了實現自己的機會，也失去了真正的自由。但人都安於沒有自由、樂於被人控制，這就是現代社會中奴性與異化的最大關係。</p>
<p>尼采說，理性和非理性兩者皆存在每個人本性中，我們不可能全然放縱而激情地生活著，也不完全壓抑自己的慾望而理性地過這每一天。人過份壓抑著尋回自身價值的慾望，過份理性地為了安穩生活而甘願屈居權勢之下，被剝削、受打壓，也不反抗，這種奴性思維也是極不理智的表現，沒有自我、沒有自尊的人，跟一塊磚頭也沒太大分別。</p>
<div class="sharedaddy sd-sharing-enabled"><div class="robots-nocontent sd-block sd-social sd-social-icon sd-sharing"><h3 class="sd-title">分享：</h3><div class="sd-content"><ul><li class="share-facebook"><a rel="nofollow" data-shared="sharing-facebook-31905" class="share-facebook sd-button share-icon no-text" href="http://polymerhk.com/articles/2016/06/06/31905/?share=facebook" rel="noopener noreferrer" target="_blank" title="按一下以分享至 Facebook"><span></span><span class="sharing-screen-reader-text">按一下以分享至 Facebook(在新視窗中開啟)</span></a></li><li class="share-twitter"><a rel="nofollow" data-shared="sharing-twitter-31905" class="share-twitter sd-button share-icon no-text" href="http://polymerhk.com/articles/2016/06/06/31905/?share=twitter" rel="noopener noreferrer" target="_blank" title="分享到 Twitter"><span></span><span class="sharing-screen-reader-text">分享到 Twitter(在新視窗中開啟)</span></a></li><li class="share-google-plus-1"><a rel="nofollow" data-shared="sharing-google-31905" class="share-google-plus-1 sd-button share-icon no-text" href="http://polymerhk.com/articles/2016/06/06/31905/?share=google-plus-1" rel="noopener noreferrer" target="_blank" title="按一下以分享到 Google+"><span></span><span class="sharing-screen-reader-text">按一下以分享到 Google+(在新視窗中開啟)</span></a></li><li class="share-print"><a rel="nofollow" data-shared="" class="share-print sd-button share-icon no-text" href="http://polymerhk.com/articles/2016/06/06/31905/#print" rel="noopener noreferrer" target="_blank" title="點這裡列印"><span></span><span class="sharing-screen-reader-text">點這裡列印(在新視窗中開啟)</span></a></li><li class="share-end"></li></ul></div></div></div>
<div id='jp-relatedposts' class='jp-relatedposts'>
<h3 class="jp-relatedposts-headline"><em>相關</em></h3>
</div>
</div>
<div class="afterpost-items">
<div class="tagcloud badge"><h5>Tags</h5><a href="http://polymerhk.com/articles/tag/%e5%a5%b4%e9%9a%b8/" rel="tag">奴隸</a> <a href="http://polymerhk.com/articles/tag/%e6%b8%af%e5%a5%b4/" rel="tag">港奴</a> <a href="http://polymerhk.com/articles/tag/%e5%a5%b4%e6%80%a7/" rel="tag">奴性</a></div><div class="clear"></div> <div class="authorboxwrap">
<div class="section-title">
<p><span>The Author</span></p>
</div>
<div class="authorboxfull">
<div class="one-fifth avatar-container">
<a href="http://polymerhk.com/articles/author/woody/"><img src="https://i1.wp.com/polymerhk.com/wp-content/uploads/2016/06/dsc_3884.jpg?fit=82%2C96" width="82" height="96" alt="胡迪" class="avatar avatar-96 wp-user-avatar wp-user-avatar-96 alignnone photo" /></a> <h4>
<a href="http://polymerhk.com/articles/author/woody/" title="由 胡迪 發表" rel="author">胡迪</a> </h4>
</div>
<div class="four-fifth text-container column-last">
<div class="author-description">
最純情動畫角色，地圖炮專家。胡迪三大敵人：偽善者、偽文青、左膠。 </div>
</div>
<div class="clear"></div>
</div>
</div>

<div class="related-posts">
<div class="related-inner">
<div class="section-title">
<p><span>You Might Also Like</span></p>
</div>
<div class="highlight_category_23 has-thumbnail related grid-item">
<div class="isobrick-inner">
<img src="https://i2.wp.com/polymerhk.com/wp-content/uploads/2016/03/MX4FwJH2.jpg?resize=512%2C343" class="attachment-related size-related wp-post-image" alt="" onload="jQuery(this).animate({ &quot;opacity&quot; : 0.75 }, 500);" srcset="https://i2.wp.com/polymerhk.com/wp-content/uploads/2016/03/MX4FwJH2.jpg?w=512 512w, https://i2.wp.com/polymerhk.com/wp-content/uploads/2016/03/MX4FwJH2.jpg?resize=366%2C245 366w, https://i2.wp.com/polymerhk.com/wp-content/uploads/2016/03/MX4FwJH2.jpg?resize=508%2C340 508w" sizes="(max-width: 512px) 100vw, 512px" />
<span class="thumboverdate">
<i class="fa fa-bookmark"></i>
2 年 ago </span>
<div class="thumbovertext">
<div class="badge">
<a href="http://polymerhk.com/articles/category/local-hk/" class="category-23" title="More 本地 Posts">本地</a><a href="http://polymerhk.com/articles/category/%e6%8a%95%e7%a8%bf/" class="category-120" title="More 投稿 Posts">投稿</a><div class="clear"></div> </div>
<h2 class="title">
<a href="http://polymerhk.com/articles/2016/03/23/29641/" title="康文署自宮的自信">
康文署自宮的自信 </a>
</h2>
<a class="button outline" href="http://polymerhk.com/articles/2016/03/23/29641/" title="康文署自宮的自信">
Read More </a>
</div>
<a class="brick-thumb-link" href="http://polymerhk.com/articles/2016/03/23/29641/" title="康文署自宮的自信">
康文署自宮的自信 </a>
</div>
</div>
<div class="highlight_category_23 has-thumbnail related grid-item">
<div class="isobrick-inner">
<img src="https://i0.wp.com/polymerhk.com/wp-content/uploads/2016/05/1fe98845f636b1e1834084b57fda9ee6.jpg?resize=525%2C564" class="attachment-related size-related wp-post-image" alt="" onload="jQuery(this).animate({ &quot;opacity&quot; : 0.75 }, 500);" srcset="https://i0.wp.com/polymerhk.com/wp-content/uploads/2016/05/1fe98845f636b1e1834084b57fda9ee6.jpg?resize=410%2C441 410w, https://i0.wp.com/polymerhk.com/wp-content/uploads/2016/05/1fe98845f636b1e1834084b57fda9ee6.jpg?resize=525%2C564 525w, https://i0.wp.com/polymerhk.com/wp-content/uploads/2016/05/1fe98845f636b1e1834084b57fda9ee6.jpg?zoom=2&amp;resize=525%2C564 1050w" sizes="(max-width: 525px) 100vw, 525px" />
<span class="thumboverdate">
<i class="fa fa-bookmark"></i>
2 年 ago </span>
<div class="thumbovertext">
<div class="badge">
<a href="http://polymerhk.com/articles/category/local-hk/" class="category-23" title="More 本地 Posts">本地</a><a href="http://polymerhk.com/articles/category/%e6%8a%95%e7%a8%bf/" class="category-120" title="More 投稿 Posts">投稿</a><div class="clear"></div> </div>
<h2 class="title">
<a href="http://polymerhk.com/articles/2016/05/21/31377/" title="論泛民的奴才心態">
論泛民的奴才心態 </a>
</h2>
<a class="button outline" href="http://polymerhk.com/articles/2016/05/21/31377/" title="論泛民的奴才心態">
Read More </a>
</div>
<a class="brick-thumb-link" href="http://polymerhk.com/articles/2016/05/21/31377/" title="論泛民的奴才心態">
論泛民的奴才心態 </a>
</div>
</div>
<div class="clear"></div>
</div>
</div>
<div id="disqus_thread"></div>
</div>
</div>
<div class="clear"></div>
</div>
</div>
<div class="sidebar">
<div class="sidebarcontent">
<div id="text-14" class="widget widget_text"><h4 class="widget-title">關注聚言時報</h4> <div class="textwidget"><div class="sf-counter-container" style="">
<h3></h3>
<div class="sf-widget-holder sf-brdrdus0 sf-m0  " style="" data-animate_numbers="1" data-duration="" data-is_lazy="1">
<div class="sf-widget-lazy" data-hide_numbers="0" data-show_total="0">
<div class="sf-block sf-view sf-no-effect sf-col-lg-4 sf-col-md-4 sf-col-sm-4 sf-col-xs-4" data-social="facebook">
<div class="sf-front sf-bg-facebook">
<a class="sf-dark-color" href="http://www.facebook.com/374401906020345" target="_blank" rel="nofollow">
<i class="-sf-icon-facebook "></i>
<div class="sf-spe sf-dark-bg"></div>
<span class="sf-social-count sf-dark-color">...</span>
<div class="clearfix"></div>
<small class="sf-dark-color">Fans</small>
</a>
</div>
<div class="sf-back sf-mask">
<a href="http://www.facebook.com/374401906020345" class="sf-join btn btn-xs sf-bg-facebook sf-dark-color" target="_blank" rel="nofollow">Like</a>
</div>
</div>
<div class="sf-block sf-view sf-no-effect sf-col-lg-4 sf-col-md-4 sf-col-sm-4 sf-col-xs-4" data-social="twitter">
<div class="sf-front sf-bg-twitter">
<a class="sf-dark-color" href="http://www.twitter.com/GaldenPolymer" target="_blank" rel="nofollow">
<i class="-sf-icon-twitter "></i>
<div class="sf-spe sf-dark-bg"></div>
<span class="sf-social-count sf-dark-color">...</span>
<div class="clearfix"></div>
<small class="sf-dark-color">Followers</small>
</a>
</div>
<div class="sf-back sf-mask">
<a href="http://www.twitter.com/GaldenPolymer" class="sf-join btn btn-xs sf-bg-twitter sf-dark-color" target="_blank" rel="nofollow">Follow</a>
</div>
</div>
<div class="sf-block sf-view sf-no-effect sf-col-lg-4 sf-col-md-4 sf-col-sm-4 sf-col-xs-4" data-social="google">
<div class="sf-front sf-bg-google">
<a class="sf-dark-color" href="http://plus.google.com/+polymerhk" target="_blank" rel="nofollow">
<i class="fa fa-google-plus "></i>
<div class="sf-spe sf-dark-bg"></div>
<span class="sf-social-count sf-dark-color">...</span>
<div class="clearfix"></div>
<small class="sf-dark-color">Fans</small>
</a>
</div>
<div class="sf-back sf-mask">
<a href="http://plus.google.com/+polymerhk" class="sf-join btn btn-xs sf-bg-google sf-dark-color" target="_blank" rel="nofollow">Follow</a>
</div>
</div>
<div class="sf-block sf-view sf-no-effect sf-col-lg-4 sf-col-md-4 sf-col-sm-4 sf-col-xs-4" data-social="instgram">
<div class="sf-front sf-bg-instgram">
<a class="sf-dark-color" href="http://instagram.com/hkpolymer" target="_blank" rel="nofollow">
<i class="fa fa-instagram "></i>
<div class="sf-spe sf-dark-bg"></div>
<span class="sf-social-count sf-dark-color">...</span>
<div class="clearfix"></div>
<small class="sf-dark-color">Followers</small>
</a>
</div>
<div class="sf-back sf-mask">
<a href="http://instagram.com/hkpolymer" class="sf-join btn btn-xs sf-bg-instgram sf-dark-color" target="_blank" rel="nofollow">Follow</a>
</div>
</div>
<div style="clear: both;"></div>
</div> </div>
</div>
</div>
</div><div class="clear"></div> <div id="recent-posts-2" class="widget widget_recent_entries"> <h4 class="widget-title">近期文章</h4> <ul>
<li>
<a href="http://polymerhk.com/articles/2018/08/24/41182/">九巴實習生的心聲</a>
</li>
<li>
<a href="http://polymerhk.com/articles/2018/08/23/41177/">中國移民在美國有名的商界領袖數目是：零！</a>
</li>
<li>
<a href="http://polymerhk.com/articles/2018/08/21/41173/">敬請小麗老師兌現競選承諾!!!</a>
</li>
<li>
<a href="http://polymerhk.com/articles/2018/08/19/41167/">留你老母! 系列</a>
</li>
<li>
<a href="http://polymerhk.com/articles/2018/08/18/41161/">又談大數據：左膠錯在不懂人心</a>
</li>
</ul>
</div><div class="clear"></div><div id="text-24" class="widget widget_text"> <div class="textwidget"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle" style="display:inline-block;width:300px;height:600px;" data-ad-client="ca-pub-2900580706071663" data-ad-slot="4291100830"></ins>
<script> 
(adsbygoogle = window.adsbygoogle || []).push({}); 
</script>
</div>
</div><div class="clear"></div><div id="ag_popular_widget-2" class="widget ag_popular_widget">
<h4 class="widget-title">熱門文章</h4>
<div class="tabswrap">
<ul class="tabs ajax-tabs">
<li><a class="active" href="#tab2" data-query="weekly">Week</a></li>
<li><a href="#tab2" data-query="monthly">Month</a></li>
<li><a href="#tab2" data-query="all_time">All Time</a></li>
</ul>
<div class="clear"></div>

<div class="loading"></div>
<ul class="tabs-content" data-posts="6">

<li class="active">
<div class="tabpost">
<div class="featuredimagewidget thumbnailarea">
<a class="thumblink" href="http://polymerhk.com/articles/2016/06/26/32425/">
<img src="https://i1.wp.com/polymerhk.com/wp-content/uploads/2016/06/stalker-001-1024x782.jpg?resize=75%2C75" class="attachment-tinyfeatured size-tinyfeatured wp-post-image" alt="" srcset="https://i1.wp.com/polymerhk.com/wp-content/uploads/2016/06/stalker-001-1024x782.jpg?resize=160%2C160 160w, https://i1.wp.com/polymerhk.com/wp-content/uploads/2016/06/stalker-001-1024x782.jpg?resize=75%2C75 75w, https://i1.wp.com/polymerhk.com/wp-content/uploads/2016/06/stalker-001-1024x782.jpg?zoom=3&amp;resize=75%2C75 225w" sizes="(max-width: 75px) 100vw, 75px" /> </a>
</div>
<p class="tab-title"><a href="http://polymerhk.com/articles/2016/06/26/32425/" title="犯罪心理檔案系列(1)：你知道誰在悄悄跟蹤你嗎？">犯罪心理檔案系列(1)：你知道誰在悄悄跟蹤你嗎？</a></p>
<p class="views"><i class="fa fa-eye"></i> 5 Views</p>
<div class="clear"></div>
</div>
<div class="tabpost">
<div class="featuredimagewidget thumbnailarea">
<a class="thumblink" href="http://polymerhk.com/articles/2016/03/01/28852/">
<img src="https://i0.wp.com/polymerhk.com/wp-content/uploads/2016/03/1020110.jpg?resize=75%2C75" class="attachment-tinyfeatured size-tinyfeatured wp-post-image" alt="" srcset="https://i0.wp.com/polymerhk.com/wp-content/uploads/2016/03/1020110.jpg?resize=160%2C160 160w, https://i0.wp.com/polymerhk.com/wp-content/uploads/2016/03/1020110.jpg?resize=75%2C75 75w, https://i0.wp.com/polymerhk.com/wp-content/uploads/2016/03/1020110.jpg?zoom=3&amp;resize=75%2C75 225w" sizes="(max-width: 75px) 100vw, 75px" /> </a>
</div>
<p class="tab-title"><a href="http://polymerhk.com/articles/2016/03/01/28852/" title="君子喻於義 小人喻於利">君子喻於義 小人喻於利</a></p>
<p class="views"><i class="fa fa-eye"></i> 4 Views</p>
<div class="clear"></div>
</div>
<div class="tabpost">
<div class="featuredimagewidget thumbnailarea">
<a class="thumblink" href="http://polymerhk.com/articles/2016/06/09/32020/">
<img src="https://i1.wp.com/polymerhk.com/wp-content/uploads/2016/06/13405341_1548046842164065_806336360_o-1.jpeg?resize=75%2C75" class="attachment-tinyfeatured size-tinyfeatured wp-post-image" alt="" srcset="https://i1.wp.com/polymerhk.com/wp-content/uploads/2016/06/13405341_1548046842164065_806336360_o-1.jpeg?resize=160%2C160 160w, https://i1.wp.com/polymerhk.com/wp-content/uploads/2016/06/13405341_1548046842164065_806336360_o-1.jpeg?resize=75%2C75 75w, https://i1.wp.com/polymerhk.com/wp-content/uploads/2016/06/13405341_1548046842164065_806336360_o-1.jpeg?zoom=3&amp;resize=75%2C75 225w" sizes="(max-width: 75px) 100vw, 75px" /> </a>
</div>
<p class="tab-title"><a href="http://polymerhk.com/articles/2016/06/09/32020/" title="好筆要玩：斷血流．硬橡膠羽觸">好筆要玩：斷血流．硬橡膠羽觸</a></p>
<p class="views"><i class="fa fa-eye"></i> 4 Views</p>
<div class="clear"></div>
</div>
<div class="tabpost">
<div class="featuredimagewidget thumbnailarea">
<a class="thumblink" href="http://polymerhk.com/articles/2015/08/09/19387/">
<img src="https://i2.wp.com/polymerhk.com/wp-content/uploads/2015/08/003830wih5mhgk7k7o8osz.jpg?resize=75%2C75" class="attachment-tinyfeatured size-tinyfeatured wp-post-image" alt="" srcset="https://i2.wp.com/polymerhk.com/wp-content/uploads/2015/08/003830wih5mhgk7k7o8osz.jpg?resize=160%2C160 160w, https://i2.wp.com/polymerhk.com/wp-content/uploads/2015/08/003830wih5mhgk7k7o8osz.jpg?resize=75%2C75 75w, https://i2.wp.com/polymerhk.com/wp-content/uploads/2015/08/003830wih5mhgk7k7o8osz.jpg?zoom=3&amp;resize=75%2C75 225w" sizes="(max-width: 75px) 100vw, 75px" /> </a>
</div>
<p class="tab-title"><a href="http://polymerhk.com/articles/2015/08/09/19387/" title="識寫禱文嘅一定係用粵文">識寫禱文嘅一定係用粵文</a></p>
<p class="views"><i class="fa fa-eye"></i> 4 Views</p>
<div class="clear"></div>
</div>
<div class="tabpost">
<div class="featuredimagewidget thumbnailarea">
<a class="thumblink" href="http://polymerhk.com/articles/2016/01/25/27047/">
<img src="https://i2.wp.com/polymerhk.com/wp-content/uploads/2016/01/CUHK_仲門.jpg?resize=75%2C75" class="attachment-tinyfeatured size-tinyfeatured wp-post-image" alt="" srcset="https://i2.wp.com/polymerhk.com/wp-content/uploads/2016/01/CUHK_仲門.jpg?resize=160%2C160 160w, https://i2.wp.com/polymerhk.com/wp-content/uploads/2016/01/CUHK_仲門.jpg?resize=75%2C75 75w, https://i2.wp.com/polymerhk.com/wp-content/uploads/2016/01/CUHK_仲門.jpg?zoom=3&amp;resize=75%2C75 225w" sizes="(max-width: 75px) 100vw, 75px" /> </a>
</div>
<p class="tab-title"><a href="http://polymerhk.com/articles/2016/01/25/27047/" title="中大左膠的獵巫傳統：我的理想凌駕你的自由">中大左膠的獵巫傳統：我的理想凌駕你的自由</a></p>
<p class="views"><i class="fa fa-eye"></i> 4 Views</p>
<div class="clear"></div>
</div>
<div class="tabpost">
<div class="featuredimagewidget thumbnailarea">
<a class="thumblink" href="http://polymerhk.com/articles/2015/07/16/18464/">
<img src="https://i2.wp.com/polymerhk.com/wp-content/uploads/2015/07/312571-cats-flying-cat.jpg?resize=75%2C75" class="attachment-tinyfeatured size-tinyfeatured wp-post-image" alt="" srcset="https://i2.wp.com/polymerhk.com/wp-content/uploads/2015/07/312571-cats-flying-cat.jpg?resize=160%2C160 160w, https://i2.wp.com/polymerhk.com/wp-content/uploads/2015/07/312571-cats-flying-cat.jpg?resize=75%2C75 75w, https://i2.wp.com/polymerhk.com/wp-content/uploads/2015/07/312571-cats-flying-cat.jpg?zoom=3&amp;resize=75%2C75 225w" sizes="(max-width: 75px) 100vw, 75px" /> </a>
</div>
<p class="tab-title"><a href="http://polymerhk.com/articles/2015/07/16/18464/" title="消極自由">消極自由</a></p>
<p class="views"><i class="fa fa-eye"></i> 4 Views</p>
<div class="clear"></div>
</div>
</li>

<li>
<div class="tabpost">
<div class="featuredimagewidget thumbnailarea">
<a class="thumblink" href="http://polymerhk.com/articles/2018/08/24/41182/">
<img src="https://i0.wp.com/polymerhk.com/wp-content/uploads/2018/08/20181914.png?resize=75%2C75" class="attachment-tinyfeatured size-tinyfeatured wp-post-image" alt="" srcset="https://i0.wp.com/polymerhk.com/wp-content/uploads/2018/08/20181914.png?resize=160%2C160 160w, https://i0.wp.com/polymerhk.com/wp-content/uploads/2018/08/20181914.png?resize=75%2C75 75w, https://i0.wp.com/polymerhk.com/wp-content/uploads/2018/08/20181914.png?zoom=3&amp;resize=75%2C75 225w" sizes="(max-width: 75px) 100vw, 75px" />  </a>
</div>
<p class="tab-title"><a href="http://polymerhk.com/articles/2018/08/24/41182/">九巴實習生的心聲</a></p>
<p class="views">2018/08/24</p>
<div class="clear"></div>
</div>
<div class="tabpost">
<div class="featuredimagewidget thumbnailarea">
<a class="thumblink" href="http://polymerhk.com/articles/2018/08/23/41177/">
<img src="https://i2.wp.com/polymerhk.com/wp-content/uploads/2018/08/20182006.png?resize=75%2C75" class="attachment-tinyfeatured size-tinyfeatured wp-post-image" alt="" srcset="https://i2.wp.com/polymerhk.com/wp-content/uploads/2018/08/20182006.png?resize=160%2C160 160w, https://i2.wp.com/polymerhk.com/wp-content/uploads/2018/08/20182006.png?resize=75%2C75 75w, https://i2.wp.com/polymerhk.com/wp-content/uploads/2018/08/20182006.png?zoom=3&amp;resize=75%2C75 225w" sizes="(max-width: 75px) 100vw, 75px" /> </a>
</div>
<p class="tab-title"><a href="http://polymerhk.com/articles/2018/08/23/41177/">中國移民在美國有名的商界領袖數目是：零！</a></p>
<p class="views">2018/08/23</p>
<div class="clear"></div>
</div>
<div class="tabpost">
<div class="featuredimagewidget thumbnailarea">
<a class="thumblink" href="http://polymerhk.com/articles/2018/08/21/41173/">
<img src="https://i2.wp.com/polymerhk.com/wp-content/uploads/2018/08/jessica.jpg?resize=75%2C75" class="attachment-tinyfeatured size-tinyfeatured wp-post-image" alt="" srcset="https://i2.wp.com/polymerhk.com/wp-content/uploads/2018/08/jessica.jpg?resize=160%2C160 160w, https://i2.wp.com/polymerhk.com/wp-content/uploads/2018/08/jessica.jpg?resize=75%2C75 75w, https://i2.wp.com/polymerhk.com/wp-content/uploads/2018/08/jessica.jpg?zoom=3&amp;resize=75%2C75 225w" sizes="(max-width: 75px) 100vw, 75px" /> </a>
</div>
<p class="tab-title"><a href="http://polymerhk.com/articles/2018/08/21/41173/">敬請小麗老師兌現競選承諾!!!</a></p>
<p class="views">2018/08/21</p>
<div class="clear"></div>
</div>
<div class="tabpost">
<div class="featuredimagewidget thumbnailarea">
<a class="thumblink" href="http://polymerhk.com/articles/2018/08/19/41167/">
<img src="https://i1.wp.com/polymerhk.com/wp-content/uploads/2018/08/111.gif?resize=75%2C75" class="attachment-tinyfeatured size-tinyfeatured wp-post-image" alt="" /> </a>
</div>
<p class="tab-title"><a href="http://polymerhk.com/articles/2018/08/19/41167/">留你老母! 系列</a></p>
<p class="views">2018/08/19</p>
<div class="clear"></div>
</div>
<div class="tabpost">
<div class="featuredimagewidget thumbnailarea">
<a class="thumblink" href="http://polymerhk.com/articles/2018/08/18/41161/">
<img src="https://i2.wp.com/polymerhk.com/wp-content/uploads/2018/08/20182104.png?resize=75%2C75" class="attachment-tinyfeatured size-tinyfeatured wp-post-image" alt="" srcset="https://i2.wp.com/polymerhk.com/wp-content/uploads/2018/08/20182104.png?resize=160%2C160 160w, https://i2.wp.com/polymerhk.com/wp-content/uploads/2018/08/20182104.png?resize=75%2C75 75w, https://i2.wp.com/polymerhk.com/wp-content/uploads/2018/08/20182104.png?zoom=3&amp;resize=75%2C75 225w" sizes="(max-width: 75px) 100vw, 75px" /> </a>
</div>
<p class="tab-title"><a href="http://polymerhk.com/articles/2018/08/18/41161/">又談大數據：左膠錯在不懂人心</a></p>
<p class="views">2018/08/18</p>
<div class="clear"></div>
</div>
<div class="tabpost">
<div class="featuredimagewidget thumbnailarea">
<a class="thumblink" href="http://polymerhk.com/articles/2018/08/17/41156/">
<img src="https://i0.wp.com/polymerhk.com/wp-content/uploads/2018/08/20180125.png?resize=75%2C75" class="attachment-tinyfeatured size-tinyfeatured wp-post-image" alt="" srcset="https://i0.wp.com/polymerhk.com/wp-content/uploads/2018/08/20180125.png?resize=160%2C160 160w, https://i0.wp.com/polymerhk.com/wp-content/uploads/2018/08/20180125.png?resize=75%2C75 75w, https://i0.wp.com/polymerhk.com/wp-content/uploads/2018/08/20180125.png?zoom=3&amp;resize=75%2C75 225w" sizes="(max-width: 75px) 100vw, 75px" /> </a>
</div>
<p class="tab-title"><a href="http://polymerhk.com/articles/2018/08/17/41156/">民主與獨立是一個事實兩個名字</a></p>
<p class="views">2018/08/17</p>
<div class="clear"></div>
</div>
</li>
</ul>
<div class="clear"></div>
</div>
</div><div class="clear"></div><div id="text-28" class="widget widget_text"> <div class="textwidget"><script>var ysmpost=0;
ysmpost++;document.write('<div id="ysm_post'+ysmpost+'"></div>')</script></div>
</div><div class="clear"></div> </div>
</div>
</div>
</div>
<div class="clear"></div>

<div id="footer" class="dark">
<div class="container clearfix">
<div class="col-md-12">
<div class="one-third"><div id="text-10" class="widget widget_text"> <div class="textwidget"><p><img src='https://i0.wp.com/polymerhk.com/wp-content/uploads/2015/12/polymer_bottom.png?w=1170' data-recalc-dims="1" /></p>
<p class="tiny-details">聚集民意 ‧ 合眾起義</p>
<a href="http://creativecommons.org/licenses/by-nc-nd/4.0/deed.zh_TW" title="聚言時報Polymer 著作 採用創用 CC 姓名標示-非商業性-禁止改作 (CC BY-NC-ND) 4.0 國際 授權條款授權." target="_blank"><img alt="創用 CC 授權條款" style="border-width:0" src="https://i2.wp.com/i.creativecommons.org/l/by-nc-nd/4.0/80x15.png?w=1170" data-recalc-dims="1" /></a>
</div>
</div><div class="clear"></div></div>
<div class="one-third"> <div id="recent-posts-3" class="widget widget_recent_entries"> <h3 class="widget-title">最近文章</h3> <ul>
<li>
<a href="http://polymerhk.com/articles/2018/08/24/41182/">九巴實習生的心聲</a>
</li>
<li>
<a href="http://polymerhk.com/articles/2018/08/23/41177/">中國移民在美國有名的商界領袖數目是：零！</a>
</li>
<li>
<a href="http://polymerhk.com/articles/2018/08/21/41173/">敬請小麗老師兌現競選承諾!!!</a>
</li>
<li>
<a href="http://polymerhk.com/articles/2018/08/19/41167/">留你老母! 系列</a>
</li>
<li>
<a href="http://polymerhk.com/articles/2018/08/18/41161/">又談大數據：左膠錯在不懂人心</a>
</li>
</ul>
</div><div class="clear"></div></div>
<div class="one-third column-last"><div id="tag_cloud-2" class="widget widget_tag_cloud"><h3 class="widget-title">標籤雲</h3><div class="tagcloud"><a href="http://polymerhk.com/articles/tag/kidnapping/" class="tag-cloud-link tag-link-2305 tag-link-position-1" style="font-size: 8pt;" aria-label="Kidnapping (1 個項目)">Kidnapping</a>
<a href="http://polymerhk.com/articles/tag/mind-control-mastery/" class="tag-cloud-link tag-link-3840 tag-link-position-2" style="font-size: 8pt;" aria-label="Mind Control Mastery (1 個項目)">Mind Control Mastery</a>
<a href="http://polymerhk.com/articles/tag/polymer-%e6%9c%88%e5%88%8a/" class="tag-cloud-link tag-link-513 tag-link-position-3" style="font-size: 8pt;" aria-label="Polymer 月刊 (1 個項目)">Polymer 月刊</a>
<a href="http://polymerhk.com/articles/tag/tesla/" class="tag-cloud-link tag-link-1026 tag-link-position-4" style="font-size: 14.857142857143pt;" aria-label="Tesla (5 個項目)">Tesla</a>
<a href="http://polymerhk.com/articles/tag/%e4%b8%96%e7%95%8c%e7%b7%9a%e8%ae%8a%e5%8b%95%e7%8e%87/" class="tag-cloud-link tag-link-4352 tag-link-position-5" style="font-size: 8pt;" aria-label="世界線變動率 (1 個項目)">世界線變動率</a>
<a href="http://polymerhk.com/articles/tag/%e4%b8%ad%e5%85%b1%e8%b5%a4%e5%8c%96/" class="tag-cloud-link tag-link-4097 tag-link-position-6" style="font-size: 20.857142857143pt;" aria-label="中共赤化 (15 個項目)">中共赤化</a>
<a href="http://polymerhk.com/articles/tag/%e4%b8%ad%e5%9c%8b%e8%82%a1%e5%b8%82/" class="tag-cloud-link tag-link-1025 tag-link-position-7" style="font-size: 8pt;" aria-label="中國股市 (1 個項目)">中國股市</a>
<a href="http://polymerhk.com/articles/tag/%e4%b8%bb%e6%b5%81%e5%82%b3%e5%aa%92/" class="tag-cloud-link tag-link-2817 tag-link-position-8" style="font-size: 12.285714285714pt;" aria-label="主流傳媒 (3 個項目)">主流傳媒</a>
<a href="http://polymerhk.com/articles/tag/%e4%bd%95%e9%9f%bb%e8%a9%a9/" class="tag-cloud-link tag-link-3584 tag-link-position-9" style="font-size: 13.714285714286pt;" aria-label="何韻詩 (4 個項目)">何韻詩</a>
<a href="http://polymerhk.com/articles/tag/%e4%bf%9d%e8%ad%b7%e5%85%92%e7%ab%a5/" class="tag-cloud-link tag-link-1281 tag-link-position-10" style="font-size: 8pt;" aria-label="保護兒童 (1 個項目)">保護兒童</a>
<a href="http://polymerhk.com/articles/tag/%e5%85%ac%e6%b0%91%e6%8a%97%e5%91%bd/" class="tag-cloud-link tag-link-2816 tag-link-position-11" style="font-size: 15.857142857143pt;" aria-label="公民抗命 (6 個項目)">公民抗命</a>
<a href="http://polymerhk.com/articles/tag/%e5%8d%81%e4%b8%80%e6%9c%88%e8%99%9f2013/" class="tag-cloud-link tag-link-7 tag-link-position-12" style="font-size: 12.285714285714pt;" aria-label="十一月號/2013 (3 個項目)">十一月號/2013</a>
<a href="http://polymerhk.com/articles/tag/%e5%8e%9f%e5%8a%9b/" class="tag-cloud-link tag-link-5376 tag-link-position-13" style="font-size: 8pt;" aria-label="原力 (1 個項目)">原力</a>
<a href="http://polymerhk.com/articles/tag/%e5%8f%a4%e5%b8%8c%e8%87%98/" class="tag-cloud-link tag-link-1280 tag-link-position-14" style="font-size: 17.285714285714pt;" aria-label="古希臘 (8 個項目)">古希臘</a>
<a href="http://polymerhk.com/articles/tag/%e5%a4%96%e5%85%ac/" class="tag-cloud-link tag-link-3841 tag-link-position-15" style="font-size: 8pt;" aria-label="外公 (1 個項目)">外公</a>
<a href="http://polymerhk.com/articles/tag/%e5%a4%a9%e5%ae%89%e9%96%80%e6%af%8d%e8%a6%aa/" class="tag-cloud-link tag-link-5121 tag-link-position-16" style="font-size: 8pt;" aria-label="天安門母親 (1 個項目)">天安門母親</a>
<a href="http://polymerhk.com/articles/tag/%e5%b1%b1%e5%b4%8e%e4%ba%ae/" class="tag-cloud-link tag-link-4353 tag-link-position-17" style="font-size: 8pt;" aria-label="山崎亮 (1 個項目)">山崎亮</a>
<a href="http://polymerhk.com/articles/tag/%e5%b4%94%e4%b8%96%e5%ae%89/" class="tag-cloud-link tag-link-258 tag-link-position-18" style="font-size: 12.285714285714pt;" aria-label="崔世安 (3 個項目)">崔世安</a>
<a href="http://polymerhk.com/articles/tag/%e5%b9%b3%e5%8f%8d%e5%85%ad%e5%9b%9b/" class="tag-cloud-link tag-link-5120 tag-link-position-19" style="font-size: 10.571428571429pt;" aria-label="平反六四 (2 個項目)">平反六四</a>
<a href="http://polymerhk.com/articles/tag/%e5%b9%b3%e6%b0%91%e4%b8%bb%e7%be%a9/" class="tag-cloud-link tag-link-4865 tag-link-position-20" style="font-size: 8pt;" aria-label="平民主義 (1 個項目)">平民主義</a>
<a href="http://polymerhk.com/articles/tag/%e6%94%bf%e6%b2%bb%e9%87%8e%e5%bf%83/" class="tag-cloud-link tag-link-4608 tag-link-position-21" style="font-size: 8pt;" aria-label="政治野心 (1 個項目)">政治野心</a>
<a href="http://polymerhk.com/articles/tag/%e6%96%87%e6%86%91%e8%a9%a6/" class="tag-cloud-link tag-link-3073 tag-link-position-22" style="font-size: 10.571428571429pt;" aria-label="文憑試 (2 個項目)">文憑試</a>
<a href="http://polymerhk.com/articles/tag/%e6%96%af%e8%ab%be%e7%99%bb/" class="tag-cloud-link tag-link-768 tag-link-position-23" style="font-size: 8pt;" aria-label="斯諾登 (1 個項目)">斯諾登</a>
<a href="http://polymerhk.com/articles/tag/%e6%99%82%e5%a0%b1%e6%9c%88%e5%88%8a/" class="tag-cloud-link tag-link-4 tag-link-position-24" style="font-size: 16.571428571429pt;" aria-label="時報月刊 (7 個項目)">時報月刊</a>
<a href="http://polymerhk.com/articles/tag/%e6%9c%ac%e6%b0%91%e5%89%8d/" class="tag-cloud-link tag-link-1537 tag-link-position-25" style="font-size: 22pt;" aria-label="本民前 (18 個項目)">本民前</a>
<a href="http://polymerhk.com/articles/tag/%e6%9d%8e%e6%80%a1/" class="tag-cloud-link tag-link-2048 tag-link-position-26" style="font-size: 15.857142857143pt;" aria-label="李怡 (6 個項目)">李怡</a>
<a href="http://polymerhk.com/articles/tag/%e6%be%b3%e9%96%80/" class="tag-cloud-link tag-link-256 tag-link-position-27" style="font-size: 19.142857142857pt;" aria-label="澳門 (11 個項目)">澳門</a>
<a href="http://polymerhk.com/articles/tag/%e7%94%9f%e6%b4%bb%e9%80%bc%e4%ba%ba/" class="tag-cloud-link tag-link-2049 tag-link-position-28" style="font-size: 8pt;" aria-label="生活逼人 (1 個項目)">生活逼人</a>
<a href="http://polymerhk.com/articles/tag/%e7%ac%ac%e5%9b%9b%e5%85%ac%e6%b0%91%ef%bc%8c%e6%81%90%e6%80%96%e7%9a%84%e7%9b%a3%e6%8e%a7/" class="tag-cloud-link tag-link-769 tag-link-position-29" style="font-size: 8pt;" aria-label="第四公民，恐怖的監控 (1 個項目)">第四公民，恐怖的監控</a>
<a href="http://polymerhk.com/articles/tag/%e7%b2%be%e8%8b%b1%e4%b8%bb%e7%be%a9/" class="tag-cloud-link tag-link-4864 tag-link-position-30" style="font-size: 8pt;" aria-label="精英主義 (1 個項目)">精英主義</a>
<a href="http://polymerhk.com/articles/tag/%e7%b6%b2%e7%b5%a1%e5%89%bd%e7%ab%8a/" class="tag-cloud-link tag-link-2561 tag-link-position-31" style="font-size: 8pt;" aria-label="網絡剽竊 (1 個項目)">網絡剽竊</a>
<a href="http://polymerhk.com/articles/tag/%e8%81%96%e8%aa%95%e8%80%81%e4%ba%ba/" class="tag-cloud-link tag-link-5377 tag-link-position-32" style="font-size: 10.571428571429pt;" aria-label="聖誕老人 (2 個項目)">聖誕老人</a>
<a href="http://polymerhk.com/articles/tag/%e8%87%aa%e6%ae%ba%e8%ab%96/" class="tag-cloud-link tag-link-3072 tag-link-position-33" style="font-size: 8pt;" aria-label="自殺論 (1 個項目)">自殺論</a>
<a href="http://polymerhk.com/articles/tag/%e8%87%aa%e6%b1%ba/" class="tag-cloud-link tag-link-1024 tag-link-position-34" style="font-size: 20.857142857143pt;" aria-label="自決 (15 個項目)">自決</a>
<a href="http://polymerhk.com/articles/tag/%e8%87%aa%e7%94%b1%e9%81%b8%e8%88%89/" class="tag-cloud-link tag-link-4609 tag-link-position-35" style="font-size: 8pt;" aria-label="自由選舉 (1 個項目)">自由選舉</a>
<a href="http://polymerhk.com/articles/tag/%e8%8f%af%e5%a4%8f%e6%8a%80%e8%97%9d/" class="tag-cloud-link tag-link-2560 tag-link-position-36" style="font-size: 8pt;" aria-label="華夏技藝 (1 個項目)">華夏技藝</a>
<a href="http://polymerhk.com/articles/tag/%e8%91%ac%e7%a6%ae/" class="tag-cloud-link tag-link-1793 tag-link-position-37" style="font-size: 8pt;" aria-label="葬禮 (1 個項目)">葬禮</a>
<a href="http://polymerhk.com/articles/tag/%e8%a2%8b%e4%bd%8f%e5%85%88/" class="tag-cloud-link tag-link-770 tag-link-position-38" style="font-size: 12.285714285714pt;" aria-label="袋住先 (3 個項目)">袋住先</a>
<a href="http://polymerhk.com/articles/tag/%e8%a8%98%e8%80%85/" class="tag-cloud-link tag-link-1536 tag-link-position-39" style="font-size: 12.285714285714pt;" aria-label="記者 (3 個項目)">記者</a>
<a href="http://polymerhk.com/articles/tag/%e8%bf%bd%e6%b1%82%e8%80%85/" class="tag-cloud-link tag-link-1792 tag-link-position-40" style="font-size: 8pt;" aria-label="追求者 (1 個項目)">追求者</a>
<a href="http://polymerhk.com/articles/tag/%e9%80%81%e7%95%80%e6%88%91%e9%83%bd%e5%94%94%e5%b1%8c/" class="tag-cloud-link tag-link-3585 tag-link-position-41" style="font-size: 8pt;" aria-label="送畀我都唔屌 (1 個項目)">送畀我都唔屌</a>
<a href="http://polymerhk.com/articles/tag/%e9%87%91%e8%9e%8d%e7%ae%a1%ef%a7%a4%e5%b1%80/" class="tag-cloud-link tag-link-2304 tag-link-position-42" style="font-size: 8pt;" aria-label="金融管理局 (1 個項目)">金融管理局</a>
<a href="http://polymerhk.com/articles/tag/%e9%9b%a2%e8%a3%9c%e6%b3%95%e6%a1%88/" class="tag-cloud-link tag-link-257 tag-link-position-43" style="font-size: 8pt;" aria-label="離補法案 (1 個項目)">離補法案</a>
<a href="http://polymerhk.com/articles/tag/%e9%9d%92%e6%94%bf/" class="tag-cloud-link tag-link-4096 tag-link-position-44" style="font-size: 18.571428571429pt;" aria-label="青政 (10 個項目)">青政</a>
<a href="http://polymerhk.com/articles/tag/%e9%bb%8e%e6%99%ba%e8%8b%b1/" class="tag-cloud-link tag-link-512 tag-link-position-45" style="font-size: 14.857142857143pt;" aria-label="黎智英 (5 個項目)">黎智英</a></div>
</div><div class="clear"></div></div>
<div class="clear"></div>
</div>
</div>
<div class="clear"></div>
</div>


<div class="top">
<a href="#">
<span class="scrolltop">
<span>
Top </span>
</span>
</a>
</div>

</div>

</div>


<script>
		var advanced_ads_ga_UID = false;
		var advanced_ads_ga_anonymIP = true;
advanced_ads_check_adblocker=function(t){function e(t){(window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||function(t){return setTimeout(t,16)}).call(window,t)}var n=[],a=null;return e(function(){var t=document.createElement("div");t.innerHTML="&nbsp;",t.setAttribute("class","ad_unit ad-unit text-ad text_ad pub_300x250"),t.setAttribute("style","width: 1px !important; height: 1px !important; position: absolute !important; left: 0px !important; top: 0px !important; overflow: hidden !important;"),document.body.appendChild(t),e(function(){var e=window.getComputedStyle&&window.getComputedStyle(t),o=e&&e.getPropertyValue("-moz-binding");a=e&&"none"===e.getPropertyValue("display")||"string"==typeof o&&-1!==o.indexOf("about:");for(var i=0;i<n.length;i++)n[i](a);n=[]})}),function(t){if(null===a)return void n.push(t);t(a)}}(),function(){var t=function(t,e){this.name=t,this.UID=e,this.analyticsObject=null;var n=this,a={hitType:"event",eventCategory:"Advanced Ads",eventAction:"AdBlock",eventLabel:"Yes",nonInteraction:!0,transport:"beacon"};this.analyticsObject="string"==typeof GoogleAnalyticsObject&&"function"==typeof window[GoogleAnalyticsObject]&&window[GoogleAnalyticsObject],!1===this.analyticsObject?(!function(t,e,n,a,o,i,d){t.GoogleAnalyticsObject=o,t[o]=t[o]||function(){(t[o].q=t[o].q||[]).push(arguments)},t[o].l=1*new Date,i=e.createElement(n),d=e.getElementsByTagName(n)[0],i.async=1,i.src="https://www.google-analytics.com/analytics.js",d.parentNode.insertBefore(i,d)}(window,document,"script",0,"_advads_ga"),_advads_ga("create",n.UID,"auto",this.name),advanced_ads_ga_anonymIP&&_advads_ga("set","anonymizeIp",!0),_advads_ga(n.name+".send",a)):(window.console&&window.console.log("Advanced Ads Analytics >> using other's variable named `"+GoogleAnalyticsObject+"`"),window[GoogleAnalyticsObject]("create",n.UID,"auto",this.name),window[GoogleAnalyticsObject]("set","anonymizeIp",!0),window[GoogleAnalyticsObject](n.name+".send",a))};advanced_ads_check_adblocker(function(e){e&&"string"==typeof advanced_ads_ga_UID&&advanced_ads_ga_UID&&new t("advadsTracker",advanced_ads_ga_UID)})}();		
		</script> <div style="display:none">
<div class="grofile-hash-map-d2d78992b56e1ed6cdf82241bfa786b2">
</div>
</div>
<script type="text/javascript">
		window.WPCOM_sharing_counts = {"http:\/\/polymerhk.com\/articles\/2016\/06\/06\/31905\/":31905};
	</script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/plugins/jetpack/_inc/build/photon/photon.min.js?ver=20130122'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var wpcf7 = {"apiSettings":{"root":"http:\/\/polymerhk.com\/wp-json\/contact-form-7\/v1","namespace":"contact-form-7\/v1"},"recaptcha":{"messages":{"empty":"\u8acb\u8b49\u660e\u4f60\u4e0d\u662f\u6a5f\u5668\u4eba\u3002"}},"cached":"1"};
/* ]]> */
</script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/plugins/contact-form-7/includes/js/scripts.js?ver=5.0.3'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var countVars = {"disqusShortname":"galdenpolymer"};
/* ]]> */
</script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/plugins/disqus-comment-system/public/js/comment_count.js?ver=3.0.16'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var embedVars = {"disqusConfig":{"integration":"wordpress 3.0.16"},"disqusIdentifier":"31905 http:\/\/polymerhk.com\/?p=31905","disqusShortname":"galdenpolymer","disqusTitle":"\u6e2f\u4eba\u5974\u6027\u6307\u6578","disqusUrl":"http:\/\/polymerhk.com\/articles\/2016\/06\/06\/31905\/","postId":"31905"};
/* ]]> */
</script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/plugins/disqus-comment-system/public/js/comment_embed.js?ver=3.0.16'></script>
<script type='text/javascript' src='https://s0.wp.com/wp-content/js/devicepx-jetpack.js?ver=201834'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var SfcounterObject = {"ajaxurl":"http:\/\/polymerhk.com\/wp-admin\/admin-ajax.php"};
/* ]]> */
</script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/plugins/socialfans-counter/assets/js/socialfans-script.js?ver=4.4.1'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/plugins/themewich-shortcodes/js/jquery.magnific-popup.min.js?ver=0.9.4'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-includes/js/imagesloaded.min.js?ver=3.2.0'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/plugins/themewich-shortcodes/js/jquery.isotope.min.js?ver=1.5.25'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-includes/js/jquery/ui/core.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-includes/js/jquery/ui/widget.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-includes/js/jquery/ui/tabs.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-includes/js/jquery/ui/accordion.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/plugins/themewich-shortcodes/js/themewich.shortcodes.js?ver=1.4.1'></script>
<script type='text/javascript' src='https://secure.gravatar.com/js/gprofiles.js?ver=2018Augaa'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var WPGroHo = {"my_hash":""};
/* ]]> */
</script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/plugins/jetpack/modules/wpgroho.js?ver=efaa517a940fe7044dadf64128491d1e'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-includes/js/comment-reply.min.js?ver=efaa517a940fe7044dadf64128491d1e'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/themes/edition/js/superfish.min.js?ver=1.7.5'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/themes/edition/js/jquery.mmenu.min.all.js?ver=5.0.4'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/themes/edition/js/jquery.fitvids.js?ver=1.1'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/themes/edition/js/jquery.easing.1.3.js?ver=1.3'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/themes/edition/js/jquery.bxslider.min.js?ver=4.2.3'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/themes/edition/js/jquery.backstretch.min.js?ver=2.0.4'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-includes/js/underscore.min.js?ver=1.8.3'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var agAjax = {"ajaxurl":"http:\/\/polymerhk.com\/wp-admin\/admin-ajax.php","get_template_directory_uri":"http:\/\/polymerhk.com\/wp-content\/themes\/edition","nonce":"6e4df4fd1d"};
/* ]]> */
</script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/themes/edition/js/custom.js?ver=1.7.4'></script>
<script type='text/javascript' src='http://polymerhk.com/wp-includes/js/wp-embed.min.js?ver=efaa517a940fe7044dadf64128491d1e'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var sharing_js_options = {"lang":"en","counts":"1"};
/* ]]> */
</script>
<script type='text/javascript' src='http://polymerhk.com/wp-content/plugins/jetpack/_inc/build/sharedaddy/sharing.min.js?ver=6.3.3'></script>
<script type='text/javascript'>
var windowOpen;
			jQuery( document.body ).on( 'click', 'a.share-facebook', function() {
				// If there's another sharing window open, close it.
				if ( 'undefined' !== typeof windowOpen ) {
					windowOpen.close();
				}
				windowOpen = window.open( jQuery( this ).attr( 'href' ), 'wpcomfacebook', 'menubar=1,resizable=1,width=600,height=400' );
				return false;
			});
var windowOpen;
			jQuery( document.body ).on( 'click', 'a.share-twitter', function() {
				// If there's another sharing window open, close it.
				if ( 'undefined' !== typeof windowOpen ) {
					windowOpen.close();
				}
				windowOpen = window.open( jQuery( this ).attr( 'href' ), 'wpcomtwitter', 'menubar=1,resizable=1,width=600,height=350' );
				return false;
			});
var windowOpen;
			jQuery( document.body ).on( 'click', 'a.share-google-plus-1', function() {
				// If there's another sharing window open, close it.
				if ( 'undefined' !== typeof windowOpen ) {
					windowOpen.close();
				}
				windowOpen = window.open( jQuery( this ).attr( 'href' ), 'wpcomgoogle-plus-1', 'menubar=1,resizable=1,width=480,height=550' );
				return false;
			});
</script>
<div class="poldes-guru-slider" id="poldes-2017844713">  <script language="JavaScript"> var zflag_nid="1044"; var zflag_cid="2387/2385"; var zflag_sid="512"; var zflag_width="1"; var zflag_height="1"; var zflag_sz="94"; </script> <script language="JavaScript" src="http://d8.zedo.com/jsc/d8/fo.js"></script> </div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/zh_HK/sdk.js#xfbml=1&appId=1438310899736479&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46664189-1', 'auto');
  ga('send', 'pageview');

</script><script type='text/javascript' src='https://stats.wp.com/e-201834.js' async='async' defer='defer'></script>
<script type='text/javascript'>
	_stq = window._stq || [];
	_stq.push([ 'view', {v:'ext',j:'1:6.3.3',blog:'92566399',post:'31905',tz:'8',srv:'polymerhk.com'} ]);
	_stq.push([ 'clickTrackerInit', '92566399', '31905' ]);
</script>
<script type="text/javascript">                                    </script></body>
</html>
			';

	echo $contentNew;
?>
