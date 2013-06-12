<div class="centered">
    <a href="<?php echo URL::site('compare') ?>">Follow this link to view all companies at one page</a>
</div>
<hr>

<?php if (empty($_SESSION['user'])): ?>
    <div class="social-buttons">
        <h3>For leaving a comment you should sign in</h3>
        <a class="btn fb" href="<?php echo URL::site("company/login?type=Facebook") ?>">Sign in with Facebook</a>
        <a class="btn tw" href="<?php echo URL::site("company/login?type=Twitter") ?>">Sign in with Twitter</a>
        <a class="btn gl" href="<?php echo URL::site("company/login?type=Google") ?>">Sign in with Google</a>
    </div>
<?php else: ?>
    <div class="social-buttons">
        <h3>You logged in as <?php echo $_SESSION['user']['displayName'] ?></h3>
        <a class="btn gl" href="<?php echo URL::site("company/logout") ?>">Logout</a>
    </div>
    <hr>
    <div>
        <form class="form-horizontal">
            <div class="row-fluid">
                <div class="span7">
                    <div class="control-group">
                        <label class="control-label" for="name">Your Name:</label>
                        <div class="controls">
                            <input class="span12" type="text" placeholder="Some Name" name="name" id="name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="message">Message:</label>
                        <div class="controls">
                            <textarea class="span12" rows="3" name="message" id="message" placeholder="Some Message"></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn">Comment</button>
                        </div>
                    </div>
                </div>
                <div class="span5">
                    <div class="row-fluid">
                        <div class="span3">Timeliness:</div>
                        <div id="timeliness" class="span9"></div>
                        <input type="hidden" id="timeliness-input" name="timeliness">
                    </div>
                    <div class="row-fluid">
                        <div class="span3">Comfort:</div>
                        <div id="comfort" class="span9"></div>
                        <input type="hidden" id="comfort-input" name="comfort">
                    </div>
                    <div class="row-fluid">
                        <div class="span3">WiFi:</div>
                        <div id="wifi" class="span9"></div>
                        <input type="hidden" id="wifi-input" name="wifi">
                    </div>
                    <div class="row-fluid">
                        <div class="span3">Empty seating:</div>
                        <div id="empty-seating" class="span9"></div>
                        <input type="hidden" id="empty-seating-input" name="empty-seating">
                    </div>
                    <div class="row-fluid">
                        <div class="span3">Cleanliness:</div>
                        <div id="cleanliness" class="span9"></div>
                        <input type="hidden" id="cleanliness-input" name="cleanliness">
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>
