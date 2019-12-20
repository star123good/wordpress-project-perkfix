<?php
//Template name: Perkstore Page
if (isset($_GET['category_id'])) {
  $current_category_id = $_GET['category_id'];
} else {
  $current_category_id = 0;
}

if (isset($_GET['po'])) {
  $current_pos = $_GET['po'];
} else {
  $current_pos = 0;
}

$args = array('hide_empty' => 0);
$parent_categories = get_categories($args);
$pf_category_id = get_cat_ID('Categories');

$pf_categories = array();

foreach ($parent_categories as $i=>$category) {
  if ($category->category_parent == $pf_category_id || $category->cat_ID == $pf_category_id) {
    $icon_image_id = get_term_meta($category->term_id, 'pix_term_icon', true);
    if (!empty($icon_image_id)) {
      $category->icon_image_url = wp_get_attachment_url($icon_image_id);
    } else {
      $category->icon_image_url = '';
    }
    $pf_categories[] = $category;
  }
}
?>
  <div class="mobile perkfix-store">
    <h1 class="title">Find the perks your employees love.<br/> And the ones they are about to.</h1>
    <div class="img-content">
        <img src="<?php bloginfo('template_url'); ?>/img/img-perk-store.png">
    </div>
  </div>
  <div class="non-mobile perkfix-store">
    <h1 class="title">Find the perks your employees love. <br/>And the ones they are about to.</h1>
    <div class="img-content">
        <img src="<?php bloginfo('template_url'); ?>/img/img-perk-store.png">
    </div>
  </div>
  <div class="non-mobile-flex perkfix-container">
    <div class="perkfix-content-category">
      <div class="categories">
      <?php 
        foreach($pf_categories as $category) {
          if ($category->category_parent == 0) {
      ?>
        <div class="category-title">
          <img src="<?php echo $category->icon_image_url; ?>">
          <b><?php echo $category->name; ?></b>
        </div>
      <?php
          }
        } 
      ?>
        <div class="category-list">
          <?php 
            foreach($pf_categories as $category) { 
              if ($category->category_parent != 0 && $category->slug == "popular-perks") {
          ?>
          <div id="pfn_<?php echo $category->slug;?>" class="category-item">
            <input type="hidden" id="h_<?php echo $category->slug;?>" value="<?php echo $category->cat_ID;?>" />
            <div class="left-item">
              <img src="<?php echo $category->icon_image_url; ?>">
              <p><?php echo $category->name; ?></p>
            </div>
            <div class="right-item">
              <img src="<?php bloginfo('template_url'); ?>/img/ico/ico-arrow-right.png">
            </div>
          </div>
          <?php
              }
            }
          ?>
          <?php 
            foreach($pf_categories as $category) { 
              if ($category->category_parent != 0 && $category->slug != "popular-perks") {
          ?>
          <div id="pfn_<?php echo $category->slug;?>" class="category-item">
            <input type="hidden" id="h_<?php echo $category->slug;?>" value="<?php echo $category->cat_ID;?>" />
            <div class="left-item">
              <img src="<?php echo $category->icon_image_url; ?>">
              <p><?php echo $category->name; ?></p>
            </div>
            <div class="right-item">
              <img src="<?php bloginfo('template_url'); ?>/img/ico/ico-arrow-right.png">
            </div>
          </div>
          <?php
              }
            }
          ?>
          
        </div>
      </div>
      <?php 
      if (is_user_logged_in()) { 
        $user = wp_get_current_user();
        //print_r($user);  
      ?>
      <div class="user">
        <div class="user-ico"><p>G U</p></div>
        <p><?php echo $user->display_name;?></p>
      </div>
      <?php } ?>
    </div>
    <?php 
      if ($current_category_id == 0) {
        $current_cat = get_category_by_slug('popular-perks');

      } else {
        $current_cat = get_category($current_category_id);
        
      }
      $args = array('category' => $current_cat->term_id, 'post_type' => 'perks', 'posts_per_page' => 1000);
      $current_perkslist = get_posts($args);
      //print_r($current_perkslist);
    ?>
    <div class="perkfix-content-item">
      <div class="d-btn-back hidden">
        <a class="w-btn-back"><i class="fas fa-chevron-left"></i></a>
      </div>
      <div class="item-title-container">
        <div class="item-title-label">
          <h1><?php echo $current_cat->name; ?></h1>
        </div>
        <div class="pf-search">
          <div class="td input">
            <input type="text" id="pf_search" placeholder="Search for perks like “Stadia”" />
          </div>
          <div class="td submit">
            <button type="submit">
              <img src="<?php bloginfo('template_url'); ?>/img/ico/ico-search-perkstore.png">
            </button>
          </div>
        </div>
      </div>
      <hr/>
      <div class="item-content-container">
        <div class="item-content-label">
          <p>Editor's Pick</p>
        </div>
        <div class="item-perkstore-image">
          <div class="img-left">
            <img class="top-left" src="<?php bloginfo('template_url'); ?>/img/img-perk-store-left.png">
            <?php 
              if (isset($current_perkslist[0])) { 
                $top1_item_meta = get_post_meta($current_perkslist[0]->ID);
            ?>
            <div class="top-item">
              <input type="hidden" id="h_top_<?php echo $current_perkslist[0]->ID;?>" class="prod" value="<?php echo $current_perkslist[0]->ID;?>" />
              <input type="hidden" id="h_top_<?php echo $category->cat_ID;?>" class="cat" value="<?php echo $category->cat_ID;?>" />
              <div class="pf-item-image">
                <img src="<?php echo get_the_post_thumbnail_url($current_perkslist[0]);?>">
              </div>
              <div class="pf-item-detail-container">
                <div class="pf-item-detail">
                  <div class="pf-item-text">
                    <div class="item-title"><b><?php echo $top1_item_meta['perk_name'][0]; ?></b></div>
                    <div class="item-desc"><?php if ($top1_item_meta['perk_detail'][0] != "") { echo $top1_item_meta['perk_detail'][0]; } ?></div>
                    <div class="item-price"><?php if ($top1_item_meta['price'][0] != '') { echo $top1_item_meta['currency_symbol'][0].$top1_item_meta['price'][0]; ?>/mo<?php } ?></div>
                  </div>
                  <div class="pf-item-button">
                  <?php if ($top1_item_meta['button_text'][0] != '') { ?>
                    <button <?php if ($top1_item_meta['button_link'][0] != "") { ?> onclick="window.open('<?php echo $top1_item_meta['button_link'][0];?>', '_blank')" <?php } ?> class="btn-pink btn-rd"><?php echo $top1_item_meta['button_text'][0];?></button>
                  <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
            <?php 
              if (isset($current_perkslist[2])) { 
                $top3_item_meta = get_post_meta($current_perkslist[2]->ID);
            ?>
            <div class="top-item">
              <input type="hidden" id="h_top_<?php echo $current_perkslist[2]->ID;?>" class="prod" value="<?php echo $current_perkslist[2]->ID;?>" />
              <input type="hidden" id="h_top_<?php echo $category->cat_ID;?>" class="cat" value="<?php echo $category->cat_ID;?>" />
              <div class="pf-item-image">
                <img src="<?php echo get_the_post_thumbnail_url($current_perkslist[2]);?>">
              </div>
              <div class="pf-item-detail-container">
                <div class="pf-item-detail">
                  <div class="pf-item-text">
                    <div class="item-title"><b><?php echo $top3_item_meta['perk_name'][0]; ?></b></div>
                    <div class="item-desc"><?php if ($top3_item_meta['perk_detail'][0] != "") { echo $top3_item_meta['perk_detail'][0]; } ?></div>
                    <div class="item-price"><?php if ($top3_item_meta['price'][0] != '') { echo $top3_item_meta['currency_symbol'][0].$top3_item_meta['price'][0]; ?>/mo<?php } ?></div>
                  </div>
                  <div class="pf-item-button">
                  <?php if ($top3_item_meta['button_text'][0] != '') { ?>
                    <button <?php if ($top3_item_meta['button_link'][0] != "") { ?> onclick="window.open('<?php echo $top3_item_meta['button_link'][0];?>', '_blank')" <?php } ?> class="btn-pink btn-rd"><?php echo $top3_item_meta['button_text'][0];?></button>
                  <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
          <div class="img-right">
            <img class="top-right" src="<?php bloginfo('template_url'); ?>/img/img-perk-store-right.png">
            <?php 
              if (isset($current_perkslist[1])) { 
                $top2_item_meta = get_post_meta($current_perkslist[1]->ID);
            ?>
            <div class="top-item">
              <input type="hidden" id="h_top_<?php echo $current_perkslist[1]->ID;?>" class="prod" value="<?php echo $current_perkslist[1]->ID;?>" />
              <input type="hidden" id="h_top_<?php echo $category->cat_ID;?>" class="cat" value="<?php echo $category->cat_ID;?>" />
              <div class="pf-item-image">
                <img src="<?php echo get_the_post_thumbnail_url($current_perkslist[1]);?>">
              </div>
              <div class="pf-item-detail-container">
                <div class="pf-item-detail">
                  <div class="pf-item-text">
                    <div class="item-title"><b><?php echo $top2_item_meta['perk_name'][0]; ?></b></div>
                    <div class="item-desc"><?php if ($top2_item_meta['perk_detail'][0] != "") { echo $top2_item_meta['perk_detail'][0]; } ?></div>
                    <div class="item-price"><?php if ($top2_item_meta['price'][0] != '') { echo $top2_item_meta['currency_symbol'][0].$top2_item_meta['price'][0]; ?>/mo<?php } ?></div>
                  </div>
                  <div class="pf-item-button">
                  <?php if ($top2_item_meta['button_text'][0] != '') { ?>
                    <button <?php if ($top2_item_meta['button_link'][0] != "") { ?> onclick="window.location.href='<?php echo $top2_item_meta['button_link'][0];?>'" <?php } ?> class="btn-pink btn-rd"><?php echo $top2_item_meta['button_text'][0];?></button>
                  <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
            <?php 
              if (isset($current_perkslist[3])) { 
                $top4_item_meta = get_post_meta($current_perkslist[3]->ID);
            ?>
            <div class="top-item">
              <input type="hidden" id="h_top_<?php echo $current_perkslist[3]->ID;?>" class="prod" value="<?php echo $current_perkslist[3]->ID;?>" />
              <input type="hidden" id="h_top_<?php echo $category->cat_ID;?>" class="cat" value="<?php echo $category->cat_ID;?>" />
              <div class="pf-item-image">
                <img src="<?php echo get_the_post_thumbnail_url($current_perkslist[3]);?>">
              </div>
              <div class="pf-item-detail-container">
                <div class="pf-item-detail">
                  <div class="pf-item-text">
                    <div class="item-title"><b><?php echo $top4_item_meta['perk_name'][0]; ?></b></div>
                    <div class="item-desc"><?php if ($top4_item_meta['perk_detail'][0] != "") { echo $top4_item_meta['perk_detail'][0]; } ?></div>
                    <div class="item-price"><?php if ($top4_item_meta['price'][0] != '') { echo $top4_item_meta['currency_symbol'][0].$top4_item_meta['price'][0]; ?>/mo<?php } ?></div>
                  </div>
                  <div class="pf-item-button">
                  <?php if ($top4_item_meta['button_text'][0] != '') { ?>
                    <button <?php if ($top4_item_meta['button_link'][0] != "") { ?> onclick="window.location.href='<?php echo $top4_item_meta['button_link'][0];?>'" <?php } ?> class="btn-pink btn-rd"><?php echo $top4_item_meta['button_text'][0];?></button>
                  <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
        <hr/>
        <div class="item-list-container">
          <div id="perkstore_left" class="arrow">
            <img src="<?php bloginfo('template_url'); ?>/img/ico/ico-webarrow-left.png">
          </div>
          <div class="item-content">
            <div class="row">
            <?php
            foreach($current_perkslist as $i => $item) {
              $item_thumb_url = get_the_post_thumbnail_url($item);
              $item_meta = get_post_meta($item->ID);
              if ($i % 3 == 0) {
            ?>
              <div class="item">
                <input type="hidden" id="h_<?php echo $item->ID;?>" class="prod" value="<?php echo $item->ID;?>" />
                <input type="hidden" id="h_<?php echo $category->cat_ID;?>" class="cat" value="<?php echo $category->cat_ID;?>" />
                <div class="pf-item-image">
                  <img src="<?php echo $item_thumb_url;?>">
                </div>
                <div class="pf-item-detail-container">
                  <div class="pf-item-detail">
                    <div class="pf-item-text">
                      <div class="item-title"><b><?php echo $item_meta['perk_name'][0]; ?></b></div>
                      <div class="item-desc"><?php if ($item_meta['perk_detail'][0] != "") { echo $item_meta['perk_detail'][0]; } ?></div>
                      <div class="item-price"><?php if ($item_meta['price'][0] != '') { echo $item_meta['currency_symbol'][0].$item_meta['price'][0]; ?>/mo<?php } ?></div>
                    </div>
                    <div class="pf-item-button">
                    <?php if ($item_meta['button_text'][0] != '') { ?>
                      <button <?php if ($item_meta['button_link'][0] != "") { ?> onclick="window.location.href='<?php echo $item_meta['button_link'][0];?>'" <?php } ?> class="btn-pink btn-rd"><?php echo $item_meta['button_text'][0];?></button>
                    <?php } ?>
                    </div>
                  </div>
                  <hr/>
                </div>
              </div>
            <?php 
              }
            }
            ?>
            </div>
            <div class="row">
            <?php
            foreach($current_perkslist as $i => $item) {
              $item_thumb_url = get_the_post_thumbnail_url($item);
              $item_meta = get_post_meta($item->ID);
              if ($i % 3 == 1) {
            ?>
              <div class="item">
                <input type="hidden" id="h_<?php echo $item->ID;?>" class="prod" value="<?php echo $item->ID;?>" />
                <input type="hidden" id="h_<?php echo $category->cat_ID;?>" class="cat" value="<?php echo $category->cat_ID;?>" />
                <div class="pf-item-image">
                  <img src="<?php echo $item_thumb_url;?>">
                </div>
                <div class="pf-item-detail-container">
                  <div class="pf-item-detail">
                    <div class="pf-item-text">
                      <div class="item-title"><b><?php echo $item_meta['perk_name'][0]; ?></b></div>
                      <div class="item-desc"><?php if ($item_meta['perk_detail'][0] != "") { echo $item_meta['perk_detail'][0]; } ?></div>
                      <div class="item-price"><?php if ($item_meta['price'][0] != '') { echo $item_meta['currency_symbol'][0].$item_meta['price'][0]; ?>/mo<?php } ?></div>
                    </div>
                    <div class="pf-item-button">
                    <?php if ($item_meta['button_text'][0] != '') { ?>
                      <button <?php if ($item_meta['button_link'][0] != "") { ?> onclick="window.location.href='<?php echo $item_meta['button_link'][0];?>'" <?php } ?> class="btn-pink btn-rd"><?php echo $item_meta['button_text'][0];?></button>
                    <?php } ?>
                    </div>
                  </div>
                  <hr/>
                </div>
              </div>
            <?php 
              }
            }
            ?>
              <div class="item">
              </div>
            </div>
            <div class="row">
            <?php
            foreach($current_perkslist as $i => $item) {
              $item_thumb_url = get_the_post_thumbnail_url($item);
              $item_meta = get_post_meta($item->ID);
              if ($i % 3 == 2) {
            ?>
              <div class="item">
                <input type="hidden" id="h_<?php echo $item->ID;?>" class="prod" value="<?php echo $item->ID;?>" />
                <input type="hidden" id="h_<?php echo $category->cat_ID;?>" class="cat" value="<?php echo $category->cat_ID;?>" />
                <div class="pf-item-image">
                  <img src="<?php echo $item_thumb_url;?>">
                </div>
                <div class="pf-item-detail-container">
                  <div class="pf-item-detail">
                    <div class="pf-item-text">
                      <div class="item-title"><b><?php echo $item_meta['perk_name'][0]; ?></b></div>
                      <div class="item-desc"><?php if ($item_meta['perk_detail'][0] != "") { echo $item_meta['perk_detail'][0]; } ?></div>
                      <div class="item-price"><?php if ($item_meta['price'][0] != '') { echo $item_meta['currency_symbol'][0].$item_meta['price'][0]; ?>/mo<?php } ?></div>
                    </div>
                    <div class="pf-item-button">
                    <?php if ($item_meta['button_text'][0] != '') { ?>
                      <button <?php if ($item_meta['button_link'][0] != "") { ?> onclick="window.location.href='<?php echo $item_meta['button_link'][0];?>'" <?php } ?> class="btn-pink btn-rd"><?php echo $item_meta['button_text'][0];?></button>
                    <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php 
              }
            }
            ?>
              <div class="item">
              </div>
              <div class="item">
              </div>
            </div>
          </div>
          <div id="perkstore_right" class="arrow">
            <img src="<?php bloginfo('template_url'); ?>/img/ico/ico-webarrow-right.png">
          </div>
        </div>
      </div>
      <div class="item-detail-content-container hidden">
        <div class="item-detail">
          <div class="item-detail-image">
            <img src="<?php echo $item_thumb_url;?>">
          </div>
          <div class="item-detail-text">
            <div class="pf-item-text">
              <div class="item-title"><b>Peloton — Digital Membership</b></div>
              <div class="item-desc">Discover something new everytime you sweat</div>
              <div class="item-provide"><a href="">Provider Website</a></div>
            </div>
            <div class="pf-item-button">
              <button class="btn-pink btn-rd">Activate</button>
              <div class="item-price">
              $39/mo
              </div>
            </div>
          </div>
        </div>
        <div class="item-cosmetic-image-container">
          <div id="item_left" class="arrow">
            <img src="<?php bloginfo('template_url'); ?>/img/ico/ico-webarrow-left.png">
          </div>
          <div class="item-image-content">
            <div class="image-list">
              <div class="image-item">
                <img src="<?php bloginfo('template_url'); ?>/img/img-perk-store-left.png">
              </div>
              <div class="image-item">
                <img src="<?php bloginfo('template_url'); ?>/img/img-perk-store-left.png">
              </div>
              <div class="image-item">
                <img src="<?php bloginfo('template_url'); ?>/img/img-perk-store-left.png">
              </div>
            </div>
          </div>
          <div id="item_right" class="arrow">
            <img src="<?php bloginfo('template_url'); ?>/img/ico/ico-webarrow-right.png">
          </div>
        </div>
        <hr/>
        <div class="item-support-device">
          <div class="left">
            <b>Supported Devices:</b> IOS, Android
          </div>
          <div class="right">
            <a href="" class="item-link">
            Show All
            </a>
          </div>
        </div>
        <hr/>
        <div class="item-helpful-link">
          <div class="item-title">
            <b>Helpful Information</b>
          </div>
          <div class="item-link">
            <a href="">The Absolute Beginner's Guide to Pelaton</a>
          </div>
          <div class="item-link">
            <a href="">The Pelaton Bike Brings the Spin Class Party to Your House</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="mobile-flex perkfix-store-search">
    <div class="pf-search">
      <div class="td input">
        <input type="text" id="pf_mobile_search" placeholder="Search for perks like “Stadia”" />
      </div>
      <div class="td submit">
        <button type="submit">
          <img src="<?php bloginfo('template_url'); ?>/img/ico/ico-search-perkstore.png">
        </button>
      </div>
    </div>
  </div>
  <div class="mobile perkfix-store-categories">
    <?php 
      foreach($pf_categories as $category) {
        if ($category->category_parent == 0) {
    ?>
    <div class="category-list-title">
      <img src="<?php echo $category->icon_image_url; ?>">
      <b><?php echo $category->name; ?></b>
    </div>
    <?php
        }
      } 
    ?>
    <?php 
      foreach($pf_categories as $category) {
        if ($category->slug == "popular-perks") {
          $args = array('category' => $category->term_id, 'post_type' => 'perks', 'posts_per_page' => 1000);
          $popular_perkslist = get_posts($args);
          $empty_val = count($popular_perkslist) % 3;
    ?>
    <div class="category-title">
      <div class="left">
        <img src="<?php echo $category->icon_image_url; ?>">
        <b><?php echo $category->name; ?></b>
      </div>
    </div>
    <div id="pf_<?php echo $category->slug; ?>" class="popular perkfix-category">
      <div class="row">
      <?php 
      foreach($popular_perkslist as $i => $item) {
        $item_thumb_url = get_the_post_thumbnail_url($item);
        $item_meta = get_post_meta($item->ID);
        //print_r($item);
        if ($i % 3 == 0) {
      ?>
        <div class="pf-item">
          <input type="hidden" id="h_pf_<?php echo $item->ID;?>" class="prod" value="<?php echo $item->ID;?>" />
          <input type="hidden" id="h_pf_<?php echo $category->cat_ID;?>" class="cat" value="<?php echo $category->cat_ID;?>" />
          <div class="pf-item-image">
            <img src="<?php echo $item_thumb_url;?>">
          </div>
          <div class="pf-item-detail-container">
            <div class="pf-item-detail">
              <div class="pf-item-text">
                <div class="item-title"><b><?php echo $item_meta['perk_name'][0]; ?></b></div>
                <div class="item-desc"><?php if ($item_meta['perk_detail'][0] != "") { echo $item_meta['perk_detail'][0]; } ?></div>
                <div class="item-price"><?php if ($item_meta['price'][0] != '') { echo $item_meta['currency_symbol'][0].$item_meta['price'][0]; ?>/mo<?php } ?></div>
              </div>
              <div class="pf-item-button">
              <?php if ($item_meta['button_text'][0] != '') { ?>
                <button <?php if ($item_meta['button_link'][0] != "") { ?> onclick="window.location.href='<?php echo $item_meta['button_link'][0];?>'" <?php } ?> class="btn-pink btn-rd"><?php echo $item_meta['button_text'][0];?></button>
              <?php } ?>
              </div>
            </div>
            <div class="pf-item-detail-break">
              <hr/>
            </div>
          </div>
        </div>
      <?php 
        }
      } 
      ?>
      </div>
      <div class="row">
      <?php 
      foreach($popular_perkslist as $i => $item) {
        $item_thumb_url = get_the_post_thumbnail_url($item);
        $item_meta = get_post_meta($item->ID);
        //print_r($item_meta);
        if ($i % 3 == 1) {
      ?>
        <div class="pf-item">
          <input type="hidden" id="h_pf_<?php echo $item->ID;?>" class="prod" value="<?php echo $item->ID;?>" />
          <input type="hidden" id="h_pf_<?php echo $category->cat_ID;?>" class="cat" value="<?php echo $category->cat_ID;?>" />
          <div class="pf-item-image">
            <img src="<?php echo $item_thumb_url;?>">
          </div>
          <div class="pf-item-detail-container">
            <div class="pf-item-detail">
              <div class="pf-item-text">
                <div class="item-title"><b><?php echo $item_meta['perk_name'][0]; ?></b></div>
                <div class="item-desc"><?php if ($item_meta['perk_detail'][0] != "") { echo $item_meta['perk_detail'][0]; } ?></div>
              <div class="item-price"><?php if ($item_meta['price'][0] != '') { echo $item_meta['currency_symbol'][0].$item_meta['price'][0]; ?>/mo<?php } ?></div>
              </div>
              <div class="pf-item-button">
              <?php if ($item_meta['button_text'][0] != '') { ?>
                <button <?php if ($item_meta['button_link'][0] != "") { ?> onclick="window.location.href='<?php echo $item_meta['button_link'][0];?>'" <?php } ?> class="btn-pink btn-rd"><?php echo $item_meta['button_text'][0];?></button>
              <?php } ?>
              </div>
            </div>
            <div class="pf-item-detail-break">
              <hr/>
            </div>
          </div>
        </div>
      <?php 
        }
      } 
      ?>
      <?php if ($empty_val > 0) { ?>
        <div class="pf-item">
        </div>
      <?php } ?>
      </div>
      <div class="row">
      <?php 
      foreach($popular_perkslist as $i => $item) {
        $item_thumb_url = get_the_post_thumbnail_url($item);
        $item_meta = get_post_meta($item->ID);
        //print_r($item_meta);
        if ($i % 3 == 2) {
      ?>
        <div class="pf-item">
          <input type="hidden" id="h_pf_<?php echo $item->ID;?>" class="prod" value="<?php echo $item->ID;?>" />
          <input type="hidden" id="h_pf_<?php echo $category->cat_ID;?>" class="cat" value="<?php echo $category->cat_ID;?>" />
          <div class="pf-item-image">
            <img src="<?php echo $item_thumb_url;?>">
          </div>
          <div class="pf-item-detail-container">
            <div class="pf-item-detail">
              <div class="pf-item-text">
                <div class="item-title"><b><?php echo $item_meta['perk_name'][0]; ?></b></div>
                <div class="item-desc"><?php if ($item_meta['perk_detail'][0] != "") { echo $item_meta['perk_detail'][0]; } ?></div>
                <div class="item-price"><?php if ($item_meta['price'][0] != '') { echo $item_meta['currency_symbol'][0].$item_meta['price'][0]; ?>/mo<?php } ?></div>
              </div>
              <div class="pf-item-button">
              <?php if ($item_meta['button_text'][0] != '') { ?>
                <button <?php if ($item_meta['button_link'][0] != "") { ?> onclick="window.location.href='<?php echo $item_meta['button_link'][0];?>'" <?php } ?> class="btn-pink btn-rd"><?php echo $item_meta['button_text'][0];?></button>
              <?php } ?>
              </div>
            </div>
          </div>
        </div>
      <?php 
        }
      } 
      ?>
      <?php if ($empty_val > 0) { ?>
        <div class="pf-item">
        </div>
      <?php } ?>
      </div>
    </div>
    <hr/>
    <?php
        }
      } 
    ?>
    <!-- foreach -->
    <?php 
      foreach($pf_categories as $category) {
        //print_r($category);
        if ($category->slug != "popular-perks" && $category->category_parent != 0) {
          $args = array('category' => $category->term_id, 'post_type' => 'perks', 'posts_per_page' => 1000);
          $normal_perkslist = get_posts($args);
          //print_r($popular_perkslist);
          $empty_val1 = count($normal_perkslist) % 2;
    ?>
    <div class="category-title">
      <div class="left">
        <img src="<?php echo $category->icon_image_url; ?>">
        <b><?php echo $category->name; ?></b>
      </div>
    </div>
    <div id="pf_<?php echo $category->slug; ?>" class="normal perkfix-category">
    <div class="row">
      <?php 
      foreach($normal_perkslist as $i => $item) {
        $item_thumb_url = get_the_post_thumbnail_url($item);
        $item_meta = get_post_meta($item->ID);
        //print_r($item_meta);
        if ($i % 2 == 0) {
      ?>
        <div class="pf-item">
          <input type="hidden" id="h_pf_<?php echo $item->ID;?>" class="prod" value="<?php echo $item->ID;?>" />
          <input type="hidden" id="h_pf_<?php echo $category->cat_ID;?>" class="cat" value="<?php echo $category->cat_ID;?>" />
          <div class="pf-item-image">
            <img src="<?php echo $item_thumb_url;?>">
          </div>
          <div class="pf-item-detail-container">
            <div class="pf-item-detail">
              <div class="pf-item-text">
                <div class="item-title"><b><?php echo $item_meta['perk_name'][0]; ?></b></div>
                <div class="item-desc"><?php if ($item_meta['perk_detail'][0] != "") { echo $item_meta['perk_detail'][0]; } ?></div>
                <div class="item-price"><?php if ($item_meta['price'][0] != '') { echo $item_meta['currency_symbol'][0].$item_meta['price'][0]; ?>/mo<?php } ?></div>
              </div>
              <div class="pf-item-button">
              <?php if ($item_meta['button_text'][0] != '') { ?>
                <button <?php if ($item_meta['button_link'][0] != "") { ?> onclick="window.location.href='<?php echo $item_meta['button_link'][0];?>'" <?php } ?> class="btn-pink btn-rd"><?php echo $item_meta['button_text'][0];?></button>
              <?php } ?>
              </div>
            </div>
            <div class="pf-item-detail-break">
              <hr/>
            </div>
          </div>
        </div>
      <?php 
        }
      } 
      ?>
      </div>
      <div class="row">
      <?php 
      foreach($normal_perkslist as $i => $item) {
        $item_thumb_url = get_the_post_thumbnail_url($item);
        $item_meta = get_post_meta($item->ID);
        //print_r($item_meta);
        if ($i % 2 == 1) {
      ?>
        <div class="pf-item">
          <input type="hidden" id="h_pf_<?php echo $item->ID;?>" class="prod" value="<?php echo $item->ID;?>" />
          <input type="hidden" id="h_pf_<?php echo $category->cat_ID;?>" class="cat" value="<?php echo $category->cat_ID;?>" />
          <div class="pf-item-image">
            <img src="<?php echo $item_thumb_url;?>">
          </div>
          <div class="pf-item-detail-container">
            <div class="pf-item-detail">
              <div class="pf-item-text">
                <div class="item-title"><b><?php echo $item_meta['perk_name'][0]; ?></b></div>
                <div class="item-desc"><?php if ($item_meta['perk_detail'][0] != "") { echo $item_meta['perk_detail'][0]; } ?></div>
                <div class="item-price"><?php if ($item_meta['price'][0] != '') { echo $item_meta['currency_symbol'][0].$item_meta['price'][0]; ?>/mo<?php } ?></div>
              </div>
              <div class="pf-item-button">
              <?php if ($item_meta['button_text'][0] != '') { ?>
                <button <?php if ($item_meta['button_link'][0] != "") { ?> onclick="window.location.href='<?php echo $item_meta['button_link'][0];?>'" <?php } ?> class="btn-pink btn-rd"><?php echo $item_meta['button_text'][0];?></button>
              <?php } ?>
              </div>
            </div>
          </div>
        </div>
      <?php 
        }
      } 
      ?>
      <?php if ($empty_val1 > 0) { ?>
        <div class="pf-item">
        </div>
      <?php } ?>
      </div>
      
    </div>
    <hr/>
    <?php
        }
      } 
    ?>
  
  
  
  </div>
  <div class="mobile product-detail hidden">
    <hr/>
    <div>
      <a class="btn-back"><i class="fas fa-chevron-left"></i></a>
    </div>
    <div class="category-title">
      <div class="left">
        <img src="<?php echo $category->icon_image_url; ?>">
        <b><?php echo $category->name; ?></b>
      </div>
    </div>
    <div class="perkfix-category">
      <div class="row">
        <div class="pf-item1">
          <div class="pf-item-image">
            <img src="<?php echo $item_thumb_url;?>">
          </div>
          <div class="pf-item-detail-container">
            <div class="pf-item-detail">
              <div class="pf-item-text">
                <div class="item-title"><b>Test</b></div>
                <div class="item-desc">Test</div>
                <div class="item-price">$10/mo</div>
              </div>
              <div class="pf-item-button">
                <button onclick="#" class="btn-pink btn-rd">Activate</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row pick-image-container">
        
      </div>
      <hr/>
      <div class="support-device">
        <div class="left"><b>Supported Devices:</b>IOS, Android</div>
        <div class="right"><a href='#'>See All</a></div>
      </div>
      <hr/>
      <div class="helpful-info">
        <div class="title"><b>Helpful Information</b></div>
        <div class="content"><a href="#">The Absolute Beginner’s Guide to Peloton</a></div>
        <div class="content"><a href="#">The Peloton Bike Brings the Spin Class Party to Your House</a></div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(".category-item").on("click", function() {
      $(".category-item").children(".right-item").removeClass("selected");
      $(this).children(".right-item").addClass("selected");
      var catID = $(this).children("input[type=hidden]").val();
      var pos = $(document).scrollTop();
      window.location.href="?category_id="+catID+"&po="+pos;
    });

    $(function() {
      var currentPos = <?php echo $current_pos; ?>;
      //$(document).scrollTop(currentPos);
      var currentID = <?php echo $current_category_id ?>;
      $(".category-item").each(function(index) {
        var catID = $(this).children("input[type=hidden]").val();
        if (catID == currentID) {
          $(this).children(".right-item").addClass("selected");
        }
      });
    });

    // mobile
    $(".pf-item").on("click", function() {
      var itemID = $(this).children("input[type=hidden].prod").val();
      var catID = $(this).children("input[type=hidden].cat").val();

      var endpoint = "<?php echo site_url(); ?>"+'/wp-json/perkstore/v1/item-detail/'+catID+'/'+itemID;

      $.ajax({
        url: endpoint,
        method: 'GET'
      }).done(function(response){
        console.log(response);
      }).fail(function(response){
        // Show error message
        alert(response.responseJSON.message);
      }).always(function(){
        // e.g. Remove 'loading' class
      });

      $(".perkfix-store-categories").addClass("hidden");
      $(".product-detail").removeClass("hidden");
    });

    // mobile back button  
    $(".btn-back").on("click", function() {
      $(".perkfix-store-categories").removeClass("hidden");
      $(".product-detail").addClass("hidden");
    });

    // web app back button
    $(".w-btn-back").on("click", function() {
      $(".item-content-container").removeClass("hidden");
      $(".d-btn-back").addClass("hidden");
      $(".item-detail-content-container").addClass("hidden");
    });

    // web app - top item click - detail page
    $(".top-item").on("click", function() {
      var itemID = $(this).children("input[type=hidden].prod").val();
      var catID = $(this).children("input[type=hidden].cat").val();

      var endpoint = "<?php echo site_url(); ?>"+'/wp-json/perkstore/v1/item-detail/'+catID+'/'+itemID;

      console.log('top item');
      console.log("item-id", itemID);
      console.log("category-id", catID);

      $(".item-content-container").addClass("hidden");
      $(".item-detail-content-container").removeClass("hidden");
      $(".d-btn-back").removeClass("hidden");

      $.ajax({
        url: endpoint,
        method: 'GET'
      }).done(function(response){
        console.log(response);
      }).fail(function(response){
        // Show error message
        alert(response.responseJSON.message);
      }).always(function(){
        // e.g. Remove 'loading' class
      });
    });

    // web app - item click - detail page
    $(".item").on("click", function() {
      var itemID = $(this).children("input[type=hidden].prod").val();
      var catID = $(this).children("input[type=hidden].cat").val();

      var endpoint = "<?php echo site_url(); ?>"+'/wp-json/perkstore/v1/item-detail/'+catID+'/'+itemID;

      console.log('item');
      console.log("item-id", itemID);
      console.log("category-id", catID);

      $(".item-content-container").addClass("hidden");
      $(".item-detail-content-container").removeClass("hidden");
      $(".d-btn-back").removeClass("hidden");

      $.ajax({
        url: endpoint,
        method: 'GET'
      }).done(function(response){
        console.log(response);
      }).fail(function(response){
        // Show error message
        alert(response.responseJSON.message);
      }).always(function(){
        // e.g. Remove 'loading' class
      });
    });
  </script>