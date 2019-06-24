<?php
/**
 * Theme widgets
 *
 * @package Buntu
 */

if ( ! function_exists( 'buntu_load_widgets' ) ) :

	/**
	 * Load widgets.
	 *
	 * @since 1.0.0
	 */
	function buntu_load_widgets() {
		// Social widget.
		register_widget( 'Buntu_Social_Widget' );
	}

endif;

add_action( 'widgets_init', 'buntu_load_widgets' );


if ( ! class_exists( 'Buntu_Social_Widget' ) ) :

	/**
	 * Social widget Class.
	 *
	 * @since 1.0.0
	 */
	class Buntu_Social_Widget extends WP_Widget {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'                   => 'buntu_widget_social',
				'description'                 => esc_html__( 'Social Icons Widget', 'buntu' ),
				'customize_selective_refresh' => true,
			);
			parent::__construct( 'buntu-social', esc_html__( 'Buntu: Social', 'buntu' ), $opts );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$size  = ! empty( $instance['size'] ) ? $instance['size'] : 'medium';

			echo $args['before_widget'];

			// Render title.
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
			}

			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'social',
						'container'      => false,
						'menu_class'     => 'size-' . esc_attr( $size ),
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
						'item_spacing'   => 'discard',
					)
				);
			}

			echo $args['after_widget'];
		}

		/**
		 * Update widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $new_instance New settings for this instance as input by the user via
		 *                            {@see WP_Widget::form()}.
		 * @param array $old_instance Old settings for this instance.
		 * @return array Settings to save or bool false to cancel saving.
		 */
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title'] = sanitize_text_field( $new_instance['title'] );
			$instance['size']  = sanitize_key( $new_instance['size'] );

			return $instance;
		}

		/**
		 * Output the settings update form.
		 *
		 * @since 1.0.0
		 *
		 * @param array $instance Current settings.
		 */
		function form( $instance ) {
			// Defaults.
			$instance = wp_parse_args(
				(array) $instance,
				array(
					'title' => '',
					'size'  => 'medium',
				)
			);
			$title    = $instance['title'];
			$size     = $instance['size'];
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'buntu' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e( 'Size:', 'buntu' ); ?></label>
				<?php
				$this->dropdown_size(
					array(
						'id'       => $this->get_field_id( 'size' ),
						'name'     => $this->get_field_name( 'size' ),
						'selected' => esc_attr( $size ),
					)
				);
				?>
			</p>

			<?php if ( false === has_nav_menu( 'social' ) ) : ?>
				<p><?php esc_html_e( 'Social menu is not set. Please create menu and assign it to Social menu.', 'buntu' ); ?></p>
				<?php
			endif;
		}

		/**
		 * Render image size dropdown.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args Arguments.
		 * @return string Rendered content.
		 */
		function dropdown_size( $args ) {
			$defaults = array(
				'id'       => '',
				'name'     => '',
				'selected' => 0,
				'echo'     => 1,
			);

			$r = wp_parse_args( $args, $defaults );

			$output = '';

			$choices = array(
				'small'       => esc_html__( 'Small', 'buntu' ),
				'medium'      => esc_html__( 'Medium', 'buntu' ),
				'large'       => esc_html__( 'Large', 'buntu' ),
				'extra-large' => esc_html__( 'Extra Large', 'buntu' ),
			);

			if ( ! empty( $choices ) ) {

				$output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
				foreach ( $choices as $key => $choice ) {
					$output .= '<option value="' . esc_attr( $key ) . '" ';
					$output .= selected( $r['selected'], $key, false );
					$output .= '>' . esc_html( $choice ) . '</option>\n';
				}
				$output .= "</select>\n";
			}

			if ( $r['echo'] ) {
				echo $output;
			}

			return $output;
		}
	}

endif;
