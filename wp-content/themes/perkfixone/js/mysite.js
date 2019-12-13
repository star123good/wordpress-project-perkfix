jQuery(document).ready(function($) {
    $("#pf_search").autoComplete({
        source: function(name, response) {
            console.log(name);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/wp-admin/admin-ajax.php',
                data: 'action=get_perkfix_names&k='+name,
                success: function(data) {
                    response(data);
                }
            });
        }
    });

    $("#pf_mobile_search").autoComplete({
        source: function(name, response) {
            console.log(name);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/wp-admin/admin-ajax.php',
                data: 'action=get_perkfix_names&k='+name,
                success: function(data) {
                    response(data);
                }
            });
        }
    });
});