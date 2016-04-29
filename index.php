<?php
  require_once('header.php');
?>
    <form action="mastery.php" method="POST" accept-charset="UTF-8">
      <div class="container_input">
        <input type="text" name="summoner[0][name]" placeholder="Search..." required />
        <input type="submit" value="I'm the Best!" name="submit" />
      </div>
      <div class="container_checkbox_select">
        <label><input type="radio" name="isearcha" value="summoner" /> Summoner</label>
        <label><input type="radio" name="isearcha" value="team" /> Team</label>
        <label><input class="disabled" type="radio" name="isearcha" value="club" disabled /> Club<span>(soon)</span></label>
        <select name="summoner[0][region]" required>
          <?php require('regionList.php'); ?>
        </select>
      </div>
      <div class="container_add_summoner">

      </div>
      <div id="add_summoner" class="button_add_summoner"><img src="assets/images/braum-add.png" alt="Add a new summoner" title="Add a new summoner"/></div>
    </form>
    <p class="text_punchline">
      Here we go, find your Summoner, your team or your mate,
and compare your Champion masteries.
  <br /><br />
Are you better than your mate ?
    </p>
<?php
  require_once('footer.php');
?>