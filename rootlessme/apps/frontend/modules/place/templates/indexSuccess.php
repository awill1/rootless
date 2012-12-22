<?php use_stylesheet(sfConfig::get('app_css_place')) ?>
<div id="indexMain">
    <h1>Share rides to your favorite places</h1>
    <ul class="placesList">
        <?php foreach ($places as $place): ?>
            <li>
                <div class="placeBox">
                    <div class="placeImg">
                        <img src="C:\Users\Russ\rootless\ski\placesindeximg.jpg" width="361"/>
                    </div>
                    <div class="placeInfo">
                        <div class='placeName'><?php echo $place->getName() ?></div>
                        <div class='placeLocation'>City, State</div>
                        <div class='placeTags'><?php echo $place->getTags() ?></div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<div id="devTable">
<table>
  <thead>
    <tr>
      <th>Place</th>
      <th>Name</th>
      <th>Website url</th>
      <th>Is partner</th>
      <th>Contact email address</th>
      <th>Contact phone number</th>
      <th>Logo url</th>
      <th>Tags</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($places as $place): ?>
    <tr>
      <td><a href="<?php echo url_for('place/show?place_id='.$place->getPlaceId()) ?>"><?php echo $place->getPlaceId() ?></a></td>
      <td><?php echo $place->getName() ?></td>
      <td><?php echo $place->getWebsiteUrl() ?></td>
      <td><?php echo $place->getIsPartner() ?></td>
      <td><?php echo $place->getContactEmailAddress() ?></td>
      <td><?php echo $place->getContactPhoneNumber() ?></td>
      <td><?php echo $place->getLogoUrl() ?></td>
      <td><?php echo $place->getTags() ?></td>
      <td><?php echo $place->getCreatedAt() ?></td>
      <td><?php echo $place->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
<div id="devNew">
  <a href="<?php echo url_for('place/new') ?>">New</a>
</div>