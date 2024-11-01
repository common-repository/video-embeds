<style type="text/css">
  .rbve.wrap {
  }
  .rbve.wrap .meta {
    padding: 10px;
    border-left: 4px solid lightGray;
    margin-bottom: 30px;
    background-color: #fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
  }
  .rbve.wrap .section {
    padding: 10px 10px 1px;
    border-left: 4px solid gray;
    margin-bottom: 30px;
  }
  .rbve.wrap .section h3 {
    margin-top: 5px;
  }
  .rbve.wrap .section.youtube {
    border-color: #bb0000;
  }
  .rbve.wrap .section.vimeo {
    border-color: #aad450;
  }
  .rbve.wrap .section.fitvids {
    border-color: #4584be;
  }
  .rbve.wrap pre {
    width: 50%;
    white-space: normal;
  }
  .rbve.wrap label {
    text-transform: capitalize;
  }
</style>

<?php

if ( isset($_POST['rbve_settings']) ) {
  $youtube_set = array();
  $vimeo_set = array();
  foreach ( $_POST as $item_name => $post_value ) {
    if ( strpos($item_name, 'youtube_') === 0 ) {
      $key = str_replace('youtube_', '', $item_name);
      $youtube_set[$key] = $post_value;
    }
    if ( strpos($item_name,'vimeo_') === 0 ) {
      $key = str_replace('vimeo_', '', $item_name);
      $vimeo_set[$key] = $post_value;
    }
  }
  update_option('rbve_youtube_options',$youtube_set);
  update_option('rbve_vimeo_options',$vimeo_set);
  update_option('rbve_fitvids',$_POST['rbve_fitvids']);
}

?>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post"><div class="rbve wrap">
  
  <input type="hidden" name="rbve_settings" value="1">

  <h2>Video Embeds</h2>

  <p class="meta">
    This is <a href="http://wordpress.org/plugins/video-embeds" target="_blank">Video Embeds</a> version
    <strong><?php echo get_option('rbve_version'); ?></strong> by <a href="http://ryanburnette.com" target="_blank">Ryan Burnette</a>.
    Visit the <a href="#" target="_blank">WordPress Forums</a> or <a href="https://github.com/ryanburnette/video-embeds/issues" target="_blank">Github issues</a> to report bugs or request features.
    <a href="http://bit.ly/1i7Ih4c" target="_blank">Donate via PayPal</a> if you enjoy this plugin.
  </p>

  <div class="section examples">
    <h3>Examples</h3>
    <p>Use this plugin to embed videos into your posts.</p>
    <p>These examples demonstrate all possible options for each video type. Any option you don't specify will be pulled from the defaults.</p>
    <p>You can add an ID or CLASS to any embed like so.</p>
    <pre>[ve vimeo=*video_id* id=something class="one-class two-class"]</pre>
    <h4>YouTube</h4>
    <p><a href="http://www.youtube.com/watch?v=EKyirtVHsK0" target="_blank">This video</a> explains how to figure out the ID of any YouTube video.</p>
    <pre>[ve youtube=*video_id* width=720 height=400 captions=true autoplay=true related=false]</pre>
    <h4>Vimeo</h4>
    <p>The ID of a Vimeo video is always numbers that come after vimeo.com/ in the URL.</p>
    <pre>[ve vimeo=*video_id* width=720 height=400 autopause=true autoplay=false badge=true byline=true color=00adef loop=false player_id=veplayer portrait=true title=false]</pre>
  </div>

  <div class="section youtube">
    <h3>YouTube Defaults</h3>

    <?php
    $youtube_options = rbve_defaults('youtube');
    ?>
    <table class="form-table">
      <tbody>

        <?php foreach ( $youtube_options as $name => $option ) : ?>
        
        <tr valign="middle">
          <th scope="row"><label for="youtube_<?php echo $name; ?>"><?php echo $name; ?></label></th>
          
          <?php if ( $option == 'true' || $option == 'false' ) : ?>
          
          <td>
            <fieldset>
              <p>
                <label><input name="youtube_<?php echo $name; ?>" type="radio" value="true" <?php if ( $option == 'true' ) echo "checked=\"checked\""; ?>> True</label>
                <br>
                <label><input name="youtube_<?php echo $name; ?>" type="radio" value="false" <?php if ( $option == 'false' ) echo "checked=\"checked\""; ?>> False</label>
              </p>
            </fieldset>
          </td>
          
          <?php else : ?>
          
          <td>
            <input id="youtube_<?php echo $name; ?>" maxlength="20" size="10" name="youtube_<?php echo $name; ?>" value="<?php echo $option; ?>" />

            <?php if ( $name == "style" ) : ?>
            <span style="padding-left: 10px;">Style can be "new" or "old." The new style uses HTML5 while the old uses a Flash embed.</span>
            <?php endif; ?>

          </td>
          
          <?php endif; ?>

        </tr>
      
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>

  <div class="section vimeo">
    <h3>Vimeo Defaults</h3>

<?php
    $vimeo_options = rbve_defaults('vimeo');
    ?>
    <table class="form-table">
      <tbody>

        <?php foreach ( $vimeo_options as $name => $option ) : ?>
        
        <tr valign="middle">
          <th scope="row"><label for="vimeo_<?php echo $name; ?>"><?php echo $name; ?></label></th>
          
          <?php if ( $option == 'true' || $option == 'false' ) : ?>
          
          <td>
            <fieldset>
              <p>
                <label><input name="vimeo_<?php echo $name; ?>" type="radio" value="true" <?php if ( $option == 'true' ) echo "checked=\"checked\""; ?>> True</label>
                <br>
                <label><input name="vimeo_<?php echo $name; ?>" type="radio" value="false" <?php if ( $option == 'false' ) echo "checked=\"checked\""; ?>> False</label>
              </p>
            </fieldset>
          </td>
          
          <?php else : ?>
          
          <td>
            <input id="vimeo_<?php echo $name; ?>" maxlength="20" size="10" name="vimeo_<?php echo $name; ?>" value="<?php echo $option; ?>" />

            <?php if ( $name == "style" ) : ?>
            <span style="padding-left: 10px;">Style can be "new" or "old." The new style uses HTML5 while the old uses a Flash embed.</span>
            <?php endif; ?>

          </td>
          
          <?php endif; ?>

        </tr>
      
        <?php endforeach; ?>

      </tbody>
    </table>

  </div>

  <div class="section fitvids">
    <h3>FitVids</h3>
    <p>FitVids.js is a jQuery plugin that makes your videos responsive. This plugin can load it up for you if you want.</p>
  
    <?php
    if ( !get_option('rbve_fitvids') ) {
      update_option('rbve_fitvids', 'false');
    }
    $option = get_option('rbve_fitvids');
    ?>

    <table class="form-table">
      <tbody>        
        <tr valign="middle">
          <th scope="row"><label for="fitvids">Enable FitVids.js</label></th>          
          <td>
            <fieldset>
              <p>
                <label><input name="rbve_fitvids" type="radio" value="true" <?php if ( $option == 'true' ) echo "checked=\"checked\""; ?>> True</label>
                <br>
                <label><input name="rbve_fitvids" type="radio" value="false" <?php if ( $option == 'false' ) echo "checked=\"checked\""; ?>> False</label>
              </p>
            </fieldset>
          </td>
      </tbody>
    </table>
  </div>

  <input type="submit" class="button-primary rbve-save-settings" value="<?php _e("Save Settings"); ?>"></input>
</form></div>