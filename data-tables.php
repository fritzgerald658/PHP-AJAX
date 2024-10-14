<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data</title>
    <link rel="icon" href="assets/edit.svg">
    <link rel="stylesheet" href="styles/data-tables.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="ajax.js"></script>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
</style>

<!-- <script>
    $(document).ready(function() {
        $(".add-user").click(function() {
            $(".forms-container").fadeIn();
        });
        $("#hide-modal").click(function() {
            $(".forms-container").hide();
        })
    });

    $(document).ready(function() {
        $("#btn-show").click(function() {
            $(".forms-container").hide();
            $.ajax({
                url: "include/test.include.php",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    let output = "";
                    response.forEach(function(user) {
                        output += "<tr>";
                        output += "<td>" + user.id + "</td>";
                        output += "<td>" + user.first_name + "</td>";
                        output += "<td>" + user.last_name + "</td>";
                        output += "<td>" + user.email_address + "</td>";
                        output += "<td>" + user.home_address + "</td>";
                        output += "<td>" + user.age + "</td>";
                        output += "<td>" + user.gender + "</td>";
                        output += "<td>" +
                            "<a href='update.php?id=" + user.id + "'><img style='width: 12%; height:auto;' src='assets/edit.svg' alt='Update'></a>" +
                            "<a href='delete.include.php?id=" + user.id + "'><img style='width: 12%; height:auto;' src='assets/delete.svg' alt='Delete'></a>" +
                            "</td>";
                        output += "<tr>";
                    });
                    output += "</ul>";
                    $("#user-data").html(output);
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                    $("#user-data").html("<p>Error</p>");
                }
            })
        });
        $("#user-form").on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Collect form data
            const formData = {
                first_name: $("#first-name").val(),
                last_name: $("#last-name").val(),
                email_address: $("#email-address").val(),
                home_address: $("#home-address").val(),
                age: $("#age").val(),
                gender: $("input[name='gender']:checked").val() // Ensuring one radio button is selected
            };

            // Log formData to verify
            console.log(formData);


            // AJAX request
            $.ajax({
                type: 'POST',
                url: 'include/add.include.php', // Correct path to your PHP script
                data: formData,
                success: function(response) {
                    console.log("Response from server: " + response); // Log the response to check if it's coming back
                    if (response.indexOf("successfully") !== -1) {
                        // If the response contains 'successfully' (or any other success indicator)
                        alert("User added successfully!");
                        $('#user-form')[0].reset(); // Optionally reset the form
                        $(".forms-container").hide();
                    } else {
                        // Handle error messages returned from the server
                        $('#response').html('<p>' + response + '</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error: ", error); // Log the error to the console for debugging
                    $('#response').html('<p>An error occurred: ' + error + '</p>');
                }
            });
        });
    });
</script> -->
<!-- execute ajax code -->
<script>
    handleUserOperations();
    updateUserData();
</script>

