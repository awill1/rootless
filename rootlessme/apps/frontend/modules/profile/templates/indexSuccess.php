<h1>Profiles List</h1>

<table>
  <thead>
    <tr>
      <th>Profile name</th>
      <th>Person</th>
      <th>First name</th>
      <th>Last name</th>
      <th>Picture url</th>
      <th>Picture url large</th>
      <th>Picture url medium</th>
      <th>Picture url small</th>
      <th>Picture url tiny</th>
      <th>Address 1</th>
      <th>Address 2</th>
      <th>City</th>
      <th>State</th>
      <th>Postal code</th>
      <th>Country</th>
      <th>Birthday</th>
      <th>Gender</th>
      <th>About me</th>
      <th>Top 5</th>
      <th>Wants to travel to</th>
      <th>Music</th>
      <th>Movies</th>
      <th>Books</th>
      <th>Interests</th>
      <th>Favorite websites</th>
      <th>Website url</th>
      <th>Facebook user name</th>
      <th>Twitter user name</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($profiles as $profile): ?>
    <tr>
      <td><a href="<?php echo url_for('profile/show?profile_name='.$profile->getProfileName()) ?>"><?php echo $profile->getProfileName() ?></a></td>
      <td><?php echo $profile->getPersonId() ?></td>
      <td><?php echo $profile->getFirstName() ?></td>
      <td><?php echo $profile->getLastName() ?></td>
      <td><?php echo $profile->getPictureUrl() ?></td>
      <td><?php echo $profile->getPictureUrlLarge() ?></td>
      <td><?php echo $profile->getPictureUrlMedium() ?></td>
      <td><?php echo $profile->getPictureUrlSmall() ?></td>
      <td><?php echo $profile->getPictureUrlTiny() ?></td>
      <td><?php echo $profile->getAddress1() ?></td>
      <td><?php echo $profile->getAddress2() ?></td>
      <td><?php echo $profile->getCity() ?></td>
      <td><?php echo $profile->getState() ?></td>
      <td><?php echo $profile->getPostalCode() ?></td>
      <td><?php echo $profile->getCountry() ?></td>
      <td><?php echo $profile->getBirthday() ?></td>
      <td><?php echo $profile->getGender() ?></td>
      <td><?php echo $profile->getAboutMe() ?></td>
      <td><?php echo $profile->getTop5() ?></td>
      <td><?php echo $profile->getWantsToTravelTo() ?></td>
      <td><?php echo $profile->getMusic() ?></td>
      <td><?php echo $profile->getMovies() ?></td>
      <td><?php echo $profile->getBooks() ?></td>
      <td><?php echo $profile->getInterests() ?></td>
      <td><?php echo $profile->getFavoriteWebsites() ?></td>
      <td><?php echo $profile->getWebsiteUrl() ?></td>
      <td><?php echo $profile->getFacebookUserName() ?></td>
      <td><?php echo $profile->getTwitterUserName() ?></td>
      <td><?php echo $profile->getCreatedAt() ?></td>
      <td><?php echo $profile->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('profile/new') ?>">New</a>
