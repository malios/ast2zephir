<?php

namespace Malios;

class HTMLTable
{
    public function render(array $data)
    {
        ?>
<table>
    <tr>
        <?php foreach (array_keys($data[0]) as $heading): ?>
        <th><?php echo $heading; ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($data as $row) {?>
    <tr>
        <?php foreach ($row as $col): ?>
        <td><?php echo $col; ?></td>
        <?php endforeach; ?>
    </tr>
    <?php } ?>
</table>
        <?php
    }
}
