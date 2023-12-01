<table>
    <tr>
        <?= wp_nonce_field('test_metabox_nonce', 'test_metabox_nonce'); ?>
    </tr>
    <tr>
        <th><label for="something">Какая-то настройка:</label></th>
        <td><input type="text" name="something"  value="<?= $something; ?>"></td>
    </tr>
</table>