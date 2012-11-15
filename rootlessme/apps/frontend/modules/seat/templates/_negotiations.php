<div id="negotiationHistoryBlock">
    <div id="seatNegotiationHistoryList">
        <?php foreach ($negotiationChanges as $negotiationChange):
                  $newHistoryItem = $negotiationChange->getNewSeatHistory();
                  $changer = $newHistoryItem->getPeople()->getProfiles();
                  $route = $newHistoryItem->getRoutes();
                  ?>
            <div class="seatNegotiationHistoryItem">
                <div class="seatNegotiationHistoryUserImage">
                    <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $changer->getPictureUrlSmall() ?>" alt="<?php echo $changer->getFullName() ?>" />   
                </div>
                <div class="seatNegotiationHistoryUserName">
                    <p>
                        <span class="seatNegotiationUserNameText"><?php echo $changer->getFullName() ?> </span>changed:
                    </p>
                 </div>
                <div class="seatNegotiationHistorySpecifics">
                    <ul>
                        <?php if ($negotiationChange->getIsSoloRouteIdDifferent()): ?>
                            <li>
                                <span class="seatNegotiationHistoryItemCategory">Pickup location:</span>
                                 
                                <span class="seatNegotiationHistoryItemSpecificText"><?php echo $route->getOriginString() ?></span>
                            </li>
                            <li>
                                <span class="seatNegotiationHistoryItemCategory">Dropoff location:</span>
                                
                                <span class="seatNegotiationHistoryItemSpecificText"><?php echo $route->getDestinationString(); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if ($negotiationChange->getIsSeatStatusIdDifferent()): ?>
                            <li>
                               <span class="seatNegotiationHistoryItemCategory">Seat status:</span>
                                
                               <span class="seatNegotiationHistoryItemSpecificText"><?php echo SeatStatusesTable::getStatusString($newHistoryItem->getSeatStatusId()) ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if ($negotiationChange->getIsPriceDifferent()): ?>
                            <li>
                               <span class="seatNegotiationHistoryItemCategory">Price:</span>
                               
                               <span class="seatNegotiationHistoryItemSpecificText">$<?php echo $newHistoryItem->getPrice() ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if ($negotiationChange->getIsSeatCountDifferent()): ?>
                            <li>
                               <span class="seatNegotiationHistoryItemCategory">Seat count:</span>
                               
                               <span class="seatNegotiationHistoryItemSpecificText"><?php echo $newHistoryItem->getSeatCount() ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if ($negotiationChange->getIsPickupDateDifferent()): ?>
                            <li>
                               <span class="seatNegotiationHistoryItemCategory">Pickup date:</span>
                               
                               <span class="seatNegotiationHistoryItemSpecificText"><?php echo date("m/d/Y",strtotime($newHistoryItem->getPickupDate())) ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if ($negotiationChange->getIsPickupTimeDifferent()): ?>
                            <li>
                               <span class="seatNegotiationHistoryItemCategory">Pickup time:</span>
                               
                               <span class="seatNegotiationHistoryItemSpecificText"><?php echo date("g:i A",strtotime($newHistoryItem->getPickupTime())) ?></span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <?php if ($negotiationChange->getIsDescriptionDifferent() && $newHistoryItem->getDescription() != ''): ?>
                    <div class="seatNegotiationHistoryItemUserSays">
                               <span class="seatNegotiationHistoryItemCategorySays"><?php echo $changer->getFullName() ?> says: </span>
                               <br />
                               <br />
                               <?php echo $newHistoryItem->getDescription() ?>
                    </div>
                <?php endif; ?>
                <div class="seatNegotiationHistoryUpdateTime">
                    Updated at <?php echo date('g:i A l, F j, Y', strtotime($newHistoryItem->getCreatedAt())) ?>
                </div>
                
                <div class="clearfix"></div>
                <hr class="historyHr"/>
            </div>
        <?php endforeach; ?>
    </div>
</div>