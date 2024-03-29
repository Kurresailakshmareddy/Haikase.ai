<?php
include("../includes/admin/header.php");

echo '<div class="about-text">
        <p>MemberShip View</p>
        </div>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the record ID to be deleted
    $record_id = mysqli_real_escape_string($conn, $_POST['record_id']);

    // Delete the record from the database
    $sql = "DELETE FROM gethelp WHERE id = '$record_id'";

    if ($conn->query($sql) !== TRUE) {
        echo "Error deleting record: " . $conn->error;
    }
    header("Location: ./gethelp_view.php?success=Form deleted successfully");
    exit();
}
?>

<?php if (isset($_GET['error'])) { ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
<?php } ?> <!--showing the status to the user -->

<?php if (isset($_GET['success'])) { ?>
    <p class="success"><?php echo $_GET['success']; ?></p>
<?php } ?>

<section class="page_nav">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li>
                        <a href="./content_view.php">Home</a>
                    </li>
                    <li>
                        <a href="./feedback_view.php">MemberShip Form</a>
                    </li>
                    <!-- <li>
                        <a href="#">add content</a>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
</section>



<table class="form_view">
    <tr>
        <th>Full Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Delete</th>
    </tr>
    <?php
    // Fetch and display existing records
    $result = $conn->query("SELECT * FROM gethelp");
    if ($result->num_rows > 0) {
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['full_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['message'] . "</td>";

            echo "<td><form method='post' action=''>
        <input type='hidden' name='record_id' value='" . $row['id'] . "'>
        <input type='submit' class='loginbtn' value='Delete'></form></td>";
            echo "</tr>";
            $i++;
        }
    } else {
        echo "<tr><td colspan='10'>No results</td></tr>";
    }

    ?>
</table>


<?php
include("../includes/admin/footer.php");
?>