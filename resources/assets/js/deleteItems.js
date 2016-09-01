//Delete some resource with sweetalert
    (function(window, $, undefined) {

        var Laravel = {
            initialize: function() {
                this.methodLinks = $('a[data-method]');
                this.token = $('a[data-token]');
                this.registerEvents();
            },

            registerEvents: function() {
                this.methodLinks.on('click', this.handleMethod);
            },

            handleMethod: function(e) {
                e.preventDefault();

                var link = $(this);
                var httpMethod = link.data('method').toUpperCase();
                var form;

                // If the data-method attribute is not PUT or DELETE,
                // then we don't know what to do. Just ignore.
                if ($.inArray(httpMethod, ['PUT', 'DELETE']) === -1) {
                    return false;
                }

                Laravel
                        .verifyConfirm(link)
                        .done(function () {
                            form = Laravel.createForm(link);
                            form.submit();
                        })
            },

            verifyConfirm: function(link) {
                var confirm = new $.Deferred();

                swal({
                            title: "Are you sure?",
                            text: "You will not be able to recover this user!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, cancel plx!",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function(isConfirm, method) {
                            if (isConfirm) {
                                confirm.resolve(link);
                                swal(
                                        "Deleted!",
                                        "Your post has been deleted.",
                                        "success");
                            } else {
                                confirm.reject(link);
                                swal(
                                        "Cancelled",
                                        "Your post is safe :)",
                                        "error");
                            } });

                return confirm.promise()
            },

            createForm: function(link) {
                var form =
                        $('<form>', {
                            'method': 'POST',
                            'action': link.attr('href')
                        });

                var token =
                        $('<input>', {
                            'type': 'hidden',
                            'name': '_token',
                            'value': link.data('token')
                        });

                var hiddenInput =
                        $('<input>', {
                            'name': '_method',
                            'type': 'hidden',
                            'value': link.data('method')
                        });

                return form.append(token, hiddenInput)
                        .appendTo('body');
            }
        };

        Laravel.initialize();

    })(window, jQuery);
