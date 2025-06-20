<div class="hero-banner">
    <div class="hero-logo">
        <img src="<?= $data['hero_logo']['src']; ?>" alt="<?= $data['hero_logo']['alt']; ?>" width="<?= $data['hero_logo']['width']; ?>px" height="<?= $data['hero_logo']['height']; ?>px">
    </div>
    <div class="hero-images">
        <?php foreach($data['hero_images'] as $image): ?>
            <div class="hero-image">
                <img src="<?= $image['src']; ?>" alt="<?= $image['alt']; ?>" width="<?= $image['width']; ?>px" height="<?= $image['height']; ?>px">
                <div class="overlay"></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>