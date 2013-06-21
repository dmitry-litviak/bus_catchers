<div class="span12" id="divMain">

    <div style="text-align:center">
        <h1>EasternShuttle</h1>
        <div class="rate-title">
            <div class="avg_rate" data-company="<?php echo $company->id ?>"></div>
            <span></span>
        </div>
    </div>

    <hr />
    <div class="well well-large justified">
        Tickets and Confirmation - Immediately after successfully completing check out, the customer will receive an order summary and eTickets by email. NONREFUNDABLE - ALL TICKETS ARE
        Nonrefundable. Please check the selected schedule information carefully before check out, ticket purchases are final and are not refundable or changeable. Duplicate transactions are also not refundable because duplicate transactions block other customers from purchasing tickets. There will be no refund or reschedule for any unused or partly used services.

        Condition of Use - (1) The ticket is valid only for the date and time stated on the ticket. (2) Customers have to bring a valid ID and a printout of the eTicket (confirmation email) at boarding for ID Check. (3) Customer's name (s) on e-ticket must match passenger's (or one of the passengers') name. (4) The printout of eTickets must be signed by customer as proof of boarding. (5) **Passenger must arrive 30 minutes prior departure time, otherwise the seat might be sold to stand-by passengers.   
    </div>
    <?php echo View::factory('company/social_buttons')->bind("company", $company)->render(); ?>
</div>