<?php
include 'config.php';

//fetch the complaint
if (isset($_POST['displaySend'])) {
    $sql = "SELECT * FROM complaint JOIN product_brand ON product_brand.id = complaint.brand_id";
    $result = mysqli_query($con, $sql);

    $data = array();
    $count = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array(
            'id' => $count,
            'cname' => $row['customer_name'],
            'phone' => $row['phone'],
            'product' => $row['product'],
            'sno' => $row['serial_no'],
            'mno' => $row['model_no'],
            'b_name' => $row['b_name'],
            'tname' => $row['technician_name'],
            'action' => '<button type="button" class="btn btn-sm btn-success btn-sm rounded-circle" onclick="Getdetails(' . $row['id'] . ')"><i class="fa-solid fa-pen-to-square"></i></button>
                   <button type="button" class="btn btn-sm btn-danger btn-sm rounded-circle" onclick="deleteComplaint(' . $row['id'] . ')"><i class="fa-solid fa-trash"></i></button>',
        );
        $count++;
    }
    $json_data = json_encode($data);

    // Print the JSON data to be used by the DataTables library
    echo "<script>$(document).ready( function () {
          $('#complaints-table').DataTable({
            'data': " . $json_data . ",
            'columns': [
              {'data': 'id'},
              {'data': 'cname'},
              {'data': 'phone'},
              {'data': 'product'},
              {'data': 'sno'},
              {'data': 'mno'},
              {'data': 'b_name'},
              {'data': 'tname'},
              {'data': 'action'}
            ]
          });
        });
        </script>";
    echo '<table id="complaints-table" class="table-striped table-bordered   " style="width:100%">
        <thead>
          <tr>
            <th>#</th>
            <th>Customer Name</th>
            <th>Phone</th>
            <th>Product</th>
            <th>Serial No</th>
            <th>Model No</th>
            <th>Product_Brand</th>
            <th>Technician</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>';
    $count++;
}



?>