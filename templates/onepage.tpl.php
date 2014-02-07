<header role="banner" data-scroll-header>
	<nav class="Navigation">
	  <ul class="Navigation-list">
	    <?php foreach ($top_menu as $item):?>
	      <li class="<?php print $item['classes']; ?>"><?php print $item['link']; ?></li>
	    <?php endforeach; ?>
	  </ul>
	  <?php // print $jump_menu; ?>
	</nav>
	<div class="Logo">
		<img src="/sites/all/themes/dcamp/images/logo.svg" alt="DrupalCamp Stockholm logo" height="170" width="170" class="Logo-img">
	</div>
</header>

<div class="main">
<?php foreach ($sections as $section):?>
  <section class="<?php print $section['class']; ?>" id="<?php print $section['id']; ?>">
  	<a class="Section-jumplink" name="<?php print $section['id']; ?>" id="<?php print $section['id']; ?>"></a>
    	<?php print $section['markup']; ?>
  </section>
<?php endforeach; ?>
</div>
