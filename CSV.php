<?php
/*
 * File for importing, exporting, and displaying CSV and database
 * Code from https://www.codexworld.com/import-export-csv-file-data-using-php-mysql/
 * and modified to fit project needs
 */


include ('php/config.php');


$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>

<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
    <div class="col-xs-12">
        <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
    </div>
<?php } ?>

<div class="row">
    <!-- Import & Export link -->
    <div class="col-md-12 head">
        <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
            <a href="php/exportCSV.php" class="btn btn-primary"><i class="exp"></i> Export</a>
        </div>
    </div>
    <!-- CSV file upload form -->
    <div class="col-md-12" id="importFrm" style="display: none;">
        <form action="php/importCSV.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
        </form>
    </div>

    <!-- Data list table -->
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Street</th>
            <th>City</th>
            <th>County</th>
            <th>State</th>
            <th>Country</th>
            <th>Postal Code</th>            
            <th>Fire ID</th>
            <th>Distance</th>

        </tr>
        </thead>
        <tbody>
        <?php
        // Get member rows
        $sql = "SELECT * FROM service_members join affected on (service_members.ID = affected.user_id)";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['street']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['county']; ?></td>
                    <td><?php echo $row['state']; ?></td>
                    <td><?php echo $row['country']; ?></td>
                    <td><?php echo $row['postalcode']; ?></td>
                    <td><?php echo $row['fire_id']; ?></td>
                    <td><?php echo $row['distance']; ?></td>

                </tr>
            <?php } }else{ ?>
            <tr><td colspan="5">No member(s) found...</td></tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<!-- Show/hide CSV upload form -->
<script>
    function formToggle(ID){
        var element = document.getElementById(ID);
        if(element.style.display === "none"){
            element.style.display = "block";
        }else{
            element.style.display = "none";
        }
    }
</script>