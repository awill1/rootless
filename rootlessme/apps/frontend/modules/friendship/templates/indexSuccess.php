<h1>Friendships List</h1>

<table>
  <thead>
    <tr>
      <th>Friend1</th>
      <th>Friend2</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($friendships as $friendship): ?>
    <tr>
      <td><a href="<?php echo url_for('friendship_show', array('friend1_id'=>$friendship->getFriend1Id(),'friend2_id'=>$friendship->getFriend2Id())) ?>"><?php echo $friendship->getFriend1Id() ?></a></td>
      <td><a href="<?php echo url_for('friendship_show', array('friend1_id'=>$friendship->getFriend1Id(),'friend2_id'=>$friendship->getFriend2Id())) ?>"><?php echo $friendship->getFriend2Id() ?></a></td>
      <td><?php echo $friendship->getCreatedAt() ?></td>
      <td><?php echo $friendship->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('friendship/new') ?>">New</a>
