<table>
    <tr>
        <?= wp_nonce_field('test_metabox_nonce', 'test_metabox_nonce'); ?>
    </tr>
    <tr>
        <th><?= $something->renderLabel(); ?></th>
        <td><?= $something->renderField(); ?></td>
    </tr>
</table>