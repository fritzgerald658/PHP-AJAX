<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<script>
    // $(document).ready(function() {
    //     $("#fetch-user").click(function() {

    //         $.ajax({
    //             url: "https://jsonplaceholder.typicode.com/users/1",
    //             type: "GET",
    //             dataType: "json",
    //             success: function(data) {
    //                 $("#result").html(
    //                     "<h3>User Information</h3>" +
    //                     "<p>Name:" + data.name + "</p>" +
    //                     "<p>Name:" + data.email + "</p>" +
    //                     "<p>Name:" + data.phone + "</p>"
    //                 );
    //             },
    //             error: function() {
    //                 $("#result").html("<h2>error</h2>")
    //             }
    //         });
    //     });
    //     $("#btn").click(function() {
    //         $.get("test.txt", function(data) {
    //             $("#result").html(data);
    //         });
    //     }); 
    // });

    $(document).ready(function() {
        $("#btn").click(function() {
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
    });
</script>

<body>
    <button id="btn">
        Click Me
    </button>
    <button id="fetch-user">
        Click Me
    </button>
    <div id="result"></div>

    <div>
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
                <!-- User data will be injected here -->
            </tbody>
        </table>
    </div>

</body>

</html>