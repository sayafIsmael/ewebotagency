<?php
/**
 * Widgets
 * @package Leverage Extra
 */

class Author_Widget extends WP_Widget {
 
    function __construct() {
 
        parent::__construct(
            'author-widget',
            'Author Widget'
        );
 
        add_action( 'widgets_init', function() {
            register_widget( 'Author_Widget' );
        } );
 
    }
 
    public $args = array(
		'before_widget' => '<div id="%1$s" class="row item"><div class="col-12 align-self-center">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
    );
 
    public function widget( $args, $instance ) {
 
        echo $args['before_widget'];
 
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'].apply_filters( 'widget_title', $instance['title'] ).$args['after_title'];
        } else {
			echo $args['before_title'].apply_filters( 'widget_title', esc_html__( 'By ', 'leverage-extra' ).get_the_author_meta( 'display_name' ) ).$args['after_title'];
		}

		?>

		<ul class="list-group list-group-flush">
			<li class="list-group-item d-flex justify-content-between align-items-center">

                <?php if ( get_avatar( get_the_author_meta( 'ID' ) ) ) : ?>
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				    <?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
                </a>
                <?php endif; ?>

                <?php if ( get_the_author_meta( 'description' ) ) : ?>
				    <span class="ml-3"><?php echo get_the_author_meta( 'description' ); ?></span>
                <?php endif; ?>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center">
				<span class="d-lg-flex align-items-center">
                    <i class="icon-clock mr-2"></i>
                    <?php echo leverage_time_ago(); ?>
                </span>
			</li>
		</ul>
		
		<?php
 
        echo $args['after_widget'];
    }
 
    public function form( $instance ) {
 
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'leverage-extra' );
		
        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php echo esc_html__( 'Title:', 'leverage-extra' ); ?>
            </label>
		    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>

	<?php 
	}
 
    public function update( $new_instance, $old_instance ) {
 
        $instance = array();
 
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
 
        return $instance;
    }
}

$Author_Widget = new Author_Widget();

class Social_Widget extends WP_Widget {
 
    function __construct() {
 
        parent::__construct(
            'social-widget',
            'Social Widget'
        );
 
        add_action( 'widgets_init', function() {
            register_widget( 'Social_Widget' );
        } );
 
    }
 
    public $args = array(
		'before_widget' => '<div id="%1$s" class="row item"><div class="col-12 align-self-center">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
    );
 
    public function widget( $args, $instance) {
 
        echo $args['before_widget'];
 
        if (  ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        } else {
			echo $args['before_title'] . apply_filters( 'widget_title', esc_html( 'Follow Us' ) ) . $args['after_title'];
		}
 
        echo '<ul class="navbar-nav social share-list">';
 
        echo '<li class="nav-item"><a href="' . esc_html__( $instance['instagram'], 'leverage-extra' ) . '" class="nav-link"><i class="icon-social-instagram ml-0"></i></a>';
        echo '<li class="nav-item"><a href="' . esc_html__( $instance['facebook'], 'leverage-extra' ) . '" class="nav-link"><i class="icon-social-facebook"></i></a>';
        echo '<li class="nav-item"><a href="' . esc_html__( $instance['linkedin'], 'leverage-extra' ) . '" class="nav-link"><i class="icon-social-linkedin"></i></a>';
        echo '<li class="nav-item"><a href="' . esc_html__( $instance['twitter'], 'leverage-extra' ) . '" class="nav-link"><i class="icon-social-twitter"></i></a>';
 
        echo '</ul>';
 
        echo $args['after_widget'];
    }
 
    public function form( $instance ) {
 
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'leverage-extra' );
		
		$instagram = ! empty( $instance['instagram'] ) ? $instance['instagram'] : esc_html__( '', 'leverage-extra' );
		$facebook  = ! empty( $instance['facebook'] ) ? $instance['facebook'] : esc_html__( '', 'leverage-extra' );
		$linkedin  = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : esc_html__( '', 'leverage-extra' );
		$twitter   = ! empty( $instance['twitter'] ) ? $instance['twitter'] : esc_html__( '', 'leverage-extra' );
		
        ?>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
			<?php echo esc_html__( 'Title:', 'leverage-extra' ); ?>
		</label>

		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'Instagram' ) ); ?>">
			<?php echo esc_html__( 'Instagram:', 'leverage-extra' ); ?>
		</label>

		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>">
        </p>		

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'Facebook' ) ); ?>">
			<?php echo esc_html__( 'Facebook:', 'leverage-extra' ); ?>
		</label>

		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>">
        </p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'Linkedin' ) ); ?>">
			<?php echo esc_html__( 'Linkedin:', 'leverage-extra' ); ?>
		</label>

		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="text" value="<?php echo esc_attr( $linkedin ); ?>">
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'Twitter' ) ); ?>">
			<?php echo esc_html__( 'Twitter:', 'leverage-extra' ); ?>
		</label>

		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>">
		</p>

	<?php 
	}
 
    public function update( $new_instance, $old_instance ) {
 
        $instance = array();
 
		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		
        $instance['instagram'] = ( !empty( $new_instance['instagram'] ) ) ? $new_instance['instagram'] : '';
        $instance['facebook'] = ( !empty( $new_instance['facebook'] ) ) ? $new_instance['facebook'] : '';
        $instance['linkedin'] = ( !empty( $new_instance['linkedin'] ) ) ? $new_instance['linkedin'] : '';
        $instance['twitter'] = ( !empty( $new_instance['twitter'] ) ) ? $new_instance['twitter'] : '';
 
        return $instance;
    }
}

$Social_Widget = new Social_Widget();