<?php
/**
 * Customizer Section
 */

$this->sections[] = array(
	'title' => __('Customizer', 'rhythm'),
	'desc' => __('Check child sections to style properly the correct area of the theme.', 'rhythm'),
	'icon' => 'el-icon-cog',
	'fields' => array(
				
	), // #fields
);
/**
 * Header Section
 */
$this->sections[] = array(
	'title' => __('Header', 'rhythm'),
	'desc' => __('Configure header styles.', 'rhythm'),
	'subsection' => true,
	'fields' => array(

		array(
			'id' => 'customizer-header-background',
			'type' => 'background',
			'output' => array('.main-nav, .main-nav.dark'),
			'title' => __('Background', 'rhythm'),
			'subtitle' => __('Header background with image, color and other options.', 'rhythm'),
		),
		
		array(
			'id' => 'customizer-header-typography',
			'type' => 'typography',
			'title' => __('Typography', 'rhythm'),
			'subtitle' => __('Menu, modules and other header items font.', 'rhythm'),
			'font-size'=> false,
			'line-height'=> false,
			'text-align' => false,
			'color' => false,
			'output' => array('.main-nav .inner-nav ul > li > a, .main-nav.dark .inner-nav ul > li > a'),
		),
		
		array(
			'id'        => 'customizer-header-submenu-background-color',
			'type'      => 'color',
			'title'     => __('Submenu Background Color', 'rhythm'),
			'default'   => '',
			'output'    => array('background-color' => '.mn-sub')
		),
	),
);

/**
 * Title Wrapper Section
 */
$this->sections[] = array(
	'title' => __('Title Wrapper', 'rhythm'),
	'desc' => __('Configure title wrapper styles.', 'rhythm'),
	'subsection' => true,
	'fields' => array(

		array(
			'id' => 'customizer-title-wrapper-background',
			'type' => 'background',
			'background-image' => false,
			'output' => array('.title-wrapper'),
			'title' => __('Background', 'rhythm'),
			'subtitle' => __('Title wrapper background, color and other options. Background image can be set in <em>Title Wrapper</em> section outside <em>Customizer</em>.', 'rhythm'),
		),
		
		array(
			'id' => 'customizer-title-wrapper-typography',
			'type' => 'typography',
			'title' => __('Typography', 'rhythm'),
			'subtitle' => __('Title and other items font.', 'rhythm'),
			'font-size'=> false,
			'line-height'=> false,
			'text-align' => false,
			'color' => false,
			'output' => array('.title-wrapper .hs-line-11, .title-wrapper .hs-line-4, .mod-breadcrumbs, .mod-breadcrumbs a, .mod-breadcrumbs span'),
		),
		
		array(
			'id'        => 'customizer-title-wrapper-title-color',
			'type'      => 'color',
			'title'     => __('Title Color', 'rhythm'),
			'default'   => '',
			'output'    => array('color' => '.title-wrapper .hs-line-11')
		),
		
		array(
			'id'        => 'customizer-title-wrapper-subtitle-color',
			'type'      => 'color',
			'title'     => __('Subtitle Color', 'rhythm'),
			'default'   => '',
			'output'    => array('color' => '.title-wrapper .hs-line-4')
		),
		
		array(
			'id'        => 'customizer-title-wrapper-breadcrumbs-color',
			'type'      => 'color',
			'title'     => __('Breadcrumbs Color', 'rhythm'),
			'default'   => '',
			'output'    => array('color' => '.mod-breadcrumbs, .mod-breadcrumbs a')
		),
		
		array(
			'id'        => 'customizer-title-wrapper-breadcrumbs-active-color',
			'type'      => 'color',
			'title'     => __('Breadcrumbs Active Item Color', 'rhythm'),
			'default'   => '',
			'output'    => array('color' => '.mod-breadcrumbs span')
		),
	),
);

/**
 * Content Section
 */
