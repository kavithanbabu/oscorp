<!--LEFT NAV-->
<aside class="grid_3 col pull_9 leftnav">
    <header><h4 class="bottomBorder notopmargin refine">REFINE BY:</h4></header>
    <div class="clear"> </div>  
    <?php
    $arg = array('hide_empty' => '0', 'orderby' => 'id', 'order' => 'ASC', 'parent' => '0');
    $terms_sub = get_terms('product_cat', $arg);
    ?>
    <section class="boxbottomBorderThin">
        <h4>DEPARTMENTS</h4>
        <ul class="norm_list with_arrow">
            <?php foreach ($terms_sub as $filterterm) { ?>
                <li class="active last">
                    <a href="<?php echo get_term_link($filterterm->slug, 'product_cat'); ?>"><?php echo $filterterm->name; ?></a>
                    <?php
                    $secarg = array('hide_empty' => '0', 'orderby' => 'id', 'order' => 'ASC', 'parent' => $filterterm->term_id);
                    $subterms = get_terms('product_cat', $secarg);
                    if (count($subterms) > 0) {
                        foreach ($subterms as $secTerm) {
                            ?>
                            <ul class="sublist">
                                <li class="inactive">
                                    <a href="<?php echo get_term_link($secTerm->slug, 'product_cat'); ?>"><?php echo $secTerm->name; ?></a>
                                </li>
                            </ul>
                            <?php
                        }
                    }
                    ?>
                </li>
            <?php } ?>
        </ul>
    </section>
</aside>
<!--END LEFT NAV-->