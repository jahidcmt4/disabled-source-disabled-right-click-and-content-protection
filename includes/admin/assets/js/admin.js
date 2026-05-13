jQuery(document).ready(function($) {
    $('.jh-pro-feature').each(function() {
        // Pricing page URL
        var pricingUrl = 'admin.php?page=disabled-source-disabled-right-click-and-content-protection-pricing';
        
        // Create the button
        var $btn = $('<a href="' + pricingUrl + '" class="jh-pro-buy-btn">Upgrade to Pro</a>');
        
        // Append to the section
        $(this).append($btn);
    });
});
