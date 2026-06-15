jQuery('.my-form-modal').validate({
    submitHandler: function (form) {
        $('.splash-ajax').show();
        jQuery(form).ajaxSubmit({
            success: function (response_array, statusText, xhr, jQueryform) {
                if (response_array.status == 'success') {
                    $('.splash-ajax').hide();
                    iziToast.success({
                        title: 'Success',
                        // rtl: true,
                        position: 'bottomCenter',
                        message: response_array.message
                    });
                } else {
                    $('.splash-ajax').hide();
                    iziToast.error({
                        title: 'Error',
                        // rtl: true,
                        position: 'bottomCenter',
                        message: response_array.message
                    });
                }
            }
        });
        return false;
    }
});
jQuery('.my-form-home').validate({
    submitHandler: function (form) {
        $('.splash-ajax').show();
        jQuery(form).ajaxSubmit({
            success: function (response_array, statusText, xhr, jQueryform) {
                if (response_array.status == 'success') {
                    $('.splash-ajax').hide();
                    iziToast.success({
                        title: 'Success',
                        // rtl: true,
                        position: 'bottomCenter',
                        message: response_array.message
                    });
                } else {
                    $('.splash-ajax').hide();
                    iziToast.error({
                        title: 'Error',
                        // rtl: true,
                        position: 'bottomCenter',
                        message: response_array.message
                    });
                }
            }
        });
        return false;
    }
});
jQuery('.my-form-contact').validate({
    submitHandler: function (form) {
        $('.splash-ajax').show();
        jQuery(form).ajaxSubmit({
            success: function (response_array, statusText, xhr, jQueryform) {
                if (response_array.status == 'success') {
                    $('.splash-ajax').hide();
                    iziToast.success({
                        title: 'Success',
                        // rtl: true,
                        position: 'bottomCenter',
                        message: response_array.message
                    });
                } else {
                    $('.splash-ajax').hide();
                    iziToast.error({
                        title: 'Error',
                        // rtl: true,
                        position: 'bottomCenter',
                        message: response_array.message
                    });
                }
            }
        });
        return false;
    }
});