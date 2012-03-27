         <li class="driverReviewsListItem">
             <a href="<?php echo $review->getPeople()->getProfiles()->getProfileName() ?>">
                 <img class="feedbackProfilePicture" src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $review->getPeople()->getProfiles()->getPictureUrlSmall() ?>" alt="<?php echo $review->getPeople()->getProfiles()->getFullName() ?>" />
             </a>
            <h3 class="feedbackProfileHeading">
              <span class="reviewNameColor">
                <a href="<?php echo $review->getPeople()->getProfiles()->getProfileName() ?>">
                  <?php echo $review->getPeople()->getProfiles()->getFullName() ?>
                </a>
              </span>
            </h3>
            <p class="feedbackProfileComment">
                <?php echo $review->getComments() ?>
            </p>
        </li>
        <div id="profileDivider"><hr /></div>