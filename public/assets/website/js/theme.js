// Custom theme code

if (document.getElementsByClassName('clean-gallery').length > 0) {
    baguetteBox.run('.clean-gallery', { animation: 'slideIn' });
}

if (document.getElementsByClassName('clean-product').length > 0) {
    window.onload = function () {
        vanillaZoom.init('#product-preview');
    };
}

$(function () {
    $('.js-example-basic-single').select2();
    $('#newsletter').ajaxForm({
        beforeSubmit: function () {
            $.LoadingOverlay("show");
        },
        success: function (resp) {
            $.LoadingOverlay("hide");
            Swal.fire(
                'Excelente!',
                'O seu endereço de email foi registado!',
                'success'
            )
        },
        error: function (err) {
            $.LoadingOverlay("hide");
            Swal.fire(
                'Erro de validação!',
                err.responseJSON.message,
                'error'
            )
        }
    });
    $('#tvde').on('change', function () {
        if (this.checked) {
            $('#tvde_card').removeClass('d-none');
        } else {
            $('#tvde_card').addClass('d-none');
        }
    });
    $('#courier').on('change', function () {
        if (this.checked) {
            $('#account').removeClass('d-none');
        } else {
            $('#account').addClass('d-none');
        }
    });
    $('#carRentalContact').ajaxForm({
        beforeSubmit: () => {
            $.LoadingOverlay('show');
        },
        success: (resp) => {
            $.LoadingOverlay('hide');
            Swal.fire(
                'Sucesso!',
                'Vamos entrar em contacto rápidamente!',
                'success'
            ).then(() => {
                location.reload();
            });
        },
        error: (err) => {
            $.LoadingOverlay('hide');
            let html = '';
            var errors = err.responseJSON.errors;
            $.each(errors, (i, v) => {
                v.forEach(element => {
                    html += '<p>' + element + '</p>';
                });
            });
            Swal.fire(
                'Erro de validação!',
                html,
                'error'
            )
        }
    });

    $('#ownCarContact').ajaxForm({
        beforeSubmit: () => {
            $.LoadingOverlay('show');
        },
        success: (resp) => {
            $.LoadingOverlay('hide');
            Swal.fire(
                'Sucesso!',
                'Vamos entrar em contacto rápidamente!',
                'success'
            ).then(() => {
                location.reload();
            });
        },
        error: (err) => {
            $.LoadingOverlay('hide');
            let html = '';
            var errors = err.responseJSON.errors;
            $.each(errors, (i, v) => {
                v.forEach(element => {
                    html += '<p>' + element + '</p>';
                });
            });
            Swal.fire(
                'Erro de validação!',
                html,
                'error'
            )
        }
    });

    $('#courierContact').ajaxForm({
        beforeSubmit: () => {
            $.LoadingOverlay('show');
        },
        success: (resp) => {
            $.LoadingOverlay('hide');
            Swal.fire(
                'Sucesso!',
                'Vamos entrar em contacto rápidamente!',
                'success'
            ).then(() => {
                location.reload();
            });
        },
        error: (err) => {
            $.LoadingOverlay('hide');
            let html = '';
            var errors = err.responseJSON.errors;
            $.each(errors, (i, v) => {
                v.forEach(element => {
                    html += '<p>' + element + '</p>';
                });
            });
            Swal.fire(
                'Erro de validação!',
                html,
                'error'
            )
        }
    });
    $('#trainingContact').ajaxForm({
        beforeSubmit: () => {
            $.LoadingOverlay('show');
        },
        success: (resp) => {
            $.LoadingOverlay('hide');
            Swal.fire(
                'Sucesso!',
                'Vamos entrar em contacto rápidamente!',
                'success'
            ).then(() => {
                location.reload();
            });
        },
        error: (err) => {
            $.LoadingOverlay('hide');
            let html = '';
            var errors = err.responseJSON.errors;
            $.each(errors, (i, v) => {
                v.forEach(element => {
                    html += '<p>' + element + '</p>';
                });
            });
            Swal.fire(
                'Erro de validação!',
                html,
                'error'
            )
        }
    });
    $('#pageContact').ajaxForm({
        beforeSubmit: () => {
            $.LoadingOverlay('show');
        },
        success: (resp) => {
            $.LoadingOverlay('hide');
            Swal.fire(
                'Sucesso!',
                'Vamos entrar em contacto rápidamente!',
                'success'
            ).then(() => {
                location.reload();
            });
        },
        error: (err) => {
            $.LoadingOverlay('hide');
            let html = '';
            var errors = err.responseJSON.errors;
            $.each(errors, (i, v) => {
                v.forEach(element => {
                    html += '<p>' + element + '</p>';
                });
            });
            Swal.fire(
                'Erro de validação!',
                html,
                'error'
            )
        }
    });
    $('#consultingContact').ajaxForm({
        beforeSubmit: () => {
            $.LoadingOverlay('show');
        },
        success: (resp) => {
            $.LoadingOverlay('hide');
            Swal.fire(
                'Sucesso!',
                'Vamos entrar em contacto rápidamente!',
                'success'
            ).then(() => {
                location.reload();
            });
        },
        error: (err) => {
            $.LoadingOverlay('hide');
            let html = '';
            var errors = err.responseJSON.errors;
            $.each(errors, (i, v) => {
                v.forEach(element => {
                    html += '<p>' + element + '</p>';
                });
            });
            Swal.fire(
                'Erro de validação!',
                html,
                'error'
            )
        }
    });
    $('#transferTourContact').ajaxForm({
        beforeSubmit: () => {
            $.LoadingOverlay('show');
        },
        success: (resp) => {
            $.LoadingOverlay('hide');
            Swal.fire(
                'Sucesso!',
                'Vamos entrar em contacto rápidamente!',
                'success'
            ).then(() => {
                location.reload();
            });
        },
        error: (err) => {
            $.LoadingOverlay('hide');
            let html = '';
            var errors = err.responseJSON.errors;
            $.each(errors, (i, v) => {
                v.forEach(element => {
                    html += '<p>' + element + '</p>';
                });
            });
            Swal.fire(
                'Erro de validação!',
                html,
                'error'
            )
        }
    });

    $('#standCarContact').ajaxForm({
        beforeSubmit: () => {
            $.LoadingOverlay('show');
        },
        success: (resp) => {
            $.LoadingOverlay('hide');
            Swal.fire(
                'Sucesso!',
                'Vamos entrar em contacto rápidamente!',
                'success'
            ).then(() => {
                location.reload();
            });
        },
        error: (err) => {
            $.LoadingOverlay('hide');
            let html = '';
            var errors = err.responseJSON.errors;
            $.each(errors, (i, v) => {
                v.forEach(element => {
                    html += '<p>' + element + '</p>';
                });
            });
            Swal.fire(
                'Erro de validação!',
                html,
                'error'
            )
        }
    });
});

openCarModal = function (car_id) {
    $.get('/ajax/car/' + car_id).then((resp) => {
        $('#car_id').val(resp.id);
        $('#car_title').text(resp.title);
        $('#car_subtitle').text(resp.subtitle);
        $('#carModal').modal('show');
    });
}

openOwnCarModal = function () {
    $('#ownCarModal').modal('show');
}

openCourierModal = function () {
    $('#courierModal').modal('show');
}

openTrainingModal = function () {
    $('#trainingModal').modal('show');
}

openPageModal = function () {
    $('#pageModal').modal('show');
}

openConsultingModal = function () {
    $('#consultingModal').modal('show');
}

openTransferTourModal = function () {
    $('#transferTourModal').modal('show');
}

$(function () {
    if ($('#standProduct').length > 0) {
        setTimeout(() => {
            $.get('/ajax/standCars').then((resp) => {
                $('#standProduct').html(resp);
            });
        }, 500);
    };
    $('.dropdown').hover(function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(200);
    }, function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(200);
    });

});

goStandCar = function (id) {
    window.location.href = '/tvde/stand/' + id;
}

openstandCarModal = function () {
    $('#standCarModal').modal('show');
}