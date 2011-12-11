<hr />
<h3>Negotiations</h3>
<div id="seatNegotiationHistoryList">
    <?php foreach ($negotiations as $negotiation):
              $changer = $negotiation->getPeople()->getProfiles()->getFirst();
              $route = $negotiation->getRoutes(); ?>
    <div class="seatNegotiationHistoryItem">
        <div class="seatNegotiationHistoryUserImage">
            <img src="<?php echo sfConfig::get('app_profile_picture_directory') ?><?php echo $changer->getPictureUrlSmall() ?>" alt="<?php echo $changer->getFullName() ?>" />   
           </div>
            <div class="seatNegotiationHistoryUserName">
                <p>
                    <span class="seatNegotiationUserNameText">  <?php echo $changer->getFullName() ?> </span>changed 
                </p>
             </div>
        <div class="seatNegotiationHistorySpecifics">
        <ul>
            <li>
                <span class="seatNegotiationHistoryItemCategory">Pickup location </span>to <span class="seatNegotiationHistoryItemSpecificText"><?php echo $route->getOriginLocation()->getName() ?></span>
            </li>
            <li>
               <span class="seatNegotiationHistoryItemCategory"> Dropoff location </span>to <span class="seatNegotiationHistoryItemSpecificText"><?php echo $route->getDestinationLocation()->getName() ?></span>
            </li>
            <li>
               <span class="seatNegotiationHistoryItemCategory"> Seat status </span>to <span class="seatNegotiationHistoryItemSpecificText"><?php echo SeatStatusesTable::getStatusString($negotiation->getSeatStatusId()) ?></span>
            </li>
            <li>
               <span class="seatNegotiationHistoryItemCategory"> Price </span>to <span class="seatNegotiationHistoryItemSpecificText">$<?php echo $negotiation->getPrice() ?></span>
            </li>
            <li>
               <span class="seatNegotiationHistoryItemCategory"> Seat count </span>to <span class="seatNegotiationHistoryItemSpecificText"><?php echo $negotiation->getSeatCount() ?></span>
            </li>
            <li>
               <span class="seatNegotiationHistoryItemCategory"> Pickup date </span>to <span class="seatNegotiationHistoryItemSpecificText"><?php echo date("m/d/Y",strtotime($negotiation->getPickupDate())) ?></span>
            </li>
            <li>
               <span class="seatNegotiationHistoryItemCategory"> Pickup time </span>to <span class="seatNegotiationHistoryItemSpecificText"><?php echo date("g:i A",strtotime($negotiation->getPickupTime())) ?></span>
            </li>
            </ul>
            </div>
            <div class="seatNegotiationHistoryItemUserSays">
                <ul>
                    
            <hr />
            <li>
               <span class="seatNegotiationHistoryItemCategorySays"> <?php echo $changer->getFullName() ?> Says </span>
                       <br />
                       <br />
                       <?php echo $negotiation->getDescription() ?>
            </li>
            <div class="seatNegotiationHistoryUpdateTime">
            <li>
                Updated <?php echo $negotiation->getCreatedAt() ?>
            </li>
            </div>
        </ul>
            </div>
    </div>
    <?php endforeach; ?>
</div>
