<?php
include("includes/header.php");

echo '<div class="about-text">
        <p>GET HELP</p>
      </div>';
?>

<section>
    <div class="feedback_main">

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?> <!--showing the status to the user -->

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <div class="contact_form">
                <form action="gethelp-check.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fname">Full Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Please enter your full name here.." required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Please enter your email here.." required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Message</label>
                        <textarea id="subject" name="messages" placeholder="Please Type Here.." class="form-control" style="height:100px" required></textarea>
                    </div>

                    <input class="feedback loginbtn" type="submit" value="Submit">
                </form>
            </div>

        </div>
    </div>
</section>

<section>
    <div class="feedback_main">
        <div class="contact_form">
            <p class="alert">Note: Your information will be utilized solely for the aforementioned purposes and will not be shared with any third party unless explicit written consent is provided. Please be aware that, while we strive to protect your data, we may not be able to prevent cyber-attacks originating from various networks.</p>
        </div>
    </div>
</section>

<?php
include("includes/footer.php");
?>