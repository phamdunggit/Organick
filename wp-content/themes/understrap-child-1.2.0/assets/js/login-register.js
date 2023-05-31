jQuery(document).ready(function () {
  $("#login").validate({
    onfocusout: false,
    onkeyup: false,
    onclick: false,
    rules: {
      username: {
        validateUsername_email:true,
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
    "Password should be at least 8 characters long and containing upper and lower case letters, numbers."
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
  // $.validator.addMethod(
  //   "validateUser",
  //   function (value, element) {
  //     return (
  //       this.optional(element) ||
  //       /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/i.test(value)
  //     );
  //   },
  //   "Password should be at least 8 characters long and containing upper and lower case letters, numbers."
  // );
});
