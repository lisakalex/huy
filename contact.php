<?php
include(__DIR__ . '/header.php');
?>
<div id="wrap__header">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
        </div>
    </header>
</div>
<div id="wrap__page">
    <section class="content xs-pb-50 contact-container">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-xs-12">
                    <h1>Send us a message and let’s get started!</h1>
                    <div class="line-bellow d-block"></div>
                    <div class="content-bellow-line">
                        <p class="small-text gray-text text-center text-md-left">
                            Let us know if you’re ready to start working together. Send us a message using our contact
                            form and we’ll get back to you as soon as possible.
                        </p>
                        <strong>Report Abuse Tool</strong>
                        <p>
                            If you ever feel like your privacy or your rights were violated by one of our publishers or
                            advertisers, or if you have witnessed a breach of our terms and conditions, we strongly
                            encourage you to report the abuse via our Report Abuse Tool.
                        </p>
                    </div>
                    <strong>Investment market Media Kit</strong>
                    <p>
                        If you want to list us on your website, feel free to use the media kit listed below to get all
                        the materials you need.
                        <br/>
<!--                        <a href="https://docs.Investment market.com/Investment market-media-kit.zip" class="dashed"><span-->
<!--                                    class="far fa-file-archive"></span> Download the Media Kit &xrarr;</a>-->
                    </p>
                </div>
                <div class="col-md-7 col-xs-12">
                    <div class="card">
                        <div class="card-header p-0">
                            <ul class="nav nav-pills p-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="sh/index.php#contact" role="tab"
                                       aria-controls="contact" aria-selected="true">Contact Our Team</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="sh/index.php#report" role="tab"
                                       aria-controls="report" aria-selected="false">Report Abuse</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="contact" role="tabpanel">
                                    <form action="index-apache.html" data-captcha="true">
                                        <input type="hidden" name="medium" value="Direct Visitor">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contactAccountType" class="col-form-label">Account
                                                        Type</label>
                                                    <select name="accountType" id="contactAccountType"
                                                            class="form-control" required>
                                                        <option value="Advertiser" selected>I'm an Advertiser</option>
                                                        <option value="Publisher">I'm a Publisher</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="contactName" class="col-form-label">Name</label>
                                                    <input type="text" class="form-control" name="name" id="contactName"
                                                           placeholder="Your full name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="contactEmail" class="col-form-label">Email
                                                        Address</label>
                                                    <input type="email" class="form-control" name="email"
                                                           id="contactEmail" placeholder="Your email address" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contactIM" class="col-form-label">Instant
                                                        Messenger</label>
                                                    <input type="text" class="form-control" name="IM" id="contactIM"
                                                           placeholder="Skype, telegram or phone number ( optional )">
                                                </div>
                                                <div class="form-group">
                                                    <label for="contactMessage" class="col-form-label">Message</label>
                                                    <textarea name="message" id="contactMessage" cols="30" rows="6"
                                                              class="form-control"
                                                              placeholder="Write here your questions or inquiries..."
                                                              required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="g-recaptcha"
                                                     data-sitekey="6Ld9EXkUAAAAAHC3gcVn4ozcj3GcOaUEKrmse-Gx"></div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button type="submit" class="btn shine b-cnt">Submit Your Message
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="report" role="tabpanel">
                                    <form action="https://Investment market.com/report-abuse/" data-captcha="true">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="reportAbuseType" id="account_label"
                                                           class="col-form-label">Report Type</label>
                                                    <select name="abuseType" id="reportAbuseType" class="form-control"
                                                            required>
                                                        <option value="Publisher / Website" selected>Publisher /
                                                            Website
                                                        </option>
                                                        <option value="Advertiser / Landing Page URL">Advertiser /
                                                            Landing Page URL
                                                        </option>
                                                        <option value="Banner Ads">Banner Ads</option>
                                                        <option value="Data Protection Violation">Data Protection
                                                            Violation
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="reportAbuseWebsite" class="col-form-label">Violation
                                                        Website/Page URL</label>
                                                    <input type="url" class="form-control" name="abuseWebsite"
                                                           id="reportAbuseWebsite" placeholder="https://" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="reportAbuseProof" class="col-form-label">Screenshot /
                                                        Proof URL</label>
                                                    <input type="url" class="form-control" name="abuseProof"
                                                           id="reportAbuseProof"
                                                           placeholder="https://prnt.sc/.... (optional)">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="reportAbuseMessage"
                                                           class="col-form-label">Message</label>
                                                    <textarea name="message" id="reportAbuseMessage" cols="30" rows="11"
                                                              class="form-control"
                                                              placeholder="Write here your message to help us better understand the report type..."
                                                              required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="g-recaptcha"
                                                     data-sitekey="6Ld9EXkUAAAAAHC3gcVn4ozcj3GcOaUEKrmse-Gx"></div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button type="submit" class="btn shine">Report This Abuse</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
include(__DIR__ . '/footer.php');
