$("#avatar").on('click', function () {
        $("#add-image").trigger('click').on('change', function () {

            var file = this.files[0];
            var name = file.name;
            var size = file.size;
            var type = file.type.split('/').pop().toLowerCase();;

            var errors = "";
            //EXtension validation
            var accepted_ext = ['jpeg', 'png', 'jpg'];
            var valid = $.inArray(type, accepted_ext);
            if (valid == -1) {
                errors += "<p>Please select jpg or png </p>";
            } else if (size > 2097152) {
                errors += "<p>Image should be less than 2MB</p>";
            } else {
                var myForm = $("#imageForm");

                var imageData = new FormData();
                imageData.append("profile-image", file);
                var new_path = "";

                $.ajax({
                    url: "uploadimage.php",
                    type: "POST",
                    data: imageData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        new_path = data;
                    },
                    error: function () {
                        console.log("Error");
                    }

                }).done(function () {
                    $(".author>img").attr('src', new_path);
                    updateProfileImage(new_path);
                });
            }

        });

    });

/**
* updated the profile image in the database
*/
function updateProfileImage (new_path){
    $.ajax({
        url: "update-image.php",
        type: "POST",
        data: {new_path: new_path},
        success: function (data) {
            console.log(data);
        },
        error: function () {
            console.log("Error");
        }

    });
    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.sidenav').sidenav();
  });
        
}

/**
* Notification helper for display
* @param {string} type success||warning||danger||info
* @param {string} icon icon class to be used
* @param {string} message Message to be displayed
*/
var notify = function (type,icon,message){
    $.notify({
        	icon: icon,
        	message: message

        },{
            type: type,
            timer: 4000,
            placement: {
                from: 'top',
                align: 'right',
            }
        });
};