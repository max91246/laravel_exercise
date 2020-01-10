

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{URL::asset('/')}}js/jquery-1.10.1.min.js" ></script>
<script type="text/javascript">

   $(function() {
    /*
    const data = {
        name: 'max',
        redirect: 'http://example.com/callback'
    };

    $.ajax({
        type: 'POST',
        url: "/oauth/clients",
        data: data,
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {

        }
    });
    */

    $.ajax({
        type: 'POST',
        url: "/oauth/token",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {

        }
    });

    });
</script>