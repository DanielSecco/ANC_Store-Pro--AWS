(function ($) {
    "use strict";

    var socialLogin = {};
    if ( typeof mkd !== 'undefined' ) {
        mkd.modules.socialLogin = socialLogin;
    }

    socialLogin.mkdUserLogin = mkdUserLogin;
    socialLogin.mkdUserRegister = mkdUserRegister;
    socialLogin.mkdUserLostPassword = mkdUserLostPassword;
    socialLogin.mkdInitLoginWidgetModal = mkdInitLoginWidgetModal;
    socialLogin.mkdUpdateUserProfile = mkdUpdateUserProfile;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);

    /**
     * All functions to be called on $(document).ready() should be in this function
     */
    function mkdOnDocumentReady() {
        mkdInitLoginWidgetModal();
        mkdUserLogin();
        mkdUserRegister();
        mkdUserLostPassword();
        mkdUpdateUserProfile();
    }

    /**
     * All functions to be called on $(window).load() should be in this function
     */
    function mkdOnWindowLoad() {
    }

    /**
     * All functions to be called on $(window).resize() should be in this function
     */
    function mkdOnWindowResize() {
    }

    /**
     * All functions to be called on $(window).scroll() should be in this function
     */
    function mkdOnWindowScroll() {
    }

    /**
     * Initialize login widget modal
     */
    function mkdInitLoginWidgetModal() {

        var modalOpener = $('.mkd-login-opener'),
            modalHolder = $('.mkd-login-register-holder');

        if (modalOpener) {
            var tabsHolder = $('.mkd-login-register-content');

            //Init opening login modal
            modalOpener.click(function (e) {
                e.preventDefault();
                modalHolder.fadeIn(300);
                modalHolder.addClass('opened');
            });

            //Init closing login modal
            modalHolder.click(function (e) {
                if (modalHolder.hasClass('opened')) {
                    modalHolder.fadeOut(300);
                    modalHolder.removeClass('opened');
                }
            });
            $('.mkd-login-register-content').click(function (e) {
                e.stopPropagation();
            });
            // on esc too
            $(window).on('keyup', function (e) {
                if (modalHolder.hasClass('opened') && e.keyCode == 27) {
                    modalHolder.fadeOut(300);
                    modalHolder.removeClass('opened');
                }
            });

            //Init tabs
            tabsHolder.tabs();
        }
    }

    /**
     * Login user via Ajax
     */
    function mkdUserLogin() {
        $('.mkd-login-form').on('submit', function (e) {
            e.preventDefault();
            var ajaxData = {
                action: 'mkd_membership_login_user',
                security: $(this).find('#mkd-login-security').val(),
                login_data: $(this).serialize()
            };
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: MikadoAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    mkdRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }

            });
            return false;
        });
    }

    /**
     * Register New User via Ajax
     */
    function mkdUserRegister() {

        $('.mkd-register-form').on('submit', function (e) {

            e.preventDefault();
            var ajaxData = {
                action: 'mkd_membership_register_user',
                security: $(this).find('#mkd-register-security').val(),
                register_data: $(this).serialize()
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: MikadoAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    mkdRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });

            return false;
        });
    }

    /**
     * Reset user password
     */
    function mkdUserLostPassword() {

        var lostPassForm = $('.mkd-reset-pass-form');
        lostPassForm.submit(function (e) {
            e.preventDefault();
            var data = {
                action: 'mkd_membership_user_lost_password',
                user_login: lostPassForm.find('#user_reset_password_login').val()
            };
            $.ajax({
                type: 'POST',
                data: data,
                url: MikadoAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    mkdRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        });
    }

    /**
     * Response notice for users
     * @param response
     */
    function mkdRenderAjaxResponseMessage(response) {

        var responseHolder = $('.mkd-membership-response-holder'), //response holder div
            responseTemplate = _.template($('.mkd-membership-response-template').html()); //Locate template for info window and insert data from marker options (via underscore)

        var messageClass;
        if (response.status === 'success') {
            messageClass = 'mkd-membership-message-succes';
        } else {
            messageClass = 'mkd-membership-message-error';
        }

        var templateData = {
            messageClass: messageClass,
            message: response.message
        };

        var template = responseTemplate(templateData);
        responseHolder.html(template);
    }

    /**
     * Update User Profile
     */
    function mkdUpdateUserProfile() {
        var updateForm = $('#mkd-membership-update-profile-form');
        if ( updateForm.length ) {
            var btnText = updateForm.find('button'),
                updatingBtnText = btnText.data('updating-text'),
                updatedBtnText = btnText.data('updated-text');

            updateForm.on('submit', function (e) {
                e.preventDefault();
                var prevBtnText = btnText.html();
                btnText.html(updatingBtnText);

                var ajaxData = {
                    action: 'mkd_membership_update_user_profile',
                    data: $(this).serialize()
                };

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: MikadoAjaxUrl,
                    success: function (data) {
                        var response;
                        response = JSON.parse(data);

                        // append ajax response html
                        mkdRenderAjaxResponseMessage(response);
                        if (response.status == 'success') {
                            btnText.html(updatedBtnText);
                            window.location = response.redirect;
                        } else {
                            btnText.html(prevBtnText);
                        }
                    }
                });
                return false;
            });
        }
    }

})(jQuery);