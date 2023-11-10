<?php
include 'config.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- sweet alert CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

</head>

<body>
    <h1 class="text-center text-primary"> Comaplaint </h1>
    <form id="complain-data">
        <label for="">Customer Name</label>
        <input type="text" id="cname" name="cname" placeholder="Enter the Customer Name" required><br><br>
        <label for="">Phone</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter the Phone No" required><br><br>
        <label for="">Product</label>
        <input type="text" id="product" name="product" placeholder="Enter Product" required><br><br>
        <label for="">Serial No</label>
        <input type="text" id="sno" name="sno" placeholder="Enter the Serial No" required><br><br>
        <label for="">Model No</label>
        <input type="text" id="mno" name="mno" placeholder="Enter the Model No" required><br><br>

        <?php
$sql = "SELECT * FROM product_brand";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    ?>
        <select name="b_name" id="b_name">
            <option value="">.......Select Brand......</option>
            <?php
while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $type_name = $row["b_name"];
        
        echo '<option value="' . $id . '">' . $type_name . '</option>';
    }
}
?>
        </select> <br><br>
        <label for="">Technician </label>
        <input type="text" id="tname" name="tname" placeholder="Enter the Technician Name" required><br><br>
        <label for="">Warrenty Date From</label>
        <input type="date" id="w_date_from" name="w_date_from" placeholder="Enter the From Warrenty Date"
            required><br><br>
        <label for="user_type">Warrenty date To</label>
        <input type="date" id="w_date_to" name="w_date_to" placeholder="Enter the To Warrenty Date"><br><br>
        <label for="user_type">Address </label>
        <input type="text" id="address" name="address" placeholder="Enter the Address"><br><br>
        <label for="user_type">Complaint</label>
        <textarea id="complaint" name="complaint"></textarea><br><br>
        <button class="btn btn-primary">Register </button>
    </form>
    <br><br><br>

    <div class="padding-right">
        <a class="btn btn-primary" href="view_data.php">View</a>
    </div>
    <br><br>
    <!-- fetch complaint-->
    <div id="displayDataTable" class="table table-responsive"></div>


    <!--update model form start-->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Complaint update</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Form -->
                <input type="hidden" class="form-control" id="id">
                <div class=" form-group mb-3 mx-3 ">
                    <label for="Name" class="form-label">Customer Name</label>
                    <input type="text" name="cus_name" class="form-control bname" id="cus_name">
                </div>




                <div class="form-group mb-3 mx-3">
                    <label for="Course" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="cus_phone">
                </div>

                <div class="form-group mb-3 mx-3">
                    <label for="Course" class="form-label">Product</label>
                    <input type="text" name="product" class="form-control" id="product">
                </div>
                <div class="form-group mb-3 mx-3">
                    <label for="Course" class="form-label">Serial No</label>
                    <input type="text" name="ser_no" class="form-control" id="ser_no">
                </div>
                <div class="form-group mb-3 mx-3">
                    <label for="Course" class="form-label">Model No</label>
                    <input type="text" name="mod_no" class="form-control" id="mod_no">
                </div>
                <div class="form-group mb-3 mx-3">
                    <label for="Course" class="form-label">Technician</label>
                    <input type="text" name="tec_name" class="form-control" id="tec_name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark" onclick="updateDetails()">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!--update model form end-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <!-- sweet alert JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
    //Complaint registration
    $(document).ready(function() {

        $("#complain-data").submit(function(e) {
            e.preventDefault();

            // Get data from the form
            var cname = $("#cname").val();
            var phone = $("#phone").val();
            var product = $("#product").val();
            var sno = $("#sno").val();
            var mno = $("#mno").val();
            var b_name = $("#b_name").val();
            var tname = $("#tname").val();
            var w_date_from = $("#w_date_from").val();
            var w_date_to = $("#w_date_to").val();
            var address = $("#address").val();
            var complaint = $('#complaint').val();
            console.log(complaint);

            $.ajax({
                type: "POST",
                url: "complaint_function.php",
                data: {
                    cname: cname,
                    phone: phone,
                    product: product,
                    sno: sno,
                    mno: mno,
                    b_name: b_name,
                    tname: tname,
                    w_date_from: w_date_from,
                    w_date_to: w_date_to,
                    address: address,
                    complaint: complaint
                },
                success: function(response) {
                    // Display a SweetAlert message
                    Swal.fire({
                        title: 'Complaint Successful!',
                        text: 'Your Complaint is registered.',
                        icon: 'success',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 1500
                    });


                    $("#complain-data")[0].reset();
                    displayData();

                }
            });
        });
    });


    //fetch complaint

    $(document).ready(function() {
        displayData();
    })

    function displayData() {
        var displayData = 'true';
        $.ajax({
            url: 'fetch_complaint.php',
            type: 'post',
            data: {
                displaySend: displayData,
            },
            success: function(data, status) {
                $('#displayDataTable').html(data);

            }
        });
    }
    </script>
    <script>
    // Update js
    function Getdetails(id) {
        $('#id').val(id);
        $.post("complaint_update.php", {
            id: id
        }, function(data, status) {
            var complaint = JSON.parse(data);
            $('#cus_name').val(complaint.customer_name);
            $('#cus_phone').val(complaint.phone);
            $('#product').val(complaint.product);
            $('#ser_no').val(complaint.serial_no);
            $('#mod_no').val(complaint.model_no);
            $('#tec_name').val(complaint.technician_name);
            console.log(data);
        });
        $('#updateModal').modal('show');
    }

    function updateDetails() {
        var form_data = new FormData();
        var id = $('#id').val();
        var cname = $('#cus_name').val();
        var phone = $('#cus_phone').val();
        var product = $('#product').val();
        var sno = $('#ser_no').val();
        var mno = $('#mod_no').val();
        var tname = $('#tec_name').val();

        form_data.append("id", id);
        form_data.append("cus_name", cname);
        form_data.append("cus_phone", phone);
        form_data.append("product", product);
        form_data.append("ser_no", sno);
        form_data.append("mod_no", mno);
        form_data.append("tec_name", tname);

        $.ajax({
            url: "complaint_update.php",
            method: "POST",
            data: form_data,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#updateModal').modal('hide');
                alertify.set('notifier', 'position', 'top-center');
                alertify.success(data);
                // Optionally, you can reload or update your data display here
            }
        });
    }
    </script>


    <script>
    function deleteComplaint(deleteid) {
        if (confirm('Are you sure to delete this record?')) {
            $.ajax({
                url: "complaint_delete_function.php",
                type: "post",
                data: {
                    deletesend: deleteid
                },
                success: function(data, status) {
                    alertify.set('notifier', 'position', 'top-center');
                    alertify.success(data);
                    displayData(); // Assuming this function updates your page
                }
            })
        }
    }
    </script>

</body>

</html>