<?php

/**
 *
 * Get El Icons
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( !function_exists('rs_el_icons')) {
	function rs_el_icons() {
		$el_icons = array('icon-mobile','icon-laptop','icon-desktop','icon-tablet','icon-phone','icon-document','icon-documents','icon-search','icon-clipboard','icon-newspaper','icon-notebook','icon-book-open','icon-browser','icon-calendar','icon-presentation','icon-picture','icon-pictures','icon-video','icon-camera','icon-printer','icon-toolbox','icon-briefcase','icon-wallet','icon-gift','icon-bargraph','icon-grid','icon-expand','icon-focus','icon-edit','icon-adjustments','icon-ribbon','icon-hourglass','icon-lock','icon-megaphone','icon-shield','icon-trophy','icon-flag','icon-map','icon-puzzle','icon-basket','icon-envelope','icon-streetsign','icon-telescope','icon-gears','icon-key','icon-paperclip','icon-attachment','icon-pricetags','icon-lightbulb','icon-layers','icon-pencil','icon-tools','icon-tools-2','icon-scissors','icon-paintbrush','icon-magnifying-glass','icon-circle-compass','icon-linegraph','icon-mic','icon-strategy','icon-beaker','icon-caution','icon-recycle','icon-anchor','icon-profile-male','icon-profile-female','icon-bike','icon-wine','icon-hotairballoon','icon-globe','icon-genius','icon-map-pin','icon-dial','icon-chat','icon-heart','icon-cloud','icon-upload','icon-download','icon-target','icon-hazardous','icon-piechart','icon-speedometer','icon-global','icon-compass','icon-lifesaver','icon-clock','icon-aperture','icon-quote','icon-scope','icon-alarmclock','icon-refresh','icon-happy','icon-sad','icon-facebook','icon-twitter','icon-googleplus','icon-rss','icon-tumblr','icon-linkedin','icon-dribbble', 'icon-elegant-accesories1', 'icon-elegant-add26', 'icon-elegant-agendas', 'icon-elegant-airplane4', 'icon-elegant-arrows145', 'icon-elegant-audio10', 'icon-elegant-basket2', 'icon-elegant-batterystatus2', 'icon-elegant-batterystatus', 'icon-elegant-big1', 'icon-elegant-boat45', 'icon-elegant-bright', 'icon-elegant-building110', 'icon-elegant-button35', 'icon-elegant-button36', 'icon-elegant-button37', 'icon-elegant-button39', 'icon-elegant-buy', 'icon-elegant-charts1', 'icon-elegant-check11', 'icon-elegant-circles29', 'icon-elegant-circular7', 'icon-elegant-circulararrows1', 'icon-elegant-clouds31', 'icon-elegant-command1', 'icon-elegant-cone2', 'icon-elegant-container29', 'icon-elegant-control', 'icon-elegant-conversation19', 'icon-elegant-credit3', 'icon-elegant-dailycalendar2', 'icon-elegant-databases2', 'icon-elegant-diagram10', 'icon-elegant-direction61', 'icon-elegant-duplicate', 'icon-elegant-energy38', 'icon-elegant-energy4', 'icon-elegant-enlarge4', 'icon-elegant-eyeball5', 'icon-elegant-fastforward', 'icon-elegant-gem', 'icon-elegant-geometry13', 'icon-elegant-help26', 'icon-elegant-illumination9', 'icon-elegant-junk', 'icon-elegant-lightning2', 'icon-elegant-link82', 'icon-elegant-link83', 'icon-elegant-lists6', 'icon-elegant-lock100', 'icon-elegant-lock101', 'icon-elegant-logotype59', 'icon-elegant-logotype61', 'icon-elegant-lovely5', 'icon-elegant-magnifyingglass23', 'icon-elegant-mail11', 'icon-elegant-mail12', 'icon-elegant-message36', 'icon-elegant-mute4', 'icon-elegant-options12', 'icon-elegant-origami11', 'icon-elegant-ortography4', 'icon-elegant-photo15', 'icon-elegant-picture65', 'icon-elegant-play138', 'icon-elegant-player16', 'icon-elegant-plugged', 'icon-elegant-pointer39', 'icon-elegant-pointer6', 'icon-elegant-quaver23', 'icon-elegant-record15', 'icon-elegant-rightarrow10', 'icon-elegant-rightarrow11', 'icon-elegant-safebox1', 'icon-elegant-shields', 'icon-elegant-shrink', 'icon-elegant-shuffle2', 'icon-elegant-sign28', 'icon-elegant-sign29', 'icon-elegant-sign30', 'icon-elegant-signal55', 'icon-elegant-sound8', 'icon-elegant-speakers1', 'icon-elegant-squared4', 'icon-elegant-start6', 'icon-elegant-tactile', 'icon-elegant-telephone141', 'icon-elegant-textalignment3', 'icon-elegant-textalignment4', 'icon-elegant-tick19', 'icon-elegant-touchscreen2', 'icon-elegant-touchscreen3', 'icon-elegant-typographic', 'icon-elegant-typography4', 'icon-elegant-uparrow20', 'icon-elegant-usb5', 'icon-elegant-volumecontrol4', 'icon-elegant-volumecontrol5', 'icon-elegant-wifi9', 'icon-elegant-wristwatch14' );
		return array_combine($el_icons, $el_icons);
	}
}

/**
 *
 * Hex to Rgba
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'rs_hex2rgba' ) ) {
	function rs_hex2rgba( $hexcolor, $opacity = 1 ) {

		$hex    = str_replace( '#', '', $hexcolor );

		if( strlen( $hex ) == 3 ) {
			$r    = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g    = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b    = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r    = hexdec( substr( $hex, 0, 2 ) );
			$g    = hexdec( substr( $hex, 2, 2 ) );
			$b    = hexdec( substr( $hex, 4, 2 ) );
		}

		return ( isset( $opacity ) && $opacity != 1 ) ? 'rgba('. $r .', '. $g .', '. $b .', '. $opacity .')' : ' ' . $hexcolor;
	}
}

/**
 *
 * Get Fontawesome Icons
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( !function_exists('rs_fontawesome_icons')) {
	function rs_fontawesome_icons() {
		$icons = array(
			'fa fa-glass',
			'fa fa-music',
			'fa fa-search',
			'fa fa-envelope-o',
			'fa fa-heart',
			'fa fa-star',
			'fa fa-star-o',
			'fa fa-user',
			'fa fa-film',
			'fa fa-th-large',
			'fa fa-th',
			'fa fa-th-list',
			'fa fa-check',
			'fa fa-times',
			'fa fa-search-plus',
			'fa fa-search-minus',
			'fa fa-power-off',
			'fa fa-signal',
			'fa fa-cog',
			'fa fa-trash-o',
			'fa fa-home',
			'fa fa-file-o',
			'fa fa-clock-o',
			'fa fa-road',
			'fa fa-download',
			'fa fa-arrow-circle-o-down',
			'fa fa-arrow-circle-o-up',
			'fa fa-inbox',
			'fa fa-play-circle-o',
			'fa fa-repeat',
			'fa fa-refresh',
			'fa fa-list-alt',
			'fa fa-lock',
			'fa fa-flag',
			'fa fa-headphones',
			'fa fa-volume-off',
			'fa fa-volume-down',
			'fa fa-volume-up',
			'fa fa-qrcode',
			'fa fa-barcode',
			'fa fa-tag',
			'fa fa-tags',
			'fa fa-book',
			'fa fa-bookmark',
			'fa fa-print',
			'fa fa-camera',
			'fa fa-font',
			'fa fa-bold',
			'fa fa-italic',
			'fa fa-text-height',
			'fa fa-text-width',
			'fa fa-align-left',
			'fa fa-align-center',
			'fa fa-align-right',
			'fa fa-align-justify',
			'fa fa-list',
			'fa fa-outdent',
			'fa fa-indent',
			'fa fa-video-camera',
			'fa fa-picture-o',
			'fa fa-pencil',
			'fa fa-map-marker',
			'fa fa-adjust',
			'fa fa-tint',
			'fa fa-pencil-square-o',
			'fa fa-share-square-o',
			'fa fa-check-square-o',
			'fa fa-arrows',
			'fa fa-step-backward',
			'fa fa-fast-backward',
			'fa fa-backward',
			'fa fa-play',
			'fa fa-pause',
			'fa fa-stop',
			'fa fa-forward',
			'fa fa-fast-forward',
			'fa fa-step-forward',
			'fa fa-eject',
			'fa fa-chevron-left',
			'fa fa-chevron-right',
			'fa fa-plus-circle',
			'fa fa-minus-circle',
			'fa fa-times-circle',
			'fa fa-check-circle',
			'fa fa-question-circle',
			'fa fa-info-circle',
			'fa fa-crosshairs',
			'fa fa-times-circle-o',
			'fa fa-check-circle-o',
			'fa fa-ban',
			'fa fa-arrow-left',
			'fa fa-arrow-right',
			'fa fa-arrow-up',
			'fa fa-arrow-down',
			'fa fa-share',
			'fa fa-expand',
			'fa fa-compress',
			'fa fa-plus',
			'fa fa-minus',
			'fa fa-asterisk',
			'fa fa-exclamation-circle',
			'fa fa-gift',
			'fa fa-leaf',
			'fa fa-fire',
			'fa fa-eye',
			'fa fa-eye-slash',
			'fa fa-exclamation-triangle',
			'fa fa-plane',
			'fa fa-calendar',
			'fa fa-random',
			'fa fa-comment',
			'fa fa-magnet',
			'fa fa-chevron-up',
			'fa fa-chevron-down',
			'fa fa-retweet',
			'fa fa-shopping-cart',
			'fa fa-folder',
			'fa fa-folder-open',
			'fa fa-arrows-v',
			'fa fa-arrows-h',
			'fa fa-bar-chart',
			'fa fa-twitter-square',
			'fa fa-facebook-square',
			'fa fa-camera-retro',
			'fa fa-key',
			'fa fa-cogs',
			'fa fa-comments',
			'fa fa-thumbs-o-up',
			'fa fa-thumbs-o-down',
			'fa fa-star-half',
			'fa fa-heart-o',
			'fa fa-sign-out',
			'fa fa-linkedin-square',
			'fa fa-thumb-tack',
			'fa fa-external-link',
			'fa fa-sign-in',
			'fa fa-trophy',
			'fa fa-github-square',
			'fa fa-upload',
			'fa fa-lemon-o',
			'fa fa-phone',
			'fa fa-square-o',
			'fa fa-bookmark-o',
			'fa fa-phone-square',
			'fa fa-twitter',
			'fa fa-facebook',
			'fa fa-github',
			'fa fa-unlock',
			'fa fa-credit-card',
			'fa fa-rss',
			'fa fa-hdd-o',
			'fa fa-bullhorn',
			'fa fa-bell',
			'fa fa-certificate',
			'fa fa-hand-o-right',
			'fa fa-hand-o-left',
			'fa fa-hand-o-up',
			'fa fa-hand-o-down',
			'fa fa-arrow-circle-left',
			'fa fa-arrow-circle-right',
			'fa fa-arrow-circle-up',
			'fa fa-arrow-circle-down',
			'fa fa-globe',
			'fa fa-wrench',
			'fa fa-tasks',
			'fa fa-filter',
			'fa fa-briefcase',
			'fa fa-arrows-alt',
			'fa fa-users',
			'fa fa-link',
			'fa fa-cloud',
			'fa fa-flask',
			'fa fa-scissors',
			'fa fa-files-o',
			'fa fa-paperclip',
			'fa fa-floppy-o',
			'fa fa-square',
			'fa fa-bars',
			'fa fa-list-ul',
			'fa fa-list-ol',
			'fa fa-strikethrough',
			'fa fa-underline',
			'fa fa-table',
			'fa fa-magic',
			'fa fa-truck',
			'fa fa-pinterest',
			'fa fa-pinterest-square',
			'fa fa-google-plus-square',
			'fa fa-google-plus',
			'fa fa-money',
			'fa fa-caret-down',
			'fa fa-caret-up',
			'fa fa-caret-left',
			'fa fa-caret-right',
			'fa fa-columns',
			'fa fa-sort',
			'fa fa-sort-desc',
			'fa fa-sort-asc',
			'fa fa-envelope',
			'fa fa-linkedin',
			'fa fa-undo',
			'fa fa-gavel',
			'fa fa-tachometer',
			'fa fa-comment-o',
			'fa fa-comments-o',
			'fa fa-bolt',
			'fa fa-sitemap',
			'fa fa-umbrella',
			'fa fa-clipboard',
			'fa fa-lightbulb-o',
			'fa fa-exchange',
			'fa fa-cloud-download',
			'fa fa-cloud-upload',
			'fa fa-user-md',
			'fa fa-stethoscope',
			'fa fa-suitcase',
			'fa fa-bell-o',
			'fa fa-coffee',
			'fa fa-cutlery',
			'fa fa-file-text-o',
			'fa fa-building-o',
			'fa fa-hospital-o',
			'fa fa-ambulance',
			'fa fa-medkit',
			'fa fa-fighter-jet',
			'fa fa-beer',
			'fa fa-h-square',
			'fa fa-plus-square',
			'fa fa-angle-double-left',
			'fa fa-angle-double-right',
			'fa fa-angle-double-up',
			'fa fa-angle-double-down',
			'fa fa-angle-left',
			'fa fa-angle-right',
			'fa fa-angle-up',
			'fa fa-angle-down',
			'fa fa-desktop',
			'fa fa-laptop',
			'fa fa-tablet',
			'fa fa-mobile',
			'fa fa-circle-o',
			'fa fa-quote-left',
			'fa fa-quote-right',
			'fa fa-spinner',
			'fa fa-circle',
			'fa fa-reply',
			'fa fa-github-alt',
			'fa fa-folder-o',
			'fa fa-folder-open-o',
			'fa fa-smile-o',
			'fa fa-frown-o',
			'fa fa-meh-o',
			'fa fa-gamepad',
			'fa fa-keyboard-o',
			'fa fa-flag-o',
			'fa fa-flag-checkered',
			'fa fa-terminal',
			'fa fa-code',
			'fa fa-reply-all',
			'fa fa-star-half-o',
			'fa fa-location-arrow',
			'fa fa-crop',
			'fa fa-code-fork',
			'fa fa-chain-broken',
			'fa fa-question',
			'fa fa-info',
			'fa fa-exclamation',
			'fa fa-superscript',
			'fa fa-subscript',
			'fa fa-eraser',
			'fa fa-puzzle-piece',
			'fa fa-microphone',
			'fa fa-microphone-slash',
			'fa fa-shield',
			'fa fa-calendar-o',
			'fa fa-fire-extinguisher',
			'fa fa-rocket',
			'fa fa-maxcdn',
			'fa fa-chevron-circle-left',
			'fa fa-chevron-circle-right',
			'fa fa-chevron-circle-up',
			'fa fa-chevron-circle-down',
			'fa fa-html5',
			'fa fa-css3',
			'fa fa-anchor',
			'fa fa-unlock-alt',
			'fa fa-bullseye',
			'fa fa-ellipsis-h',
			'fa fa-ellipsis-v',
			'fa fa-rss-square',
			'fa fa-play-circle',
			'fa fa-ticket',
			'fa fa-minus-square',
			'fa fa-minus-square-o',
			'fa fa-level-up',
			'fa fa-level-down',
			'fa fa-check-square',
			'fa fa-pencil-square',
			'fa fa-external-link-square',
			'fa fa-share-square',
			'fa fa-compass',
			'fa fa-caret-square-o-down',
			'fa fa-caret-square-o-up',
			'fa fa-caret-square-o-right',
			'fa fa-eur',
			'fa fa-gbp',
			'fa fa-usd',
			'fa fa-inr',
			'fa fa-jpy',
			'fa fa-rub',
			'fa fa-krw',
			'fa fa-btc',
			'fa fa-file',
			'fa fa-file-text',
			'fa fa-sort-alpha-asc',
			'fa fa-sort-alpha-desc',
			'fa fa-sort-amount-asc',
			'fa fa-sort-amount-desc',
			'fa fa-sort-numeric-asc',
			'fa fa-sort-numeric-desc',
			'fa fa-thumbs-up',
			'fa fa-thumbs-down',
			'fa fa-youtube-square',
			'fa fa-youtube',
			'fa fa-xing',
			'fa fa-xing-square',
			'fa fa-youtube-play',
			'fa fa-dropbox',
			'fa fa-stack-overflow',
			'fa fa-instagram',
			'fa fa-flickr',
			'fa fa-adn',
			'fa fa-bitbucket',
			'fa fa-bitbucket-square',
			'fa fa-tumblr',
			'fa fa-tumblr-square',
			'fa fa-long-arrow-down',
			'fa fa-long-arrow-up',
			'fa fa-long-arrow-left',
			'fa fa-long-arrow-right',
			'fa fa-apple',
			'fa fa-windows',
			'fa fa-android',
			'fa fa-linux',
			'fa fa-dribbble',
			'fa fa-skype',
			'fa fa-foursquare',
			'fa fa-trello',
			'fa fa-female',
			'fa fa-male',
			'fa fa-gratipay',
			'fa fa-sun-o',
			'fa fa-moon-o',
			'fa fa-archive',
			'fa fa-bug',
			'fa fa-vk',
			'fa fa-weibo',
			'fa fa-renren',
			'fa fa-pagelines',
			'fa fa-stack-exchange',
			'fa fa-arrow-circle-o-right',
			'fa fa-arrow-circle-o-left',
			'fa fa-caret-square-o-left',
			'fa fa-dot-circle-o',
			'fa fa-wheelchair',
			'fa fa-vimeo-square',
			'fa fa-try',
			'fa fa-plus-square-o',
			'fa fa-space-shuttle',
			'fa fa-slack',
			'fa fa-envelope-square',
			'fa fa-wordpress',
			'fa fa-openid',
			'fa fa-university',
			'fa fa-graduation-cap',
			'fa fa-yahoo',
			'fa fa-google',
			'fa fa-reddit',
			'fa fa-reddit-square',
			'fa fa-stumbleupon-circle',
			'fa fa-stumbleupon',
			'fa fa-delicious',
			'fa fa-digg',
			'fa fa-pied-piper-pp',
			'fa fa-pied-piper-alt',
			'fa fa-drupal',
			'fa fa-joomla',
			'fa fa-language',
			'fa fa-fax',
			'fa fa-building',
			'fa fa-child',
			'fa fa-paw',
			'fa fa-spoon',
			'fa fa-cube',
			'fa fa-cubes',
			'fa fa-behance',
			'fa fa-behance-square',
			'fa fa-steam',
			'fa fa-steam-square',
			'fa fa-recycle',
			'fa fa-car',
			'fa fa-taxi',
			'fa fa-tree',
			'fa fa-spotify',
			'fa fa-deviantart',
			'fa fa-soundcloud',
			'fa fa-database',
			'fa fa-file-pdf-o',
			'fa fa-file-word-o',
			'fa fa-file-excel-o',
			'fa fa-file-powerpoint-o',
			'fa fa-file-image-o',
			'fa fa-file-archive-o',
			'fa fa-file-audio-o',
			'fa fa-file-video-o',
			'fa fa-file-code-o',
			'fa fa-vine',
			'fa fa-codepen',
			'fa fa-jsfiddle',
			'fa fa-life-ring',
			'fa fa-circle-o-notch',
			'fa fa-rebel',
			'fa fa-empire',
			'fa fa-git-square',
			'fa fa-git',
			'fa fa-hacker-news',
			'fa fa-tencent-weibo',
			'fa fa-qq',
			'fa fa-weixin',
			'fa fa-paper-plane',
			'fa fa-paper-plane-o',
			'fa fa-history',
			'fa fa-circle-thin',
			'fa fa-header',
			'fa fa-paragraph',
			'fa fa-sliders',
			'fa fa-share-alt',
			'fa fa-share-alt-square',
			'fa fa-bomb',
			'fa fa-futbol-o',
			'fa fa-tty',
			'fa fa-binoculars',
			'fa fa-plug',
			'fa fa-slideshare',
			'fa fa-twitch',
			'fa fa-yelp',
			'fa fa-newspaper-o',
			'fa fa-wifi',
			'fa fa-calculator',
			'fa fa-paypal',
			'fa fa-google-wallet',
			'fa fa-cc-visa',
			'fa fa-cc-mastercard',
			'fa fa-cc-discover',
			'fa fa-cc-amex',
			'fa fa-cc-paypal',
			'fa fa-cc-stripe',
			'fa fa-bell-slash',
			'fa fa-bell-slash-o',
			'fa fa-trash',
			'fa fa-copyright',
			'fa fa-at',
			'fa fa-eyedropper',
			'fa fa-paint-brush',
			'fa fa-birthday-cake',
			'fa fa-area-chart',
			'fa fa-pie-chart',
			'fa fa-line-chart',
			'fa fa-lastfm',
			'fa fa-lastfm-square',
			'fa fa-toggle-off',
			'fa fa-toggle-on',
			'fa fa-bicycle',
			'fa fa-bus',
			'fa fa-ioxhost',
			'fa fa-angellist',
			'fa fa-cc',
			'fa fa-ils',
			'fa fa-meanpath',
			'fa fa-buysellads',
			'fa fa-connectdevelop',
			'fa fa-dashcube',
			'fa fa-forumbee',
			'fa fa-leanpub',
			'fa fa-sellsy',
			'fa fa-shirtsinbulk',
			'fa fa-simplybuilt',
			'fa fa-skyatlas',
			'fa fa-cart-plus',
			'fa fa-cart-arrow-down',
			'fa fa-diamond',
			'fa fa-ship',
			'fa fa-user-secret',
			'fa fa-motorcycle',
			'fa fa-street-view',
			'fa fa-heartbeat',
			'fa fa-venus',
			'fa fa-mars',
			'fa fa-mercury',
			'fa fa-transgender',
			'fa fa-transgender-alt',
			'fa fa-venus-double',
			'fa fa-mars-double',
			'fa fa-venus-mars',
			'fa fa-mars-stroke',
			'fa fa-mars-stroke-v',
			'fa fa-mars-stroke-h',
			'fa fa-neuter',
			'fa fa-genderless',
			'fa fa-facebook-official',
			'fa fa-pinterest-p',
			'fa fa-whatsapp',
			'fa fa-server',
			'fa fa-user-plus',
			'fa fa-user-times',
			'fa fa-bed',
			'fa fa-viacoin',
			'fa fa-train',
			'fa fa-subway',
			'fa fa-medium',
			'fa fa-y-combinator',
			'fa fa-optin-monster',
			'fa fa-opencart',
			'fa fa-expeditedssl',
			'fa fa-battery-full',
			'fa fa-battery-three-quarters',
			'fa fa-battery-half',
			'fa fa-battery-quarter',
			'fa fa-battery-empty',
			'fa fa-mouse-pointer',
			'fa fa-i-cursor',
			'fa fa-object-group',
			'fa fa-object-ungroup',
			'fa fa-sticky-note',
			'fa fa-sticky-note-o',
			'fa fa-cc-jcb',
			'fa fa-cc-diners-club',
			'fa fa-clone',
			'fa fa-balance-scale',
			'fa fa-hourglass-o',
			'fa fa-hourglass-start',
			'fa fa-hourglass-half',
			'fa fa-hourglass-end',
			'fa fa-hourglass',
			'fa fa-hand-rock-o',
			'fa fa-hand-paper-o',
			'fa fa-hand-scissors-o',
			'fa fa-hand-lizard-o',
			'fa fa-hand-spock-o',
			'fa fa-hand-pointer-o',
			'fa fa-hand-peace-o',
			'fa fa-trademark',
			'fa fa-registered',
			'fa fa-creative-commons',
			'fa fa-gg',
			'fa fa-gg-circle',
			'fa fa-tripadvisor',
			'fa fa-odnoklassniki',
			'fa fa-odnoklassniki-square',
			'fa fa-get-pocket',
			'fa fa-wikipedia-w',
			'fa fa-safari',
			'fa fa-chrome',
			'fa fa-firefox',
			'fa fa-opera',
			'fa fa-internet-explorer',
			'fa fa-television',
			'fa fa-contao',
			'fa fa-500px',
			'fa fa-amazon',
			'fa fa-calendar-plus-o',
			'fa fa-calendar-minus-o',
			'fa fa-calendar-times-o',
			'fa fa-calendar-check-o',
			'fa fa-industry',
			'fa fa-map-pin',
			'fa fa-map-signs',
			'fa fa-map-o',
			'fa fa-map',
			'fa fa-commenting',
			'fa fa-commenting-o',
			'fa fa-houzz',
			'fa fa-vimeo',
			'fa fa-black-tie',
			'fa fa-fonticons',
			'fa fa-reddit-alien',
			'fa fa-edge',
			'fa fa-credit-card-alt',
			'fa fa-codiepie',
			'fa fa-modx',
			'fa fa-fort-awesome',
			'fa fa-usb',
			'fa fa-product-hunt',
			'fa fa-mixcloud',
			'fa fa-scribd',
			'fa fa-pause-circle',
			'fa fa-pause-circle-o',
			'fa fa-stop-circle',
			'fa fa-stop-circle-o',
			'fa fa-shopping-bag',
			'fa fa-shopping-basket',
			'fa fa-hashtag',
			'fa fa-bluetooth',
			'fa fa-bluetooth-b',
			'fa fa-percent',
			'fa fa-gitlab',
			'fa fa-wpbeginner',
			'fa fa-wpforms',
			'fa fa-envira',
			'fa fa-universal-access',
			'fa fa-wheelchair-alt',
			'fa fa-question-circle-o',
			'fa fa-blind',
			'fa fa-audio-description',
			'fa fa-volume-control-phone',
			'fa fa-braille',
			'fa fa-assistive-listening-systems',
			'fa fa-american-sign-language-interpreting',
			'fa fa-deaf',
			'fa fa-glide',
			'fa fa-glide-g',
			'fa fa-sign-language',
			'fa fa-low-vision',
			'fa fa-viadeo',
			'fa fa-viadeo-square',
			'fa fa-snapchat',
			'fa fa-snapchat-ghost',
			'fa fa-snapchat-square',
			'fa fa-pied-piper',
			'fa fa-first-order',
			'fa fa-yoast',
			'fa fa-themeisle',
			'fa fa-google-plus-official',
			'fa fa-font-awesome',
		);
		return array_combine($icons, $icons);
	}
}

/**
 *
 * Walker Category
 * @since 1.0.0
 * @version 1.1.0
 *
 */
