<!doctype html>
<html lang="en">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
    body {
        background-color: #f4f7f6;
        margin-top: 20px;
    }

    .card {
        background: #fff;
        transition: .5s;
        border: 0;
        margin-bottom: 30px;
        border-radius: .55rem;
        position: relative;
        width: 100%;
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
    }

    .chat-app .people-list {
        width: 280px;
        position: absolute;
        left: 0;
        top: 0;
        padding: 20px;
        z-index: 7
    }

    .chat-app .chat {
        margin-left: 280px;
        border-left: 1px solid #eaeaea
    }

    .people-list {
        -moz-transition: .5s;
        -o-transition: .5s;
        -webkit-transition: .5s;
        transition: .5s
    }

    .people-list .chat-list li {
        padding: 10px 15px;
        list-style: none;
        border-radius: 3px
    }

    .people-list .chat-list li:hover {
        background: #efefef;
        cursor: pointer
    }

    .people-list .chat-list li.active {
        background: #efefef
    }

    .people-list .chat-list li .name {
        font-size: 15px
    }

    .people-list .chat-list img {
        width: 45px;
        border-radius: 50%
    }

    .people-list img {
        float: left;
        border-radius: 50%
    }

    .people-list .about {
        float: left;
        padding-left: 8px
    }

    .people-list .status {
        color: #999;
        font-size: 13px
    }

    .chat .chat-header {
        padding: 15px 20px;
        border-bottom: 2px solid #f4f7f6
    }

    .chat .chat-header img {
        float: left;
        border-radius: 40px;
        width: 40px
    }

    .chat .chat-header .chat-about {
        float: left;
        padding-left: 10px
    }

    .chat .chat-history {
        padding: 20px;
        border-bottom: 2px solid #fff;
        height: 80vh;
        overflow-y: auto;
    }

    .chat .chat-history ul {
        padding: 0
    }

    .chat .chat-history ul li {
        list-style: none;
        margin-bottom: 30px
    }

    .chat .chat-history ul li:last-child {
        margin-bottom: 0px
    }

    .chat .chat-history .message-data {
        margin-bottom: 15px
    }

    .chat .chat-history .message-data img {
        border-radius: 40px;
        width: 40px
    }

    .chat .chat-history .message-data-time {
        color: #434651;
        padding-left: 6px
    }

    .chat .chat-history .message {
        color: #444;
        padding: 18px 20px;
        line-height: 26px;
        font-size: 16px;
        border-radius: 7px;
        display: inline-block;
        position: relative
    }

    .chat .chat-history .message:after {
        bottom: 100%;
        right: 15px;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: #fff;
        border-width: 10px;
        margin-left: -10px
    }

    .chat .chat-history .my-message {
        background: #efefef;
        max-width: 50%;
    }

    .chat .chat-history .my-message:after {
        bottom: 100%;
        left: 30px;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: #efefef;
        border-width: 10px;
        margin-left: -10px
    }

    .chat .chat-history .other-message {
        background: #e8f1f3;
        text-align: right;
        max-width: 50%;
    }

    .chat .chat-history .other-message:after {
        border-bottom-color: #e8f1f3;
        right: 15px
    }

    /* .chat .chat-message {
        padding: 20px
    } */

    .online,
    .offline,
    .me {
        margin-right: 2px;
        font-size: 8px;
        vertical-align: middle
    }

    .online {
        color: #86c541
    }

    .offline {
        color: #e47297
    }

    .me {
        color: #1d8ecd
    }

    .float-right {
        float: right
    }

    .clearfix:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0
    }

    #input_container {
        background-color: lightgray;
        padding: 10px;
    }

    #preview_image {
        width: 200px;
        margin-bottom: 10px;
    }

    .image_container {
        position: relative;
    }

    .image_container:hover .fa-close {
        display: block;
    }

    .fa-close {
        position: absolute;
        top: 10px;
        right: 14px;
        font-size: 26px;
        display: none
    }

    .fa-close:hover {
        cursor: pointer;
    }

    @media only screen and (max-width: 767px) {
        .chat-app .people-list {
            height: 465px;
            width: 100%;
            overflow-x: auto;
            background: #fff;
            left: -400px;
            display: none
        }

        .chat-app .people-list.open {
            left: 0
        }

        .chat-app .chat {
            margin: 0
        }

        .chat-app .chat .chat-header {
            border-radius: 0.55rem 0.55rem 0 0
        }

        .chat-app .chat-history {
            height: 300px;
            overflow-x: auto
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 992px) {
        .chat-app .chat-list {
            height: 650px;
            overflow-x: auto
        }

        .chat-app .chat-history {
            height: 600px;
            overflow-x: auto
        }
    }

    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
        .chat-app .chat-list {
            height: 480px;
            overflow-x: auto
        }

        .chat-app .chat-history {
            height: calc(100vh - 350px);
            overflow-x: auto
        }
    }
