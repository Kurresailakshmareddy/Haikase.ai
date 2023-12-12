<?php
include("includes/header.php");

echo '<div class="feedback-text">
        <p>Haikase.AI Membership Expression of Interest Form</p>
      </div>';
?>

<section>
    <div class="feedback_main">
        <div class="contact_form">
            <p>Being a Haikase.AI member grants you first priority in staying informed about existing and future opportunities, collaborations, and emerging AI markets. It is important to note that membership does not entail ownership of shares in Haikase.AI, and there are no associated business or financial obligations. Instead, it is a means to cultivate a community of like-minded individuals, fostering information sharing, collaborative efforts, and access to future markets.</p>
        </div>
    </div>
</section>

<section>
    <div class="feedback_main">
        <!-- <div class="heading-text">
            <p></p>
        </div> -->
        <p class="heading">If you are intrigued by this idea, kindly complete the Expression of Interest Membership Form below:</p>
        <div class="row">

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?> <!--showing the status to the user -->

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <div class="contact_form">
                <form action="feedback-check.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fname">Full Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Please enter your full name here.." required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Please enter your email here.." required>
                    </div>
                    <div class="form-group">
                        <label for="occpu">Your Job</label>
                        <input type="text" class="form-control" id="occpu" name="occpu" placeholder="Please enter your occupation here.." required>
                    </div>
                    <div class="form-group">
                        <label for="role">Your Job Title</label>
                        <input type="text" class="form-control" id="role" name="role" placeholder="Please enter your job title.." required>
                    </div>
                    <div class="form-group">
                        <label for="website">Your Business Website</label>
                        <input type="text" class="form-control" id="website" name="website" placeholder="Please enter your website here.." required>
                    </div>
                    <div class="form-group">
                        <label for="tel">Telephone Number</label>
                        <input type="tel" class="form-control" id="tel" name="tel" placeholder="Please enter your Number.." required>
                    </div>
                    <div class="form-group">
                        <label for="subject">What prompted your interest in joining us? (only 100 words)</label>
                        <textarea id="subject" name="messages" placeholder="Please Type Here.." class="form-control" style="height:100px" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>May we contact you when we identify an opportunity suitable for your business?</label>
                        <input type="radio" id="contact_yes" name="contact" value="yes" required> Yes
                        <input type="radio" id="contact_no" name="contact" value="no" required> No
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