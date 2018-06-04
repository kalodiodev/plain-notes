<?php if(isset($pager)): ?>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">

            <li class="page-item <?php if(! $pager->hasPrevious()) { echo 'disabled'; } ?>">
                <a class="page-link" href="<?php echo '?page=' . $pager->previous(); ?>">Previous</a>
            </li>

            <?php for($i=1; $i<=$pager->pages(); $i++): ?>
                <li class="page-item <?php if($i == $pager->page()) { echo 'active'; } ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?php if(! $pager->hasNext()) { echo 'disabled'; }?>">
                <a class="page-link" href="<?php echo '?page=' . $pager->next(); ?>">Next</a>
            </li>
        </ul>
    </nav>
<?php endif; ?>