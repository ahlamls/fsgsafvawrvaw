<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Galaxy_Sleep
 */

?>
	<section class="contact-list-wrapper">
		
        <div class="row justify-content-around">
			<div class="col-12 flex-column d-flex mx-auto text-center mb-5">
				<h3><?php echo get_theme_mod("section_footer_contact_setting_title", gs_get_content('section_footer.contacts.title')) ?></h3>
			</div>
            <div class="col-12 col-md-3 contact-list">
                <div>
					<?php if(!empty(get_theme_mod("section_footer_contact_setting_logo_0", gs_get_content('section_footer.contacts.items.0.logo')))): ?>
						<img src="<?php echo get_theme_mod("section_footer_contact_setting_logo_0", gs_get_content('section_footer.contacts.items.0.logo')) ?>" alt="">
					<?php else: ?>
						<svg role="presentation" fill="none" focusable="false" stroke-width="1.6" width="40" height="40" class="hidden sm:block icon icon-picto-envelope" viewBox="0 0 24 24">
							<path d="M1.77 18.063a3.586 3.586 0 0 0 3.174 3.11c2.278.24 4.637.49 7.056.49 2.417 0 4.778-.252 7.056-.49a3.584 3.584 0 0 0 3.175-3.11c.243-1.96.483-3.987.483-6.063 0-2.074-.24-4.102-.483-6.063a3.586 3.586 0 0 0-3.175-3.112c-2.278-.236-4.639-.487-7.056-.487s-4.778.252-7.056.49a3.583 3.583 0 0 0-3.175 3.11c-.243 1.96-.483 3.988-.483 6.062 0 2.074.24 4.102.483 6.063Z" fill="currentColor" fill-opacity="0" stroke="currentColor" stroke-linejoin="round"></path>
							<path d="m1.817 5.493 8.06 6.356a3.428 3.428 0 0 0 4.245 0l8.06-6.356" stroke="currentColor" stroke-linejoin="round"></path>
						</svg>
					<?php endif; ?>
                </div>
                <div>
                    <p><b><?php echo get_theme_mod("section_footer_contact_setting_title_0", gs_get_content('section_footer.contacts.items.0.title')) ?></b></p>
					<p><?php echo get_theme_mod("section_footer_contact_setting_desc_0", gs_get_content('section_footer.contacts.items.0.desc')) ?></p>
                    <p class="mt-4">
                        <a href="<?php echo get_theme_mod("section_footer_contact_setting_cta_link_0", gs_get_content('section_footer.contacts.items.0.cta_link')) ?>" title="Email"  data-zoho-live-chat><?php echo get_theme_mod("section_footer_contact_setting_cta_label_0", gs_get_content('section_footer.contacts.items.0.cta_label')) ?></a>
                    </p>
                </div>
            </div>
			<div class="col-12 col-md-3 contact-list">
                <div>
					<?php if(!empty(get_theme_mod("section_footer_contact_setting_logo_1", gs_get_content('section_footer.contacts.items.1.logo')))): ?>
						<img src="<?php echo get_theme_mod("section_footer_contact_setting_logo_1", gs_get_content('section_footer.contacts.items.1.logo')) ?>" alt="">
					<?php else: ?>
						<svg role="presentation" fill="none" focusable="false" stroke-width="1.6" width="40" height="40" class="hidden sm:block icon icon-picto-customer-support" viewBox="0 0 24 24">
							<path d="M1.714 14.143c0-3.919 2.613-4.898 3.92-4.898 2.35 0 2.938 1.96 2.938 2.938v3.92c0 2.35-1.96 2.938-2.939 2.938-1.306 0-3.919-.98-3.919-4.898ZM22.286 14.143c0-3.919-2.613-4.898-3.92-4.898-2.35 0-2.937 1.96-2.937 2.938v3.92c0 2.35 1.96 2.938 2.938 2.938 1.306 0 3.919-.98 3.919-4.898Z" fill="currentColor" fill-opacity="0"></path>
							<path d="M1.714 14.143c0-3.919 2.613-4.898 3.92-4.898 2.35 0 2.938 1.96 2.938 2.938v3.92c0 2.35-1.96 2.938-2.939 2.938-1.306 0-3.919-.98-3.919-4.898ZM22.286 14.143c0-3.919-2.613-4.898-3.92-4.898-2.35 0-2.937 1.96-2.937 2.938v3.92c0 2.35 1.96 2.938 2.938 2.938 1.306 0 3.919-.98 3.919-4.898Z" stroke="currentColor"></path>
							<path d="M2.38 11.263C2.524 6.537 4.929 1.286 12 1.286c7.06 0 9.468 5.232 9.617 9.951m.106 5.666s.134 3.079-1.447 4.42c-1.58 1.336-5.57 1.31-5.57 1.31" stroke="currentColor" stroke-linecap="round"></path>
						</svg>
					<?php endif; ?>
                </div>
                <div>
                    <p><b><?php echo get_theme_mod("section_footer_contact_setting_title_1", gs_get_content('section_footer.contacts.items.1.title')) ?></b></p>
					<p><?php echo get_theme_mod("section_footer_contact_setting_desc_1", gs_get_content('section_footer.contacts.items.1.desc')) ?></p>
                    <p class="mt-4">
                        <a href="<?php echo get_theme_mod("section_footer_contact_setting_cta_link_1", gs_get_content('section_footer.contacts.items.1.cta_link')) ?>" title="Email"><?php echo get_theme_mod("section_footer_contact_setting_cta_label_1", gs_get_content('section_footer.contacts.items.1.cta_label')) ?></a>
                    </p>
                </div>
            </div>
			<div class="col-12 col-md-3 contact-list">
                <div>
					<?php if(!empty(get_theme_mod("section_footer_contact_setting_logo_2", gs_get_content('section_footer.contacts.items.2.logo')))): ?>
						<img src="<?php echo get_theme_mod("section_footer_contact_setting_logo_2", gs_get_content('section_footer.contacts.items.2.logo')) ?>" alt="">
					<?php else: ?>
						<svg role="presentation" fill="none" focusable="false" stroke-width="1.6" width="40" height="40" class="hidden sm:block icon icon-picto-phone" viewBox="0 0 24 24">
							<path d="M7.102 7.137a2.628 2.628 0 0 0-3.895.421c-.14.192-.312.415-.531.691a4.843 4.843 0 0 0 .007 6.028c1.039 1.287 2.127 2.586 3.343 3.804 1.217 1.217 2.516 2.305 3.805 3.342 1.742 1.406 4.276 1.406 6.026.009.31-.249.554-.432.76-.583 1.237-.903 1.448-2.599.445-3.758a44.912 44.912 0 0 0-1.42-1.542c-.657-.695-1.789-.772-2.512-.144-.125.11-.287.257-.511.464-2-1.188-3.214-2.417-4.382-4.382.213-.226.36-.39.472-.517a1.827 1.827 0 0 0-.148-2.503c-.48-.448-.963-.897-1.459-1.33Z" fill="currentColor" fill-opacity="0" stroke="currentColor" stroke-linejoin="round"></path>
							<path d="M17.297 10.644a4.354 4.354 0 0 0-1.508-2.517 4.354 4.354 0 0 0-2.875-.994M22.59 9.77a9.824 9.824 0 0 0-3.405-5.678 9.828 9.828 0 0 0-6.494-2.246" stroke="currentColor" stroke-linecap="round"></path>
						</svg>
					<?php endif; ?>
                </div>
                <div>
                    <p><b><?php echo get_theme_mod("section_footer_contact_setting_title_2", gs_get_content('section_footer.contacts.items.2.title')) ?></b></p>
					<p><?php echo get_theme_mod("section_footer_contact_setting_desc_2", gs_get_content('section_footer.contacts.items.2.desc')) ?></p>
                    <p class="mt-4">
                        <a href="<?php echo get_theme_mod("section_footer_contact_setting_cta_link_2", gs_get_content('section_footer.contacts.items.2.cta_link')) ?>" title="Email"><?php echo get_theme_mod("section_footer_contact_setting_cta_label_2", gs_get_content('section_footer.contacts.items.2.cta_label')) ?></a>
                    </p>
                </div>
            </div>
        </div>
    </section>
	<footer class="site-footer">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 d-xl-flex justify-content-center align-items-center flex-column p-0">
					<div class="row d-block d-xl-none">
						<div class="col-12 mt-xl-0 mt-2 footer-heading footer-logo">
							<img src="<?php echo get_theme_mod("section_footer_logo_setting_logo", gs_get_content('section_footer.logo')) ?>" alt="">
						</div>
						<div class="col-12">
							<div class="accordion accordion-footer" id="accordionFooter">
								<?php 
									$footer_menu = gs_get_content("section_footer.menu.items");
								?>
								<?php foreach ($footer_menu as $i => $menu): ?>
								<div class="accordion-item">
									<div class="accordion-header" id="heading-footer-<?php echo $i; ?>">
										<div role="button" class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapse-footer-<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse-footer-<?php echo $i; ?>">
											<div class="d-flex w-100 justify-content-between align-items-center flex-row">
												<div class="d-flex align-items-center">
													<p class="d-flex mb-0">
													<b><?php echo get_theme_mod("section_footer_menu_setting_title_$i", $menu['title']) ?></b>
													</p>
												</div>
												<div class="accordion-toggle d-flex ml-3">
													<span class="accordion-toggle-line1 bg-bright border-bright"></span>
													<span class="accordion-toggle-line2 bg-bright border-bright"></span>
												</div>
											</div>
										</div>
									</div>
									<div id="collapse-footer-<?php echo $i; ?>" class="collapse" aria-labelledby="heading-footer-<?php echo $i; ?>" data-parent="#accordionFooter">
										<div class="accordion-body">
										<?php wp_nav_menu(['menu' => get_theme_mod("section_footer_menu_setting_menu_$i", $menu['menu']), 'depth' => 1 ]) ?>
										</div>
									</div>
								</div>
								<?php endforeach ?>
							</div>
						</div>
					</div>
					<div class="row pt-xl-6 mt-xl-0 mb-2 mt-1 pt-4 footer-main">
						<div class="col-12 px-xl-0 mx-auto">
							<div class="row flex-column-reverse footer-inner">
								<div class="col-12 col-xl-2 col-xxl-1">
									<div class="row">
										<div class="col-12 d-none d-xl-flex pb-3 footer-logo">
											<img src="<?php echo get_theme_mod("section_footer_logo_setting_logo", gs_get_content('section_footer.logo')) ?>" alt="">
										</div>
										<div class="col-12 d-flex flex-column pt-xl-0 pb-2 pt-4">
											<ul class="footer-social-list m-0 pb-4 pt-2">
												<li>
													<a class="footer-icon" aria-label="facebook social link" rel="noopener noreferrer" href="<?php echo get_theme_mod("section_footer_social_link_setting_facebook", gs_get_content('section_footer.social_link.facebook')) ?>" target="_blank">
														<svg width="24" height="24" viewBox="0 0 26 26" fill="#ffffff"><g stroke="none" stroke-width="1" fill="#ffffff" fill-rule="evenodd"><g transform="translate(-84.000000, -2388.000000)" fill="#ffffff" fill-rule="nonzero"><g transform="translate(-8.000000, 2007.000000)"><g transform="translate(92.000000, 381.000000)"><path d="M13,0 C5.82045455,0 0,5.85037122 0,13.066819 C0,19.6180468 4.80113636,25.0271159 11.0570909,25.9720845 L11.0570909,16.5301199 L7.84077273,16.5301199 L7.84077273,13.0953284 L11.0570909,13.0953284 L11.0570909,10.809823 C11.0570909,7.02579098 12.8912727,5.36452313 16.0201364,5.36452313 C17.5186818,5.36452313 18.3110909,5.47618504 18.6863182,5.52726442 L18.6863182,8.52550543 L16.5519545,8.52550543 C15.2235909,8.52550543 14.7597273,9.79120503 14.7597273,11.2178641 L14.7597273,13.0953284 L18.6526364,13.0953284 L18.1243636,16.5301199 L14.7597273,16.5301199 L14.7597273,26 C21.1049091,25.1346202 26,19.6815991 26,13.066819 C26,5.85037122 20.1795455,0 13,0 Z"></path></g></g></g></g></svg>
													</a>
												</li>
												<li>
													<a class="footer-icon" rel="noopener noreferrer" href="<?php echo get_theme_mod("section_footer_social_link_setting_linkedin", gs_get_content('section_footer.social_link.linkedin')) ?>" aria-label="linkedin social link" target="_blank">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="#ffffff"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g fill="#ffffff" fill-rule="nonzero"><path d="M20.447,20.452 L16.893,20.452 L16.893,14.883 C16.893,13.555 16.866,11.846 15.041,11.846 C13.188,11.846 12.905,13.291 12.905,14.785 L12.905,20.452 L9.351,20.452 L9.351,9 L12.765,9 L12.765,10.561 L12.811,10.561 C13.288,9.661 14.448,8.711 16.181,8.711 C19.782,8.711 20.448,11.081 20.448,14.166 L20.448,20.452 L20.447,20.452 Z M5.337,7.433 C4.193,7.433 3.274,6.507 3.274,5.368 C3.274,4.23 4.194,3.305 5.337,3.305 C6.477,3.305 7.401,4.23 7.401,5.368 C7.401,6.507 6.476,7.433 5.337,7.433 Z M7.119,20.452 L3.555,20.452 L3.555,9 L7.119,9 L7.119,20.452 Z M22.225,0 L1.771,0 C0.792,0 0,0.774 0,1.729 L0,22.271 C0,23.227 0.792,24 1.771,24 L22.222,24 C23.2,24 24,23.227 24,22.271 L24,1.729 C24,0.774 23.2,0 22.222,0 L22.225,0 Z"></path></g></g></svg>
													</a>
												</li>
												<li>
													<a class="footer-icon" rel="noopener noreferrer" href="<?php echo get_theme_mod("section_footer_social_link_setting_instagram", gs_get_content('section_footer.social_link.instagram')) ?>" aria-label="instagram social link" target="_blank">
														<svg width="24" height="24" viewBox="0 0 26 26" fill="#ffffff"><g stroke="none" stroke-width="1" fill="#ffffff" fill-rule="evenodd"><g transform="translate(-86.000000, -2336.000000)" fill="#ffffff" fill-rule="nonzero"><g transform="translate(-8.000000, 2007.000000)"><g><g><path d="M107.000026,329 C110.530588,329 110.973295,329.014965 112.359883,329.078231 C113.743582,329.141342 114.688598,329.361122 115.515494,329.682509 C116.370359,330.014681 117.095338,330.459194 117.818097,331.181903 C118.540806,331.904662 118.985319,332.629641 119.317543,333.484506 C119.638878,334.311402 119.858658,335.256418 119.921769,336.640117 C119.985035,338.026705 120,338.469412 120,342.000026 C120,345.530588 119.985035,345.973295 119.921769,347.359883 C119.858658,348.743582 119.638878,349.688598 119.317543,350.515494 C118.985319,351.370359 118.540806,352.095338 117.818097,352.818097 C117.095338,353.540806 116.370359,353.985319 115.515494,354.317543 C114.688598,354.638878 113.743582,354.858658 112.359883,354.921769 C110.973295,354.985035 110.530588,355 107.000026,355 C103.469412,355 103.026705,354.985035 101.640117,354.921769 C100.256418,354.858658 99.3114018,354.638878 98.484506,354.317543 C97.6296411,353.985319 96.9046624,353.540806 96.1819026,352.818097 C95.4591945,352.095338 95.0146812,351.370359 94.682509,350.515494 C94.3611219,349.688598 94.1413422,348.743582 94.078231,347.359883 C94.014965,345.973295 94,345.530588 94,342.000026 C94,338.469412 94.014965,338.026705 94.078231,336.640117 C94.1413422,335.256418 94.3611219,334.311402 94.682509,333.484506 C95.0146812,332.629641 95.4591945,331.904662 96.1819026,331.181903 C96.9046624,330.459194 97.6296411,330.014681 98.484506,329.682509 C99.3114018,329.361122 100.256418,329.141342 101.640117,329.078231 C103.026705,329.014965 103.469412,329 107.000026,329 Z M112.675405,332.074684 C111.324886,332.013066 110.919791,332 107.500025,332 C104.080209,332 103.675114,332.013066 102.324595,332.074684 C101.075858,332.131625 100.397701,332.340273 99.9463926,332.515672 C99.3485628,332.748012 98.9219119,333.025548 98.4737556,333.473756 C98.0255484,333.921912 97.7480118,334.348563 97.5156721,334.946393 C97.3402734,335.397701 97.1316253,336.075858 97.0746842,337.324595 C97.0130659,338.675114 97,339.080209 97,342.500025 C97,345.919791 97.0130659,346.324886 97.0746842,347.675405 C97.1316253,348.924142 97.3402734,349.602299 97.5156721,350.053607 C97.7480118,350.651437 98.0255992,351.078088 98.4737556,351.526244 C98.9219119,351.974452 99.3485628,352.251988 99.9463926,352.484328 C100.397701,352.659727 101.075858,352.868375 102.324595,352.925316 C103.674962,352.986934 104.079955,353 107.500025,353 C110.920045,353 111.325089,352.986934 112.675405,352.925316 C113.924142,352.868375 114.602299,352.659727 115.053607,352.484328 C115.651437,352.251988 116.078088,351.974452 116.526244,351.526244 C116.974452,351.078088 117.251988,350.651437 117.484328,350.053607 C117.659727,349.602299 117.868375,348.924142 117.925316,347.675405 C117.986934,346.324886 118,345.919791 118,342.500025 C118,339.080209 117.986934,338.675114 117.925316,337.324595 C117.868375,336.075858 117.659727,335.397701 117.484328,334.946393 C117.251988,334.348563 116.974452,333.921912 116.526244,333.473756 C116.078088,333.025548 115.651437,332.748012 115.053607,332.515672 C114.602299,332.340273 113.924142,332.131625 112.675405,332.074684 Z M107.500025,336 C111.089874,336 114,338.910126 114,342.500025 C114,346.089874 111.089874,349 107.500025,349 C103.910126,349 101,346.089874 101,342.500025 C101,338.910126 103.910126,336 107.500025,336 Z M107.500027,347 C105.014707,347 103,344.985293 103,342.500027 C103,340.014707 105.014707,338 107.500027,338 C109.985293,338 112,340.014707 112,342.500027 C112,344.985293 109.985293,347 107.500027,347 Z M115,335.500025 C115,336.32846 114.32841,337 113.499975,337 C112.67159,337 112,336.32846 112,335.500025 C112,334.67159 112.67159,334 113.499975,334 C114.32841,334 115,334.67159 115,335.500025 Z"></path></g></g></g></g></g></svg>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-12 d-flex flex-column pb-xl-8 pt-xl-4 pb-2 pt-4">
											<div>
												<h4><b><?php echo get_theme_mod("section_footer_newsletter_setting_title", gs_get_content('section_footer.newsletter_title')) ?></b></h4>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 col-xl-7 d-none d-xl-flex pr-0 footer-link-block">
									<?php 
										$footer_menu = gs_get_content("section_footer.menu.items");
									?>
									<?php foreach ($footer_menu as $i => $menu): ?>
									<div class="d-flex flex-column mr-8 pb-3 footer-links-column">
										<span class="footer-nav-title">
											<b><?php echo get_theme_mod("section_footer_menu_setting_title_$i", $menu['title']) ?></b>
										</span>
										<?php wp_nav_menu(['menu' => get_theme_mod("section_footer_menu_setting_menu_$i", $menu['menu']), 'depth' => 1 ]) ?>
									</div>
									<?php endforeach ?>
								</div>
							</div>
						</div>
					</div>
					<div class="d-flex w-100 mb-1 pb-3 pt-4 justify-content-between flex-column flex-md-row">
						<div class="footer-copyright">
							<div class="richtext"><p>© <?php echo date('Y') ?> Yakin Group AG</p></div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</footer>
</div><!-- #page -->
<!-- Modal -->
<div class="modal fade modal-search" id="modalSearch" tabindex="-1" role="dialog" aria-labelledby="modalSearchLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="d-flex">
					<div class="flex-fill">
						<form role="search" method="get" class="search-form" action="<?php echo site_url(); ?>">
							<input id="input-search" type="text" class="search-field" placeholder="Gib etwas ein..." value="" name="s">
						</form>
					</div>
					<div>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" id="zsiqchat">var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode: "siq87ba344117e377af292f483a3af3e2a301c2e9f00be7d0db5da45effccd94fc7", values:{},ready:function(){}};var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;s.src="https://salesiq.zohopublic.eu/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);</script>
<?php wp_footer(); ?>

</body>
</html>
