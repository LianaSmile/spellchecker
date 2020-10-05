<title>Contact V17</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/app.css')}}">
</head>
<body>

@yield('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {

        $('#contact-form').on('submit', function (event) {

            event.preventDefault();

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            var message = $("#message").text();

            $.ajax({
                url: "/compare",
                type: "POST",
                data: {
                    message: message,
                },
                success: function (response) {

                    $('#message').html((response));

                    $('.wrong').on('click', function (event) {

                        event.preventDefault();

                        $(this).find('div').css("display", "block");

                        var id = $(this).attr("id");

                        $('#' + id).find('.' + id).click(function () {

                            $('#' + id).find("select").change(function () {

                                $("select option:selected").each(function () {

                                    $('#' + id).text($(this).text());

                                });

                            })
                                .change();
                        });
                    });

                    $('.wrong').on('dblclick', function (event) {

                        event.preventDefault();

                        $(this).find('div').css("display", "none");

                    });

                },

            });

        });

    });

</script>






