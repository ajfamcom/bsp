<?php

/**Template Name:News Header Section */ ?>
<div class="latest-news-top-section">
    <div class="container">
    <div class="row">
        <div class="col-md-6">
            <?php do_shortcode('[news_header]'); ?>
        </div>
        <div class="col-md-6">
            <?php include "searchform.php"; ?>
        </div>
    </div>
    </div>
</div>