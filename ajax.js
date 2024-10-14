function handleUserOperations() {
  $(document).ready(function () {
    // Show and hide form
    $(".add-user").click(function () {
      $(".forms-container").fadeIn();
    });
    $("#hide-modal").click(function () {
      $(".forms-container").hide();
    });

    // Fetch and display user data
    $("#btn-show").click(function () {
      $(".forms-container").hide();
      $.ajax({
        url: "include/test.include.php",
        type: "GET",
        dataType: "json",
        success: function (response) {
          let output = "";
          response.forEach(function (user) {
            output += "<tr>";
            output += "<td>" + user.id + "</td>";
            output += "<td>" + user.first_name + "</td>";
            output += "<td>" + user.last_name + "</td>";
            output += "<td>" + user.email_address + "</td>";
            output += "<td>" + user.home_address + "</td>";
            output += "<td>" + user.age + "</td>";
            output += "<td>" + user.gender + "</td>";
            output +=
              "<td>" +
              "<button class='update-btn' data-id='" +
              user.id +
              "' style='background: none; border: none; padding: 0;'>" +
              "<img style='width: 40%; height:auto;' src='assets/edit.svg' alt='Edit'>" +
              "</button>" +
              "<button class='delete-btn' data-id='" +
              user.id +
              "' style='background: none; border: none; padding: 0;'>" +
              "<img style='width: 40%; height:auto;' src='assets/delete.svg' alt='Delete'>" +
              "</button>" +
              "</td>";

            output += "</tr>";
          });
          $("#user-data").html(output);
        },
        error: function (xhr, status, error) {
          console.log("Error: " + error);
          $("#user-data").html("<p>Error</p>");
        },
      });
    });

    // Handle user registration
    $("#user-form").on("submit", function (e) {
      e.preventDefault(); // Prevent the default form submission

      // Collect form data
      const formData = {
        first_name: $("#first-name").val(),
        last_name: $("#last-name").val(),
        email_address: $("#email-address").val(),
        home_address: $("#home-address").val(),
        age: $("#age").val(),
        gender: $("input[name='gender']:checked").val(), // Ensuring one radio button is selected
      };

      // Log formData to verify
      console.log(formData);

      // AJAX request for adding user
      $.ajax({
        type: "POST",
        url: "include/add.include.php", // Correct path to your PHP script
        data: formData,
        success: function (response) {
          console.log("Response from server: " + response); // Log the response to check if it's coming back
          if (response.indexOf("successfully") !== -1) {
            alert("User added successfully!");
            $("#user-form")[0].reset(); // Optionally reset the form
            $(".forms-container").hide();
            $("#btn-show").trigger("click"); // Refresh the user list after adding
          } else {
            // Handle error messages returned from the server
            $("#response").html("<p>" + response + "</p>");
          }
        },
        error: function (xhr, status, error) {
          console.log("Error: ", error); // Log the error to the console for debugging
          $("#response").html("<p>An error occurred: " + error + "</p>");
        },
      });
    });

    // Handle delete user
    $(document).on("click", ".delete-btn", function () {
      const userId = $(this).data("id");
      if (confirm("Are you sure you want to delete this user?")) {
        $.ajax({
          type: "GET", // or 'POST' depending on your server setup
          url: "include/delete.include.php", // Your delete PHP script
          data: { id: userId },
          success: function (response) {
            alert("User has been deleted"); // Alert the response message
            $("#btn-show").trigger("click"); // Refresh the user list after deletion
          },
          error: function (xhr, status, error) {
            console.error("Error: ", error); // Log error for debugging
            alert("An error occurred while deleting the user.");
          },
        });
      }
    });

    $(document).on("click", ".update-btn", function () {
      const userId = $(this).data("id"); // Get user ID from the button's data-id attribute
      updateUserData(userId); // Pass userId to the function
    });
  });
}

// Call the function to set everything up
function updateUserData(userId) {
  $("#update-forms-container").fadeIn(); // Show the update form

  // Set the user ID in the form's hidden input field
  $("#user-id").val(userId);

  // Handle the form submission
  $("#update-form")
    .off("submit")
    .on("submit", function (e) {
      // Use .off() to prevent multiple bindings
      e.preventDefault(); // Prevent the default form submission

      // Collect form data, including the user ID
      const formData = {
        id: $("#user-id").val(), // Get user ID from the hidden input
        first_name: $("#update-first-name").val(),
        last_name: $("#update-last-name").val(),
        email_address: $("#update-email-address").val(),
        home_address: $("#update-home-address").val(),
        age: $("#update-age").val(),
        gender: $("input[name='update-gender']:checked").val(), // Get the checked radio button value
      };

      // Log formData to verify it's being set correctly
      console.log("Form Data: ", formData);

      // AJAX request for updating user data
      $.ajax({
        url: "include/update.include.php", // Update with your PHP script to handle updates
        type: "POST", // Use POST for updating data
        data: formData, // Send form data directly
        success: function (response) {
          console.log("Response from server: ", response);
          // Check if the response contains a success message
          if (response.indexOf("successfully") !== -1) {
            alert("User updated successfully!");
            $("#update-forms-container").fadeOut(); // Optionally hide the form
            $("#update-forms-container")[0].reset(); // Optionally hide the form

            // Optionally refresh or update the user list here
            $("#btn-show").trigger("click"); // Refresh the user list after updating
          } else {
            alert("Error updating user: " + response);
          }
        },
        error: function (xhr, status, error) {
          console.log("Error occurred:", error);
          alert("An error occurred: " + error);
        },
      });
    });
}