class Walker_Portfolio_List_Categories extends Walker_Category {

	function start_el( &$output, $category, $depth = 0, $args = array(), $current_object_id = 0 ) {

		$has_children = get_term_children( $category->term_id, 'portfolio-category' );

		if( empty( $has_children ) ) {
			$cat_name = esc_attr( $category->name );
			$cat_name = apply_filters( 'list_cats', $cat_name, $category );
			$link     = '<a class="filter" data-filter=".portfolio_cat-' . $category->term_id . ' ">';
			$link    .= $cat_name;
			$link    .= '</a>';
			$output  .= $link;
		}

	}

	function end_el( &$output, $page, $depth = 0, $args = array() ) {}

}

/**
 *
 * Set WPAUTOP for shortcode output
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'rs_set_wpautop' ) ) {
	function rs_set_wpautop( $content, $force = true ) {
		if ( $force ) {
			$content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
		}
		return do_shortcode( shortcode_unautop( $content ) );
	}
}

/**
 *
 * element values post, page, categories
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'rs_element_values' ) ) {
	function rs_element_values(  $type = '', $query_args = array() ) {

		$options = array();

		switch( $type ) {

			case 'pages':
			case 'page':
			$pages = get_pages( $query_args );

			if ( !empty($pages) ) {
				foreach ( $pages as $page ) {
					$options[$page->post_title] = $page->ID;
				}
			}
			break;

			case 'posts':
			case 'post':
			$posts = get_posts( $query_args );

			//print_r($posts);

			if ( !empty($posts) ) {
				foreach ( $posts as $post ) {
					$options[$post->post_title] = lcfirst($post->ID);
				}
			}
			break;

			case 'tags':
			case 'tag':

			$tags = get_terms( $query_args['taxonomies'], $query_args['args'] );
				if ( !empty($tags) ) {
					foreach ( $tags as $tag ) {
						$options[$tag->name] = $tag->term_id;
				}
			}
			break;

			case 'categories':
			case 'category':

			$categories = get_categories( $query_args );
			if ( !empty($categories) ) {
				foreach ( $categories as $category ) {
					$options[$category->name] = $category->term_id;
				}
			}
			break;

			case 'custom':
			case 'callback':

			if( is_callable( $query_args['function'] ) ) {
				$options = call_user_func( $query_args['function'], $query_args['args'] );
			}

			break;

		}
	
	if (!is_array($options)) {
		return array();
	}
	
		return $options;

	}
}

/**
 *
 * Animations
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'rs_get_animations' ) ) {
	function rs_get_animations() {

		$animations = array(
			'',
			'fadeIn',
			'fadeInLeft',
			'fadeInRight',
			'fadeInUp',
			'fadeInDown',
			'bounce',
			'flash',
			'pulse',
			'shake',
			'swing',
			'tada',
			'wobble',
			'bounceIn',
			'bounceInLeft',
			'bounceInRight',
			'bounceInUp',
			'bounceInDown',
		);

		$animations = apply_filters( 'rs_animations', $animations );
		return $animations;

	}
}

/**
 *
 * Get Bootstrap Col
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'rs_get_bootstrap_col' ) ) {
	function rs_get_bootstrap_col( $width = '' ) {
		$width = explode('/', $width);
		$width = ( $width[0] != '1' ) ? $width[0] * floor(12 / $width[1]) : floor(12 / $width[1]);
		return  $width;
	}
}

/**
 * Get font choices for theme options
 * @param bool $return_string if true returned array is strict, example array item: font_name => font_label
 * @return array
 */
