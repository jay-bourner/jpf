<footer>
    <div class="footer-grid">
        <?php foreach($footer['columns'] as $column): ?>
            <div class="<?= (isset($column['class'])) ? $column['class'] : '' ?>">
                <?php if (isset($column['header'])): ?>
                    <div class="links-header">
                        <h3><?= $column['header'] ?></h3>
                    </div>
                <?php endif; ?>
                <nav>
                    <?php foreach($column['links'] as $link): ?>
                        <div>
                            <?php if (isset($link['name'])): ?>
                                <a href="<?= $link['href'] ?>"><?= $link['name'] ?></a>
                            <?php elseif (isset($link['email'])): ?>
                                Email: <a href="mailto:<?= $link['email'] ?>"><?= $link['email'] ?></a>
                            <?php elseif (isset($link['tel'])): ?>
                                Tel: <a href="tel:<?= $link['tel'] ?>"><?= $link['tel'] ?></a>
                            <?php elseif (isset($link['icon'])): ?>
                                <a href="<?= $link['href'] ?>" target="_blank">
                                    <span class="svg-icon svg-icon--<?= $link['icon'] ?>"></span>
                                </a>
                            <?php elseif (isset($link['text'])): ?>
                                <?= $link['text'] ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </nav>
            </div>
        <?php endforeach; ?>
    </div>
</footer>