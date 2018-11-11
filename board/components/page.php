<table>
  <tr class="page">
    <td><a href="index.php?page=<?php echo $page > 1 ? $page - 1 : 1 ?>">上一頁</a></td>
    <?php for ($i = $begin; $i <= $end; $i++): ?>
    <td <?php echo $i===$page ? 'class="active"' : '' ; ?>><a href="index.php?page=<?php echo $i ?>">
        <?php echo $i ?></a></td>
    <?php endfor?>
    <td><a href="index.php?page=<?php echo $page < $end ? $page + 1 : $end ?>">下一頁</a></td>
  </tr>
</table>