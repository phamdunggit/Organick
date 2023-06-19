jQuery(document).ready(function () {
  $("#login").validate({
    onfocusout: false,
    onkeyup: false,
    onclick: false,
    rules: {
      username: {
        validateEmail:true,
        required: true,
        minlength: 8,
        maxlength: 50,
      },
      password: {
        validatePassword: true,
        required: true,
        minlength: 8,
        maxlength: 30,
      },
    },
    messages: {
      username: {
        required: "Email address must be required.",
      },
      password: {
        required: "Password must be required.",
      },
    },
  });
  $("#register").validate({
    onfocusout: false,
    onkeyup: false,
    onclick: false,
    rules: {
      password: {
        validatePassword: true,
        required: true,
        minlength: 8,
        maxlength: 30,
      },
      email: {
        validateEmail:true,
        required: true,
        minlength: 8,
        maxlength: 256,
      },
      password2: {
        equalTo: "#reg_password",
        required: true,
        minlength: 8,
        maxlength: 30,
      }
    },
      messages: {
        password: {
          // validatePassword: "",
          required: "Password must be required.",
          // minlength: "Please enter at least 8 characters.",
          // maxlength: "Please enter no more than 30 characters.",
        },
        email: {
          email: "Please enter a valid email address.",
          required: "Email must be required.",
          // minlength: "Please enter at least 8 characters.",
          // maxlength: "Please enter no more than 256 characters.",
        },
        password2: {
          required: "Confirm password must be required.",
          equalTo: "Password & Confirm password do not match!",
          // minlength: "Please enter at least 8 characters.",
          // maxlength: "Please enter no more than 30 characters.",
        },
      },
  });
  $("#lost-password").validate({
    onfocusout: false,
    onkeyup: false,
    onclick: false,
    rules: {
      user_login: {
        validateUsername_email:true,
        required: true,
        minlength: 8,
        maxlength: 50,
      },
    },
    messages: {
      user_login: {
        required: "Email address must be required.",
      },
    },
  });
 
  $("#reset-password").validate({
    onfocusout: false,
    onkeyup: false,
    onclick: false,
    rules: {
      password_1: {
        validatePassword: true,
        required: true,
        minlength: 8,
        maxlength: 30,
      },
      password_2: {
        equalTo: "#password_1",
        required: true,
        minlength: 8,
        maxlength: 30,
      },
    },
    messages: {
      password_1: {
        required: "Password must be required.",
      },
      password_2: {
        equalTo: "New password & Re-enter new password do not match!",
        required: "Re-enter new password must be required.",
      },
    },
  });
  $.validator.addMethod(
    "validatePassword",
    function (value, element) {
      return (
        this.optional(element) ||
        /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,30}$/g.test(value)
      );
    },
    "Password should be at least 8 characters and containing upper and lower case letters, numbers."
  );
  $.validator.addMethod(
    "validateEmail",
    function (value, element) {
      return (
        this.optional(element) ||
        /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g.test(value)
      );
    },
    "Please enter valid email!"
  );
  $.validator.addMethod(
    "validateUsername_email",
    function (value, element) {
      return (
        this.optional(element) ||
        /^[a-zA-Z0-9@\-_.]+$/.test(value)
      );
    },
    "Please enter valid email or username!"
  );
  $('.input-trim').on('input', function() {
    $(this).val($(this).val().trim());
  });
  $('#show-hide-password').click(function() {
    var passwordField = $('#password');
    var passwordFieldType = passwordField.attr('type');
    if (passwordFieldType == 'password') {
      passwordField.attr('type', 'text');
      $(this).html(`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z"/></svg>`)
    } else {
      passwordField.attr('type', 'password');
      $(this).html(`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19.604 2.562l-3.346 3.137c-1.27-.428-2.686-.699-4.243-.699-7.569 0-12.015 6.551-12.015 6.551s1.928 2.951 5.146 5.138l-2.911 2.909 1.414 1.414 17.37-17.035-1.415-1.415zm-6.016 5.779c-3.288-1.453-6.681 1.908-5.265 5.206l-1.726 1.707c-1.814-1.16-3.225-2.65-4.06-3.66 1.493-1.648 4.817-4.594 9.478-4.594.927 0 1.796.119 2.61.315l-1.037 1.026zm-2.883 7.431l5.09-4.993c1.017 3.111-2.003 6.067-5.09 4.993zm13.295-4.221s-4.252 7.449-11.985 7.449c-1.379 0-2.662-.291-3.851-.737l1.614-1.583c.715.193 1.458.32 2.237.32 4.791 0 8.104-3.527 9.504-5.364-.729-.822-1.956-1.99-3.587-2.952l1.489-1.46c2.982 1.9 4.579 4.327 4.579 4.327z"/></svg>`);
    }
  });
});