<body>
    <!-- this is the registration form -->
    <section class="forms-container py-5">
        <?php
        if (!empty($error_msg)) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                $error_msg
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
        ?>
        <header class="d-flex justify-content-center">
            <h2>Registration</h2>
        </header>
        <form id="user-form" method="post">
            <div class="row">
                <div class="col-6">
                    <div class="content">
                        <label for="first_name">First Name</label>
                        <input id="first-name" name="first_name" class="px-3 py-1" type="text" placeholder="e.g Juan">
                    </div>
                    <div class="content">
                        <label for="email_address">Email Address</label>
                        <input id="email-address" name="email_address" class="px-3 py-1" type="email" placeholder="example@gmail.com">
                    </div>
                    <div class="content">
                        <label for="home_address">Address</label>
                        <input id="home-address" name="home_address" class="px-3 py-1" type="text" placeholder="e.g Zambales">
                    </div>
                </div>
                <div class="col-6">
                    <div class="content">
                        <label for="last_name">Last Name</label>
                        <input id="last-name" name="last_name" class="px-3 py-1" type="text" placeholder="e.g Cruz">
                    </div>
                    <div class="content">
                        <label for="age">Age</label>
                        <input id="age" name="age" class="px-3 py-1" type="number" min="18" placeholder="18">
                    </div>
                    <div class="radio-content">
                        <fieldset>
                            <legend class="form-label">Gender:</legend>
                            <div class="container d-flex gap-5">
                                <div class="form-check">
                                    <input type="radio" id="male" name="gender" value="Male" class="form-check-input" required>
                                    <label for="male" class="form-check-label">Male</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="female" name="gender" value="Female" class="form-check-input" required>
                                    <label for="female" class="form-check-label">Female</label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="container-fluid p-0 d-flex gap-2 flex-column justify-content-center">
                <button id="btn-submit" class="py-1 " type="submit" name="submit">Register</button>
                <a id="hide-modal" class=" text-decoration-none py-1 text-center">Cancel</a>
            </div>
        </form>
    </section>
    <!-- this is the update form -->
    <section id="update-forms-container" class="py-5">
        <?php
        if (!empty($error_msg)) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                $error_msg
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
        ?>
        <header class="d-flex justify-content-center">
            <h2>Update</h2>
        </header>
        <form id="update-form" method="post">
            <div class="row">
                <div class="col-6">
                    <input id="user-id" type="hidden">
                    <div class="content">
                        <label for="first_name">First Name</label>
                        <input id="update-first-name" name="first_name" class="px-3 py-1" type="text" placeholder="e.g Juan">
                    </div>
                    <div class="content">
                        <label for="email_address">Email Address</label>
                        <input id="update-email-address" name="email_address" class="px-3 py-1" type="email" placeholder="example@gmail.com">
                    </div>
                    <div class="content">
                        <label for="home_address">Address</label>
                        <input id="update-home-address" name="home_address" class="px-3 py-1" type="text" placeholder="e.g Zambales">
                    </div>
                </div>
                <div class="col-6">
                    <div class="content">
                        <label for="last_name">Last Name</label>
                        <input id="update-last-name" name="last_name" class="px-3 py-1" type="text" placeholder="e.g Cruz">
                    </div>
                    <div class="content">
                        <label for="age">Age</label>
                        <input id="update-age" name="age" class="px-3 py-1" type="number" placeholder="18">
                    </div>
                    <div class="radio-content">
                        <fieldset>
                            <legend class="form-label">Gender:</legend>
                            <div class="container d-flex gap-5">
                                <div class="form-check">
                                    <input type="radio" id="male" name="update-gender" value="male" class="form-check-input" required>
                                    <label for="male" class="form-check-label">Male</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="female" name="update-gender" value="female" class="form-check-input" required>
                                    <label for="female" class="form-check-label">Female</label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="container-fluid p-0 d-flex gap-2 flex-column justify-content-center">
                <button class="py-1" id="btn-submit" name="submit" type="submit">Update</button>
                <a href="index.php" class="text-decoration-none py-1 text-center">Cancel</a>
            </div>
        </form>

    </section>

    <section>
        <div class="container d-flex justify-content-end gap-3">
            <button id="btn-show">Show Data</button>
            <button href="#" class="text-right add-user text-decoration-none p-3 py-1 bg-black text-white"><i class="fa-solid fa-plus p-2"></i>Add new user</button>
            <a href="dashboard.php" class="logout-user  p-4 py-2 text-center text-decoration-none d-flex align-items-center ">Logout</a>
        </div>

        <table class='table mt-5'>
            <thead>
                <tr>
                    <th scope='col'>ID</th>
                    <th scope='col'>First Name</th>
                    <th scope='col'>Last Name</th>
                    <th scope='col'>Email</th>
                    <th scope='col'>Address</th>
                    <th scope='col'>Age</th>
                    <th scope='col'>Gender</th>
                    <th scope='col'></th>
                </tr>
            </thead>
            <tbody id="user-data">
            </tbody>
        </table>



    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php



?>