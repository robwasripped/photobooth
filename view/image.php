<li>
    <?php printf('<img src="%s" />', $image->images->standard_resolution->url); ?>
    <p class="qr">
        <?php echo $qrCode->image("image alt", ['class' => 'qr-code-img']); ?>
        Scan the code to see your photo on instagram
    </p>
</li>