$this->sections[] = array(
	'title' => __('Content', 'rhythm'),
	'desc' => __('Configure content styles.', 'rhythm'),
	'subsection' => true,
	'fields' => array(

		array(
			'id' => 'customizer-content-background',
			'type' => 'background',
			'output' => array('.main-section'),
			'title' => __('Background', 'rhythm'),
			'subtitle' => __('Content background, color and other options.', 'rhythm'),
		),
		
		array(
			'id' => 'customizer-content-typography',
			'type' => 'typography',
			'title' => __('Typography', 'rhythm'),
			'subtitle' => __('Content font.', 'rhythm'),
			'font-size'=> false,
			'line-height'=> false,
			'text-align' => false,
			'color' => false,
			'output' => array('.main-section'),
		),
		
		array(
			'id' => 'customizer-alt-content-typography',
			'type' => 'typography',
			'title' => __('Alternative Typography', 'rhythm'),
			'subtitle' => __('Font used for content headers and other items where not main one is used.', 'rhythm'),
			'font-size'=> false,
			'line-height'=> false,
			'text-align' => false,
			'color' => false,
			'output' => array('.font-alt'),
		),
		
		array(
			'id'        => 'customizer-content-text-color',
			'type'      => 'color',
			'title'     => __('Color (1)', 'rhythm'),
			'subtitle'     => __('Default text color. Gray elements by default.', 'rhythm'),
			'default'   => '',
			'output'    => array('color' => '
				/* Overriding: #777,#555, #888, #5F5F5F */
				blockquote,
				.section-text,
				.team-item-detail,
				.widget_wysija input[type="text"],
				.wpcf7-form input[type="text"],
				.wpcf7-form input[type="email"],
				.form input[type="text"],
				.form input[type="email"],
				.form input[type="number"],
				.form input[type="url"],
				.form input[type="search"],
				.form input[type="tel"],
				.form input[type="password"],
				.form input[type="date"],
				.form input[type="color"],
				.form select,
				.comment-form input[type="text"],
				.comment-form input[type="email"],
				.comment-form input[type="number"],
				.comment-form input[type="url"],
				.comment-form input[type="search"],
				.comment-form input[type="tel"],
				.comment-form input[type="password"],
				.comment-form input[type="date"],
				.comment-form input[type="color"],
				.comment-form select,
				.form textarea,
				.comment-form textarea,
				.wpcf7-form textarea,
				.team-item-descr,
				.alt-features-descr,
				.benefits-descr,
				.work-full-text,
				.work-full-detail,
				.post-prev-title a,
				.post-prev-text,
				
				.ci-title,
				.gm-style-iw div,
				.blog-item-title a:hover,
				.blog-item-more,
				.post-navigation a,
				a.blog-item-more,
				.post-navigation a,
				.blog-item-q:hover a,
				.blog-item-q p a:hover,
				.blog-item-q p:hover:before,
				.blog-item-q p:hover:after,
				.comment-item-data,
				.comment-item-data a,
				.widget-title,
				.widget-body,
				.widget,
				.widget input[type="text"],
				.widget input[type="email"],
				.widget input[type="number"],
				.widget input[type="url"],
				.widget input[type="search"],
				.widget input[type="tel"],
				.widget input[type="password"],
				.widget input[type="date"],
				.widget input[type="color"],
				.widget select,
				.widget textarea,
				.widget.widget_tag_cloud .tagcloud a,
				.pr-list,
				.tpl-tabs > li > a,
				.tpl-tabs-cont,
				.tpl-minimal-tabs > li > a:hover,
				.alert,
				.accordion > dt > a,
				.accordion > dd,
				.toggle > dt > a,
				.toggle > dd,
				.woocommerce .woocommerce-review-link,
				.woocommerce .star-rating span,
				.woocommerce form .form-row input.input-text,
				.woocommerce form .form-row .input-text, 
				.woocommerce-page form .form-row .input-text,
				
				.btn-mod.btn-gray,
				.btn-icon > span,

				.works-filter,
				.work-navigation a,
				.work-navigation a:visited,
				.wpcf7-form-control,
				.date-num,
				.blog-item-q p a,
				.widget strong,
				.widget ul li a,
				.widget.widget_calendar table thead th,
				.widget-comments li a,
				.widget .widget-posts li a,
				.highlight pre,
				.fa-examples,
				.et-examples,
				
				a:hover,
				.footer a,
				
				.text,
				.blog-item-body,
				caption,
				blockquote footer, 
				blockquote small, 
				blockquote .small
				
			'),
		),
		
		array(
			'id'        => 'customizer-content-active-color',
			'type'      => 'color',
			'title'     => __('Color (2)', 'rhythm'),
			'subtitle'     => __('Active elements, links, text. Dark elements by default.', 'rhythm'),
			'default'   => '',
			'output'    => 
				array('color' => '
					/* Overriding: #111, #252525, #000 */
					body,
					a,
					.text h1,
					.text h2,
					.text h3,
					.text h4,
					.text h5,
					.text h6,
					.btn-mod.btn-border-w:hover,
					.btn-mod.btn-border-w:focus,
					.btn-mod.btn-w,
					.btn-mod.btn-w:hover,
					.btn-mod.btn-w:focus,
					table thead th,
					.wpcf7-form input[type="text"].wpcf7-form-control:focus,
					.wpcf7-form input[type="email"].wpcf7-form-control:focus,
					.widget_wysija input[type="text"].wysija-input:focus,
					.form input[type="text"]:focus,
					.form input[type="email"]:focus,
					.form input[type="number"]:focus,
					.form input[type="url"]:focus,
					.form input[type="search"]:focus,
					.form input[type="tel"]:focus,
					.form input[type="password"]:focus,
					.form input[type="date"]:focus,
					.form input[type="color"]:focus,
					.form select:focus,
					.comment-form input[type="text"]:focus,
					.comment-form input[type="email"]:focus,
					.comment-form input[type="number"]:focus,
					.comment-form input[type="url"]:focus,
					.comment-form input[type="search"]:focus,
					.comment-form input[type="tel"]:focus,
					.comment-form input[type="password"]:focus,
					.comment-form input[type="date"]:focus,
					.comment-form input[type="color"]:focus,
					.comment-form select:focus,
					.form textarea:focus,
					.comment-form textarea:focus,
					.wpcf7-form textarea:focus,
					.scroll-down-icon,
					.bg-dark,
					.section-line,
					.alt-service-icon,
					.alt-services-title,
					.no-mobile .team-item:hover .team-item-descr,
					.team-item.js-active .team-item-descr,
					.alt-features-icon,
					.works-filter a:hover,
					.works-filter a.active,
					.works-filter a.active:hover,
					.work-item a,
					.work-item a:hover,
					.work-navigation a:hover,
					.post-prev-title a:hover,
					.post-prev-info a:hover,
					.google-map,
					#map-canvas,
					.mt-icon,
					.footer a:hover,
					.footer-social-links a,
					.footer-social-links a:before,
					.footer-social-links a:hover:before,
					.blog-item-title a,
					.blog-item-more:hover,
					.post-navigation a:hover,
					a.blog-item-more:hover,
					.post-navigation a:hover,
					.widget input[type="text"]:focus,
					.widget input[type="email"]:focus,
					.widget input[type="number"]:focus,
					.widget input[type="url"]:focus,
					.widget input[type="search"]:focus,
					.widget input[type="tel"]:focus,
					.widget input[type="password"]:focus,
					.widget input[type="date"]:focus,
					.widget input[type="color"]:focus,
					.widget select:focus,
					.widget textarea:focus,
					.widget.widget_tag_cloud .tagcloud a:hover,
					.owl-prev,
					.owl-next,
					.tpl-alt-tabs > li > a:hover,
					.tpl-alt-tabs li.active a,
					.tpl-alt-tabs li.active a:hover,
					.accordion > dt > a.active:after,
					.accordion > dt > a.active:hover:after,
					.toggle > dt > a.active:after,
					.toggle > dt > a.active:hover:after,
					.et-examples .box1:hover,
					.woocommerce div.product p.price, .woocommerce div.product span.price,
					.bg-dark-lighter,
					.fa-examples > div:hover,
					.tpl-progress .progress-bar,
					.btn-mod.btn-border,
					.big-icon.black,
					.big-icon-link:hover .big-icon.black,
					.big-icon-link.black:hover,
					.big-icon-link:hover .wide-heading.black,
					.btn-icon > span.black,
					.title-wrapper .dark-subtitle,
					.section-more:hover,
					.works-grid.hover-white .work-item:hover .work-intro,
					.works-grid.hover-white .work-item:hover .work-title,
					.works-grid.hover-white .work-item:hover .work-descr,
					.contact-item a:hover,
					.blog-item-data a:hover,
					.comment-item-data a:hover,
					.tpl-tabs li.active a,
					.tpl-minimal-tabs > li > a,
					.tpl-minimal-tabs li.active a,
					.tpl-minimal-tabs li.active a:hover,
					.accordion > dt > a.active
				',
				'background-color' => '
					/* Overriding: #222, rgba(0,0,0, .7);, #000 */
					.tpl-progress .progress-bar,
					.tpl-progress-alt .progress-bar,
					.wysija-submit:hover,
					.wysija-submit:focus,
					.wpcf7-form-control.wpcf7-submit:hover,
					.wpcf7-form-control.wpcf7-submit:focus,
					.comment-form input[type=submit],
					.btn-mod:hover,
					.btn-mod:focus,
					a.btn-mod:hover,
					a.btn-mod:focus,
					.woocommerce #respond input#submit, 
					.woocommerce a.button, 
					.woocommerce button.button, 
					.woocommerce input.button,
					.woocommerce input.button.alt,
					.woocommerce #respond input#submit:hover, 
					.woocommerce a.button:hover, 
					.woocommerce button.button:hover, 
					.woocommerce input.button:hover,
					.woocommerce input.button.alt:hover,
					.btn-mod.btn-border:hover,
					.btn-mod.btn-border:focus,
					.ci-icon:before
				',
				'border-color' => '
					/* Overriding: #222, rgba(0,0,0, .7);, #000 */
					.wpcf7-form input[type="text"].wpcf7-form-control:focus,
					.wpcf7-form input[type="email"].wpcf7-form-control:focus,
					.widget_wysija input[type="text"].wysija-input:focus,
					.form input[type="text"]:focus,
					.form input[type="email"]:focus,
					.form input[type="number"]:focus,
					.form input[type="url"]:focus,
					.form input[type="search"]:focus,
					.form input[type="tel"]:focus,
					.form input[type="password"]:focus,
					.form input[type="date"]:focus,
					.form input[type="color"]:focus,
					.form select:focus,
					.comment-form input[type="text"]:focus,
					.comment-form input[type="email"]:focus,
					.comment-form input[type="number"]:focus,
					.comment-form input[type="url"]:focus,
					.comment-form input[type="search"]:focus,
					.comment-form input[type="tel"]:focus,
					.comment-form input[type="password"]:focus,
					.comment-form input[type="date"]:focus,
					.comment-form input[type="color"]:focus,
					.comment-form select:focus,
					.form textarea:focus,
					.comment-form textarea:focus,
					.wpcf7-form textarea:focus,
					.widget input[type="text"]:focus,
					.widget input[type="email"]:focus,
					.widget input[type="number"]:focus,
					.widget input[type="url"]:focus,
					.widget input[type="search"]:focus,
					.widget input[type="tel"]:focus,
					.widget input[type="password"]:focus,
					.widget input[type="date"]:focus,
					.widget input[type="color"]:focus,
					.widget select:focus,
					.widget textarea:focus,
					.btn-mod.btn-border,
					.big-icon-link:hover .big-icon.black,
					.ci-icon:before
				'
			),
			
		),
		
		array(
			'id'        => 'customizer-content-light-dark-color',
			'type'      => 'color',
			'title'     => __('Color (3)', 'rhythm'),
			'subtitle'     => __('Light dark elements by default.', 'rhythm'),
			'default'   => '',
			'output'    => array(
				'color' => '
					/* Overriding: #444, #333 */
					.contact-item,
					.contact-item a,
					.pagination a:hover,
					.pagination .page-numbers.current,
					.pagination .page-numbers.current:hover,
					.accordion > dt > a:hover,
					.accordion > dt > a:hover:after,
					.toggle > dt > a:hover,
					.toggle > dt > a:hover:after,
					.btn-mod.btn-gray:hover,
					.btn-mod.btn-gray:focus,
					.accordion > dt > a:hover,
					pre
				',
				'background-color' => '
					/* Overriding: rgba(34,34,34, .9) */
					.wpcf7-form-control.wpcf7-submit,
					.wysija-submit,
					.comment-form input[type=submit],
					.btn-mod,
					a.btn-mod,
					.comment-form input[type=submit]
				',
				'border-color' => '
					/* Overriding: #333 */
					.widget.widget_tag_cloud .tagcloud a:hover
				'
			),
		),
		
		array(
			'id'        => 'customizer-content-light-color',
			'type'      => 'color',
			'title'     => __('Color (4)', 'rhythm'),
			'subtitle'     => __('Light elements, links, text.', 'rhythm'),
			'default'   => '',
			'output'    => array('color' => '
				/* Overriding: #999, #AAA */
				.mobile-on .desktop-nav ul li a,
				.section-more,
				.alt-service-item,
				.count-descr,
				.works-filter a,
				.work-item:hover .work-descr,
				.footer-made,
				.blog-item-date,
				.pagination a,
				.pagination .page-numbers,
				.comment-author a,
				.widget ul li a:hover,
				.widget ul li a.active,
				.widget.widget_search .search-form:after,
				.widget-comments li a:hover,
				.widget .widget-posts li a:hover,
				.pr-per,
				.accordion > dt > a:after,
				.toggle > dt > a:after,
				.fa-examples > div > .muted,
				.form-tip,
				.hs-line-10.transparent,
				.team-item-role,
				.post-prev-info,
				.post-prev-info a,
				.blog-item-data,
				.blog-item-data a,
				.blog-post-data,
				.widget ul li,
				.widget.widget_recent_comments ul li .comment-author-link a,
				.widget-comments,
				.widget .widget-posts,
				.main .pricing-item-inner
			',
			'border-color' => '
				/* Overriding: #AAA */
				.pricing-item-inner:hover
			',
			'background-color' => '
				.btn-mod.btn-gray:hover
			'
			),
		),
		
		array(
			'id'        => 'customizer-content-light-gray-color',
			'type'      => 'color',
			'title'     => __('Color (5)', 'rhythm'),
			'subtitle'     => __('Light gray text, background, borders color.', 'rhythm'),
			'default'   => '',
			'output'    => array(
				'color' => '
					/* Overriding: #DDD, #CCC */
					.mobile-on .desktop-nav ul li a:hover,
					.mobile-on .desktop-nav ul li a.active,
					.work-item:hover .work-title
				',
				'background-color' => '
					/* Overriding: #f4f4f4, #f8f8f8, #f2f2f2, #f0f0f0, rgba(255,255,255, .08). #FCFCFC, #F5F5F5 */
					.bg-gray,
					.bg-gray-lighter,
					.tpl-progress-alt,
					.tpl-progress,
					.fa-examples > div:hover,
					.btn-mod.btn-w,
					hr,
					.btn-mod.btn-gray,
					.accordion > dt > a:hover,
					.widget.widget_calendar table thead
				',
				'border-color' => '
					/* Overriding: #e9e9e9, #e5e5e5, #EAEAEA, #f1f1f1, #DDD, #BBB */
					.comment-item,
					.widget.widget_tag_cloud .tagcloud a,
					.tpl-minimal-tabs > li > a:hover,
					hr,
					.widget-title,
					table,
					table thead,
					table tbody tr,
					.work-full-action,
					.blog-item-more,
					.post-navigation a,
					.pagination a,
					.pagination .page-numbers,
					.widget-comments li,
					.widget .widget-posts li,
					.pricing-item-inner,
					.highlight pre,
					.tpl-tabs,
					.accordion > dt > a,
					.toggle > dt > a,
					.fa-examples > div,
					.et-examples .box1,
					.pr-list li:first-child,
					.pr-list li,
					.fa-examples > div > i,
					.pr-button,
					.et-examples .box1 > span,
					.alert,
					pre,
					.accordion > dt > a:hover,
					.pagination .page-numbers.current,
					.widget.widget_calendar table caption,
					.widget.widget_calendar table thead,
					.widget.widget_calendar table thead th,
					.widget.widget_calendar table tbody,
					.widget.widget_calendar table tbody #today, 
					.widget.widget_calendar table tfoot,
					.wpcf7-form-control,
					.widget-title,
					.widget.widget_search .search-form .search-submit:hover + .search-field
				'
			),
		),
		
		array(
			'id'        => 'customizer-content-white-color',
			'type'      => 'color',
			'title'     => __('Color (6)', 'rhythm'),
			'subtitle'     => __('White elements by default.', 'rhythm'),
			'default'   => '',
			'output'    => array(
				'color' => '
					/* Overriding: rgba(255,255,255, .85), #FFF  */
					.wysija-submit:hover,
					.wysija-submit:focus,
					.wpcf7-form-control.wpcf7-submit:hover,
					.wpcf7-form-control.wpcf7-submit:focus,
					.comment-form input[type=submit],
					.btn-mod:hover,
					.btn-mod:focus,
					a.btn-mod:hover,
					a.btn-mod:focus,
					.hs-line-2,
					.hs-line-4,
					.hs-line-10,
					.woocommerce #respond input#submit, 
					.woocommerce a.button, 
					.woocommerce button.button, 
					.woocommerce input.button,
					.woocommerce input.button.alt,
					.tpl-progress-alt .progress-bar,
					.big-icon-link:hover .big-icon,
					.big-icon-link:hover,
					.big-icon-link:hover .wide-heading,
					.wpcf7-form-control.wpcf7-submit,
					.wysija-submit,
					.comment-form input[type=submit],
					.btn-mod,
					a.btn-mod,
					.btn-mod.btn-border:hover,
					.btn-mod.btn-border:focus,
					.btn-mod.btn-border-c:hover,
					.btn-mod.btn-border-c:focus,
					.btn-mod.btn-border-w,
					.btn-mod.btn-color,
					.btn-mod.btn-color:hover,
					.btn-mod.btn-color:focus,
					.btn-icon > span.white,
					.hs-line-1,
					.small-title.white,
					.bg-dark,
					.bg-dark-lighter,
					.bg-dark-alfa-30,
					.bg-dark-alfa-50,
					.bg-dark-alfa-70,
					.bg-dark-alfa-90,
					.bg-dark-alfa,
					.bg-color,
					.bg-color-lighter,
					.bg-color-alfa-30,
					.bg-color-alfa-50,
					.bg-color-alfa-70,
					.bg-color-alfa-90,
					.bg-color-alfa,
					.bg-color .white,
					.bg-color-lighter .whitet,
					.bg-color-alfa-30 .white,
					.bg-color-alfa-50 .white,
					.bg-color-alfa-70 .white,
					.bg-color-alfa-90 .white,
					.bg-color-alfa .white,
					.work-item:hover .work-intro,
					.works-grid.hover-color .work-item:hover .work-intro,
					.works-grid.hover-color .work-item:hover .work-title,
					.works-grid.hover-color .work-item:hover .work-descr,
					.ci-icon,
					.contact-form .error,
					.contact-form .success,
					.map-toggle,
					.footer-social-links a:hover,
					.progress-color .progress-bar > span,
					.tpl-progress-alt .progress-bar,
					.mt-text,
					.sub-heading,
					.btn-mod.btn-glass,
					.bg-color .text,
					.bg-color-lighter .text,
					.bg-color-alfa-30 .text,
					.bg-color-alfa-50 .text,
					.bg-color-alfa-70 .text,
					.bg-color-alfa-90 .text,
					.bg-color-alfa .text,
					.bg-color .section-text,
					.bg-color-lighter .section-text,
					.bg-color-alfa-30 .section-text,
					.bg-color-alfa-50 .section-text,
					.bg-color-alfa-70 .section-text,
					.bg-color-alfa-90 .section-text,
					.bg-color-alfa .section-text,
					.features-descr
				',
				'border' => '
					/* Overriding: #FFF  */
					.big-icon,
					.big-icon-link:hover .big-icon,
					.btn-mod.btn-border-w
				',
				'background-color' => '
					.btn-mod.btn-border-w:hover,
					.btn-mod.btn-border-w:focus,
					.btn-mod.btn-w:hover,
					.btn-mod.btn-w:focus,
					.btn-mod.btn-w-color,
					.btn-mod.btn-w-color:hover,
					.btn-mod.btn-w-color:focus,
					.scroll-down:before,
					.mobile-nav:hover,
					.mobile-nav.active,
					.work-full,
					.work-loader,
					.work-navigation,
					.work-navigation a span,
					.work-back-link,
					.wpcf7-form-control,
					.mt-icon:before,
					.owl-prev:before,
					.owl-next:before
				'
			),
		),
	),
);

/**
 * Footer Section
 */
$this->sections[] = array(
	'title' => __('Footer', 'rhythm'),
	'desc' => __('Configure footer sidebar styles.', 'rhythm'),
	'subsection' => true,
	'fields' => array(
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Footer Sidebar Configuration', 'rhythm')
		),
		
		array(
			'id' => 'customizer-footer-sidebar-background',
			'type' => 'background',
			'output' => array('.footer-sidebar'),
			'title' => __('Background', 'rhythm'),
			'subtitle' => __('Footer sidebar background, color and other options.', 'rhythm'),
		),
		
		array(
			'id' => 'customizer-footer-sidebar-typography',
			'type' => 'typography',
			'title' => __('Typography', 'rhythm'),
			'subtitle' => __('Widgets font and color.', 'rhythm'),
			'font-size'=> false,
			'line-height'=> false,
			'text-align' => false,
			'color' => false,
			'output' => array('.footer-sidebar'),
		),
		
		array(
			'id'        => 'customizer-footer-sidebar-text-color',
			'type'      => 'color',
			'title'     => __('Text Color', 'rhythm'),
			'default'   => '',
			'output'    => array('color' => '
				.footer-sidebar .widget-title, 
				.footer-sidebar .widget, 
				.footer-sidebar .widget ul li a, 
				.footer-sidebar caption,
				.footer-sidebar .widget.widget_recent_comments ul li .comment-author-link a,
				.footer-sidebar .widget ul li,
				.footer-sidebar .widget-title a,
				.footer-sidebar .widget strong,
				.footer-sidebar .widget.widget_tag_cloud .tagcloud a
			',
			'border-color' => '
				.footer-sidebar .widget.widget_tag_cloud .tagcloud a'
			)
		),
		
		array(
			'id'        => 'customizer-footer-sidebar-text-hover-color',
			'type'      => 'color',
			'title'     => __('Text Hover Color', 'rhythm'),
			'default'   => '',
			'output'    => array('color' => '
				.footer-sidebar .widget ul li a:hover,
				.footer-sidebar .widget.widget_recent_comments ul li .comment-author-link a:hover,
				.footer-sidebar .widget-title a:hover,
				.footer-sidebar .widget.widget_tag_cloud .tagcloud a:hover
			')
		),
		
		array(
			'id'        => 'customizer-footer-sidebar-border-color',
			'type'      => 'color',
			'title'     => __('Items Border Color', 'rhythm'),
			'default'   => '',
			'output'    => array('border-bottom-color' => '
				.footer-sidebar .widget-title,
				.footer-sidebar .widget .widget-posts li
			')
		),
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Footer Bar Configuration', 'rhythm')
		),
		
		array(
			'id' => 'customizer-footer-background',
			'type' => 'background',
			'output' => array('.footer'),
			'title' => __('Background', 'rhythm'),
			'subtitle' => __('Footer background, color and other options.', 'rhythm'),
		),
		
		array(
			'id' => 'customizer-footer-typography',
			'type' => 'typography',
			'title' => __('Typography', 'rhythm'),
			'subtitle' => __('Footer font.', 'rhythm'),
			'font-size'=> false,
			'line-height'=> false,
			'text-align' => false,
			'color' => true,
			'output' => array('.footer-copy, .footer-copy a, .footer-copy a:hover, .footer-made, .footer-made a, .footer-made a:hover'),
		),
		
		array(
			'id'        => 'customizer-footer-social-links-color',
			'type'      => 'color',
			'title'     => __('Icons Color', 'rhythm'),
			'default'   => '',
			'output'    => array(
				'color' => '.footer-social-links a',
				'border-color' => '.footer-social-links a:before',
				'background-color' => '.footer-social-links a:hover:before'
			)
		),
		
		array(
			'id'        => 'customizer-footer-social-links-hover-color',
			'type'      => 'color',
			'title'     => __('Icons Hover Color', 'rhythm'),
			'default'   => '',
			'output'    => array(
				'color' => '.footer-social-links a:hover',
				
			)
		),
		
		array(
			'id'        => 'customizer-footer-to-top-color',
			'type'      => 'color',
			'title'     => __('Back To Top Icon Color', 'rhythm'),
			'default'   => '',
			'output'    => array(
				'color' => 'a.link-to-top',
			)
		),
		
		array(
			'id'        => 'customizer-footer-to-top-hover-color',
			'type'      => 'color',
			'title'     => __('Back To Top Hover Icon Color', 'rhythm'),
			'default'   => '',
			'output'    => array(
				'color' => 'a.link-to-top:hover',
				
			)
		),
	),
);


