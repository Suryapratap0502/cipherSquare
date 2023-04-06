var base_url = window.location.origin + "/";

function upload() {
    document.getElementById("show_image").style.display = "block";
    var imgcanvas = document.getElementById("show_image");
    var fileinput = document.getElementById("image");
    var image = new SimpleImage(fileinput);
    image.drawTo(imgcanvas);
}

function add_coloumn(val) {
    var coloumn_name = 'coloumn_' + val;
    $.ajax({
        url: base_url + 'task_two/add_coloumn',
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            coloumn_name: coloumn_name
        },
        success: function() {
            $("tr:first").append("<th scope='col'>coloumn_" + val + "</th>");
            $("tr:not(:first)").append("<th><input type='text' class='form-control custom_width' id='row_1' name='row_1' value='0'></th>");
        }
    })
}