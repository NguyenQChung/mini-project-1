<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>


<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination">
        <?php if ($pager->hasPrevious()): ?>
            <li>
                <a class="page-link" href=" <?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                    <i class="fas fa-angle-double-left" aria-hidden="true"></i>
                </a>
            </li>
            <li>
                <a class="page-link" href="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang('Pager.previous') ?>">
                    <i class="fas fa-chevron-left" aria-hidden="true"></i>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link): ?>
            <li <?= $link['active'] ? 'class="active page-item"' : 'class="page-item"' ?>>
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()): ?>
            <li>
                <a class="page-link" href="<?= $pager->getNextPage() ?>" aria-label="<?= lang('Pager.next') ?>">
                    <i class="fas fa-chevron-right" aria-hidden="true"></i>
                </a>
            </li>
            <li>
                <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                    <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                </a>
            </li>
        <?php endif ?>

    </ul>

</nav>