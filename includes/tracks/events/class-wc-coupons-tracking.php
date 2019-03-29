<?php
/**
 * WooCommerce Coupons Tracking
 *
 * @package WooCommerce\Tracks
 */

defined( 'ABSPATH' ) || exit;

/**
 * This class adds actions to track usage of WooCommerce Orders.
 */
class WC_Coupons_Tracking {
	/**
	 * Init tracking.
	 */
	public function init() {
		add_action( 'load-edit.php', array( $this, 'paul' ), 10 );
	}

	public function paul() {
		if ( isset( $_GET['post_type'] ) && 'shop_coupon' === wp_unslash( $_GET['post_type'] ) ) {
			
			WC_Tracks::record_event( 'coupons_view', array(
				'status' => $_GET['post_status'],
			) );

			if ( isset( $_GET['filter_action'] ) && 'Filter' === wp_unslash( $_GET['filter_action'] ) && isset( $_GET['coupon_type'] ) ) {
				WC_Tracks::record_event( 'coupons_filter', array(
					'filter' => 'coupon_type',
					'value'  => wp_unslash( $_GET['coupon_type'] ),
				) );
			}

			if ( isset( $_GET['s'] ) ) {
				WC_Tracks::record_event( 'coupons_search', array(
					'filter' => 'search',
					'value'  => wp_unslash( $_GET['s'] ),
				) );
			}
		}
	}
}
