$(document).ready(function () {
    let archive_chats = $(".archive_chat");
    $(".toggle-btn").click(function () {
        $(this).find('img').toggleClass("chevron-style");
    });
    $('.selectpicker').selectpicker({title: 'Skills'});

    $(".show-password").click(function () {
        var input = $(this).siblings();
        if (input.attr("type") == 'password') {
            input.attr("type", "text");
            $(this).children().attr("src", "data/img/eye-slash.svg");
        } else {
            input.attr("type", "password");
            $(this).children().attr("src", "data/img/eye.svg");
        }
    });

    $(".input-style").keyup(function () {
        $(this).siblings().find("button:not(.btn)").removeClass("back-btn");
        $(this).siblings().find("button:not(.btn)").addClass("active-btn");
        console.log("typing");
        if ($(this).val().length === 0) {
            $(this).siblings().find("button:not(.btn)").addClass("back-btn");
            $(this).siblings().find("button:not(.btn)").removeClass("active-btn");
        }
    });

    $('.modal-delete-btn').prop('disabled', true);
    $('#delete-input').keyup(function () {
        if ($(this).val() != '') {
            $('.modal-delete-btn').prop('disabled', false);
        } else {
            $('.modal-delete-btn').prop('disabled', true);
        }
    });

    $('#userimage').change(function () {
        let reader = new FileReader();
        reader.onload = function (event) {
            $image_crop.croppie('bind', {
               url: event.target.result
            }).then(function () {
                console.log("Jquery bind complete");
            })
        }
        reader.readAsDataURL(this.files[0]);
        $('#myModal').show();
    });

    $('#saveModal').click(function (event) {
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (response) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'user/uploadImage',
                type: 'POST',
                data: {"avatar":response},
                success:function (data) {
                    location.reload();
                }
            });
        })
        $('#myModal').hide();
    });

    $('.closeModal').click(function () {
        $('#myModal').hide();
    });

    $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
            width:200,
            height:200,
            type: 'circle'
        },
        boundary:{
            width:300,
            height:300
        }
    })


    // $('#liveSearch').keyup(function () {
    //     let search = $(this).val();
    //     $.ajax({
    //         type: "POST",
    //         url: "post/search",
    //         dataType: "json",
    //         data: {
    //             search: search
    //         },
    //         success: function (result) {
    //             console.log(result);
    //         }
    //     });
    // });
});

