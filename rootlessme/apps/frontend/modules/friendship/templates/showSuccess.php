<table>
  <tbody>
    <tr>
      <th>Friend1:</th>
      <td><?php echo $friendship->getFriend1Id() ?></td>
    </tr>
    <tr>
      <th>Friend2:</th>
      <td><?php echo $friendship->getFriend2Id() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $friendship->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $friendship->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('friendship_edit', array('friend1_id'=>$friendship->getFriend1Id(),'friend2_id'=>$friendship->getFriend2Id())) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('friendship') ?>">List</a>
