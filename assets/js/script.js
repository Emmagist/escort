$(document).ready(function(event) {//alert('hey')
    // event.preventDefault(); 
    $.ajax({
        url: 'controllers/ajaxGet.php?nav=200',
        method: 'GET',
        dataType: 'json',
        data: '200',
        contentType: false,
        processData: false,
        beforeSend: () => {
            $('#navigation_lists').html('Loading contents...');
        },
        success: (param) => {
            if (param) {
                $('#navigation_lists').html(param);
            }
        }
    })

})
//registration
$('#registeration_form').submit(function () {
    const formData = new FormData(this);
    $.ajax({
        url: 'controllers/fetchAjax.php?pg=200',
        method: 'POST',
        dataType: 'json',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: () => {
            $('.register_button').html('Registering...');
        },
        success: (param) => { alert(param)
            if (param.success) {
                $('#reg_success').fadeIn()
                $('#reg_success').text(param.success);
                setInterval(() => {
                    $('#reg_success').fadeOut();
                    location.reload();
                }, 7000);
            }else if(param.error){
                $('#reg_danger').fadeIn()
                $('#reg_danger').text(param.error);
                setInterval(() => {
                    $('#reg_danger').fadeOut();
                }, 5000);
            }
        }
    })
    return false;
});

//earns
// $(document).ready(function() {alert('hey')
//     // event.preventDefault(); 
//     $.ajax({
//         url: 'controllers/ajaxGet.php?ern=200',
//         method: 'GET',
//         dataType: 'json',
//         data: '200',
//         contentType: false,
//         processData: false,
//         beforeSend: () => {
//             $('#wallet_earn').html('Loading contents...');
//         },
//         success: (param) => {
//             if (param) {
//                 $('#wallet_earn').html(param);
//             }
//         }
//     })

// })

//get escort
// $(window).load(function(event) {
//     event.preventDefault(); alert('hey')
//     $.ajax({
//         url: 'controllers/ajaxGet.php?escorts=121',
//         method: 'GET',
//         dataType: 'json',
//         data: '121',
//         contentType: false,
//         processData: false,
//         beforeSend: () => {
//             $('.escort_row').html('Loading contents...');
//         },
//         success: (param) => {
//             if (param) {
//                 $('.escort_row').html(param);
//             }
//         }
//     })

// })