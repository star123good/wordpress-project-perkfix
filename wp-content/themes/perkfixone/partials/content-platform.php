<?php
// Template name: Platform Page
$flag_redirect = false;

try {
    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
    $current_team_id = $current_user->team_id;
    $current_org_id = get_field('org_id', $current_team_id);
    $flag_redirect = ($current_user_id > 0 && $current_team_id > 0 && $current_org_id > 0);
}
catch(Exception $e) {
}

if ($flag_redirect) {
?>
<script>
    localStorage.setItem('perkfix_user_id', '<?php echo $current_user_id; ?>');
    localStorage.setItem('perkfix_team_id', '<?php echo $current_team_id; ?>');
    localStorage.setItem('perkfix_org_id', '<?php echo $current_org_id; ?>');
    window.location.replace("<?php echo site_url().'/hr-admin/'; ?>");
</script>
<?php
}
else {
?>
<script>
    localStorage.removeItem('perkfix_user_id');
    localStorage.removeItem('perkfix_team_id');
    localStorage.removeItem('perkfix_org_id');
</script>
<?php
}
?>
<div class="perkfix-home18">
    <div class="content">
        <h1 class="title">We are building something for you.</h1>
        <div class="movie-container">
            <img src="<?php bloginfo('template_url'); ?>/img/building.jpg" class="movie">
        </div>
    </div>
</div>