<?php
/**
 * Theme-agnostic stubs for blog templates that originally called Evolta helpers.
 *
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'evolta_get_isotope_holder_ID' ) ) {
	function evolta_get_isotope_holder_ID( $id_prefix = 'id' ) {
		return elemental_addons_get_isotope_holder_ID( $id_prefix );
	}
}

if ( ! function_exists( 'evolta_get_rwmb_group' ) ) {
	function evolta_get_rwmb_group( $group = '', $key = '' ) {
		return '';
	}
}

if ( ! function_exists( 'evolta_get_post_thumbnail_img' ) ) {
	/**
	 * Echo only the <img> for the featured image.
	 *
	 * @param string $post_format_or_size Post format or image size (Evolta used format first).
	 * @param string $img_size            Image size when first arg is post format.
	 */
	function evolta_get_post_thumbnail_img( $post_format_or_size = '', $img_size = '' ) {
		if ( ! has_post_thumbnail() ) {
			return;
		}
		// Compatible with both evolta_get_post_thumbnail_img( $size ) and ( $format, $size ).
		$size = $img_size ? $img_size : ( $post_format_or_size ? $post_format_or_size : 'large' );
		// If first arg looks like a post format, prefer second arg / large.
		$formats = array( 'standard', 'video', 'gallery', 'audio', 'quote', 'link', 'image', 'status', 'aside', 'chat' );
		if ( in_array( $post_format_or_size, $formats, true ) ) {
			$size = $img_size ? $img_size : 'large';
		}
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), $size );
		if ( empty( $image[0] ) ) {
			return;
		}
		echo '<img src="' . esc_url( $image[0] ) . '" width="' . esc_attr( $image[1] ) . '" height="' . esc_attr( $image[2] ) . '" alt="' . esc_attr( the_title_attribute( array( 'echo' => false ) ) ) . '"/>';
	}
}

if ( ! function_exists( 'evolta_get_post_thumbnail' ) ) {
	/**
	 * Output featured image markup (templates call this without capturing return).
	 *
	 * @param string $post_format Unused; kept for Evolta signature compatibility.
	 * @param string $img_size    Image size slug.
	 */
	function evolta_get_post_thumbnail( $post_format = '', $img_size = '' ) {
		if ( ! has_post_thumbnail() ) {
			return;
		}
		$size = $img_size ? $img_size : 'large';
		?>
		<div class="post-thumb">
			<figure class="post-thumb-inner">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( $size ); ?>
				</a>
			</figure>
		</div>
		<?php
	}
}

if ( ! function_exists( 'evolta_post_category' ) ) {
	function evolta_post_category() {
		$categories_list = get_the_category_list( esc_html__( ', ', 'elemental-addons' ) );
		if ( ! $categories_list ) {
			return;
		}
		echo '<span class="categories-links">' . wp_kses(
			$categories_list,
			array(
				'a' => array(
					'href' => array(),
					'rel'  => array(),
				),
			)
		) . '</span>';
	}
}

if ( ! function_exists( 'evolta_post_tag' ) ) {
	function evolta_post_tag() {
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'elemental-addons' ) );
		if ( $tags_list ) {
			echo wp_kses_post( $tags_list );
		}
	}
}

if ( ! function_exists( 'evolta_posted_on' ) ) {
	function evolta_posted_on() {
		echo '<a href="' . esc_url( get_permalink() ) . '"><time datetime="' . esc_attr( get_the_date( DATE_W3C ) ) . '">' . esc_html( get_the_date() ) . '</time></a>';
	}
}

if ( ! function_exists( 'evolta_posted_on_date' ) ) {
	function evolta_posted_on_date() {
		evolta_posted_on();
	}
}

if ( ! function_exists( 'evolta_posted_on_split_date' ) ) {
	function evolta_posted_on_split_date() {
		echo '<span class="day">' . esc_html( get_the_date( 'd' ) ) . '</span><span class="month">' . esc_html( get_the_date( 'M' ) ) . '</span>';
	}
}

