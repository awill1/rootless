<div id="driverRatingSummary">
    <ul id="feedbackSummaryList">
        <li class="feedbackSummaryListItem"><div id="safeDriverRating" class="feedbackRatingBar"><div class="feedbackRatingBarValue" style="width: <?php echo round($ratings['safetyAverage']) ?>%;"><?php echo round($ratings['safetyAverage']) ?>%</div></div><div class="feedbackRatingBarLabel">Safe Driver</div></li>
        <li class="feedbackSummaryListItem"><div id="puncualityRating" class="feedbackRatingBar"><div class="feedbackRatingBarValue" style="width: <?php echo round($ratings['punctualityAverage']) ?>%;"><?php echo round($ratings['punctualityAverage']) ?>%</div></div><div class="feedbackRatingBarLabel">Punctuality</div></li>
        <li class="feedbackSummaryListItem"><div id="friendlinessRating" class="feedbackRatingBar"><div class="feedbackRatingBarValue" style="width: <?php echo round($ratings['friendlinessAverage']) ?>%;"><?php echo round($ratings['friendlinessAverage']) ?>%</div></div><div class="feedbackRatingBarLabel">Friendliness</div></li>
        <li class="feedbackSummaryListItem"><div id="goodRiderRating" class="feedbackRatingBar"><div class="feedbackRatingBarValue" style="width: <?php echo round($ratings['riderAverage']) ?>%;"><?php echo round($ratings['riderAverage']) ?>%</div></div><div class="feedbackRatingBarLabel">Good Rider</div></li>
    </ul>
    <div id="howmanyReviews">
        Based on 
        <?php echo $ratings['reviewCount'] ?> 
        response<?php if ($ratings['reviewCount'] != 1){ echo 's'; } ?>.
    </div>
</div>