</style>

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>


        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card chat-app">
                        <div id="plist" class="people-list">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="height: 100%"><i
                                            class="fa fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                            <ul class="list-unstyled chat-list mt-2 mb-0" id="user_list">
                                <li class="clearfix" data-active="active" id="public_chat" onclick="set_message(this)"
                                    data-name="public chat">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                                    <div class="about">
                                        <div class="name">Public Chat</div>
                                        <div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago</div>
                                    </div>
                                </li>
                                {{-- <li class="clearfix active">
                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                        <div class="about">
                            <div class="name">Aiden Chavez</div>
                            <div class="status"> <i class="fa fa-circle online"></i> online </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                        <div class="about">
                            <div class="name">Mike Thomas</div>
                            <div class="status"> <i class="fa fa-circle online"></i> online </div>
                        </div>
                    </li>                                    
                    <li class="clearfix">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                        <div class="about">
                            <div class="name">Christian Kelly</div>
                            <div class="status"> <i class="fa fa-circle offline"></i> left 10 hours ago </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt="avatar">
                        <div class="about">
                            <div class="name">Monica Ward</div>
                            <div class="status"> <i class="fa fa-circle online"></i> online </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                        <div class="about">
                            <div class="name">Dean Henry</div>
                            <div class="status"> <i class="fa fa-circle offline"></i> offline since Oct 28 </div>
                        </div>
                    </li> --}}
                            </ul>
                        </div>
                        <div class="chat">
                            <div class="chat-header clearfix">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png"
                                                alt="avatar">
                                        </a>
                                        <div class="chat-about">
                                            <h6 class="m-b-0" id="curr_name">Aiden Chavez</h6>
                                            <small>Last seen: 2 hours ago</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 hidden-sm text-right">
                                        <a href="javascript:void(0);" class="btn btn-outline-secondary"
                                            id="image"><i class="fa fa-camera"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-outline-primary"><i
                                                class="fa fa-image"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-outline-info"><i
                                                class="fa fa-cogs"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-outline-warning"><i
                                                class="fa fa-question"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-history">
                                <ul class="m-b-0" id="main-body">
                                    {{-- <li class="clearfix">
                            <div class="message-data text-right">
                                <span class="message-data-time">10:10 AM, Today</span>
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                            </div>
                            <div class="message other-message float-right"> Hi Aiden, how are you? How is the project coming along? </div>
                        </li>
                        <li class="clearfix">
                            <div class="message-data">
                                <span class="message-data-time">10:12 AM, Today</span>
                            </div>
                            <div class="message my-message">Are we meeting today?</div>                                    
                        </li>                               
                        <li class="clearfix">
                            <div class="message-data">
                                <span class="message-data-time">10:15 AM, Today</span>
                            </div>
                            <div class="message my-message">Project has been already finished and I have results to show you.</div>
                        </li> --}}
                                </ul>
                            </div>
                            <div class="chat-message clearfix">
                                <div class="input-group mb-0" id="input_container">
                                    <div class="image_container">
                                        <img src="" alt="" id="preview_image" hidden>
                                        <i class="fa fa-close" id="img_close"></i>
                                    </div>
                                    <form id="main_form" style="width:100%">
                                        @csrf
                                        <input type="text" class="form-control" id="message" name="message"
                                            placeholder="Enter text here...">
                                        <input type="file" name="image" id="image_file" hidden>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>


@vite(['resources/css/app.css', 'resources/js/app.js'])
<div id="list_messages">

</div>

