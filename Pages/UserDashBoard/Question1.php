<?php
include '../../Includes/header.php';
?>


<form action="process_form.php" method="post">
  <div class="content-container text-center">
    <h1 class="HeadText">Vragen</h1>
    <p class="BasicText">Vraag 1 - 10</p>

    <p id="QuestionText"  class="BasicText">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi, delectus odit quia corrupti error explicabo provident illo officiis, corporis maxime labore minima nemo eveniet soluta ut! Tempora velit iusto dolorem?</p>

    <div class="col-auto">
      <div class="radio-label">
      <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
      <label class="btn btn-secondary" for="option1">Vraag 1</label>
    </div>

    <div class="col-auto">
      <div class="radio-label">
        <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
        <label class="btn btn-secondary" for="option2">Vraag 2</label>
      </div>
    </div>

    <div class="col-auto">
      <div class="radio-label">
        <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
        <label class="btn btn-secondary" for="option3">Vraag 3</label>
      </div>
    </div>

    <div class="col-auto">
      <div class="radio-label">
        <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off">
        <label class="btn btn-secondary" for="option4">Vraag 4</label>
      </div>
    </div>

    <!-- Buttons below the radios -->
    <label for="fileInput" class="btn btn-primary">Foto kiezen*<input type="file" id="fileInput" name="userPhoto" accept="image/*" style="display: none;"></label><br>
    <button type="" class="btn btn-primary">Volgende</button>
  </div>
</form>