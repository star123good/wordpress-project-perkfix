jQuery(document).ready(function($) {
    var templateUrl = 'perkfix/';

    $("#pf_search").autoComplete({
        source: function(name, response) {
            //var templateUrl = location.href;
            
            console.log(name);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../wp-admin/admin-ajax.php',
                data: 'action=get_perkfix_names&k='+name,
                success: function(data) {
                    response(data);
                }
            });
        }
    });

    $("#pf_mobile_search").autoComplete({
        source: function(name, response) {
            //var templateUrl = location.href;
            console.log(name);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../wp-admin/admin-ajax.php',
                data: 'action=get_perkfix_names&k='+name,
                success: function(data) {
                    response(data);
                }
            });
        }
    });
});