<div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            fetch_messages("public_chat");
            window.Echo.channel('test').listen('NewMessage', (e) => {
                var ac_id = $('[data-active="active"]').attr('id');
                console.log(e);
                if (ac_id == "public_chat") {
                    display_message(e);
                }
            });

            $.ajax({
                type: "get",
                url: '{{ url('/get_users') }}',
                success: function(e) {
                    $.each(e, function(i, v) {
                        $("#user_list").append(`<li class="clearfix" id="${v.id}" data-name = "${v.name}" onclick="set_message(this)" data-active="deactive">
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                            <div class="about">
                                <div class="name">${v.name}</div>
                                <div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago </div>                                            
                            </div>
                        </li>`);
                        window.Echo.private(`private.{{ $user_id }}.${v.id}`).listen(
                            'private_message', (e) => {
                                console.log(e);
                                var ac_id = $('[data-active="active"]').attr('id');
                                if (ac_id == e.message.user_id.id) {
                                    display_message(e);
                                }
                            })
                    });
                }
            })

            $('#image').on('click', function(e) {
                $('#image_file').trigger('click');
            })

            $("#image_file").change(function(e) {
                file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        console.log(event);
                        $("#preview_image")
                            .attr("src", event.target.result);
                        $("#preview_image").attr('hidden', false);
                    };
                    reader.readAsDataURL(file);
                }
            });
            $("#img_close").click(function(e) {
                $("#preview_image").attr('hidden', true);
                $("#image_file").val('');
            });

        });

        function display_message(e) {
            var image = `<img src='{{ asset('${e.message.image}') }}'>`
            if (e.message.user_id.id == '{{ $user_id }}') {
                document.getElementById('main-body').innerHTML += `<li class="clearfix">
                        <div class="message-data text-right">
                            <span class="message-data-time">${e.message.user_id.name}</span>
                            {{-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar"> --}}
                        </div>
                        <div class="message other-message float-right">${(e.message.image != null)?image:""} ${e.message.message} </div>
                    </li>`
            } else {
                document.getElementById('main-body').innerHTML += `<li class="clearfix">
                            <div class="message-data">
                                <span class="message-data-time">${e.message.user_id.name}</span>
                            </div>
                            <div class="message my-message">${(e.message.image != null)?image:""} ${e.message.message}</div>                                    
                        </li>`
            }
            $('.chat-history').animate({
                scrollTop: $(".chat-history")[0].scrollHeight
            });
        }

        async function fetch_messages(user_id) {
            await $.ajax({
                type: "post",
                data: {
                    user_id: user_id,
                    _token: '{{ csrf_token() }}'
                },
                url: '{{ url('/fetch_messages') }}',
                success: function(data) {
                    if (user_id == 'public_chat') {
                        $.each(data, function(key, value) {
                            var image = `<img src='{{ asset('${value.image}') }}'>`
                            if (value.sender_users.id == '{{ $user_id }}') {
                                document.getElementById('main-body').innerHTML += `<li class="clearfix">
                                        <div class="message-data text-right">
                                            <span class="message-data-time">${value.sender_users.name}</span>
                                            {{-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar"> --}}
                                        </div>
                                        <div class="message other-message float-right"> ${(value.image != null)?image:""} ${value.message} </div>
                                    </li>`
                            } else {
                                document.getElementById('main-body').innerHTML += `<li class="clearfix">
                                            <div class="message-data">
                                                <span class="message-data-time">${value.sender_users.name}</span>
                                            </div>
                                            <div class="message my-message">${(value.image != null)?image:""} ${value.message}</div>                                    
                                        </li>`
                            }
                        })
                    } else {
                        $.each(data, function(key, value) {
                            var image = `<img src='{{ asset('${value.image}') }}'>`
                            if (value.sender_users.id == '{{ $user_id }}') {
                                document.getElementById('main-body').innerHTML += `<li class="clearfix">
                                        <div class="message-data text-right">
                                            <span class="message-data-time">${value.sender_users.name}</span>
                                            {{-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar"> --}}
                                        </div>
                                        <div class="message other-message float-right">${(value.image != null)?image:""} ${value.message} </div>
                                    </li>`
                            } else {
                                document.getElementById('main-body').innerHTML += `<li class="clearfix">
                                            <div class="message-data">
                                                <span class="message-data-time">${value.sender_users.name}</span>
                                            </div>
                                            <div class="message my-message">${(value.image != null)?image:""} ${value.message}</div>                                    
                                        </li>`
                            }
                        })
                    }
                    $('.chat-history').animate({
                        scrollTop: $(".chat-history")[0].scrollHeight
                    });
                }
            })
        }

        function set_message(v) {
            $('[data-active="active"]').attr('data-active', "deactive");
            $(v).attr('data-active', "active");
            $('#main-body').html("");
            $('#curr_name').html($(v).attr('data-name'));

            var user_id = $(v).attr('id')
            fetch_messages(user_id).then(function() {
                $('.chat-history').animate({
                    scrollTop: $(".chat-history")[0].scrollHeight
                });
            });
        }
        $("#main_form").on("submit", function(e) {
            e.preventDefault();
            var ac = $('[data-active="active"]');
            var data = new FormData($('#main_form')[0])
            var message = $('#message').val();
            console.log(data);
            var id = $(ac[0]).attr('id');
            if (id == "public_chat") {
                if (message != "") {
                    $.ajax({
                        type: "post",
                        data: data,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        url: '{{ url('/send_message') }}'
                    })
                }
            } else {
                data.append('user_id', id);
                if (message != "") {
                    $.ajax({
                        type: "post",
                        data: data,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        url: '{{ url('/send_message_private') }}'
                    })
                    var preview_image = $('#preview_image').attr('src');
                    var image = `<img src='${preview_image}'>`
                    document.getElementById('main-body').innerHTML += `
                    <li class="clearfix">
                        <div class="message-data text-right">
                            <span class="message-data-time">{{ $user['name'] }}</span>
                            {{-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar"> --}}
                            </div>
                            <div class="message other-message float-right"> ${(preview_image != "")?image:""} ${message} </div>
                            </li>`
                    $('.chat-history').animate({
                        scrollTop: $(".chat-history")[0].scrollHeight
                    });
                }
            }
            $('#main_form')[0].reset();
            $("#preview_image").attr('hidden', true);
        })
    </script>
</div>
