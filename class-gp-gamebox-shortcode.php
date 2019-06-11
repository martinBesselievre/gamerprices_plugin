<?php

class GP_Game_Box_Shortcode {
    private static $initiated = false;
    /**
     * @since 1.0
     */

     public static function init(){
         if(!self::$initiated){
             self::init_hooks();
         }
     }

     /**
      * @since 1.0
      */

      public static function init_hooks(){
          self::$initiated = true;
          add_shortcode('gp_game_box', array('GP_Game_Box_Shortcode', 'display_game_box'));
      }

      /**
       * @param
       * @return
       * @since 1.0
       */
        private static function check_cover_attribute($att){
            $allowed_values = array('true', 'false');
            if (in_array($att, $allowed_values)){
                return $att;
            }
                return true;
        }

        private static function check_platform_attribute($att){
          $allowed_values = GamerPrices::$platforms_available;
          if (in_array($att, $allowed_values)){
              return $att;
          }
          return 'pc';
      }
      /**
       * @since 1.0
       */

        public static function display_game_box($atts){
           $a = shortcode_atts(array(
               'gameid' => '',
               'editionid' => '',
               'platform' => 'pc',
               'cover' => 'true',
               'width' => '100%',
               'height' => '200',
               'scrolling' => 'no'
           ), $atts);

           $gameId = $a['gameid'];
           $editionId = $a['editionid'];
           $platform = GP_Game_Box_Shortcode::check_platform_attribute($a['platform']);
           $cover = GP_Game_Box_Shortcode::check_cover_attribute($a['cover']);
           $scrolling = $a['scrolling'];
           $width = $a['width'];
           $height = $a['height'];

           $id = 'gp_game_box_'.$gameId.'_'.$platform;
           if(!empty($editionId)){
               $id = $id.'_'.$editionId;
           }

           $locale="fr_fr";
           $url = "https://api.gamerprices.com/compare/xboxygen?";
           $url = $url."locale=".$locale;
           $url = $url."&platform=".$platform;
           $url = $url."&gameId=".$gameId;
           $url = $url."&cover=".$cover;
           if(!empty($editionId)){
               $url = $url."&editionId=".$editionId;
           }
          
           ob_start();
           if (!empty($gameId)){
               ?>
                <iframe id="<?php echo $id ?>"
	    		width="<?php echo $width ?>"
	    		height="<?php echo $height ?>"
	    		scrolling="<?php echo $scrolling ?>" 
	    		src="<?php echo $url ?>"
	    	>
			</iframe>
                <?php
           }
           return ob_get_clean();
       }
}

?>