if ( ! function_exists( 'evolta_posted_by' ) ) {
	function evolta_posted_by() {
		printf(
			'<a href="%1$s">%2$s</a>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
}

if ( ! function_exists( 'evolta_get_comments_number' ) ) {
	function evolta_get_comments_number() {
		comments_number(
			esc_html__( '0 Comments', 'elemental-addons' ),
			esc_html__( '1 Comment', 'elemental-addons' ),
			esc_html__( '% Comments', 'elemental-addons' )
		);
	}
}

if ( ! function_exists( 'evolta_get_excerpt' ) ) {
	function evolta_get_excerpt( $excerpt_length = '' ) {
		if ( post_password_required() ) {
			echo wp_kses_post( get_the_password_form() );
			return;
		}
		$word_count = 20;
		if ( is_numeric( $excerpt_length ) && (int) $excerpt_length > 0 ) {
			$word_count = (int) $excerpt_length;
		}
		$excerpt = get_the_excerpt();
		$words   = preg_split( '/\s+/', wp_strip_all_tags( $excerpt ), $word_count + 1 );
		if ( count( $words ) > $word_count ) {
			array_pop( $words );
			$excerpt = implode( ' ', $words ) . '&hellip;';
		} else {
			$excerpt = implode( ' ', $words );
		}
		echo '<p>' . esc_html( $excerpt ) . '</p>';
	}
}

if ( ! function_exists( 'evolta_post_shortcode_meta' ) ) {
	function evolta_post_shortcode_meta( $post_meta_options = array(), $exclude = array() ) {
		if ( empty( $post_meta_options ) ) {
			return;
		}
		if ( is_string( $post_meta_options ) ) {
			$post_meta_options = explode( ',', $post_meta_options );
		}
		if ( ! empty( $exclude ) ) {
			$post_meta_options = array_diff( $post_meta_options, $exclude );
		}
		echo '<ul class="entry-meta list-inline">';
		if ( in_array( 'show-post-date', $post_meta_options, true ) ) {
			echo '<li class="list-inline-item posted-date">';
			evolta_posted_on();
			echo '</li>';
		}
		if ( in_array( 'show-post-by-author', $post_meta_options, true ) ) {
			echo '<li class="list-inline-item author">';
			evolta_posted_by();
			echo '</li>';
		}
		if ( in_array( 'show-post-category', $post_meta_options, true ) ) {
			echo '<li class="list-inline-item categories">';
			evolta_post_category();
			echo '</li>';
		}
		if ( in_array( 'show-post-comments-count', $post_meta_options, true ) ) {
			echo '<li class="list-inline-item comments">';
			evolta_get_comments_number();
			echo '</li>';
		}
		if ( in_array( 'show-post-tag', $post_meta_options, true ) ) {
			echo '<li class="list-inline-item tags">';
			evolta_post_tag();
			echo '</li>';
		}
		echo '</ul>';
	}
}

if ( ! function_exists( 'evolta_post_shortcode_single_meta' ) ) {
	function evolta_post_shortcode_single_meta( $post_meta = '' ) {
		if ( 'show-post-by-author' === $post_meta ) {
			evolta_posted_by();
		} elseif ( 'show-post-date' === $post_meta || 'show-post-date-split' === $post_meta ) {
			if ( 'show-post-date-split' === $post_meta ) {
				evolta_posted_on_split_date();
			} else {
				evolta_posted_on_date();
			}
		} elseif ( 'show-post-category' === $post_meta ) {
			evolta_post_category();
		} elseif ( 'show-post-comments-count' === $post_meta ) {
			evolta_get_comments_number();
		} elseif ( 'show-post-tag' === $post_meta ) {
			evolta_post_tag();
		}
	}
}

if ( ! function_exists( 'evolta_sl_get_simple_likes_button' ) ) {
	function evolta_sl_get_simple_likes_button( $post_id = 0 ) {
		return '';
	}
}
