<?php
/**
 * Output_Post_Request_Queries.php
 *
 * @created     10/14/16 3:09 PM
 * @author      Alley Interactive
 * @package     query-monitor-post-request-queries
 * @description Output HTML POST request HTML
 *
 */
namespace QMPRQ;

class Output_Post_Request_Queries extends \QM_Output_Html_DB_Queries {

	public function __construct( \QM_Collector $collector ) {
		parent::__construct( $collector );
		add_filter( 'qm/output/menus', array( $this, 'admin_menu' ), 101 );
		add_filter( 'qm/output/menu_class', array( $this, 'admin_class' ) );
	}

	/**
	 * Outputs POST request queries data in the footer
	 */
	public function output() {
		$data = $this->collector->get_data();
		?>
		<div class="qm" id="<?php echo esc_attr( $this->collector->id() ) ?>">
			<table cellspacing="0">
				<thead>
				<tr>
					<th scope="col">
						<?php esc_html_e( 'Total number of POST request queries', 'query-monitor' ); ?>
					</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td class="qm-ltr">
						<?php echo absint( $data['post_request_queries_count'] ); ?>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
		<?php
	}

	/**
	 * @param array $class
	 *
	 * @return array
	 */
	public function admin_class( array $class ) {
		$class[] = 'qm-' . QMPRQ_COLLECTOR_NAME;

		return $class;
	}

	public function admin_menu( array $menu ) {

		$data = $this->collector->get_data();

		$menu[] = $this->menu( array(
			'id'    => 'qm-' . QMPRQ_COLLECTOR_NAME,
			'href'  => '#qm-' . QMPRQ_COLLECTOR_NAME,
			'title' => sprintf( __( 'POST request queries (%s)', 'query-monitor' ), $data['post_request_queries_count'] ),
		) );

		return $menu;
	}
}
