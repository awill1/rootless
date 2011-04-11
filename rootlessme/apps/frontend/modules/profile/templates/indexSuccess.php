<h1>Profiless List</h1>

<table>
  <thead>
    <tr>
      <th>Idprofile</th>
      <th>Firstname</th>
      <th>Lastname</th>
      <th>Pictureurl</th>
      <th>Pictureurllarge</th>
      <th>Pictureurlmedium</th>
      <th>Pictureurlsmall</th>
      <th>Pictureurltiny</th>
      <th>Address1</th>
      <th>Address2</th>
      <th>City</th>
      <th>State</th>
      <th>Postalcode</th>
      <th>Country</th>
      <th>Birthday</th>
      <th>Gender</th>
      <th>Aboutme</th>
      <th>Top5</th>
      <th>Wantstotravelto</th>
      <th>Music</th>
      <th>Movies</th>
      <th>Books</th>
      <th>Interests</th>
      <th>Favoritewebsites</th>
      <th>Websiteurl</th>
      <th>Facebookusername</th>
      <th>Twitterusername</th>
      <th>Createdon</th>
      <th>Modifiedon</th>
      <th>Users username</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($profiless as $profiles): ?>
    <tr>
      <td><a href="<?php echo url_for('profile/show?idprofile='.$profiles->getIdprofile()) ?>"><?php echo $profiles->getIdprofile() ?></a></td>
      <td><?php echo $profiles->getFirstname() ?></td>
      <td><?php echo $profiles->getLastname() ?></td>
      <td><?php echo $profiles->getPictureurl() ?></td>
      <td><?php echo $profiles->getPictureurllarge() ?></td>
      <td><?php echo $profiles->getPictureurlmedium() ?></td>
      <td><?php echo $profiles->getPictureurlsmall() ?></td>
      <td><?php echo $profiles->getPictureurltiny() ?></td>
      <td><?php echo $profiles->getAddress1() ?></td>
      <td><?php echo $profiles->getAddress2() ?></td>
      <td><?php echo $profiles->getCity() ?></td>
      <td><?php echo $profiles->getState() ?></td>
      <td><?php echo $profiles->getPostalcode() ?></td>
      <td><?php echo $profiles->getCountry() ?></td>
      <td><?php echo $profiles->getBirthday() ?></td>
      <td><?php echo $profiles->getGender() ?></td>
      <td><?php echo $profiles->getAboutme() ?></td>
      <td><?php echo $profiles->getTop5() ?></td>
      <td><?php echo $profiles->getWantstotravelto() ?></td>
      <td><?php echo $profiles->getMusic() ?></td>
      <td><?php echo $profiles->getMovies() ?></td>
      <td><?php echo $profiles->getBooks() ?></td>
      <td><?php echo $profiles->getInterests() ?></td>
      <td><?php echo $profiles->getFavoritewebsites() ?></td>
      <td><?php echo $profiles->getWebsiteurl() ?></td>
      <td><?php echo $profiles->getFacebookusername() ?></td>
      <td><?php echo $profiles->getTwitterusername() ?></td>
      <td><?php echo $profiles->getCreatedon() ?></td>
      <td><?php echo $profiles->getModifiedon() ?></td>
      <td><?php echo $profiles->getUsersUsername() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('profile/new') ?>">New</a>
