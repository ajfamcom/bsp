<?php

/**Template Name:News Header Section */ ?>
<div class="latest-news-top-section">
    <div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="head-news"><?php do_shortcode('[news_header]'); ?></div>
        </div>
        <div class="col-md-4">
        <div class="head-search"><?php include "searchform.php"; ?></div>
        </div>
    </div>
    </div>
</div>