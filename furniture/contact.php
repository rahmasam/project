<?php
session_start();
include "includes/mysqli_connect.php";
include "includes/source.php";
include "includes/header.php";
?>
    <section>
        <div class="container py-85 py-tn-50" style="margin-top: 100px">
            <div class="port-title">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 text-center">
                            <h2 class="title">Contact us</h2>
                            <p class="title-detail">If you need product advice or have contributions to us.
                                 Please contact us by filling in the information below. Thank you!</p>
                            <div class="title-border mx-auto m-b-55 m-b-tn-35"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="port-body">
                <div class="contact-form">
                    <div class="messages" id="status"></div>
                    <form id="contact-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group au-form">
                                    <div class="help-block with-errors"></div>
                                    <input type="text" id="name" name="name" placeholder="Enter your name" required="" data-error="Name is required.">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group au-form">
                                    <div class="help-block with-errors"></div>
                                    <input type="email" id="email" name="email" placeholder="Enter your email"  required="" data-error="Please, enter a valid email.">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group au-form">
                                    <div class="help-block with-errors"></div>
                                    <input type="text" id="address" name="address" placeholder="Enter your address"  required="" data-error="Address is required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group au-form">
                                    <div class="help-block with-errors"></div>
                                    <input type="text" id="phone" name="phone" placeholder="Enter your phone" required="" data-error="Phone is required">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group au-form">
                                    <div class="help-block with-errors"></div>
                                    <textarea rows="9"  placeholder="Enter your message" id="msg" name="msg" required="" data-error="Please, leave us a message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group au-form">
                                    <button type="submit" id="contactBtn" class="mx-auto">To send</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php
include "includes/footer.php";

?>