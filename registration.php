<?php
require_once "config.php";
include "header.php";
?>

<h1>Register user account</h1>

<form method="post" action="regsubmit.php">
  <div>
    <label for="email">E-mail</label>
    <input type="email" name="email" required/>
  </div>
  <div>
    <label for="password">Password</label>
    <input type="password" name="password" required/>
  </div>
  <div>
    <select name="country">
      <option value="ee">Estonia</option>
      <option value="lt">Latvia</option>
      <option value="lv">Lithuania</option>
    </select>
  </div>
  <div>
    <label for="phone">Telephone number</label>
    <input type="tel"/>
  </div>
  <div>
    <label for="vatin">VAT indication number</label>
    <input type="text" pattern="([A-Z0-9]{4,14})?$"/>
  </div>
  <div>
    <label for="dob">Date of birth</label>
    <input type="date" name="dob" placeholder="dd/mm/yyyy" required/>
  </div>
  <div>
    <label for="first_name">First name</label>
    <input type="text" name="first_name" required/>
  </div>
  <div>
    <label for="last_name">Last name</label>
    <input type="text" name="last_name" required/>
  </div>
  <div>
    <input type="submit"/>
  </div>
</form>

<?php include "footer.php" ?>











