<div class="span12" id="divMain">

    <div style="text-align:center">
        <h1>Megabus</h1>
        <div class="avg_rate" data-company="<?php echo $company->id ?>"></div>
    </div>

    <hr />
    <div class="well well-large justified">
        Megabus.com is the first, low-cost, express bus service to offer city center-to-city center travel for as low as $1 via the Internet. Since launching in April 2006, megabus.com has served more than 24 million customers throughout more than 100 cities across North America.  Our luxury single and double deckers offer free wi-fi, at-seat plug ins, panoramic windows and a green alternative way to travel. Meticulously maintained with professional drivers at the wheel, when you travel with megabus.com, you will be riding in comfort and confidence. We provide affordable and reliable bus services, offering the highest level of comfort and safety.  You can be assured of a great experience and overall satisfaction when you choose megabus.com. Our professional staff, and our fleet of clean, comfortable, well maintained wheelchair accessible, state-of-the-art double decker buses enable us to provide you with the dependable, quality service you expect.  We look forward to serving you!
    </div>
    <?php echo View::factory('company/social_buttons')->bind("company", $company)->render(); ?>
</div>