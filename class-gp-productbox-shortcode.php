<?php
/**
 * Gameprices Product Compare Box Shortcode Feature
 *
 * This Shortcode calls Gameprices Api to recover the Product box HTML in an iframe.
 * Usage: 
 *		[gp_product_box ean="0711719827757" width="100%" height="200" scrolling="auto"]
 * 		. ean       : Mandatory attribute. The product ean code
 * 		. width     : Optional attribute. The iframe width attribute. Default value '100%'
 *      . height    : Optional attribute. The iframe height attribute. Default value '200'
 *      . scrolling  : Optional attribute. The iframe scrolling attribute. Default value 'auto'
 *
 * @package    Gameprices
 * @since      1.0
 */

class GP_Product_Box_Shortcode {
    private static $initiated = false;

     /** 
     * Class init
     * @since 1.0
    */
    public static function init() {
		if (! self::$initiated) {
			self::init_hooks ();
		}
	}
    /** 
     *Register the class with the Wordpress Api
     * @since 1.0
    */
	public static function init_hooks() {
        self::$initiated = true;
        
        add_shortcode('gp_product_box', array (
            'GP_Product_Box_Shortcode',
            'display_shortcode' 
        ));
    }
    /**
     * Display Product box
     * @since 1.0
     */
    public static function display_shortcode($atts) {
        // Merge the given attributes with the default values
        $a = shortcode_atts( array(
            'ean' => '',
            'width' => '100%',
            'height' => '300',
            'scrolling' => 'auto'
        ), $atts );
        // Set variables with the merge attributes
        $ean = $a['ean'];
        $width = $a['width'];
        $height = $a['height'];
        $scrolling = $a['scrolling'];
        $id = 'gp_product_box_'.$a['ean'];

        // Compute API URL
        $url = 'https://prod.api.gamerprices.com/compare/product/xboxygen?ean='.$ean;

        // Insert the iframe only if eam code is correct
        ob_start(); 
        if (!empty($ean)) {
        ?>
            <iframe id="<?php echo $id ?>"
            width="<?php echo $width ?>"
            height="<?php echo $height ?>"
            scrolling="<?php echo $scrolling ?>"
            src="<?php echo $url ?>">
            </iframe>
        <?php
        }
        return ob_get_clean();
    }
}
?>