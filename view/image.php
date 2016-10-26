<li>
    <?php printf('<img src="%s" />', $image->images->standard_resolution->url); ?>
    <?php echo $qrCode->image("image alt", ['class' => 'qr-code-img']); ?>
</li>