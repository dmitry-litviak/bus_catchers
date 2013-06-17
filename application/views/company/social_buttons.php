<div class="centered">
    <a href="<?php echo URL::site('compare') ?>">Follow this link to view all companies at one page</a>
</div>
<hr>
<input type="hidden" id="company" value="<?php echo $company->id ?>">
<?php if (empty($_SESSION['user'])): ?>
    <div class="social-buttons">
        <h3>Sign in to leave a review</h3>
        <a class="btn btn-facebook" href="<?php echo URL::site("company/login?type=Facebook") ?>"><i class="icon-facebook"></i>  Sign in with Facebook</a>
        <a class="btn btn-twitter" href="<?php echo URL::site("company/login?type=Twitter") ?>"><i class="icon-twitter"></i>  Sign in with Twitter</a>
        <a class="btn btn-google-plus" href="<?php echo URL::site("company/login?type=Google") ?>"><i class="icon-google-plus"></i>  Sign in with Google</a>
    </div>
<?php else: ?>
    <div class="social-buttons">
        <h3>You logged in as <?php echo $_SESSION['user']['displayName'] ?></h3>
        <a class="btn gl" href="<?php echo URL::site("company/logout") ?>">Logout</a>
    </div>
    <hr>
    <?php if (!ORM::factory('Comment')->where('user_id', '=', $_SESSION['user']['identifier'])->where('company_id', '=', $company->id)->find()->id): ?>
        <div>
            <form class="form-actions comment-form well well-large" action="<?php echo URL::site('company/comment') ?>" method="POST">
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user']['identifier'] ?>">
                <input type="hidden" name="photo" value="<?php echo $_SESSION['user']['photoURL'] ? $_SESSION['user']['photoURL'] : URL::site('/img/default-profile.jpg') ?>">
                <input type="hidden" name="company_id" value="<?php echo $company->id ?>">
                <div class="row-fluid">
                    <div class="span8">
                        <div class="control-group">
                            <label class="control-label" for="rate">1. Choose a rating:</label>
                            <div class="controls">
                                <div class="rating"></div>
                                <input type="hidden" id="rating" name="rating">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="title">2. Add a title:</label>
                            <div class="controls">
                                <input class="span12" type="text" placeholder="Some Title" name="title" id="title">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="name">3. Post As:</label>
                            <div class="controls">
                                <input class="span12" type="text" value="<?php echo $_SESSION['user']['displayName'] ?>" name="name" id="name">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="message">4. Write a review:</label>
                            <div class="controls">
                                <textarea class="span12" rows="3" name="message" id="message" placeholder="Some Message"></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="span4">
                        <label>Detailed Ratings (optional):</label>
                        <div class="row-fluid new-rating">
                            <div class="span4">Timeliness:</div>
                            <div id="timeliness" class="span9"></div>
                            <input type="hidden" id="timeliness-input" name="timeliness">
                        </div>
                        <div class="row-fluid new-rating">
                            <div class="span4">Comfort:</div>
                            <div id="comfort" class="span9"></div>
                            <input type="hidden" id="comfort-input" name="comfort">
                        </div>
                        <div class="row-fluid new-rating">
                            <div class="span4">WiFi:</div>
                            <div id="wifi" class="span9"></div>
                            <input type="hidden" id="wifi-input" name="wifi">
                        </div>
                        <div class="row-fluid new-rating">
                            <div class="span4">Empty seating:</div>
                            <div id="empty-seating" class="span9"></div>
                            <input type="hidden" id="empty-seating-input" name="empty_seating">
                        </div>
                        <div class="row-fluid new-rating">
                            <div class="span4">Cleanliness:</div>
                            <div id="cleanliness" class="span9"></div>
                            <input type="hidden" id="cleanliness-input" name="cleanliness">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <?php else: ?>
        <h3>You have already written a review for this company</h3>
    <?php endif; ?>
<?php endif; ?>
<div class="comments-block">
</div>
