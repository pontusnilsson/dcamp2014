<div class="bg-gradient"></div>
<a id="home"></a>


<nav id ="nav-collapse" class="menu menu-sticky">
  <ul id="nav">
    <?php foreach ($top_menu as $item):?>
      <li class="<?php print $item['classes']; ?>"><?php print $item['link']; ?></li>
    <?php endforeach; ?>
  </ul>
  <?php print $jump_menu; ?>
</nav>

<?php foreach ($sections as $section):?>
  <section class="<?php print $section['class']; ?>" id="<?php print $section['id']; ?>">
    <?php print $section['markup']; ?>
  </section>
<?php endforeach; ?>
<footer class="footer">

</footer>