if(!function_exists('rs_get_font_choices')) {
	function rs_get_font_choices($return_strict = false) {
		$aFonts = array(
			array(
				'value' => 'default',
				'label' => __('Default', 'rhythm-addons'),
				'src' => ''
			),
			array(
				'value' => 'Verdana',
				'label' => 'Verdana',
				'src' => ''
			),
			array(
				'value' => 'Geneva',
				'label' => 'Geneva',
				'src' => ''
			),
			array(
				'value' => 'Arial',
				'label' => 'Arial',
				'src' => ''
			),
			array(
				'value' => 'Arial Black',
				'label' => 'Arial Black',
				'src' => ''
			),
			array(
				'value' => 'Trebuchet MS',
				'label' => 'Trebuchet MS',
				'src' => ''
			),
			array(
				'value' => 'Helvetica',
				'label' => 'Helvetica',
				'src' => ''
			),
			array(
				'value' => 'sans-serif',
				'label' => 'sans-serif',
				'src' => ''
			),
			array(
				'value' => 'Georgia',
				'label' => 'Georgia',
				'src' => ''
			),
			array(
				'value' => 'Times New Roman',
				'label' => 'Times New Roman',
				'src' => ''
			),
			array(
				'value' => 'Times',
				'label' => 'Times',
				'src' => ''
			),
			array(
				'value' => 'serif',
				'label' => 'serif',
				'src' => ''
			),
			array(
				'value' => 'Nella Sue',
				'label' => 'Nella Sue',
				'src' => ''
			)
		);

		if (file_exists(RS_ROOT . '/composer/google-fonts.json')) {

			//ts_load_filesystem();
			//WP_Filesystem();
			//global $wp_filesystem;

			//$google_fonts = $wp_filesystem->get_contents(get_template_directory() . '/framework/fonts/google-fonts.json');
			$google_fonts = file_get_contents(RS_ROOT . '/composer/google-fonts.json', true);
			$aGoogleFonts = json_decode($google_fonts, true);

			if (!isset($aGoogleFonts['items']) || !is_array($aGoogleFonts['items'])) {
				return;
			}

			$aFonts[] = array(
				'value' => 'google_web_fonts',
				'label' => '---Google Web Fonts---',
				'src' => ''
			);

			foreach ($aGoogleFonts['items'] as $aGoogleFont) {
				$aFonts[] = array(
					'value' => 'google_web_font_' . $aGoogleFont['family'],
					'label' => $aGoogleFont['family'],
					'src' => ''
				);
			}
		}

		if ($return_strict) {
			$aFonts2 = array();
			foreach ($aFonts as $font) {
				$aFonts2[$font['value']] = $font['label'];
			}
			return $aFonts2;
		}
		return $aFonts;
	}
}

/**
 * Get custom term values array
 * @param type $type
 * @return type
 */
function rs_get_custom_term_values($type) {

	$items = array();
	$terms = get_terms($type, array('orderby' => 'name'));
	if (is_array($terms) && !is_wp_error($terms)) {
		foreach ($terms as $term) {
			$items[$term -> name] = $term -> term_id;
		}
	}
	return $items;
}
