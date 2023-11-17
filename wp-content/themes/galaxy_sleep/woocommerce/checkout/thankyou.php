<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">
	<div class="row no-gutters">
		<div class="col-12 col-md-6 blocky-group d-flex">
			<div class="p-4 p-md-5 w-100 title-section">
				<?php
				if ( $order ) :

					do_action( 'woocommerce_before_thankyou', $order->get_id() );
					?>
					<?php if ( $order->has_status( 'failed' ) ) : ?>

						<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

						<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
							<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
							<?php if ( is_user_logged_in() ) : ?>
								<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
							<?php endif; ?>
						</p>

					<?php else : ?>

						<?php wc_get_template( 'checkout/order-received.php', array( 'order' => $order ) ); ?>
						<div class="row no-gutters">
							<div class="col-12 col-md-8">
								<table>
									<tbody>
										<tr>
											<td><?php esc_html_e( 'Order number:', 'woocommerce' ); ?></td>
											<td><strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong></td>
										</tr>
										<tr>
											<td><?php esc_html_e( 'Date:', 'woocommerce' ); ?></td>
											<td><strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong></td>
										</tr>
										<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
										<tr>
											<td><?php esc_html_e( 'Email:', 'woocommerce' ); ?></td>
											<td><strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong></td>
										</tr>
										<?php endif; ?>
										<tr>
											<td><?php esc_html_e( 'Total:', 'woocommerce' ); ?></td>
											<td><strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong></td>
										</tr>
										<?php if ( $order->get_payment_method_title() ) : ?>
										<tr>
											<td><?php esc_html_e( 'Payment method:', 'woocommerce' ); ?></td>
											<td><strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong></td>
										</tr>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
						</div>

					<?php endif; ?>

				<?php else: ?>
				<?php wc_get_template( 'checkout/order-received.php', array( 'order' => false ) ); ?>
				<?php endif; ?>
				<iframe width="100%" height="750px" src="https://booking.galaxy-sleep.ch/portal-embed#/customer/termin-buchen" frameborder="0" allowfullscreen=""> </iframe>
			</div>
		</div>
		<div class="col-12 col-md-6 blocky-group d-flex bg-stone">
			<div class="p-4 p-md-5 w-100">
				<?php if( $order ): ?>
					<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
					<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
